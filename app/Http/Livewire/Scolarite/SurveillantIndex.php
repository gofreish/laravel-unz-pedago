<?php

namespace App\Http\Livewire\Scolarite;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Surveillant;
use App\Exports\Surveillant\SurveillantListHeadExport;
use Maatwebsite\Excel\Facades\Excel;

class SurveillantIndex extends Component
{

    
    public  $filtre = 'nom';
    public  $ordre = 'asc';
    public $page = 1;
    public $size = 20;
    public $nbrPage = 0;

    public $surveillantListe = null;

    public function mount(){
        $this->nbrPage = ceil(Surveillant::all()->count() / $this->size);
        $this->surveillantListe = DB::table('surveillants')->orderBy($this->filtre, $this->ordre)->offset(($this->page-1)*$this->size)->limit($this->size)->get();
    }

    public function downloadListHead(){
        return Excel::download(new SurveillantListHeadExport, "Liste de surveillants.xlsx");
    }

    public function updatedOrdre($ordre){
        $this->page = 1;
        $this->surveillantListe = DB::table('surveillants')->orderBy($this->filtre, $this->ordre)->offset(($this->page-1)*$this->size)->limit($this->size)->get();
    }

    public function updatedFiltre($filtre){
        $this->page = 1;
        $this->surveillantListe = DB::table('surveillants')->orderBy($filtre, $this->ordre)->offset(($this->page-1)*$this->size)->limit($this->size)->get();
    }

    public function changePage($page){
        $this->page = $page;
        $this->surveillantListe = DB::table('surveillants')->orderBy($this->filtre, $this->ordre)->offset(($this->page-1)*$this->size)->limit($this->size)->get();
    }

    public function render()
    {
        return view('livewire.scolarite.surveillant-index');
    }
}
