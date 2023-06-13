<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TitreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //1
        DB::table('titres')->insert([
                    'titre'    => 'M.'
                ]);

        //2
        DB::table('titres')->insert([
                    'titre'    => 'Mme'
                ]);

        //3
        DB::table('titres')->insert([
                    'titre'    => 'Mlle'
                ]);

        //4
        DB::table('titres')->insert([
                    'titre'    => 'Dr'
                ]);

        //5
        DB::table('titres')->insert([
                    'titre'    => 'Pr'
                ]);
    }
}
