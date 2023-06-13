<?php
/**
 * Astuce pour les style 
 * En cle le contenu, en valeur le range des colonnes
*/
namespace App\Exports\Deliberation;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Deliberation;
use App\Models\Promotion;
use App\Models\Filiere;
use App\Models\Cycle;
use App\Models\Semestre;
use App\Models\UE;
use App\Models\ECU;
use App\Models\Etudiant;
use App\Models\TestMark;

class DeliberationExport implements FromArray, WithHeadings, WithStyles, ShouldAutoSize, WithTitle
{
    //Chemin de stockage de la deliberation
    private $storePath;

    //Using
    private $deliberation;
    private $filiere;
    private $promotion;
    private $cycle;
    private $semestre;
    private $ues;
    private $delibTab;
    //Alphabet pour les identifiants des colonnes excels
    private $alphabet = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
    //Total pondere
    private $totalPondere = 0;
    //Entete
    private $titreHead = ['PROCÈS VERBAL DE DÉLIBÉRATION'];
    private $filiereHead;
    private $niveauHead;
    private $titreColonne;
    //La tete des données
    private $HeadUE = array('INE', 'Nom', 'Prénom(s)', 'Date de naissance');
    private $HeadUEColonne = array('A4:A7', 'B4:B7', 'C4:C7', 'D4:D7');
    
    private $HeadECU = array('x','x','x','x');
    
    private $HeadCredit = array('x','x','x','x');
    private $HeadCreditColonne = array();
    
    private $HeadCoefficient = array('x','x','x','x');

    public function __construct( $delib_id ) {
        $this->deliberation = Deliberation::find($delib_id);
        $this->promotion = Promotion::find($this->deliberation->promotion_id);
        $this->filiere = Filiere::find($this->promotion->filiere_id);
        $this->cycle = Cycle::find($this->deliberation->cycle_id);
        $this->semestre = Semestre::find($this->deliberation->semestre_id);
        //Recuperation des UE
        $this->ues = UE::where('filiere_id', $this->filiere->id)
            ->where('cycle_id', $this->cycle->id)
            ->where('semestre_id', $this->semestre->id)
            ->orderBy('nom')
            ->get();
        $this->filiereHead = array($this->filiere->name);
        $session = $this->deliberation->is_normal ? 'normale' : 'de rattrapage';
        $this->niveauHead = array('Cycle '.$this->cycle->cycle.' '.$this->semestre->intitule.' Session '.$session);
        $this->initDatas();
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Déliberation';
    }

    public function headings(): array
    {
        return [
            $this->titreHead,
            $this->filiereHead,
            $this->niveauHead,
            $this->HeadUE,
            $this->HeadECU,
            $this->HeadCredit,
            $this->HeadCoefficient
        ];
    }

