<?php

namespace App\Http\Livewire\Scolarite;

use Livewire\Component;
use App\Models\Filiere;
use App\Models\Cycle;
use App\Models\Semestre;
use App\Models\UE;
use App\Models\ECU;
use App\Models\Programme;
use App\Models\Copie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class EvaluationIndex extends Component
{
    public $devoirs; //['programme_id' => ,'nom_ecu' => ,'ecu_id' => ,'date' => ,'promotion' => ,'ensei_id' => ,'ensei_nom' => nom.prenom,'is_public' => ,'is_prepare' => ]

    public $selectedFiliere;
    public $selectedCycle;
    public $selectedSemestre;
    //##################
    public $filieres;
    public $cycles;
    public $semestres;
    public $ues;
    public $ecus;

    public $selectedUE;
    public $selectedECU;

    public function mount(){
        $this->filieres = Filiere::all();
        $this->cycles = Cycle::all();
        $this->semestres = Semestre::all();
        $this->ues = collect();
        $this->ecus = collect();
        $this->devoirs = array();
    }

    public function updatedSelectedFiliere( $filiere ){
        if( $filiere = "" ){
            $this->reset('selectedFiliere');
        }   
    }

    public function updatedSelectedCycle( $cycle ){
        if( $cycle = "" ){
            $this->reset('selectedCycle');
        }
    }

    public function updatedSelectedSemestre( $semestre ){
        if( $semestre = "" ){
            $this->reset('selectedSemestre');
        }
    }

    public function rechercherEvaluation(){
        if( !is_null($this->selectedFiliere) && !is_null($this->selectedCycle) && !is_null($this->selectedSemestre) ){
            $this->devoirs = array();
            $ue_id = UE::where('filiere_id', $this->selectedFiliere)
                ->where('cycle_id', $this->selectedCycle)
                ->where('semestre_id', $this->selectedSemestre)
                ->pluck('id');
            $this->ecus = ECU::whereIn('u_e_id', $ue_id)->pluck('id');
            
            $programmes = DB::table('programmes')
                ->where('programmes.dateDebut', '>=', today())
                ->whereIn('programmes.e_c_u_id', $this->ecus)
                ->join('e_c_u_s', 'e_c_u_s.id', '=', 'programmes.e_c_u_id')
                ->join('promotions', 'promotions.id', '=', 'programmes.promotion_id')
                ->join('users', 'users.id', '=', 'programmes.enseignant_id')
                ->orderBy('programmes.dateDebut', 'asc')
                ->select(
                    'programmes.id as id',
                    'e_c_u_s.nom as nomECU',
                    'programmes.dateDebut as date',
                    'promotions.annee_entrer as promotion',
                    'users.name as nomEnseignant',
                    'users.prenom as prenomEnseignant',
                    'programmes.public as isPublier'
                )
                ->get();
                foreach ($programmes as $key => $programme) {
                    $copie = Copie::where('programme_id', $programme->id)->first();
                    $is_prepare = false;
                    $is_composer = false;
                    //Si ca ete preparer
                    if( !is_null($copie) ){
                        $is_prepare = true;
                        $is_composer = $copie->is_composer;
                    }
                    $evaluation = [
                        'programme_id' => $programme->id,
                        'nom_ecu' => $programme->nomECU,
                        'date' => $programme->date,
                        'promotion' => $programme->promotion,
                        'enseignant' => $programme->prenomEnseignant." ".$programme->nomEnseignant,
                        'is_public' => $programme->isPublier,
                        'is_prepare' => $is_prepare,
                        'is_composer' => $is_composer
                    ]; 
                    array_push($this->devoirs, $evaluation);
                }
        }
    }

    public function render()
    {
        return view('livewire.scolarite.evaluation-index');
    }
}
