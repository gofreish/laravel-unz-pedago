<?php

namespace App\Http\Livewire\Scolarite;

use Livewire\Component;
use App\Models\Filiere;
use App\Models\Cycle;
use App\Models\Semestre;
use App\Models\UE;
use App\Models\ECU;
use App\Models\Programme;
use App\Models\TypeProgramme;
use App\Models\Copie;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class CopiesIndex extends Component
{
    public $filieres;
    public $cycles;
    public $semestres;
    public $ecus;
    public $devoirs = array();

    public $selectedFiliere = null;
    public $selectedCycle = null;
    public $selectedSemestre = null;
    public $selectedECU = null;

    public function mount(){
        $this->filieres = Filiere::all();
        $this->cycles = Cycle::all();
        $this->semestres = Semestre::all();
        $this->ecus = collect();
    }

    private function rechercher(){
        if( !is_null($this->selectedFiliere) && !is_null($this->selectedCycle) && !is_null($this->selectedSemestre) ){
            $ue_id = UE::where('filiere_id', $this->selectedFiliere)
                ->where('cycle_id', $this->selectedCycle)
                ->where('semestre_id', $this->selectedSemestre)
                ->pluck('id');
            $this->ecus = ECU::whereIn('u_e_id', $ue_id)->get();
        }
    }

    public function updatedSelectedFiliere( $filiere ){
        $this->rechercher();
    }
    public function updatedSelectedCycle( $cycle ){
        $this->rechercher();
    }
    public function updatedSelectedSemestre( $semestre ){
        $this->rechercher();
    }

    public function updatedSelectedECU( $ecu ){
        
        if( $ecu == null ){
            $this->reset('selectedECU');
            $ecu = null;
        }
        if( !is_null($ecu) ){
            $this->devoirs = array();
            $typeDevoir = TypeProgramme::where('type', "EXAMEN")->pluck('id');
            $programmes = DB::table("programmes")
                ->where("programmes.e_c_u_id", $ecu)
                ->where('programmes.dateDebut', '>=', today())
                ->join("e_c_u_s", "e_c_u_s.id", "programmes.e_c_u_id")
                ->join("promotions", "promotions.id", "programmes.promotion_id")
                ->join('users', 'users.id', 'programmes.enseignant_id')
                ->select(
                    'programmes.id as id',
                    'e_c_u_s.nom as nomECU',
                    'programmes.dateDebut as date',
                    'promotions.annee_entrer as promotion',
                    'users.name as nomEnseignant',
                    'users.prenom as prenomEnseignant',
                )
                ->get();
                
            $programmes = $programmes->reject(
                function($value, $key){ 
                    return count(Copie::where('programme_id', $value->id)->get()) > 0;
                }
            );

            $filiere = Filiere::where('id', $this->selectedFiliere)->pluck('name')[0];
            //dd($filiere);
            $cycle = Cycle::where('id', $this->selectedCycle)->pluck('cycle')[0];
            $semestre = Semestre::where('id', $this->selectedSemestre)->pluck('intitule')[0];
            $nomECU = ECU::where('id', $this->selectedECU)->pluck("nom")[0];

            $chemin = 'root/exports/evaluation/'.
                        $filiere.'/'.
                        $cycle.'/'.
                        $semestre.'/'.
                        $nomECU.'/';

            foreach ($programmes as $key => $programme) {
                /*Les clés suplementaires sont : 
                    hasDirectory = boolean
                    isFinish = boolean
                */
                $tab = (array)$programme;
                $tab['hasDirectory'] = false;
                $tab['isFinish'] = false;

                //Si on le repertoire du devoir existe
                if( Storage::disk('local')->exists($chemin.$programme->date) ){
                    $tab['hasDirectory'] = true;    //On idique que le repertoire existe deja
                    
                    //Si il a fini de preparer le devoir
                    if( Storage::disk('local')->exists($chemin.$programme->date.'/finish.txt')){
                        $tab['isFinish'] = true;
                    }
                }
                array_push($this->devoirs, $tab);
            }
            //dd($this->devoirs);
        }
    }

    public function render()
    {
        return view('livewire.scolarite.copies-index');
    }
}
