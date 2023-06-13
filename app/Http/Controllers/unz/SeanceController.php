<?php

namespace App\Http\Controllers\unz;

use App\Http\Controllers\Controller;
use App\Models\Seance;
use Illuminate\Http\Request;
use App\Http\Requests\SeanceRequest;
use Illuminate\Support\Facades\DB;
use App\Models\ECU;
use Illuminate\Pagination\CursorPaginator;
use Barryvdh\DomPDF\Facade as PDF;


class SeanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('unz_st.seance.index');
    }

    public function createPDF( Request $request ){
        return PDF::loadHtml($request->html)
            ->download($request->pdfName.".pdf");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        return view('unz_st.seance.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SeanceRequest $request)
    {
        $seance = Seance::create([
            'date' =>  $request->date,
            'hDebut' =>  $request->heure_debut,
            'hFin' =>  $request->heure_fin,
            'contenu' =>  $request->contenu,
            'e_c_u_id' =>  $request->ecu,
            'delegue_id' =>  auth()->user()->id,
            'enseignant_id' =>  $request->enseignant
        ]);

        //Sauvegarde dans le log
        LogsController::storeUserAction($seance, "Seance : create");

        return redirect()->route('seance.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Seance  $seance
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $seance= DB::table('seances')
                    ->where('seances.id','=',$id)
                    ->join('e_c_u_s','e_c_u_s.id','=','seances.e_c_u_id')
                    ->select('e_c_u_s.id',
                            'seances.id',
                            'date',
                            'hDebut',
                            'hFin',
                            'contenu',
                            'statut',
                            'e_c_u_s.nom as nom_ecu',
                            'seances.enseignant_id',
                            'seances.delegue_id')
                            ->first();

            return view('unz_st.seance.show',['seance' => $seance]);
    }


     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function valide(Request $request, $id){

        if( $request->has('marker') && $request->marker == 'valider' ){
            $seance = Seance::find($id );

           // dd($seance);
            if($seance->statut){
                $request->session()->flash('message', 'Séance déja validée');
                return redirect()->route('seance.index');
            }else{
            $seance->statut = 'true';
            $seance->save();
            $request->session()->flash('message', 'Séance validée avec succès');

            //Sauvegarde dans le log
            LogsController::storeUserAction($seance, "Seance : validater : Seance valider par l enseignant");

            return redirect()->route('seance.index');
            }
        }
    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Seance  $seance
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

                $seance= DB::table('seances')
                ->where('seances.id','=',$id)
                ->join('e_c_u_s','e_c_u_s.id','=','seances.e_c_u_id')
                ->select('e_c_u_s.id',
                        'seances.id',
                        'date',
                        'hDebut',
                        'hFin',
                        'contenu',
                        'e_c_u_s.nom as nom_ecu')
                        ->first();


        return view('unz_st.seance.update',[
            'seance' => $seance
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Seance  $seance
     * @return \Illuminate\Http\Response
     */

    public function update(SeanceRequest $request, $id)
    {


        if( $request->has('marker') && $request->marker == 'modifier' ){
            $seance = Seance::find($id);
            $seance->date =  $request->date;
            $seance->hDebut = $request-> heure_debut;
            $seance->hFin = $request-> heure_fin;
            $seance->contenu = $request->contenu;
            $seance->statut = 'false';
            $seance->save();

            //Sauvegarde dans le log
            LogsController::storeUserAction($seance, "Seance : Mise a jour");

            $request->session()->flash('message', 'Séance modifiée avec succès');
            return view('unz_st.seance.show',['seance' => $seance]);

        }
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Seance  $seance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seance $seance)
    {
        //
    }
}
