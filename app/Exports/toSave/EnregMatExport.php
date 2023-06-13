<?php

namespace App\Exports\toSave;

use App\Models\EnregMat;
use App\Models\TypeEnreg;
use App\Models\Materiel;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class EnregMatExport implements FromCollection, WithTitle, withHeadings, withMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return EnregMat::all();
    }

    /**
     * @return array
    */
    public function map($enregMat): array {
        $user = User::find($enregMat->user_id);
        $chaine = $user->prenom.' '.$user->name;
        return [
            $enregMat->id,
            $enregMat->date,
            $enregMat->quantite,
            $enregMat->quantite_avant_enreg,
            $enregMat->achever,
            $enregMat->type_enreg_id,
            TypeEnreg::find($enregMat->type_enreg_id)->type,
            $enregMat->materiel_id,
            Materiel::find($enregMat->materiel_id)->name,
            $enregMat->user_id,
            $chaine,
            $enregMat->created_at,
            $enregMat->updated_at
        ];
    }

    /**
     * @return array
    */
    public function headings():array {
        return [
            'Identifiant',
            'Date',
            'Quantité',
            'Ancienne Quantité',
            'Est ce Achevé',
            'Identifiant du type d\'enregistrement',
            'Type d\'enregistrement',
            'Identifiant du materiel',
            'Nom du materiel',
            'Identifiant du concerné',
            'Nom du concerné',
            'Créée le',
            'Modifier le'
        ];
    }

    /**
     * @return string
    */
    public function title(): string {
        return 'Le cahier de suivit du materiel';
    }

}