    public function styles(Worksheet $sheet){
        //explode
        //dd($this->HeadUEColonne);
        foreach ($this->titreColonne as $key => $range) {
            $sheet->mergeCells($range);
        }

        foreach ($this->HeadUEColonne as $key => $range) {
            $sheet->mergeCells($range);
        }
        
        foreach ($this->HeadCreditColonne as $key => $range) {
            $sheet->mergeCells($range);
        }

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
        1 => $styleArray,
        2 => $styleArray,
        3 => $styleArray,
        4 => [
                'font' => ['bold' => true, 'size' => 16],
                'alignment' => [ 
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ]
            ],  
        ];
    }

    private function initDatas(){
        $debut = $fin = 5;
        //Parcour des UE
        foreach ($this->ues as $key => $ue) {
            //On det la portion de colonne occupée et on l affecte coe valeur
            array_push($this->HeadUE, $ue->nom);//On ajoute l ue
                
            //On ajoute le credit
            array_push($this->HeadCredit, 'Poids des ECU');

            $coefficientUE = 0;
            //On recupere les ECU
            $ecus = ECU::where('u_e_id', $ue->id)->orderBy('nom')->get();
            //On ajoute les ECU
            foreach ($ecus as $cle => $ecu) {
                array_push($this->HeadECU, $ecu->nom); //on ajoute l ecu
                array_push($this->HeadCoefficient, $ecu->coefficient); //On ajoute son coefficient
                array_push($this->HeadUE, 'x');//On ajoute des x pour créer de l espace pour la fusion
                array_push($this->HeadCredit, 'x');//On ajoute des x pour créer de l espace pour la fusion
                $fin++;
                $coefficientUE += $ecu->coefficient;
            }
            array_push($this->HeadCoefficient, $coefficientUE);
            $this->totalPondere += $coefficientUE;
            $this->HeadCredit[array_key_last($this->HeadCredit)] = "Credit UE";//On remplace la derniere entrée du tab
            array_push($this->HeadECU, 'Pondere UE');//On ajoute la chaine pondere
            array_push($this->HeadUEColonne, $this->getColumnName($debut).'4:'.$this->getColumnName($fin).'4');//On ajoute l espace occupé
            array_push($this->HeadCreditColonne, $this->getColumnName($debut).'6:'.$this->getColumnName($fin-1).'6');//On ajoute l espace occupé par Poids ECU
            $debut = $fin + 1;
            $fin = $debut;
        }
        $lettreCol = $this->getColumnName( count($this->HeadUE)+1 );
        array_push($this->HeadUE, 'Total');
        array_push($this->HeadUEColonne, $lettreCol.'4:'.$lettreCol.'7');

        $lettreCol = $this->getColumnName( count($this->HeadUE)+1 );
        array_push($this->HeadUE, 'Moyenne');
        array_push($this->HeadUEColonne, $lettreCol.'4:'.$lettreCol.'7');

        $lettreCol = $this->getColumnName( count($this->HeadUE)+1 );
        array_push($this->HeadUE, 'Resultat');
        array_push($this->HeadUEColonne, $lettreCol.'4:'.$lettreCol.'7');

        $lettreCol = $this->getColumnName( count($this->HeadUE)+1 );
        array_push($this->HeadUE, 'Mention');
        array_push($this->HeadUEColonne, $lettreCol.'4:'.$lettreCol.'7');

        $colFin = $this->getColumnName(8 + count($this->HeadECU)+1 );
        $this->titreColonne = array(
            'A1:'.$colFin.'1',
            'A2:'.$colFin.'2',
            'A3:'.$colFin.'3'
        );
    }

    private function generateRegEx( $resultat ){
        /* exemple : l{1(v:1);2(v:1);3(a:1);4(v:1);5(v:1);6(v:1);}|m{1(a:2);}
        regEx dans le cas des ajourner licence s3
        regEx = l{______________3(a%
        regEx dans le cas des ajourner Master s1
        regEx = %m{1(a%
        */
        $resultsPossible = ['n', 'a', 'v'];
        if( in_array($resultat, $resultsPossible, true) ){
            $semestreNumber = $this->semestre->intitule[strlen($this->semestre->intitule) - 1];
            $regEx = "";
            switch ($this->cycle->cycle[0]) {
                case 'L':
                    $regEx = "l{";
                    break;
                case 'M':
                    $regEx = "%m{";
                    break;
            }
            for ($i=0; $i < 7*(intval($semestreNumber)-1) ; $i++) { 
                $regEx = $regEx.'_';
            }
            $regEx = $regEx.$semestreNumber."($resultat%";
            return $regEx;
        }
    }

    /**
    * @return array
    */
    public function array(): array{
        //Tous les etudiant ayant reussi ou ajourner le semestre
        $promotions_id = Promotion::where('filiere_id', $this->filiere->id)->pluck('id');

        $students = Etudiant::where('cycle_id', $this->cycle->id)
            ->whereIn('promotion_id', $promotions_id->all())
            ->where('historique', 'like', $this->generateRegEx('v'))
            ->orWhere('historique', 'like', $this->generateRegEx('a'))
            ->orderBy('nom')
            ->get();
        
        $dataTab = array();
        foreach ( $students as $key => $studentObj) {
            $student = array($studentObj->ine, $studentObj->nom, $studentObj->prenom, $studentObj->nee_le);
            $total = 0;
            foreach ($this->ues as $cle => $ue) {
                $ecus = ECU::where('u_e_id', $ue->id)->orderBy('nom')->get();
                $pondere = 0;
                foreach ($ecus as $iden => $ecu) {
                    //Ajout de la note
                    $note = TestMark::where('etudiant_ine', $studentObj->ine)
                        ->where('e_c_u_id', $ecu->id)
                        ->where('is_normal', $this->deliberation->is_normal)
                        ->first();
                    //Calcul du pondere
                    $pondere += $note->note*$ecu->coefficient;
                    array_push($student, $note->note);
                }
                array_push($student, $pondere);
                $total += $pondere;
            }
            array_push($student, $total);
            array_push($student, $total/$this->totalPondere);
            if( $total < 10*$this->totalPondere ){
                array_push($student, "Ajourné");
            }else{
                array_push($student, "Validé");
            }
            array_push($student, $this->mention( $total ) );
            array_push($dataTab, $student);
        }
        return $dataTab;
    }

    private function mention( $total ):string
    {
        if( (10*$this->totalPondere <= $total) && ($total < 12*$this->totalPondere) ){
            return 'Passable';
        }elseif( (12*$this->totalPondere <= $total) && ($total < 15*$this->totalPondere) ){
            return 'Assez Bien';
        }elseif( (15*$this->totalPondere <= $total) && ($total < 17*$this->totalPondere) ){
            return 'Bien';
        }elseif( (17*$this->totalPondere <= $total) && ($total < 18*$this->totalPondere) ){
            return 'Très Bien';
        }elseif( 18*$this->totalPondere <= $total ){
            return 'Excellent';
        }else{
            return '';
        }
    }

    /**
     * Principe : sur excel les colonnes sont identifiées par des lettre : A,B,...,AA,AB,...BA,...ZZ,...
     * Pour avoir le bon nom en fonction du numero de la colonne on fera : 
     * une division ecludienne par 26, Puis on utilisera le quotient et le reste.
     * Exemple : 30 = 26*1 + 4.
     * 1 => la lettre A
     * 4 => la lettre D
     * Donc la 30 ieme colonne a comme index : AD
    */
    private function getColumnName($indexColonne) : string
    {
        //On ne travail que avec les nombres positifs
        if( $indexColonne > 0 ){
            //division ecludienne
            $quotient = floor($indexColonne/26);
            $reste = $indexColonne - 26*$quotient;
            //Le index du tableau commencent a 0
            if( $quotient > 0 ){
                return $this->alphabet[$quotient - 1].$this->alphabet[$reste - 1];
            }else{
                return $this->alphabet[$reste - 1];
            }
        }
    }
}