<?php
/*
    30.09.2021
    SuperviserProgramme.php
*/

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Salle;
use App\Models\Programme;

class SuperviserProgramme{

    private $request;
    private $message = "";
    private $satisfait = true;

    public function __construct( $request ){
        $this->request = $request;
    }

    //Vérifie si c est occupé
    public function VERIFICATION_OCCUPATION(){
        //Si le champ type n est pas null
        if( !is_null($this->request->type) ){
            //Si c est un cours
            if( $this->request->type == 1 ){
                $this->chercheur();
                $this->trySendingMessage();
            }
            //SI c est un examen
            elseif ($this->request->type == 2) {
            }
            //Si c est autre
            elseif ( $this->request->type == 3 ) {
                $this->chercheur();
                $this->trySendingMessage();
            }

            //On retourne le boolean satisfait
            return $this->satisfait;
        }
    }

    //Elle fait toutes les vérifications DES CHAMPS et renvoi une variable qui indique si c est satisfait ou pas
    public function VERIFICATION_DES_CHAMPS(){
        //Si le champ type n est pas null
        if( !is_null($this->request->type) ){
            //Si c est un cours
            if( $this->request->type == 1 ){
                $this->checkECU();
                $this->checkPromotion();
                $this->checkEnseignant();
                $this->checkDate();
                $this->checkSalle();
                $this->checkHours();

                $this->trySendingMessage();
            }
            //SI c est un examen
            elseif ($this->request->type == 2) {
                $this->checkECU();
                $this->checkPromotion();
                $this->checkEnseignant();
                $this->checkDate_debut();
                $this->trySendingMessage();
            }
            //Si c est autre
            elseif ( $this->request->type == 3 ) {
                $this->checkDate();
                $this->checkHours();
                $this->checkSalle();
                $this->checkCommentaire();
                $this->trySendingMessage();
            }

            //On retourne le boolean satisfait
            return $this->satisfait;
        }
    }

