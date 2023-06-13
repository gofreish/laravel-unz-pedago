<?php

namespace App\Exports\Copies;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use App\Models\Salle;
use App\Models\Batiment;

class GroupesExport implements FromArray, WithHeadings, WithMapping, ShouldAutoSize,
WithEvents, WithTitle
{
    use RegistersEventListeners;

    private $numero;

    private $groupe;
    /**
     * @param array
     * [
     *  'nom'
     *  'batiment'
     *  'salle'
     *  'inscrits'
     *  'absent'
     *  'copies'
     *  'obs'
     *  'survs' => [
     *      'nom'
     *      'prenom'
     *      'signature'
     *  ]
     * ] 
    */
    public function __construct( $numero, $groupe ){
        $this->numero = $numero;
        $this->groupe = $groupe;
    }

    public function title():string
    {
        return "Groupe ".$this->numero;
    }

    /**
    * @return array
    */
    public function array(): array
    {
        return $this->groupe['survs'];
    }

    public function headings():array 
    {
        $entete = array(
            array("Groupe ".$this->numero),
            array("Batiment", "Salle", "Inscrits", "Absent", "Copies")
        );

        //Si on a pas les infos de la salle
        if( empty( $this->groupe['salle'] ) ){
            array_push($entete, array("Non Assigné", "Non Assigné", $this->groupe['inscrits'], $this->groupe['absent'], $this->groupe['copies']));
        }else{
            array_push($entete, array($this->groupe['batiment'], $this->groupe['salle'], $this->groupe['inscrits'], $this->groupe['absent'], $this->groupe['copies']));
        }

        array_push($entete, array("Observations"));
        array_push($entete, array($this->groupe['obs']));
        array_push($entete, array());
        array_push($entete, array());
        array_push($entete, array());
        array_push($entete, array());
        array_push($entete, array());
        array_push($entete, array());
        array_push($entete, array());
        array_push($entete, array());
        array_push($entete, array());
        array_push($entete, array("Liste des surveillants"));
        array_push($entete, array("cnib", "nom", "prenom", "signature"));
        return $entete;
    }

    public function map($surveillant): array
    {
        $wasPresent = " ";
        if( $surveillant['signature'] ){
            $wasPresent = "present";
        }
        return [
            $surveillant['cnib'],
            $surveillant['nom'],
            $surveillant['prenom'],
            $wasPresent
        ];
    }

    public static function afterSheet(AfterSheet $event)
    {
        //
        
        $event->sheet->mergeCells('A1:E1');
        $event->sheet->getStyle('A1:E1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 23, 
                'underline' => \PhpOffice\PhpSpreadsheet\Style\Font::UNDERLINE_SINGLE
            ],
            'alignment' => [ 
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
            ]
        ]);
        $event->sheet->getStyle('A2')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 14, 
            ],
            'alignment' => [ 
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
            ]
        ]);
        $event->sheet->getStyle('A2:A3')->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                    'color' => ['argb' => '000000']
                ]
            ],
        ]);

        $event->sheet->getStyle('B2')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 14, 
            ],
            'alignment' => [ 
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
            ]
        ]);
        $event->sheet->getStyle('B2:B3')->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                    'color' => ['argb' => '000000']
                ]
            ],
        ]);

        $event->sheet->getStyle('C2')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 14, 
            ],
            'alignment' => [ 
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
            ]
        ]);
        $event->sheet->getStyle('C2:C3')->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                    'color' => ['argb' => '000000']
                ]
            ],
        ]);

        $event->sheet->getStyle('D2')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 14, 
            ],
            'alignment' => [ 
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
            ]
        ]);
        $event->sheet->getStyle('D2:D3')->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                    'color' => ['argb' => '000000']
                ]
            ],
        ]);

        $event->sheet->getStyle('E2')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 14, 
            ],
            'alignment' => [ 
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
            ]
        ]);
        $event->sheet->getStyle('E2:E3')->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                    'color' => ['argb' => '000000']
                ]
            ],
        ]);

        $event->sheet->mergeCells('A4:J4');
        $event->sheet->getStyle('A4:J4')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 14
            ],
            'alignment' => [ 
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                    'color' => ['argb' => '000000']
                ]
            ]
        ]);

        $event->sheet->mergeCells('A5:J14');
        $event->sheet->getStyle('A5:J14')->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                    'color' => ['argb' => '000000']
                ]
            ],
        ]);

        $event->sheet->mergeCells('A15:C15');
        $event->sheet->getStyle('A15:C15')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 18
            ],
            'alignment' => [ 
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
            ]
        ]);
    }
}
