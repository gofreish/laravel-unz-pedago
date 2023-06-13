<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Filiere;

class UFR extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    //Cette fonction permet d'avoir la liste des filières de l'UFR
    public function filieres(){
    	return $this->hasMany(Filiere::class);
    }
}
