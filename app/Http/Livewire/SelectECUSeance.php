<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

use App\Models\Filiere;
use App\Models\Cycle;
use App\Models\UE;
use App\Models\Semestre;
use App\Models\ECU;
use App\Models\User;

class SelectECUSeance extends Component
{

    public $filieres;
	public $cycles;
	public $semestres;
	public $UEs;
	public $ECUs;
	public $enseignant;
	public $ECUchoisi;

	public $selectedFiliere = null;
    public $selectedCycle = null;
    public $selectedSemestre = null;
    public $selectedUE = null;
    public $selectedECU = null;

	public function mount(){
		//On récupère toutes les filières
		$this->filieres = Filiere::all();
		$this->cycles = collect();
		$this->semestres = collect();
		$this->UEs = collect();
		$this->ECUs = collect();
		$this->ECUchoisi = collect();
	}

    public function render()
    {
        return view('livewire.select-e-c-u-seance');
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

	public function updatedSelectedUE($ue_id){
        if( $ue_id=='null' ){
            $ue_id = null;
            $this->reset('selectedUE');
        }
		if( !is_null($ue_id) ){
			//On récupère la liste des ecu
			$ECU_id = DB::table('e_c_u_s')
								->join('programmes','e_c_u_s.id','=','programmes.e_c_u_id')
								->where('programmes.dateFin', '>=', today())
								->where('programmes.dateDebut', '<=', today())
								->where('e_c_u_s.u_e_id', $ue_id)
								->pluck('e_c_u_s.id');

			$this->ECUs = ECU::find($ECU_id);

		}
		//dd($this->ECUs);
	}

    //
    public function updatedSelectedECU($ecu){
        if( $ecu=='null' ){
            $ecu = null;
            $this->reset('selectedECU');
        }
    	if( !is_null($ecu) ){
			$enseignant_id=DB::table('e_c_u_s')
						->where('e_c_u_id',$ecu)
                        ->join('programmes','e_c_u_s.id','=','programmes.e_c_u_id')
                        ->pluck('programmes.enseignant_id')->first();
			$this->enseignant= User::find($enseignant_id);
    		$this->ECUchoisi = $ecu;
    	}
    }

}
