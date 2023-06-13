<?php

namespace App\Http\Controllers\unz;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;
use App\Models\User;
use App\Models\Filiere;
use App\Models\Promotion;
use App\Exports\EtudiantExport;
use App\Imports\EtudiantImport;
use App\Exports\DeliberationExport;

class ExcelFileController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function importEtudiant(){
        Excel::import(new EtudiantImport(), 'root/imports/etudiants/Mathématiques Physique Chimie Informatique (MPCI)/L1_P2021.xls');
        /*$filieres = Filiere::all();
        $path = 'root/imports/etudiants/';
        foreach ($filieres as $key => $filiere) {
            $promotions = Promotion::where('filiere_id', $filiere->id)->get();
            foreach ($promotions as $key => $promotion) {
                Excel::import(new EtudiantImport(), $path.$filiere->name.'/P('.$promotion->annee_entrer.').xls');
            }
        }*/
    }

    public function exportDeliberation(){ 
        (new DeliberationExport('Mathématiques Physique Chimie Informatique (MPCI)', 2016, 'Licence', 'Semestre 3', 'Session normale'))->download();
        //(new DeliberationExport('Mathématiques Physique Chimie Informatique (MPCI)', 2018, 'Licence', 'Semestre 1', 'Session normale'))->download();
        //(new DeliberationExport('Informatique', 2018, 'Licence', 'Semestre 4', 'Session normale'))->download();
    }

    public function exportAllStStudent(){
          //Export déja fait

        /*(new EtudiantExport(3, '2016', 'Informatique', 'Licence', 'Semestre 1'))->download();
        
        (new EtudiantExport(15, '2018', 'Informatique', 'Licence', 'Semestre 5'))->download();
        (new EtudiantExport(30, '2018', 'Mathématiques'))->download();
        (new EtudiantExport(79, '2018', 'Physique'))->download();
        (new EtudiantExport(17, '2018', 'Chimie'))->download();
        (new EtudiantExport(1001, '2018', 'Mathématiques Physique Chimie Informatique (MPCI)'))->download();
        (new EtudiantExport(1121, '2018', 'Sciences de la Vie et de la Terre (SVT)'))->download();
        
        (new EtudiantExport(21, '2019', 'Informatique'))->download();
        (new EtudiantExport(32, '2019', 'Mathématiques'))->download();
        (new EtudiantExport(91, '2019', 'Physique'))->download();
        (new EtudiantExport(23, '2019', 'Chimie'))->download();
        (new EtudiantExport(1113, '2019', 'Mathématiques Physique Chimie Informatique (MPCI)'))->download();
        (new EtudiantExport(1433, '2019', 'Sciences de la Vie et de la Terre (SVT)'))->download();
        
        (new EtudiantExport(29, '2020', 'Informatique'))->download();
        (new EtudiantExport(33, '2020', 'Mathématiques'))->download();
        (new EtudiantExport(100, '2020', 'Physique'))->download();
        (new EtudiantExport(30, '2020', 'Chimie'))->download();
        (new EtudiantExport(1150, '2020', 'Mathématiques Physique Chimie Informatique (MPCI)'))->download();
        (new EtudiantExport(1760, '2020', 'Sciences de la Vie et de la Terre (SVT)'))->download();
        
        (new EtudiantExport(30, '2021', 'Informatique'))->download();
        (new EtudiantExport(40, '2021', 'Mathématiques'))->download();
        (new EtudiantExport(120, '2021', 'Physique'))->download();
        (new EtudiantExport(47, '2021', 'Chimie'))->download();*/

        //Le seul executer : (new EtudiantExport(1200, '2021', 'Mathématiques Physique Chimie Informatique (MPCI)', 'Licence', 'Semestre 1'))->download();
        //(new EtudiantExport(2000, '2021', 'Sciences de la Vie et de la Terre (SVT)', 'Licence', 'Semestre 1'))->download();
        
    }

    public function index(){
        //$delib = new DeliberationExport( "Mathématiques Physique Chimie Informatique (MPCI)", "Licence", "Semestre 1", "Session Normale");
        //return $delib->download();
        $var = new EtudiantExport(10, '2018', 'Informatique');
        $var->download(); 
        return view('unz_st.excel.index');
    }

    public function import(Request $request){
        if($request->hasFile('excel_file') && $request->file('excel_file')->isValid()){
            //dd();
            Excel::import(new UsersImport, $request->excel_file->path());
        }
    }
}
