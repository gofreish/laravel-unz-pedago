<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\UFR;
use App\Models\Promotion;
use App\Models\User;
use App\Models\Semestre;

class Filiere extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'u_f_r_id'];

    //Cette fonction retourne l'UFR dans laquelle se trouve la filière
    public function ufr(){
    	return $this->belongsTo(UFR::class);
    }

    //Cette fonction permet d'avoir la liste des Promotions de la filière
    public function promotions(){
    	return $this->hasMany(Promotion::class);
    }

    //Cette fonction retourne le coodinateur de cette filière
    public function users(){
    	return $this->morphToMany(User::class, 'userable');
    }

    //Cette fonction retourne la liste des semestres de la filière
    public function semestres(){
        return $this->hasMany(Semestre::class);
    }
}
