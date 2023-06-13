<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Surveillant;
use Maatwebsite\Excel\Concerns\Importable;
use Illuminate\Database\QueryException;

class surveillantImport implements ToCollection, WithHeadingRow
{

    public $isSuccess = false;
    public $message = null;
    use Importable;

    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        if( isset($rows[0]) ){ // sil il y a au moins un surveillant dans le fichier
            $ligne = $rows[0];
            if(                             //Si l entete a tous les elements
                isset($ligne['cnib']) &&
                isset($ligne['genrem_ou_f']) &&
                isset($ligne['nom']) &&
                isset($ligne['prenom'])
            ){
                //Verification des donnees
                foreach ($rows as $key => $row) {
                    //Si ca existe deja
                    if( !is_null(Surveillant::find($row['cnib'])) ){
                        $this->message = "Le surveillant (CNIB=".$row['cnib']." ,Nom=".$row['nom']." ,Prénom=".$row['prenom']." ) existe déja, veuillez le retirer de votre liste excel";
                        return 0;
                    }
                    if( $row['genrem_ou_f'] != "M" && $row['genrem_ou_f'] != "F" ){
                        $this->message = "Le genre doit être M ou F";
                        return 0;
                    }
                }
                foreach ($rows as $key => $row) {  
                    $surveillant = Surveillant::create([
                        'cnib' => $row['cnib'],
                        'genre' => $row['genrem_ou_f'],
                        'nom' => $row['nom'],
                        'prenom' => $row['prenom'],
                        'non_paye' => 0,
                        'total' => 0
                    ]); 
                }
                $this->isSuccess = true;
            }else{
                $this->message = "Entêtes des colonnes incorrectes";
            }
        }
    }
}
