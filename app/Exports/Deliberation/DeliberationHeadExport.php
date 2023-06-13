<?php

namespace App\Exports\Deliberation;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

use App\Models\Filiere;
use App\Models\Cycle;
use App\Models\Semestre;
use App\Models\UE;
use App\Models\ECU;

use Maatwebsite\Excel\Concerns\FromCollection;

class DeliberationHeadExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{

    private $filiere;
    private $cycle;
    private $semestre;
    private $Head = array('INE');

    public function __construct($filiere_id ,$cycle_id ,$semestre_id){
        $this->filiere = Filiere::find($filiere_id);
        $this->cycle = Cycle::find($cycle_id);
        $this->semestre = Semestre::find($semestre_id);
        $ues_id = UE::where('filiere_id', $filiere_id)->where('cycle_id', $cycle_id)->where('semestre_id', $semestre_id)->orderBy('nom')->pluck('id');
        foreach ($ues_id as $key => $ue_id) {
            $ecus = ECU::where('u_e_id', $ue_id)->orderBy('nom')->get();
            foreach ($ecus as $key_ecu => $ecu) {
                array_push($this->Head, $ecu->nom);
            }
        }
    }

    public function headings(): array
    {
        return 
            [
                ['PROCÈS VERBAL DE DÉLIBÉRATION', $this->filiere->name, 'Cycle '.$this->cycle->cycle.' '.$this->semestre->intitule],
                $this->Head
            ];
    }

    public function styles(Worksheet $sheet){
        $styleArray = [
            'font' => ['bold' => true, 'size' => 16],
            'alignment' => [ 
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ]
            ];
        return [
            1 => $styleArray,
            2 => $styleArray,
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect();
    }
}
