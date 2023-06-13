<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//1
        DB::table('salles')->insert([ 
            'nom' => 'Salle Informatique',
            'capacite' => '200',
            'batiment_id' => '1'
        ]);

        //2
        DB::table('salles')->insert([ 
            'nom' => 'Salle Physique',
            'capacite' => '200',
            'batiment_id' => '1'
        ]);

        //3
        DB::table('salles')->insert([ 
            'nom' => 'Salle Chimie',
            'capacite' => '200',
            'batiment_id' => '1'
        ]);

        //4
        DB::table('salles')->insert([ 
            'nom' => 'Salle SEG',
            'capacite' => '200',
            'batiment_id' => '1'
        ]);

        //6
        DB::table('salles')->insert([ 
            'nom' => 'EST',
            'capacite' => '750',
            'batiment_id' => '2'
        ]);

        //7
        DB::table('salles')->insert([ 
            'nom' => 'OUEST',
            'capacite' => '750',
            'batiment_id' => '2'
        ]);

    }
}
