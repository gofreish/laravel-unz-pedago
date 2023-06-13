<?php

namespace App\Models;

class Groupe
{
    /*
    [
                    index => [
                        taille => nbr,
                        surveillants = [
                            surveillant1,
                            surveillant2,
                            surveillant3,
                        ],
                        salle => {id: , nom: ,batiment_id }
                    ]
                ]*/

    public $numero;
    public $taille;
    public $surveillants = array();
    public $salle;

    public function __construct( $numero, $taille ){
        $this->numero = $numero;
        $this->taille = $taille;
    }

}
