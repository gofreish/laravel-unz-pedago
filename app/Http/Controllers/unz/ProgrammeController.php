<?php

namespace App\Http\Controllers\unz;
use Illuminate\Support\Facades\Mail;
use App\Mail\MessageMail;
use App\Mail\MailScolarite;
use App\Mail\MailEnseignant;
use Carbon\Carbon;
use App\Models\Programme;
use App\Models\ECU;
use App\Models\UE;
use App\Models\Filiere;
use App\Models\Cycle;
use App\Models\Semestre;
use App\Models\Promotion;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Services\RolesService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Controllers\Controller;
use App\Models\Titre;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\CursorPaginator;
use App\Services\SuperviserProgramme;
use App\Http\Controllers\LogsController;
use Telegram;
//##########################################

class ProgrammeController extends Controller
{

    /**
     * Get a list of programms and group them by week.
     *
     * @return \Illuminate\Http\Response
     */

    private function programme( $type_id, $pagination )
    {
        //Récupération de la liste des programmes
        //Si c'est un Admin on recupère tout
        if( auth()->user()->getRoleNames()->contains('admin') or auth()->user()->getRoleNames()->contains('scolarite')){
            $programmes = DB::table('programmes')
        ->where('type_programme_id', '=', $type_id)
        ->join('e_c_u_s', 'e_c_u_s.id', '=', 'programmes.e_c_u_id')
        ->join('u_e_s', 'u_e_s.id', '=', 'e_c_u_s.u_e_id')
        ->join('filieres', 'filieres.id', '=', 'u_e_s.filiere_id')
        ->join('cycles', 'cycles.id', '=', 'u_e_s.cycle_id')
        ->join('semestres', 'semestres.id', '=', 'u_e_s.semestre_id')
        ->join('promotions', 'promotions.id', '=', 'programmes.promotion_id')
        ->orderBy('dateDebut', 'desc')
        ->select('programmes.id',
                'programmes.dateDebut',
                'programmes.dateFin',
                'programmes.h_Deb_Matin',
                'programmes.h_Fin_Matin',
                'programmes.h_Deb_Soir',
                'programmes.h_Fin_Soir',
                'programmes.commentaire',
                'programmes.public',
                'e_c_u_s.nom as nom_ecu',
                'filieres.name as filiere',
                'cycles.cycle as cycle',
                'semestres.intitule as semestre',
                'promotions.annee_entrer as promotion',
                'type_programme_id as type_programme'
        )->paginate($pagination);
        }else{
            $programmes = DB::table('programmes')
        ->where('programmes.user_id', '=', auth()->user()->id)
        ->where('type_programme_id', '=', $type_id)
        ->join('e_c_u_s', 'e_c_u_s.id', '=', 'programmes.e_c_u_id')
        ->join('u_e_s', 'u_e_s.id', '=', 'e_c_u_s.u_e_id')
        ->join('filieres', 'filieres.id', '=', 'u_e_s.filiere_id')
        ->join('cycles', 'cycles.id', '=', 'u_e_s.cycle_id')
        ->join('semestres', 'semestres.id', '=', 'u_e_s.semestre_id')
        ->join('promotions', 'promotions.id', '=', 'programmes.promotion_id')
        ->orderBy('dateDebut', 'desc')
        ->select('programmes.id',
                'programmes.dateDebut',
                'programmes.dateFin',
                'programmes.h_Deb_Matin',
                'programmes.h_Fin_Matin',
                'programmes.h_Deb_Soir',
                'programmes.h_Fin_Soir',
                'programmes.commentaire',
                'programmes.public',
                'e_c_u_s.nom as nom_ecu',
                'filieres.name as filiere',
                'cycles.cycle as cycle',
                'semestres.intitule as semestre',
                'promotions.annee_entrer as promotion',
                'type_programme_id as type_programme'
        )->paginate($pagination);
        }


        return $programmes;
    }

