<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use App\Models\Etudiant;
use App\Models\Promotion;
use App\Models\Filiere;
use App\Models\Cycle;
use App\Models\Semestre;
use Maatwebsite\Excel\Facades\Excel;

class EtudiantExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{

    private $promotion;
    private $filiere;
    private $nombre;
    private $cycle;
    private $semestre;

    public function __construct($nombre, $promotion, $filiere, string $cycle, string $semestre){
        $this->nombre = $nombre;
        $this->promotion = $promotion;
        $this->filiere = $filiere;
        $this->cycle = $cycle;
        $this->semestre = $semestre;
    }

    public function headings(): array
    {
        return [
            'INE',
            'Genre',
            'Nom',
            'Prenom',
            'Date de naissance',
            'Filière',
            'Promotion',
            'Cycle',
            'Semestre'
        ];
    }

    public function map($etudiant): array 
    {
        $promotion = Promotion::find($etudiant->promotion_id);
        $filiere = Filiere::find($promotion->filiere_id);
        return [
            $etudiant->ine,
            $etudiant->genre,
            $etudiant->nom,
            $etudiant->prenom,
            $etudiant->nee_le,
            $filiere->name,
            $promotion->annee_entrer,
            (Cycle::find($etudiant->cycle_id))->cycle,
            (Semestre::find($etudiant->semestre_id))->intitule
        ];
    }

    public function styles(Worksheet $sheet){
        return [
            1 => [
                'font' => ['bold' => true, 'size' => 16],
                'alignment' => [ 
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ]
            ]
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Etudiant::factory()->count($this->nombre)->setData($this->promotion, $this->filiere, $this->cycle, $this->semestre)->make();
    }

    /**
     * To download file
    */
    public function download(){
        $niveau = '';
        if( $this->cycle == 'Licence' ){
            $niveau = 'L';
        }elseif( $this->cycle == 'Master' ){
            $niveau = 'M';
        }elseif( $this->cycle == 'Doctorat' ){
            $niveau = 'D';
        }

        if( ($this->semestre == 'Semestre 1') || ($this->semestre == 'Semestre 2') ){
            $niveau = $niveau.'1';
        }elseif( ($this->semestre == 'Semestre 3') || ($this->semestre == 'Semestre 4') ){
            $niveau = $niveau.'2';
        }elseif( ($this->semestre == 'Semestre 5') || ($this->semestre == 'Semestre 6') ){
            $niveau = $niveau.'3';
        }
        $path = 'root/imports/etudiants/'.$this->filiere.'/'.$niveau.'_P'.$this->promotion.'.xls';
        return Excel::store($this, $path);
    }
}
