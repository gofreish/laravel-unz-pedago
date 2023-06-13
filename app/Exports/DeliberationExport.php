<?php

namespace App\Exports;

use Faker\Factory as Faker;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use App\Models\ECU;
use App\Models\Cycle;
use App\Models\Filiere;
use App\Models\Semestre;
use App\Models\UE;
use App\Models\Etudiant;
use App\Models\Promotion;

class DeliberationExport implements FromArray, WithHeadings, ShouldAutoSize, WithStyles
{
    //Alphabet pour les identifiants des colonnes excels
    private $alphabet = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
    //Les notes
    private $notes = array();
    //Les ECU groupés
    private $ecuGrouped = array();
    //Le cycle
    private $cycle = "";
    //Le semestre
    private $semestre = "";
    //La filiere
    private $filiere = "";
    //promotion
    private $promotion_id = 0;
    //Poids total du semestre
    private $creditTotal = 0;
    //Si c est session normale ou rattrage
    private $session = "";
    //Entete
    private $titreHead = ['PROCÈS VERBAL DE DÉLIBÉRATION'];
    private $filiereHead = array();
    private $niveauHead = array();
    //La tete des données
    private $HeadUE = array('INE','Nom','Prénom(s)','Date de naissance');
    private $HeadECU = array('x','x','x','x');
    private $HeadCredit = array('x','x','x','x');
    private $HeadCoefficient = array('x','x','x','x');

    public function __construct( $filiere, $promotion, $cycle, $semestre, $session){
        $this->cycle = $cycle;//'Licence'
        $this->semestre = $semestre;//'Semestre 4'
        $this->filiere = $filiere;//'Informatique'
        $this->session = $session;
        array_push($this->filiereHead, $this->filiere);
        array_push($this->niveauHead, 'Cycle '.$this->cycle.' '.$this->semestre.' '.$this->session);
        $this->session = $session;
        $cycle_id = Cycle::where('cycle', $this->cycle)->pluck('id')->first();
        $semestre_id = Semestre::where('intitule', $this->semestre)->pluck('id')->first();
        $filiere_id = Filiere::where('name', $this->filiere)->pluck('id')->first();
        $ueList = UE::select('id', 'nom', 'credit')->where('filiere_id', $filiere_id)->where('cycle_id', $cycle_id)->where('semestre_id', $semestre_id)->get();
        foreach($ueList as $cle=>$ue){
            $this->creditTotal += $ue->credit;
            $this->ecuGrouped[$ue->nom] = ECU::where('u_e_id', $ue->id)->get();
        }
        $this->promotion_id = Promotion::where('annee_entrer', $promotion)->where('filiere_id', $filiere_id)->pluck('id');
    }

    public function array(): array{
        $faker = Faker::create();
        $etudiants = Etudiant::where('promotion_id', $this->promotion_id)->get();
        foreach($etudiants as $cle => $etudiant){
            $total = 0;
            $notesEtudiant = array($etudiant->ine, $etudiant->nom, $etudiant->prenom, $etudiant->nee_le); //Les notes d un seul etudiant
            foreach ($this->ecuGrouped as $nomUE => $ecuGroup) { //On boucle suivant les groupe de UE
                $pondereUE = 0;//Pour calculer le pondéré
                foreach ($ecuGroup as $cle => $ecu) {  //On boucle sur les ECU de cette UE
                    $noteECU = $faker->numberBetween(0,20);
                    array_push($notesEtudiant, $noteECU);
                    $pondereUE += $noteECU*$ecu->coefficient;
                }
                $total += $pondereUE;//On ajoute les pondere pour faire le total
                array_push($notesEtudiant, $pondereUE);
            }
            array_push($notesEtudiant, $total);//On met le total des points
            array_push($notesEtudiant, $total/$this->creditTotal);//On on calcule et met la moyenne
            if( $total < 10*$this->creditTotal ){   //Si il est ajourné
                array_push($notesEtudiant,'Ajourné');
                array_push($notesEtudiant, $this->mention($total, $this->creditTotal));
            }else{  //Si il a valider
                array_push($notesEtudiant,'Validé');
                array_push($notesEtudiant, $this->mention($total, $this->creditTotal));
            }
            //On précise si il est ajourné ou pas
            array_push($this->notes, $notesEtudiant);
        }
        //dd($this->notes);
        return $this->notes;
    }

