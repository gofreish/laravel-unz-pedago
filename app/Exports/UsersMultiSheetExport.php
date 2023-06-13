<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class UsersMultiSheetExport implements WithMultipleSheets
{
    protected array $types;

    public function __construct($type){
        $this->types = $type;
    }

    public function sheets(): array{
        $sheets = array();
        foreach($this->types as $cle => $valeur ){
            array_push($sheets, new UsersExport($valeur));
        }
        return $sheets;
    }
}