    public function coordonateurVoir( $type_id, $pagination )
    {
        //Récupération de la liste des programmes
        //Si c'est un Admin on recupère tout
        if(auth()->user()->getRoleNames()->contains('coordonateur')){
            $programmes = DB::table('programmes')
        ->where('type_programme_id', '=', $type_id)
        ->join('e_c_u_s', 'e_c_u_s.id', '=', 'programmes.e_c_u_id')
        ->join('u_e_s', 'u_e_s.id', '=', 'e_c_u_s.u_e_id')
        ->join('filieres', 'filieres.id', '=', 'u_e_s.filiere_id')
        ->join('cycles', 'cycles.id', '=', 'u_e_s.cycle_id')
        ->join('semestres', 'semestres.id', '=', 'u_e_s.semestre_id')
        ->join('promotions', 'promotions.id', '=', 'programmes.promotion_id')
        ->orderBy('dateDebut', 'desc')
        ->select('programmes.id',
                'programmes.dateDebut',
                'programmes.dateFin',
                'programmes.h_Deb_Matin',
                'programmes.h_Fin_Matin',
                'programmes.h_Deb_Soir',
                'programmes.h_Fin_Soir',
                'programmes.commentaire',
                'programmes.public',
                'e_c_u_s.nom as nom_ecu',
                'filieres.name as filiere',
                'cycles.cycle as cycle',
                'semestres.intitule as semestre',
                'promotions.annee_entrer as promotion',
                'type_programme_id as type_programme'
        )->paginate($pagination);
        //dd($programmes);
        return $programmes;
        }
    }
    public function indexVoir()
    {


        //dd($programmesOrdonnees);
        return view('unz_st.programme.indexVoir', [
            'cours' =>$this->coordonateurVoir( 1, 10 ) ,
            'examens' =>$this->coordonateurVoir( 2, 10 ),
            'autres' =>$this->coordonateurVoir( 3, 10 )
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('unz_st.programme.index', [
            'cours' =>$this->programme( 1, 10 ) ,
            'examens' =>$this->programme( 2, 10 ),
            'autres' =>$this->programme( 3, 10 )
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAcceuil()
    {
         
        return view('unz_st.programme.public');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //if(Gate::authorize('create', Programme::class));

        //appel de la vue
        //dd(auth()->user()->can('create', Programme::class));
        return view('unz_st.programme.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $verificateur = new SuperviserProgramme( $request );

        $satisfait = $verificateur->VERIFICATION_DES_CHAMPS();
        if( !$satisfait ){
            return view('unz_st.programme.create');
        }

        $satisfait = $verificateur->VERIFICATION_OCCUPATION();
        if( !$satisfait ){
            return view('unz_st.programme.create');
        }
        //dd("Je suis ici");
        //Enregistrement dans la BDD
        $programme = Programme::create([
            'type_programme_id' =>  $request->type,
            'dateDebut' =>  $request->date_debut,
            'dateFin' =>  $request->date_fin,
            'h_Deb_Matin' =>  $request->heure_debut_matin,
            'h_Fin_Matin' =>  $request->heure_fin_matin,
            'h_Deb_Soir' =>  $request->heure_debut_soir,
            'h_Fin_Soir' =>  $request->heure_fin_soir,
            'e_c_u_id' =>  $request->ecu,
            'salle_id' =>  $request->salle,
            'promotion_id' => $request->promotion,
            'user_id' => auth()->user()->id,
            'enseignant_id' => $request->enseignant,
            'commentaire' => $request->commentaire
        ]);
        
        //Enregistrement dans le log
        $type = '';
        switch( $request->type ){
            case 1 :
                $type = 'programme de cours';
                break;
            case 2 :
                $type = 'examen';
                break;
            case 3 :
                $type = 'programme de type autre';
                break;
            default:
                $type='';
                break;
        }
        LogsController::storeUserAction($programme, "Programme : Creation d un ".$type);
        return redirect()->route('programme.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $programme = DB::table('programmes')
        ->where('programmes.id', '=', $id)
        ->join('e_c_u_s', 'e_c_u_s.id', '=', 'programmes.e_c_u_id')
        ->join('u_e_s', 'u_e_s.id', '=', 'e_c_u_s.u_e_id')
        ->join('filieres', 'filieres.id', '=', 'u_e_s.filiere_id')
        ->join('cycles', 'cycles.id', '=', 'u_e_s.cycle_id')
        ->join('semestres', 'semestres.id', '=', 'u_e_s.semestre_id')
        ->join('promotions', 'promotions.id', '=', 'programmes.promotion_id')
        ->join('type_programmes', 'type_programmes.id', '=', 'programmes.type_programme_id')
        ->select('programmes.id',
                'programmes.dateDebut',
                'programmes.dateFin',
                'programmes.h_Deb_Matin',
                'programmes.h_Fin_Matin',
                'programmes.h_Deb_Soir',
                'programmes.h_Fin_Soir',
                'programmes.public',
                'programmes.user_id',
                'e_c_u_s.nom as nom_ecu',
                'filieres.name as filiere',
                'cycles.cycle as cycle',
                'semestres.intitule as semestre',
                'promotions.annee_entrer as promotion',
                'type_programmes.type as type_programme'
        )
        ->first();

        $prog = Programme::find($id);

        $salle = DB::table('salles')
        ->where('salles.id', $prog->salle_id)
        ->first();

        $enseignant = DB::table('users')
        ->where('users.id', $prog->enseignant_id)
        ->join('titres', 'titres.id', '=', 'users.titre_id')
        ->select('titres.titre', 'users.name', 'users.prenom')
        ->first();

        $coordonnateur = DB::table('users')
        ->where('users.id', $prog->user_id)
        ->join('titres', 'titres.id', '=', 'users.titre_id')
        ->select('titres.titre', 'users.name', 'users.prenom')
        ->first();


        //dd($programme);
        return view('unz_st.programme.show',[
            'programme' => $programme,
            'enseignant' => $enseignant,
            'coordonnateur' => $coordonnateur,
            'salle' => $salle
        ]);
    }


   /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function envoieSms(Request $request,$id)
    {


        try {
        $programme = DB::table('programmes')
        ->where('programmes.id', '=', $id)
        ->join('e_c_u_s', 'e_c_u_s.id', '=', 'programmes.e_c_u_id')
        ->join('u_e_s', 'u_e_s.id', '=', 'e_c_u_s.u_e_id')
        ->join('filieres', 'filieres.id', '=', 'u_e_s.filiere_id')
        ->join('cycles', 'cycles.id', '=', 'u_e_s.cycle_id')
        ->join('semestres', 'semestres.id', '=', 'u_e_s.semestre_id')
        ->join('promotions', 'promotions.id', '=', 'programmes.promotion_id')
        ->join('type_programmes', 'type_programmes.id', '=', 'programmes.type_programme_id')
        ->select('programmes.id',
                'programmes.dateDebut',
                'programmes.dateFin',
                'programmes.h_Deb_Matin',
                'programmes.h_Fin_Matin',
                'programmes.h_Deb_Soir',
                'programmes.h_Fin_Soir',
                'e_c_u_s.nom as nom_ecu',
                'filieres.name as filiere',
                'cycles.cycle as cycle',
                'semestres.intitule as semestre',
                'promotions.annee_entrer as promotion',
                'type_programmes.type as type_programme'
        )
        ->first();


        $prog = Programme::find($id);

        $salle = DB::table('salles')
        ->where('salles.id', $prog->salle_id)
        ->first();
        //dd($salle);

        $enseignant = DB::table('users')
        ->where('users.id', $prog->enseignant_id)
        ->join('titres', 'titres.id', '=', 'users.titre_id')
        ->select('titres.titre', 'users.name', 'users.prenom','users.email','users.telephone')
        ->first();

        $coordonnateur = DB::table('users')
        ->where('users.id', $prog->user_id)
        ->join('titres', 'titres.id', '=', 'users.titre_id')
        ->select('titres.titre', 'users.name', 'users.prenom','users.email','users.telephone')
        ->first();

        $scolarite = DB::table('users')
        ->where('menuroles','user,scolarite')
        ->join('titres', 'titres.id', '=', 'users.titre_id')
        ->select('titres.titre','users.email','users.name', 'users.prenom','users.telephone')
        ->first();

        if($programme->type_programme=='COURS'){
            $dataEnseignant = [
                'ecu'=>$programme->nom_ecu,
                'dateDebut' =>  $programme->dateDebut,
                'dateFin' => $programme->dateFin,
                'h_Deb_Matin' =>  $programme->h_Deb_Matin,
                'h_Fin_Matin' => $programme->h_Fin_Matin,
                'h_Deb_Soir' =>  $programme->h_Deb_Soir,
                'h_Fin_Soir' =>  $programme->h_Fin_Soir,
                'filiere'=> $programme->filiere,
                'cycle'=> $programme->cycle,
                'promotion'=> $programme->promotion,
                'semestre'=> $programme->semestre,
                'salle'=>$salle->nom,
                'titreE'=> $enseignant->titre,
                'prenomE'=> $enseignant->prenom,
                'nomE'=> $enseignant->name,
                'titre'=> $coordonnateur->titre,
                'prenom'=> $coordonnateur->prenom,
                
                'nom'=> $coordonnateur->name,
                'email'=>$enseignant->email
            ];

            if ($dataEnseignant['h_Deb_Matin'] && $dataEnseignant['h_Fin_Matin']) {
                $horaires = $dataEnseignant['h_Deb_Matin']."-".$dataEnseignant['h_Fin_Matin'];
            } elseif ($dataEnseignant['h_Deb_Soir'] && $dataEnseignant['h_Fin_Soir']) {
                $horaires =$dataEnseignant['h_Deb_Soir']."-".$dataEnseignant['h_Fin_Soir'];
            } else {
                $horaires = $dataEnseignant['h_Deb_Matin']."-".$dataEnseignant['h_Fin_Matin']."et".$dataEnseignant['h_Deb_Soir']."-".$dataEnseignant['h_Fin_Soir'];
            }

              $messages = "Cher ".$dataEnseignant['titreE']." ".$dataEnseignant['nomE'].", vous êtes programmé pour enseigner ".$dataEnseignant['ecu']." du ".$dataEnseignant['dateDebut']." au ".$dataEnseignant['dateFin']."de ".$horaires.".en : ".$dataEnseignant['salle']." avec ".$dataEnseignant['filiere']." ".$dataEnseignant['promotion'];
             $this->sendSms($messages ,  $enseignant->telephone);
             $request->session()->flash('message', 'Message envoyé avec succès'); 
             return redirect()->back();  
               //return $messages;         
               }
             elseif($programme->type_programme=='EXAMEN'){
            $dataScolirite = [
                'ecu'=>$programme->nom_ecu,
                'date' =>  $programme->dateDebut,
                'filiere'=> $programme->filiere,
                'cycle'=> $programme->cycle,
                'semestre'=> $programme->semestre,
                'promotion'=> $programme->promotion,
               'titreS'=> $scolarite->titre,
               'prenomS'=> $scolarite->prenom,
               'nomS'=> $scolarite->name,
                'titre'=> $coordonnateur->titre,
                'prenom'=> $coordonnateur->prenom,
                'nom'=> $coordonnateur->name,
               'emailS'=>$scolarite->email,
                'emailE'=>$enseignant->email,
                'titreE'=> $enseignant->titre,
                'prenomE'=> $enseignant->prenom,
                'nomE'=> $enseignant->name,
                'email'=> $coordonnateur->email,
                'tel'=> $coordonnateur->telephone,
                'telS'=>$scolarite->telephone,
                'telE'=>$enseignant->telephone
            ];
            $messages = "Cher ".$dataScolirite['nomS']." je tient a vous informez qu'un examen de ".$dataScolirite['ecu']." avec ".$dataScolirite['filiere']." est prevue pour le ".$dataScolirite['date']." pour plus d'info veuillez consultez votre telegramme.Merci! coordonateur: ".$dataScolirite['nom'];
          //  return $messages;
         $this->sendSms($messages , $dataScolirite['telS']);
         $request->session()->flash('message', 'Message envoyé avec succès'); 
         return redirect()->back();  
         
       };
    } catch (\Exception $e) {
        echo "Une erreur s'est produite : " . $e->getMessage();
      }
}
    



   /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function envoieMail(Request $request,$id)
    {
        try {

        $programme = DB::table('programmes')
        ->where('programmes.id', '=', $id)
        ->join('e_c_u_s', 'e_c_u_s.id', '=', 'programmes.e_c_u_id')
        ->join('u_e_s', 'u_e_s.id', '=', 'e_c_u_s.u_e_id')
        ->join('filieres', 'filieres.id', '=', 'u_e_s.filiere_id')
        ->join('cycles', 'cycles.id', '=', 'u_e_s.cycle_id')
        ->join('semestres', 'semestres.id', '=', 'u_e_s.semestre_id')
        ->join('promotions', 'promotions.id', '=', 'programmes.promotion_id')
        ->join('type_programmes', 'type_programmes.id', '=', 'programmes.type_programme_id')
        ->select('programmes.id',
                'programmes.dateDebut',
                'programmes.dateFin',
                'programmes.h_Deb_Matin',
                'programmes.h_Fin_Matin',
                'programmes.h_Deb_Soir',
                'programmes.h_Fin_Soir',
                'e_c_u_s.nom as nom_ecu',
                'filieres.name as filiere',
                'cycles.cycle as cycle',
                'semestres.intitule as semestre',
                'promotions.annee_entrer as promotion',
                'type_programmes.type as type_programme'
        )
        ->first();


        $prog = Programme::find($id);

        $salle = DB::table('salles')
        ->where('salles.id', $prog->salle_id)
        ->first();
        //dd($salle);

        $enseignant = DB::table('users')
        ->where('users.id', $prog->enseignant_id)
        ->join('titres', 'titres.id', '=', 'users.titre_id')
        ->select('titres.titre', 'users.name', 'users.prenom','users.email','users.telephone')
        ->first();

        
        $coordonnateur = DB::table('users')
        ->where('users.id', $prog->user_id)
        ->join('titres', 'titres.id', '=', 'users.titre_id')
        ->select('titres.titre', 'users.name', 'users.prenom','users.email','users.telephone')
        ->first();

        $scolarite = DB::table('users')
        ->where('menuroles','user,scolarite')
        ->join('titres', 'titres.id', '=', 'users.titre_id')
        ->select('titres.titre','users.email','users.name', 'users.prenom','users.telephone')
        ->first();




        if($programme->type_programme=='COURS'){

            $dataEnseignant = [
                'ecu'=>$programme->nom_ecu,
                'dateDebut' =>  $programme->dateDebut,
                'dateFin' => $programme->dateFin,
                'h_Deb_Matin' =>  $programme->h_Deb_Matin,
                'h_Fin_Matin' => $programme->h_Fin_Matin,
                'h_Deb_Soir' =>  $programme->h_Deb_Soir,
                'h_Fin_Soir' =>  $programme->h_Fin_Soir,
                'filiere'=> $programme->filiere,
                'cycle'=> $programme->cycle,
                'promotion'=> $programme->promotion,
                'semestre'=> $programme->semestre,
                'salle'=>$salle->nom,
                'titreE'=> $enseignant->titre,
                'prenomE'=> $enseignant->prenom,
                'nomE'=> $enseignant->name,
                'titre'=> $coordonnateur->titre,
                'prenom'=> $coordonnateur->prenom,
                'nom'=> $coordonnateur->name,
                'email'=>$enseignant->email
            ];
        //  return $dataEnseignant;

         Mail::to( $dataEnseignant['email'])->send(new MessageMail($dataEnseignant));
         $request->session()->flash('message', 'Mail envoyé avec succès');
         return redirect()->route('programme.index');
        }
        elseif($programme->type_programme=='EXAMEN'){

            $dataScolirite = [
                'ecu'=>$programme->nom_ecu,
                'date' =>  $programme->dateDebut,
                'filiere'=> $programme->filiere,
                'cycle'=> $programme->cycle,
                'semestre'=> $programme->semestre,
                'promotion'=> $programme->promotion,
                'titreS'=> $scolarite->titre,
                'prenomS'=> $scolarite->prenom,
                'nomS'=> $scolarite->name,
                'titre'=> $coordonnateur->titre,
                'prenom'=> $coordonnateur->prenom,
                'nom'=> $coordonnateur->name,
                'emailS'=>$scolarite->email,
                'emailE'=>$enseignant->email,
                'titreE'=> $enseignant->titre,
                'prenomE'=> $enseignant->prenom,
                'nomE'=> $enseignant->name,
                'tel'=>$enseignant->telephone
            ];
        //return $dataScolirite; 
            Mail::to($dataScolirite['emailE'])->send(new MailEnseignant($dataScolirite));

            Mail::to($dataScolirite['emailS'])->send(new MailScolarite($dataScolirite));
            $request->session()->flash('message', 'Mail envoyé avec succès');
            return redirect()->route('programme.index');
       };
    } catch (\Exception $e) {
        echo "Une erreur s'est produite : " . $e->getMessage();
      }

    }




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function envoieTelegramme(Request $request,$id)
    {
        try{

        $programme = DB::table('programmes')
        ->where('programmes.id', '=', $id)
        ->join('e_c_u_s', 'e_c_u_s.id', '=', 'programmes.e_c_u_id')
        ->join('u_e_s', 'u_e_s.id', '=', 'e_c_u_s.u_e_id')
        ->join('filieres', 'filieres.id', '=', 'u_e_s.filiere_id')
        ->join('cycles', 'cycles.id', '=', 'u_e_s.cycle_id')
        ->join('semestres', 'semestres.id', '=', 'u_e_s.semestre_id')
        ->join('promotions', 'promotions.id', '=', 'programmes.promotion_id')
        ->join('type_programmes', 'type_programmes.id', '=', 'programmes.type_programme_id')
        ->select('programmes.id',
                'programmes.dateDebut',
                'programmes.dateFin',
                'programmes.h_Deb_Matin',
                'programmes.h_Fin_Matin',
                'programmes.h_Deb_Soir',
                'programmes.h_Fin_Soir',
                'e_c_u_s.nom as nom_ecu',
                'filieres.name as filiere',
                'cycles.cycle as cycle',
                'semestres.intitule as semestre',
                'promotions.annee_entrer as promotion',
                'type_programmes.type as type_programme'
        )
        ->first();


        $prog = Programme::find($id);

        $salle = DB::table('salles')
        ->where('salles.id', $prog->salle_id)
        ->first();
        //dd($salle);

        $enseignant = DB::table('users')
        ->where('users.id', $prog->enseignant_id)
        ->join('titres', 'titres.id', '=', 'users.titre_id')
        ->select('titres.titre', 'users.name', 'users.prenom','users.email','users.telephone','users.user_id')
        ->first();

        $coordonnateur = DB::table('users')
        ->where('users.id', $prog->user_id)
        ->join('titres', 'titres.id', '=', 'users.titre_id')
        ->select('titres.titre', 'users.name', 'users.prenom','users.email','users.telephone','users.user_id')
        ->first();

        $scolarite = DB::table('users')
        ->where('menuroles','user,scolarite')
        ->join('titres', 'titres.id', '=', 'users.titre_id')
        ->select('titres.titre','users.email','users.name', 'users.prenom','users.telephone','users.user_id')
        ->first();


        if($programme->type_programme=='COURS'){
            $dataEnseignant = [
                'ecu'=>$programme->nom_ecu,
                'dateDebut' =>  $programme->dateDebut,
                'dateFin' => $programme->dateFin,
                'h_Deb_Matin' =>  $programme->h_Deb_Matin,
                'h_Fin_Matin' => $programme->h_Fin_Matin,
                'h_Deb_Soir' =>  $programme->h_Deb_Soir,
                'h_Fin_Soir' =>  $programme->h_Fin_Soir,
                'filiere'=> $programme->filiere,
                'cycle'=> $programme->cycle,
                'promotion'=> $programme->promotion,
                'semestre'=> $programme->semestre,
                'salle'=>$salle->nom,
                'titreE'=> $enseignant->titre,
                'prenomE'=> $enseignant->prenom,
                'nomE'=> $enseignant->name,
                'titre'=> $coordonnateur->titre,
                'prenom'=> $coordonnateur->prenom,
                'nom'=> $coordonnateur->name,
                'email'=>$enseignant->email,
                'mail'=> $coordonnateur->email,
                'user_id'=>$enseignant->user_id,
                'tel'=> $coordonnateur->telephone
            ];
            
            if ($dataEnseignant['h_Deb_Matin'] && $dataEnseignant['h_Fin_Matin']) {
                $horaires = $dataEnseignant['h_Deb_Matin']."-".$dataEnseignant['h_Fin_Matin'];
            } elseif ($dataEnseignant['h_Deb_Soir'] && $dataEnseignant['h_Fin_Soir']) {
                $horaires =$dataEnseignant['h_Deb_Soir']."-".$dataEnseignant['h_Fin_Soir'];
            } else {
                $horaires = $dataEnseignant['h_Deb_Matin']."-".$dataEnseignant['h_Fin_Matin']."et".$dataEnseignant['h_Deb_Soir']."-".$dataEnseignant['h_Fin_Soir'];
            }
            $userId=$dataEnseignant['user_id'];
            
            

            $messages = "Cher/Chère " .  $dataEnseignant['titreE']. " " . $dataEnseignant['prenomE'] . " " .   $dataEnseignant['nomE'] . ",

              J'espère que vous allez bien. Je tiens à vous informer que vous êtes programmé pour dispenser le cours". $dataEnseignant['ecu'] . "dans le cadre du programme suivant :
    
           Du ".$dataEnseignant['dateDebut']." au ".$dataEnseignant['dateFin'].
           "  de ".$horaires."
            - Filière : " . $dataEnseignant['filiere']. "
           - Cycle : " . $dataEnseignant['cycle'] . "
           - Promotion : " . $dataEnseignant['promotion'] . "
            - Semestre : " . $dataEnseignant['semestre'] . "
            - Salle : " . $dataEnseignant['salle'] . "

           Si vous avez des questions ou besoin de plus d'informations, n'hésitez pas à me contacter. Je suis là pour vous aider.

          Cordialement,

          " .$dataEnseignant['titre']. " " . $dataEnseignant['prenom']. " " . $dataEnseignant['nom'] . "
          Email : " .  $dataEnseignant['mail'] . "
          Téléphone : " .  $dataEnseignant['tel'] . "
          ";
             $this->envoyerMessagetelegrammer($userId, $messages); 
             $request->session()->flash('message', 'Message envoyé avec succès'); 
             return redirect()->back();
               }
             elseif($programme->type_programme=='EXAMEN'){
            $dataScolarite = [
                'ecu'=>$programme->nom_ecu,
                'date' =>  $programme->dateDebut,
                'filiere'=> $programme->filiere,
                'cycle'=> $programme->cycle,
                'semestre'=> $programme->semestre,
                'promotion'=> $programme->promotion,
               'titreS'=> $scolarite->titre,
               'prenomS'=> $scolarite->prenom,
               'nomS'=> $scolarite->name,
                'titre'=> $coordonnateur->titre,
                'prenom'=> $coordonnateur->prenom,
                'nom'=> $coordonnateur->name,
               'emailS'=>$scolarite->email,
                'emailE'=>$enseignant->email,
                'titreE'=> $enseignant->titre,
                'prenomE'=> $enseignant->prenom,
                'nomE'=> $enseignant->name,
                'email'=> $coordonnateur->email,
                'tel'=> $coordonnateur->telephone,
                'telS'=>$scolarite->telephone,
                'user_id'=>$scolarite->user_id,
                'telE'=>$enseignant->telephone
            ];
           
           $messages = "Cher/Chère " . $dataScolarite['titreS'] . " " . $dataScolarite['prenomS'] . " " . $dataScolarite['nomS'] . ",\n" .
            "Nous souhaitons vous informer qu'un examen est prévu dans le cadre du programme suivant :\n" .
            "Module : " . $dataScolarite['ecu'] . "\n" .
            "Date : " . $dataScolarite['date'] . "\n" .
            "Filière : " . $dataScolarite['filiere'] . "\n" .
            "Promotion : " . $dataScolarite['promotion'] . "\n" .
            "L'enseignant responsable de cet examen est :\n" .
            $dataScolarite['titreE'] . " " . $dataScolarite['prenomE'] . " " . $dataScolarite['nomE'] . "\n" .
            "Email : " . $dataScolarite['emailE'] . "\n" .
            "Téléphone : " . $dataScolarite['telE'] . "\n" .
            "Veuillez noter que cette information est fournie à titre de notification et que toute communication ultérieure concernant cet examen devrait être adressée à l'enseignant responsable.\n" .
            "Si vous avez des questions ou avez besoin de plus d'informations, n'hésitez pas à me contacter.\n" .
            "Cordialement,\n" .
            $dataScolarite['titre'] . " " . $dataScolarite['prenom'] . " " . $dataScolarite['nom'] . "\n" .
            "Email : " . $dataScolarite['email'] . "\n" .
            "Téléphone : " . $dataScolarite['tel'] . "\n" .
            "Merci !";
        
            $this->envoyerMessagetelegrammer($userId, $messages);
           $request->session()->flash('message', 'Message envoyé avec succès'); 
            return redirect()->back();  
                  
       };
    }  catch (\Exception $e) {
        echo "Une erreur s'est produite : " . $e->getMessage();
      }


    }    


    public function envoyerMessagetelegrammer($userId, $message)
    { 
        try {
        Telegram::sendMessage([
            'chat_id' => $userId,
            'text' => $message,
        ]);
        if ($response['ok']) {
            // L'envoi du message a réussi
            return "Message envoyé avec succès";
        } else {
            // L'envoi du message a échoué
            return "Échec de l'envoi du message : " . $response['description'];
        }
            } catch (\Exception $e) {
             // Gérer les exceptions lors de l'envoi du message
             return "Erreur lors de l'envoi du message : " . $e->getMessage();
                }
   }

        private function sendSms($msg, $recipients)
        {
             $smsContent=[
            "from"=>"unz",
            "to"=>[$recipients],
            "text"=>$msg
        ];
       
        $jsonContent = json_encode($smsContent);

        $API_KEY_HERE=' 71ae2f70-bb43-4551-a0aa-4777b19c4405';

        $ch = curl_init("https://www.aqilas.com/api/v1/sms");
        $header=array('Content-Type: application/json',"X-AUTH-TOKEN: $API_KEY_HERE");
        
        curl_setopt($ch,CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch,CURLOPT_POST, 1);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $jsonContent);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $json_response = curl_exec($ch);
        
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $response = json_decode($json_response, true);
        curl_close($ch);
        
        if ( $status == 201 or $status == 200 ) {
            //return redirect()->route('programme.show');
            echo("Message envoyé avec succès {$response['bulk_id']}");
        }else die("Error: {$response['message']} ");
            return $json_response;  


    }
    




    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('unz_st.programme.update',[
            'id' => $id
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function publicUpdate(Request $request, $id){

        if( $request->has('marker') && $request->marker == 'publier' ){
            $programme = Programme::find($id);

            if( $programme->type_programme_id === 1){
                if( $programme->dateFin < today()->toDateString() ){

                    $request->session()->flash('message', "Cet programme est obselete, vous ne pouvez pas le publier");
                    return redirect()->route('programme.show',
                            ['programme' => $id]);
                }
            }
            elseif ( $programme->type_programme_id === 2 ) {
                if( $programme->dateDebut < today()->toDateString() ){

                    $request->session()->flash('message', "Cet programme est obselete, vous ne pouvez pas le publier");
                    return redirect()->route('programme.show',
                            ['programme' => $id]);
                }
            }

            $programme->public = 'true';
            $programme->save();

            //Enregistrement dans le log
            $type = '';
            switch( $programme->type_programme_id ){
                case 1 :
                    $type = 'programme de cours';
                    break;
                case 2 :
                    $type = 'examen';
                    break;
                case 3 :
                    $type = 'programme de type autre';
                    break;
                default:
                    $type='';
                    break;
            }
            LogsController::storeUserAction($programme, "Programme : Publication d un ".$type);

            $request->session()->flash('message', 'Programme publié avec succès');
            return view('unz_st.programme.public');
        }
    }

    public function update(Request $request, $id)
    {

        if( $request->has('marker') && $request->marker == 'modifier' ){
            $programme = Programme::find($id);
            $programme->dateDebut = $request->date_debut;
            $programme->dateFin = $request->date_fin;
            $programme->h_Deb_Matin = $request->heure_debut_matin;
            $programme->h_Fin_Matin = $request->heure_fin_matin;
            $programme->h_Deb_Soir = $request->heure_debut_soir;
            $programme->h_Fin_Soir = $request->heure_fin_soir;
            $programme->commentaire = $request->commentaire;
            $programme->type_programme_id = $request->type;
            $programme->e_c_u_id = $request->ecu;
            $programme->salle_id = $request->salle_id;
            $programme->promotion_id = $request->promotion;
            $programme->enseignant_id = $request->enseignant;
            $programme->public = 'false';
            $programme->save();
            //Logging de l action
            LogsController::storeUserAction($programme, "Programme : Update : modification du programme ");
        }
        elseif (  $request->has('marker') && $request->marker == 'scolarite'  ) {
            $programme = Programme::find($id);
            $programme->h_Deb_Matin = $request->heure_debut_matin;
            $programme->h_Deb_Soir = $request->heure_debut_soir;
            $programme->salle_id = $request->salle_id;
            $programme->save();
            //Logging de l action
            LogsController::storeUserAction($programme, "Programme : Update : La scolarité met a jour les informations d un examen");
        }

        return redirect()->route('programme.show',
            ['programme' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        //Logging de l action
        LogsController::storeUserAction(Programme::find($id), "Programme : Destroy : Suppression d un programme");
        Programme::destroy($id);
        $request->session()->flash('message', 'Programme supprimé avec succès');
        return redirect()->route('programme.index');
    }

//<<<<<<< Updated upstream

    // Generate PDF
    public function createPDF(Request $request) {
        
        return PDF::loadHtml($request->html)
            ->download($request->pdfName.".pdf");
    }

    //Generate PDF for exams
    public function createExamPDF(){
        //Recuperation de la liste des examens
        $liste_examens = Programme::where('type_programme_id', '=', 2)
                            ->where('dateDebut', '>=', today())
                            ->orderBy('dateDebut')
                            ->get();
        //Le tableau contenant toute les infos pour la vue
        $examens = [];
        foreach ($liste_examens as $key => $exam) {
            $examen = [];
            if( !is_null($exam->h_Deb_Matin) ){
                $examen['heureDebut'] = $exam->h_Deb_Matin;
            }
            elseif (!is_null($exam->h_Deb_Soir)) {
                $examen['heureDebut'] = $exam->h_Deb_Soir;
            }
            else{
                $examen['heureDebut'] = null;
            }
            $enseignant = User::find($exam->enseignant_id);
            $titre = Titre::find($enseignant->titre_id);
            $ecu = ECU::find($exam->e_c_u_id);
            $ue = UE::find($ecu->u_e_id);
            $filiere = Filiere::find($ue->filiere_id);
            $cycle = Cycle::find($ue->cycle_id);
            $semestre = Semestre::find($ue->semestre_id);
            $promotion = Promotion::find($exam->promotion_id);

            $examen['date'] = $exam->dateDebut;
            $examen['ue'] = $ue->nom;
            $examen['ecu'] = $ecu->nom;
            $examen['filiere'] = $filiere->name;
            $examen['cycle'] = $cycle->cycle;
            $examen['semestre'] = $semestre->intitule;
            $examen['promotion'] = $promotion->annee_entrer;
            $examen['enseignant'] = $titre->titre.' '.$enseignant->prenom.' '.$enseignant->name;

            array_push($examens, $examen);
        }
        
        //Logging de l action
        LogsController::storeAction("Programme : Telecharger : Telechargement de la liste des examens");
        return PDF::loadView('unz_st.programme.examenPDF', ['examens' => $examens])
        ->download('Examens a partir du '.today().'.pdf');
    }

//=======

//>>>>>>> Stashed changes
}
