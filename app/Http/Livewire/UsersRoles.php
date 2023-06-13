<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UsersRoles extends Component
{
    public $you = null;
    public $contain = false;
    public $usersList = null;
    public $selectedRole = null;

    public function mount(){
        $this->roles = DB::table('roles')->pluck('name');
    }

    public function render()
    {
        return view('livewire.users-roles');
    }

    public function updatedSelectedRole( $role ){
        $this->you = auth()->user();
        if( $this->selectedRole == "all" ){
            $this->usersList = User::all()->sortBy('name');
        }else{
            $this->usersList = User::where('menuroles','LIKE','%'.$this->selectedRole.'%')
                        ->orderBy('name')
                        ->get();
        }
        if( count($this->usersList) > 0 ){
            foreach ($this->usersList as $user) {
                $user->menuroles = \explode(",", $user->menuroles);
            }
            $this->contain = true;
        }
        else{
            $this->contain = false;
        }
    }

}
