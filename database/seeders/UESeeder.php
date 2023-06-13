<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class UESeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker::create();
        
//############################################
        //SEMESTRE 1 Licence 1 MPCI
        //1
        $mpci = DB::table('filieres')->where('name', 'Mathématiques Physique Chimie Informatique (MPCI)')->first();
        DB::table('u_e_s')->insert([
                'code'    => 'PHY 1100',
                'nom' => 'Physique 1',
                'credit' => '6',
                'filiere_id' => $mpci->id,
                'cycle_id' => '1',
                'semestre_id' => '1'
            ]);

        //2
        DB::table('u_e_s')->insert([
                'code'    => 'MTH 1100',
                'nom' => 'Mathématiques 1',
                'credit' => '6',
                'filiere_id' => $mpci->id,
                'cycle_id' => '1',
                'semestre_id' => '1'
            ]);

        //3
        DB::table('u_e_s')->insert([
                'code'    => 'CHM 1100',
                'nom' => 'Chimie 1',
                'credit' => '6',
                'filiere_id' => $mpci->id,
                'cycle_id' => '1',
                'semestre_id' => '1'
            ]);

        //4
        DB::table('u_e_s')->insert([
                'code'    => 'INF 1100',
                'nom' => 'Informatique 1',
                'credit' => '6',
                'filiere_id' => $mpci->id,
                'cycle_id' => '1',
                'semestre_id' => '1'
            ]);

        //5
        DB::table('u_e_s')->insert([
                'code'    => 'TTC 1160',
                'nom' => 'UE transversales 1',
                'credit' => '6',
                'filiere_id' => $mpci->id,
                'cycle_id' => '1',
                'semestre_id' => '1'
            ]);

