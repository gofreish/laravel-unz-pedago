<?php

namespace App\Exports\Evaluation;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class HeadGroupesExport implements FromCollection, WithHeadings, ShouldAutoSize, 
WithDrawings, WithEvents, WithTitle
{
    use RegistersEventListeners;

    private $informations;

    /**
     * @param array 
     * 'programmes.id as id',
     * 'programmes.dateDebut as date',
     * 'e_c_u_s.nom as nomECU',
     * 'filieres.name as filiere',
     * 'cycles.cycle as cycle',
     * 'semestres.intitule as semestre',
     * 'promotions.annee_entrer as promotion'
    */
    public function __construct( $infos ){
        $this->informations = $infos;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
        return collect();
    }

    public function title(): string
    {
        return "Page de garde";
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('Logo de UNZ');
        $drawing->setPath(public_path('/assets/img/logo_unz.jpg'));
        $drawing->setHeight(200);
        $drawing->setWidth(200);
        $drawing->setCoordinates('A1');

        return $drawing;
    }
    
    public function headings(): array
    {  
        $entete = array(
            array(""),
            array(""),
            array(""),
            array(""),
            array(""),
            array(""),
            array(""),
            array(""),
            array(""),
            array("Université Norbert Zongo"),
            array("Unité de Formation et de Recherche en Sciences et Technologie (UFR/ST)"),
            //array("en Sciences et Technologie (UFR/ST)"),
            array("Service de la scolarité"),
            array($this->calculAnneAcademique()),
            array($this->informations['filiere']),
            array("Niveau : ".$this->informations['cycle']." ".$this->informations['semestre']),
            array("Module : ".$this->informations['nomECU']),
            array("Date : ".$this->informations['date'])
        );

        return $entete;
    }

    public static function afterSheet(AfterSheet $event)
    {
        //
        $event->sheet->getStyle('A10')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 23, 
                'underline' => \PhpOffice\PhpSpreadsheet\Style\Font::UNDERLINE_SINGLE
            ],
            'alignment' => [ 
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
            ]
        ]);
        $event->sheet->getStyle('A11')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 20, 
                'underline' => \PhpOffice\PhpSpreadsheet\Style\Font::UNDERLINE_SINGLE
            ],
            'alignment' => [ 
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
            ]
        ]);
        $event->sheet->getStyle('A12')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 18
            ],
            'alignment' => [ 
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
            ]
        ]);
        $event->sheet->getStyle('A13')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 14
            ], 
            'alignment' => [ 
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
            ]
        ]);
        $event->sheet->getStyle('A14')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 14
            ], 
            'alignment' => [ 
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
            ]
        ]);
        $event->sheet->getStyle('A15')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 12
            ], 
            'alignment' => [ 
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
            ]
        ]);
        $event->sheet->getStyle('A16')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 12
            ], 
            'alignment' => [ 
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
            ]
        ]);
        $event->sheet->getStyle('A17')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 12
            ], 
            'alignment' => [ 
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
            ]
        ]);
    }

    private function calculAnneAcademique(){
        $debAnneAcad = intval($this->informations['promotion']);
        //Si c est la licence
        if( $this->informations['cycle'] == 'Licence' ){ //Licence
            //On ne change rien pour la premiere anne
            //Pour la deuxième anne ils on une annee écoulée donc on fait + 1
            if( ($this->informations['semestre'] == 'Semestre 3') || ($this->informations['semestre'] == 'Semestre 4') ){
                $debAnneAcad++;
            }
            //Pour la troisieme anne ils on deja deux annees d ecoulées
            elseif( ($this->informations['semestre'] == 'Semestre 5') || ($this->informations['semestre'] == 'Semestre 6') ){
                $debAnneAcad = $debAnneAcad + 2;
            }
        }elseif( $this->informations['cycle'] == 'Master' ){    //Master
            //Pour le master il y a 3 année écoulés
            if( ($this->informations['semestre'] == 'Semestre 1') || ($this->informations['semestre'] == 'Semestre 2') ){
                $debAnneAcad = $debAnneAcad + 3;
            }elseif( ($this->informations['semestre'] == 'Semestre 3') || ($this->informations['semestre'] == 'Semestre 4') ){
                $debAnneAcad = $debAnneAcad + 4;
            }
        }elseif( $this->informations['cycle'] == 'Doctorat' ){  //Doctorat
            //Pour le doctorat il y a 5 année écoulés
            if( ($this->informations['semestre'] == 'Semestre 1') || ($this->informations['semestre'] == 'Semestre 2') ){
                $debAnneAcad = $debAnneAcad + 5;
            }elseif( ($this->informations['semestre'] == 'Semestre 3') || ($this->informations['semestre'] == 'Semestre 4') ){
                $debAnneAcad = $debAnneAcad + 6;
            }
            elseif( ($this->informations['semestre'] == 'Semestre 5') || ($this->informations['semestre'] == 'Semestre 6') ){
                $debAnneAcad = $debAnneAcad + 7;
            }
        }

        return "Année académique : ".$debAnneAcad." - ".($debAnneAcad+1);
    }
}
