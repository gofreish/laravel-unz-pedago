<?php

/*
*   $salle
*/

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Batiment;
use App\Models\Salle;

class BatimentSalle extends Component
{

    public $batiments;
    public $salles;
    public $salle_choisie;

    public $selectedBatiment = null;
    public $selectedSalle = null;

    public function mount(){
        $this->batiments = Batiment::all();
        $this->salles = collect();
        $this->salle_choisie = collect();
    }

    public function render()
    {
        return view('livewire.batiment-salle');
    }

    public function updatedSelectedBatiment($batiments){
        if( $batiments=='null' ){
            $batiments = null;
            $this->reset('selectedBatiment');
        }
        if(!is_null($batiments)){
            $this->salles = Salle::where('batiment_id', $batiments)->get();
        }
    }

    public function updatedSelectedSalle($salles){
        if($salles=='null' ){
            $salles = null;
            $this->reset('selectedSalle');
        }
        if(!is_null($salles)){
            $salleid = Salle::find($salles);
            $this->salle_choisie = $salleid->id;
        }
    }
}
