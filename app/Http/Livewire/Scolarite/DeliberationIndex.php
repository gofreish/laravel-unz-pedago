<?php

namespace App\Http\Livewire\Scolarite;

use Livewire\Component;
use App\Models\Filiere;
use App\Models\Promotion;
use App\Models\Cycle;
use App\Models\Semestre;
use App\Models\Etudiant;
use App\Models\Deliberation;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use RealRashid\SweetAlert\Facades\Alert;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Imports\Deliberation\DeliberationImport;
use App\Imports\Deliberation\DeliberationUpdateImport;
use App\Exports\Deliberation\DeliberationHeadExport;
use App\Exports\Deliberation\DeliberationExport;
use Maatwebsite\Excel\Facades\Excel;

class DeliberationIndex extends Component
{

    public $delibPathFolder;
    public $delibFileName;

    use WithFileUploads;
    use LivewireAlert;
    protected $listeners = [
        'accepter'
    ];

    public $filieres;
    public $promotions;
    public $promotionsForModel;
    public $cycles;
    public $semestres;
    public $delibFound = false;
    public $delibFouded;
    public $delibFile;
    public $delibImportSuccess = false;

    public $selectedSession = "1";
    public $selectedSemestre;
    public $selectedCycle;
    public $selectedPromotion;
    public $selectedFiliere;
    public $selectedFiliereForUpload;
    public $selectedFiliereForModel = null;
    public $selectedCycleForModel = null;
    public $selectedSemestreForModel = null;

    public function mount(){
        $this->filieres = Filiere::all();
        $this->promotions = collect();
        $this->promotionsForModel = collect();
        $this->cycles = Cycle::all();
        $this->semestres = Semestre::all();
    }

    //Pour telecharger le model de PV pour l<importation
    public function downloadPVHead(){
        if( !is_null($this->selectedFiliereForModel)|| !is_null($this->selectedCycleForModel)|| !is_null($this->selectedSemestreForModel)){
            $filiere = Filiere::find($this->selectedFiliereForModel);
            $cycle = Cycle::find($this->selectedCycleForModel);
            $semestre = Semestre::find($this->selectedSemestreForModel);
            $fileName = "PV de deliberation ".$filiere->name." ".$cycle->cycle." ".$semestre->intitule;
            return Excel::download(new DeliberationHeadExport($this->selectedFiliereForModel, $this->selectedCycleForModel, $this->selectedSemestreForModel), $fileName.".xlsx");
        }
    }
    public function updatedSelectedFiliereForUpload($id){
        if( strlen($id) <= 0 ){
            $this->selectedFiliereForUpload = null;
        }else{
            $this->promotionsForModel = Promotion::where('filiere_id', $id)->get();
        }
    }
    public function updatedSelectedFiliereForModel($id){
        if( strlen($id) <= 0 ){
            $this->selectedFiliereForModel = null;
        }
    }
    public function updatedSelectedCycleForModel($id){
        if( strlen($id) <= 0 ){
            $this->selectedCycleForModel = null;
        }
    }
    public function updatedSelectedSemestreForModel($id){
        if( strlen($id) <= 0 ){
            $this->selectedSemestreForModel = null;
        }
    }

    public function rechercher(){
        $this->delibFound = false;
        if ( 
            !is_null($this->selectedSession) &&
            !is_null($this->selectedSemestre) &&
            !is_null($this->selectedCycle) &&
            !is_null($this->selectedPromotion)
        ) {
            $delib = Deliberation::where('promotion_id', $this->selectedPromotion)
                ->where('cycle_id', $this->selectedCycle)
                ->where('semestre_id', $this->selectedSemestre)
                ->where('is_normal', (boolean)$this->selectedSession)
                ->where('is_ready', true)
                ->first();
            if( !is_null($delib) ){//Si une deliberation existe on a :
                $this->delibFouded = $delib;
                $this->delibFound = true;
            }
        }
    }

    public function downloadDeliberation(){
        $delib = Deliberation::where('promotion_id', $this->selectedPromotion)
                ->where('cycle_id', $this->selectedCycle)
                ->where('semestre_id', $this->selectedSemestre)
                ->where('is_normal', (boolean)$this->selectedSession)
                ->where('is_ready', true)
                ->first();
        $filiere_name = Filiere::find($this->selectedFiliere)->name;
        $cycle_name = Cycle::find($this->selectedCycle)->cycle;
        $semestre_name = Semestre::find($this->selectedSemestre)->intitule;
        $promotion_name = Promotion::find($this->selectedPromotion)->annee_entrer;
        return Excel::download(new DeliberationExport($delib->id), "Deliberation P".$promotion_name.' '.$filiere_name.'('.$cycle_name.' '.$semestre_name.').xlsx');
    }

    //############################ OLD
    public function accepter(){
        $semestre = Semestre::find($this->selectedSemestre);
        $promotion = Promotion::find($this->selectedPromotion);
        //On traite les etudiants pour se conformer a cette deliberation
        Excel::import(new DeliberationImport($semestre->intitule), $this->delibPathFolder.$this->delibFileName);
        storage::disk('local')->put($this->delibPathFolder."public(".$promotion->annee_entrer.").txt", "public = true");
    }

    public function confirmDelib(){
        $this->confirm(
            "Par ce geste confirmez vous que le PV de délibération convient et qu'il sera rendu public", [
            'position' => 'center',
            'showConfirmButton' => true,
            'confirmButtonText' => 'Accepter',
            'onConfirmed' => 'accepter'
        ]);
    }

    public function updatedSelectedFiliere( $filiere_id ){
        $this->promotions = collect();
        if( $filiere_id == "" ){
            $filiere_id = null;
            $this->reset("selectedFiliere");
        }
        if( !is_null($filiere_id) ){
            $this->promotions = Promotion::where('filiere_id', $filiere_id)->get();
        }
    }

    public function updatedSelectedSession( $selected ){
        if( $selected == "" ){
            $selected = null;
            $this->reset('selectedSession');
        }
    }
    public function updatedSelectedSemestre( $selected ){
        if( $selected == "" ){
            $selected = null;
            $this->reset('selectedSemestre');
        }
    }
    public function updatedSelectedCycle( $selected ){
        if( $selected == "" ){
            $selected = null;
            $this->reset('selectedCycle');
        }
    }
    public function updatedSelectedPromotion( $selected ){
        if( $selected == "" ){
            $selected = null;
            $this->reset('selectedPromotion');
        }
    }

    public function render()
    {
        return view('livewire.scolarite.deliberation-index');
    }
}
