<?php

namespace App\Http\Livewire\Scolarite;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Filiere;
use App\Models\Promotion;
use App\Models\Etudiant;
use App\Models\Cycle;
use App\Models\Semestre;

use App\Exports\Etudiant\EtudiantListHeadExport;
use Maatwebsite\Excel\Facades\Excel;

class EtudiantIndex extends Component
{
    public $ine = '';
    public $cycles = null;
    public $semestres = null;
    public $filieres = null;
    public $promotions = null;
    public $promotionsSearch = null;
    public $etudiants = null;

    public $etudiantResultList = null;
    public $selectedCycle = null;
    public $selectedFiliere = null;
    public $selectedFiliereSearch = null;
    public $selectedPromotion = null;
    public $selectedPromotionSearch = null;

    public function mount(){

        $this->cycles = Cycle::all(); 
        $this->semestres = Semestre::all(); 
        $this->etudiantResultList = collect();
        $this->filieres = Filiere::orderBy('name')->get();
        $this->promotions = collect();
        $this->promotionsSearch = collect();
        $this->etudiants = collect();
    }

    public function downloadListHead(){
        return Excel::download(new EtudiantListHeadExport, "Liste d etudiants.xlsx");
    }

    public function updatedSelectedFiliere( $id ){
        if( strlen($id) > 0 ){
            $this->promotions = Promotion::orderBy('annee_entrer')->where('filiere_id', $id)->get();
        }else{
            $this->selectedFiliere = null;
        }
    }
    //Pour le champ de recherche
    public function updatedSelectedFiliereSearch( $id ){
        if( strlen($id) > 0 ){
            $this->promotionsSearch = Promotion::orderBy('annee_entrer')->where('filiere_id', $id)->get();
        }else{
            $this->selectedFiliere = null;
        }
    }

    public function updatedSelectedPromotion( $id ){
        if( strlen($id) <=0 ){
            $this->selectedPromotion = null;
        }
    }
    //Pour le champ de recherche
    public function updatedSelectedPromotionSearch( $id ){
        if( strlen($id) <=0 ){
            $this->selectedPromotionSearch = null;
        }
    }

    public function rechercher(){
        
        if( !is_null($this->selectedPromotionSearch) || strlen($this->ine)>0 ){
            $requete = Etudiant::select('*');
            if( !is_null($this->selectedPromotionSearch) ){
                $requete = $requete->where('promotion_id', $this->selectedPromotionSearch);
            }
            if( strlen($this->ine)>0 ){
                $requete = $requete->where('ine', 'ilike', $this->ine.'%');
            }
            $this->etudiants = $requete->get();
        }
    }

    public function render()
    {
        return view('livewire.scolarite.etudiant-index');
    }
}
