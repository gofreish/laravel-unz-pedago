<?php
/* TAF : exporter un ex de PV avec et le remplir
*/

namespace App\Imports\Deliberation;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Illuminate\Support\Str;
use App\Models\Etudiant;
use App\Models\Promotion;
use App\Models\Filiere;
use App\Models\Cycle;
use App\Models\Semestre;
use App\Models\UE;
use App\Models\ECU;
use App\Models\TestMark;
use App\Models\Deliberation;

class DeliberationImport implements ToCollection, WithHeadingRow
{
    use Importable;
    private $filiere;
    private $promotion;
    private $cycle;
    private $semestre;
    private $ecus = array();
    private $isNormal;
    private $delibDate;
    private $totalCoeff = 0;
    public $message;
    public $isSuccess = false;

    public function __construct( $promotion_id, $cycle_id , $semestre_id, $isNormal, $delibDate) {
        $this->isNormal = (boolean)$isNormal;
        $this->promotion = Promotion::find($promotion_id);
        $this->filiere = Filiere::find($this->promotion->filiere_id);
        $this->cycle = Cycle::find($cycle_id);
        $this->semestre = Semestre::find($semestre_id);
        $this->delibDate = $delibDate;
        $this->ues_id = UE::where('filiere_id', $this->filiere->id)->where('cycle_id', $this->cycle->id)->where('semestre_id', $this->semestre->id)->orderBy('nom')->pluck('id');
        foreach ($this->ues_id as $key => $ue_id) {
            $ecus = ECU::where('u_e_id', $ue_id)->orderBy('nom')->get();
            foreach ($ecus as $key => $ecu) {
                $this->totalCoeff += $ecu->coefficient;
                array_push($this->ecus, $ecu);
            }
        }
    }

    private function getSemestre(){
        $length = Str::length($this->semestre->intitule);
        return $this->semestre->intitule[$length-1];
    }

    private function getCycle(){
        switch ($this->cycle->cycle[0]) {
            case 'L':
                return 'l';
            case 'M':
                return 'm';
            case 'D':
                return 'd';
        }
    }

    public function headingRow(): int
    {
        return 2;
    }

    
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        //Supression des lignes vides
        $rows = $rows->filter( function($value, $key){
                return !is_null($value['ine']);
        });
        if( !is_null($rows->first()) ){ //Si on a un element
            $keys = $rows->first()->keys();
            //Verification des entetes
            for ($i=0; $i < count($this->ecus); $i++) { 
                if( 
                    Str::slug($this->ecus[$i]->nom,'_') 
                        !=
                    $keys[$i+1]
                    ){
                    //Si le nom d une ecu ne correspond pas
                    $this->message = "Il y a une erreur avec le nom du module :".$this->ecus[$i]->nom." veuillez retélécharger un exemplaire";
                    return 0;
                }
            }
            //Verification de l existance des etudiants
            foreach ($rows->all() as $key => $row) {
                //Si l etudiant n existe pas
                if( is_null(Etudiant::find($row['ine'])) ){
                    $this->message = "L'étudiant INE=".$row['ine']." n'existe pas en base de donner";
                    return 0;
                }
            }
            //Enregistrment des datas
            foreach ($rows as $key => $row) { //Pour chaque etudiant
                $totalPonderer = 0;
                //Pour chaque ecu
                foreach ($this->ecus as $key => $ecu) {
                    $note = floatval($row[Str::slug($ecu->nom,'_')]);
                    //On calcul les ponderer
                    $totalPonderer += $ecu->coefficient * $note;

                    $lastMark = TestMark::where('is_normal', $this->isNormal)->where('etudiant_ine', $row['ine'])->where('e_c_u_id', $ecu->id)->first();
                    //Si la note n a jamais existée
                    if( is_null($lastMark) ){
                        //On crée la note
                        $mark = TestMark::create([
                            'note' => $note,
                            'is_normal' => $this->isNormal,
                            'etudiant_ine' => $row['ine'],
                            'e_c_u_id' => $ecu->id
                        ]);
                    }else{
                        //Si la note existe deja on modifie et save
                        $lastMark->note = $note;
                        $lastMark->save();
                    }
                }
                //On conforme son historique
                $student = Etudiant::find($row['ine']);
                if( $totalPonderer >= 10*$this->totalCoeff){ //Si il a valider
                    $student->semestreValider($this->getCycle(), $this->getSemestre());
                }else{
                    $student->semestreAjourner($this->getCycle(), $this->getSemestre());
                }
                $student->cycle_id = $this->cycle->id;
                $student->save();
            }
            $deliberation = Deliberation::updateOrCreate(
                [
                    'is_normal' => $this->isNormal,
                    'promotion_id' => $this->promotion->id,
                    'cycle_id' => $this->cycle->id,
                    'semestre_id' => $this->semestre->id
                ],
                [
                    'date_delib' => $this->delibDate,
                    'is_ready' => true,
                ]
            );
            $this->isSuccess = true;
            $this->message = "Importé avec susccès";
        }else{
            $this->message = "PV de délibération vide";
        }
    }
}
