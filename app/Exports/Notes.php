<?php
    namespace App\Exports;

    class Notes{

        private $ecu;
        private $note;
        private $coefficient;

        public function __construct($ecu="", $note=0, $coefficient=1){
            $this->ecu = $ecu;
            $this->note = $note;
            $this->coefficient = $coefficient;
        }

    }