    public function styles(Worksheet $sheet){
        $debutCell = 4;
        $range = '';
        $sheet->mergeCells('A4:A7');
        $sheet->mergeCells('B4:B7');
        $sheet->mergeCells('C4:C7');
        $sheet->mergeCells('D4:D7');
       
        foreach ($this->ecuGrouped as $nomUE => $ecuGroup) {
            $nbrECU = count($ecuGroup);

            //UE
            $sheet->mergeCells($this->getColumnName($debutCell).'4:'.$this->getColumnName($debutCell+$nbrECU).'4');

            //Poids
            $sheet->mergeCells($this->getColumnName($debutCell).'6:'.$this->getColumnName($debutCell+$nbrECU-1).'6');
            
            $debutCell+=$nbrECU+1;
        }

        $sheet->mergeCells('A1:'.$this->getColumnName($debutCell-1).'1');
        $sheet->mergeCells('A2:'.$this->getColumnName($debutCell-1).'2');
        $sheet->mergeCells('A3:'.$this->getColumnName($debutCell-1).'3');
        
        $cel = $this->getColumnName($debutCell);
        $sheet->mergeCells($cel.'4:'.$cel.'7');//Total
        
        $cel = $this->getColumnName($debutCell+1);
        $sheet->mergeCells($cel.'4:'.$cel.'7');//Moyenne
        
        $cel = $this->getColumnName($debutCell+2);
        $sheet->mergeCells($cel.'4:'.$cel.'7');//Resultat
        
        $cel = $this->getColumnName($debutCell+3);
        $sheet->mergeCells($cel.'4:'.$cel.'7');//Mention

        $styleArray = [
                        'font' => [
                            'bold' => true,
                            'size' => 20, 
                            'underline' => \PhpOffice\PhpSpreadsheet\Style\Font::UNDERLINE_SINGLE],
                        'alignment' => [ 
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
                            ]
                    ];

        return [
            // Style the first row as bold text.
            1    => $styleArray,
            2    => $styleArray,
            3    => $styleArray,
            4    => [
                        'font' => ['bold' => true, 'size' => 16],
                        'alignment' => [ 
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                        ]
                    ],
            
        ];
        
    }

    public function headings(): array
    {   
        foreach ($this->ecuGrouped as $nomUE => $ecuGroup) { //On boucle suivant les groupe de UE
            $credit = 0;    //Pour avoir le credit d une UE

            array_push($this->HeadUE, $nomUE); //Ajout du nom de l UE a la premiere ligne

            array_push($this->HeadCredit, "Poids ECU"); //Ajout du label poids à la 2nd ligne 

            foreach ($ecuGroup as $cle => $ecu) {  //On boucle sur les ECU de cette UE

                array_push($this->HeadUE, "x"); //Une croix pour la fusion prochaine des cellules
                
                array_push($this->HeadECU, $ecu->nom); //Ajout du nom de l ecu 2nd ligne
                
                array_push($this->HeadCoefficient, $ecu->coefficient);

                array_push($this->HeadCredit, "x");
                $credit += $ecu->coefficient;
            }
            array_push($this->HeadCoefficient, $credit);

            array_push($this->HeadECU, "Pondéré");
            array_pop($this->HeadCredit);
            array_push($this->HeadCredit, "Credit UE");
        }
        array_push($this->HeadUE, 'Total');
        array_push($this->HeadUE, 'Moyenne');
        array_push($this->HeadUE, 'Resultat');
        array_push($this->HeadUE, 'Mention');

        $Head = [$this->titreHead, $this->filiereHead, $this->niveauHead, $this->HeadUE, $this->HeadECU, $this->HeadCredit, $this->HeadCoefficient];
        return $Head;
    }
    /**
     * fonction de test
    */
    private function testUnitaire(){
        
    }

    public function download(){
        return Excel::store($this, 'Deliberation.xlsx');
    }

    private function getColumnName($debutCell):string //Renvoit juste la lettre de la colonne
    {
        if( $debutCell < 26){
            return $this->alphabet[$debutCell];
        }else{
            return 'A'.$this->alphabet[$debutCell-26];
        }
    }

    private function mention($total, $credits):string
    {
        if( (10*$credits <= $total) && ($total < 12*$credits) ){
            return 'Passable';
        }elseif( (12*$credits <= $total) && ($total < 15*$credits) ){
            return 'Assez Bien';
        }elseif( (15*$credits <= $total) && ($total < 17*$credits) ){
            return 'Bien';
        }elseif( (17*$credits <= $total) && ($total < 18*$credits) ){
            return 'Très Bien';
        }elseif( 18*$credits <= $total ){
            return 'Excellent';
        }else{
            return '';
        }
    }

}
