<?php

namespace App\Http\Controllers\unz;

use App\Http\Controllers\Controller;
use App\Models\Etudiant;
use App\Models\Filiere;
use App\Models\Promotion;
use App\Models\Cycle;
use App\Models\Semestre;
use Illuminate\Http\Request;
use App\Imports\EtudiantImport;
use App\Imports\AddOneEtudiant;
use App\Http\Controllers\LogsController;
use Maatwebsite\Excel\Facades\Excel;

class EtudiantController extends Controller
{

    private $storeFolder;
    private $storeFileName;

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function importEtudiant(Request $request){
        $request->validate([
            'liste' => 'required|file|mimes:xlsx',
            'promotion' => 'required',
            'cycle' => 'required'
        ]);
        $import = new EtudiantImport($request->promotion, $request->cycle);
        $import->import($request->file('liste'));
        if( $import->isSuccess ){
            $promotion = Promotion::find($request->promotion);
            $filiere = Filiere::find($promotion->filiere_id);
            $cycle = Cycle::find($request->cycle);
            $desc = "Etudiant : Importation de la liste des etudiants : Filiere: ".$filiere->name." Promotion: ".$promotion->annee_entrer." Cycle: ".$cycle->cycle;
            LogsController::storeAction($desc);
            return redirect()->route('etudiant.index')->with('success', 'Importer avec success');
        }else{
            return redirect()->route('etudiant.index')->with('erreur', 'Impossible d importer : '.$import->message);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('unz_st.scolarite.etudiant-index');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('unz_st.scolarite.etudiant-create-form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'ine' => ['required', 'unique:etudiants,ine']
        ]);

        if($request->genre === "masculin"){
            if( $request->ine[-1] != '1'){ //Si le dernier chiffre est 1 c est un masculin
                return redirect()->route('etudiant.create')->with('erreur', 'INE incompatible avec le genre');
            }
        }else{
            if( $request->ine[-1] != '2'){ //Si le dernier chiffre est 2 c est un feminin
                return redirect()->route('etudiant.create')->with('erreur', 'INE incompatible avec le genre');
            }
        }

        $etudiant = Etudiant::make([
            'ine' => $request->ine,
            'genre' => $request->genre,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'nee_le' => $request->date_naissance,
            'promotion_id' => $request->promotion,
            'cycle_id' => $request->cycle,
            'historique' => $request->historique
        ]);
        $etudiant->save();
        //$this->storePath($request);
        //$addtoList = new AddOneEtudiant($etudiant, $this->storeFolder.$this->storeFileName);
        //Excel::import($addtoList, $this->storeFolder.$this->storeFileName);
        LogsController::storeAction("Etudiant : Ajout de ".$etudiant->ine." ".$etudiant->nom." ".$etudiant->prenom);
        return redirect()->route('etudiant.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function show(Etudiant $etudiant)
    {   
        $promotion = $etudiant->promotion->annee_entrer;
        $cycle = $etudiant->cycle->cycle;
        $cycles = Cycle::all();
        return view('unz_st.scolarite.etudiant-show', 
        [
            'etudiant'=>$etudiant, 
            'promotion'=>$promotion,
            'cycle'=>$cycle,
            'cycles'=>$cycles,
            'historique'=>$etudiant->historiqueToArray()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function edit(Etudiant $etudiant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Etudiant $etudiant)
    {
        $etudiant->ine = $request->ine;
        $etudiant->nom = $request->nom;
        $etudiant->prenom = $request->prenom;
        $etudiant->nee_le = $request->nee_le;
        $etudiant->promotion_id = $request->promotion;
        $etudiant->cycle_id = $request->cycle;
        $etudiant->historique = $request->historique;
        $etudiant->save();
        return redirect()->route('etudiant.show', ['etudiant'=>$request->ine]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Etudiant $etudiant)
    {
        //
    }
}