    private function trySendingMessage(){
        if( !$this->satisfait ){
            $this->request->session()->flash('message', $this->message);
        }
    }

//####################################################################
//Cette fonction est chargée de cherché si c est occupé
    private function chercheur(){
        /*Chercons si il y a intersection entre les duré de jour avec un programme */

       $result = DB::table('programmes')
       ->where(function($query){
                $query->where('programmes.dateDebut', '>=', $this->request->date_debut)
                ->orWhere('programmes.dateFin', '>=', $this->request->date_debut);
            })
       ->where(function($query){
                $query->where('programmes.dateDebut', '<=', $this->request->date_fin)
                ->orWhere('programmes.dateFin', '<=', $this->request->date_fin);
            });

        //**********************************************************
        //Si il y a quelque chose
        if( count(  $result->get() ) > 0 ){
            //Chercons si il y a intersection entre les heures des programmes
            //Si le cour est programmer que dans la matinée
            if( is_null($this->request->heure_debut_soir) ){
                $result = $result
                ->where(function($query){
                    $query->where('programmes.h_Deb_Matin', '>=', $this->request->heure_debut_matin)
                    ->orWhere('programmes.h_Fin_Matin', '>=', $this->request->heure_debut_matin);
                })
                ->where(function($query){
                    $query->where('programmes.h_Deb_Matin', '<=', $this->request->heure_fin_matin)
                    ->orWhere('programmes.h_Fin_Matin', '<=', $this->request->heure_fin_matin);
                });

            }
            //Si le cour est programmer que dans la soirée
            elseif ( is_null($this->request->heure_debut_matin) ) {
                $result = $result
                ->where(function($query){
                    $query->where('programmes.h_Deb_Soir', '>=', $this->request->heure_debut_soir)
                    ->orWhere('programmes.h_Fin_Soir', '>=', $this->request->heure_debut_soir);
                })
                ->where(function($query){
                    $query->where('programmes.h_Deb_Soir', '<=', $this->request->heure_fin_soir)
                    ->orWhere('programmes.h_Fin_Soir', '<=', $this->request->heure_fin_soir);
                });
            }
            //Si c est le matin et le soir
            else{
                $result = $result
                ->where(function($querys){
                    $querys->where(function($query){
                        $query->where('programmes.h_Deb_Matin', '>=', $this->request->heure_debut_matin)
                        ->orWhere('programmes.h_Fin_Matin', '>=', $this->request->heure_debut_matin);
                        })
                    ->where(function($query){
                        $query->where('programmes.h_Deb_Matin', '<=', $this->request->heure_fin_matin)
                        ->orWhere('programmes.h_Fin_Matin', '<=', $this->request->heure_fin_matin);
                        });
                })
                ->orWhere(function($querys){
                    $querys->where(function($query){
                        $query->where('programmes.h_Deb_Soir', '>=', $this->request->heure_debut_soir)
                        ->orWhere('programmes.h_Fin_Soir', '>=', $this->request->heure_debut_soir);
                        })
                    ->where(function($query){
                        $query->where('programmes.h_Deb_Soir', '<=', $this->request->heure_fin_soir)
                        ->orWhere('programmes.h_Fin_Soir', '<=', $this->request->heure_fin_soir);
                        });
                });

            }

            //******************************************************
            //Si il y a intersection
            if( count(  $result->get() ) > 0 ){
                //On cherche si c est dans la meme salle
                $result = $result->where('salle_id', '=', $this->request->salle);

                //*******************************************
                //Si c est dans la meme salle
                if( count(  $result->get() ) > 0 ){
                    //On indique que c est occupé
                    $result = $result->first();
                    //Récupération des infos du coordonateur
                    $coordonateur = User::findOrFail($result->user_id);
                    //Récupération des infos da la salle
                    $salle = Salle::findOrFail($result->salle_id);

                    $this->message = $this->message."&lt;span class='badge badge-success'&gt; ".$coordonateur->prenom." ".$coordonateur->name." &lt;/span&gt; à déja mis un programme dans: &lt;span class='badge badge-ssecondary'&gt;".$salle->nom." &lt;/span&gt; &lt;hr&gt; &lt;br&gt; Jours: Du ".$result->dateDebut." Au ".$result->dateFin." &lt;hr&gt; &lt;br&gt; Heures : ".$this->gestionHeurePourMessage( $result );

                    $this->satisfait = false;
                }
            }
        }
    }


//######################################################################
    private function gestionHeurePourMessage( $programme ){
        $message = "";
        //Si c est le matin seulement
        if( is_null($programme->h_Deb_Soir) ){
            $message = "De ".$programme->h_Deb_Matin." à ".$programme->h_Fin_Matin;
            return $message;
        }
        //Le soir seulement
        elseif ( is_null($programme->h_Deb_Matin) ) {
            $message = "De ".$programme->h_Deb_Soir." à ".$programme->h_Fin_Soir;
            return $message;
        }
        else{
            $message = "De ".$programme->h_Deb_Matin." à ".$programme->h_Fin_Matin." et de ".$programme->h_Deb_Soir." à ".$programme->h_Fin_Soir;
            return $message;
        }
    }

    //Cette fonction vérifie la concordance des heures
    private function checkHours(){
        //Si on a debut matin sans fin matin
        if( !is_null($this->request->heure_debut_matin) &&
             is_null($this->request->heure_fin_matin) ){
            $this->message = $this->message." Il faut une heure de fin le matin ||";
            $this->satisfait = false;
        }
        //Si on a fin matin sans debut matin
        elseif ( !is_null($this->request->heure_fin_matin) &&
                  is_null($this->request->heure_debut_matin)  ) {
            $this->message = $this->message." Il faut une heure de Début le matin ||";
            $this->satisfait = false;
        }
        //Si on a les 2 sans concordance
        elseif ( !is_null($this->request->heure_fin_matin) &&
                  !is_null($this->request->heure_debut_matin) &&
                   ($this->request->heure_fin_matin <= $this->request->heure_debut_matin) ) {
            $this->message = $this->message." l'heure de Début du matin doit etre inferieur a l'heure de fin du matin ||";
            $this->satisfait = false;
        }

        //Si on a debut soir sans fin soir
        if( !is_null($this->request->heure_debut_soir) &&
             is_null($this->request->heure_fin_soir) ){
            $this->message = $this->message." Il faut une heure de fin le soir ||";
            $this->satisfait = false;
        }
        //Si on a fin soir sans debut soir
        elseif ( !is_null($this->request->heure_fin_soir) &&
                  is_null($this->request->heure_debut_soir)  ) {
            $this->message = $this->message." Il faut une heure de Début le soir ||";
            $this->satisfait = false;
        }
        //Si on a les 2 sans concordance
        elseif ( !is_null($this->request->heure_fin_soir) &&
                  is_null($this->request->heure_debut_soir) &&
                  ($this->request->heure_fin_soir <= $this->request->heure_debut_soir) ) {
            $this->message = $this->message."l'heure de Début du soir doit etre inferieur a l'heure de fin du soir ||";
            $this->satisfait = false;
        }

        //Si on a aucune heure
        if ( is_null($this->request->heure_debut_matin) &&
             is_null($this->request->heure_debut_soir) ) {
            $this->message = $this->message." Il faut &lt;strong&gt; au moins &lt;/strong&gt; une heure de Début ||";
            $this->satisfait = false;
        }
    }

//#########################################################################
    //Ici On défini les fonction qui s'occupent de vérifier si le champ est vide ou pas

