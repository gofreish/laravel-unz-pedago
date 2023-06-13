<?php

namespace App\Exports;

use App\Models\Logs;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LogsExport implements FromCollection, WithTitle, withHeadings, withMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Logs::all();
    }

    public function map($logs): array{
        return [
            $logs->id,
            $logs->user_id,
            $logs->logs_target_id,
            $logs->logs_target_type,
            $logs->description,
            $logs->created_at,
            $logs->updated_at
        ];
    }

    /**
     * @return String
    */
    public function headings(): array{
        return [
            'Id',
            'Id Auteur',
            'Id Objet',
            'Type Objet',
            'Description',
            'Crée le',
            'Modifier le'
        ];
    }

    /**
     * @return String
    */
    public function title():string {
        return "Logs jusqu'au ".today()->toDateString();
    }
}
