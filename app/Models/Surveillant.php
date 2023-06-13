<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surveillant extends Model
{
    use HasFactory;
    
     /**
     * Clé primaire associée au model Etudiant
     * @var string
    */
    protected $primaryKey = 'cnib';
    public $incrementing = false;
    public $keyType = 'string';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cnib', 'genre', 'nom', 'prenom', 'non_paye', 'total'
    ];
}
