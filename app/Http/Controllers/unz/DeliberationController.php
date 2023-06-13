<?php

namespace App\Http\Controllers\unz;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\LogsController;
use App\Imports\Deliberation\DeliberationImport;
use App\Models\Promotion;
use App\Models\Filiere;
use App\Models\Cycle;
use App\Models\Semestre;

class DeliberationController extends Controller
{
    //

    public function index(){
        return view('unz_st.scolarite.deliberation-index');
    }

    public function import(Request $request){
        $request->validate([
            'pv_delib' => 'required|file|mimes:xlsx',
            'promotion_id' => 'required',
            'cycle_id' => 'required',
            'semestre_id' => 'required',
            'isNormal' => 'required',
            'delibDate' => 'required'
        ]);
        $import = new DeliberationImport($request->promotion_id, $request->cycle_id, $request->semestre_id, $request->isNormal, $request->delibDate);
        $import->import($request->file('pv_delib'));
        if( $import->isSuccess ){
            $promotion = Promotion::find($request->promotion_id);
            $filiere = Filiere::find($promotion->filiere_id);
            $cycle = Cycle::find($request->cycle_id);
            $semestre = Semestre::find($request->semestre_id);
            $isNormal = $request->isNormal == 1 ? 'Session normale' : "Session de rattrapage";
            $desc = "Déliberation : Importation de PV : Filiere: ".$filiere->name." Promotion: ".$promotion->annee_entrer." Cycle: ".$cycle->cycle." Semestre: ".$semestre->intitule." ".$isNormal;
            LogsController::storeAction($desc);
            return redirect()->route('deliberation')->with('success', 'Importer avec success');
        }else{
            return redirect()->route('deliberation')->with('erreur', 'Impossible d importer : '.$import->message);
        }
    }
}
