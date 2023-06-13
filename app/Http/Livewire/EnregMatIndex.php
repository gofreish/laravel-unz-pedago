<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class EnregMatIndex extends Component
{
	protected $listeners = ['afficher' => 'Afficher',
							'page' => 'Page'
							];

	public $perPage = 50;
	public $numberOfPage;
	public $pageNumero = 1;
	public $pages = null;
	public $debut = null;
	public $fin = null;
	public $enregistrements = null;
	public $achever = null;

	//Son role est de recupérer les données en fonction des dates de début et de fin
    private function getData(){
        //Si la date de début existe
        if( !is_null($this->debut) ){
            //Si la date de fin existe
            if (!is_null($this->fin)) {
                $this->pages = DB::table('enreg_mats')
                    ->whereBetween('enreg_mats.date', [$this->debut, $this->fin] );
            }
            //Si la date de fin n existe pas
            else{
                $this->pages = DB::table('enreg_mats')
                    ->where('enreg_mats.date', '>=', $this->debut);
            }
        }
        //Si la date de debut n existe pas
        else{
            //Si la date de fin existe
            if (!is_null($this->fin)) {
                $this->pages = DB::table('enreg_mats')
                    ->where('enreg_mats.date', '<=', $this->fin);
            }
            //Si la date de fin n existe pas
            else{
                $this->pages = DB::table('enreg_mats');
            }
        }

        if( !is_null($this->achever) && $this->achever != 'tous' ){
            $this->pages = $this->pages->where('enreg_mats.achever', '=', $this->achever);
        }

        $this->pages = $this->pages->orderBy('enreg_mats.date', 'asc')
        ->join('type_enregs', 'type_enregs.id', 'enreg_mats.type_enreg_id')
        ->join('materiels', 'materiels.id', 'enreg_mats.materiel_id')
        ->join('users', 'users.id', 'enreg_mats.user_id')
        ->join('titres', 'titres.id', 'users.titre_id')
        ->select('enreg_mats.date',
                 'enreg_mats.quantite',
                 'enreg_mats.quantite_avant_enreg',
                 'enreg_mats.achever',
                 'type_enregs.id as typeEnregId',
                 'type_enregs.type',
                 'materiels.name as materiel',
                 'users.name',
                 'users.prenom',
                 'titres.titre',
        )
        ->get();
        $this->pages = $this->pages->chunk( $this->perPage )->all();
    }

    public function render()
    {
        return view('livewire.enreg-mat-index');
    }

    public function Afficher(){
    	$this->getData();
    	$this->numberOfPage = count($this->pages);
        if( count($this->pages) > 0 )
    	$this->enregistrements = $this->pages[0];
    }

    public function Page( $page ){
    	if ( !is_null($page) ) {
    		$this->enregistrements = $this->pages[$page-1];
    	}
    }

}
