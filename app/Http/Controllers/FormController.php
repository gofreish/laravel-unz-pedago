<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\ECU;
use App\Models\Seance;

class FormController extends Controller
{    

    public function indexAcceuil()
    {
         
            
        //dd($programmesOrdonnees);
        return view('unz_st.programme.public');
    }
    
    public function createECU(){
    	return view('unz_st.formulaires.ecu');
    }

    public function storeECU(Request $request){
        $request->validate([
    		'ecu' => ['required']
    	]);
    	
    	//Création de l ECU
    	ECU::create([
    		'code' => $request->code,
    		'nom' => $request->ecu,
    		'coefficient' => $request->coefficient,
    		'u_e_id' => $request->ue
    	]);

        //Recherche de l id de ECU dans la BDD du BREAD
        $ecu_id = DB::table('form')->where('name', '=','ECU')->value('id');       

    	return redirect()->route('resource.index',
    		['table' => $ecu_id]);
    }

    public function createProg(){
        //appel de la vue
        return view('unz_st.formulaires.programme');
    }

    public function storeProg(Request $request){
        
        dd('Le groupe du module programmation de cours s occupe de cette partie');
        //Validation du formulaire
        $request->validate([
            'date_debut' => ['required'],
        ]);

        //Ajouté les conditions permettant d'enregistrer le programme dans la BDD

        //Recherche de l id de Programme dans la BDD du BREAD
        $prog_id = DB::table('form')->where('name', '=',"Programme")
                    ->value('id');

        return redirect()->route('resource.index',
            ['table' => $prog_id]);
    }

    public function createSeance(){
        return view('unz_st.formulaires.seance');
    }

   
    public function storeSeance(Request $request){

        Seance::create([
            'date' =>  $request->date,
            'hDebut' =>  $request-> heure_debut,
            'hFin' =>  $request-> heure_fin,
            'contenu' =>  $request->contenu,
            'e_c_u_id' =>  $request->ecu,
            'delegue_id' =>  $request->delegue,
            'enseignant_id' =>  $request->enseignant
        ]);

        //Recherche de l id de Seance dans la BDD du BREAD
        $seance_id = DB::table('form')->where('name', '=',"Séance")
                    ->value('id');

        return redirect()->route('resource.index',
            ['table' => $seance_id]);
    }

    public function createEnregMat(){
        return view('unz_st.formulaires.enregmat');
    }

    public function storeEnregMat(Request $request){
        dd('Réussi');
        //On précise les conditions de validation


        //Ici on crée l'enregistrement dans la BDD

        //Recherche de l id de Enregistrement du matériel dans la BDD du BREAD
        $enregMat_id = DB::table('form')->where('name', '=',"Enregistrement du matériel")
                    ->value('id');

        return redirect()->route('resource.index',
            ['table' => $enregMat_id]);
    }
}
