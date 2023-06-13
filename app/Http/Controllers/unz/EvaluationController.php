<?php

namespace App\Http\Controllers\unz;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class EvaluationController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('unz_st.scolarite.evaluation-index');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $evaluation = DB::table('programmes')
                            ->where('programmes.id', $id)
                            ->join('e_c_u_s', 'e_c_u_s.id', '=', 'programmes.e_c_u_id')
                            ->join('promotions', 'promotions.id', '=', 'programmes.promotion_id')
                            ->join('users', 'users.id', '=', 'programmes.enseignant_id')
                            ->where('programmes.dateDebut', '>=', today())
                            ->orderBy('programmes.dateDebut', 'asc')
                            ->select(
                                'programmes.id as id',
                                'e_c_u_s.nom as nomECU',
                                'programmes.dateDebut as date',
                                'programmes.h_Deb_Matin as heureDebut',
                                'programmes.h_Deb_Soir as heureFin',
                                'promotions.annee_entrer as promotion',
                                'users.name as nomEnseignant',
                                'users.prenom as prenomEnseignant',
                                'programmes.public as isPublier'
                            )->first();
        return view('unz_st.scolarite.evaluation-show', ['evaluation'=>$evaluation]);
    }

    public function finishPreparation($filiere, $cycle, $semestre, $nomECU, $date, $nbrGroup){
        //dd('filiere = '.$filiere.'semestre = '.$semestre.'nomECU = '.$nomECU.'date = '.$date);
        $path = 'root/exports/evaluation/'.
                        $filiere.'/'.
                        $cycle.'/'.
                        $semestre.'/'.
                        $nomECU.'/'.
                        $date.'/finish.txt';

        Storage::put($path, "-[".strval($nbrGroup)."]groupes");
        //dd("-[".strval($nbrGroup)."]groupes");
        return redirect()->route('evaluation');
    }
}
