<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use App\Http\Controllers\unz\ProgrammeController;
use App\Http\Controllers\unz\SeanceController;
use App\Http\Controllers\unz\ECUController;
use App\Http\Livewire\ProgrammeCreate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Batiment;
use App\Http\Livewire\BatimentSalle;
use App\Http\Livewire\ProgrammePublic;
use App\Http\Controllers\unz\RegisterController;
use App\Http\Controllers\unz\UsersController;
use App\Http\Controllers\unz\MaterielController;
use App\Http\Controllers\unz\EnregMatController;
use App\Http\Controllers\unz\RealiserPar;
use App\Http\Controllers\unz\ExcelFileController;
use App\Http\Controllers\unz\EtudiantController;
use App\Http\Controllers\unz\EvaluationController;
use App\Http\Controllers\unz\SurveillantController;
use App\Http\Controllers\unz\CopiesController;
use App\Http\Controllers\unz\DeliberationController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|   dashboard.homepage
    welcome
	unz_st.acceuil.acceuil_layout layout
*/

Route::get('test/{id}', [MaterielController::class, 'testeur']);

//Route pour les deliberation
Route::get('deliberation',[DeliberationController::class, 'index'])->name("deliberation");
Route::post('deliberation/import',[DeliberationController::class, 'import'])->name("deliberation.import");

//Route pour le relevé de notes
Route::get("releveNotes", [CopiesController::class, 'releveNotesIndex'])->name("releve.notes");

//Route pour le suivit des copies
Route::get('suivitCopies', [CopiesController::class, 'suivitIndex'])->name('copies.suivit');

//Route pour les copies
Route::get('copies', [CopiesController::class, 'index'])->name("copies");
Route::get('copies/show/{id}', [CopiesController::class, 'show'])->name("copies.show");

//Route pour les evaluations
Route::get('evaluation', [EvaluationController::class, 'index'])->name('evaluation');
Route::get('evaluation/{id}', [EvaluationController::class, 'show'])->name('evaluation.show');
Route::get('evaluation/preparation/finish/{filiere}/{cycle}/{semestre}/{nomECU}/{date}/{nbrGroup}', [EvaluationController::class, 'finishPreparation'])->name('evaluation.finish');

//Route pour les etudiants
Route::resource('etudiant', EtudiantController::class)
        ->missing(function (Request $request) {
            return Redirect::route('etudiant.index');
        });

//Route pour l'importation de la liste des etudiants
Route::post('etudiant/import/liste', [EtudiantController::class, 'importEtudiant'])->name('etudiant.import');


//Route pour les surveillants
Route::resource('surveillant', SurveillantController::class)
        ->missing(function (Request $request) {
            return Redirect::route('surveillant.index');
        });

//Route pour l'importation de la liste des etudiants
Route::post('surveillant/import/liste', [SurveillantController::class, 'importSurveillant'])->name('surveillant.import');


//Route pour les fichiers Excel
Route::get('/fichier/excel/', [ExcelFileController::class, 'index'])->name('excel.index');
Route::post('/fichier/excel/import', [ExcelFileController::class, 'import'])->name('excel.import');
//Route::get('/fichier/excel/stExport', [ExcelFileController::class, 'exportAllStStudent'])->name('excel.stExport');
Route::get('/fichier/excel/delibExport', [ExcelFileController::class, 'exportDeliberation'])->name('excel.stExport');
Route::get('/fichier/excel/stImport', [ExcelFileController::class, 'importEtudiant'])->name('excel.stImport');

Route::get('/export/users/', [UsersController::class, 'export']);
Route::get('/', function(){ return view('unz_st.acceuil.acceuil_layout'); })->name('acceuil');
Route::get('/welcome', function(){ return view('unz_st.acceuil.brouillons'); });

//Route pour l'ajout d'utilisateur
Route::get('/enregistrement', [RegisterController::class, 'create'])->middleware('admin')->name('enregistrement');
Route::post('/sauvegarde', [RegisterController::class, 'store'])->middleware('admin')->name('sauvegarde');

//Route pour la gestion des utilisateurs
Route::resource('user', UsersController::class)
        ->missing(function (Request $request) {
            return Redirect::route('user.index');
        });

