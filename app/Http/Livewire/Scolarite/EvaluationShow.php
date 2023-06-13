<?php

namespace App\Http\Livewire\Scolarite;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Programme;
use App\Models\Groupe;
use App\Models\Surveillant;
use App\Models\Batiment;
use App\Models\Salle;
use App\Models\Copie;
use App\Exports\studentAllGroupExport;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\Etudiant;
use App\Models\Promotion;
use App\Models\StudentGroup;
use Illuminate\Support\Str;

class EvaluationShow extends Component
{

    public $informations;
    public $newStudentsINE;
    public $newStudentsNbr = 0;
    public $oldStudentsINE;
    public $oldStudentsNbr = 0;
    public $studentRestant = 0;
    public $groupeList = [ //on met un groupe par defaut
        ['numero' => 1, 'taille' => 1, 'salle' => [], 'surv' => []] //'salle'=>['id'=>, 'nom'=>], 'surv'=>[ ['cnib'=>, 'nom'=>, 'prenom'=>] ] plus 'student' => [ine1, ine2]
    ];
    public $group_id;
    public $surveillantList;
    public $batimentList;
    public $salleList;
    public $errorMessage = null;
    public $successMessage = null;
    public $isNormal = "";
    public $sessionConfirmed = false;
    public $hasStudent = false;

    public $selectedSurv;
    public $selectedBat;
    public $selectedSalle; 

    public function mount( $id ){        
        $this->surveillantList = Surveillant::all();
        $this->batimentList = Batiment::all();
        $this->salleList = collect();
        $this->informations = (array)DB::table('programmes')
            ->where('programmes.id', $id)
            ->join('e_c_u_s', 'e_c_u_s.id', 'programmes.e_c_u_id')
            ->join('u_e_s', 'u_e_s.id', 'e_c_u_s.u_e_id')
            ->join('filieres', 'filieres.id', 'u_e_s.filiere_id')
            ->join('cycles', 'cycles.id', 'u_e_s.cycle_id')
            ->join('semestres', 'semestres.id', 'u_e_s.semestre_id')
            ->join('promotions', 'promotions.id', 'programmes.promotion_id')
            ->select(
                'programmes.id as id',
                'programmes.dateDebut as date',
                'e_c_u_s.nom as nomECU',
                'filieres.name as filiere',
                'filieres.id as filiere_id',
                'cycles.cycle as cycle',
                'cycles.id as cycle_id',
                'semestres.intitule as semestre',
                'promotions.annee_entrer as promotion',
                'promotions.id as promotion_id',
            )->first();
    }

    public function render()
    {
        return view('livewire.scolarite.evaluation-show');
    }

    public function confirmSession(){
        $this->sessionConfirmed = true;
        $this->getStudents();
    }

    private function generateRegEx( $resultat ){
        /* exemple : l{1(v:1);2(v:1);3(a:1);4(v:1);5(v:1);6(v:1);}|m{1(a:2);}
        regEx dans le cas des ajourner licence s3
        regEx = l{______________3(a%
        regEx dans le cas des ajourner Master s1
        regEx = %m{1(a%
        */
        $resultsPossible = ['n', 'a', 'v'];
        if( in_array($resultat, $resultsPossible, true) ){
            $semestreNumber = $this->informations['semestre'][strlen($this->informations['semestre']) - 1];
            $regEx = "";
            switch ($this->informations['cycle'][0]) {
                case 'L':
                    $regEx = "l{";
                    break;
                case 'M':
                    $regEx = "%m{";
                    break;
            }
            for ($i=0; $i < 7*(intval($semestreNumber)-1) ; $i++) { 
                $regEx = $regEx.'_';
            }
            $regEx = $regEx.$semestreNumber."($resultat%";
            return $regEx;
        }
    }

