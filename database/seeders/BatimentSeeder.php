<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class BatimentSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Données
        $batimentArray = [
            ['name' => 'Wendpanga', 'image' => 'default.jpg'],
            ['name' => 'PSUT', 'image' => 'default.jpg'],
            ['name' => 'Togogéni', 'image' => 'default.jpg']
        ];

        //Enregistrement
        foreach ($batimentArray as $key => $bat) {
            DB::table('batiments')->insert([
                'name' => $bat['name'],
                'image' => $bat['image'],
            ]);
        }
    }
}