//Route pour les roles
Route::get('/rolesList', [UsersController::class, 'editRoles'])->middleware('admin')->name('user.roles');
Route::put('/rolesUpdate/{user}', [UsersController::class, 'updateRoles'])->middleware('admin')->name('user.roles.update');

//Route pour telecharger la liste en pdf
Route::post('/userListPDF', [UsersController::class, 'createPDF'])->middleware('admin')->name('user.pdf');

//Route pour le materiel
Route::resource('materiel', MaterielController::class)
        ->missing(function (Request $request) {
            return Redirect::route('materiel.index');
        })->middleware('csaf');

 //Route pour le suivi du matériel
Route::resource('enregMat', EnregMatController::class)
        ->missing(function (Request $request) {
            return Redirect::route('enregMat.index');
        })->middleware('csaf');

//Route pour les statistique du matériel
Route::get('/statistiques/materiel', [EnregMatController::class, 'statistiques'])->name('statistiques.materiel');

Route::post('/statistiques', [EnregMatController::class, 'showStatistique'])->name('statistiques');

//Les routes pour ECU Avec redirection automatique
//Si l'ECU n'existe pas
Route::resource('ecu', ECUController::class)
        ->missing(function (Request $request) {
            return Redirect::route('ECU.index');
        });
Route::post('ecu/pdf', [ECUController::class, 'createPDF'])->name('ecu.pdf');

/*Les routes pour ECU
Route::resource('ecu', );
Route::group(
	['prefix' => 'ecu',
	 'as' => 'ecu'],
	function(){
		Route::get('/create', [FormController::class, 'createECU'])->name('.create');
		Route::post('/store', [FormController::class, 'storeECU'])->name('.store');
	}
); */

//Les routes pour programme Avec redirection automatique
//Si le programme n'existe pas
Route::resource('programme', ProgrammeController::class)
        ->missing(function (Request $request) {
            return Redirect::route('programme.index');
        })->middleware('auth');
Route::get('programmes/affichage', [ProgrammeController::class, 'indexAcceuil'])->name('programme.affichage');

Route::put('/programmes/affichage/{id}', [ProgrammeController::class, 'publicUpdate'])->name('programme.publicUpdate');
//Route pour envoyer le mail 
Route::get('/send-mail/{id}', [ProgrammeController::class, 'envoieMail'])->name('programme.mail');
//Route pour envoyer le messge 
Route::get('/send-sms/{id}',  [ProgrammeController::class, 'envoieSms'])->name('programme.sms');
//Route pour envoyer le telegramme 
Route::get('/send-telegramme/{id}',  [ProgrammeController::class, 'envoieTelegramme'])->name('programme.telegramme');

Route::get('programmes/affichageVoir', [ProgrammeController::class, 'indexVoir'])->name('programme.indexVoir');


//Route pour exporter le programme publié en PDF
Route::post('programmes/pdf', [ProgrammeController::class, 'createPDF'])->name('programme.createPDF');
Route::get('programmes/examen/pdf', [ProgrammeController::class, 'createExamPDF'])->name('programme.examenPDF');
//Route::get('/send-sms', [RealiserPar::class, 'envoi'])->name('sms');
//Les routes pour Enregistrement de Matériel
Route::group(
	['prefix' => 'enregmat',
	 'as' => 'enregmat'],
	function(){
		Route::get('/create', [FormController::class, 'createEnregMat'])->name('.create');
		Route::post('/store', [FormController::class, 'storeEnregMat'])->name('.store');
	}
);

//Route pour Seance
Route::resource('seance', SeanceController::class)
        ->missing(function (Request $request) {
            return Redirect::route('seance.index');
        });
        Route::post('seance/pdf', [SeanceController::class, 'createPDF'])->name('seance.pdf');

		Route::get('seance/affichage', [SeanceController::class, 'indexAcceuil'])->name('seance.affichage');

		Route::put('/seance/affichage/{id}', [SeanceController::class, 'valide'])->name('seance.valide');

		//Route::put('/seance/update/{id}', [SeanceController::class, 'update'])->name('seance.update');
		//Route::get('/seance/update/', [SeanceController::class, 'update'])->name('seance.update');

//Route pour la presentation des developpers
Route::get('/realiser par', [RealiserPar::class, 'developpersData'])->name('realiser_par');
