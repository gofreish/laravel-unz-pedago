<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\TypeMateriel;
use App\Models\Materiel;


class MaterielIndex extends Component
{

	public $typesMateriel;
	public $materiels;
	public $type_name = null;

	public $selectedTypeMateriel = null;

	public function mount(){
		$this->typesMateriel = TypeMateriel::all();
	}

    public function render()
    {
        return view('livewire.materiel-index');
    }

    public function updatedSelectedTypeMateriel($type){
        if( $type=='null' ){
            $type = null;
            $this->reset('selectedTypeMateriel');
        }
    	if(!is_null($type)){
    		$this->selectedTypeMateriel = $type;
    		$this->materiels = Materiel::where('type_materiel_id', '=', $type)->get();

    		$this->type_name = TypeMateriel::find($type)->type;
    		//dd($this->materiels);
    	}
    }
}
