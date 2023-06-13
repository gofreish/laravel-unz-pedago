<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Filiere;
use App\Models\Promotion;

class SelectPromotion extends Component
{
	public $filieres;
	public $promotions;

	public $selectedFiliere = null;
	public $selectedPromotion = null;

	public function mount(){
		$this->filieres =  Filiere::all();
		$this->promotions = collect();
	}

    public function render()
    {
        return view('livewire.select-promotion');
    }

    public function updatedSelectedFiliere( $filiere ){
        if( $filiere=='null' ){
            $filiere = null;
            $this->reset('selectedFiliere');
        }
    	//On récupère les promotion de la filiere
    	if( !is_null($filiere) ){
    		$this->promotions = Promotion::where('filiere_id', $filiere)->get();
    	}
    }
}
