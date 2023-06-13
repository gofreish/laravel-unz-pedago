<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ECU extends Model
{
    use HasFactory;

    protected $fillable = ['code','nom','coefficient','u_e_id'];
}
