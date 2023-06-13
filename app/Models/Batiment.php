<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Salle;
use App\Models\Image;

class Batiment extends Model
{
    use HasFactory;

    //Cette fonction retourne la liste des salle d'un batiment
    public function salles(){
    	return $this->hasMany(Salle::class);
    }

    //retourne l'image du batiment
    public function image(){
    	return $this->morphOne(Image::class, 'imageable');
    }
}
