<?php

namespace App\Http\Controllers\unz;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CopiesController extends Controller
{
    //

    public function index(){
        return view('unz_st.scolarite.copies-index');
    }

    public function suivitIndex(){
        return view('unz_st.scolarite.suivit-copies-index');
    }

    public function releveNotesIndex(){
        return view('unz_st.scolarite.releve-notes-index');
    }

    public function show( $id ){
        $evaluation = DB::table("programmes")
        ->where("programmes.id", $id)
        ->join("e_c_u_s", "e_c_u_s.id", "programmes.e_c_u_id")
        ->join("promotions", "promotions.id", "programmes.promotion_id")
        ->join('users', 'users.id', 'programmes.enseignant_id')
        ->select(
            'programmes.id as id',
            'e_c_u_s.nom as nomECU',
            'programmes.dateDebut as date',
            'programmes.h_Deb_Matin as heureDebut',
            'programmes.h_Deb_Soir as heureFin',
            'promotions.annee_entrer as promotion',
            'users.name as nomEnseignant',
            'users.prenom as prenomEnseignant',
        )
        ->get(); 

        return view('unz_st.scolarite.copies-show', ['programme_id' => $id]);
    }
}
