<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\EnregMateriel;
use App\Models\Image;

class Materiel extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'quantite', 'type_materiel_id'];

    //Cette fonction retourne la liste des enregistrement concernant cet materiel
    public function enreg_materiels(){
    	return $this->hasMany(EnregMateriel::class);
    } 

    //retourne l'image du materiel
    public function image(){
    	return $this->morphOne(Image::class, 'imageable');
    }
}
