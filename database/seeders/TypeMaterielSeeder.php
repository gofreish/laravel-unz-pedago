<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeMaterielSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('type_materiels')->insert([
                'type'          => 'Consommable',
            ]);

        DB::table('type_materiels')->insert([
                'type'          => 'Non Consommable',
            ]);
    }
}
