<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\UFR;

class FiliereSeeder extends Seeder
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
        $filieres = [
            'Informatique',
            'Mathématiques',
            'Physique',
            'Chimie',
            'Mathématiques Physique Chimie Informatique (MPCI)',
            'Sciences de la Vie et de la Terre (SVT)'
        ];

        /*###########################
            ENREGISTREMENT
        */
        $st_id = UFR::where('name', 'Sciences et Technologies')->first()->id;
        foreach ($filieres as $key => $filiere) {
            DB::table('filieres')->insert([
                'name'    => $filiere,
                'u_f_r_id' => $st_id
            ]);
        }
    }
}
