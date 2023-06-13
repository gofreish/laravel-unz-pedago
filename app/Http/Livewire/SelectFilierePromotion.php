<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Filiere;
use App\Models\Promotion;

class SelectFilierePromotion extends Component
{

    public $filieres;
    public $promotions;

    public $selectedFiliere;
    public $selectedPromotion;

    public function mount(){
        $this->filieres = DB::table('filieres')->orderBy('name')->pluck('id','name');
        $this->promotions = collect();
    }

    public function updatedSelectedFiliere( $filieres ){
        if( $filieres=='null' ){
            $filieres = null;
            $this->reset('selectedFiliere');
        }
    	if( !is_null($filieres) ){
    		$this->selectedFiliereName = Filiere::find($filieres);
    		$this->promotions = Promotion::where('filiere_id', $filieres )
    			->get();
    	}
    }

    public function render()
    {
        return view('livewire.select-filiere-promotion');
    }
}
