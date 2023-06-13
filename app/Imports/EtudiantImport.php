<?php

namespace App\Imports;

use App\Models\Etudiant;
use App\Models\Filiere;
use App\Models\Cycle;
use App\Models\Promotion;
use App\Models\Semestre;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Database\QueryException;

class EtudiantImport implements ToCollection, WithHeadingRow
{
    public $isSuccess = false;
    public $message = null;
    public $promotion_id;
    public $cycle_id;
    use Importable;

    public function __construct($promotion_id, $cycle_id) {
        $this->promotion_id = $promotion_id; 
        $this->cycle_id = $cycle_id; 
    }

    /**
    * @param array $row
    *
    * @return null
    */
    public function collection(Collection $rows)
    {   
        
        if( isset($rows[0]) ){ // sil il y a au moins un etudiant dans le fichier
            $ligne = $rows[0];
            if(                             //Si l entete a tous les elements
                isset($ligne['ine']) &&
                isset($ligne['genrem_ou_f']) &&
                isset($ligne['nom']) &&
                isset($ligne['prenom']) &&
                isset($ligne['date_de_naissance'])
            ){
                //Verification des donnees
                foreach ($rows as $key => $row) {
                    //Si ca existe deja
                    if( !is_null(Etudiant::find($row['ine'])) ){
                        $this->message = "L'étudiant (INE=".$row['ine']." ,Nom=".$row['nom']." ,Prénom=".$row['prenom']." ) existe déja, veuillez le retirer de votre liste excel";
                        return 0;
                    }
                    if( $row['genrem_ou_f'] != "M" && $row['genrem_ou_f'] != "F" ){
                        $this->message = "Le genre doit être M ou F";
                        return 0;
                    }
                }
                //Enregistrement
                foreach ($rows as $key => $row) {
                    $student = Etudiant::create([
                        'ine' => $row['ine'],
                        'genre' => $row['genrem_ou_f'],
                        'nom' => $row['nom'],
                        'prenom' => $row['prenom'],
                        'nee_le' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_de_naissance'])->format('d-m-Y'),
                        'promotion_id' => $this->promotion_id,
                        'cycle_id' => $this->cycle_id
                    ]);
                    $student->initHistorique();
                    $student->save();
                }
                $this->isSuccess = true;
            }else{
                $this->message = "Entêtes des colonnes incorrectes";
            }
        }
    }

}
