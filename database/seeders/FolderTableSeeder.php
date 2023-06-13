<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Database\Seeders\CycleSeeder;
use Database\Seeders\FiliereSeeder;
use Database\Seeders\SemestreSeeder;
use Database\Seeders\TypeMaterielSeeder;
use Database\Seeders\TypeProgrammeSeeder;
use Database\Seeders\UFRSeeder;
use Database\Seeders\TypeEnregSeeder;
use Database\Seeders\UESeeder;
use Database\Seeders\BatimentSeeder;
use Database\Seeders\SalleSeeder;
use Database\Seeders\ECUSeeder;
use Database\Seeders\TitreSeeder;
use Database\Seeders\PromotionSeeder;
use Database\Seeders\gofreishUpdate1;
use Database\Seeders\EnregMatSeeder;
use Database\Seeders\UEandECUSeeder;

class FolderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Folders  */

        DB::table('folder')->insert([  /* without this folder, nothing works */
            'name' => 'root',
            'folder_id' => NULL,
        ]);
        $rootId = DB::getPdo()->lastInsertId();
        DB::table('folder')->insert([   /* without this folder, nothing works - only this folder have column `resource` = 1 */
            'name' => 'resource',
            'folder_id' => $rootId,
            'resource' => 1
        ]);
        DB::table('folder')->insert([
            'name' => 'documents',
            'folder_id' => $rootId,
        ]);
        DB::table('folder')->insert([
            'name' => 'graphics',
            'folder_id' => $rootId,
        ]);
        DB::table('folder')->insert([
            'name' => 'other',
            'folder_id' => $rootId,
        ]);
        $id = DB::getPdo()->lastInsertId();


        //Appel des autres Seeder par défaut
        $this->call([
            UFRSeeder::class,
            FiliereSeeder::class,
            CycleSeeder::class,
            SemestreSeeder::class,
            BatimentSeeder::class,
            TypeMaterielSeeder::class,
            TypeProgrammeSeeder::class,
            TypeEnregSeeder::class,
            //UESeeder::class,
            SalleSeeder::class,
            //ECUSeeder::class,
            TitreSeeder::class,
            //PromotionSeeder::class,
            gofreishUpdate1::class,
            //EnregMatSeeder::class,
            UEandECUSeeder::class
        ]);
    }
}