    private function checkECU(){
        if( is_null($this->request->ecu) ){
            $this->message = $this->message." Le champ &lt;span class='text-primary'&gt; ECU &lt;/span&gt; est obligatoire ||";
            $this->satisfait = false;
        }
    }

    private function checkPromotion(){
        if( is_null($this->request->promotion) ){
            $this->message = $this->message." Le champ &lt;span class='text-primary'&gt; Promotion &lt;/span&gt; est obligatoire ||";
            $this->satisfait = false;
        }
    }

    private function checkEnseignant(){
        if( is_null($this->request->enseignant) ){
            $this->message = $this->message." Le champ &lt;span class='text-primary'&gt; Enseignant &lt;/span&gt; est obligatoire ||";
            $this->satisfait = false;
        }
    }

    //Cette fonction controle la concordance des dates. Ex: Si le début est avant la fin
    private function checkDate(){
        $this->checkDate_debut();
        $this->checkDate_fin();
        //Si on a un début et une fin
        if( !is_null($this->request->date_debut) &&
            !is_null($this->request->date_fin)
         ){
            if( $this->request->date_debut > $this->request->date_fin ){
                $this->message = $this->message." &lt;span class='text-primary'&gt; La Date de début &lt;/span&gt; doit être avant &lt;span class='text-primary'&gt; la date de fin &lt;/span&gt; ||";
                $this->satisfait = false;
            }
        }
    }

    private function checkDate_debut(){
        if( is_null($this->request->date_debut) ){
            $this->message = $this->message." &lt;span class='text-primary'&gt; La Date de début &lt;/span&gt; est obligatoire ||";
            $this->satisfait = false;
        }
    }

    private function checkDate_fin(){
        if( is_null($this->request->date_fin) ){
            $this->message = $this->message." &lt;span class='text-primary'&gt; La Date de fin &lt;/span&gt; est obligatoire ||";
            $this->satisfait = false;
        }
    }

    private function checkHeure_debut_matin(){
        if( is_null($this->request->heure_debut_matin) ){
            $this->message = $this->message." &lt;span class='text-primary'&gt; L'heure de début du matin &lt;/span&gt; est obligatoire ||";
            $this->satisfait = false;
        }
    }

    private function checkHeure_fin_matin(){
        if( is_null($this->request->heure_fin_matin) ){
            $this->message = $this->message." &lt;span class='text-primary'&gt; L'heure de fin du matin &lt;/span&gt; est obligatoire ||";
            $this->satisfait = false;
        }
    }

    private function checkHeure_debut_soir(){
        if( is_null($this->request->heure_debut_soir) ){
            $this->message = $this->message." &lt;span class='text-primary'&gt; L'heure de début du soir &lt;/span&gt; est obligatoire ||";
            $this->satisfait = false;
        }
    }

    private function checkHeure_fin_soir(){
        if( is_null($this->request->heure_fin_soir) ){
            $this->message = $this->message." &lt;span class='text-primary'&gt; L'heure de fin du soir &lt;/span&gt; est obligatoire ||";
            $this->satisfait = false;
        }
    }

    private function checkSalle(){
        if( is_null($this->request->salle) ){
            $this->message = $this->message." La &lt;span class='text-primary'&gt; Salle &lt;/span&gt; est obligatoire ||";
            $this->satisfait = false;
        }
    }

    private function checkCommentaire(){
        if( is_null($this->request->commentaire) ){
            $this->message = $this->message." Le &lt;span class='text-primary'&gt; commentaire &lt;/span&gt; est obligatoire ||";
            $this->satisfait = false;
        }
    }

}
