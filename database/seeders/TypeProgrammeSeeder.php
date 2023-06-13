<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeProgrammeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //1
        DB::table('type_programmes')->insert([
                'type'          => 'COURS',
            ]);

        //2
        DB::table('type_programmes')->insert([
                'type'          => 'EXAMEN',
            ]);

        //3
        DB::table('type_programmes')->insert([
                'type'          => 'AUTRE',
            ]);
    }
}
