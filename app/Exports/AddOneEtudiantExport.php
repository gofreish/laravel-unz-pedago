<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Facades\Excel;

class AddOneEtudiantExport implements FromArray, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    private $studentsList;
    private $storePath;

    public function __construct( $studentsList, $storePath ){
        $this->studentsList = $studentsList;
        $this->storePath = $storePath;
    }

    public function headings(): array
    {
        return [
            'INE',
            'Genre',
            'Nom',
            'Prenom',
            'Date de naissance',
        ];
    }

    public function map($etudiant): array 
    {
        return [
            $etudiant['ine'],
            $etudiant['genre'],
            $etudiant['nom'],
            $etudiant['prenom'],
            $etudiant['nee_le'],
        ];
    }

    public function styles(Worksheet $sheet){
        return [
            1 => [
                'font' => ['bold' => true, 'size' => 16],
                'alignment' => [ 
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ]
            ]
        ];
    }

    /**
    * @return array
    */
    public function array(): array
    {
        return $this->studentsList;
    }

    /**
     * To download file
    */
    public function store(){
        return Excel::store($this, $this->storePath);
    }
}
