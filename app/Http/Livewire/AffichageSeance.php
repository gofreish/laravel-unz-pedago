<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Seance;
use App\Models\User;
use App\Models\Titre;
use App\Models\ECU;
use Illuminate\Pagination\CursorPaginator;

class AffichageSeance extends Component
{
    public $ECUs;
    public $seances;
    public $contain = false;
    public $html;
    public $pdfName;

    public $selectedECU=null;



    private function seanceDonnees(){
        $donnees = [];
        if( !is_null($this->selectedECU) ){
            $data = DB::table('e_c_u_s')
            ->where('e_c_u_s.id', '=', $this->selectedECU)
            ->join('u_e_s', 'u_e_s.id', '=', 'e_c_u_s.u_e_id')
            ->join('filieres', 'filieres.id', '=', 'u_e_s.filiere_id')
            ->join('cycles', 'cycles.id', '=', 'u_e_s.cycle_id')
            ->join('semestres', 'semestres.id', '=', 'u_e_s.semestre_id')
            ->select(
                'e_c_u_s.nom as nom_ecu',
                'u_e_s.nom as ue',
                'filieres.name as nomFiliere',
                'cycles.cycle as cycle',
                'semestres.intitule as semestre',
            )->first();
            //Recuperation des donnees communes
            $donnees['ecu'] =  $data->nom_ecu;
            $donnees['ue'] = $data->ue;
            $donnees['filiere'] = $data->nomFiliere;
            $donnees['cyle'] = $data->cycle;
            $donnees['semestre'] = $data->semestre;

            //Recuperation des sceances
            $seanceListe =  DB::table('seances')
            ->where('seances.e_c_u_id', '=', $this->selectedECU)
            ->where('seances.enseignant_id', '=', auth()->user()->id)
            ->orWhere('seances.delegue_id', '=', auth()->user()->id)
            ->get();

            //Si il y a quelque chose
            if( count($seanceListe) > 0 ){
                $enseignant = User::findOrFail($seanceListe->first()->enseignant_id);
                $delegue = User::findOrFail($seanceListe->first()->delegue_id);

                $donnees['enseignantName'] = $enseignant->name;
                $donnees['enseignantPrenom'] = $enseignant->prenom;
                $donnees['enseignantTitre'] = Titre::findOrFail($enseignant->titre_id)->titre;
                $donnees['delegueName'] = $delegue->name;
                $donnees['deleguePrenom'] = $delegue->prenom;

                $seances = [];
                foreach ($seanceListe as $key => $seance) {
                    //on met les donnees de la seance dans le tableau
                    $SC = [];
                    $SC['date'] = $seance->date;
                    $SC['hDebut'] = $seance->hDebut;
                    $SC['hFin'] = $seance->hFin;
                    $SC['contenu'] = $seance->contenu;
                    $SC['statut'] = $seance->statut;

                    //puis on le push dans le
                    array_push($seances, $SC);
                }
                $donnees['seance'] = $seances;
                return $donnees;
            }

        }


    }

    public function mount(){
        //dd('je suis là');
       $this->ECUs = DB::table('e_c_u_s')
                        ->where('programmes.enseignant_id', '=', auth()->user()->id)
                        ->orWhere('seances.delegue_id', '=', auth()->user()->id)
                        ->join('programmes','e_c_u_s.id','=','programmes.e_c_u_id')
                        ->join('seances','e_c_u_s.id','=','seances.e_c_u_id')
                        ->pluck('e_c_u_s.id','e_c_u_s.nom');
        $this->seances=collect();
        //dd($this->ECUs);
    }

    public function render()
    {
        return view('livewire.affichage-seance');
        //dd($this->seance(5));
    }


    public function updatedSelectedECU ($ECUs){
        if( $ECUs=='null' ){
            $ECUs = null;
            $this->reset('selectedECU');
        }
        if (!is_null($ECUs)) {
            $this->seanceDonnees();
            $this->seances= Seance::where('e_c_u_id','=',$ECUs)->get();
            if( count($this->seances) > 0 ){
                $donnees = $this->seanceDonnees();
                $this->contain = true;
                $this->html = (string)view('unz_st.seance.seancePDF',[
                    'donnees' => $donnees,
                ])->render();
                $this->pdfName = $donnees['ecu'].' '.$donnees['filiere'].' '.$donnees['semestre'].'.pdf';
            }
        }
    }

}
