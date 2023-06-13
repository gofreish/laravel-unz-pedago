<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class gofreishUpdate1 extends Seeder
{

   //Cette fonction associe le role au menu qui vient d etre ajouter en BDD.
    //Parametre: un tableau; le nom d'un role ou all pout tout
    private function setRole( $role, $menuElement){

        if( $role == 'all' ){
            $allRoles = DB::table('roles')->pluck('name');
            foreach ($allRoles as $key => $role_name) {
                DB::table('menu_role')
                ->insert([
                    'role_name' => $role_name,
                    'menus_id' => $menuElement
                ]);
            }
        }
        elseif(is_array($role)){
            foreach ($role as $key => $role_name) {
               DB::table('menu_role')
                ->insert([
                    'role_name' => $role_name,
                    'menus_id' => $menuElement
                ]);
            }
        }
        else{
            DB::table('menu_role')
                ->insert([
                    'role_name' => $role,
                    'menus_id' => $menuElement
                ]);
        }

    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $rolesForMe;

        //Ajout du bouton UNZ permetant d aller dans notre partie
        DB::table('menus')
        ->insert([
            'name' => 'UNZ',
            'href' => '/programmes/affichage',
            'icon' => null,
            'slug' => 'link',
            'parent_id' => null,
            'menu_id' => 1,
            'sequence' => 56
        ]);
        $UnzId = DB::getPdo()->lastInsertId();
        $this->setRole( 'all', $UnzId );

        //Ajout du menu unz dans la BDD
		DB::table('menulist')
		->insert([
            'name' => 'unz'
        ]);
		$menuUnzId = DB::getPdo()->lastInsertId();

        //Ajout du dropdown Utilisateurs du menu unz dans la BDD
		DB::table('menus')
		->insert([
            'name' => 'Utilisateurs',
            'href' => null,
            'icon' => "cil-user",
            'slug' => 'dropdown',
            'parent_id' => null,
            'menu_id' => $menuUnzId,
            'sequence' => 1
        ]);
        $unz_utilisateurId = DB::getPdo()->lastInsertId();
        $this->setRole( 'admin', $unz_utilisateurId );

        //Ajout du lien Ajout du dropdown Utilisateurs dans la BDD
        DB::table('menus')
        ->insert([
            'name' => "Ajout",
            'href' => '/enregistrement',
            'icon' => ' cil-user-follow',
            'slug' => 'link',
            'parent_id' => $unz_utilisateurId,
            'menu_id' => $menuUnzId,
            'sequence' => 2
        ]);
        $rolesForMe = DB::getPdo()->lastInsertId();
        $this->setRole( 'admin', $rolesForMe );

        //Ajout du lien Liste du dropdown Utilisateurs dans la BDD
		DB::table('menus')
		->insert([
            'name' => "Liste",
            'href' => '/user',
            'icon' => null,
            'slug' => 'link',
            'parent_id' => $unz_utilisateurId,
            'menu_id' => $menuUnzId,
            'sequence' => 3
        ]);
        $rolesForMe = DB::getPdo()->lastInsertId();
        $this->setRole( 'admin', $rolesForMe );

        //Ajout du lien Roles du dropdown Utilisateurs dans la BDD
		DB::table('menus')
		->insert([
            'name' => "Roles",
            'href' => '/rolesList',
            'icon' => null,
            'slug' => 'link',
            'parent_id' => $unz_utilisateurId,
            'menu_id' => $menuUnzId,
            'sequence' => 4
        ]);
        $rolesForMe = DB::getPdo()->lastInsertId();
        $this->setRole( 'admin', $rolesForMe );

        //Ajout du dropdown Programme du menu unz dans la BDD
		DB::table('menus')
		->insert([
            'name' => 'Programme',
            'href' => null,
            'icon' => 'cil-clipboard',
            'slug' => 'dropdown',
            'parent_id' => null,
            'menu_id' => $menuUnzId,
            'sequence' => 5
        ]);
        $unz_programmeId = DB::getPdo()->lastInsertId();
        $this->setRole( 'all', $unz_programmeId );

        //Ajout du lien Ajout du dropdown Programme dans la BDD
        DB::table('menus')
        ->insert([
            'name' => 'Ajout',
            'href' => 'programme/create',
            'icon' => null,
            'slug' => 'link',
            'parent_id' => $unz_programmeId,
            'menu_id' => $menuUnzId,
            'sequence' =>6
        ]);
        $rolesForMe = DB::getPdo()->lastInsertId();
        $this->setRole( 'admin', $rolesForMe );
        $this->setRole( 'coordonateur', $rolesForMe );

        //Ajout du lien Liste du dropdown Programme dans la BDD
		DB::table('menus')
		->insert([
            'name' => 'Liste',
            'href' => '/programme',
            'icon' => null,
            'slug' => 'link',
            'parent_id' => $unz_programmeId,
            'menu_id' => $menuUnzId,
            'sequence' => 7
        ]);
        $rolesForMe = DB::getPdo()->lastInsertId();
        $this->setRole( 'admin', $rolesForMe );
        $this->setRole( 'coordonateur', $rolesForMe );
        $this->setRole( 'scolarite', $rolesForMe );

        //Ajout du lien Tableau d'affichage du dropdown Programme dans la BDD
		DB::table('menus')
		->insert([
            'name' => "Tableau d'affichage",
            'href' => 'programmes/affichage',
            'icon' => null,
            'slug' => 'link',
            'parent_id' => $unz_programmeId,
            'menu_id' => $menuUnzId,
            'sequence' => 8
        ]);
        $rolesForMe = DB::getPdo()->lastInsertId();
        $this->setRole( 'all', $rolesForMe );

        //Ajout du lien Déliberation du dropdown Programme dans la BDD
		DB::table('menus')
		->insert([
            'name' => "Déliberation",
            'href' => 'deliberation',
            'icon' => null,
            'slug' => 'link',
            'parent_id' => $unz_programmeId,
            'menu_id' => $menuUnzId,
            'sequence' => 9
        ]);
        $rolesForMe = DB::getPdo()->lastInsertId();
        $this->setRole( 'admin', $rolesForMe );
        $this->setRole( 'coordonateur', $rolesForMe );

        //Ajout du dropdown Seance du menu unz dans la BDD
        DB::table('menus')
        ->insert([
            'name' => 'Cahier  de texte',
            'href' => null,
            'icon' => 'cil-book-open',
            'slug' => 'dropdown',
            'parent_id' => null,
            'menu_id' => $menuUnzId,
            'sequence' => 10
        ]);
        $unz_seanceId = DB::getPdo()->lastInsertId();
        $this->setRole( 'admin', $unz_seanceId );
        $this->setRole( 'delegue', $unz_seanceId );
        $this->setRole( 'enseignant', $unz_seanceId );
        $this->setRole( 'coordonateur', $unz_seanceId );

        //Ajout du lien Ajout du dropdown Seance dans la BDD
        DB::table('menus')
        ->insert([
            'name' => 'Ajout',
            'href' => 'seance/create',
            'icon' => null,
            'slug' => 'link',
            'parent_id' => $unz_seanceId,
            'menu_id' => $menuUnzId,
            'sequence' => 11
        ]);
        $rolesForMe = DB::getPdo()->lastInsertId();
        //$this->setRole( 'admin', $rolesForMe );
        $this->setRole( 'delegue', $rolesForMe );
        //$this->setRole( 'enseignant', $rolesForMe );
       // $this->setRole( 'coordonateur', $rolesForMe );

        //Ajout du lien Liste du dropdown Seance dans la BDD
        DB::table('menus')
        ->insert([
            'name' => 'Liste',
            'href' => '/seance',
            'icon' => null,
            'slug' => 'link',
            'parent_id' => $unz_seanceId,
            'menu_id' => $menuUnzId,
            'sequence' => 12
        ]);
        $rolesForMe = DB::getPdo()->lastInsertId();
        $this->setRole( 'admin', $rolesForMe );
        $this->setRole( 'delegue', $rolesForMe );
        $this->setRole( 'enseignant', $rolesForMe );
        $this->setRole( 'coordonateur', $rolesForMe );

        //Ajout du dropdown Materiel du menu unz dans la BDD
        DB::table('menus')
        ->insert([
            'name' => 'Materiel',
            'href' => null,
            'icon' => 'cil-apps',
            'slug' => 'dropdown',
            'parent_id' => null,
            'menu_id' => $menuUnzId,
            'sequence' => 13
        ]);
        $unz_materielId = DB::getPdo()->lastInsertId();
        $this->setRole( 'admin', $unz_materielId );
        $this->setRole( 'csaf', $unz_materielId );

        //Ajout du lien Tous du dropdown Materiel dans la BDD
        DB::table('menus')
        ->insert([
            'name' => "Liste",
            'href' => '/materiel',
            'icon' => null,
            'slug' => 'link',
            'parent_id' => $unz_materielId,
            'menu_id' => $menuUnzId,
            'sequence' => 14
        ]);
        $rolesForMe = DB::getPdo()->lastInsertId();
        $this->setRole( 'admin', $rolesForMe );
        $this->setRole( 'csaf', $rolesForMe );

        //Ajout du lien Cahier de suivi du dropdown Materiel dans la BDD
        DB::table('menus')
        ->insert([
            'name' => "Cahier de suivi",
            'href' => '/enregMat',
            'icon' => null,
            'slug' => 'link',
            'parent_id' => $unz_materielId,
            'menu_id' => $menuUnzId,
            'sequence' => 15
        ]);
        $rolesForMe = DB::getPdo()->lastInsertId();
        $this->setRole( 'admin', $rolesForMe );
        $this->setRole( 'csaf', $rolesForMe );

        //Ajout du lien Statistique du dropdown Materiel dans la BDD
        DB::table('menus')
        ->insert([
            'name' => "Statistiques",
            'href' => '/statistiques/materiel',
            'icon' => null,
            'slug' => 'link',
            'parent_id' => $unz_materielId,
            'menu_id' => $menuUnzId,
            'sequence' => 16
        ]);
        $rolesForMe = DB::getPdo()->lastInsertId();
        $this->setRole( 'admin', $rolesForMe );
        $this->setRole( 'csaf', $rolesForMe );

        //Ajout du dropdown Scolarité
        DB::table('menus')
        ->insert([
            'name' => 'Scolarité',
            'href' => null,
            'icon' => 'cil-education',
            'slug' => 'dropdown',
            'parent_id' => null,
            'menu_id' => $menuUnzId,
            'sequence' => 17
        ]);
        $unz_ScolariteId = DB::getPdo()->lastInsertId();
        $this->setRole( 'admin', $unz_ScolariteId );
        $this->setRole( 'scolarite', $unz_ScolariteId );

        //Ajout du lien Liste des surveillants
        DB::table('menus')
        ->insert([
            'name' => "Liste de surveillants",
            'href' => '/surveillant',
            'icon' => null,
            'slug' => 'link',
            'parent_id' => $unz_ScolariteId,
            'menu_id' => $menuUnzId,
            'sequence' => 18
        ]);
        $rolesForMe = DB::getPdo()->lastInsertId();
        $this->setRole( 'admin', $rolesForMe );
        $this->setRole( 'scolarite', $rolesForMe );
        
        //Ajout du lien Liste d etudiants
        DB::table('menus')
        ->insert([
            'name' => "Liste d'étudiant",
            'href' => '/etudiant',
            'icon' => null,
            'slug' => 'link',
            'parent_id' => $unz_ScolariteId,
            'menu_id' => $menuUnzId,
            'sequence' => 19
        ]);
        $rolesForMe = DB::getPdo()->lastInsertId();
        $this->setRole( 'admin', $rolesForMe );
        $this->setRole( 'scolarite', $rolesForMe );

        //Ajout du lien Evaluation
        DB::table('menus')
        ->insert([
            'name' => "Evaluations",
            'href' => '/evaluation',
            'icon' => null,
            'slug' => 'link',
            'parent_id' => $unz_ScolariteId,
            'menu_id' => $menuUnzId,
            'sequence' => 20
        ]);
        $rolesForMe = DB::getPdo()->lastInsertId();
        $this->setRole( 'admin', $rolesForMe );
        $this->setRole( 'scolarite', $rolesForMe );
        
        //Ajout du lien suivit des copies
        DB::table('menus')
        ->insert([
            'name' => "Suivi des Copies",
            'href' => '/suivitCopies',
            'icon' => null,
            'slug' => 'link',
            'parent_id' => $unz_ScolariteId,
            'menu_id' => $menuUnzId,
            'sequence' => 21
        ]);
        $rolesForMe = DB::getPdo()->lastInsertId();
        $this->setRole( 'admin', $rolesForMe );
        $this->setRole( 'scolarite', $rolesForMe );

        //Ajout du dropdown Enseignant du menu unz dans la BDD
        DB::table('menus')
        ->insert([
            'name' => 'Enseignant',
            'href' => null,
            'icon' => 'cil-user',
            'slug' => 'dropdown',
            'parent_id' => null,
            'menu_id' => $menuUnzId,
            'sequence' => 22
        ]);
        $unz_EnseignantId = DB::getPdo()->lastInsertId();
        $this->setRole( 'admin', $unz_EnseignantId );
        $this->setRole( 'enseignant', $unz_EnseignantId );

        //Ajout du lien Relever de note
        DB::table('menus')
        ->insert([
            'name' => "Relevé de note",
            'href' => '/releveNotes',
            'icon' => null,
            'slug' => 'link',
            'parent_id' => $unz_EnseignantId,
            'menu_id' => $menuUnzId,
            'sequence' => 23
        ]);
        $rolesForMe = DB::getPdo()->lastInsertId();
        $this->setRole( 'admin', $rolesForMe );
        $this->setRole( 'enseignant', $rolesForMe );        

        //Ajout du dropdown Ressources du menu unz dans la BDD
        DB::table('menus')
        ->insert([
            'name' => 'Ressources',
            'href' => null,
            'icon' => 'cil-pen-nib',
            'slug' => 'dropdown',
            'parent_id' => null,
            'menu_id' => $menuUnzId,
            'sequence' => 24
        ]);
        $unz_DonnéesId = DB::getPdo()->lastInsertId();
        $this->setRole( 'admin', $unz_DonnéesId );


        //Ajout du lien Bâtiment (BREAD) du dropdown Données dans la BDD
        $breadElementID = DB::table('form')->where('name', 'Bâtiment')->first();
        $breadElementID = $breadElementID->id;
        DB::table('menus')
        ->insert([
            'name' => 'Bâtiment',
            'href' => 'resource/'.$breadElementID.'/resource',
            'icon' => null,
            'slug' => 'link',
            'parent_id' => $unz_DonnéesId,
            'menu_id' => $menuUnzId,
            'sequence' => 25
        ]);
        $rolesForMe = DB::getPdo()->lastInsertId();
        $this->setRole( 'admin', $rolesForMe );

        //Ajout du lien Filière (BREAD) du dropdown Données dans la BDD
        $breadElementID = DB::table('form')->where('name', 'Filière')->first();
        $breadElementID = $breadElementID->id;
        DB::table('menus')
        ->insert([
            'name' => 'Filière',
            'href' => 'resource/'.$breadElementID.'/resource',
            'icon' => null,
            'slug' => 'link',
            'parent_id' => $unz_DonnéesId,
            'menu_id' => $menuUnzId,
            'sequence' => 26
        ]);
        $rolesForMe = DB::getPdo()->lastInsertId();
        $this->setRole( 'admin', $rolesForMe );

        //Ajout du lien Unité d'enseignement (BREAD) du dropdown Données dans la BDD
        $breadElementID = DB::table('form')->where('name', "Unité d'enseignement")->first();
        $breadElementID = $breadElementID->id;
        DB::table('menus')
        ->insert([
            'name' => "Unité d'enseignement",
            'href' => 'resource/'.$breadElementID.'/resource',
            'icon' => null,
            'slug' => 'link',
            'parent_id' => $unz_DonnéesId,
            'menu_id' => $menuUnzId,
            'sequence' => 27
        ]);
        $rolesForMe = DB::getPdo()->lastInsertId();
        $this->setRole( 'admin', $rolesForMe );

        //Ajout du lien ECU (BREAD) du dropdown Données dans la BDD
        $breadElementID = DB::table('form')->where('name', "ECU")->first();
        $breadElementID = $breadElementID->id;
        DB::table('menus')
        ->insert([
            'name' => "ECU",
            'href' => '/ecu',
            'icon' => null,
            'slug' => 'link',
            'parent_id' => $unz_DonnéesId,
            'menu_id' => $menuUnzId,
            'sequence' => 28
        ]);
        $rolesForMe = DB::getPdo()->lastInsertId();
        $this->setRole( 'admin', $rolesForMe );

        //Ajout du lien Salle (BREAD) du dropdown Données dans la BDD
        $breadElementID = DB::table('form')->where('name', "Salle")->first();
        $breadElementID = $breadElementID->id;
        DB::table('menus')
        ->insert([
            'name' => "Salle",
            'href' => 'resource/'.$breadElementID.'/resource',
            'icon' => null,
            'slug' => 'link',
            'parent_id' => $unz_DonnéesId,
            'menu_id' => $menuUnzId,
            'sequence' => 29
        ]);
        $rolesForMe = DB::getPdo()->lastInsertId();
        $this->setRole( 'admin', $rolesForMe );

        //Ajout du lien Promotion (BREAD) du dropdown Données dans la BDD
        $breadElementID = DB::table('form')->where('name', "Promotion")->first();
        $breadElementID = $breadElementID->id;
        DB::table('menus')
        ->insert([
            'name' => "Promotion",
            'href' => 'resource/'.$breadElementID.'/resource',
            'icon' => null,
            'slug' => 'link',
            'parent_id' => $unz_DonnéesId,
            'menu_id' => $menuUnzId,
            'sequence' => 30
        ]);
        $rolesForMe = DB::getPdo()->lastInsertId();
        $this->setRole( 'admin', $rolesForMe );

    }
}
