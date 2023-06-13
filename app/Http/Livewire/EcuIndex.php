<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Cycle;
use App\Models\Filiere;
use App\Models\Semestre;
use App\Models\UE;
use App\Models\ECU;

class EcuIndex extends Component
{
	public $filieres;
	public $selectedFiliereName;
	public $cycles;
	public $semestres;
	public $selectedSemestreName;
    public $html;
    public $contain = false;
    public $pdfName;

	public $selectedFiliere = null;
	public $selectedCycle = null;
	public $selectedSemestre = null;

	public $tableau = null;

	private function remplissage(){
		//On récupère la liste des UE
        $UEs = DB::table('u_e_s')
        ->where('filiere_id', $this->selectedFiliere)
        ->where('cycle_id', $this->selectedCycle)
        ->where('semestre_id', $this->selectedSemestre)
        ->get();

		$tabUE = [];
		//Pour chaque UE
		foreach ($UEs as $cle => $UE) {
			$UEelement = [];
			$UEelement['nom'] = $UE->nom;
			$UEelement['credit'] = $UE->credit;
			$UEelement['VH'] = 20 * $UE->credit;

			//On récupère la liste des ECU
			$ECUs = ECU::where('u_e_id', $UE->id)->get();
			$tabECUs = [];
            //Pour chaque ECU
            foreach ($ECUs as $key => $ECU) {
            	$ecu = [];
            	$ecu['id'] = $ECU->id;
            	$ecu['code'] = $ECU->code;
            	$ecu['nom'] = $ECU->nom;
            	$ecu['coefficient'] = $ECU->coefficient;
            	$ecu['VHF'] = 12 * $ECU->coefficient;
            	$ecu['VHA'] = 8 * $ECU->coefficient;
            	array_push($tabECUs, $ecu);
            }
            $UEelement['ec'] = $tabECUs;
            array_push($tabUE, $UEelement);
		}
		return $tabUE;
	}

	public function mount(){
		$this->filieres = DB::table('filieres')->orderBy('name')->pluck('id','name');
		$this->cycles = collect();
		$this->semestres = collect();
	}

    public function render()
    {
        return view('livewire.ecu-index');
    }

    public function updatedSelectedFiliere( $filiere ){
    	if( $filiere=='null' ){
            $filiere = null;
            $this->reset('selectedFiliere');
        }
        if( !is_null($filiere) ){
    		$this->selectedFiliereName = Filiere::find($filiere);
    		$this->selectedFiliereName = $this->selectedFiliereName->name;

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
        if( !is_null($semestre) ){
        	$this->selectedSemestreName = Semestre::find($semestre);
        	$this->selectedSemestreName = $this->selectedSemestreName->intitule;
        	$this->tableau = $this->remplissage();
            if( count($this->tableau) > 0 ){
                $this->contain = true;
                $this->html = (string)view('unz_st.ecu.ECUPDF',[
                    'tableau' => $this->tableau,
                    'SemestreName' => $this->selectedSemestreName,
                    'FiliereName' => $this->selectedFiliereName
                ])->render();
                $this->pdfName = $this->selectedFiliereName.' '.$this->selectedSemestreName.' UE et ECU';
            }
        }
    }


}
