<?php

namespace App\Exports\toSave;

use App\Models\ECU;
use App\Models\UE;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class ECUExport implements FromCollection, WithTitle, withHeadings, withMapping{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ECU::all();
    }
    
    /**
     * @return array
    */
    public function map($ecu): array {
        return [
            $ecu->id,
            $ecu->code,
            $ecu->nom,
            $ecu->coefficient,
            $ecu->u_e_id,
            UE::find($ecu->u_e_id)->nom,
            $ecu->created_at,
            $ecu->updated_at
        ];
    }

    /**
     * @return array
    */
    public function headings(): array {
        return [
            'Identifiant',
            'Code',
            'Nom',
            'Coefficient',
            'Identifiant UE',
            'Nom UE',
            'Créée le',
            'Modifier le'
        ];
    }

    /**
     * @return string
    */
    public function title(): string {
        return 'Les ECU';
    }

}
