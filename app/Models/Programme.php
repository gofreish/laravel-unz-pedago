<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programme extends Model
{
    use HasFactory; 

    protected $fillable = [
    						'type_programme_id',
                            'dateDebut',
                            'dateFin',
                            'h_Deb_Matin',
                            'h_Fin_Matin',
                            'h_Deb_Soir',
                            'h_Fin_Soir',
                            'e_c_u_id',
                            'salle_id',
                            'promotion_id',
                            'user_id',
                            'enseignant_id',
                            'commentaire'
    		              ];

}
