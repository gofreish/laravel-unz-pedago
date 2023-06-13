<?php

namespace App\Http\Livewire\Scolarite;

use Livewire\Component;

class StudentParcours extends Component
{
    public $parcours = [
        's1' => ['result' => 'n', 'times' => 0],
        's2' => ['result' => 'n', 'times' => 0],
        's3' => ['result' => 'n', 'times' => 0],
        's4' => ['result' => 'n', 'times' => 0],
        's5' => ['result' => 'n', 'times' => 0],
        's6' => ['result' => 'n', 'times' => 0],
        'm1' => ['result' => 'n', 'times' => 0],
        'm2' => ['result' => 'n', 'times' => 0],
        'm3' => ['result' => 'n', 'times' => 0],
        'm4' => ['result' => 'n', 'times' => 0],
        'd' => ['result' => 'false', 'times' => 0]
    ];

    public $historique = "";

    public function mount(){
        $this->updatedParcours();
    }

    public function updatedParcours(){
        $this->historique = 
        "l{".
            "1(".$this->parcours['s1']['result'].":".$this->parcours['s1']['times'].");".
            "2(".$this->parcours['s2']['result'].":".$this->parcours['s2']['times'].");".
            "3(".$this->parcours['s3']['result'].":".$this->parcours['s3']['times'].");".
            "4(".$this->parcours['s4']['result'].":".$this->parcours['s4']['times'].");".
            "5(".$this->parcours['s5']['result'].":".$this->parcours['s5']['times'].");".
            "6(".$this->parcours['s6']['result'].":".$this->parcours['s6']['times'].");".
        "}|".
        "m{".
            "1(".$this->parcours['m1']['result'].":".$this->parcours['m1']['times'].");".
            "2(".$this->parcours['m2']['result'].":".$this->parcours['m2']['times'].");".
            "3(".$this->parcours['m3']['result'].":".$this->parcours['m3']['times'].");".
            "4(".$this->parcours['m4']['result'].":".$this->parcours['m4']['times'].");".
        "}|".
        "d{".
            "1(".$this->parcours['d']['result'].":".$this->parcours['d']['times'].");".
        "}";
    }

    public function render()
    {
        return view('livewire.scolarite.student-parcours');
    }
}