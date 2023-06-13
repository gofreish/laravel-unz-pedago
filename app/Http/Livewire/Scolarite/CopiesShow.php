<?php

namespace App\Http\Livewire\Scolarite;

use Livewire\Component;
use App\Models\Programme;
use App\Models\Copie;
use App\Models\StudentGroup;
use App\Models\Salle;
use App\Models\Batiment;
use App\Models\Etudiant;
use App\Models\Surveillant;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\DB;
//##### OLD


class CopiesShow extends Component
{   
    use LivewireAlert;
    
    private $informations;
    public $nomECU;
    public $dateEvaluation;
    public $debutEvaluation;
    public $promotion;
    public $enseignant;
    public $copie;
    private $groupes;
    /*groupesArray one element map : 
    [   'id'=>
        'nom'=> ,
        'taille'=>,
        'nbr_copie'=>0,
        'commentaire'=>,
        'salle'=> ['id'=>, 'nom'=>, 'nomBat'=>], 
        'students'=> [ ['ine'=>, 'nom'=>, 'prenom'=>, 'absent'=>], ['ine'=>, 'nom'=>, 'prenom'=>, 'absent'=>]], 
        'st_absent'=>[ine1, ine2], '
        'surveillants'=>[ ['cnib'=>, 'nom'=>, 'prenom'=>, 'absent'=>], ['cnib'=>, 'nom'=>, 'prenom'=>, 'absent'=>]] ,
        'su_absent' => [cnib1, cnib2],
    ]
    */
    public $groupesArray;

    //######### OLD

    public function mount( $programme_id ){

        $this->informations = DB::table("programmes")
        ->where("programmes.id", $programme_id)
        ->join("e_c_u_s", "e_c_u_s.id","programmes.e_c_u_id")
        ->join("promotions", "promotions.id", "programmes.promotion_id")
        ->join('users', 'users.id', 'programmes.enseignant_id')
        ->select(
            'programmes.id as programme_id',
            'e_c_u_s.nom as nomECU',
            'programmes.dateDebut as date',
            'programmes.h_Deb_Matin as heureDebut',
            'promotions.annee_entrer as promotion',
            'users.name as nom_enseignant',
            'users.prenom as prenom_enseignant',
        )->first();
        $this->nomECU = $this->informations->nomECU;
        $this->dateEvaluation = $this->informations->date;
        $this->debutEvaluation = $this->informations->heureDebut;
        $this->promotion = $this->informations->promotion;
        $this->enseignant = $this->informations->prenom_enseignant." ".$this->informations->nom_enseignant;
        
        $this->copie = Copie::where('programme_id', $this->informations->programme_id)->first();
        $this->groupes = StudentGroup::where('copie_id', $this->copie->id)->get();
        $this->groupesArray = [];
        //Pour chaque groupe
        foreach ($this->groupes as $key => $groupe) {
            $salle = Salle::find($groupe->salle_id);
            $batiment = Batiment::find($salle->batiment_id);
            //Recuperation des infos des surveillants
            $surveillants = Surveillant::whereIn('cnib', explode(';', $groupe->surveillants))->orderBy('nom')->get();
            $surv = [];
            foreach ($surveillants as $cle => $surveillant) {
                array_push($surv, ['cnib'=>$surveillant->cnib, 'nom'=>$surveillant->nom, 'prenom'=>$surveillant->prenom, 'absent'=>false]);
            }
            //Recuperation des infos des etudiants
            $etudiants = Etudiant::whereIn('ine', explode(';', $groupe->students))->orderBy('nom')->get();
            $students = [];
            foreach ($etudiants as $cle => $etudiant) {
                array_push($students, ['ine'=>$etudiant->ine, 'nom'=>$etudiant->nom, 'prenom'=>$etudiant->prenom, 'absent'=>false]);
            }

            $groupeArray = [
                'id'=>$groupe->id,
                'nom'=>$groupe->nom,
                'taille'=>$groupe->taille,
                'nbr_copie'=>$groupe->nbr_copie,
                'commentaire'=>" ",
                'salle'=>['id'=>$groupe->salle_id, 'nom'=>$salle->nom, 'nomBat'=>$batiment->name],
                'students'=>$students,
                'surveillants'=>$surv
            ];
            array_push($this->groupesArray, $groupeArray);
        }
    }

    public function terminer(){
        foreach ($this->groupesArray as $key => $groupeArray) {
            //Recherche des absent
            $survAbsCNIBs = "";
            foreach ($groupeArray['surveillants'] as $key => $surv) {
                if($surv['absent']){
                    $survAbsCNIBs = $survAbsCNIBs.$surv['cnib'].';';
                }
            }
            $stuAbsINEs = "";
            foreach ($groupeArray['students'] as $key => $stu) {
                if($stu['absent']){
                    $stuAbsINEs = $stuAbsINEs.$stu['ine'].';';
                }
            }
            //Pour suppromer le dernier ;
            $stuAbsINEs = Str::replaceLast(';', '', $stuAbsINEs);
            $survAbsCNIBs = Str::replaceLast(';', '', $survAbsCNIBs);

            $groupe = StudentGroup::find($groupeArray['id']);
            $groupe->nbr_copie = $groupeArray['nbr_copie'];
            $groupe->commentaire = $groupeArray['commentaire'];
            $groupe->st_absent = $stuAbsINEs;
            $groupe->su_absent = $survAbsCNIBs;
            $groupe->save();
        }
        
        $this->copie->is_composer = true;
        $this->copie->save();
        $this->confirm(
            "Informations enregistrées avec succès", [
            'position' => 'center',
            'showConfirmButton' => true,
            'confirmButtonText' => 'OK',
        ]);
    }

    public function render()
    {
        return view('livewire.scolarite.copies-show');
    }
}
