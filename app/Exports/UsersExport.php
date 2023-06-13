<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Titre;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class UsersExport implements FromQuery, WithTitle, WithHeadings, WithMapping
{

    protected $type;

    public function __construct($type){
        $this->type = $type;
    }

    //Definition du contenu de chaque ligne
    public function map($user): array {
        return[
            (Titre::find($user->titre_id))->titre,
            $user->name,
            $user->prenom,
            $user->telephone,
            $user->email,
        ];
    }

    public function headings(): array{
        return [
            [
                "Tous les ".$this->type
            ],
            [
                "titre",
                "nom",
                "prenom",
                "telephone",
                "email"
            ]
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function query(){
        return User::filtreEnseignant($this->type);
    }

    /**
     * @return string
    */
    public function title(): string {
        return "Tous les ".$this->type;
    }

}
