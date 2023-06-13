<?php
/*
    13.11.2019
    EditMenuViewService.php
*/

namespace App\Services;

use App\Http\Menus\GetSidebarMenu;

class PaginatorLivewire{

    private $data;
    private $perPage;
    private $indexDebut;
    private $indexFin;

    public function __construct( $data, $perPage ){
        $this->data = $data;
        $this->perPage = $perPage;
        $this->indexDebut = 0;
        $this->indexFin = $perPage - 1;
    }

    private function deplacement(){
        $this->indexDebut = $this->indexFin + 1;
        $this->indexFin = $this->indexFin + $this->perPage;
    }

    public function getElementOfPage( $numberOfPage ){
        $this->indexDebut = $this->perPage*( $numberOfPage - 1 );
        $this->indexFin = $this->perPage*$numberOfPage - 1;
        
    }
// 0;12 || 13;25 || 26;38 || 27;51
//  13*(1-1);13*1-1 || 13*(2-1);13*2 - 1 || 13*(3-1);13*3 - 1
}