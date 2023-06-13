<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeEnregSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
    	DB::table('type_enregs')->insert([
                'type'          => 'Entré',
            ]);

        DB::table('type_enregs')->insert([
                'type'          => 'Sortie',
            ]);

        DB::table('type_enregs')->insert([
                'type'          => 'Retour',
            ]);

    }
}
