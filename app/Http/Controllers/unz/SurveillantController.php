<?php

namespace App\Http\Controllers\unz;

use App\Http\Controllers\Controller;

use App\Models\Surveillant;
use Illuminate\Http\Request;
use App\Imports\surveillantImport;
use App\Http\Controllers\LogsController;
use Illuminate\Support\Facades\Storage;

class SurveillantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('unz_st.scolarite.surveillant-index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('unz_st.scolarite.surveillant-create-form');
    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function importSurveillant(Request $request){
        $request->validate([
            'liste' => 'required|file|mimes:xlsx',
        ]);
        $import = new surveillantImport();
        $import->import($request->file('liste'));
        if( $import->isSuccess ){
            LogsController::storeAction("Surveillant : Importation de la liste des surveillants");
            return redirect()->route('surveillant.index')->with('success', 'Importer avec success');
        }else{
            return redirect()->route('surveillant.index')->with('erreur', 'Impossible d importer : '.$import->message);
        }
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
            'cnib' => ['required', 'unique:surveillants,cnib']
        ]);

        $surveillant = Surveillant::create([
            'cnib' => $request->ine,
            'genre' => $request->genre,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
        ]);
        LogsController::storeUserAction($surveillant, "Surveillant : Ajout de ".$surveillant->cnib." ".$surveillant->nom." ".$surveillant->prenom);
        return redirect()->route('surveillant.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Surveillant  $surveillant
     * @return \Illuminate\Http\Response
     */
    public function show(Surveillant $surveillant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Surveillant  $surveillant
     * @return \Illuminate\Http\Response
     */
    public function edit(Surveillant $surveillant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Surveillant  $surveillant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Surveillant $surveillant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Surveillant  $surveillant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Surveillant $surveillant)
    {
        //
    }
}
