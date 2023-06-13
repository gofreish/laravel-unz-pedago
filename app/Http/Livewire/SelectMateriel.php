<?php

/* La variable résultante est:
* 	$materiel
*/

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Materiel;
use App\Models\TypeMateriel;

class SelectMateriel extends Component
{

	public $typeMateriels;
	public $materiels;

	public $selectedtypeMateriel = null;
	public $selectedMateriel = null;

	public function mount(){
		$this->typeMateriels = TypeMateriel::all();
		$this->materiels = collect();
	}

    public function render()
    {
        return view('livewire.select-materiel');
    }

    public function updatedSelectedtypeMateriel($type){
        if( $type=='null' ){
            $type = null;
            $this->reset('selectedtypeMateriel');
        }
    	if( !is_null($type) ){
    		$this->materiels = Materiel::where('type_materiel_id', $type)->get();
    	}
    }
}
