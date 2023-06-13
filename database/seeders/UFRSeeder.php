<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UFRSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*###########################
            DONNES
        */
        $ufrs = [
            'Sciences et Technologies',
            'Sciences Economiques et de Gestion',
            'Lettres et Sciences Humaines',
            'Institut Universitaire de Technologies'
        ];

        /*###########################
            ENREGISTREMENT
        */
        foreach ($ufrs as $key => $ufr) {
            DB::table('u_f_r_s')->insert([
                'name' => $ufr,
            ]);
        }
    }
}
