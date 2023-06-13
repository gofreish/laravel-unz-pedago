<?php

namespace App\Exports\toSave;

use App\Models\Filiere;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class FiliereExport implements FromCollection, WithTitle, withHeadings, withMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Filiere::all();
    }

    /**
     * @return array
    */
    public function map($filiere): array {
        return [
            $filiere->id,
            $filiere->name,
            $filiere->u_f_r_id,
            UFR::find()->name,
            $filiere->created_at,
            $filiere->updated_at
        ];
    }

    /**
     * @return array
    */
    public function headings():array {
        return [
            'Identifiant',
            'Nom',
            'Identifiant UFR',
            'Nom UFR',
            'Créée le',
            'Modifier le'
        ];
    }

    /**
     * @return string
    */
    public function title(): string {
        return 'Les Filières';
    }
}
