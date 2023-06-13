<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserList extends Component
{

    public $roles;
    public $users;
    public $html;
    public $contain = false;

    public $selectedRole = null;

    public function mount(){
        $this->roles = DB::table('roles')->pluck('name');
    }

    public function render()
    {
        return view('livewire.user-list');
    }

    public function updatedSelectedRole( $role ){
        if( $role=='null' ){
            $role = null;
            $this->reset('selectedRole');
        }
        $this->users = User::where('menuroles','LIKE','%'.$role.'%')
                            ->orderBy('name')
                            ->get();
        if ( count($this->users) > 0 ) {
            $this->contain = true;
            //On creer la vue pour le PDF
    	    $this->html = (string)view('unz_st.admin.userListPDF',[
                'role' => $role,
                'users' => $this->users
            ])->render();
        }
        else{
            $this->contain = false;
        }

    }
}
