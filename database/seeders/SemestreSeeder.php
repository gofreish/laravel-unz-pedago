<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SemestreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for($i=1; $i<=6; $i+=1){

            DB::table('semestres')->insert([
                    'intitule'    => 'Semestre '.$i,
                ]);
        
        }

    }
}
