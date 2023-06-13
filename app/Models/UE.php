<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Semestre;
use App\Models\ECU;

class UE extends Model
{
    use HasFactory;

    protected $fillable = [];

    //Cette fonction retourne le Semestre de lÚE en question
    public function semestre(){
    	return $this->belongsTo(Semestre::class);
    }

    //Cette fonction permet d'avoir la liste des ECU du de l'UE
    public function ecus(){
    	return $this->hasMany(ECU::class);
    }
}
