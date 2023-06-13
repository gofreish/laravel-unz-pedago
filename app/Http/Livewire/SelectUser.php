<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

use App\Models\User;

class SelectUser extends Component
{

	public $roles;
	public $personnes;

	public $selectedRole = null;
	public $selectedPersonne = null;

	public function mount(){
		$this->roles = DB::table('roles')->get()->pluck('name');
		//dd($this->roles);
		$this->personnes = collect();
	}

    public function render()
    {
        return view('livewire.select-user');
    }

    public function updatedSelectedRole($role){
        if( $role=='null' ){
            $role = null;
            $this->reset('selectedRole');
        }
    	if( !is_null($role) ){
    		$this->personnes = User::where('menuroles', 'like' ,'%'.$role.'%')->orderBy('name')->get();
    		//dd($this->personnes[0]);
    	}
    }

}