//############################################
        //SEMESTRE 2 Licence 1 MPCI
        //6
        DB::table('u_e_s')->insert([
                'code'    => 'PHY 1200',
                'nom' => 'Physique 2',
                'credit' => '5',
                'filiere_id' => $mpci->id,
                'cycle_id' => '1',
                'semestre_id' => '2'
            ]);

        //7
        DB::table('u_e_s')->insert([
                'code'    => 'MTH 1200',
                'nom' => 'Mathématiques 2',
                'credit' => '5',
                'filiere_id' => $mpci->id,
                'cycle_id' => '1',
                'semestre_id' => '2'
            ]);

        //8
        DB::table('u_e_s')->insert([
                'code'    => 'CHM 1200',
                'nom' => 'Chimie 2',
                'credit' => '5',
                'filiere_id' => $mpci->id,
                'cycle_id' => '1',
                'semestre_id' => '2'
            ]);

        //9
        DB::table('u_e_s')->insert([
                'code'    => 'INF 1200',
                'nom' => 'Informatique 2',
                'credit' => '5',
                'filiere_id' => $mpci->id,
                'cycle_id' => '1',
                'semestre_id' => '2'
            ]);

        //10
        DB::table('u_e_s')->insert([
                'code'    => 'TTC 1260',
                'nom' => 'UE transversales 2',
                'credit' => '5',
                'filiere_id' => $mpci->id,
                'cycle_id' => '1',
                'semestre_id' => '2'
            ]);

        //11
        DB::table('u_e_s')->insert([
                'code'    => 'TTC 1261',
                'nom' => 'Sciences Graphiques',
                'credit' => '5',
                'filiere_id' => $mpci->id,
                'cycle_id' => '1',
                'semestre_id' => '2'
            ]);
        
    //############################################
        //SEMESTRE 3 Licence 1 MPCI
        //12
        DB::table('u_e_s')->insert([
                'code'    => 'PHY 1300',
                'nom' => 'Physique 3-1',
                'credit' => '6',
                'filiere_id' => $mpci->id,
                'cycle_id' => '1',
                'semestre_id' => '3'
            ]);
        //13
        DB::table('u_e_s')->insert([
                'code'    => 'PHY 1301',
                'nom' => 'Physique 3-2',
                'credit' => '3',
                'filiere_id' => $mpci->id,
                'cycle_id' => '1',
                'semestre_id' => '3'
            ]);

        //14
        DB::table('u_e_s')->insert([
                'code'    => 'MTH 1300',
                'nom' => 'Mathématiques 3-1',
                'credit' => '6',
                'filiere_id' => $mpci->id,
                'cycle_id' => '1',
                'semestre_id' => '3'
            ]);

        //15
        DB::table('u_e_s')->insert([
                'code'    => 'MTH 1301',
                'nom' => 'Mathématiques 3-2',
                'credit' => '3',
                'filiere_id' => $mpci->id,
                'cycle_id' => '1',
                'semestre_id' => '3'
            ]);
        
        //16
        DB::table('u_e_s')->insert([
                'code'    => 'CHM 1300',
                'nom' => 'Chimie 3',
                'credit' => '6',
                'filiere_id' => $mpci->id,
                'cycle_id' => '1',
                'semestre_id' => '3'
            ]);

        //17
        DB::table('u_e_s')->insert([
                'code'    => 'INF 1300',
                'nom' => 'Informatique 3',
                'credit' => '6',
                'filiere_id' => $mpci->id,
                'cycle_id' => '1',
                'semestre_id' => '3'
            ]);

    //############################################
        //SEMESTRE 4 Licence 2 Mathematiques
        $math = DB::table('filieres')->where('name', 'Mathématiques')->first();
        //18
        DB::table('u_e_s')->insert([
                'code'    => 'MTH 1400',
                'nom' => 'Algèbre 4',
                'credit' => '5',
                'filiere_id' => $math->id,
                'cycle_id' => '1',
                'semestre_id' => '4'
            ]);
        //19
        DB::table('u_e_s')->insert([
                'code'    => 'MTH 1401',
                'nom' => 'Analyse 4',
                'credit' => '5',
                'filiere_id' => $math->id,
                'cycle_id' => '1',
                'semestre_id' => '4'
            ]);
        //20
        DB::table('u_e_s')->insert([
                'code'    => 'MTH 1402',
                'nom' => 'Calcul Numérique',
                'credit' => '4',
                'filiere_id' => $math->id,
                'cycle_id' => '1',
                'semestre_id' => '4'
            ]);
        //21
        DB::table('u_e_s')->insert([
                'code'    => 'MTH 1403',
                'nom' => 'Optimisation',
                'credit' => '4',
                'filiere_id' => $math->id,
                'cycle_id' => '1',
                'semestre_id' => '4'
            ]);
        //22
        DB::table('u_e_s')->insert([
                'code'    => 'MTH 1404',
                'nom' => 'Géométrie des courbes et surfaces',
                'credit' => '5',
                'filiere_id' => $math->id,
                'cycle_id' => '1',
                'semestre_id' => '4'
            ]);
        //23
        DB::table('u_e_s')->insert([
                'code'    => 'MTH 1405',
                'nom' => 'Statistiques Mathématiques',
                'credit' => '4',
                'filiere_id' => $math->id,
                'cycle_id' => '1',
                'semestre_id' => '4'
            ]);
        //23
        DB::table('u_e_s')->insert([
                'code'    => 'MTH 1406',
                'nom' => 'Géométrie Affine et Euclidienne',
                'credit' => '3',
                'filiere_id' => $math->id,
                'cycle_id' => '1',
                'semestre_id' => '4'
            ]);

    //############################################
        //SEMESTRE 4 Licence 2 Physique
        $phys = DB::table('filieres')->where('name', 'Physique')->first();
        //24
        DB::table('u_e_s')->insert([
                'code'    => 'PHY 1400',
                'nom' => 'Physique Expérimentale',
                'credit' => '3',
                'filiere_id' => $phys->id,
                'cycle_id' => '1',
                'semestre_id' => '4'
            ]);
        //25
        DB::table('u_e_s')->insert([
                'code'    => 'PHY 1401',
                'nom' => 'Mécanique des Fluides',
                'credit' => '3',
                'filiere_id' => $phys->id,
                'cycle_id' => '1',
                'semestre_id' => '4'
            ]);
        //26
        DB::table('u_e_s')->insert([
                'code'    => 'PHY 1402',
                'nom' => 'Électronique Analogique',
                'credit' => '5',
                'filiere_id' => $phys->id,
                'cycle_id' => '1',
                'semestre_id' => '4'
            ]);
        //27
        DB::table('u_e_s')->insert([
                'code'    => 'PHY 1403',
                'nom' => 'Mécanique du Solide 1',
                'credit' => '5',
                'filiere_id' => $phys->id,
                'cycle_id' => '1',
                'semestre_id' => '4'
            ]);
        //28
        DB::table('u_e_s')->insert([
                'code'    => 'PHY 1404',
                'nom' => 'Mécanique Quantique 1',
                'credit' => '5',
                'filiere_id' => $phys->id,
                'cycle_id' => '1',
                'semestre_id' => '4'
            ]);
        //29
        DB::table('u_e_s')->insert([
                'code'    => 'MTH 1400',
                'nom' => 'Outils Mathématiques et Informatique',
                'credit' => '4',
                'filiere_id' => $phys->id,
                'cycle_id' => '1',
                'semestre_id' => '4'
            ]);
        //30
        DB::table('u_e_s')->insert([
                'code'    => 'TTC 1460',
                'nom' => 'Anglais Scientifique',
                'credit' => '2',
                'filiere_id' => $phys->id,
                'cycle_id' => '1',
                'semestre_id' => '4'
            ]);
        //30
        DB::table('u_e_s')->insert([
                'code'    => 'CHM 1400',
                'nom' => 'Chimie',
                'credit' => '3',
                'filiere_id' => $phys->id,
                'cycle_id' => '1',
                'semestre_id' => '4'
            ]);
    //############################################
        //SEMESTRE 4 Licence 2 Chimie
        $chimie = DB::table('filieres')->where('name', 'Chimie')->first();
        //31
        DB::table('u_e_s')->insert([
                'code'    => 'CHM 1400',
                'nom' => 'Chimie des matériaux Inorganiques',
                'credit' => '4',
                'filiere_id' => $chimie->id,
                'cycle_id' => '1',
                'semestre_id' => '4'
            ]);
        //32
        DB::table('u_e_s')->insert([
                'code'    => 'CHM 1401',
                'nom' => 'Chimie Organique Descriptive',
                'credit' => '4',
                'filiere_id' => $chimie->id,
                'cycle_id' => '1',
                'semestre_id' => '4'
            ]);
        //32
        DB::table('u_e_s')->insert([
                'code'    => 'CHM 1402',
                'nom' => 'Chimie Quantique',
                'credit' => '3',
                'filiere_id' => $chimie->id,
                'cycle_id' => '1',
                'semestre_id' => '4'
            ]);
        //33
        DB::table('u_e_s')->insert([
                'code'    => 'CHM 1403',
                'nom' => 'Chimie Analytique',
                'credit' => '3',
                'filiere_id' => $chimie->id,
                'cycle_id' => '1',
                'semestre_id' => '4'
            ]);
        //33
        DB::table('u_e_s')->insert([
                'code'    => 'CHM 1404',
                'nom' => 'Électrochimie',
                'credit' => '4',
                'filiere_id' => $chimie->id,
                'cycle_id' => '1',
                'semestre_id' => '4'
            ]);
        //33
        DB::table('u_e_s')->insert([
                'code'    => 'PHY 1400',
                'nom' => 'Mécanique Quantique',
                'credit' => '3',
                'filiere_id' => $chimie->id,
                'cycle_id' => '1',
                'semestre_id' => '4'
            ]);
        //33
        DB::table('u_e_s')->insert([
                'code'    => 'PHY 1401',
                'nom' => 'Thermodynamique',
                'credit' => '4',
                'filiere_id' => $chimie->id,
                'cycle_id' => '1',
                'semestre_id' => '4'
            ]);
        //34
        DB::table('u_e_s')->insert([
                'code'    => 'CHM 1400',
                'nom' => "Méthodes Statistique d'Analyse de données",
                'credit' => '2',
                'filiere_id' => $chimie->id,
                'cycle_id' => '1',
                'semestre_id' => '4'
            ]);
        //35
        DB::table('u_e_s')->insert([
                'code'    => 'TTC 1460',
                'nom' => "UE transversales",
                'credit' => '3',
                'filiere_id' => $chimie->id,
                'cycle_id' => '1',
                'semestre_id' => '4'
            ]);

    //############################################
        //SEMESTRE 4 Licence 2 Informatique
        //36
        $info = DB::table('filieres')->where('name', 'Informatique')->first();
        DB::table('u_e_s')->insert([
                'code'    => 'MTH 1400',
                'nom' => 'Probabilités et Statistiques',
                'credit' => '4',
                'filiere_id' => $info->id,
                'cycle_id' => '1',
                'semestre_id' => '4'
            ]);
        //37
        DB::table('u_e_s')->insert([
                'code'    => 'MTH 1401',
                'nom' => 'Fondamentaux Scientifique',
                'credit' => '4',
                'filiere_id' => $info->id,
                'cycle_id' => '1',
                'semestre_id' => '4'
            ]);
        //37
        DB::table('u_e_s')->insert([
                'code'    => 'INF 1400',
                'nom' => 'Introduction à la POO',
                'credit' => '3',
                'filiere_id' => $info->id,
                'cycle_id' => '1',
                'semestre_id' => '4'
            ]);
        //37
        DB::table('u_e_s')->insert([
                'code'    => 'INF 1401',
                'nom' => 'Structure de données avancées',
                'credit' => '3',
                'filiere_id' => $info->id,
                'cycle_id' => '1',
                'semestre_id' => '4'
            ]);
        //38
        DB::table('u_e_s')->insert([
                'code'    => 'INF 1402',
                'nom' => "Base de données et Système d'information",
                'credit' => '6',
                'filiere_id' => $info->id,
                'cycle_id' => '1',
                'semestre_id' => '4'
            ]);
        //38
        DB::table('u_e_s')->insert([
                'code'    => 'INF 1403',
                'nom' => "Réseau et Système Informatique",
                'credit' => '6',
                'filiere_id' => $info->id,
                'cycle_id' => '1',
                'semestre_id' => '4'
            ]);
        //38
        DB::table('u_e_s')->insert([
                'code'    => 'TTC 1460',
                'nom' => "UE-transversales",
                'credit' => '4',
                'filiere_id' => $info->id,
                'cycle_id' => '1',
                'semestre_id' => '4'
            ]);

    //############################################
        //SEMESTRE 5 Licence 3 Math
        //39
        $math = DB::table('filieres')->where('name', 'Mathématiques')->first();
        DB::table('u_e_s')->insert([
                'code'    => 'MTH 1500',
                'nom' => 'Algèbre 5',
                'credit' => '6',
                'filiere_id' => $math->id,
                'cycle_id' => '1',
                'semestre_id' => '5'
            ]);
        //40
        DB::table('u_e_s')->insert([
                'code'    => 'MTH 1501',
                'nom' => 'Analyse 5',
                'credit' => '3',
                'filiere_id' => $math->id,
                'cycle_id' => '1',
                'semestre_id' => '5'
            ]);
        //41
        DB::table('u_e_s')->insert([
                'code'    => 'MTH 1502',
                'nom' => 'Topologie Générale',
                'credit' => '4',
                'filiere_id' => $math->id,
                'cycle_id' => '1',
                'semestre_id' => '5'
            ]);
        //42
        DB::table('u_e_s')->insert([
                'code'    => 'MTH 1503',
                'nom' => 'Statistique avancée 1',
                'credit' => '3',
                'filiere_id' => $math->id,
                'cycle_id' => '1',
                'semestre_id' => '5'
            ]);
        //43
        DB::table('u_e_s')->insert([
                'code'    => 'MTH 1504',
                'nom' => 'Calcul Différentiel',
                'credit' => '3',
                'filiere_id' => $math->id,
                'cycle_id' => '1',
                'semestre_id' => '5'
            ]);
        //44
        DB::table('u_e_s')->insert([
                'code'    => 'MTH 1505',
                'nom' => 'Analyse Complexe',
                'credit' => '3',
                'filiere_id' => $math->id,
                'cycle_id' => '1',
                'semestre_id' => '5'
            ]);
        //45
        DB::table('u_e_s')->insert([
                'code'    => 'MTH 1506',
                'nom' => 'Analyse des Données',
                'credit' => '3',
                'filiere_id' => $math->id,
                'cycle_id' => '1',
                'semestre_id' => '5'
            ]);
        //46
        DB::table('u_e_s')->insert([
                'code'    => 'MTH 1507',
                'nom' => 'Calcul Scientifique et Traitement de Texte Scientifique',
                'credit' => '2',
                'filiere_id' => $math->id,
                'cycle_id' => '1',
                'semestre_id' => '5'
            ]);
        //47
        DB::table('u_e_s')->insert([
                'code'    => 'MTH 1508',
                'nom' => 'Analyse Numérique',
                'credit' => '3',
                'filiere_id' => $math->id,
                'cycle_id' => '1',
                'semestre_id' => '5'
            ]);

    //############################################
        //SEMESTRE 6 Licence 3 Math
        //48
        $math = DB::table('filieres')->where('name', 'Mathématiques')->first();
        DB::table('u_e_s')->insert([
                'code'    => 'MTH 1600',
                'nom' => 'Algèbre 6',
                'credit' => '6',
                'filiere_id' => $math->id,
                'cycle_id' => '1',
                'semestre_id' => '6'
            ]);
        //40
        DB::table('u_e_s')->insert([
                'code'    => 'MTH 1601',
                'nom' => 'Mesure et Intégration',
                'credit' => '4',
                'filiere_id' => $math->id,
                'cycle_id' => '1',
                'semestre_id' => '6'
            ]);
        //41
        DB::table('u_e_s')->insert([
                'code'    => 'MTH 1602',
                'nom' => 'Géométrie Différentiel',
                'credit' => '4',
                'filiere_id' => $math->id,
                'cycle_id' => '1',
                'semestre_id' => '6'
            ]);
        //42
        DB::table('u_e_s')->insert([
                'code'    => 'MTH 1603',
                'nom' => 'Inférence Statistique',
                'credit' => '4',
                'filiere_id' => $math->id,
                'cycle_id' => '1',
                'semestre_id' => '6'
            ]);
        //43
        DB::table('u_e_s')->insert([
                'code'    => 'MTH 1604',
                'nom' => 'Recherche Opérationnelle',
                'credit' => '4',
                'filiere_id' => $math->id,
                'cycle_id' => '1',
                'semestre_id' => '6'
            ]);
        //44
        DB::table('u_e_s')->insert([
                'code'    => 'MTH 1605',
                'nom' => 'Optimisation non Linéaire',
                'credit' => '3',
                'filiere_id' => $math->id,
                'cycle_id' => '1',
                'semestre_id' => '6'
            ]);
        //45
        DB::table('u_e_s')->insert([
                'code'    => 'MTH 1606',
                'nom' => 'Statistique Avancée 2',
                'credit' => '3',
                'filiere_id' => $math->id,
                'cycle_id' => '1',
                'semestre_id' => '6'
            ]);
        //46
        DB::table('u_e_s')->insert([
                'code'    => 'MTH 1607',
                'nom' => 'Initiation au Projet Professionnel',
                'credit' => '2',
                'filiere_id' => $math->id,
                'cycle_id' => '1',
                'semestre_id' => '6'
            ]);

    //############################################
        //SEMESTRE 5 Licence 3 Physique
        $phys = DB::table('filieres')->where('name', 'Physique')->first();
        //47
        DB::table('u_e_s')->insert([
                'code'    => 'PHY 1501',
                'nom' => 'Physique du Solide',
                'credit' => '4',
                'filiere_id' => $phys->id,
                'cycle_id' => '1',
                'semestre_id' => '5'
            ]);
        //48
        DB::table('u_e_s')->insert([
                'code'    => 'PHY 1502',
                'nom' => 'Mécanique Quantique 2',
                'credit' => '4',
                'filiere_id' => $phys->id,
                'cycle_id' => '1',
                'semestre_id' => '5'
            ]);
        //49
        DB::table('u_e_s')->insert([
                'code'    => 'PHY 1503',
                'nom' => 'Électronique Numérique',
                'credit' => '4',
                'filiere_id' => $phys->id,
                'cycle_id' => '1',
                'semestre_id' => '5'
            ]);
        //50
        DB::table('u_e_s')->insert([
                'code'    => 'PHY 1504',
                'nom' => 'Physique Statistique',
                'credit' => '4',
                'filiere_id' => $phys->id,
                'cycle_id' => '1',
                'semestre_id' => '5'
            ]);
        //50
        DB::table('u_e_s')->insert([
                'code'    => 'PHY 1505',
                'nom' => "Physique de l'Atmosphère",
                'credit' => '3',
                'filiere_id' => $phys->id,
                'cycle_id' => '1',
                'semestre_id' => '5'
            ]);
        //51
        DB::table('u_e_s')->insert([
                'code'    => 'PHY 1506',
                'nom' => "Transfert Thermique",
                'credit' => '3',
                'filiere_id' => $phys->id,
                'cycle_id' => '1',
                'semestre_id' => '5'
            ]);
        //53
        DB::table('u_e_s')->insert([
                'code'    => 'PHY 1507',
                'nom' => "Météorologie de l'Espace",
                'credit' => '2',
                'filiere_id' => $phys->id,
                'cycle_id' => '1',
                'semestre_id' => '5'
            ]);
        //54
        DB::table('u_e_s')->insert([
                'code'    => 'PHY 1508',
                'nom' => "Mécanique Céleste",
                'credit' => '2',
                'filiere_id' => $phys->id,
                'cycle_id' => '1',
                'semestre_id' => '5'
            ]);
        //55
        DB::table('u_e_s')->insert([
                'code'    => 'PHY 1509',
                'nom' => "Combustion",
                'credit' => '2',
                'filiere_id' => $phys->id,
                'cycle_id' => '1',
                'semestre_id' => '5'
            ]);
        //56
        DB::table('u_e_s')->insert([
                'code'    => 'TCC 1560',
                'nom' => "UE Transversale",
                'credit' => '2',
                'filiere_id' => $phys->id,
                'cycle_id' => '1',
                'semestre_id' => '5'
            ]);
    //############################################
        //SEMESTRE 6 Licence 3 Physique
        $phys = DB::table('filieres')->where('name', 'Physique')->first();
        //57
        DB::table('u_e_s')->insert([
                'code'    => 'PHY 1600',
                'nom' => 'Optique Physique',
                'credit' => '3',
                'filiere_id' => $phys->id,
                'cycle_id' => '1',
                'semestre_id' => '6'
            ]);
        //58
        DB::table('u_e_s')->insert([
                'code'    => 'PHY 1601',
                'nom' => 'Mécanique des Fluides',
                'credit' => '4',
                'filiere_id' => $phys->id,
                'cycle_id' => '1',
                'semestre_id' => '6'
            ]);
        //59
        DB::table('u_e_s')->insert([
                'code'    => 'PHY 1602',
                'nom' => 'Thermodynamique Machines Thermiques',
                'credit' => '3',
                'filiere_id' => $phys->id,
                'cycle_id' => '1',
                'semestre_id' => '6'
            ]);
        //60
        DB::table('u_e_s')->insert([
                'code'    => 'PHY 1603',
                'nom' => 'Mécanique Analytique',
                'credit' => '3',
                'filiere_id' => $phys->id,
                'cycle_id' => '1',
                'semestre_id' => '6'
            ]);
        //61
        DB::table('u_e_s')->insert([
                'code'    => 'PHY 1604',
                'nom' => "Théorie du Signal et Notions sur les Lasers",
                'credit' => '4',
                'filiere_id' => $phys->id,
                'cycle_id' => '1',
                'semestre_id' => '6'
            ]);
        //62
        DB::table('u_e_s')->insert([
                'code'    => 'PHY 1605',
                'nom' => "RDM",
                'credit' => '3',
                'filiere_id' => $phys->id,
                'cycle_id' => '1',
                'semestre_id' => '6'
            ]);
        //63
        DB::table('u_e_s')->insert([
                'code'    => 'PHY 1606',
                'nom' => "Radioactivité et Physique Nucléaire",
                'credit' => '2',
                'filiere_id' => $phys->id,
                'cycle_id' => '1',
                'semestre_id' => '6'
            ]);
        //64
        DB::table('u_e_s')->insert([
                'code'    => 'PHY 1607',
                'nom' => "Étude de l'Ionosphère",
                'credit' => '2',
                'filiere_id' => $phys->id,
                'cycle_id' => '1',
                'semestre_id' => '6'
            ]);
        //65
        DB::table('u_e_s')->insert([
                'code'    => 'PHY 1608',
                'nom' => "Physique Atomique et Moléculaire",
                'credit' => '2',
                'filiere_id' => $phys->id,
                'cycle_id' => '1',
                'semestre_id' => '6'
            ]);
        //66
        DB::table('u_e_s')->insert([
                'code'    => 'PHY 1609',
                'nom' => "TP Physique",
                'credit' => '2',
                'filiere_id' => $phys->id,
                'cycle_id' => '1',
                'semestre_id' => '6'
            ]);
        //67
        DB::table('u_e_s')->insert([
                'code'    => 'TCC 1660',
                'nom' => "UE-Transversale",
                'credit' => '2',
                'filiere_id' => $phys->id,
                'cycle_id' => '1',
                'semestre_id' => '6'
            ]);

    //############################################
        //SEMESTRE 5 Licence 3 Chimie
        $chimie = DB::table('filieres')->where('name', 'Chimie')->first();
        //68
        DB::table('u_e_s')->insert([
                'code'    => 'CHM 1500',
                'nom' => 'Chimie Théorique',
                'credit' => '4',
                'filiere_id' => $chimie->id,
                'cycle_id' => '1',
                'semestre_id' => '5'
            ]);
        //69
        DB::table('u_e_s')->insert([
                'code'    => 'CHM 1501',
                'nom' => 'Chimie Organique 2',
                'credit' => '4',
                'filiere_id' => $chimie->id,
                'cycle_id' => '1',
                'semestre_id' => '5'
            ]);
        //70
        DB::table('u_e_s')->insert([
                'code'    => 'CHM 1502',
                'nom' => 'Chimie Minérale xx',
                'credit' => '4',
                'filiere_id' => $chimie->id,
                'cycle_id' => '1',
                'semestre_id' => '5'
            ]);
        //71
        DB::table('u_e_s')->insert([
                'code'    => 'CHM 1503',
                'nom' => 'Chimie Analytique',
                'credit' => '5',
                'filiere_id' => $chimie->id,
                'cycle_id' => '1',
                'semestre_id' => '5'
            ]);
        //72
        DB::table('u_e_s')->insert([
                'code'    => 'CHM 1504',
                'nom' => 'Electrochimie',
                'credit' => '3',
                'filiere_id' => $chimie->id,
                'cycle_id' => '1',
                'semestre_id' => '5'
            ]);
        //73
        DB::table('u_e_s')->insert([
                'code'    => 'CHM 1505',
                'nom' => 'Méthode de caractérisation Physique',
                'credit' => '3',
                'filiere_id' => $chimie->id,
                'cycle_id' => '1',
                'semestre_id' => '5'
            ]);
        //74
        DB::table('u_e_s')->insert([
                'code'    => 'CHM 1506',
                'nom' => 'Méthode de Séparation',
                'credit' => '3',
                'filiere_id' => $chimie->id,
                'cycle_id' => '1',
                'semestre_id' => '5'
            ]);
        //75
        DB::table('u_e_s')->insert([
                'code'    => 'TCC 1560',
                'nom' => 'UE Libres',
                'credit' => '2',
                'filiere_id' => $chimie->id,
                'cycle_id' => '1',
                'semestre_id' => '5'
            ]);
        //76
        DB::table('u_e_s')->insert([
                'code'    => 'TCC 1561',
                'nom' => 'UE - transversale',
                'credit' => '2',
                'filiere_id' => $chimie->id,
                'cycle_id' => '1',
                'semestre_id' => '5'
            ]);
        
    //############################################
        //SEMESTRE 6 Licence 3 Chimie
        $chimie = DB::table('filieres')->where('name', 'Chimie')->first();
        //77
        DB::table('u_e_s')->insert([
                'code'    => 'CHM 1600',
                'nom' => 'Thermodynamique Chimique',
                'credit' => '6',
                'filiere_id' => $chimie->id,
                'cycle_id' => '1',
                'semestre_id' => '6'
            ]);
        //78
        DB::table('u_e_s')->insert([
                'code'    => 'CHM 1601',
                'nom' => 'Chimie Organique 3',
                'credit' => '6',
                'filiere_id' => $chimie->id,
                'cycle_id' => '1',
                'semestre_id' => '6'
            ]);
        //79
        DB::table('u_e_s')->insert([
                'code'    => 'CHM 1602',
                'nom' => 'Chimie Minérale xx',
                'credit' => '6',
                'filiere_id' => $chimie->id,
                'cycle_id' => '1',
                'semestre_id' => '6'
            ]);
        //80
        DB::table('u_e_s')->insert([
                'code'    => 'CHM 1603',
                'nom' => 'Chimie Théorique',
                'credit' => '2',
                'filiere_id' => $chimie->id,
                'cycle_id' => '1',
                'semestre_id' => '6'
            ]);
        //81
        DB::table('u_e_s')->insert([
                'code'    => 'CHM 1604',
                'nom' => 'Chimie Physique',
                'credit' => '3',
                'filiere_id' => $chimie->id,
                'cycle_id' => '1',
                'semestre_id' => '6'
            ]);
        //82
        DB::table('u_e_s')->insert([
                'code'    => 'CHM 1605',
                'nom' => 'Electrochimie',
                'credit' => '3',
                'filiere_id' => $chimie->id,
                'cycle_id' => '1',
                'semestre_id' => '6'
            ]);
        //83
        DB::table('u_e_s')->insert([
                'code'    => 'TCC 1660',
                'nom' => 'UE Libres',
                'credit' => '2',
                'filiere_id' => $chimie->id,
                'cycle_id' => '1',
                'semestre_id' => '6'
            ]);
        //84
        DB::table('u_e_s')->insert([
                'code'    => 'TCC 1661',
                'nom' => 'UE Transversale s6',
                'credit' => '2',
                'filiere_id' => $chimie->id,
                'cycle_id' => '1',
                'semestre_id' => '6'
            ]);
