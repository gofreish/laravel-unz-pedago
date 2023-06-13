<?php

namespace App\Exports\toSave;

use App\Models\Batiment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class BatimentExport implements FromQuery, WithTitle, withHeadings, withMapping
{

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Batiment::all();
    }

    /**
     * @return array
    */
    public function map($batiment): array{
        return [
            $batiment->id,
            $batiment->name,
            $batiment->image,
            $batiment->created_at,
            $batiment->updated_at
        ];
    }

    /**
     * @return array
    */
    public function headings(): array{
        return [
            'Identifiant',
            'Nom',
            'Chemin image',
            'Créée le',
            'Modifier le'
        ];
    }

    /**
     * @return string
    */
    public function title():string {
        return 'Les Bâtiment';
    }
}
