<?php

namespace App\Exports\Evaluation;

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

    private $groupe;
    /**
     * @param array
     * [
     *  'numero' => num,
     *  'taille' => taille,
     *  'salle' => [
     *              'id' => 5,
     *              'nom' => nom
     *              ],
     *  'surveillants' => [
     *              0 => [
     *                  'cnib' => cnib,
     *                  'nom' => nom,
     *                  'prenom' => prenom
     *                  ]             
     *              ]
     * ] 
    */
    public function __construct( $groupe ){
        $this->groupe = $groupe;
    }

    public function title():string
    {
        return "Groupe ".$this->groupe['numero'];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function array(): array
    {
        return $this->groupe['surveillants'];
    }

    public function headings():array 
    {
        $entete = array(
            array("Groupe ".$this->groupe['numero']),
            array("Batiment", "Salle", "Inscrits", "Absent", "Copies")
        );

        //Si on a les infos de la salle
        if( empty( $this->groupe['salle'] ) ){
            array_push($entete, array("Non Assigné", "Non Assigné", $this->groupe['taille']));
        }else{
            $salle = Salle::find($this->groupe['salle']['id']);
            $batiment = Batiment::find($salle->batiment_id);
            array_push($entete, array($batiment->name, $salle->nom, $this->groupe['taille']));
        }

        array_push($entete, array("Observations"));
        array_push($entete, array(""));
        array_push($entete, array(""));
        array_push($entete, array(""));
        array_push($entete, array(""));
        array_push($entete, array(""));
        array_push($entete, array(""));
        array_push($entete, array(""));
        array_push($entete, array(""));
        array_push($entete, array(""));
        array_push($entete, array(""));
        array_push($entete, array("Liste des surveillants"));
        array_push($entete, array("cnib", "nom", "prenom", "signature"));
        return $entete;
    }

    public function map($surveillant): array
    {
        return [
            $surveillant['cnib'],
            $surveillant['nom'],
            $surveillant['prenom']
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