    //Recupere les etudiants qui composent
    public function getStudents(){
        $this->newStudentsINE = Etudiant::where('promotion_id', $this->informations['promotion_id']);
        if( (boolean)$this->isNormal ){
            //Session normale
            $this->newStudentsINE = $this->newStudentsINE->where('historique', 'like', $this->generateRegEx('n'));
        }else{
            //Session de rattrapage
            $this->newStudentsINE = $this->newStudentsINE->where('historique', 'like', $this->generateRegEx('a'));
        }
        $this->newStudentsINE = $this->newStudentsINE->orderBy('nom')
        ->pluck('ine');
        $this->newStudentsNbr = $this->newStudentsINE->count();

        /*Pour les ancien on prend ceux du même cycle que le devoir et qui sont dans le filiere*/
        $promotions_id = Promotion::where('filiere_id', $this->informations['filiere_id'])->
        where('id', '<>', $this->informations['promotion_id'] )->pluck('id');
        $this->oldStudentsINE = Etudiant::where('cycle_id', $this->informations['cycle_id'])
            ->whereIn('promotion_id', $promotions_id->all())
            ->where('historique', 'like', $this->generateRegEx('a'))
            ->orderBy('nom')
            ->pluck('ine');
        $this->oldStudentsNbr = $this->oldStudentsINE->count();
        $this->studentRestant = $this->newStudentsNbr + $this->oldStudentsNbr;
    }

    private function isNbrOK():bool{
        if( $this->newStudentsNbr==0 && $this->oldStudentsNbr==0 ){
            return false;
        }else{
            $dejaCompter = 0;
            foreach ($this->groupeList as $key => $groupe) {
                $dejaCompter += $groupe['taille'];
            }
            return ($this->newStudentsNbr + $this->oldStudentsNbr - $dejaCompter) == 0;
        }
    }

    public function addGroup(){
        $groupe = ['numero' => $this->groupeList[array_key_last($this->groupeList)]['numero']+1, 'taille' => 1, 'salle' => [], 'surv' => []];
        array_push($this->groupeList, $groupe);
        $this->calculateRestant();
    }
    
    public function suppGroupe(){
        if( count($this->groupeList) > 1 ){
            unset($this->groupeList[array_key_last($this->groupeList)]);
            $this->groupeList = array_values($this->groupeList);
        }
        $this->calculateRestant();
    }

    public function updatedGroup_id( $id ){
        if( $id == ""){
            $this->reset('group_id');
            $id = null;
        }
    }

    public function updatedSelectedBat($bat_id){
        if( $bat_id == "" ){
            $this->reset('selectedBat');
            $bat_id = null;
        }
        if( !is_null($bat_id) ){
            $this->salleList = Salle::where('batiment_id', $bat_id)->get();
        }
    }

    public function updatedSelectedSalle($salle_id){
        if( $salle_id == ""){
            $this->reset('selectedSalle');
            $salle_id = null;
        }

        if( !is_null($salle_id) && !is_null($this->group_id) ){
            $salle = Salle::find($salle_id);
            $this->groupeList[$this->group_id]['salle']['id'] = $salle->id;
            $this->groupeList[$this->group_id]['salle']['nom'] = $salle->nom;
        }
    }

    public function updatedSelectedSurv($surv){
        if( $surv == "" ){
            $this->reset('selectedSurv');
            $surv = null;
        }
        if( !is_null($surv) && !is_null($this->group_id) ){
            $surveillant = Surveillant::find($surv);
            $surv = [ 
                'cnib' => $surveillant->cnib,
                'nom' => $surveillant->nom,
                'prenom' => $surveillant->prenom
            ];
            array_push( $this->groupeList[$this->group_id]['surv'], $surv );
        }
    }
    
    //Supression de la salle
    public function suppSalle( $group_id ){
        $this->groupeList[$group_id]['salle'] = array();
    }
    
    //Supression de la salle
    public function suppSurv( $group_id ){
        $this->groupeList[$group_id]['surv'] = array();
    }

