<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class BREADSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Bread Exemple
        DB::table('form')->insert([
            'name' => 'Example',
            'table_name' => 'example',
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'delete' => 1,
            'pagination' => 5
        ]);
        $formId = DB::getPdo()->lastInsertId();
        DB::table('form_field')->insert([
            'name' => 'Title',
            'type' => 'text',
            'browse' => 1,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'form_id' => $formId,
            'column_name' => 'name'
        ]);
        DB::table('form_field')->insert([
            'name' => 'Description',
            'type' => 'text_area',
            'browse' => 1,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'form_id' => $formId,
            'column_name' => 'description'
        ]);
        DB::table('form_field')->insert([
            'name' => 'Status',
            'type' => 'relation_select',
            'browse' => 1,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'form_id' => $formId,
            'column_name' => 'status_id',
            'relation_table' => 'status',
            'relation_column' => 'name'
        ]);
        $role = Role::where('name', '=', 'guest')->first();
        Permission::create(['name' => 'browse bread '   . $formId]);
        Permission::create(['name' => 'read bread '     . $formId]);
        Permission::create(['name' => 'edit bread '     . $formId]);
        Permission::create(['name' => 'add bread '      . $formId]);
        Permission::create(['name' => 'delete bread '   . $formId]);
        $role->givePermissionTo('browse bread '     . $formId);
        $role->givePermissionTo('read bread '       . $formId);
        $role->givePermissionTo('edit bread '       . $formId);
        $role->givePermissionTo('add bread '        . $formId);
        $role->givePermissionTo('delete bread '     . $formId);

