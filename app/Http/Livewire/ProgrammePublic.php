<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\ECU;
use App\Models\User;
use App\Models\Salle;
use App\Models\Filiere;
use Livewire\Component;
use App\Models\Programme;
use App\Models\Promotion;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use phpDocumentor\Reflection\Types\This;

use function PHPUnit\Framework\returnSelf;

class ProgrammePublic extends Component
{
	public $pdfName;
	public $html;
	public $filieres;
	public $promotions;
	public $programmes;
	public $coordonateur = ['nom' => null,
							'prenom' => null,
							'titre' => null];

	public $contain = false;
	public $superProgrammeTab = [];
	public $programmeTab = [
		'lundi'=> null,
		'mardi'=> null,
		'mercredi' => null,
		'jeudi'=> null,
		'vendredi'=> null,
		'samedi'=> null,
	];


	public $selectedFiliere = null;
	public $selectedPromotion = null;
	public $selectedFiliereName = null;
	public $selectedPromotionAnne = null;

	private function isSameWeek( $date1, $date2 ){
		$date_a = new Carbon($date1);

		return $date_a->isSameWeek($date2);
	}

	//Cette fonction rempli un tableau a deux dimension qui représente le programme.
	//Paramètre : La liste des programmes a affiché
	public function remplissage( $programmes ){

		if( !$programmes->isEmpty() ){
		$selectedCoordonateur = DB::table('users')
			->where('users.id', $programmes[0]->user_id)
			->join('titres', 'titres.id', '=', 'users.titre_id')
			->first();
		$this->coordonateur['nom'] = $selectedCoordonateur->name;
		$this->coordonateur['prenom'] = $selectedCoordonateur->prenom;
		$this->coordonateur['titre'] = $selectedCoordonateur->titre;



		//On parcourt la liste des programmes
		foreach($programmes as $key => $programme){
			//On récupère les informations a mettre dans les colonnes de jour
			$enseignant = DB::table('users')
			->where('users.id', $programme->enseignant_id)
			->join('titres', 'titres.id', '=', 'users.titre_id')
			->first();
			$ecu = ECU::find($programme->e_c_u_id);

			$semestre = DB::table('e_c_u_s')
			->where('e_c_u_s.id', $programme->e_c_u_id)
			->join('u_e_s', 'u_e_s.id', '=', 'e_c_u_s.u_e_id')
			->join('semestres', 'semestres.id', '=', 'u_e_s.semestre_id')
			->first();

			//On initialise des objets carbon pour les utilisé avec la boucle for
			//$dateDebut;
			//$dateFin;
			$donnees = "";
			//Si c est un cour on initialise avec la date de début et celle de fin
			if( $programme->type_programme_id == 1){
				$dateDebut = new Carbon( $programme->dateDebut );
				$dateFin = new Carbon( $programme->dateFin );
			//Sinon si c est un devoir on initialise avec la date de début seulement
			}elseif($programme->type_programme_id == 2){
				$dateDebut = new Carbon( $programme->dateDebut);
				$dateFin = new Carbon( $programme->dateDebut );
				$donnees = "&lt;span class='text-danger'&gt; EXAMEN &lt;/span&gt; &lt;br&gt;" ;
			}
			$dateFin->add(1, 'days');

			$donnees = $donnees."&lt;span class='text-primary'&gt;".$ecu->nom." &lt;/span&gt;( ".$semestre->intitule." ) "."&lt;br&gt; Salle: ".Salle::all()->pluck('nom', 'id')->get($programme->salle_id)."&lt;br&gt;".$programme->h_Deb_Matin." - ".$programme->h_Fin_Matin."&lt;br&gt;".$programme->h_Deb_Soir." - ".$programme->h_Fin_Soir."&lt;br&gt; &lt;strong&gt;".$enseignant->titre." ".$enseignant->prenom." ".$enseignant->name."&lt;/strong&gt; " ;

			//On parcourt les jours du programme
			for($date = $dateDebut; $date->isBefore($dateFin); $date->add(1, 'days')){
				$semaine = null;
				if( $date->getTranslatedDayName() == 'dimanche' ){
					continue;
				}
				//On cherche la semaine dans laquelle se trouve le jour courant
				foreach( $this->superProgrammeTab as $lundi => $valeur ){
					//Si on à trouvé la semaine
					if( $this->isSameWeek( $lundi, $date ) ){
						$semaine = $lundi;
						break;
					}
				}

				//Si on a pas trouvé la semaine dans le tableau, On crée une nouvelle semaine
				if( is_null($semaine) ){
					$carbon = new Carbon($date);
					$lundi = $carbon->startOfWeek();
					$this->superProgrammeTab[$lundi->toDateString()] = [
									'lundi'=> null,
									'mardi'=> null,
									'mercredi' => null,
									'jeudi'=> null,
									'vendredi'=> null,
									'samedi'=> null,
								];
					$semaine = $lundi->toDateString();
				}

				//S'il y avait rien dans la colonne du jour alors on l ajoute simplement
				if( is_null($this->superProgrammeTab[$semaine][$date->getTranslatedDayName()]) ){
					$this->superProgrammeTab[$semaine][$date->getTranslatedDayName()] = $donnees;
				}
				//Sinon On concatène avec l'ancien contenu
				else{
				$this->superProgrammeTab[$semaine][$date->getTranslatedDayName()] = $this->superProgrammeTab[$semaine][$date->getTranslatedDayName()].'&lt;hr&gt; &lt;br&gt;'.$donnees;
				}
			}
		}
		}
	}

	public function mount(){
		//dd('je suis là');
		$this->filieres = DB::table('filieres')->orderBy('name')->pluck('id','name');
		//dd($this->filieres);
		$this->promotions = collect();
        $this->programmes = collect();
	}

    public function render()
    {
        return view('livewire.programme-public');
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

    public function updatedSelectedPromotion( $promotions ){
        if( $promotions=='null' ){
            $promotions = null;
            $this->reset('selectedPromotion');
        }
    	if( !is_null($promotions) ){
    		$this->selectedPromotionAnne = Promotion::find($promotions);
    		$this->programmes =  Programme::where('promotion_id', $promotions)
    		->where('public', 'true')
    		->get();

    		$this->programmes = $this->programmes->sortBy('dateDebut');
    		//On rempli que quand il y a un programme
    		if(count($this->programmes) != 0){
    		$this->contain = true;
    		$this->remplissage( $this->programmes );
    		//On creer la vue pour le PDF
    		$this->html = (string)view('unz_st.programme.pdf',[
       		'superProgrammeTab' => $this->superProgrammeTab,
       		'filiereName' => $this->selectedFiliereName->name,
       		'promotion' => $this->selectedPromotionAnne->annee_entrer,
       		'coordonateur' => $this->coordonateur
       	])->render();
    		//On crée le nom du pdf
    		$this->pdfName = $this->PDFName( $this->superProgrammeTab );
    		}
    		else{
    			$this->contain = false;
    		}

    	}


    }

    public function PDFName( $programme ){
    	$nom = "Programme du ";
    	$cle;
    	$i = 1;
    	foreach($programme as $key => $value){
    		if($i==1) $nom = $nom.$key;
    		$i++;
    		$cle = $key;
    	}
    	$nom = $nom." au ".$cle;
    	return $nom;
    }
}
