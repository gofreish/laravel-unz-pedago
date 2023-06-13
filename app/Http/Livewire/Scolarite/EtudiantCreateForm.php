<?php

namespace App\Http\Livewire\Scolarite;

use Livewire\Component;
use App\Models\Filiere;
use App\Models\Promotion;
use App\Models\Cycle;
use App\Models\Semestre;
use Illuminate\Support\Facades\DB;

class EtudiantCreateForm extends Component
{

    public $filieres;
    public $promotions;
    public $cycles;
    public $semestres;
    public $messages;
    public $genre;
    public $ine;
    public $semestesNonVld = "";

    public $selectedFiliere;
    public $selectedPromotion;
    public $selectedSemestre;

    public function mount(){
        $this->messages = array();
        $this->genre = "masculin"; 
        $this->filieres = DB::table('filieres')->orderBy('name')->pluck('id','name');
        $this->promotions = collect();
        $this->cycles = Cycle::all();
        $this->semestres = Semestre::all();
    }

    public  function save(){
        $this->messages = array();
        if($this->genre === "masculin"){
            if( $this->ine[-1] != '1'){ //Si le dernier chiffre est 1 c est un masculin
                array_push($this->messages, "INE incohérent avec le genre");
            }
        }else{
            if( $this->ine[strlen($this->ine) - 1] != '2'){ //Si le dernier chiffre est 2 c est un feminin
                array_push($this->messages, "INE incohérent avec le genre");
            }
        }
        return true;
    }

    public function updatedSelectedSemestre( $semestre ){
        if( $semestre != ""){
            if( $this->semestesNonVld == "" ){
                $this->semestesNonVld = $semestre;
            }else{
                $this->semestesNonVld = $this->semestesNonVld.'|'.$semestre;
            }
        }
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
        return view('livewire.scolarite.etudiant-create-form');
    }
}
