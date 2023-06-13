<?php

namespace App\Imports\Evaluation;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class groupeDataImport implements ToCollection
{
    
    /*
        [
            'nom' => groupeName,
            'batiment' => bat,
            'salle' => salle,
            'inscrits' => incrits,
            'absent' => absent,
            'copies' => copies,
            'obs' => observations,
            'isValidate' => false, sert a savoir si on a enregistrer les infos: c est pour le livewire CopiesShow
            'survs' => [
                [
                    'cnib' => cnib
                    'nom' => nom,
                    'prenom' => prenom,
                    'signature' => sign
                ]
            ]
        ]
    */
    private $datas = array();

    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $this->datas['nom'] = $collection->get(0)[0];
        $this->datas['batiment'] = $collection->get(2)[0];
        $this->datas['salle'] = $collection->get(2)[1];
        $this->datas['inscrits'] = $collection->get(2)[2];
        $this->datas['absent'] = 0;
        $this->datas['copies'] = 0;
        $this->datas['obs'] = "";
        $surveillants = array();
        for($i=16; $i<count($collection); $i++){
            array_push($surveillants, array(
                    'cnib' => $collection->get($i)[0],
                    'nom' => $collection->get($i)[1],
                    'prenom' => $collection->get($i)[2],
                    'signature' => false
                )
            );
        }
        $this->datas['survs'] = $surveillants;
    }

    public function getDatas(){
        return $this->datas;
    }

    
}
