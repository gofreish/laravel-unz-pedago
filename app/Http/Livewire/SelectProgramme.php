<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SelectProgramme extends Component
{

	public $programmes;

	public $selectedProgramme = null;

    public function render()
    {
        return view('livewire.select-programme');
    }
}
