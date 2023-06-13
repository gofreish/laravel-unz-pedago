<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\TypeMateriel;
use App\Models\Materiel;
use App\Models\TypeEnreg;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class EnregMatCreate extends Component
{

	public $typesMat;
	public $materiels;
	public $typesEnreg;
	public $role_list;
	public $quantite = null;
	public $users = array();

	public $selectedQuantite = 0;
	public $selectedTypeMat = null;
	public $selectedMateriel = null;
	public $selectedRole = [];
    public $selectedTypeEnreg = null;

	public function mount(){
		$this->typesMat = TypeMateriel::all();
		$this->role_list = DB::table('roles')->pluck('name');
	}

    public function render()
    {
        return view('livewire.enreg-mat-create');
    }

    public function updatedSelectedTypeMat( $type ){
    	if( !is_null($type) ){
    		$this->selectedTypeMat = $type;
    		$this->materiels = Materiel::where('type_materiel_id', '=', $type)->orderBy('name')->get();
    	}
    }

    public function updatedSelectedMateriel( $materiel ){
        if ( !is_null($materiel) ) {
    			$this->quantite = Materiel::find($materiel)->quantite;

                if( $this->selectedTypeMat == 1 ){
                 $this->typesEnreg = TypeEnreg::where('id', '<>', 3)->get();
                }
                else{
    			 $this->typesEnreg = TypeEnreg::all();
                }
    	}	
    }

    public function updatedSelectedRole( $role ){
    	if( !is_null($role) ){  
    		$this->users = User::where('menuroles', 'like', '%'.$role.'%')->orderBy('name')->get();
    	}
    }
}
