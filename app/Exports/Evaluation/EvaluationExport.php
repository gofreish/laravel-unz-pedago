<?php

namespace App\Exports\Evaluation;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Facades\Excel;

class EvaluationExport implements WithMultipleSheets
{
    private $informations;
    private $groupes;

    /**
     * @param array infos
     * @param array groupes
     * 'programmes.id as id',
     * 'programmes.dateDebut as date',
     * 'e_c_u_s.nom as nomECU',
     * 'filieres.name as filiere',
     * 'cycles.cycle as cycle',
     * 'semestres.intitule as semestre',
     * 'promotions.annee_entrer as promotion'
    */
    public function __construct( $infos, $groupes){
        $this->informations = $infos;
        $this->groupes = $groupes;
    }

    /**
     * @return array
     */
    public function sheets(): array
    {  
        $sheets = array(
            new HeadGroupesExport($this->informations)
        );

        foreach ($this->groupes as $key => $groupe) {
            array_push($sheets, new GroupesExport($groupe));
        }
        return $sheets;
    }

    public function store(){
        $path = 'root/exports/evaluation/'.
                $this->informations['filiere'].'/'.
                $this->informations['cycle'].'/'.
                $this->informations['semestre'].'/'.
                $this->informations['nomECU'].'/'.
                $this->informations['date'].'/repartition_en_groupes.xlsx';
        Excel::store($this, $path);
    }
}