//#########################################################
        //Bread Matériel
        DB::table('form')->insert([
            'name' => 'Matériel',
            'table_name' => 'materiels',
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'delete' => 1,
            'pagination' => 10
        ]);
        $formId = DB::getPdo()->lastInsertId();
        DB::table('form_field')->insert([
            'name' => 'NOM',
            'type' => 'text',
            'browse' => 1,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'form_id' => $formId,
            'column_name' => 'name'
        ]);
        DB::table('form_field')->insert([
            'name' => 'Quantité',
            'type' => 'number',
            'browse' => 1,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'form_id' => $formId,
            'column_name' => 'quantite'
        ]);
        DB::table('form_field')->insert([
            'name' => 'Type',
            'type' => 'relation_select',
            'browse' => 1,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'form_id' => $formId,
            'relation_table' => 'type_materiels',
            'relation_column' => 'type',
            'column_name' => 'type_materiel_id',
        ]);

        $role = Role::where('name', '=', 'guest')->first();
        Permission::create(['name' => 'browse bread '   . $formId]);
        Permission::create(['name' => 'read bread '     . $formId]);
        Permission::create(['name' => 'edit bread '     . $formId]);
        Permission::create(['name' => 'add bread '      . $formId]);
        Permission::create(['name' => 'delete bread '   . $formId]);
        $role->givePermissionTo('browse bread '     . $formId);
        $role->givePermissionTo('read bread '       . $formId);
        $role->givePermissionTo('edit bread '       . $formId);
        $role->givePermissionTo('add bread '        . $formId);
        $role->givePermissionTo('delete bread '     . $formId);

    //############################################################
        //Bread Batiment
        DB::table('form')->insert([
            'name' => 'Bâtiment',
            'table_name' => 'batiments',
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'delete' => 1,
            'pagination' => 10
        ]);
        $formId = DB::getPdo()->lastInsertId();
        DB::table('form_field')->insert([
            'name' => 'NOM',
            'type' => 'text',
            'browse' => 1,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'form_id' => $formId,
            'column_name' => 'name'
        ]);
        /*DB::table('form_field')->insert([
            'name' => 'Image',
            'type' => 'image',
            'browse' => 1,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'form_id' => $formId,
            'column_name' => 'image'
        ]);*/

        $role = Role::where('name', '=', 'guest')->first();
        Permission::create(['name' => 'browse bread '   . $formId]);
        Permission::create(['name' => 'read bread '     . $formId]);
        Permission::create(['name' => 'edit bread '     . $formId]);
        Permission::create(['name' => 'add bread '      . $formId]);
        Permission::create(['name' => 'delete bread '   . $formId]);
        $role->givePermissionTo('browse bread '     . $formId);
        $role->givePermissionTo('read bread '       . $formId);
        $role->givePermissionTo('edit bread '       . $formId);
        $role->givePermissionTo('add bread '        . $formId);
        $role->givePermissionTo('delete bread '     . $formId);

    //##############################################################
        //Bread UFR
        DB::table('form')->insert([
            'name' => 'UFR',
            'table_name' => 'u_f_r_s',
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'delete' => 1,
            'pagination' => 10
        ]);
        $formId = DB::getPdo()->lastInsertId();
        DB::table('form_field')->insert([
            'name' => 'NOM',
            'type' => 'text',
            'browse' => 1,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'form_id' => $formId,
            'column_name' => 'name'
        ]);

        $role = Role::where('name', '=', 'guest')->first();
        Permission::create(['name' => 'browse bread '   . $formId]);
        Permission::create(['name' => 'read bread '     . $formId]);
        Permission::create(['name' => 'edit bread '     . $formId]);
        Permission::create(['name' => 'add bread '      . $formId]);
        Permission::create(['name' => 'delete bread '   . $formId]);
        $role->givePermissionTo('browse bread '     . $formId);
        $role->givePermissionTo('read bread '       . $formId);
        $role->givePermissionTo('edit bread '       . $formId);
        $role->givePermissionTo('add bread '        . $formId);
        $role->givePermissionTo('delete bread '     . $formId);

    //##############################################################
        //Bread Filière
        DB::table('form')->insert([
            'name' => 'Filière',
            'table_name' => 'filieres',
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'delete' => 1,
            'pagination' => 10
        ]);
        $formId = DB::getPdo()->lastInsertId();
        DB::table('form_field')->insert([
            'name' => 'NOM',
            'type' => 'text',
            'browse' => 1,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'form_id' => $formId,
            'column_name' => 'name'
        ]);
        DB::table('form_field')->insert([
            'name' => 'UFR',
            'type' => 'relation_select',
            'browse' => 1,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'form_id' => $formId,
            'relation_table' => 'u_f_r_s',
            'relation_column' => 'name',
            'column_name' => 'u_f_r_id',
        ]);

        $role = Role::where('name', '=', 'guest')->first();
        Permission::create(['name' => 'browse bread '   . $formId]);
        Permission::create(['name' => 'read bread '     . $formId]);
        Permission::create(['name' => 'edit bread '     . $formId]);
        Permission::create(['name' => 'add bread '      . $formId]);
        Permission::create(['name' => 'delete bread '   . $formId]);
        $role->givePermissionTo('browse bread '     . $formId);
        $role->givePermissionTo('read bread '       . $formId);
        $role->givePermissionTo('edit bread '       . $formId);
        $role->givePermissionTo('add bread '        . $formId);
        $role->givePermissionTo('delete bread '     . $formId);

    //##############################################################
        //Bread UE
        DB::table('form')->insert([
            'name' => "Unité d'enseignement",
            'table_name' => 'u_e_s',
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'delete' => 1,
            'pagination' => 10
        ]);
        $formId = DB::getPdo()->lastInsertId();
        DB::table('form_field')->insert([
            'name' => 'Code',
            'type' => 'text',
            'browse' => 1,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'form_id' => $formId,
            'column_name' => 'code'
        ]);
        DB::table('form_field')->insert([
            'name' => 'NOM',
            'type' => 'text',
            'browse' => 1,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'form_id' => $formId,
            'column_name' => 'nom'
        ]);
        DB::table('form_field')->insert([
            'name' => 'Crédit',
            'type' => 'number',
            'browse' => 1,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'form_id' => $formId,
            'column_name' => 'credit'
        ]);
        DB::table('form_field')->insert([
            'name' => 'Filière',
            'type' => 'relation_select',
            'browse' => 1,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'form_id' => $formId,
            'relation_table' => 'filieres',
            'relation_column' => 'name',
            'column_name' => 'filiere_id',
        ]);
        DB::table('form_field')->insert([
            'name' => 'Cycle',
            'type' => 'relation_select',
            'browse' => 1,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'form_id' => $formId,
            'relation_table' => 'cycles',
            'relation_column' => 'cycle',
            'column_name' => 'cycle_id',
        ]);
        DB::table('form_field')->insert([
            'name' => 'Semestre',
            'type' => 'relation_select',
            'browse' => 1,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'form_id' => $formId,
            'relation_table' => 'semestres',
            'relation_column' => 'intitule',
            'column_name' => 'semestre_id',
        ]);

        $role = Role::where('name', '=', 'guest')->first();
        Permission::create(['name' => 'browse bread '   . $formId]);
        Permission::create(['name' => 'read bread '     . $formId]);
        Permission::create(['name' => 'edit bread '     . $formId]);
        Permission::create(['name' => 'add bread '      . $formId]);
        Permission::create(['name' => 'delete bread '   . $formId]);
        $role->givePermissionTo('browse bread '     . $formId);
        $role->givePermissionTo('read bread '       . $formId);
        $role->givePermissionTo('edit bread '       . $formId);
        $role->givePermissionTo('add bread '        . $formId);
        $role->givePermissionTo('delete bread '     . $formId);

    //##############################################################
        //Bread ECU
        DB::table('form')->insert([
            'name' => 'ECU',
            'table_name' => 'e_c_u_s',
            'read' => 1,
            'edit' => 1,
            'add' => 0,
            'delete' => 1,
            'pagination' => 10
        ]);
        $formId = DB::getPdo()->lastInsertId();
        DB::table('form_field')->insert([
            'name' => 'Code',
            'type' => 'text',
            'browse' => 1,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'form_id' => $formId,
            'column_name' => 'code'
        ]);
        DB::table('form_field')->insert([
            'name' => 'NOM',
            'type' => 'text',
            'browse' => 1,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'form_id' => $formId,
            'column_name' => 'nom'
        ]);
        DB::table('form_field')->insert([
            'name' => 'Coefficient',
            'type' => 'number',
            'browse' => 1,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'form_id' => $formId,
            'column_name' => 'coefficient'
        ]);
         DB::table('form_field')->insert([
            'name' => 'UE',
            'type' => 'relation_select',
            'browse' => 1,
            'read' => 1,
            'edit' => 0,
            'add' => 0,
            'form_id' => $formId,
            'relation_table' => 'u_e_s',
            'relation_column' => 'nom',
            'column_name' => 'u_e_id',
        ]);

        $role = Role::where('name', '=', 'guest')->first();
        Permission::create(['name' => 'browse bread '   . $formId]);
        Permission::create(['name' => 'read bread '     . $formId]);
        Permission::create(['name' => 'edit bread '     . $formId]);
        Permission::create(['name' => 'add bread '      . $formId]);
        Permission::create(['name' => 'delete bread '   . $formId]);
        $role->givePermissionTo('browse bread '     . $formId);
        $role->givePermissionTo('read bread '       . $formId);
        $role->givePermissionTo('edit bread '       . $formId);
        $role->givePermissionTo('add bread '        . $formId);
        $role->givePermissionTo('delete bread '     . $formId);

    //##############################################################
        //Bread Salle
        DB::table('form')->insert([
            'name' => 'Salle',
            'table_name' => 'salles',
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'delete' => 1,
            'pagination' => 10
        ]);
        $formId = DB::getPdo()->lastInsertId();
        DB::table('form_field')->insert([
            'name' => 'NOM',
            'type' => 'text',
            'browse' => 1,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'form_id' => $formId,
            'column_name' => 'nom'
        ]);
        DB::table('form_field')->insert([
            'name' => 'Capacité',
            'type' => 'number',
            'browse' => 1,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'form_id' => $formId,
            'column_name' => 'capacite'
        ]);
          DB::table('form_field')->insert([
            'name' => 'Bâtiment',
            'type' => 'relation_select',
            'browse' => 1,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'form_id' => $formId,
            'relation_table' => 'batiments',
            'relation_column' => 'name',
            'column_name' => 'batiment_id',
        ]);

        $role = Role::where('name', '=', 'guest')->first();
        Permission::create(['name' => 'browse bread '   . $formId]);
        Permission::create(['name' => 'read bread '     . $formId]);
        Permission::create(['name' => 'edit bread '     . $formId]);
        Permission::create(['name' => 'add bread '      . $formId]);
        Permission::create(['name' => 'delete bread '   . $formId]);
        $role->givePermissionTo('browse bread '     . $formId);
        $role->givePermissionTo('read bread '       . $formId);
        $role->givePermissionTo('edit bread '       . $formId);
        $role->givePermissionTo('add bread '        . $formId);
        $role->givePermissionTo('delete bread '     . $formId);

    //##############################################################
        //Bread Promotion
        DB::table('form')->insert([
            'name' => 'Promotion',
            'table_name' => 'promotions',
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'delete' => 1,
            'pagination' => 10
        ]);
        $formId = DB::getPdo()->lastInsertId();
        DB::table('form_field')->insert([
            'name' => "Année d'entrée",
            'type' => 'number',
            'browse' => 1,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'form_id' => $formId,
            'column_name' => 'annee_entrer'
        ]);
        DB::table('form_field')->insert([
            'name' => 'Filière',
            'type' => 'relation_select',
            'browse' => 1,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'relation_table' => 'filieres',
            'relation_column' => 'name',
            'form_id' => $formId,
            'column_name' => 'filiere_id',
        ]);

        $role = Role::where('name', '=', 'guest')->first();
        Permission::create(['name' => 'browse bread '   . $formId]);
        Permission::create(['name' => 'read bread '     . $formId]);
        Permission::create(['name' => 'edit bread '     . $formId]);
        Permission::create(['name' => 'add bread '      . $formId]);
        Permission::create(['name' => 'delete bread '   . $formId]);
        $role->givePermissionTo('browse bread '     . $formId);
        $role->givePermissionTo('read bread '       . $formId);
        $role->givePermissionTo('edit bread '       . $formId);
        $role->givePermissionTo('add bread '        . $formId);
        $role->givePermissionTo('delete bread '     . $formId);

    }


}