    public function enregistrerRepartition(){
        $this->errorMessage = null;
        $this->successMessage = null;
        $go = true;
        if( !$this->isNbrOK() ){
            $go = false;
            $this->errorMessage = $this->errorMessage."Erreur avec le nombre d'étudiant |";
        }
        if( !$this->sessionConfirmed ){
            $go = false; 
            $this->errorMessage = $this->errorMessage."Veuillez confirmer la session";
        }
        if( $go ){ //Si il y a pas de bleme
            $copie = Copie::where('programme_id', $this->informations['id'])->first();
            if( is_null($copie) ){ //Si c est la copie n existait pas
                $copie = Copie::create([ //on la cree
                    'is_prepared' => true,
                    'is_normal' => (boolean)$this->isNormal,
                    'has_note' => false,
                    'programme_id' => $this->informations['id'],
                    'agent_id' => auth()->user()->id,
                ]);
            }else{//Sinon on la modifie
                $copie->is_prepared = true;
                $copie->is_normal = (boolean)$this->isNormal;
                $copie->save();
            }

            //On supprime les anciens groupes pour cette copie
            StudentGroup::destroy( StudentGroup::where('copie_id', $copie->id)->pluck('id') );
            
            //Ici on associe les INE des etudiants au groupe
            $allStudents = $this->newStudentsINE->merge($this->oldStudentsINE);
            $first = 0; $last = 0;
            foreach ($this->groupeList as $key => $groupe) {
                /* Cette chaine represente la liste des etudiants d un groupe a 
                garder dans la table student_groups*/
                $students = "";
                $last =$first + $groupe['taille'] - 1; 
                $this->groupeList[$key]['student'] = [];
                for ( $i=$first; $i <= $last; $i++) { 
                    $students = $students.$allStudents->get($i).';';
                    array_push($this->groupeList[$key]['student'], $allStudents->get($i));
                }
                $first = $last + 1;

                //Creation du student_groups relié a la copie
                /* Cette chaine represente la liste des surveillants d un groupe a 
                garder dans la table student_groups*/
                $survCNIBs = "";
                foreach ($groupe['surv'] as $key => $surv) {
                    $survCNIBs = $survCNIBs.$surv['cnib'].';';
                }
                //Pour suppromer le dernier ;
                $students = Str::replaceLast(';', '', $students);
                $survCNIBs = Str::replaceLast(';', '', $survCNIBs);

                $copieGroupe = StudentGroup::create([ //On cree le groupe
                    'nom' => "groupe".$groupe['numero'],
                    'students' => $students,
                    'surveillants' => $survCNIBs,
                    'taille' => $groupe['taille'],
                    'salle_id' => $groupe['salle']['id'],
                    'copie_id' => $copie->id
                ]);
            }
            $this->successMessage = "Enregistrer avec succès";
        }
    }

    public function telechargerRepartition(){
        $fileName = "Repartition Module:".$this->informations['nomECU']." du ".$this->informations['date']."(".$this->informations['filiere']." P:".$this->informations['promotion'].").xlsx";
        return Excel::download(new studentAllGroupExport($this->groupeList), $fileName);
    }

     //Modification de l heure du devoir
     public function changeHeure(){
        //dd($this->hDebDev);
        $canSave = false;
        $programme = Programme::find($this->informations['id']);

        //Si la date est après aujourd'hui
        if($programme->dateDebut > today() ){
            $canSave = true;
        }
        //Si c est le meme jour
        elseif( today()->isSameDay($programme->dateDebut) ){
            //Si l heure est toujours après
            if( !is_null($this->hDebDev) && (now()->format('H:m:s') < $this->hDebDev) ){
                $canSave = true;
            }
        }
        
        if ( !is_null($this->hDebDev) && $canSave ){
            
            $programme->h_Deb_Matin = $this->hDebDev;
        }
        if ( !is_null($this->hFinDev) ){
            
            $programme->h_Deb_Soir = $this->hFinDev;
        }
        $programme->save();
    }

    //Modification de la date du devoir
    public function changeDate(){
        $canSave = false;
        //si la date n est pas null
        if( !is_null($this->dateDevoir) ){
            //Si la date est après aujourd'hui
            if($this->dateDevoir>today() ){
                $canSave = true;
            }
            //Si c est le meme jour
            elseif( today()->isSameDay($this->dateDevoir) ){
                $programme_heure = Programme::find($this->informations['id'])->h_Deb_Matin;
                //Si l heure est toujours après
                if( now()->format('H:m:s') < $programme_heure ){
                    $canSave = true;
                }
            }
        }
    }
}