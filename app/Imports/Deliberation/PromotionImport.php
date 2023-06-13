<?php

namespace App\Imports\Deliberation;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PromotionImport implements ToCollection, WithHeadingRow
{

    private $students = array();

    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        if( !is_null($rows->get(0)) ){
            $ligne = $rows->get(0);
            //Si tout est ok
            if(
                isset($ligne['ine']) &&
                isset($ligne['nom']) &&
                isset($ligne['prenom']) &&
                isset($ligne['date_de_naissance'])
            ){
                foreach ($rows as $key => $row) {
                    $this->students[ $row['ine'] ] = array(
                            'nom' => $row['nom'],
                            'prenom' => $row['prenom'],
                            'nee_le' => $row['date_de_naissance'],
                            'ues' => array()
                        );
                }
                //dd($this->students);
            }else{
                /**
                 * Il y a des champs maquant dans l entete
                */
            }
        }else{
            /**
             * Il ny a rien dans le fichier excel
            */
        }
    }

    public function getPromotionStudents(){
        return $this->students;
    }
}
