<?php

namespace App\Imports\Note;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use App\Models\Copie;
use App\Models\Programme;
use App\Models\ECU;
use App\Models\Etudiant;
use App\Models\TestMark;

class NotesImport implements ToCollection, WithHeadingRow
{
    use Importable;

    public $isSuccess = false;
    public $message = null;
    private $copie;
    private $ecu;

    public function __construct( $id_copie ) {
        $this->copie = Copie::find($id_copie);
        $programme = Programme::find($this->copie->programme_id);
        $this->ecu = ECU::find($programme->e_c_u_id);
    }

    public function headingRow(): int
    {
        return 5;
    }

    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {   
        //Si il y a quelque chose alors
        if( !is_null($rows->get(0)) ){
            $ligne = $rows->get(0);
            //Si l entete a tous les elements
            if(
                isset($ligne['ine']) &&
                isset($ligne['nom']) &&
                isset($ligne['prenom']) &&
                isset($ligne['statut']) &&
                isset($ligne['note'])
            ){
                //Verification des données
                foreach ($rows as $key => $row) {
                    //Si ca n existe pas
                    if( is_null(Etudiant::find($row['ine'])) ){
                        $this->message = "L'étudiant (INE=".$row['ine']." ,Nom=".$row['nom']." ,Prénom=".$row['prenom']." ) n'existe pas, veuillez le retirer de la liste excel et contacter la scolarité";
                        return 0;
                    }
                }

                //Enregistrement
                foreach ($rows as $key => $row) {
                    /* Si l etudiant avait une note dans le module a la session donnee alors on update.
                    Sinon on crée*/
                    $note = TestMark::updateOrCreate(
                        [   'is_normal'=>$this->copie->is_normal,
                            'etudiant_ine' => $row['ine'], 
                            'e_c_u_id'=>$this->ecu->id
                        ],
                        [   'note'=>floatval($row['note'])]
                    );
                }
                $this->isSuccess = true;
                $this->message = "Envoyé avec succès";
            }else{
                $this->message = "Entete du document incorrect. Veuillez télécharger une liste de présence";
            }
        }
    }
}
