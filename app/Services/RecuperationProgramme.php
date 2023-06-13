<?php
/*
    16.12.2019
    RolesService.php
*/

namespace App\Services;

use App\Models\Programme;
use Illuminate\Support\Facades\DB;


class RecuperationProgramme{

    public static function recuperation($programme_id){
        
        $donnees = [

            'dateDebut' => null,
            'dateFin' => null,
            'h_Deb_Matin' => null,
            'h_Fin_Matin' => null,
            'h_Deb_Soir' => null,
            'h_Fin_Soir' => null,
            'commentaire' => null,
            'public' => null,
            'e_c_u_id' => null,
            'e_c_u_nom' => null,
            'filiere_nom' => null,
            'cycle_nom' => null,
            'semestre_nom' => null,
            'promotion_id' => null,
            'promotion_anne' => null,
            'salle_id' => null,
            'salle_nom' => null,
            'batiment_name' => null,
            'type_programme_id' => null,
            'type_programme_nom' => null,
            'u_e_nom' => null,
            'enseignant_id' => null,
            'enseignant_nom' => null,
            'enseignant_prenom' => null,
            'enseignant_titre' => null
        ];

        $type = Programme::findOrFail($programme_id);

        if( $type->type_programme_id == 1 ){
            $programme = DB::table('programmes')
        ->where('programmes.id', '=', $programme_id)
        ->join('e_c_u_s', 'e_c_u_s.id', '=', 'programmes.e_c_u_id')
        ->join('u_e_s', 'u_e_s.id', '=', 'e_c_u_s.u_e_id')
        ->join('filieres', 'filieres.id', '=', 'u_e_s.filiere_id')
        ->join('cycles', 'cycles.id', '=', 'u_e_s.cycle_id')
        ->join('semestres', 'semestres.id', '=', 'u_e_s.semestre_id')
        ->join('promotions', 'promotions.id', '=', 'programmes.promotion_id')
        ->join('salles', 'salles.id', '=', 'programmes.salle_id')
        ->join('batiments', 'batiments.id', '=', 'salles.batiment_id')
        ->join('type_programmes', 'type_programmes.id', '=', 'programmes.type_programme_id')
        ->join('users', 'users.id', '=', 'programmes.enseignant_id')
        ->join('titres', 'titres.id', '=', 'users.titre_id')/**/
        ->select('programmes.id',
                'programmes.dateDebut',
                'programmes.dateFin',
                'programmes.h_Deb_Matin',
                'programmes.h_Fin_Matin',
                'programmes.h_Deb_Soir',
                'programmes.h_Fin_Soir',
                'programmes.commentaire',
                'programmes.public',
                'e_c_u_s.id as e_c_u_id',
                'e_c_u_s.nom as nom_ecu',
                'filieres.name as filiere', 
                'cycles.cycle as cycle', 
                'semestres.intitule as semestre',
                'promotions.id as promotion_id',
                'promotions.annee_entrer as promotion',
                'salles.id as salle_id', 
                'salles.nom as salle_nom',
                'batiments.name as batiment_name',
                'type_programmes.id as type_programme_id',
                'type_programmes.type as type_programme_nom',
                'u_e_s.nom as u_e_nom',
                'users.id as enseignant_id',
                'users.name as enseignant_nom',
                'users.prenom as enseignant_prenom',
                'titres.titre as enseignant_titre'/**/
        )->first();

        //dd($programme);

        $donnees['dateDebut'] = $programme->dateDebut;
        $donnees['dateFin'] = $programme->dateFin;
        $donnees['h_Deb_Matin'] = $programme->h_Deb_Matin;
        $donnees['h_Fin_Matin'] = $programme->h_Fin_Matin;
        $donnees['h_Deb_Soir'] = $programme->h_Deb_Soir;
        $donnees['h_Fin_Soir'] = $programme->h_Fin_Soir;
        $donnees['commentaire'] = $programme->commentaire;
        $donnees['public'] = $programme->public;
        $donnees['e_c_u_id'] = $programme->e_c_u_id;
        $donnees['e_c_u_nom'] = $programme->nom_ecu;
        $donnees['filiere_nom'] = $programme->filiere;
        $donnees['cycle_nom'] = $programme->cycle;
        $donnees['semestre_nom'] = $programme->semestre;
        $donnees['promotion_id'] = $programme->promotion_id;
        $donnees['promotion_anne'] = $programme->promotion;
        $donnees['salle_id'] = $programme->salle_id;
        $donnees['salle_nom'] = $programme->salle_nom;
        $donnees['batiment_name']=$programme->batiment_name;
        $donnees['type_programme_id'] = $programme->type_programme_id;
        $donnees['type_programme_nom'] = $programme->type_programme_nom;
        $donnees['u_e_nom'] = $programme->u_e_nom;
        $donnees['enseignant_id'] = $programme->enseignant_id;
        $donnees['enseignant_nom'] = $programme->enseignant_nom;
        $donnees['enseignant_prenom'] = $programme->enseignant_prenom;
        $donnees['enseignant_titre'] = $programme->enseignant_titre;
        }
        elseif ( $type->type_programme_id == 2 ) {
            $programme = DB::table('programmes')
        ->where('programmes.id', '=', $programme_id)
        ->join('e_c_u_s', 'e_c_u_s.id', '=', 'programmes.e_c_u_id')
        ->join('u_e_s', 'u_e_s.id', '=', 'e_c_u_s.u_e_id')
        ->join('filieres', 'filieres.id', '=', 'u_e_s.filiere_id')
        ->join('cycles', 'cycles.id', '=', 'u_e_s.cycle_id')
        ->join('semestres', 'semestres.id', '=', 'u_e_s.semestre_id')
        ->join('promotions', 'promotions.id', '=', 'programmes.promotion_id')
        ->join('type_programmes', 'type_programmes.id', '=', 'programmes.type_programme_id')
        ->join('users', 'users.id', '=', 'programmes.enseignant_id')
        ->join('titres', 'titres.id', '=', 'users.titre_id')/**/
        ->select('programmes.id',
                'programmes.dateDebut',
                'programmes.dateFin',
                'programmes.h_Deb_Matin',
                'programmes.h_Fin_Matin',
                'programmes.h_Deb_Soir',
                'programmes.h_Fin_Soir',
                'programmes.commentaire',
                'programmes.public',
                'e_c_u_s.id as e_c_u_id',
                'e_c_u_s.nom as nom_ecu',
                'filieres.name as filiere', 
                'cycles.cycle as cycle', 
                'semestres.intitule as semestre',
                'promotions.id as promotion_id',
                'promotions.annee_entrer as promotion',
                'type_programmes.id as type_programme_id',
                'type_programmes.type as type_programme_nom',
                'u_e_s.nom as u_e_nom',
                'users.id as enseignant_id',
                'users.name as enseignant_nom',
                'users.prenom as enseignant_prenom',
                'titres.titre as enseignant_titre'/**/
        )->first();

        //dd($programme);

        $donnees['dateDebut'] = $programme->dateDebut;
        $donnees['dateFin'] = $programme->dateFin;
        $donnees['h_Deb_Matin'] = $programme->h_Deb_Matin;
        $donnees['h_Fin_Matin'] = $programme->h_Fin_Matin;
        $donnees['h_Deb_Soir'] = $programme->h_Deb_Soir;
        $donnees['h_Fin_Soir'] = $programme->h_Fin_Soir;
        $donnees['commentaire'] = $programme->commentaire;
        $donnees['e_c_u_id'] = $programme->e_c_u_id;
        $donnees['e_c_u_nom'] = $programme->nom_ecu;
        $donnees['filiere_nom'] = $programme->filiere;
        $donnees['cycle_nom'] = $programme->cycle;
        $donnees['semestre_nom'] = $programme->semestre;
        $donnees['promotion_id'] = $programme->promotion_id;
        $donnees['promotion_anne'] = $programme->promotion;
        $donnees['type_programme_id'] = $programme->type_programme_id;
        $donnees['type_programme_nom'] = $programme->type_programme_nom;
        $donnees['u_e_nom'] = $programme->u_e_nom;
        $donnees['enseignant_id'] = $programme->enseignant_id;
        $donnees['enseignant_nom'] = $programme->enseignant_nom;
        $donnees['enseignant_prenom'] = $programme->enseignant_prenom;
        $donnees['enseignant_titre'] = $programme->enseignant_titre;   
        }
        else{
            $programme = DB::table('programmes')
        ->where('programmes.id', '=', $programme_id)
        ->join('salles', 'salles.id', '=', 'programmes.salle_id')
        ->join('batiments', 'batiments.id', '=', 'salles.batiment_id')
        ->join('type_programmes', 'type_programmes.id', '=', 'programmes.type_programme_id')
        ->select('programmes.id',
                'programmes.dateDebut',
                'programmes.dateFin',
                'programmes.h_Deb_Matin',
                'programmes.h_Fin_Matin',
                'programmes.h_Deb_Soir',
                'programmes.h_Fin_Soir',
                'programmes.commentaire',
                'salles.id as salle_id',
                'salles.nom as salle_nom',
                'batiments.name as batiment_name',
                'type_programmes.id as type_programme_id',
                'type_programmes.type as type_programme_nom'/**/
        )->first();

        //dd($programme);

        $donnees['dateDebut'] = $programme->dateDebut;
        $donnees['dateFin'] = $programme->dateFin;
        $donnees['h_Deb_Matin'] = $programme->h_Deb_Matin;
        $donnees['h_Fin_Matin'] = $programme->h_Fin_Matin;
        $donnees['h_Deb_Soir'] = $programme->h_Deb_Soir;
        $donnees['h_Fin_Soir'] = $programme->h_Fin_Soir;
        $donnees['commentaire'] = $programme->commentaire;
        $donnees['public'] = $programme->public;
        $donnees['salle_id'] = $programme->salle_id;
        $donnees['salle_nom'] = $programme->salle_nom;
        $donnees['batiment_name']=$programme->batiment_name;
        $donnees['type_programme_id'] = $programme->type_programme_id;
        $donnees['type_programme_nom'] = $programme->type_programme_nom;
        }

        return $donnees;

    }    

}