<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ECUSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker::create();
    /*##########################################
        DONNEES
    */  
    $datas = [
        [

        ],
        [],
    ];
    
    //##########################################
        //Semestre 1 Licence 1
        //1
        $physique = DB::table('u_e_s')->where('nom', 'Physique 1')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1PHY 1100',
                'nom' => 'Electricité',
                'coefficient' => '3',
                'u_e_id' => $physique->id
            ]);

        //2
        DB::table('e_c_u_s')->insert([
                'code'    => '2PHY 1100',
                'nom' => 'Mécanique du point',
                'coefficient' => '3',
                'u_e_id' => $physique->id
            ]);

        //3
        $math = DB::table('u_e_s')->where('nom', 'Mathématiques 1')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1MTH 1100',
                'nom' => 'Analyse 1',
                'coefficient' => '4',
                'u_e_id' => $math->id
            ]);

        //4
        DB::table('e_c_u_s')->insert([
                'code'    => '2MTH 1100',
                'nom' => 'Algèbre 1',
                'coefficient' => '2',
                'u_e_id' => $math->id
            ]);

        //5
        $chimie = DB::table('u_e_s')->where('nom', 'Chimie 1')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1CHM 1100',
                'nom' => 'Atomistique',
                'coefficient' => '2',
                'u_e_id' => $chimie->id
            ]);
        //6
        DB::table('e_c_u_s')->insert([
                'code'    => '2CHM 1100',
                'nom' => 'Liaisons chimiques',
                'coefficient' => '2',
                'u_e_id' => $chimie->id
            ]);
        //7
        DB::table('e_c_u_s')->insert([
                'code'    => '3CHM 1100',
                'nom' => 'Termochimi et Equilibre Chimique',
                'coefficient' => '2',
                'u_e_id' => $chimie->id
            ]);

        //8
        $info = DB::table('u_e_s')->where('nom', 'Informatique 1')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1INF 1100',
                'nom' => 'Algorithmique',
                'coefficient' => '4',
                'u_e_id' => $info->id
            ]);
        //9
        DB::table('e_c_u_s')->insert([
                'code'    => '2INF 1100',
                'nom' => 'Programmation',
                'coefficient' => '2',
                'u_e_id' => $info->id
            ]);

        //10
        $transv = DB::table('u_e_s')->where('nom', 'UE transversales 1')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1TTC 1160',
                'nom' => 'Statistique Descriptve',
                'coefficient' => '2',
                'u_e_id' => $transv->id
            ]);
        //11
        DB::table('e_c_u_s')->insert([
                'code'    => '2TTC 1160',
                'nom' => 'Anglais Scientifique',
                'coefficient' => '2',
                'u_e_id' => $transv->id
            ]);
        //12
        DB::table('e_c_u_s')->insert([
                'code'    => '3TTC 1160',
                'nom' => 'Généralités sur les TIC',
                'coefficient' => '2',
                'u_e_id' => $transv->id
            ]);

    //##########################################
        //Semestre 2 Licence 1
        //13
        $physique = DB::table('u_e_s')->where('nom', 'Physique 2')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1PHY 1200',
                'nom' => 'Physique Expérimentale 1',
                'coefficient' => '1',
                'u_e_id' => $physique->id
            ]);

        //14
        DB::table('e_c_u_s')->insert([
                'code'    => '2PHY 1200',
                'nom' => 'Optique Géométrique',
                'coefficient' => '2',
                'u_e_id' => $physique->id
            ]);

        //15
        DB::table('e_c_u_s')->insert([
                'code'    => '3PHY 1200',
                'nom' => 'Magnétostatique et Régime variable',
                'coefficient' => '2',
                'u_e_id' => $physique->id
            ]);

        //16
        $math = DB::table('u_e_s')->where('nom', 'Mathématiques 2')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1MTH 1200',
                'nom' => 'Analyse 2',
                'coefficient' => '2',
                'u_e_id' => $math->id
            ]);

        //17
        DB::table('e_c_u_s')->insert([
                'code'    => '2MTH 1200',
                'nom' => 'Algèbre Linéaire 1',
                'coefficient' => '3',
                'u_e_id' => $math->id
            ]);

        //18
        $chimie = DB::table('u_e_s')->where('nom', 'Chimie 2')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1CHM 1200',
                'nom' => 'Chimie Expérimentale 1',
                'coefficient' => '1',
                'u_e_id' => $chimie->id
            ]);
        //19
        DB::table('e_c_u_s')->insert([
                'code'    => '2CHM 1200',
                'nom' => 'Équilibre chimique en solution',
                'coefficient' => '2',
                'u_e_id' => $chimie->id
            ]);
        //20
        DB::table('e_c_u_s')->insert([
                'code'    => '3CHM 1200',
                'nom' => 'Chimie organique générale',
                'coefficient' => '2',
                'u_e_id' => $chimie->id
            ]);

        //21
        $info = DB::table('u_e_s')->where('nom', 'Informatique 2')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1INF 1200',
                'nom' => 'Algorithmique et Programmation',
                'coefficient' => '3',
                'u_e_id' => $info->id
            ]);
        //22
        DB::table('e_c_u_s')->insert([
                'code'    => '2INF 1200',
                'nom' => 'Architecture des ordinateurs',
                'coefficient' => '2',
                'u_e_id' => $info->id
            ]);

        //23
        $transv = DB::table('u_e_s')->where('nom', 'UE transversales 2')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1TTC 1260',
                'nom' => 'Anglais Scientifique',
                'coefficient' => '2',
                'u_e_id' => $transv->id
            ]);
        //24
        DB::table('e_c_u_s')->insert([
                'code'    => '2TTC 1260',
                'nom' => 'Initiation au droit',
                'coefficient' => '1',
                'u_e_id' => $transv->id
            ]);
        //25
        DB::table('e_c_u_s')->insert([
                'code'    => '3TTC 1260',
                'nom' => 'Epistémologie',
                'coefficient' => '2',
                'u_e_id' => $transv->id
            ]);

        //26
        $graph = DB::table('u_e_s')->where('nom', 'Sciences Graphiques')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1TTC 1261',
                'nom' => 'Statique Grapique',
                'coefficient' => '2',
                'u_e_id' => $graph->id
            ]);
        //27
        DB::table('e_c_u_s')->insert([
                'code'    => '2TTC 1261',
                'nom' => 'Déssin Assisté par Ordinateur(DAO)',
                'coefficient' => '2',
                'u_e_id' => $graph->id
            ]);
        //28
        DB::table('e_c_u_s')->insert([
                'code'    => '3TTC 1261',
                'nom' => 'Initiation au Graphismes',
                'coefficient' => '1',
                'u_e_id' => $graph->id
            ]);

    //##########################################
        //Semestre 3 Licence 2
        //29
        $physique = DB::table('u_e_s')->where('nom', 'Physique 3-1')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1PHY 1300',
                'nom' => 'Thermodynamique Physique',
                'coefficient' => '3',
                'u_e_id' => $physique->id
            ]);

        //30
        DB::table('e_c_u_s')->insert([
                'code'    => '2PHY 1300',
                'nom' => 'Électromagnétisme er relativité restreinte',
                'coefficient' => '3',
                'u_e_id' => $physique->id
            ]);
        //31
        $physique = DB::table('u_e_s')->where('nom', 'Physique 3-2')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1PHY 1301',
                'nom' => 'Optique Physique',
                'coefficient' => '3',
                'u_e_id' => $physique->id
            ]);

        //32
        $math = DB::table('u_e_s')->where('nom', 'Mathématiques 3-1')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1MTH 1300',
                'nom' => 'Algèbre 2',
                'coefficient' => '3',
                'u_e_id' => $math->id
            ]);

        //33
        DB::table('e_c_u_s')->insert([
                'code'    => '2MTH 1300',
                'nom' => 'Algèbre Linéaire 2',
                'coefficient' => '3',
                'u_e_id' => $math->id
            ]);

        //34
        $math = DB::table('u_e_s')->where('nom', 'Mathématiques 3-2')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1MTH 1301',
                'nom' => 'Analyse 3',
                'coefficient' => '3',
                'u_e_id' => $math->id
            ]);

        //35
        $chimie = DB::table('u_e_s')->where('nom', 'Chimie 2')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1CHM 1300',
                'nom' => 'Chimie Minérale',
                'coefficient' => '3',
                'u_e_id' => $chimie->id
            ]);
        //36
        DB::table('e_c_u_s')->insert([
                'code'    => '2CHM 1300',
                'nom' => 'Cinétique chimique',
                'coefficient' => '3',
                'u_e_id' => $chimie->id
            ]);

        //37
        $info = DB::table('u_e_s')->where('nom', 'Informatique 3')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1INF 1300',
                'nom' => 'Structures de données et Programmation',
                'coefficient' => '3',
                'u_e_id' => $info->id
            ]);
        //38
        DB::table('e_c_u_s')->insert([
                'code'    => '2INF 1300',
                'nom' => "Système d'exploitation",
                'coefficient' => '3',
                'u_e_id' => $info->id
            ]);

    //##########################################
        //Semestre 4 Licence 2 Math
        //39
        $math = DB::table('u_e_s')->where('nom', 'Algèbre 4')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1MTH 1400',
                'nom' => 'Algèbre 4',
                'coefficient' => '5',
                'u_e_id' => $math->id
            ]);
        //40
        $math = DB::table('u_e_s')->where('nom', 'Analyse 4')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1MTH 1401',
                'nom' => 'Analyse 4',
                'coefficient' => '5',
                'u_e_id' => $math->id
            ]);
        //41
        $math = DB::table('u_e_s')->where('nom', 'Analyse 4')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1MTH 1402',
                'nom' => 'Calcul Numérique',
                'coefficient' => '4',
                'u_e_id' => $math->id
            ]);
        //42
        $math = DB::table('u_e_s')->where('nom', 'Optimisation')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1MTH 1403',
                'nom' => 'Optimisation',
                'coefficient' => '4',
                'u_e_id' => $math->id
            ]);
        //43
        $math = DB::table('u_e_s')->where('nom', 'Géométrie des courbes et surfaces')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1MTH 1404',
                'nom' => 'Géométrie des courbes et surfaces',
                'coefficient' => '5',
                'u_e_id' => $math->id
            ]);
        //44
        $math = DB::table('u_e_s')->where('nom', 'Statistiques Mathématiques')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1MTH 1405',
                'nom' => 'Statistiques Mathématiques',
                'coefficient' => '4',
                'u_e_id' => $math->id
            ]);
        //45
        $math = DB::table('u_e_s')->where('nom', 'Géométrie Affine et Euclidienne')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1MTH 1406',
                'nom' => 'Géométrie Affine et Euclidienne',
                'coefficient' => '3',
                'u_e_id' => $math->id
            ]);
    //##########################################
        //Semestre 4 Licence 2 PHY
        //46
        $physique = DB::table('u_e_s')->where('nom', 'Physique Expérimentale')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1PHY 1400',
                'nom' => 'Physique Expérimentale',
                'coefficient' => '3',
                'u_e_id' => $physique->id
            ]);
        //47
        $physique = DB::table('u_e_s')->where('nom', 'Mécanique des Fluides')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1PHY 1401',
                'nom' => 'Mécanique des Fluides',
                'coefficient' => '3',
                'u_e_id' => $physique->id
            ]);
        //48
        $physique = DB::table('u_e_s')->where('nom', 'Électronique Analogique')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1PHY 1402',
                'nom' => 'Électronique Analogique',
                'coefficient' => '5',
                'u_e_id' => $physique->id
            ]);
        //49
        $physique = DB::table('u_e_s')->where('nom', 'Mécanique du Solide 1')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1PHY 1403',
                'nom' => 'Mécanique du Point Approfondissement',
                'coefficient' => '2',
                'u_e_id' => $physique->id
            ]);
        //50
        DB::table('e_c_u_s')->insert([
                'code'    => '2PHY 1403',
                'nom' => 'Mécanique Physique',
                'coefficient' => '3',
                'u_e_id' => $physique->id
            ]);
        //51
        $physique = DB::table('u_e_s')->where('nom', 'Mécanique Quantique 1')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1PHY 1404',
                'nom' => 'Mécanique Quantique 1',
                'coefficient' => '5',
                'u_e_id' => $physique->id
            ]);
        //52
        $physique = DB::table('u_e_s')->where('nom', 'Anglais Scientifique')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => 'TTC 1460',
                'nom' => 'Anglais Scientifique',
                'coefficient' => '2',
                'u_e_id' => $physique->id
            ]);
        //53
        $physique = DB::table('u_e_s')->where('nom', 'Outils Mathématiques et Informatique')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1MTH 1400',
                'nom' => 'Mathématiques pour la Physique',
                'coefficient' => '2',
                'u_e_id' => $physique->id
            ]);
        //54
        DB::table('e_c_u_s')->insert([
                'code'    => '2MTH 1400',
                'nom' => 'Approfondissement Graphique',
                'coefficient' => '2',
                'u_e_id' => $physique->id
            ]);
        //55
        $physique = DB::table('u_e_s')->where('nom', 'Chimie')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1CHM 1400',
                'nom' => 'Initiation à la Chimie des Eaux et des Sols',
                'coefficient' => '1',
                'u_e_id' => $physique->id
            ]);
        //56
        DB::table('e_c_u_s')->insert([
                'code'    => '2CHM 1400',
                'nom' => 'Chimie Verte',
                'coefficient' => '2',
                'u_e_id' => $physique->id
            ]);

        //##########################################
        //Semestre 4 Licence 2 Chimie
        //57
        $chimie = DB::table('u_e_s')->where('nom', 'Chimie des matériaux Inorganiques')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1CHM 1400',
                'nom' => 'Chimie des matériaux Inorganiques',
                'coefficient' => '4',
                'u_e_id' => $chimie->id
            ]);
        //58
        $chimie = DB::table('u_e_s')->where('nom', 'Chimie Organique Descriptive')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1CHM 1401',
                'nom' => 'Chimie Organique Descriptive',
                'coefficient' => '4',
                'u_e_id' => $chimie->id
            ]);
        //59
        $chimie = DB::table('u_e_s')->where('nom', 'Chimie Quantique')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1CHM 1402',
                'nom' => 'Chimie Quantique',
                'coefficient' => '3',
                'u_e_id' => $chimie->id
            ]);
        //60
        $chimie = DB::table('u_e_s')->where('nom', 'Chimie Analytique')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1CHM 1403',
                'nom' => 'Chimie Analytique',
                'coefficient' => '3',
                'u_e_id' => $chimie->id
            ]);
        //62
        $chimie = DB::table('u_e_s')->where('nom', 'Électrochimie')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1CHM 1404',
                'nom' => 'Électrochimie',
                'coefficient' => '4',
                'u_e_id' => $chimie->id
            ]);
        //63
        $chimie = DB::table('u_e_s')->where('nom', 'Mécanique Quantique')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1PHY 1400',
                'nom' => 'Mécanique Quantique',
                'coefficient' => '3',
                'u_e_id' => $chimie->id
            ]);
        //64
        $chimie = DB::table('u_e_s')->where('nom', 'Thermodynamique')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1PHY 1401',
                'nom' => 'Thermodynamique',
                'coefficient' => '4',
                'u_e_id' => $chimie->id
            ]);
        //65
        $chimie = DB::table('u_e_s')->where('nom', "Méthodes Statistique d'Analyse de données")->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1CHM 1400',
                'nom' => "Méthodes Statistique d'Analyse de données",
                'coefficient' => '2',
                'u_e_id' => $chimie->id
            ]);
        //65
        $chimie = DB::table('u_e_s')->where('nom', "UE transversales")->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1TTC 1460',
                'nom' => "Mathématiques pour Chimiste",
                'coefficient' => '1',
                'u_e_id' => $chimie->id
            ]);
        //66
        DB::table('e_c_u_s')->insert([
                'code'    => '2TTC 1460',
                'nom' => "Chimie Expérimentale 2",
                'coefficient' => '1',
                'u_e_id' => $chimie->id
            ]);
        //67
        DB::table('e_c_u_s')->insert([
                'code'    => '3TTC 1460',
                'nom' => "Chimie Verte",
                'coefficient' => '1',
                'u_e_id' => $chimie->id
            ]);

    //##########################################
        //Semestre 4 Licence 2 Informatique
        //68
        $info = DB::table('u_e_s')->where('nom', 'Probabilités et Statistiques')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1MTH 1400',
                'nom' => 'Probabilité',
                'coefficient' => '2',
                'u_e_id' => $info->id
            ]);
        //69
        DB::table('e_c_u_s')->insert([
                'code'    => '2MTH 1400',
                'nom' => 'Statistique',
                'coefficient' => '2',
                'u_e_id' => $info->id
            ]);
        //70
        $info = DB::table('u_e_s')->where('nom', 'Fondamentaux Scientifique')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1MTH 1401',
                'nom' => 'Calcul Numérique',
                'coefficient' => '2',
                'u_e_id' => $info->id
            ]);
        //71
        DB::table('e_c_u_s')->insert([
                'code'    => '1MTH 1401',
                'nom' => 'Recherche Opérationnel',
                'coefficient' => '2',
                'u_e_id' => $info->id
            ]);
        //72
        $info = DB::table('u_e_s')->where('nom', 'Introduction à la POO')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1INF 1400',
                'nom' => 'Introduction à la POO',
                'coefficient' => '3',
                'u_e_id' => $info->id
            ]);
        //73
        $info = DB::table('u_e_s')->where('nom', 'Structure de données avancées')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1INF 1401',
                'nom' => 'Structure de données avancées',
                'coefficient' => '3',
                'u_e_id' => $info->id
            ]);
        //74
        $info = DB::table('u_e_s')->where('nom', "Base de données et Système d'information")->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1INF 1402',
                'nom' => 'Base de données',
                'coefficient' => '3',
                'u_e_id' => $info->id
            ]);
        //75
        DB::table('e_c_u_s')->insert([
                'code'    => '2INF 1402',
                'nom' => "Système d'information",
                'coefficient' => '3',
                'u_e_id' => $info->id
            ]);
        //76
        $info = DB::table('u_e_s')->where('nom', "Réseau et Système Informatique")->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1INF 1403',
                'nom' => 'Introdution aux Réseaux Informatique',
                'coefficient' => '3',
                'u_e_id' => $info->id
            ]);
        //77
        DB::table('e_c_u_s')->insert([
                'code'    => '2INF 1403',
                'nom' => 'Architecture des Ordinateurs',
                'coefficient' => '3',
                'u_e_id' => $info->id
            ]);
        //78
        $info = DB::table('u_e_s')->where('nom', "UE-transversales")->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1TTC 1460',
                'nom' => 'Technique Quantitative de Gestion',
                'coefficient' => '2',
                'u_e_id' => $info->id
            ]);
        //79
        DB::table('e_c_u_s')->insert([
                'code'    => '2TTC 1460',
                'nom' => 'Droit du travail',
                'coefficient' => '2',
                'u_e_id' => $info->id
            ]);

    //##########################################
        //Semestre 5 Licence 3 Math
        //80
        $math = DB::table('u_e_s')->where('nom', 'Algèbre 5')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1MTH 1500',
                'nom' => 'Algèbre 5',
                'coefficient' => '6',
                'u_e_id' => $math->id
            ]);
        //81
        $math = DB::table('u_e_s')->where('nom', 'Analyse 5')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1MTH 1501',
                'nom' => 'Analyse 5',
                'coefficient' => '3',
                'u_e_id' => $math->id
            ]);
        //82
        $math = DB::table('u_e_s')->where('nom', 'Topologie Générale')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1MTH 1502',
                'nom' => 'Topologie Générale',
                'coefficient' => '4',
                'u_e_id' => $math->id
            ]);
        //83
        $math = DB::table('u_e_s')->where('nom', 'Statistique avancée 1')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1MTH 1503',
                'nom' => 'Statistique avancée 1',
                'coefficient' => '3',
                'u_e_id' => $math->id
            ]);
        //84
        $math = DB::table('u_e_s')->where('nom', 'Calcul Différentiel')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1MTH 1504',
                'nom' => 'Calcul Différentiel',
                'coefficient' => '3',
                'u_e_id' => $math->id
            ]);
        //84
        $math = DB::table('u_e_s')->where('nom', 'Analyse Complexe')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1MTH 1505',
                'nom' => 'Analyse Complexe',
                'coefficient' => '3',
                'u_e_id' => $math->id
            ]);
        //85
        $math = DB::table('u_e_s')->where('nom', 'Analyse des Données')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1MTH 1506',
                'nom' => 'Analyse des Données',
                'coefficient' => '3',
                'u_e_id' => $math->id
            ]);
        //86
        $math = DB::table('u_e_s')->where('nom', 'Calcul Scientifique et Traitement de Texte Scientifique')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1MTH 1507',
                'nom' => 'Calcul Scientifique et Traitement de Texte Scientifique',
                'coefficient' => '2',
                'u_e_id' => $math->id
            ]);
        //87
        $math = DB::table('u_e_s')->where('nom', 'Analyse Numérique')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1MTH 1508',
                'nom' => 'Analyse Numérique',
                'coefficient' => '3',
                'u_e_id' => $math->id
            ]);

    //##########################################
        //Semestre 6 Licence 3 Math
        //88
        $math = DB::table('u_e_s')->where('nom', 'Algèbre 6')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1MTH 1600',
                'nom' => 'Algèbre 6',
                'coefficient' => '6',
                'u_e_id' => $math->id
            ]);
        //81
        $math = DB::table('u_e_s')->where('nom', 'Mesure et Intégration')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1MTH 1601',
                'nom' => 'Mesure et Intégration',
                'coefficient' => '4',
                'u_e_id' => $math->id
            ]);
        //82
        $math = DB::table('u_e_s')->where('nom', 'Géométrie Différentiel')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1MTH 1602',
                'nom' => 'Géométrie Différentiel',
                'coefficient' => '4',
                'u_e_id' => $math->id
            ]);
        //83
        $math = DB::table('u_e_s')->where('nom', 'Inférence Statistique')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1MTH 1603',
                'nom' => 'Inférence Statistique',
                'coefficient' => '4',
                'u_e_id' => $math->id
            ]);
        //84
        $math = DB::table('u_e_s')->where('nom', 'Recherche Opérationnelle')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1MTH 1604',
                'nom' => 'Recherche Opérationnelle',
                'coefficient' => '4',
                'u_e_id' => $math->id
            ]);
        //84
        $math = DB::table('u_e_s')->where('nom', 'Optimisation non Linéaire')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1MTH 1605',
                'nom' => 'Optimisation non Linéaire',
                'coefficient' => '3',
                'u_e_id' => $math->id
            ]);
        //85
        $math = DB::table('u_e_s')->where('nom', 'Statistique Avancée 2')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1MTH 1606',
                'nom' => 'Statistique Avancée 2',
                'coefficient' => '3',
                'u_e_id' => $math->id
            ]);
        //86
        $math = DB::table('u_e_s')->where('nom', 'Initiation au Projet Professionnel')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1MTH 1607',
                'nom' => 'Initiation au Projet Professionnel',
                'coefficient' => '2',
                'u_e_id' => $math->id
            ]);

    //##########################################
        //Semestre 5 Licence 3 PHY
        //87
        $physique = DB::table('u_e_s')->where('nom', 'Physique du Solide')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1PHY 1501',
                'nom' => 'Mécanique du Solide Approfondissement',
                'coefficient' => '2',
                'u_e_id' => $physique->id
            ]);
        //88
        DB::table('e_c_u_s')->insert([
                'code'    => '2PHY 1501',
                'nom' => 'Initiation à la Cristallographie et Sciences des Matériaux',
                'coefficient' => '2',
                'u_e_id' => $physique->id
            ]);
        //89
        $physique = DB::table('u_e_s')->where('nom', 'Mécanique Quantique 2')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1PHY 1502',
                'nom' => 'Mécanique Quantique 2',
                'coefficient' => '4',
                'u_e_id' => $physique->id
            ]);
        //90
        $physique = DB::table('u_e_s')->where('nom', 'Électronique Numérique')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1PHY 1503',
                'nom' => 'Électronique Numérique',
                'coefficient' => '4',
                'u_e_id' => $physique->id
            ]);
        //91
        $physique = DB::table('u_e_s')->where('nom', 'Physique Statistique')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1PHY 1504',
                'nom' => 'Physique Statistique',
                'coefficient' => '4',
                'u_e_id' => $physique->id
            ]);
        //92
        $physique = DB::table('u_e_s')->where('nom', "Physique de l'Atmosphère")->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1PHY 1505',
                'nom' => "Physique de l'Atmosphère",
                'coefficient' => '3',
                'u_e_id' => $physique->id
            ]);
        //92
        $physique = DB::table('u_e_s')->where('nom', 'Transfert Thermique')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1PHY 1506',
                'nom' => 'Transfert Thermique',
                'coefficient' => '3',
                'u_e_id' => $physique->id
            ]);
        //93
        $physique = DB::table('u_e_s')->where('nom', "Météorologie de l'Espace")->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1PHY 1507',
                'nom' => "Météorologie de l'Espace",
                'coefficient' => '2',
                'u_e_id' => $physique->id
            ]);
        //94
        $physique = DB::table('u_e_s')->where('nom', "Mécanique Céleste")->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1PHY 1508',
                'nom' => "Mécanique Céleste",
                'coefficient' => '2',
                'u_e_id' => $physique->id
            ]);
        //95
        $physique = DB::table('u_e_s')->where('nom', "Combustion")->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1PHY 1509',
                'nom' => "Combustion",
                'coefficient' => '2',
                'u_e_id' => $physique->id
            ]);
        //96
        $physique = DB::table('u_e_s')->where('nom', "UE Transversale")->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1TCC 1560',
                'nom' => "UE Transversale",
                'coefficient' => '2',
                'u_e_id' => $physique->id
            ]);

    //##########################################
        //Semestre 6 Licence 3 PHY
        //97
        $physique = DB::table('u_e_s')->where('nom', 'Optique Physique')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1PHY 1600',
                'nom' => 'Optique Physique',
                'coefficient' => '3',
                'u_e_id' => $physique->id
            ]);
        //98
        $physique = DB::table('u_e_s')->where('nom', 'Mécanique des Fluides')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1PHY 1601',
                'nom' => 'Mécanique des Fluides',
                'coefficient' => '4',
                'u_e_id' => $physique->id
            ]);
        //99
        $physique = DB::table('u_e_s')->where('nom', 'Thermodynamique Machines Thermiques')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1PHY 1602',
                'nom' => 'Thermodynamique Machines Thermiques',
                'coefficient' => '3',
                'u_e_id' => $physique->id
            ]);
        //100
        $physique = DB::table('u_e_s')->where('nom', 'Mécanique Analytique')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1PHY 1603',
                'nom' => 'Mécanique Analytique',
                'coefficient' => '3',
                'u_e_id' => $physique->id
            ]);
        //101
        $physique = DB::table('u_e_s')->where('nom', "Théorie du Signal et Notions sur les Lasers")->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1PHY 1604',
                'nom' => "Théorie du Signal et Notions sur les Lasers",
                'coefficient' => '4',
                'u_e_id' => $physique->id
            ]);
        //102
        $physique = DB::table('u_e_s')->where('nom', 'RDM')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1PHY 1605',
                'nom' => 'RDM',
                'coefficient' => '3',
                'u_e_id' => $physique->id
            ]);
        //103
        $physique = DB::table('u_e_s')->where('nom', "Radioactivité et Physique Nucléaire")->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1PHY 1606',
                'nom' => "Radioactivité et Physique Nucléaire",
                'coefficient' => '2',
                'u_e_id' => $physique->id
            ]);
        //104
        $physique = DB::table('u_e_s')->where('nom', "Étude de l'Ionosphère")->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1PHY 1607',
                'nom' => "Étude de l'Ionosphère",
                'coefficient' => '2',
                'u_e_id' => $physique->id
            ]);
        //105
        $physique = DB::table('u_e_s')->where('nom', "Physique Atomique et Moléculaire")->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1PHY 1608',
                'nom' => "Physique Atomique et Moléculaire",
                'coefficient' => '2',
                'u_e_id' => $physique->id
            ]);
        //106
        $physique = DB::table('u_e_s')->where('nom', "TP Physique")->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1PHY 1609',
                'nom' => "TP Physique",
                'coefficient' => '2',
                'u_e_id' => $physique->id
            ]);
        //110
        $physique = DB::table('u_e_s')->where('nom', "UE-Transversale")->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1TCC 1660',
                'nom' => "Anglais Scientifique Spécialité Physique",
                'coefficient' => '2',
                'u_e_id' => $physique->id
            ]);

    //##########################################
        //Semestre 5 Licence 3 Chimie
        //111
        $chimie = DB::table('u_e_s')->where('nom', 'Chimie Théorique')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1CHM 1500',
                'nom' => 'Atomes, Molécules et Spectroscopie',
                'coefficient' => '4',
                'u_e_id' => $chimie->id
            ]);
        //112
        $chimie = DB::table('u_e_s')->where('nom', 'Chimie Organique 2')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1CHM 1501',
                'nom' => 'Synthèse Organique',
                'coefficient' => '4',
                'u_e_id' => $chimie->id
            ]);
        //113
        $chimie = DB::table('u_e_s')->where('nom', 'Chimie Minérale xx')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1CHM 1502',
                'nom' => 'Chimie Inorganique Moléculaire',
                'coefficient' => '4',
                'u_e_id' => $chimie->id
            ]);
        //114
        $chimie = DB::table('u_e_s')->where('nom', 'Chimie Analytique')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1CHM 1503',
                'nom' => 'Chimie Analytique et Traitement Statistique de Données',
                'coefficient' => '5',
                'u_e_id' => $chimie->id
            ]);
        //115
        $chimie = DB::table('u_e_s')->where('nom', 'Electrochimie')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1CHM 1504',
                'nom' => "Introduction aux Méthodes Electrochimiques d'Analyse",
                'coefficient' => '3',
                'u_e_id' => $chimie->id
            ]);
        //116
        $chimie = DB::table('u_e_s')->where('nom', 'Méthode de caractérisation Physique')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1CHM 1505',
                'nom' => "Introduction aux Méthodes de caractérisation Physico-chimmiques des Matériaux(RX, MEB, TEM, 1CP, XPS, ...)",
                'coefficient' => '3',
                'u_e_id' => $chimie->id
            ]);
        //117
        $chimie = DB::table('u_e_s')->where('nom', 'Méthode de Séparation')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1CHM 1506',
                'nom' => "Introduction aux Méthodes Séparatives et Spectroscopiques d'Analyse",
                'coefficient' => '3',
                'u_e_id' => $chimie->id
            ]);
        //118
        $chimie = DB::table('u_e_s')->where('nom', 'UE Libres')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1|2|3TCC 1560',
                'nom' => "Biochimie | Developpement Durable | MicroBiologie",
                'coefficient' => '2',
                'u_e_id' => $chimie->id
            ]);
        //119
        $chimie = DB::table('u_e_s')->where('nom', 'UE - transversale')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1TCC 1561',
                'nom' => "Sécurité et Environnement",
                'coefficient' => '1',
                'u_e_id' => $chimie->id
            ]);
        //120
        DB::table('e_c_u_s')->insert([
                'code'    => '2TCC 1561',
                'nom' => "Informatique",
                'coefficient' => '1',
                'u_e_id' => $chimie->id
            ]);
        
    //##########################################
        //Semestre 6 Licence 3 Chimie
        //121
        $chimie = DB::table('u_e_s')->where('nom', 'Thermodynamique Chimique')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1CHM 1600',
                'nom' => 'Thermodynamique Chimique',
                'coefficient' => '6',
                'u_e_id' => $chimie->id
            ]);
        //122
        $chimie = DB::table('u_e_s')->where('nom', 'Chimie Organique 3')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1CHM 1601',
                'nom' => 'Chimie Organique',
                'coefficient' => '6',
                'u_e_id' => $chimie->id
            ]);
        //123
        $chimie = DB::table('u_e_s')->where('nom', 'Chimie Minérale xx')
            ->where('semestre_id', '6')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1CHM 1602',
                'nom' => 'Matériaux et Chimie du Solide',
                'coefficient' => '6',
                'u_e_id' => $chimie->id
            ]);
        //124
        $chimie = DB::table('u_e_s')->where('nom', 'Chimie Théorique')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1CHM 1603',
                'nom' => 'Chimie Théorique',
                'coefficient' => '1',
                'u_e_id' => $chimie->id
            ]);
        //124
        DB::table('e_c_u_s')->insert([
                'code'    => '2CHM 1603',
                'nom' => 'TP Chimie Théorique',
                'coefficient' => '1',
                'u_e_id' => $chimie->id
            ]);
        //125
        $chimie = DB::table('u_e_s')->where('nom', 'Chimie Physique')->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1CHM 1604',
                'nom' => 'Matériaux Sémi-conducteur, Structures, Radio-Activité, Spectroscopie : Molécules et Lumières',
                'coefficient' => '2',
                'u_e_id' => $chimie->id
            ]);
        //126
        DB::table('e_c_u_s')->insert([
                'code'    => '2CHM 1604',
                'nom' => 'TP Chimie Physique',
                'coefficient' => '1',
                'u_e_id' => $chimie->id
            ]);

        //127
        $chimie = DB::table('u_e_s')
                ->where('nom', 'Electrochimie')
                ->where('semestre_id', '6')
                ->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1CHM 1605',
                'nom' => "Cinétique Electrochimique et Étude d'Interfaces",
                'coefficient' => '2',
                'u_e_id' => $chimie->id
            ]);
        //128
        DB::table('e_c_u_s')->insert([
                'code'    => '2CHM 1605',
                'nom' => "TP Electrochimie",
                'coefficient' => '1',
                'u_e_id' => $chimie->id
            ]);
        //129
        $chimie = DB::table('u_e_s')
                ->where('nom', 'UE Libres')
                ->where('semestre_id', '6')
                ->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1|2|3TCC 1660',
                'nom' => "Droit | Géochimie | Économie et Gestion",
                'coefficient' => '2',
                'u_e_id' => $chimie->id
            ]);
        //130
        $chimie = DB::table('u_e_s')
                ->where('nom', 'UE Transversale s6')
                ->where('semestre_id', '6')
                ->first();
        DB::table('e_c_u_s')->insert([
                'code'    => '1TCC 1661',
                'nom' => "Initiation au Projet Professionnel",
                'coefficient' => '2',
                'u_e_id' => $chimie->id
            ]);

    }
}
