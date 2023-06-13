<?php

namespace App\Http\Controllers\unz;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LogsController;
use Illuminate\Http\Request;
use App\Models\Materiel;
use App\Http\Middleware\csaf;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;

class MaterielController extends Controller
{

    public function testeur($id){
        $val = $id;
        Storage::put("fichierTest.txt", "-[$val]groupes");
        return redirect()->route('evaluation');
        //return view('unz_st.scolarite.evaluation-index');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('unz_st.materiel.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('unz_st.materiel.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $materiel = Materiel::create([
            'name' => $request->name,
            'quantite' => $request->quantite,
            'type_materiel_id' => $request->type_materiel_id
        ]);
        //Sauvegarde dans le log
        LogsController::storeUserAction($materiel, "Materiel : store (quantite= ".$materiel->quantite.";name= ".$materiel->name.")");
        
        return redirect()->route('materiel.index');
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
        $materiel = Materiel::find($id);
        return view('unz_st.materiel.edit',[
            'materiel' => $materiel
        ]);
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
        $materiel = Materiel::find($id);
        $materiel->name = $request->name;
        $materiel->quantite = $request->quantite;
        $materiel->type_materiel_id = $request->type_materiel_id;
        $materiel->save();
        
        //Sauvegarde dans le log
        LogsController::storeUserAction($materiel, "Materiel : update (quantite= ".$materiel->quantite.";name= ".$materiel->name.")");

        return redirect()->route('materiel.index');
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
        $materiel = Materiel::find($id);
        //Sauvegarde dans le log
        LogsController::storeUserAction($materiel, "Materiel : destroy (quantite= ".$materiel->quantite.";name= ".$materiel->name.")");

        Materiel::destroy($id);
        return redirect()->route('materiel.index');
    }
}
