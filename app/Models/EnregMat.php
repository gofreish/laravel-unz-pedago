<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnregMat extends Model
{
    use HasFactory;

    protected $fillable = [
    	'date', 
    	'quantite', 
    	'quantite_avant_enreg', 
    	'type_enreg_id', 
    	'materiel_id',
    	'user_id'
    ];
}
