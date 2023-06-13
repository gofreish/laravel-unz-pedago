<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CycleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Donnees
        $cycleArray = [
            'Licence',
            'Master',
            'Doctorat'
        ];

        //Enregistrement
        foreach ($cycleArray as $key => $cycle) {
            DB::table('cycles')->insert([
                'cycle'    => $cycle,
            ]);
        }
    }
}
