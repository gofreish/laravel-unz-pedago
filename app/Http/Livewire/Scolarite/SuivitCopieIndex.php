<?php

namespace App\Http\Livewire\Scolarite;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Filiere;
use App\Models\Promotion;
use App\Models\Cycle;
use App\Models\Semestre;
use App\Models\StudentGroup;


//########## OLD
use App\Models\UE;
use App\Models\ECU;
use App\Models\Programme;
use App\Models\TypeProgramme;
use App\Models\User;
use App\Models\Copie;
use Illuminate\Support\Facades\Storage;

class SuivitCopieIndex extends Component
{
    public $filieres;
    public $promotions;
    public $cycles;
    public $semestres;
    public $statuCopie = 0;
    public $copiesData;
    
    public $selectedFiliere = null;
    public $selectedPromotion = null;
    public $selectedCycle = null;
    public $selectedSemestre = null;
    //################# OLD
   
    public $ecus;
    public $copies = array();

    
    public $selectedECU = null;

    public function mount(){
        $this->filieres = Filiere::all();
        $this->promotions = collect();
        $this->copiesData = [];
        $this->cycles = Cycle::all();
        $this->semestres = Semestre::all();

    }

    public function updatedSelectedFiliere( $filiere ){
        if( $filiere == ''){
            $this->reset('selectedFiliere');
            $filiere = null;
        }
        if( !is_null($filiere) ){ 
            $this->promotions = Promotion::where('filiere_id', $filiere)->orderBy('annee_entrer')->get();
        }
    }

    public function updatedSelectedPromotion( $promotion ){
        if( $promotion = ''){
            $this->reset('selectedPromotion');
            $promotion = null;
        }
    }
    
    public function updatedSelectedCycle( $cycle ){
        if( $cycle = ''){
            $this->reset('selectedCycle');
            $cycle = null;
        }
    }
    public function updatedSelectedSemestre( $semestre ){
        if( $semestre = ''){
            $this->reset('selectedSemestre');
            $semestre = null;
        }
    }

    public function rechercher(){
        if( !is_null($this->selectedPromotion) && !is_null($this->selectedCycle) && !is_null($this->selectedSemestre) && !is_null($this->statuCopie) ){
            $informations = 
            
            $ues_id = UE::where('filiere_id', $this->selectedFiliere)
                ->where('cycle_id', $this->selectedCycle)
                ->where('semestre_id', $this->selectedSemestre)
                ->pluck('id');
            $ecus_id = ECU::whereIn('u_e_id', $ues_id)->pluck('id');

            $typeDevoir = TypeProgramme::where('type', "EXAMEN")->pluck('id');

            $informations = DB::table("programmes")
                ->where("programmes.type_programme_id", $typeDevoir)
                ->where("programmes.promotion_id", $this->selectedPromotion)
                ->whereIn("programmes.e_c_u_id", $ecus_id)
                ->where('programmes.dateDebut', '<=', today())
                ->join("copies", "copies.programme_id", "programmes.id")
                ->where("copies.is_composer", true);

                switch ($this->statuCopie) {
                    case 0:
                        $informations = $informations->whereNull('copies.date_sortie')->whereNull('copies.date_retour');
                        break;
                    case 1:
                        $informations = $informations->whereNotNull('copies.date_sortie')->whereNull('copies.date_retour');
                        break;
                    case 2:
                        $informations = $informations->whereNotNull('copies.date_retour');
                        break;
                    case 3:
                        $informations = $informations->where('copies.has_note', true);
                        break;
                }

                $informations = $informations->join("e_c_u_s", "e_c_u_s.id", "programmes.e_c_u_id")
                ->join('users', 'users.id', 'programmes.enseignant_id')
                ->join('users as U', 'U.id', 'copies.agent_id')
                ->select(
                    'programmes.id as id',
                    'e_c_u_s.nom as nomECU',
                    'programmes.dateDebut as date',
                    'users.name as nomEnseignant',
                    'users.prenom as prenomEnseignant',
                    "copies.id as copie_id",
                    "copies.agent_id as copie_agent_id",
                    "U.name as nomAgent",
                    "U.prenom as prenomAgent",
                    "copies.date_sortie as date_sortie",
                    "copies.auteur_sortie as auteur_sortie",
                    "copies.date_retour as date_retour"
                )->get();
            $this->copiesData = [];
            foreach ($informations as $key => $info) {
                $nbrCopies = StudentGroup::selectRaw('sum(nbr_copie) as nbr_copie')
                            ->groupBy('copie_id')
                            ->having('copie_id', '=', $info->copie_id)
                            ->pluck('nbr_copie')
                            ->first();
                $copieInfo = (array)$info;
                $copieInfo['nbr_copie'] = $nbrCopies;
                array_push($this->copiesData, $copieInfo);
            }
        }
    }

    public function sortirCopie( $id ){
        $copie = Copie::find($this->copiesData[$id]['copie_id']);
        $copie->auteur_sortie = $this->copiesData[$id]['auteur_sortie'];
        $copie->date_sortie = today();
        $copie->save();
        $this->copiesData[$id]['date_sortie'] = today();
    }
    
    public function retourCopie( $id ){
        $copie = Copie::find($this->copiesData[$id]['copie_id']);
        $copie->date_retour = today();
        $copie->save();
        $this->copiesData[$id]['date_retour'] = today();
    }

    //###################### OLD CODE

    public function updatedSelectedECU( $ecu ){
        
        if( $ecu == null ){
            $this->reset('selectedECU');
            $ecu = null;
        }
        if( !is_null($ecu) ){
            $this->copies = array();
            $typeDevoir = TypeProgramme::where('type', "EXAMEN")->pluck('id');
            $programmes = DB::table("programmes")
                ->where("programmes.e_c_u_id", $ecu)
                //->where('programmes.dateDebut', '<=', today())
                ->join("copies", "copies.programme_id", "programmes.id")
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
                    "e_c_u_s.nom as nomECU",
                    "copies.id as copie_id",
                    "copies.nombre as copie_nombre",
                    "copies.personne as copie_perso",
                    "copies.agent_id as copie_agent_id",
                    "copies.date_sortie as date_sortie",
                    "copies.date_retour as date_retour"
                )->get();
            foreach ($programmes->all() as $cle => $valeur) {
                $tab = (array)$valeur;
                $user = User::find($tab["copie_agent_id"]);
                $tab["agent"] = $user->prenom." ".$user->name;
                $tab['is_sortie'] = !is_null($tab['date_sortie']);
                $tab['is_retour'] = !is_null($tab['date_retour']);
                array_push($this->copies, $tab);
            }
            //dd($this->copies);
        }
    }

    



    public function render()
    {
        return view('livewire.scolarite.suivit-copie-index');
    }
}
