<?php

namespace App\Exports\Note;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Facades\Excel;

class AllNotesExport implements WithMultipleSheets
{

    private $pages = array();
    private $cheminSorti;

    public function __construct( $cheminSorti ) {
        $this->cheminSorti = $cheminSorti;
    }

    /**
     * @return array
     */
    public function sheets(): array
    {
        return $this->pages;
    }

    public function newPageWithData( $data ){
        array_push($this->pages, new GroupeNotesExport($data) );
    }

    public function store(){
        Excel::store($this, $this->cheminSorti );
    }
}