//A partir d ici on met l UE ensuite l ECU dans ce meme fichier
    //############################################
        //SEMESTRE 5 Licence 3 Informatique
        //UE 85
        $info = DB::table('filieres')->where('name', 'Informatique')->first();
        DB::table('u_e_s')->insert([
                'code'    => 'INF 1500',
                'nom' => 'Orienté Objet',
                'credit' => '6',
                'filiere_id' => $info->id,
                'cycle_id' => '1',
                'semestre_id' => '5'
            ]);
        $UE_id = DB::getPdo()->lastInsertId();
        //ECU 131
        DB::table('e_c_u_s')->insert([
                'code'    => '1INF 1500',
                'nom' => 'Conception Orientée Objet',
                'coefficient' => '2',
                'u_e_id' => $UE_id
            ]);
        //ECU 132
        DB::table('e_c_u_s')->insert([
                'code'    => '2INF 1500',
                'nom' => 'Programmation Orientée Objet Avancé',
                'coefficient' => '4',
                'u_e_id' => $UE_id
            ]);

        //UE 86
        DB::table('u_e_s')->insert([
                'code'    => 'INF 1501',
                'nom' => 'Bases de Données',
                'credit' => '3',
                'filiere_id' => $info->id,
                'cycle_id' => '1',
                'semestre_id' => '5'
            ]);
        $UE_id = DB::getPdo()->lastInsertId();
        //ECU 133
        DB::table('e_c_u_s')->insert([
                'code'    => '1INF 1501',
                'nom' => 'Bases de données 2',
                'coefficient' => '3',
                'u_e_id' => $UE_id
            ]);

        //UE 87
        DB::table('u_e_s')->insert([
                'code'    => 'INF 1502',
                'nom' => 'Compilation',
                'credit' => '4',
                'filiere_id' => $info->id,
                'cycle_id' => '1',
                'semestre_id' => '5'
            ]);
        $UE_id = DB::getPdo()->lastInsertId();
        //ECU 134
        DB::table('e_c_u_s')->insert([
                'code'    => '1INF 1502',
                'nom' => 'Logique pour informatique',
                'coefficient' => '2',
                'u_e_id' => $UE_id
            ]);
        //ECU 135
        DB::table('e_c_u_s')->insert([
                'code'    => '2INF 1502',
                'nom' => 'Théorie de compilation',
                'coefficient' => '2',
                'u_e_id' => $UE_id
            ]);

        //UE 88
        DB::table('u_e_s')->insert([
                'code'    => 'INF 1503',
                'nom' => 'Technologies Web 1',
                'credit' => '3',
                'filiere_id' => $info->id,
                'cycle_id' => '1',
                'semestre_id' => '5'
            ]);
        $UE_id = DB::getPdo()->lastInsertId();
        //ECU 136
        DB::table('e_c_u_s')->insert([
                'code'    => '1INF 1503',
                'nom' => 'Technologies Web 1',
                'coefficient' => '3',
                'u_e_id' => $UE_id
            ]);

        //UE 89
        DB::table('u_e_s')->insert([
                'code'    => 'INF 1504',
                'nom' => 'Programmation Avancée',
                'credit' => '6',
                'filiere_id' => $info->id,
                'cycle_id' => '1',
                'semestre_id' => '5'
            ]);
        $UE_id = DB::getPdo()->lastInsertId();
        //ECU 137
        DB::table('e_c_u_s')->insert([
                'code'    => '1INF 1504',
                'nom' => 'Théorie des Graphes',
                'coefficient' => '1',
                'u_e_id' => $UE_id
            ]);
        //ECU 138
        DB::table('e_c_u_s')->insert([
                'code'    => '2INF 1504',
                'nom' => 'Complexité des algorithmes',
                'coefficient' => '2',
                'u_e_id' => $UE_id
            ]);
        //ECU 139
        DB::table('e_c_u_s')->insert([
                'code'    => '3INF 1504',
                'nom' => 'Programmation Système',
                'coefficient' => '3',
                'u_e_id' => $UE_id
            ]);

        //UE 90
        DB::table('u_e_s')->insert([
                'code'    => 'INF 1505',
                'nom' => 'Génie Logiciel',
                'credit' => '2',
                'filiere_id' => $info->id,
                'cycle_id' => '1',
                'semestre_id' => '5'
            ]);
        $UE_id = DB::getPdo()->lastInsertId();
        //ECU 140
        DB::table('e_c_u_s')->insert([
                'code'    => '1INF 1505',
                'nom' => 'Génie Logiciel',
                'coefficient' => '2',
                'u_e_id' => $UE_id
            ]);

        //UE 91
        DB::table('u_e_s')->insert([
                'code'    => 'INF 1506',
                'nom' => 'Réseaux et Systèmes',
                'credit' => '6',
                'filiere_id' => $info->id,
                'cycle_id' => '1',
                'semestre_id' => '5'
            ]);
        $UE_id = DB::getPdo()->lastInsertId();
        //ECU 141
        DB::table('e_c_u_s')->insert([
                'code'    => '1INF 1505',
                'nom' => 'Réseaux Informatiques 2',
                'coefficient' => '3',
                'u_e_id' => $UE_id
            ]);
        //ECU 142
        DB::table('e_c_u_s')->insert([
                'code'    => '2INF 1505',
                'nom' => 'Administration Système Linux',
                'coefficient' => '3',
                'u_e_id' => $UE_id
            ]);

    //############################################
        //SEMESTRE 6 Licence 3 Informatique
        //UE 92
        $info = DB::table('filieres')->where('name', 'Informatique')->first();
        DB::table('u_e_s')->insert([
                'code'    => 'INF 1600',
                'nom' => 'Sécurité informatique',
                'credit' => '3',
                'filiere_id' => $info->id,
                'cycle_id' => '1',
                'semestre_id' => '6'
            ]);
        $UE_id = DB::getPdo()->lastInsertId();
        //ECU 143
        DB::table('e_c_u_s')->insert([
                'code'    => '1INF 1600',
                'nom' => 'Sécurité informatique',
                'coefficient' => '3',
                'u_e_id' => $UE_id
            ]);

        //UE 93
        DB::table('u_e_s')->insert([
                'code'    => 'INF 1601',
                'nom' => 'Technologies Web 2',
                'credit' => '3',
                'filiere_id' => $info->id,
                'cycle_id' => '1',
                'semestre_id' => '6'
            ]);
        $UE_id = DB::getPdo()->lastInsertId();
        //ECU 144
        DB::table('e_c_u_s')->insert([
                'code'    => '1INF 1601',
                'nom' => 'Technologies Web 2',
                'coefficient' => '3',
                'u_e_id' => $UE_id
            ]);

        //UE 94
        DB::table('u_e_s')->insert([
                'code'    => 'INF 1602',
                'nom' => 'Techniques d’expression',
                'credit' => '2',
                'filiere_id' => $info->id,
                'cycle_id' => '1',
                'semestre_id' => '6'
            ]);
        $UE_id = DB::getPdo()->lastInsertId();
        //ECU 145
        DB::table('e_c_u_s')->insert([
                'code'    => '1INF 1602',
                'nom' => 'Techniques d’expression',
                'coefficient' => '2',
                'u_e_id' => $UE_id
            ]);
        
        //UE 95
        DB::table('u_e_s')->insert([
                'code'    => 'INF 1603',
                'nom' => 'Maintenance des équipements informatiques',
                'credit' => '3',
                'filiere_id' => $info->id,
                'cycle_id' => '1',
                'semestre_id' => '6'
            ]);
        $UE_id = DB::getPdo()->lastInsertId();
        //ECU 146
        DB::table('e_c_u_s')->insert([
                'code'    => '1INF 1603',
                'nom' => 'Maintenance des équipements informatiques',
                'coefficient' => '3',
                'u_e_id' => $UE_id
            ]);
        
        //UE 96
        DB::table('u_e_s')->insert([
                'code'    => 'INF 1604',
                'nom' => "Développement d’application mobile",
                'credit' => '2',
                'filiere_id' => $info->id,
                'cycle_id' => '1',
                'semestre_id' => '6'
            ]);
        $UE_id = DB::getPdo()->lastInsertId();
        //ECU 147
        DB::table('e_c_u_s')->insert([
                'code'    => '1INF 1604',
                'nom' => "Développement d’application mobile",
                'coefficient' => '2',
                'u_e_id' => $UE_id
            ]);
        
        //UE 97
        DB::table('u_e_s')->insert([
                'code'    => 'INF 1605',
                'nom' => "Réseaux sans fil",
                'credit' => '2',
                'filiere_id' => $info->id,
                'cycle_id' => '1',
                'semestre_id' => '6'
            ]);
        $UE_id = DB::getPdo()->lastInsertId();
        //ECU 148
        DB::table('e_c_u_s')->insert([
                'code'    => '1INF 1605',
                'nom' => "Réseaux sans fil",
                'coefficient' => '2',
                'u_e_id' => $UE_id
            ]);
        
        //UE 98
        DB::table('u_e_s')->insert([
                'code'    => 'INF 1606',
                'nom' => "Gestion de projets informatiques",
                'credit' => '2',
                'filiere_id' => $info->id,
                'cycle_id' => '1',
                'semestre_id' => '6'
            ]);
        $UE_id = DB::getPdo()->lastInsertId();
        //ECU 149
        DB::table('e_c_u_s')->insert([
                'code'    => '1INF 1606',
                'nom' => "Gestion de projets informatiques",
                'coefficient' => '2',
                'u_e_id' => $UE_id
            ]);
        
        //UE 99
        DB::table('u_e_s')->insert([
                'code'    => 'INF 1607',
                'nom' => "Rédaction de documents scientifiques",
                'credit' => '2',
                'filiere_id' => $info->id,
                'cycle_id' => '1',
                'semestre_id' => '6'
            ]);
        $UE_id = DB::getPdo()->lastInsertId();
        //ECU 150
        DB::table('e_c_u_s')->insert([
                'code'    => '1INF 1607',
                'nom' => "Rédaction de documents scientifiques",
                'coefficient' => '2',
                'u_e_id' => $UE_id
            ]);
        
        //UE 100
        DB::table('u_e_s')->insert([
                'code'    => 'TCC 1660',
                'nom' => "UE Transversale",
                'credit' => '2',
                'filiere_id' => $info->id,
                'cycle_id' => '1',
                'semestre_id' => '6'
            ]);
        $UE_id = DB::getPdo()->lastInsertId();
        //ECU 151
        DB::table('e_c_u_s')->insert([
                'code'    => '1TCC 1660',
                'nom' => "Initiation au Projet Professionnel",
                'coefficient' => '2',
                'u_e_id' => $UE_id
            ]);
        
        //UE 101
        DB::table('u_e_s')->insert([
                'code'    => 'INF 1661',
                'nom' => "Présentation projet tutoré",
                'credit' => '3',
                'filiere_id' => $info->id,
                'cycle_id' => '1',
                'semestre_id' => '6'
            ]);
        $UE_id = DB::getPdo()->lastInsertId();
        //ECU 152
        DB::table('e_c_u_s')->insert([
                'code'    => '1INF 1661',
                'nom' => "Présentation projet tutoré",
                'coefficient' => '3',
                'u_e_id' => $UE_id
            ]);
        
        //UE 102
        DB::table('u_e_s')->insert([
                'code'    => 'INF 1661',
                'nom' => "Rapport projet tutoré",
                'credit' => '6',
                'filiere_id' => $info->id,
                'cycle_id' => '1',
                'semestre_id' => '6'
            ]);
        $UE_id = DB::getPdo()->lastInsertId();
        //ECU 153
        DB::table('e_c_u_s')->insert([
                'code'    => '1INF 1661',
                'nom' => "Rapport projet tutoré",
                'coefficient' => '6',
                'u_e_id' => $UE_id
            ]);
        
    }
}
