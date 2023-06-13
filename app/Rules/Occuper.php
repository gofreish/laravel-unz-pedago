<?php
/* Cette règle permet de savoir si quelque chose est déja
*programmé le même jour dans la même tranche d'heure.
*/
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Programme;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Occuper implements Rule
{
    private $dateDebut;
    private $heure_debut_matin;
    private $heure_debut_soir;
    private $salle;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($dateDebut, $heure_debut_matin, $heure_debut_soir, $salle )
    {
        if( !is_null($dateDebut)){
            $this->dateDebut = $dateDebut;
        }else{ $this->dateDebut = "1999-01-01"; }
        
        $this->heure_debut_matin = $heure_debut_matin;

        $this->heure_debut_soir = $heure_debut_soir;

        if( !is_null($salle) ){
            $this->salle = $salle;
        }else{ $this->salle = 0; }
    }

    private function requete(){
        //Si on a les heures de début
        if( !is_null($this->heure_debut_matin) and !is_null($this->heure_debut_soir)){

            $jour = Programme::where('dateDebut', '<=', $this->dateDebut)
            ->where('dateFin', '>', $this->dateDebut)
            ->where(function($query) {
                $query->whereTime('h_Deb_Matin', '<=', $this->heure_debut_matin)
                    ->whereTime('h_Fin_Matin', '>', $this->heure_debut_matin);
            })
            ->where(function($query) {
                $query->whereTime('h_Deb_Soir', '<=', $this->heure_debut_soir)
                    ->whereTime('h_Fin_Soir', '>', $this->heure_debut_soir);
            })
            ->where('salle_id', '=', $this->salle)
            ->first();
            return $jour;
        }
        //Si on a pas l heure de début du soir
        elseif( !is_null($this->heure_debut_matin) and is_null($this->heure_debut_soir) ){

            $jour = Programme::where('dateDebut', '<=', $this->dateDebut)
            ->where('dateFin', '>', $this->dateDebut)
            ->whereTime('h_Deb_Matin', '<=', $this->heure_debut_matin)
            ->whereTime('h_Fin_Matin', '>', $this->heure_debut_matin)
            ->where('salle_id', '=', $this->salle)
            ->first();
            return $jour;
        }
        //Si on a pas l heure de début du matin
        elseif( is_null($this->heure_debut_matin) and !is_null($this->heure_debut_soir) ){

            $jour = Programme::where('dateDebut', '<=', $this->dateDebut)
            ->where('dateFin', '>', $this->dateDebut)
            ->where(function($query) {
                $query->whereTime('h_Deb_Soir', '<=', $this->heure_debut_soir)
                    ->whereTime('h_Fin_Soir', '>', $this->heure_debut_soir);
            })
            ->where('salle_id', '=', $this->salle)
            ->first();
            return $jour;
        }
        //Si on a rien
        else{
            return null;
        }
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //Si ce n'est pas examen
        if( $value != 2 ){
            //dd($this->heure_debut_matin);
            if( is_null( $this->requete() ) ){
                /*$time = strtotime($this->dateDebut);
                $jour = date('l', $time);
                dd($jour);*/
                return true;
            }
            //Si c'est déja occupé
            else{ 
                //dd("c'est déja occupé");
                return false;
            }
        }else{
            return true;   
        }
        /*Si c est un Examen
        elseif( $value == 2 ){
            //On cherche s'il y a déja un cours ou un examen
            $jour = Programme::where('dateDebut', '=', $this->dateDebut)
            ->where('h_Deb_Matin' ,'<', $this->heure_debut_matin)
            ->orWhere('h_Deb_Soir' ,'>', $this->heure_debut_soir)
            ->first();

            //Si c'est libre
            if( is_null($jour) ){
                dd("c'est libre");
                return true;
            }
            //Si c'est déja occupé
            else{
            dd("c'est déja occupé"); 
                return false;
            }
        }
        */
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Il y a déja un autre programme';
    }
}