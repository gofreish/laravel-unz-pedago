<?php

namespace App\Exports\toSave;

use App\Models\Cycle;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class CycleExport implements FromCollection, WithTitle, withHeadings, withMapping{

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Cycle::all();
    }

    /**
     * @return array
    */
    public function map($cycle): array {
        return [
            $cycle->id,
            $cycle->cycle,
            $cycle->created_at,
            $cycle->updated_at
        ];
    }

    /**
     * @return array
    */
    public function headings(): array {
        return [
            'Identifiant',
            'Cycle',
            'Créée le',
            'Modifier le'
        ];
    }

    /**
     * @return string
    */
    public function title():string {
        return 'Les Cycles';
    }
}
