<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class EnregMatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
    	$faker = Faker::create();
        //Ajout de materiels
        DB::table('materiels')
            ->insert([
                'name' => 'Projecteur',
                'quantite' => 50,
                'type_materiel_id' => 2
        ]);
        DB::table('materiels')
            ->insert([
                'name' => 'Craie',
                'quantite' => 75,
                'type_materiel_id' => 1
        ]);

        $date = Carbon::today();
        //Ajout d enregistrement
        for($jour=1; $jour<20; $jour++){
        	for ($i=0; $i < 10; $i++) { 
        		DB::table('enreg_mats')
            	->insert([
                	'date' => $date->toDateString(),
                	'quantite' => $faker->numberBetween(1,10),
                	'quantite_avant_enreg' => $faker->numberBetween(1,10),
                	'achever' => $faker->randomElement([true, false]),
                	'type_enreg_id' => $faker->numberBetween(1,3),
                	'materiel_id' => 1,
                	'user_id' => 1
        		]);
        	}
        	$date->add(1, 'days');
        }

        $date = Carbon::today();
        //Ajout d enregistrement
        for($jour=1; $jour<20; $jour++){
        	for ($i=0; $i < 10; $i++) { 
        		DB::table('enreg_mats')
            	->insert([
                	'date' => $date->toDateString(),
                	'quantite' => $faker->numberBetween(1,20),
                	'quantite_avant_enreg' => $faker->numberBetween(1,10),
                	'achever' => $faker->randomElement([true, false]),
                	'type_enreg_id' => $faker->numberBetween(1,3),
                	'materiel_id' => 2,
                	'user_id' => 2
        		]);
        	}
        	$date->add(1, 'days');
        }
        */
    }
}
