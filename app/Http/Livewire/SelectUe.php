<?php

/*
* $ue
*/

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

use App\Models\Filiere;
use App\Models\Cycle;
use App\Models\UE;
use App\Models\Semestre;

class SelectUe extends Component
{
	public $filieres;
	public $cycles;
	public $semestres;
	public $UEs;
	public $UEchoisi;

	public $selectedFiliere;
	public $selectedCycle;
	public $selectedSemestre;
	public $selectedUE;

	public function mount(){
		//On récupère toutes les filières
		$this->filieres = Filiere::all();
		$this->cycles = collect();
		$this->semestres = collect();
		$this->UEs = collect();
	}

	public function render()
    {
        return view('livewire.select-ue');
    }

	//A chaque fois que $selectedFiliere est mis à jour cette fonction est exécutée avec sa valeur comme paramètre
	public function updatedSelectedFiliere($filiere){
        if( $filiere=='null' ){
            $filiere = null;
            $this->reset('selectedFiliere');
        }
		if( !is_null($filiere) ){
			//On récupère les id des cycles
			$cycles_id = DB::table('u_e_s')
			->where('filiere_id', $filiere)
			->pluck('cycle_id');
			//On récupère les cycles correspondants
			$this->cycles = Cycle::find($cycles_id);
		}
	}

	public function updatedSelectedCycle($cycle){
        if( $cycle=='null' ){
            $cycle = null;
            $this->reset('selectedCycle');
        }
		if( !is_null($cycle) ){
			$semestre_id = DB::table('u_e_s')
			->where('filiere_id', $this->selectedFiliere)
			->where('cycle_id', $cycle)
			->pluck('semestre_id');

			$this->semestres = Semestre::find($semestre_id);
		}
	}

	public function updatedSelectedSemestre($semestre){
        if( $semestre=='null' ){
            $semestre = null;
            $this->reset('selectedSemestre');
        }
		if( !is_null($semestre) ){
			//On récupère la liste des UE
			$UE_id = DB::table('u_e_s')
			->where('filiere_id', $this->selectedFiliere)
			->where('cycle_id', $this->selectedCycle)
			->where('semestre_id', $semestre)
			->pluck('id');

			$this->UEs = UE::find($UE_id);
		}
	}

	public function updateSelectedUE($ue_id){
        if( $ue_id=='null' ){
            $ue_id = null;
            $this->reset('selectedUE');
        }
		if( !is_null($ue_id) ){
			$this->UEchoisi = $ue_id;
		}
	}

}
