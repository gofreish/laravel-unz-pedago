<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Filiere;
use App\Models\Cycle;
use App\Models\Semestre;

class UEandECUSeeder extends Seeder
{

    /*###########################
        DONNES
    */
    private $datas = [
        //S1 L MPCI
        [
            'filiere' => 'Mathématiques Physique Chimie Informatique (MPCI)',
            'cycle' => 'Licence',
            'semestre' => 'Semestre 1',
            'ues' => [
                [
                    'code' => 'PHY 1100',
                    'nom' => 'Physique 1',
                    'credit' => 6,
                    'ecus' => [
                        [
                            'code'    => '1PHY 1100',
                            'nom' => 'Electricité',
                            'coefficient' => 3,
                        ],
                        [
                            'code'    => '2PHY 1100',
                            'nom' => 'Mécanique du point',
                            'coefficient' => 3,
                        ],
                    ]
                ],
                [
                    'code' => 'MTH 1100',
                    'nom' => 'Mathématiques 1',
                    'credit' => 6,
                    'ecus' => [
                        [
                            'code'    => '1MTH 1100',
                            'nom' => 'Analyse 1',
                            'coefficient' => 4,
                        ],
                        [
                            'code'    => '2MTH 1100',
                            'nom' => 'Algèbre 1',
                            'coefficient' => 2,
                        ],
                    ]
                ],
                [
                    'code' => 'CHM 1100',
                    'nom' => 'Chimie 1',
                    'credit' => 6,
                    'ecus' => [
                        [
                            'code'    => '1CHM 1100',
                            'nom' => 'Atomistique',
                            'coefficient' => 2,
                        ],
                        [
                            'code'    => '2CHM 1100',
                            'nom' => 'Liaisons chimiques',
                            'coefficient' => 2,
                        ],
                        [
                            'code'    => '3CHM 1100',
                            'nom' => 'Termochimi et Equilibre Chimique',
                            'coefficient' => 2,
                        ],
                    ]
                ],
                [
                    'code' => 'INF 1100',
                    'nom' => 'Informatique 1',
                    'credit' => 6,
                    'ecus' => [
                        [
                            'code'    => '1INF 1100',
                            'nom' => 'Algorithmique',
                            'coefficient' => 4,
                        ],
                        [
                            'code'    => '2INF 1100',
                            'nom' => 'Programmation',
                            'coefficient' => 2,
                        ],
                    ]
                ],
                [
                    'code' => 'TTC 1160',
                    'nom' => 'UE transversale',
                    'credit' => 6,
                    'ecus' => [
                        [
                            'code'    => '1TTC 1160',
                            'nom' => 'Statistique Descriptve',
                            'coefficient' => 2,
                        ],
                        [
                            'code'    => '2TTC 1160',
                            'nom' => 'Anglais Scientifique',
                            'coefficient' => 2,
                        ],
                        [
                            'code'    => '3TTC 1160',
                            'nom' => 'Généralités sur les TIC',
                            'coefficient' => '2',
                        ],
                    ]
                ]
            ],
        ],
        //S2 L MPCI
        [
            'filiere' => 'Mathématiques Physique Chimie Informatique (MPCI)',
            'cycle' => 'Licence',
            'semestre' => 'Semestre 2',
            'ues' => [
                [
                    'code' => 'PHY 1200',
                    'nom' => 'Physique 2',
                    'credit' => 5,
                    'ecus' => [
                        [
                            'code'    => '1PHY 1200',
                            'nom' => 'Physique Expérimentale 1',
                            'coefficient' => 1,
                        ],
                        [
                            'code'    => '2PHY 1200',
                            'nom' => 'Optique Géométrique',
                            'coefficient' => 2,
                        ],
                        [
                            'code'    => '3PHY 1200',
                            'nom' => 'Magnétostatique et Régime variable',
                            'coefficient' => 2,
                        ],
                    ]
                ],
                [
                    'code' => 'MTH 1200',
                    'nom' => 'Mathématiques 2',
                    'credit' => 5,
                    'ecus' => [
                        [
                            'code'    => '1MTH 1200',
                            'nom' => 'Analyse 2',
                            'coefficient' => 2,
                        ],
                        [
                            'code'    => '2MTH 1200',
                            'nom' => 'Algèbre Linéaire 1',
                            'coefficient' => 3,
                        ],
                    ]
                ],
                [
                    'code' => 'CHM 1200',
                    'nom' => 'Chimie 2',
                    'credit' => 5,
                    'ecus' => [
                        [
                            'code'    => '1CHM 1200',
                            'nom' => 'Chimie Expérimentale 1',
                            'coefficient' => 1,
                        ],
                        [
                            'code'    => '2CHM 1200',
                            'nom' => 'Équilibre chimique en solution',
                            'coefficient' => 2,
                        ],
                        [
                            'code'    => '3CHM 1200',
                            'nom' => 'Chimie organique générale',
                            'coefficient' => 2,
                        ],
                    ]
                ],
                [
                    'code' => 'INF 1200',
                    'nom' => 'Informatique 2',
                    'credit' => 5,
                    'ecus' => [
                        [
                            'code'    => '1INF 1200',
                            'nom' => 'Algorithmique et Programmation',
                            'coefficient' => 3,
                        ],
                        [
                            'code'    => '2INF 1200',
                            'nom' => 'Architecture des ordinateurs',
                            'coefficient' => 2,
                        ],
                    ]
                ],
                [
                    'code' => 'TTC 1260',
                    'nom' => 'UE transversales 2',
                    'credit' => 5,
                    'ecus' => [
                        [
                            'code'    => '1TTC 1260',
                            'nom' => 'Anglais Scientifique',
                            'coefficient' => 2,
                        ],
                        [
                            'code'    => '2TTC 1260',
                            'nom' => 'Initiation au droit',
                            'coefficient' => 1,
                        ],
                        [
                            'code'    => '3TTC 1260',
                            'nom' => 'Epistémologie',
                            'coefficient' => 2,
                        ],
                    ]
                ],
                [
                    'code' => 'TTC 1261',
                    'nom' => 'Sciences Graphiques',
                    'credit' => 5,
                    'ecus' => [
                        [
                            'code'    => '1TTC 1261',
                            'nom' => 'Statique Grapique',
                            'coefficient' => 2,
                        ],
                        [
                            'code'    => '2TTC 1261',
                            'nom' => 'Déssin Assisté par Ordinateur(DAO)',
                            'coefficient' => 2,
                        ],
                        [
                            'code'    => '3TTC 1261',
                            'nom' => 'Initiation au Graphismes',
                            'coefficient' => 1,
                        ],
                    ]
                ],
            ],
        ],
        //S3 L MPCI
        [
            'filiere' => 'Mathématiques Physique Chimie Informatique (MPCI)',
            'cycle' => 'Licence',
            'semestre' => 'Semestre 3',
            'ues' => [
                [
                    'code' => 'PHY 1300',
                    'nom' => 'Physique 3-1',
                    'credit' => 6,
                    'ecus' => [
                        [
                            'code'    => '1PHY 1300',
                            'nom' => 'Thermodynamique Physique',
                            'coefficient' => 3,
                        ],
                        [
                            'code'    => '2PHY 1300',
                            'nom' => 'Électromagnétisme er relativité restreinte',
                            'coefficient' => 3,
                        ],
                    ]
                ],
                [
                    'code' => 'PHY 1301',
                    'nom' => 'Physique 3-2',
                    'credit' => 3,
                    'ecus' => [
                        [
                            'code'    => '1PHY 1301',
                            'nom' => 'Optique Physique',
                            'coefficient' => 3,
                        ]
                    ]
                ],
                [
                    'code' => 'MTH 1300',
                    'nom' => 'Mathématiques 3-1',
                    'credit' => 6,
                    'ecus' => [
                        [
                            'code'    => '1MTH 1300',
                            'nom' => 'Algèbre 2',
                            'coefficient' => 3,
                        ],
                        [
                            'code'    => '2MTH 1300',
                            'nom' => 'Algèbre Linéaire 2',
                            'coefficient' => 3,
                        ],
                    ]
                ],
                [
                    'code' => 'MTH 1301',
                    'nom' => 'Mathématiques 3-2',
                    'credit' => 3,
                    'ecus' => [
                        [
                            'code'    => '1MTH 1301',
                            'nom' => 'Analyse 3',
                            'coefficient' => 3,
                        ]
                    ]
                ],
                [
                    'code' => 'CHM 1300',
                    'nom' => 'Chimie 3',
                    'credit' => 6,
                    'ecus' => [
                        [
                            'code'    => '1CHM 1300',
                            'nom' => 'Chimie Minérale',
                            'coefficient' => 3,
                        ],
                        [
                            'code'    => '2CHM 1300',
                            'nom' => 'Cinétique chimique',
                            'coefficient' => 3,
                        ],
                    ]
                ],
                [
                    'code' => 'INF 1300',
                    'nom' => 'Informatique 3',
                    'credit' => 6,
                    'ecus' => [
                        [
                            'code'    => '1INF 1300',
                            'nom' => 'Structures de données et Programmation',
                            'coefficient' => 3,
                        ],
                        [
                            'code'    => '2INF 1300',
                            'nom' => "Système d'exploitation",
                            'coefficient' => 3,
                        ],
                    ]
                ],
            ],
        ],
        //S4 L Mathematiques
        [
            'filiere' => 'Mathématiques',
            'cycle' => 'Licence',
            'semestre' => 'Semestre 4',
            'ues' => [
                [
                    'code' => 'MTH 1400',
                    'nom' => 'Algèbre 4',
                    'credit' => 5,
                    'ecus' => [
                        [
                            'code'    => '1MTH 1400',
                            'nom' => 'Algèbre 4',
                            'coefficient' => 5,
                        ]
                    ]
                ],
                [
                    'code' => 'MTH 1401',
                    'nom' => 'Analyse 4',
                    'credit' => 5,
                    'ecus' => [
                        [
                            'code'    => '1MTH 1401',
                            'nom' => 'Analyse 4',
                            'coefficient' => 5,
                        ]
                    ]
                ],
                [
                    'code' => 'MTH 1402',
                    'nom' => 'Calcul Numérique',
                    'credit' => 4,
                    'ecus' => [
                        [
                            'code'    => '1MTH 1402',
                            'nom' => 'Calcul Numérique',
                            'coefficient' => 4,
                        ]
                    ]
                ],
                [
                    'code' => 'MTH 1403',
                    'nom' => 'Optimisation',
                    'credit' => 4,
                    'ecus' => [
                        [
                            'code'    => '1MTH 1403',
                            'nom' => 'Optimisation',
                            'coefficient' => 4,
                        ]
                    ]
                ],
                [
                    'code' => 'MTH 1404',
                    'nom' => 'Géométrie des courbes et surfaces',
                    'credit' => 5,
                    'ecus' => [
                        [
                            'code'    => '1MTH 1404',
                            'nom' => 'Géométrie des courbes et surfaces',
                            'coefficient' => 5,
                        ]
                    ]
                ],
                [
                    'code' => 'MTH 1405',
                    'nom' => 'Statistiques Mathématiques',
                    'credit' => 4,
                    'ecus' => [
                        [
                            'code'    => '1MTH 1405',
                            'nom' => 'Statistiques Mathématiques',
                            'coefficient' => 4,
                        ]
                    ]
                ],
                [
                    'code' => 'MTH 1406',
                    'nom' => 'Géométrie Affine et Euclidienne',
                    'credit' => 3,
                    'ecus' => [
                        [
                            'code'    => '1MTH 1406',
                            'nom' => 'Géométrie Affine et Euclidienne',
                            'coefficient' => 3,
                        ]
                    ]
                ],
            ],
        ],
        //S4 L Physique
        [
            'filiere' => 'Physique',
            'cycle' => 'Licence',
            'semestre' => 'Semestre 4',
            'ues' => [
                [
                    'code' => 'PHY 1400',
                    'nom' => 'Physique Expérimentale',
                    'credit' => 3,
                    'ecus' => [
                        [
                            'code'    => '1PHY 1400',
                            'nom' => 'Physique Expérimentale',
                            'coefficient' => 3,
                        ]
                    ]
                ],
                [
                    'code'    => 'PHY 1401',
                    'nom' => 'Mécanique des Fluides',
                    'credit' => 3,
                    'ecus' => [
                        [
                            'code'    => '1PHY 1401',
                            'nom' => 'Mécanique des Fluides',
                            'coefficient' => 3,
                        ]
                    ]
                ],
                [
                    'code'    => 'PHY 1402',
                    'nom' => 'Électronique Analogique',
                    'credit' => 5,
                    'ecus' => [
                        [
                            'code'    => '1PHY 1402',
                            'nom' => 'Électronique Analogique',
                            'coefficient' => 5,
                        ]
                    ]
                ],
                [
                    'code'    => 'PHY 1403',
                    'nom' => 'Mécanique du Solide 1',
                    'credit' => 5,
                    'ecus' => [
                        [
                            'code'    => '1PHY 1403',
                            'nom' => 'Mécanique du Point Approfondissement',
                            'coefficient' => 2,
                        ],
                        [
                            'code'    => '2PHY 1403',
                            'nom' => 'Mécanique Physique',
                            'coefficient' => 3,
                        ],
                    ]
                ],
                [
                    'code'    => 'PHY 1404',
                    'nom' => 'Mécanique Quantique 1',
                    'credit' => 5,
                    'ecus' => [
                        [
                            'code'    => '1PHY 1404',
                            'nom' => 'Mécanique Quantique 1',
                            'coefficient' => 5,
                        ]
                    ]
                ],
                [
                    'code'    => 'TTC 1460',
                    'nom' => 'Anglais Scientifique',
                    'credit' => '2',
                    'ecus' => [
                        [
                            'code'    => 'TTC 1460',
                            'nom' => 'Anglais Scientifique',
                            'coefficient' => 2,
                        ]
                    ]
                ],
                [
                    'code'    => 'MTH 1400',
                    'nom' => 'Outils Mathématiques et Informatique',
                    'credit' => 4,
                    'ecus' => [
                        [
                            'code'    => '1MTH 1400',
                            'nom' => 'Mathématiques pour la Physique',
                            'coefficient' => 2,
                        ],
                        [
                            'code'    => '2MTH 1400',
                            'nom' => 'Approfondissement Graphique',
                            'coefficient' => 2,
                        ]
                    ]
                ],
                [
                    'code'    => 'CHM 1400',
                    'nom' => 'Chimie',
                    'credit' => '3',
                    'ecus' => [
                        [
                            'code'    => '1CHM 1400',
                            'nom' => 'Initiation à la Chimie des Eaux et des Sols',
                            'coefficient' => 1,
                        ],
                        [
                            'code'    => '2CHM 1400',
                            'nom' => 'Chimie Verte',
                            'coefficient' => 2,
                        ],
                    ]
                ],
            ],
        ],
        //S4 L Chimie
        [
            'filiere' => 'Chimie',
            'cycle' => 'Licence',
            'semestre' => 'Semestre 4',
            'ues' => [
                [
                    'code'    => 'CHM 1400',
                    'nom' => 'Chimie des matériaux Inorganiques',
                    'credit' => 4,
                    'ecus' => [
                        [
                            'code'    => '1CHM 1400',
                            'nom' => 'Chimie des matériaux Inorganiques',
                            'coefficient' => 4,
                        ]
                    ]
                ],
                [
                    'code'    => 'CHM 1401',
                    'nom' => 'Chimie Organique Descriptive',
                    'credit' => 4,
                    'ecus' => [
                        [
                            'code'    => '1CHM 1401',
                            'nom' => 'Chimie Organique Descriptive',
                            'coefficient' => 4,
                        ]
                    ]
                ],
                [
                    'code'    => 'CHM 1402',
                    'nom' => 'Chimie Quantique',
                    'credit' => 3,
                    'ecus' => [
                        [
                            'code'    => '1CHM 1402',
                            'nom' => 'Chimie Quantique',
                            'coefficient' => 3,
                        ]
                    ]
                ],
                [
                    'code'    => 'CHM 1403',
                    'nom' => 'Chimie Analytique',
                    'credit' => 3,
                    'ecus' => [
                        [
                            'code'    => '1CHM 1403',
                            'nom' => 'Chimie Analytique',
                            'coefficient' => 3,
                        ]
                    ]
                ],
                [
                    'code'    => 'CHM 1404',
                    'nom' => 'Électrochimie',
                    'credit' => 4,
                    'ecus' => [
                        [
                            'code'    => '1CHM 1404',
                            'nom' => 'Électrochimie',
                            'coefficient' => 4,
                        ]
                    ]
                ],
                [
                    'code'    => 'PHY 1400',
                    'nom' => 'Mécanique Quantique',
                    'credit' => 3,
                    'ecus' => [
                        [
                            'code'    => '1PHY 1400',
                            'nom' => 'Mécanique Quantique',
                            'coefficient' => 3,
                        ]
                    ]
                ],
                [
                    'code'    => 'PHY 1401',
                    'nom' => 'Thermodynamique',
                    'credit' => 4,
                    'ecus' => [
                        [
                            'code'    => '1PHY 1401',
                            'nom' => 'Thermodynamique',
                            'coefficient' => 4,
                        ]
                    ]
                ],
                [
                    'code'    => 'CHM 1400',
                    'nom' => "Méthodes Statistique d'Analyse de données",
                    'credit' => 2,
                    'ecus' => [
                        [
                            'code'    => '1CHM 1400',
                            'nom' => "Méthodes Statistique d'Analyse de données",
                            'coefficient' => 2,
                        ]
                    ]
                ],
                [
                    'code'    => 'TTC 1460',
                    'nom' => "UE transversales",
                    'credit' => 3,
                    'ecus' => [
                        [
                            'code'    => '1TTC 1460',
                            'nom' => "Mathématiques pour Chimiste",
                            'coefficient' => 1,
                        ],
                        [
                            'code'    => '2TTC 1460',
                            'nom' => "Chimie Expérimentale 2",
                            'coefficient' => 1,
                        ],
                        [
                            'code'    => '3TTC 1460',
                            'nom' => "Chimie Verte",
                            'coefficient' => 1,
                        ],
                    ]
                ],
            ],
        ],
        //S4 L Informatique
        [
            'filiere' => 'Informatique',
            'cycle' => 'Licence',
            'semestre' => 'Semestre 4',
            'ues' => [
                [
                    'code'    => 'MTH 1400',
                    'nom' => 'Probabilités et Statistiques',
                    'credit' => 4,
                    'ecus' => [
                        [
                            'code'    => '1MTH 1400',
                            'nom' => 'Probabilité',
                            'coefficient' => 2,
                        ],
                        [
                            'code'    => '2MTH 1400',
                            'nom' => 'Statistique',
                            'coefficient' => 2,
                        ],
                    ]
                ],
                [
                    'code'    => 'MTH 1401',
                    'nom' => 'Fondamentaux Scientifique',
                    'credit' => 4,
                    'ecus' => [
                        [
                            'code'    => '1MTH 1401',
                            'nom' => 'Calcul Numérique',
                            'coefficient' => 2,
                        ],
                        [
                            'code'    => '1MTH 1401',
                            'nom' => 'Recherche Opérationnel',
                            'coefficient' => 2,
                        ],
                    ]
                ],
                [
                    'code'    => 'INF 1400',
                    'nom' => 'Introduction à la POO',
                    'credit' => 3,
                    'ecus' => [
                        [
                            'code'    => '1INF 1400',
                            'nom' => 'Introduction à la POO',
                            'coefficient' => 3,
                        ]
                    ]
                ],
                [
                    'code'    => 'INF 1401',
                    'nom' => 'Structure de données avancées',
                    'credit' => 3,
                    'ecus' => [
                        [
                            'code'    => '1INF 1401',
                            'nom' => 'Structure de données avancées',
                            'coefficient' => 3,
                        ]
                    ]
                ],
                [
                    'code'    => 'INF 1402',
                    'nom' => "Base de données et Système d'information",
                    'credit' => 6,
                    'ecus' => [
                        [
                            'code'    => '1INF 1402',
                            'nom' => 'Base de données',
                            'coefficient' => 3,
                        ],
                        [
                            'code'    => '2INF 1402',
                            'nom' => "Système d'information",
                            'coefficient' => 3,
                        ],
                    ]
                ],
                [
                    'code'    => 'INF 1403',
                    'nom' => "Réseau et Système Informatique",
                    'credit' => 6,
                    'ecus' => [
                        [
                            'code'    => '1INF 1403',
                            'nom' => 'Introdution aux Réseaux Informatique',
                            'coefficient' => 3,
                        ],
                        [
                            'code'    => '2INF 1403',
                            'nom' => 'Architecture des Ordinateurs',
                            'coefficient' => 3,
                        ],
                    ]
                ],
                [
                    'code'    => 'TTC 1460',
                    'nom' => "UE-transversales",
                    'credit' => 4,
                    'ecus' => [
                        [
                            'code'    => '1TTC 1460',
                            'nom' => 'Technique Quantitative de Gestion',
                            'coefficient' => 2,
                        ],
                        [
                            'code'    => '2TTC 1460',
                            'nom' => 'Droit du travail',
                            'coefficient' => 2,
                        ],
                    ]
                ],
            ],
        ],
        //S5 L Mathematique
        [
            'filiere' => 'Mathématiques',
            'cycle' => 'Licence',
            'semestre' => 'Semestre 5',
            'ues' => [
                [
                    'code'    => 'MTH 1500',
                    'nom' => 'Algèbre 5',
                    'credit' => 6,
                    'ecus' => [
                        [
                            'code'    => '1MTH 1500',
                            'nom' => 'Algèbre 5',
                            'coefficient' => '6',
                        ]
                    ]
                ],
                [
                    'code'    => 'MTH 1501',
                    'nom' => 'Analyse 5',
                    'credit' => 3,
                    'ecus' => [
                        [
                            'code'    => '1MTH 1501',
                            'nom' => 'Analyse 5',
                            'coefficient' => 3,
                        ]
                    ]
                ],
                [
                    'code'    => 'MTH 1502',
                    'nom' => 'Topologie Générale',
                    'credit' => 4,
                    'ecus' => [
                        [
                            'code'    => '1MTH 1502',
                            'nom' => 'Topologie Générale',
                            'coefficient' => 4,
                        ]
                    ]
                ],
                [
                    'code'    => 'MTH 1503',
                    'nom' => 'Statistique avancée 1',
                    'credit' => 3,
                    'ecus' => [
                        [
                            'code'    => '1MTH 1503',
                            'nom' => 'Statistique avancée 1',
                            'coefficient' => 3,
                        ]
                    ]
                ],
                [
                    'code'    => 'MTH 1504',
                    'nom' => 'Calcul Différentiel',
                    'credit' => 3,
                    'ecus' => [
                        [
                            'code'    => '1MTH 1504',
                            'nom' => 'Calcul Différentiel',
                            'coefficient' => 3,
                        ]
                    ]
                ],
                [
                    'code'    => 'MTH 1505',
                    'nom' => 'Analyse Complexe',
                    'credit' => 3,
                    'ecus' => [
                        [
                            'code'    => '1MTH 1505',
                            'nom' => 'Analyse Complexe',
                            'coefficient' => 3,
                        ]
                    ]
                ],
                [
                    'code'    => 'MTH 1506',
                    'nom' => 'Analyse des Données',
                    'credit' => 3,
                    'ecus' => [
                        [
                            'code'    => '1MTH 1506',
                            'nom' => 'Analyse des Données',
                            'coefficient' => 3,
                        ]
                    ]
                ],
                [
                    'code'    => 'MTH 1507',
                    'nom' => 'Calcul Scientifique et Traitement de Texte Scientifique',
                    'credit' => 2,
                    'ecus' => [
                        [
                            'code'    => '1MTH 1507',
                            'nom' => 'Calcul Scientifique et Traitement de Texte Scientifique',
                            'coefficient' => 2,
                        ]
                    ]
                ],
                [
                    'code'    => 'MTH 1508',
                    'nom' => 'Analyse Numérique',
                    'credit' => 3,
                    'ecus' => [
                        [
                            'code'    => '1MTH 1508',
                            'nom' => 'Analyse Numérique',
                            'coefficient' => 3,
                        ]
                    ]
                ],
            ],
        ],
        //S6 L Math
        [
            'filiere' => 'Mathématiques',
            'cycle' => 'Licence',
            'semestre' => 'Semestre 6',
            'ues' => [
                [
                    'code'    => 'MTH 1600',
                    'nom' => 'Algèbre 6',
                    'credit' => 6,
                    'ecus' => [
                        [
                            'code'    => '1MTH 1600',
                            'nom' => 'Algèbre 6',
                            'coefficient' => 6,
                        ]
                    ]
                ],
                [
                    'code'    => 'MTH 1601',
                    'nom' => 'Mesure et Intégration',
                    'credit' => 4,
                    'ecus' => [
                        [
                            'code'    => '1MTH 1601',
                            'nom' => 'Mesure et Intégration',
                            'coefficient' => 4,
                        ]
                    ]
                ],
                [
                    'code'    => 'MTH 1602',
                    'nom' => 'Géométrie Différentiel',
                    'credit' => 4,
                    'ecus' => [
                        [
                            'code'    => '1MTH 1602',
                            'nom' => 'Géométrie Différentiel',
                            'coefficient' => 4,
                        ]
                    ]
                ],
                [
                    'code'    => 'MTH 1603',
                    'nom' => 'Inférence Statistique',
                    'credit' => 4,
                    'ecus' => [
                        [
                            'code'    => '1MTH 1603',
                            'nom' => 'Inférence Statistique',
                            'coefficient' => 4,
                        ]
                    ]
                ],
                [
                    'code'    => 'MTH 1604',
                    'nom' => 'Recherche Opérationnelle',
                    'credit' => 4,
                    'ecus' => [
                        [
                            'code'    => '1MTH 1604',
                            'nom' => 'Recherche Opérationnelle',
                            'coefficient' => 4,
                        ]
                    ]
                ],
                [
                    'code'    => 'MTH 1605',
                    'nom' => 'Optimisation non Linéaire',
                    'credit' => 3,
                    'ecus' => [
                        [
                            'code'    => '1MTH 1605',
                            'nom' => 'Optimisation non Linéaire',
                            'coefficient' => 3,
                        ]
                    ]
                ],
                [
                    'code'    => 'MTH 1606',
                    'nom' => 'Statistique Avancée 2',
                    'credit' => 3,
                    'ecus' => [
                        [
                            'code'    => '1MTH 1606',
                            'nom' => 'Statistique Avancée 2',
                            'coefficient' => 3,
                        ]
                    ]
                ],
                [
                    'code'    => 'MTH 1607',
                    'nom' => 'Initiation au Projet Professionnel',
                    'credit' => 2,
                    'ecus' => [
                        [
                            'code'    => '1MTH 1607',
                            'nom' => 'Initiation au Projet Professionnel',
                            'coefficient' => 2,
                        ]
                    ]
                ],
            ],
        ],
        //S5 L Physique
        [
            'filiere' => 'Physique',
            'cycle' => 'Licence',
            'semestre' => 'Semestre 5',
            'ues' => [
                [
                    'code'    => 'PHY 1501',
                    'nom' => 'Physique du Solide',
                    'credit' => 4,
                    'ecus' => [
                        [
                            'code'    => '1PHY 1501',
                            'nom' => 'Mécanique du Solide Approfondissement',
                            'coefficient' => 2,
                        ],
                        [
                            'code'    => '2PHY 1501',
                            'nom' => 'Initiation à la Cristallographie et Sciences des Matériaux',
                            'coefficient' => 2,
                        ],
                    ]
                ],
                [
                    'code'    => 'PHY 1502',
                    'nom' => 'Mécanique Quantique 2',
                    'credit' => 4,
                    'ecus' => [
                        [
                            'code'    => '1PHY 1502',
                            'nom' => 'Mécanique Quantique 2',
                            'coefficient' => 4,
                        ]
                    ]
                ],
                [
                    'code'    => 'PHY 1503',
                    'nom' => 'Électronique Numérique',
                    'credit' => 4,   
                    'ecus' => [
                        [
                            'code'    => '1PHY 1503',
                            'nom' => 'Électronique Numérique',
                            'coefficient' => 4,
                        ]
                    ]
                ],
                [
                    'code'    => 'PHY 1504',
                    'nom' => 'Physique Statistique',
                    'credit' => 4,
                    'ecus' => [
                        [
                            'code'    => '1PHY 1504',
                            'nom' => 'Physique Statistique',
                            'coefficient' => 4,
                        ]
                    ]
                ],
                [
                    'code'    => 'PHY 1505',
                    'nom' => "Physique de l'Atmosphère",
                    'credit' => 3,
                    'ecus' => [
                        [
                            'code'    => '1PHY 1505',
                            'nom' => "Physique de l'Atmosphère",
                            'coefficient' => 3,
                        ]
                    ]
                ],
                [
                    'code'    => 'PHY 1506',
                    'nom' => "Transfert Thermique",
                    'credit' => 3,
                    'ecus' => [
                        [
                            'code'    => '1PHY 1506',
                            'nom' => 'Transfert Thermique',
                            'coefficient' => 3,
                        ]
                    ]
                ],
                [
                    'code'    => 'PHY 1507',
                    'nom' => "Météorologie de l'Espace",
                    'credit' => 2,
                    'ecus' => [
                        [
                            'code'    => '1PHY 1507',
                            'nom' => "Météorologie de l'Espace",
                            'coefficient' => 2,
                        ]
                    ]
                ],
                [
                    'code'    => 'PHY 1508',
                    'nom' => "Mécanique Céleste",
                    'credit' => 2,
                    'ecus' => [
                        [
                            'code'    => '1PHY 1508',
                            'nom' => "Mécanique Céleste",
                            'coefficient' => 2,
                        ]
                    ]
                ],
                [
                    'code'    => 'PHY 1509',
                    'nom' => "Combustion",
                    'credit' => 2,
                    'ecus' => [
                        [
                            'code'    => '1PHY 1509',
                            'nom' => "Combustion",
                            'coefficient' => 2,
                        ]
                    ]
                ],
                [
                    'code'    => 'TCC 1560',
                    'nom' => "UE Transversale",
                    'credit' => 2,
                    'ecus' => [
                        [
                            'code'    => '1TCC 1560',
                            'nom' => "UE Transversale",
                            'coefficient' => 2,
                        ]
                    ]
                ],
            ],
        ],
        //S6 L Phy
        [
            'filiere' => 'Physique',
            'cycle' => 'Licence',
            'semestre' => 'Semestre 6',
            'ues' => [
                [
                    'code'    => 'PHY 1600',
                    'nom' => 'Optique Physique',
                    'credit' => 3,
                    'ecus' => [
                        [
                            'code'    => '1PHY 1600',
                            'nom' => 'Optique Physique',
                            'coefficient' => '3',
                        ]
                    ]
                ],
                [
                    'code'    => 'PHY 1601',
                    'nom' => 'Mécanique des Fluides',
                    'credit' => 4,
                    'ecus' => [
                        [
                            'code'    => '1PHY 1601',
                            'nom' => 'Mécanique des Fluides',
                            'coefficient' => 4,
                        ]
                    ]
                ],
                [
                    'code'    => 'PHY 1602',
                    'nom' => 'Thermodynamique Machines Thermiques',
                    'credit' => 3,
                    'ecus' => [
                        [
                            'code'    => '1PHY 1602',
                            'nom' => 'Thermodynamique Machines Thermiques',
                            'coefficient' => 3,
                        ]
                    ]
                ],
                [
                    'code'    => 'PHY 1603',
                    'nom' => 'Mécanique Analytique',
                    'credit' => 3,
                    'ecus' => [
                        [
                            'code'    => '1PHY 1603',
                            'nom' => 'Mécanique Analytique',
                            'coefficient' => 3,
                        ]
                    ]
                ],
                [
                    'code'    => 'PHY 1604',
                    'nom' => "Théorie du Signal et Notions sur les Lasers",
                    'credit' => 4,
                    'ecus' => [
                        [
                            'code'    => '1PHY 1604',
                            'nom' => "Théorie du Signal et Notions sur les Lasers",
                            'coefficient' => 4,
                        ]
                    ]
                ],
                [
                    'code'    => 'PHY 1605',
                    'nom' => "RDM",
                    'credit' => 3,
                    'ecus' => [
                        [
                            'code'    => '1PHY 1605',
                            'nom' => 'RDM',
                            'coefficient' => 3,
                        ]
                    ]
                ],
                [
                    'code'    => 'PHY 1606',
                    'nom' => "Radioactivité et Physique Nucléaire",
                    'credit' => 2,
                    'ecus' => [
                        [
                            'code'    => '1PHY 1606',
                            'nom' => "Radioactivité et Physique Nucléaire",
                            'coefficient' => 2,
                        ]
                    ]
                ],
                [
                    'code'    => 'PHY 1607',
                    'nom' => "Étude de l'Ionosphère",
                    'credit' => 2,
                    'ecus' => [
                        [
                            'code'    => '1PHY 1607',
                            'nom' => "Étude de l'Ionosphère",
                            'coefficient' => 2,
                        ]
                    ]
                ],
                [
                    'code'    => 'PHY 1608',
                    'nom' => "Physique Atomique et Moléculaire",
                    'credit' => 2,
                    'ecus' => [
                        [
                            'code'    => '1PHY 1608',
                            'nom' => "Physique Atomique et Moléculaire",
                            'coefficient' => 2,
                        ]
                    ]
                ],
                [
                    'code'    => 'PHY 1609',
                    'nom' => "TP Physique",
                    'credit' => 2,
                    'ecus' => [
                        [
                            'code'    => '1PHY 1609',
                            'nom' => "TP Physique",
                            'coefficient' => 2,
                        ]
                    ]
                ],
                [
                    'code'    => 'TCC 1660',
                    'nom' => "UE-Transversale",
                    'credit' => 2,
                    'ecus' => [
                        [
                            'code'    => '1TCC 1660',
                            'nom' => "Anglais Scientifique Spécialité Physique",
                            'coefficient' => 2,
                        ]
                    ]
                ],
            ],
        ],
        //S5 L Chimie
        [
            'filiere' => 'Chimie',
            'cycle' => 'Licence',
            'semestre' => 'Semestre 5',
            'ues' => [
                [
                    'code'    => 'CHM 1500',
                    'nom' => 'Chimie Théorique',
                    'credit' => 4,
                    'ecus' => [
                        [
                            'code'    => '1CHM 1500',
                            'nom' => 'Atomes, Molécules et Spectroscopie',
                            'coefficient' => 4,
                        ]
                    ]
                ],
                [
                    'code'    => 'CHM 1501',
                    'nom' => 'Chimie Organique 2',
                    'credit' => 4,
                    'ecus' => [
                        [
                            'code'    => '1CHM 1501',
                            'nom' => 'Synthèse Organique',
                            'coefficient' => 4,
                        ]
                    ]
                ],
                [
                    'code'    => 'CHM 1502',
                    'nom' => 'Chimie Minérale xx',
                    'credit' => 4,
                    'ecus' => [
                        [
                            'code'    => '1CHM 1502',
                            'nom' => 'Chimie Inorganique Moléculaire',
                            'coefficient' => 4,
                        ]
                    ]
                ],
                [
                    'code'    => 'CHM 1503',
                    'nom' => 'Chimie Analytique',
                    'credit' => 5,
                    'ecus' => [
                        [
                            'code'    => '1CHM 1503',
                            'nom' => 'Chimie Analytique et Traitement Statistique de Données',
                            'coefficient' => 5,
                        ]
                    ]
                ],
                [
                    'code'    => 'CHM 1504',
                    'nom' => 'Electrochimie',
                    'credit' => 3,
                    'ecus' => [
                        [
                            'code'    => '1CHM 1504',
                            'nom' => "Introduction aux Méthodes Electrochimiques d'Analyse",
                            'coefficient' => 3,
                        ]
                    ]
                ],
                [
                    'code'    => 'CHM 1505',
                    'nom' => 'Méthode de caractérisation Physique',
                    'credit' => 3,
                    'ecus' => [
                        [
                            'code'    => '1CHM 1505',
                            'nom' => "Introduction aux Méthodes de caractérisation Physico-chimmiques des Matériaux(RX, MEB, TEM, 1CP, XPS, ...)",
                            'coefficient' => 3,
                        ]
                    ]
                ],
                [
                    'code'    => 'CHM 1506',
                    'nom' => 'Méthode de Séparation',
                    'credit' => 3,
                    'ecus' => [
                        [
                            'code'    => '1CHM 1506',
                            'nom' => "Introduction aux Méthodes Séparatives et Spectroscopiques d'Analyse",
                            'coefficient' => 3,
                        ]
                    ]
                ],
                [
                    'code'    => 'TCC 1560',
                    'nom' => 'UE Libres',
                    'credit' => 2,
                    'ecus' => [
                        [
                            'code'    => '1|2|3TCC 1560',
                            'nom' => "Biochimie | Developpement Durable | MicroBiologie",
                            'coefficient' => 2,
                        ]
                    ]
                ],
                [
                    'code'    => 'TCC 1561',
                    'nom' => 'UE - transversale',
                    'credit' => 2,
                    'ecus' => [
                        [
                            'code'    => '1TCC 1561',
                            'nom' => "Sécurité et Environnement",
                            'coefficient' => 1,
                        ],
                        [
                            'code'    => '2TCC 1561',
                            'nom' => "Informatique",
                            'coefficient' => '1',
                        ]
                    ]
                ],
            ],
        ],
        //S6 L Chimie
        [
            'filiere' => 'Chimie',
            'cycle' => 'Licence',
            'semestre' => 'Semestre 6',
            'ues' => [
                [
                    'code'    => 'CHM 1600',
                    'nom' => 'Thermodynamique Chimique',
                    'credit' => 6,
                    'ecus' => [
                        [
                            'code'    => '1CHM 1600',
                            'nom' => 'Thermodynamique Chimique',
                            'coefficient' => 6,
                        ]
                    ]
                ],
                [
                    'code'    => 'CHM 1601',
                    'nom' => 'Chimie Organique 3',
                    'credit' => 6,
                    'ecus' => [
                        [
                            'code'    => '1CHM 1601',
                            'nom' => 'Chimie Organique',
                            'coefficient' => 6,
                        ]
                    ]
                ],
                [
                    'code'    => 'CHM 1602',
                    'nom' => 'Chimie Minérale xx',
                    'credit' => 6,
                    'ecus' => [
                        [
                            'code'    => '1CHM 1602',
                            'nom' => 'Matériaux et Chimie du Solide',
                            'coefficient' => 6,
                        ]
                    ]
                ],
                [
                    'code'    => 'CHM 1603',
                    'nom' => 'Chimie Théorique',
                    'credit' => 2,
                    'ecus' => [
                        [
                            'code'    => '1CHM 1603',
                            'nom' => 'Chimie Théorique',
                            'coefficient' => 1,
                        ],
                        [
                            'code'    => '2CHM 1603',
                            'nom' => 'TP Chimie Théorique',
                            'coefficient' => 1,
                        ],
                    ]
                ],
                [
                    'code'    => 'CHM 1604',
                    'nom' => 'Chimie Physique',
                    'credit' => 3,
                    'ecus' => [
                        [
                            'code'    => '1CHM 1604',
                            'nom' => 'Matériaux Sémi-conducteur, Structures, Radio-Activité, Spectroscopie : Molécules et Lumières',
                            'coefficient' => 2,
                        ],
                        [
                            'code'    => '2CHM 1604',
                            'nom' => 'TP Chimie Physique',
                            'coefficient' => 1,
                        ],
                    ]
                ],
                [
                    'code'    => 'CHM 1605',
                    'nom' => 'Electrochimie',
                    'credit' => 3,
                    'ecus' => [
                        [
                            'code'    => '1CHM 1605',
                            'nom' => "Cinétique Electrochimique et Étude d'Interfaces",
                            'coefficient' => 2,
                        ],
                        [
                            'code'    => '2CHM 1605',
                            'nom' => "TP Electrochimie",
                            'coefficient' => 1,
                        ],
                    ]
                ],
                [
                    'code'    => 'TCC 1660',
                    'nom' => 'UE Libres',
                    'credit' => 2,
                    'ecus' => [
                        [
                            'code'    => '1|2|3TCC 1660',
                            'nom' => "Droit | Géochimie | Économie et Gestion",
                            'coefficient' => 2,
                        ]
                    ]
                ],
                [
                    'code'    => 'TCC 1661',
                    'nom' => 'UE Transversale s6',
                    'credit' => 2,
                    'ecus' => [
                        [
                            'code'    => '1TCC 1661',
                            'nom' => "Initiation au Projet Professionnel",
                            'coefficient' => 2,
                        ]
                    ]
                ],
            ],
        ],
        //S5 L Informatique
        [
            'filiere' => 'Informatique',
            'cycle' => 'Licence',
            'semestre' => 'Semestre 5',
            'ues' => [
                [
                    'code'    => 'INF 1500',
                    'nom' => 'Orienté Objet',
                    'credit' => 6,
                    'ecus' => [
                        [
                            'code'    => '1INF 1500',
                            'nom' => 'Conception Orientée Objet',
                            'coefficient' => 2,
                        ],
                        [
                            'code'    => '2INF 1500',
                            'nom' => 'Programmation Orientée Objet Avancé',
                            'coefficient' => 4,
                        ],
                    ]
                ],
                [
                    'code'    => 'INF 1501',
                    'nom' => 'Bases de Données',
                    'credit' => 3,
                    'ecus' => [
                        [
                            'code'    => '1INF 1501',
                            'nom' => 'Bases de données 2',
                            'coefficient' => 3,
                        ],
                    ]
                ],
                [
                    'code'    => 'INF 1502',
                    'nom' => 'Compilation',
                    'credit' => 4,
                    'ecus' => [
                        [
                            'code'    => '1INF 1502',
                            'nom' => 'Logique pour informatique',
                            'coefficient' => 2,
                        ],
                        [
                            'code'    => '2INF 1502',
                            'nom' => 'Théorie de compilation',
                            'coefficient' => 2,
                        ],
                    ]
                ],
                [
                    'code'    => 'INF 1503',
                    'nom' => 'Technologies Web 1',
                    'credit' => 3,
                    'ecus' => [
                        [
                            'code'    => '1INF 1503',
                            'nom' => 'Technologies Web 1',
                            'coefficient' => 3,
                        ],
                    ]
                ],
                [
                    'code'    => 'INF 1504',
                    'nom' => 'Programmation Avancée',
                    'credit' => 6,
                    'ecus' => [
                        [
                            'code'    => '1INF 1504',
                            'nom' => 'Théorie des Graphes',
                            'coefficient' => 1,
                        ],
                        [
                            'code'    => '2INF 1504',
                            'nom' => 'Complexité des algorithmes',
                            'coefficient' => 2,
                        ],
                        [
                            'code'    => '3INF 1504',
                            'nom' => 'Programmation Système',
                            'coefficient' => 3,
                        ],
                    ]
                ],
                [
                    'code'    => 'INF 1505',
                    'nom' => 'Génie Logiciel',
                    'credit' => 2,
                    'ecus' => [
                        [
                            'code'    => '1INF 1505',
                            'nom' => 'Génie Logiciel',
                            'coefficient' => 2,
                        ]
                    ]
                ],
                [
                    'code'    => 'INF 1506',
                    'nom' => 'Réseaux et Systèmes',
                    'credit' => 6,
                    'ecus' => [
                        [
                            'code'    => '1INF 1505',
                            'nom' => 'Réseaux Informatiques 2',
                            'coefficient' => 3,
                        ],
                        [
                            'code'    => '2INF 1505',
                            'nom' => 'Administration Système Linux',
                            'coefficient' => 3,
                        ]
                    ]
                ],
            ],
        ],
        //S6 L Informatique
        [
            'filiere' => 'Informatique',
            'cycle' => 'Licence',
            'semestre' => 'Semestre 6',
            'ues' => [
                [
                    'code'    => 'INF 1600',
                    'nom' => 'Sécurité informatique',
                    'credit' => 3,
                    'ecus' => [
                        [
                            'code'    => '1INF 1600',
                            'nom' => 'Sécurité informatique',
                            'coefficient' => 3,
                        ],
                    ]
                ],
                [
                    'code'    => 'INF 1601',
                    'nom' => 'Technologies Web 2',
                    'credit' => 3,
                    'ecus' => [
                        [
                            'code'    => '1INF 1601',
                            'nom' => 'Technologies Web 2',
                            'coefficient' => 3,
                        ]
                    ]
                ],
                [
                    'code'    => 'INF 1602',
                    'nom' => 'Techniques d’expression',
                    'credit' => 2,
                    'ecus' => [
                        [
                            'code'    => '1INF 1602',
                            'nom' => 'Techniques d’expression',
                            'coefficient' => 2,
                        ]
                    ]
                ],
                [
                    'code'    => 'INF 1603',
                    'nom' => 'Maintenance des équipements informatiques',
                    'credit' => 3,
                    'ecus' => [
                        [
                            'code'    => '1INF 1603',
                            'nom' => 'Maintenance des équipements informatiques',
                            'coefficient' => 3,
                        ]
                    ]
                ],
                [
                    'code'    => 'INF 1604',
                    'nom' => "Développement d’application mobile",
                    'credit' => 2,
                    'ecus' => [
                        [
                            'code'    => '1INF 1604',
                            'nom' => "Développement d’application mobile",
                            'coefficient' => 2,
                        ]
                    ]
                ],
                [
                    'code'    => 'INF 1605',
                    'nom' => "Réseaux sans fil",
                    'credit' => 2,
                    'ecus' => [
                        [
                            'code'    => '1INF 1605',
                            'nom' => "Réseaux sans fil",
                            'coefficient' => 2,
                        ]
                    ]
                ],
                [
                    'code'    => 'INF 1606',
                    'nom' => "Gestion de projets informatiques",
                    'credit' => 2,
                    'ecus' => [
                        [
                            'code'    => '1INF 1606',
                            'nom' => "Gestion de projets informatiques",
                            'coefficient' => 2,
                        ]
                    ]
                ],
                [
                    'code'    => 'INF 1607',
                    'nom' => "Rédaction de documents scientifiques",
                    'credit' => 2,
                    'ecus' => [
                        [
                            'code'    => '1INF 1607',
                            'nom' => "Rédaction de documents scientifiques",
                            'coefficient' => 2,
                        ]
                    ]
                ],
                [
                    'code'    => 'TCC 1660',
                    'nom' => "UE Transversale",
                    'credit' => '2',
                    'ecus' => [
                        [
                            'code'    => '1TCC 1660',
                            'nom' => "Initiation au Projet Professionnel",
                            'coefficient' => 2,
                        ]
                    ]
                ],
                [
                    'code'    => 'INF 1661',
                    'nom' => "Présentation projet tutoré",
                    'credit' => 3,
                    'ecus' => [
                        [
                            'code'    => '1INF 1661',
                            'nom' => "Présentation projet tutoré",
                            'coefficient' => 3,
                        ]
                    ]
                ],
                [
                    'code'    => 'INF 1661',
                    'nom' => "Rapport projet tutoré",
                    'credit' => 6,
                    'ecus' => [
                        [
                            'code'    => '1INF 1661',
                            'nom' => "Rapport projet tutoré",
                            'coefficient' => 6,
                        ]
                    ]
                ],
            ],
        ],
//############################ SVT ###############################
        //S1 L SVT
        [
            'filiere' => 'Sciences de la Vie et de la Terre (SVT)',
            'cycle' => 'Licence',
            'semestre' => 'Semestre 1',
            'ues' => [
                [
                    'code'    => 'MTH 1100',
                    'nom' => 'Mathématiques générales',
                    'credit' => 5,
                    'ecus' => [
                        [
                            'code'    => '1MTH 1100',
                            'nom' => 'Analyse',
                            'coefficient' => 3,
                        ],
                        [
                            'code'    => '2MTH 1100',
                            'nom' => 'Algèbre',
                            'coefficient' => 2,
                        ],
                    ]
                ],
                [
                    'code'    => 'PHY 1100',
                    'nom' => 'Physique',
                    'credit' => 5,
                    'ecus' => [
                        [
                            'code'    => '1PHY 1100',
                            'nom' => 'Mécanique',
                            'coefficient' => 3,
                        ],
                        [
                            'code'    => '2PHY 1100',
                            'nom' => 'Optique',
                            'coefficient' => 2,
                        ],
                    ]
                ],
                [
                    'code'    => 'CHM 1100',
                    'nom' => 'Chimie',
                    'credit' => 5,
                    'ecus' => [
                        [
                            'code'    => '1CHM 1100',
                            'nom' => 'Atomistique',
                            'coefficient' => 3,
                        ],
                        [
                            'code'    => '2CHM 1100',
                            'nom' => 'Liaisons chimiques',
                            'coefficient' => 2,
                        ],
                    ]
                ],
                [
                    'code'    => 'BIO 1100',
                    'nom' => 'Biologie cellulaire',
                    'credit' => 4,
                    'ecus' => [
                        [
                            'code'    => '1BIO 1100',
                            'nom' => 'Cellules et Virus',
                            'coefficient' => 2,
                        ],
                        [
                            'code'    => '2BIO 1100',
                            'nom' => 'Membrane plasmique, Hyaloplasme et cytosquelette',
                            'coefficient' => 1,
                        ],
                        [
                            'code'    => '3BIO 1100',
                            'nom' => 'Organites intracellulaires et rôles',
                            'coefficient' => 1,
                        ],
                    ]
                ],
                [
                    'code'    => 'BIO 1101',
                    'nom' => 'Embryologie',
                    'credit' => 3,
                    'ecus' => [
                        [
                            'code'    => '1BIO 1101',
                            'nom' => 'Grandes étapes du développement embryonnaire',
                            'coefficient' => 1,
                        ],
                        [
                            'code'    => '2BIO 1101',
                            'nom' => 'Développement embryonnaire des invertébrés et des vertébrés',
                            'coefficient' => 2,
                        ],
                    ]
                ],
                [
                    'code'    => 'SCT 1100',
                    'nom' => 'Géodynamique Interne – Minéraux et roches',
                    'credit' => 6,
                    'ecus' => [
                        [
                            'code'    => '1SCT 1100',
                            'nom' => 'Géodynamique interne',
                            'coefficient' => 4,
                        ],
                        [
                            'code'    => '2SCT 1100',
                            'nom' => 'Minéraux et Roches',
                            'coefficient' => 2,
                        ],
                    ]
                ],
                [
                    'code'    => 'TCC 1100',
                    'nom' => 'Techniques d’expression et de communication',
                    'credit' => 2,
                    'ecus' => [
                        [
                            'code'    => '1TCC 1100',
                            'nom' => 'Anglais',
                            'coefficient' => 1,
                        ],
                        [
                            'code'    => '2TCC 1100',
                            'nom' => 'Expressions orale et écrite',
                            'coefficient' => 1,
                        ],
                    ]
                ],
            ],
        ],
        //S2 L SVT
        [
            'filiere' => 'Sciences de la Vie et de la Terre (SVT)',
            'cycle' => 'Licence',
            'semestre' => 'Semestre 2',
            'ues' => [
                [
                    'code'    => 'MHT 1200',
                    'nom' => 'Mathématiques',
                    'credit' => 4,
                    'ecus' => [
                        [
                            'code'    => '1MHT 1200',
                            'nom' => 'Probabilités',
                            'coefficient' => 2,
                        ],
                        [
                            'code'    => '2MHT 1200',
                            'nom' => 'Statistiques',
                            'coefficient' => 2,
                        ],
                    ]
                ],
                [
                    'code'    => 'PHY 1200',
                    'nom' => 'Physique',
                    'credit' => 4,
                    'ecus' => [
                        [
                            'code'    => '1PHY 1200',
                            'nom' => 'Thermodynamique',
                            'coefficient' => 2,
                        ],
                        [
                            'code'    => '2PHY 1200',
                            'nom' => 'Electricité',
                            'coefficient' => 2,
                        ],
                    ]
                ],
                [
                    'code'    => 'CHM 1200',
                    'nom' => 'Chimie',
                    'credit' => 5,
                    'ecus' => [
                        [
                            'code'    => '1CHM 1200',
                            'nom' => 'Thermodynamique chimique',
                            'coefficient' => 3,
                        ],
                        [
                            'code'    => '2CHM 1200',
                            'nom' => 'Solutions aqueuses',
                            'coefficient' => 2,
                        ],
                    ]
                ],
                [
                    'code'    => 'BIO 1200',
                    'nom' => 'Génétique formelle',
                    'credit' => 6,
                    'ecus' => [
                        [
                            'code'    =>'1BIO 1200',
                            'nom' => 'Matériel héréditaire',
                            'coefficient' => 3,
                        ],
                        [
                            'code'    => '2BIO 1200',
                            'nom' => 'Hérédité',
                            'coefficient' => 3,
                        ],
                    ]
                ],
                [
                    'code'    => 'SCT 1200',
                    'nom' => 'Géodynamique Externe et Cartographie',
                    'credit' => 6,
                    'ecus' => [
                        [
                            'code'    => '1SCT 1200',
                            'nom' => 'Géodynamique Externe',
                            'coefficient' => 3,
                        ],
                        [
                            'code'    => '2SCT 1200',
                            'nom' => 'Cartographie',
                            'coefficient' => 3,
                        ],
                    ]
                ],
                [
                    'code'    => 'ANG 1200',
                    'nom' => 'Anglais scientifique',
                    'credit' => 2,
                    'ecus' => [
                        [
                            'code'    => '1ANG 1200',
                            'nom' => 'Anglais scientifique',
                            'coefficient' => 2,
                        ],
                    ]
                ],
                [
                    'code'    => 'TCC 1260',
                    'nom' => 'UE transversales',
                    'credit' => 2,
                    'ecus' => [
                        [
                            'code'    => '1TCC 1260',
                            'nom' => 'Epistémologie',
                            'coefficient' => 1,
                        ],
                        [
                            'code'    => '2TCC 1260',
                            'nom' => 'Technique de documentation',
                            'coefficient' => 1,
                        ],
                    ]
                ],
                [
                    'code'    => 'TCC 1261',
                    'nom' => 'UE libres',
                    'credit' => 1,
                    'ecus' => [
                        [
                            'code'    => '1TCC 1261',
                            'nom' => 'Initiation aux TIC',
                            'coefficient' => 1,
                        ],
                        [
                            'code'    => '2TCC 1261',
                            'nom' => 'Secourisme',
                            'coefficient' => 1,
                        ],
                    ]
                ],
            ],
        ],
        //S3 L SVT
        [
            'filiere' => 'Sciences de la Vie et de la Terre (SVT)',
            'cycle' => 'Licence',
            'semestre' => 'Semestre 3',
            'ues' => [
                [
                    'code'    => 'CHM 1300',
                    'nom' => 'Chimie',
                    'credit' => 5,
                    'ecus' => [
                        [
                            'code'    => '1CHM 1300',
                            'nom' => 'Chimie organique',
                            'coefficient' => 3,
                        ],
                        [
                            'code'    => '2CHM 1300',
                            'nom' => 'Chimie minérale',
                            'coefficient' => 2,
                        ],
                    ]
                ],
                [
                    'code'    => 'SCT 1300',
                    'nom' => 'Pétrologie générale',
                    'credit' => 6,
                    'ecus' => [
                        [
                            'code'    => '1SCT 1300',
                            'nom' => 'Pétrologie magmatique',
                            'coefficient' => 2,
                        ],
                        [
                            'code'    => '2SCT 1300',
                            'nom' => 'Pétrologie Métamorphique',
                            'coefficient' => 2,
                        ],
                        [
                            'code'    => '3SCT 1300',
                            'nom' => 'Pétrologie sédimentaire',
                            'coefficient' => 2,
                        ],
                    ]
                ],
                [
                    'code'    => 'SCT 1301',
                    'nom' => 'Cristallographie et Minéralogie',
                    'credit' => 5,
                    'ecus' => [
                        [
                            'code'    => '1SCT 1301',
                            'nom' => 'Cristallographie',
                            'coefficient' => 2,
                        ],
                        [
                            'code'    => '2SCT 1301',
                            'nom' => 'Minéralogie',
                            'coefficient' => 3,
                        ],
                    ]
                ],
                [
                    'code'    => 'BIO 1300',
                    'nom' => 'Biologie Animale',
                    'credit' => 6,
                    'ecus' => [
                        [
                            'code'    => '1BIO 1300',
                            'nom' => 'Protozoaires',
                            'coefficient' => 3,
                        ],
                        [
                            'code'    => '2BIO 1300',
                            'nom' => 'Métazoaires',
                            'coefficient' => 3,
                        ],
                    ]
                ],
                [
                    'code'    => 'BIO 1301',
                    'nom' => 'Biochimie',
                    'credit' => 5,
                    'ecus' => [
                        [
                            'code'    => '1BIO 1301',
                            'nom' => 'Biochimie structurale',
                            'coefficient' => 3,
                        ],
                        [
                            'code'    => '2BIO 1301',
                            'nom' => 'Enzymologie',
                            'coefficient' => 2,
                        ],
                    ]
                ],
                [
                    'code'    => 'ANG 1300',
                    'nom' => 'Anglais scientifique avancé',
                    'credit' => 2,
                    'ecus' => [
                        [
                            'code'    => '1ANG 1300',
                            'nom' => 'Anglais scientifique avancé',
                            'coefficient' => 2,
                        ],
                    ]
                ],
                [
                    'code'    => 'TCC 1360',
                    'nom' => 'UE libres',
                    'credit' => 1,
                    'ecus' => [
                        [
                            'code'    => '1TCC 1360',
                            'nom' => 'Ethiques sociale et politique',
                            'coefficient' => 1,
                        ],
                        [
                            'code'    => '2TCC 1360',
                            'nom' => 'Eco citoyenneté',
                            'coefficient' => 1,
                        ],
                    ]
                ],
            ],
        ],
        //S4 L SVT
        [
            'filiere' => 'Sciences de la Vie et de la Terre (SVT)',
            'cycle' => 'Licence',
            'semestre' => 'Semestre 4',
            'ues' => [
                [
                    'code'    => 'BIO 1400',
                    'nom' => 'Biologie végétale',
                    'credit' => 5,
                    'ecus' => [
                        [
                            'code'    => '1BIO 1400',
                            'nom' => 'Anatomie et morphologie',
                            'coefficient' => 2,
                        ],
                        [
                            'code'    => '2BIO 1400',
                            'nom' => 'TP d’Anatomie et morphologie',
                            'coefficient' => 1,
                        ],
                        [
                            'code'    => '3BIO 1400',
                            'nom' => 'Reproduction',
                            'coefficient' => 2,
                        ],
                    ]
                ],
                [
                    'code'    => 'SCT 1400',
                    'nom' => 'Pédologie et Géomorphologie',
                    'credit' => 5,
                    'ecus' => [
                        [
                            'code'    => '1SCT 1400',
                            'nom' => 'Pédologie',
                            'coefficient' => 3,
                        ],
                        [
                            'code'    => '2SCT 1400',
                            'nom' => 'Géomorphologie',
                            'coefficient' => 2,
                        ],
                    ]
                ],
                [
                    'code'    => 'BIO 1401',
                    'nom' => 'Physiologie animale',
                    'credit' => 4,
                    'ecus' => [
                        [
                            'code'    => '1BIO 1401',
                            'nom' => 'Physiologie animale',
                            'coefficient' => 3,
                        ],
                        [
                            'code'    => '2BIO 1401',
                            'nom' => 'TP de Physiologie animale',
                            'coefficient' => 1,
                        ],
                    ]
                ],
                [
                    'code'    => 'BIO 1402',
                    'nom' => 'Physiologie végétale',
                    'credit' => 4,
                    'ecus' => [
                        [
                            'code'    => '1BIO 1402',
                            'nom' => 'Physiologie végétale',
                            'coefficient' => 3,
                        ],
                        [
                            'code'    => '2BIO 1402',
                            'nom' => 'TP de Physiologie végétale',
                            'coefficient' => 1,
                        ],
                    ]
                ],
                [
                    'code'    => 'SCT 1401',
                    'nom' => 'Paléontologie et Stratigraphie',
                    'credit' => 4,
                    'ecus' => [
                        [
                            'code'    => '1SCT 1401',
                            'nom' => 'Paléontologie',
                            'coefficient' => 2,
                        ],
                        [
                            'code'    => '2SCT 1401',
                            'nom' => 'Stratigraphie',
                            'coefficient' => 2,
                        ],
                    ]
                ],
                [
                    'code'    => 'BIO 1403',
                    'nom' => 'Microbiologie générale',
                    'credit' => 4,
                    'ecus' => [
                        [
                            'code'    => '1BIO 1403',
                            'nom' => 'Structure et Physiologie de la cellule microbienne',
                            'coefficient' => 1,
                        ],
                        [
                            'code'    => '2BIO 1403',
                            'nom' => 'TP de Structure et Physiologie de la cellule microbienne',
                            'coefficient' => 1,
                        ],
                        [
                            'code'    => 'BIO 1403',
                            'nom' => 'Ecologie microbienne',
                            'coefficient' => 1,
                        ],
                        [
                            'code'    => 'BIO 1403',
                            'nom' => 'TP d’Ecologie microbienne',
                            'coefficient' => 1,
                        ],
                    ]
                ],
                [
                    'code'    => 'SCT 1402',
                    'nom' => 'Hydrologie et Climatologie',
                    'credit' => 3,
                    'ecus' => [
                        [
                            'code'    => '1SCT 1402',
                            'nom' => 'Climatologie',
                            'coefficient' => 2,
                        ],
                        [
                            'code'    => '2SCT 1402',
                            'nom' => 'Hydrologie',
                            'coefficient' => 1,
                        ],
                    ]
                ],
                [
                    'code'    => 'DRE 1400',
                    'nom' => 'UE libres',
                    'credit' => 1,
                    'ecus' => [
                        [
                            'code'    => '1DRE 1400',
                            'nom' => 'Droit de l\'environnement',
                            'coefficient' => 1,
                        ],
                        [
                            'code'    => '2DRE 1400',
                            'nom' => 'Bioéthique',
                            'coefficient' => 1,
                        ],
                        [
                            'code'    => '3DRE 1400',
                            'nom' => 'Droit foncier',
                            'coefficient' => 1,
                        ],
                    ]
                ],
            ],
        ],
        //S5 L SVT
        [
            'filiere' => 'Sciences de la Vie et de la Terre (SVT)',
            'cycle' => 'Licence',
            'semestre' => 'Semestre 5',
            'ues' => [
                [
                    'code'    => 'BIO 1501',
                    'nom' => 'Génétique',
                    'credit' => 2,
                    'ecus' => [
                        [
                            'code'    => '1BIO 1501',
                            'nom' => 'Génétique des eucaryotes',
                            'coefficient' => 2,
                        ],
                    ]
                ],
                [
                    'code'    => 'BIO 1502',
                    'nom' => 'Virologie générale',
                    'credit' => 1,
                    'ecus' => [
                        [
                            'code'    => '1BIO 1502',
                            'nom' => 'Virologie générale',
                            'coefficient' => 1,
                        ],
                    ]
                ],
                [
                    'code'    => 'BIO 1503',
                    'nom' => 'Biochimie métabolique',
                    'credit' => 3,
                    'ecus' => [
                        [
                            'code'    => '1BIO 1503',
                            'nom' => 'Métabolisme des lipides',
                            'coefficient' => 1,
                        ],
                        [
                            'code'    => '2BIO 1503',
                            'nom' => 'Métabolisme des glucides',
                            'coefficient' => 1,
                        ],
                        [
                            'code'    => '3BIO 1503',
                            'nom' => 'Métabolisme des protides',
                            'coefficient' => 1,
                        ],
                    ]
                ],
                [
                    'code'    => 'BIO 1504',
                    'nom' => 'Bioénergétique',
                    'credit' => 2,
                    'ecus' => [
                        [
                            'code'    => '1BIO 1504',
                            'nom' => 'Bioénergétique',
                            'coefficient' => 2,
                        ],
                    ]
                ],
                [
                    'code'    => 'BIO 1505',
                    'nom' => 'Immunologie',
                    'credit' => 1,
                    'ecus' => [
                        [
                            'code'    => '1BIO 1505',
                            'nom' => 'Immunologie',
                            'coefficient' => 1,
                        ],
                    ]
                ],
                [
                    'code'    => 'BIO 1506',
                    'nom' => 'Enzymologie',
                    'credit' => 3,
                    'ecus' => [
                        [
                            'code'    => '1BIO 1506',
                            'nom' => 'Notion de cinétique enzymatique',
                            'coefficient' => 2,
                        ],
                        [
                            'code'    => '2BIO 1506',
                            'nom' => 'TP de cinétique enzymatique',
                            'coefficient' => 1,
                        ],
                    ]
                ],
                [
                    'code'    => 'BIO 1507',
                    'nom' => 'Systématique bactérienne',
                    'credit' => 2,
                    'ecus' => [
                        [
                            'code'    => '1BIO 1507',
                            'nom' => 'Systématique bactérienne',
                            'coefficient' => 2,
                        ],
                    ]
                ],
                [
                    'code'    => 'BIO 1508',
                    'nom' => 'Biologie végétale',
                    'credit' => 3,
                    'ecus' => [
                        [
                            'code'    => '1BIO 1508',
                            'nom' => 'Systématique des algues',
                            'coefficient' => 1,
                        ],
                        [
                            'code'    => '2BIO 1508',
                            'nom' => 'Biologie de la reproduction des algues',
                            'coefficient' => 1,
                        ],
                        [
                            'code'    => '3BIO 1508',
                            'nom' => 'TP de Systématique des algues',
                            'coefficient' => 1,
                        ],
                    ]
                ],
                [
                    'code'    => 'BIO 1509',
                    'nom' => 'Biologie animale',
                    'credit' => 3,
                    'ecus' => [
                        [
                            'code'    => '1BIO 1509',
                            'nom' => 'Anatomie comparée',
                            'coefficient' => 2,
                        ],
                        [
                            'code'    => '2BIO 1509',
                            'nom' => 'TP d’Anatomie comparée',
                            'coefficient' => 1,
                        ],
                    ]
                ],
                [
                    'code'    => '1BIO 1510',
                    'nom' => 'Physiologie animale',
                    'credit' => 5,
                    'ecus' => [
                        [
                            'code'    => '1BIO 1510',
                            'nom' => 'Système nerveux central',
                            'coefficient' => 2,
                        ],
                        [
                            'code'    => '2BIO 1510',
                            'nom' => 'Grandes fonctions (circulation, excrétion)',
                            'coefficient' => 2,
                        ],
                        [
                            'code'    => '3BIO 1510',
                            'nom' => 'TP des grandes fonctions (circulation, excrétion)',
                            'coefficient' => 1,
                        ],
                    ]
                ],
                [
                    'code'    => 'BIO 1511',
                    'nom' => 'Physiologie végétale',
                    'credit' => 2,
                    'ecus' => [
                        [
                            'code'    => '1BIO 1511',
                            'nom' => 'Croissance et développement',
                            'coefficient' => 1,
                        ],
                        [
                            'code'    => '2BIO 1511',
                            'nom' => 'TP de Croissance et développement',
                            'coefficient' => 1,
                        ],
                    ]
                ],
                [
                    'code'    => 'BIO 1512',
                    'nom' => 'Ecologie générale',
                    'credit' => 2,
                    'ecus' => [
                        [
                            'code'    => '1BIO 1512',
                            'nom' => 'Ecologie fondamentale',
                            'coefficient' => 2,
                        ],
                    ]
                ],
                [
                    'code'    => 'INF 1560',
                    'nom' => 'Informatique',
                    'credit' => 1,
                    'ecus' => [
                        [
                            'code'    => '1INF 1560',
                            'nom' => 'Présentation assistée par l’ordinateur',
                            'coefficient' => 1,
                        ],
                    ]
                ],
            ],
        ],
        //S6 L SVT
        [
            'filiere' => 'Sciences de la Vie et de la Terre (SVT)',
            'cycle' => 'Licence',
            'semestre' => 'Semestre 6',
            'ues' => [
                [
                    'code'    => 'BIO 1600',
                    'nom' => 'Génétique',
                    'credit' => 5,
                    'ecus' => [
                        [
                            'code'    => '1BIO 1600',
                            'nom' => 'Génétique des procaryotes',
                            'coefficient' => 2,
                        ],
                        [
                            'code'    => '2BIO 1600',
                            'nom' => 'TD de Génétique des procaryotes',
                            'coefficient' => 1,
                        ],
                        [
                            'code'    => '3BIO 1600',
                            'nom' => 'Génétique quantitative',
                            'coefficient' => 2,
                        ],
                    ]
                ],
                [
                    'code'    => 'BIO 1601',
                    'nom' => 'Biologie moléculaire',
                    'credit' => 2,
                    'ecus' => [
                        [
                            'code'    => '1BIO 1601',
                            'nom' => 'Extraction et études des acides nucléiques',
                            'coefficient' => 2,
                        ],
                    ]
                ],
                [
                    'code'    => 'BIO 1602',
                    'nom' => 'Biologie végétale',
                    'credit' => 6,
                    'ecus' => [
                        [
                            'code'    => '1BIO 1602',
                            'nom' => 'Systématique des archégoniates',
                            'coefficient' => 1,
                        ],
                        [
                            'code'    => '2BIO 1602',
                            'nom' => 'Systématique des angiospermes',
                            'coefficient' => 2,
                        ],
                        [
                            'code'    => '3BIO 1602',
                            'nom' => 'Reproduction des trachéophytes',
                            'coefficient' => 1,
                        ],
                        [
                            'code'    => '4BIO 1602',
                            'nom' => 'Herborisation',
                            'coefficient' => 1,
                        ],
                        [
                            'code'    => '5BIO 1602',
                            'nom' => 'TP d’herborisation',
                            'coefficient' => 1,
                        ],
                    ]
                ],
                [
                    'code'    => 'BIO 1603',
                    'nom' => 'Physiologie végétale',
                    'credit' => 3,
                    'ecus' => [
                        [
                            'code'    => '1BIO 1603',
                            'nom' => 'Germination',
                            'coefficient' => 2,
                        ],
                        [
                            'code'    => '2BIO 1603',
                            'nom' => 'TP de Germination',
                            'coefficient' => 1,
                        ],
                    ]
                ],
                [
                    'code'    => 'BIO 1604',
                    'nom' => 'Biologie animale',
                    'credit' => 6,
                    'ecus' => [
                        [
                            'code'    => '1BIO 1604',
                            'nom' => 'Histologie',
                            'coefficient' => 2,
                        ],
                        [
                            'code'    => '2BIO 1604',
                            'nom' => 'Reproduction chez les animaux',
                            'coefficient' => 1,
                        ],
                        [
                            'code'    => '3BIO 1604',
                            'nom' => 'TP de Reproduction chez les animaux',
                            'coefficient' => 1,
                        ],
                    ]
                ],
                [
                    'code'    => 'BIO 1605',
                    'nom' => 'Physiologie animale',
                    'credit' => 5,
                    'ecus' => [
                        [
                            'code'    => '1BIO 1605',
                            'nom' => 'Endocrinologie',
                            'coefficient' => 2,
                        ],
                        [
                            'code'    => '2BIO 1605',
                            'nom' => 'Physiologie de la reproduction',
                            'coefficient' => 2,
                        ],
                        [
                            'code'    => '3BIO 1605',
                            'nom' => 'TP de Physiologie de la reproduction',
                            'coefficient' => 1,
                        ],
                    ]
                ],
                [
                    'code'    => '1BIO 1606',
                    'nom' => 'Ecologie/Environnement',
                    'credit' => 3,
                    'ecus' => [
                        [
                            'code'    => '1BIO 1606',
                            'nom' => 'Ecologie des populations',
                            'coefficient' => 2,
                        ],
                        [
                            'code'    => '2BIO 1606',
                            'nom' => 'Toxicologie et écotoxicologie',
                            'coefficient' => 1,
                        ],
                    ]
                ],
            ],
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Parcours des semestres
        foreach ($this->datas as $key => $data) {
            $filiere_id = Filiere::where('name', $data['filiere'])->first()->id;
            $cycle_id = Cycle::where('cycle', $data['cycle'])->first()->id;
            $semestre_id = Semestre::where('intitule', $data['semestre'])->first()->id;
            //Parcours des UE du semestre
            foreach ($data['ues'] as $cle => $ue) {
                $ue_id = DB::table('u_e_s')->insertGetId([
                    'code'    => $ue['code'],
                    'nom' => $ue['nom'],
                    'credit' => $ue['credit'],
                    'filiere_id' => $filiere_id,
                    'cycle_id' => $cycle_id,
                    'semestre_id' => $semestre_id
                ]);
                //Parcours des ECU de l UE
                foreach ($ue['ecus'] as $ecuKey => $ecu) {
                    DB::table('e_c_u_s')->insert([
                        'code'    => $ecu['code'],
                        'nom' => $ecu['nom'],
                        'coefficient' => $ecu['coefficient'],
                        'u_e_id' => $ue_id
                    ]);
                }
            }
        }
    }
}
