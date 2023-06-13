<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Exports\AddOneEtudiantExport;

class AddOneEtudiant implements ToCollection, WithHeadingRow
{
    public $isSuccess = false;
    public $message = null;
    public $promotion_id;
    public $cycle_id;
    public $studentsArray = array();
    public $newStudent;
    public $storePath;

    public function __construct( $newStudent, $storePath ) {
        $this->newStudent = array(
            'ine' => $newStudent->ine,
            'genre' => $newStudent->genre,
            'nom' => $newStudent->nom,
            'prenom' => $newStudent->prenom,
            'nee_le' => $newStudent->nee_le
        );
        $this->storePath = $storePath;
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
                isset($ligne['genre']) &&
                isset($ligne['nom']) &&
                isset($ligne['prenom']) &&
                isset($ligne['date_de_naissance'])
            ){
                foreach ($rows as $key => $row) {
                    try{
                        //dd(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_de_naissance'])->format('d-m-Y'));
                        $student = array(
                            'ine' => $row['ine'],
                            'genre' => $row['genre'],
                            'nom' => $row['nom'],
                            'prenom' => $row['prenom'],
                            'nee_le' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_de_naissance'])->format('d-m-Y'),
                        );
                        array_push($this->studentsArray, $student);
                    }catch(QueryException $e){
                        $this->message = "L'étudiant (INE=".$row['ine']." ,Nom=".$row['nom']." ,Prénom=".$row['prenom']." ) existe déja, veuillez le retirer de votre liste excel";
                    }
                }
                array_push($this->studentsArray, $this->newStudent);
                $export = new AddOneEtudiantExport($this->studentsArray, $this->storePath);
                $export->store();
                $this->isSuccess = true;
            }else{
                $this->message = "Entêtes des colonnes incorrectes";
            }
        }
    }
}
