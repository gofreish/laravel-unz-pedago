<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\UE;
use App\Models\Filiere;

class Semestre extends Model
{
    use HasFactory;

    protected $fillable = ['intitule', 'cycle', 'filiere_id'];

    //Cette fonction permet d'avoir la liste des UE du semestre
    public function ues(){
    	return $this->hasMany(UE::class);
    }

    //Cette fonction retourne la filière a laquelle apartien cet semestre
    public function filiere(){
    	return $this->belongsTo(Filiere::class);
    }
}
