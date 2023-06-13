<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use App\Models\Salle;
use App\Models\Batiment;
use App\Models\Etudiant;

class studentGroupExport implements FromCollection, WithHeadings, WithMapping, WithTitle, ShouldAutoSize, WithStyles
{

    private array $groupe;
    private $salle;
    private $batiment;

    public function __construct( $groupe ){
        $this->groupe = $groupe;
        $this->salle = Salle::find($groupe['salle']['id']);
        $this->batiment = Batiment::find($this->salle->batiment_id);
    }

    public function styles(Worksheet $sheet){
        $titre = [
            'font' => ['bold' => true, 'size' => 16],
            'alignment' => [ 
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ]
        ];
        $element = [
            'font' => ['size' => 16],
            'alignment' => [ 
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ]
            ];
        return [
            'A1' => $titre,
            'A2' => $titre,
            'B2' => $element,
            'C2' => $titre,
            'D2' => $element,
            'A3' => $titre,
            4 => $titre,
        ];
    }

    public function headings(): array
    {
        $salleInfos = ['Bâtiment:', $this->batiment->name, 'Salle:', $this->salle->nom];
        $globlaHead = [
            ['Groupe '.$this->groupe['numero']],
            $salleInfos,
            ['Surveillants'],
            ['CNIB', 'Nom', 'Prénom'],
        ];
        foreach ($this->groupe['surv'] as $key => $surv) {
            array_push( $globlaHead, [ $surv['cnib'], $surv['nom'], $surv['prenom'] ] );
        }
        array_push($globlaHead, ['Étudiants']);
        array_push($globlaHead, ['']);
        array_push($globlaHead, ['INE','Genre','Nom','Prenom','Date de naissance','signature','note'] );
        return $globlaHead;
    }

    public function map($etudiant): array 
    {
        return [
            $etudiant->ine,
            $etudiant->genre,
            $etudiant->nom,
            $etudiant->prenom,
            $etudiant->nee_le,
            "",
            ""
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Groupe '.$this->groupe['numero'];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Etudiant::whereIn('ine', $this->groupe['student'])->get();
    }
}
