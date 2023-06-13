<?php
// Gérer la fenetre modal pour la selection de la personne

namespace App\Http\Controllers\unz;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\EnregMat;
use App\Models\Materiel;
use App\Models\TypeMateriel;
use App\Models\User;
use App\Http\Controllers\LogsController;

class EnregMatController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $enregistrements = DB::table('enreg_mats')
        ->orderBy('enreg_mats.date', 'asc')
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

        return view('unz_st.enregMat.index',[
            'enregistrements' => $enregistrements
        ]);
    }

    /**
     * Affiche les statistiques d un materiel données 
     *
     * @return \Illuminate\Http\Response
     */
    public function statistiques()
    {

        return view('unz_st.enregMat.statistiques');
    }

    //Son roles est de récupéere tout les enregistrement
    private function getEnregistrement( $request, $materiel_id ){
        $enregistrements = DB::table('enreg_mats')->where('enreg_mats.materiel_id', '=', $materiel_id);
        //Si la date de début existe
        if( !is_null($request->debut) ){
            //Si la date de fin existe
            if (!is_null($request->fin)) {
                $enregistrements = $enregistrements->whereBetween('enreg_mats.date', [$request->debut, $request->fin] );
            }
            //Si la date de fin n existe pas
            else{
                $enregistrements = $enregistrements->where('enreg_mats.date', '>=', $request->debut);
            }
        }
        //Si la date de debut n existe pas
        else{
            //Si la date de fin existe
            if (!is_null($request->fin)) {
                $enregistrements = $enregistrements->where('enreg_mats.date', '<=', $request->fin);
            }
            //Si la date de fin n existe pas
            else{

            }
        }

        $enregistrements = $enregistrements->orderBy('enreg_mats.date', 'desc')
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
        return $enregistrements;
    }


    //Son role est de recupérer les données en fonction des dates de début et de fin
    private function getData( $request ){
        $enregistrements = null;
        //Si la date de début existe
        if( !is_null($request->debut) ){
            //Si la date de fin existe
            if (!is_null($request->fin)) {
                $enregistrements = DB::table('enreg_mats')
                    ->where('enreg_mats.materiel_id', '=', $request->materiel_id)
                    ->whereBetween('enreg_mats.date', [$request->debut, $request->fin] )
                    ->orderBy('date')
                    ->get();
            }
            //Si la date de fin n existe pas
            else{
                $enregistrements = DB::table('enreg_mats')
                    ->where('enreg_mats.materiel_id', '=', $request->materiel_id)
                    ->where('enreg_mats.date', '>=', $request->debut)
                    ->orderBy('date')
                    ->get();
            }
        }
        //Si la date de debut n existe pas
        else{
            //Si la date de fin existe
            if (!is_null($request->fin)) {
                $enregistrements = DB::table('enreg_mats')
                    ->where('enreg_mats.materiel_id', '=', $request->materiel_id)
                    ->where('enreg_mats.date', '<=', $request->fin)
                    ->orderBy('date')
                    ->get();
            }
            //Si la date de fin n existe pas
            else{
                $enregistrements = DB::table('enreg_mats')
                    ->where('enreg_mats.materiel_id', '=', $request->materiel_id)
                    ->orderBy('date')
                    ->get();
            }
        }

        return $enregistrements;
    }

    //Son roles est de générer les données pour le graphe
    private function createData( $enregistrements ){
        $data = array();
        $labels = array();
        $dataEntre = array();
        $dataSortie = array();
        $dataRetour = array();

        foreach ($enregistrements as $key => $enreg) {
            //Si la clé existe on peut faire une incrementation
            if( in_array($enreg->date, $labels) ){
                $key = array_search($enreg->date, $labels);
                switch ($enreg->type_enreg_id) {
                    case 1:
                        $dataEntre[$key] = $dataEntre[$key] + $enreg->quantite;
                        break;

                    case 2:
                        $dataSortie[$key] = $dataSortie[$key] + $enreg->quantite;
                        break;

                    case 3:
                        $dataRetour[$key] = $dataRetour[$key] + $enreg->quantite;
                    
                    default:
                        break;
                }
            }
            //Sinon on ajoute et fait une initialisation
            else{
                array_push($labels, $enreg->date);
                switch ($enreg->type_enreg_id) {
                    case 1:
                        array_push($dataEntre, $enreg->quantite);
                        array_push($dataSortie, 0);
                        array_push($dataRetour, 0);
                        break;

                    case 2:
                        array_push($dataEntre, 0);
                        array_push($dataSortie, $enreg->quantite);
                        array_push($dataRetour, 0);
                        break;

                    case 3:
                        array_push($dataEntre, 0);
                        array_push($dataSortie, 0);
                        array_push($dataRetour, $enreg->quantite);
                        break;
                    
                    default:
                        break;
                }
            }
        }

        array_push($data, $labels);
        array_push($data, $dataEntre);
        array_push($data, $dataSortie);
        array_push($data, $dataRetour);

        return $data;
    }

    public function showStatistique( Request $request )
    {
        $materiel = Materiel::findOrFail($request->materiel_id);
        $materiel_name = $materiel->name;

        $typeMat = TypeMateriel::findOrFail($materiel->type_materiel_id);
        $typeMat_name = $typeMat->type;



        //On enocde les données en JSON pour les utiliser dans le JavaScript
        $data = json_encode( $this->createData( $this->getData( $request ) )  );

        return view('unz_st.enregMat.showStatistiques',[
            'materiel_name' => $materiel_name,
            'typeMat_name' => $typeMat_name,
            'data' => $data,
            'debut' => $request->debut,
            'fin' => $request->fin,
            'enregistrements' => $this->getEnregistrement( $request, $request->materiel_id )
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('unz_st.enregMat.create');
    }

    /**
     * Store a newly created resource in storage.
     *'user_id' => ,
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = 'Enregistré avec succès';
        $logMessage = '';

        $materiel = Materiel::find($request->materiel_id);
        if($request->typeEnreg == 2){
            $materiel->quantite = $request->quantite_avant_enreg - $request->quantite;
        }else{
            $materiel->quantite = $request->quantite_avant_enreg + $request->quantite;
        }

        $enreg = new EnregMat();
        $enreg->date = today()->toDateString();
        $enreg->quantite = $request->quantite;
        $enreg->quantite_avant_enreg = $request->quantite_avant_enreg;
        $enreg->type_enreg_id = $request->typeEnreg;
        $enreg->materiel_id = $request->materiel_id;
        $enreg->user_id = $request->user_id;

        //Si c est une Entré
        if($request->typeEnreg == 1){
            $enreg->achever = true;
            $logMessage = 'Enregistrement Materiel : Entre de '.$request->quantite.' '.$materiel->name;
        }
        //Si c est une sortie
        elseif ($request->typeEnreg == 2) {
            //De materiel consommable
            if( $request->type_materiel == 1){
                $enreg->achever = true;
            }
            //De materiel non consommable
            else{
                $enreg->achever = false;
            }
            $logMessage = 'Enregistrement Materiel : Sortie de '.$request->quantite.' '.$materiel->name;
        }
        //Si c est un retour
        elseif ($request->typeEnreg == 3) {
            //On recherche la sortie non achevé que la personne avait effectué
            $result = EnregMat::where('materiel_id', '=', $request->materiel_id)
            ->where('user_id', '=', $request->user_id)
            ->where('achever', '=', false)
            ->get();
            //Si on a rien trouvée
            if( count($result) == 0){ 
                $user = User::findOrFail($request->user_id);
                $materiel = Materiel::find($request->materiel_id);
                $message = '';
                $message = $user->name." ".$user->prenom." n'avait pas pris de ".$materiel->name;
                $request->session()->flash('message', $message);
                return view('unz_st.enregMat.create');
            }
            //Si on a quelque chose
            else{
                $total = 0;
                foreach ($result as $key => $value) {
                    //Les sorties sont comptés négativement
                    if($value->type_enreg_id == 2){
                        $total = $total - $value->quantite;
                    }
                    elseif ($value->type_enreg_id == 3) {
                        $total = $total + $value->quantite;
                    }
                }
                $total = $total + $request->quantite;
                if( $total < 0 ){
                    $materiel = Materiel::find($request->materiel_id);
                    $enreg->achever = false;
                    $message = '';
                    $message = 'Enregistré avec succès. Mai il reste encore '.(-$total).' '.$materiel->name;
                    $logMessage = 'Enregistrement Materiel : Retour de '.$request->quantite.' '.$materiel->name;
                }
                elseif ($total > 0) {
                    $user = User::findOrFail($request->user_id);
                    $materiel = Materiel::find($request->materiel_id);
                    $message = $user->name.' '.$user->prenom.' n\'avait pas pris autant de '.$materiel->name;
                $request->session()->flash('message', $message);
                return view('unz_st.enregMat.create');
                }
                elseif ($total == 0) {
                    foreach ($result as $key => $value) {
                        $value->achever = true;
                        $value->save();
                    }
                    $enreg->achever = true;
                    $logMessage = 'Enregistrement Materiel : Retour de '.$request->quantite.' '.$materiel->name;
                }
            }
        }
        $materiel->save();
        $enreg->save();
        
        //Sauvegarde dans le log
        LogsController::storeUserAction($enreg, $logMessage);
        
        $request->session()->flash('message', $message);
        return redirect()->route('enregMat.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
