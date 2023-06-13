<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\TypeMateriel;
use App\Models\Materiel;
use Chartisan\PHP\Chartisan;
use App\Charts\StatistiquesMaterielChart;

class EnregMatStatistiques extends Component
{

	public $typesMateriel;
	public $materiels;
	public $materiel_name;

	public $selectedTypeMateriel = null;
	public $selectedMateriel = null;
	public $selectedDebut = null;
	public $selectedFin = null;

	public function mount(){
		$this->typesMateriel = TypeMateriel::all();
		$this->materiels = collect();
	}

    public function render()
    {
        return view('livewire.enreg-mat-statistiques');
    }

    public function updatedSelectedTypeMateriel( $type ){
        if( $type=='null' ){
            $type = null;
            $this->reset('selectedTypeMateriel');
        }
    	if(!is_null($type)){
    		$this->materiels = Materiel::where('type_materiel_id', '=', $type)->get();
    	}
    }

    public function updatedSelectedMateriel( $materiel_id ){
        if( $materiel_id=='null' ){
            $materiel_id = null;
            $this->reset('selectedMateriel');
        }
    	if(!is_null($materiel_id)){
    		$this->materiel_name = Materiel::find($materiel_id)->name;
    	}
    }

}
