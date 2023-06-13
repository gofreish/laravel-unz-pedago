<?php

/*
*   $type_enregistrement 
*/

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\TypeEnreg;

class SelectTypeenreg extends Component
{

	public $types;

	public $selectedType;

	public function mount(){
		$this->types = TypeEnreg::all();		
	}

    public function render()
    {
        return view('livewire.select-typeenreg');
    }
}
