<?php

/*
*	$type_programme
*/

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\TypeProgramme;

class SelectTypeprogramme extends Component
{

	public $types;

	public $selectedType;

	public function mount(){
		$this->types = TypeProgramme::all();	
	}

    public function render()
    {
        return view('livewire.select-typeprogramme');
    }

}
