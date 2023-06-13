<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Facades\Excel;

class studentAllGroupExport implements WithMultipleSheets, ShouldAutoSize
{

    private $groupeList;

    public function __construct( $groupeList ){
        $this->groupeList = $groupeList;
    }

    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = array();
        foreach ($this->groupeList as $key => $groupe) {
            array_push($sheets, new studentGroupExport($groupe));   
        }
        return $sheets;
    }

}
