<?php

namespace App\Http\Controllers\unz;

use App\Exports\UsersMultiSheetExport;
use App\Exports\LogsExport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\GroupeCopie;
use App\Models\Logs;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\LogsController;

class UsersController extends Controller
{
    private $logRoleMessage = '';

    //Cette fonction permet de generer un fichier excel eds users
    public function export(){
        dd(GroupeCopie::find(1));
        return Excel::download(new LogsExport(), "listeUser.xlsx");
    }

    //Cette fonction renvoi une liste contenant en clé le nom du role et en valeur checked si le user a ce role et '' sinon
    private function Roles($user){
        $roles = [];
        $rolesNames = DB::table('roles')->pluck('name');
        for($i=0; $i<count($rolesNames); $i++){
            //Si user a cet role
            if( $user->getRoleNames()->contains($rolesNames[$i]) ){
                $roles[$rolesNames[$i]] = 'checked';
            }
            else{
                $roles[$rolesNames[$i]] = '';
            }
        }
        return $roles;
    }

    public function createPDF(Request $request) {

        LogsController::storeAction("Telechargement de la liste des utilisateurs");

        return PDF::loadHtml($request->html)
            ->download($request->pdfName.".pdf");
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){   
        //dd(Logs::find(1));
        $you = auth()->user();
        $users = User::all()->sortBy('name');
        return view('unz_st.admin.usersList', compact('users', 'you'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('unz_st.admin.userShow', compact( 'user' ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('unz_st.admin.userEditForm', compact('user'));
    }

    /**
     * Show the form for editing Roles the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editRoles()
    {   
        return view('unz_st.admin.userRoles');
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
        $validatedData = $request->validate([
            'name'       => 'required|min:1|max:256',
            'prenom'     => 'required|min:1|max:256',
            'email'      => 'required|email|max:256',
            'ancien_password' =>  'required_with:changer',
            'nouveau_password' => 'required_with:confirm_password,ancien_password|same:confirm_password',
            'confirm_password' => 'required_with:nouveau_password,ancien_password|same:nouveau_password'
        ]);
        $user = User::findOrFail($id);
        $this->updateRoles($request, $user);

        $user->name = $request->name;
        $user->prenom = $request->prenom;
        $user->titre_id = $request->titre;
        $user->telephone = $request->telephone;
        $user->email = $request->email;
        
        //Si l'utilisateur veu changer le mot de passe
        if($request->has('changer')){
            //Si l ancien mot de passe est le bon
            if( Hash::check($request->ancien_password, $user->password) ){
                $user->password = Hash::make($request->nouveau_password);
            }
        }
        $user->save();
        //Sauvegarde dans le log
        LogsController::storeUserAction($user, "Utilisateur : Mis a jour: changement ".$this->logRoleMessage);
        return redirect()->route('user.index');
    }

    private function updateRoles(Request $request, $user)
    {
        $this->logRoleMessage = 'Roles : ';
        $roles = DB::table('roles')->get();
        $menuroles = '';
        $i = 1;

        foreach ($roles as $role) {
            //Recuperation de l ID du role
            //$roleId = DB::table('roles')->where('name', '=', $role)->select('id')->first();
            //$roleId = $roleId->id;

            //Si le role est cocher
            if($request->has($role->name)){
                //Si il ne possède pas le role on ajoute le role
                if( !$user->getRoleNames()->contains($role->name) ){

                    //Ajout du role dans la BDD
                    DB::table('model_has_roles')
                    ->insert([
                        'role_id' => $role->id,
                        'model_type' => 'App\Models\User',
                        'model_id' => $user->id
                    ]);
                    $this->logRoleMessage.'+'.$role->name.' ';
                }
                //on ajoute le nom du role
                if( $i == 1 ){
                    //Le premier ajout est sans virgule
                    $menuroles = $menuroles.$role->name;
                }
                else{
                    //Pour les autres ajouts avec virgule
                    $menuroles = $menuroles.','.$role->name;
                }
                $i++;
            }
            //Si le role n est pas cocher
            else{
                //Si il possède ce role on le supprime
                if( $user->getRoleNames()->contains($role->name) ){
                    DB::table('model_has_roles')
                    ->where('role_id', '=', $role->id)
                    ->where('model_type', '=', 'App\Models\User')
                    ->where('model_id', '=', $user->id)
                    ->delete();
                }
                $this->logRoleMessage.'-'.$role->name.' ';
            }
        }

        $user->menuroles = $menuroles;
        $this->logRoleMessage.')';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if($user){
            $user->delete();
        }
        //Sauvegarde dans le log
        LogsController::storeUserAction($user, "Utilisateur : Suppression");
        return redirect()->route('user.index');
    }
}
