<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seance extends Model
{
    use HasFactory;

    protected $fillable = [
    	'date',
    	'hDebut', 
    	'hFin',
    	'contenu',
    	'enseignant_id',
    	'e_c_u_id',
		'delegue_id',
		'statut'
		
    ];
}
