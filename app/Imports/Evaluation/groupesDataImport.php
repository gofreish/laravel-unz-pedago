<?php

namespace App\Imports\Evaluation;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Illuminate\Support\Facades\Storage;

class groupesDataImport implements WithMultipleSheets
{

    private $groupNbr;
    private $groupesDataInstance = array();

    public function __construct($path) { //-[8]; -[12]
        if(Storage::exists($path)){
            $content = Storage::get($path);
            if($content[3] == ']'){
                $this->groupNbr = intval($content[2]);
            }elseif ($path[4] == ']') {
                $this->groupNbr = intval($content[2].$content[3]);
            }
        }

    }

    public function sheets(): array
    {
        $pages = array();
        for($i=1; $i<=$this->groupNbr; $i++)
        {
            $this->groupesDataInstance[$i] = new groupeDataImport();
            $pages[$i] = $this->groupesDataInstance[$i];
        }
        return $pages;
    }

    public function getAllGroupsDatas(){
        $allGroupsDatas = array();
        foreach ($this->groupesDataInstance as $key => $groupeData) {
            array_push($allGroupsDatas, $groupeData->getDatas());
        }
        return $allGroupsDatas;
    }
}
