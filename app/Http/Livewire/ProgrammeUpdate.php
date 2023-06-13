<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Programme;
use App\Models\TypeProgramme;
use App\Models\ECU;
use App\Models\UE;
use App\Models\Cycle;
use App\Models\Semestre;
use App\Models\Salle;
use App\Models\Promotion;
use App\Models\Filiere;
use App\Models\User;
use App\Models\Titre;
use App\Models\Batiment;
use App\Services\RecuperationProgramme;

class ProgrammeUpdate extends Component
{

	public $ID;
    public $isActiveHeure;
	private $programme;

    public $filieres;
    public $cycles;
    public $semestres;
    public $UEs;
    public $ECUs;
    public $enseignants=[];
    public $promotions;
	public $types;
    public $batiments;
    public $salles;

    public $selectedFiliere = "";
    public $selectedCycle = "";
    public $selectedSemestre = "";
    public $selectedUE = "";
    public $selectedECU = "";
    public $selectedPromotion = null;
	public $selectedType = null;
	public $selectedTypeId = null;
    public $selectedBatiment = null;
    public $selectedSalle = null;

	public $donnees;

    public function __construct( $ID ){
        $this->ID = $ID;
    }

	public function mount(){
        $this->donnees = RecuperationProgramme::recuperation($this->ID);

        //Activé par défaut
        $this->isActive = "";

        //On récupère les types de programme et celui présélectionnée
        $this->types = TypeProgramme::all();
        //$this->selectedType =$this->donnees['type_programme_nom'] ;

        $this->batiments = Batiment::all();

        $this->filieres = Filiere::all();

        $this->salles = collect();
        $this->cycles = collect();
        $this->semestres = collect();
        $this->UEs = collect();
        $this->ECUs = collect();
        $this->ECUchoisi = collect();
        $this->promotions = collect();

	}

    public function render()
    {
        return view('livewire.programme-update');
    }

    public function Désactivation(){
        $roles = Auth::user()->getRoleNames();
    }

    public function updatedSelectedType( $type ){

    	if( !is_null($type) ){
    		$this->selectedTypeId = TypeProgramme::where('type', $type)
    			->first()
    			->id;

            if( Auth::user()->getRoleNames()->contains('coordonateur') and $type=="EXAMEN"){
                $this->isActiveHeure = "disabled";
            }else{
                $this->isActiveHeure = "";
            }

        }

    }

    //A chaque fois que $selectedFiliere est mis à jour cette fonction est exécutée avec sa valeur comme paramètre Arr::exists(Auth::user()->getRoleNames(), 'coordonateur') in_array('coordonateur', Auth::user()->getRoleNames())
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
            //On récûpère la liste des promotion
            $this->promotions = Promotion::where('filiere_id', $filiere)->get();
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
            $this->ECUs = ECU::where('u_e_id', $ue_id)
                                ->get();
        }
    }

    public function updatedSelectedECU( $ecu ){
        $enseignant_id = DB::table('roles')->where('name', 'enseignant')->pluck('id');
        if( !is_null( $enseignant_id ) ){
            $enseignant_user = DB::table('model_has_roles')
            ->where('model_type', 'App\Models\User')
            ->where('role_id', $enseignant_id)
            ->get()->pluck("model_id");
            //DB::table('users')
            $this->enseignants = User::whereIn('id', $enseignant_user)->orderBy('name', 'asc')->get();
            //dd($this->enseignants);
        }
    }

    public function updatedSelectedBatiment($batiments){

        if(!is_null($batiments)){
            $this->salles = Salle::where('batiment_id', $batiments)->get();
        }
    }
}
