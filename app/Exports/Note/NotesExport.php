<?php

namespace App\Exports\Note;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use App\Models\Copie;
use App\Models\StudentGroup;
use App\Models\Programme;
use App\Models\Promotion;
use App\Models\Filiere;
use App\Models\ECU;
use App\Models\UE;
use App\Models\Cycle;
use App\Models\Semestre;
use App\Models\Etudiant;
use App\Models\TestMark;

class NotesExport implements FromArray, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    private $copie;
    private $groupes;
    private $filiere;
    private $promotion;
    private $cycle;
    private $semestre;
    private $ecu;

    public function __construct( $copie_id ) {
        $this->copie = Copie::find($copie_id);
        $this->groupes = StudentGroup::where('copie_id', $copie_id)->get();
        $prog = Programme::find($this->copie->programme_id);
        $this->promotion = Promotion::find($prog->promotion_id);
        $this->filiere = Filiere::find($this->promotion->filiere_id);
        $this->ecu = ECU::find($prog->e_c_u_id);
        $ue = UE::find($this->ecu->u_e_id);
        $this->cycle = Cycle::find($ue->cycle_id);
        $this->semestre = Semestre::find($ue->semestre_id);
    }

    public function headings(): array
    {
        $globalHead = [
            ['Université Norbert Zongo'],
            [$this->filiere->name, "P : ".$this->promotion->annee_entrer],
            ['Cycle : '.$this->cycle->cycle, $this->semestre->intitule],
            ['Module ', $this->ecu->nom],
            ['INE', 'Nom', 'Prénom', 'Note']
        ];

        return $globalHead;
    }

    public function map($note): array 
    {
        return [
            $note['ine'],
            $note['nom'],
            $note['prenom'],
            $note['note']
        ];
    }

    public function styles(Worksheet $sheet){
        return [
            '1:5' => [
                'font' => ['bold' => true, 'size' => 16],
                'alignment' => [ 
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ]
            ]
        ];
    }

    private function getStudents(){
        $allStudents = [];
        foreach ($this->groupes as $key => $groupe) {
            $groupeStudents = [];
            $studentsArray = explode(';', $groupe->students);
            foreach ($studentsArray as $cle => $studentINE) {
                $etudiant = Etudiant::find($studentINE);
                $noteEtudiant = TestMark::where('etudiant_ine', $studentINE)
                ->where('e_c_u_id', $this->ecu->id)
                ->where('is_normal', $this->copie->is_normal)
                ->first();
                $note = is_null($noteEtudiant) ? 0 : $noteEtudiant->note;
                $student = [
                    'ine'=>$studentINE, 
                    'nom'=>$etudiant->nom, 
                    'prenom'=>$etudiant->prenom,
                    'note'=>$note
                ];
                array_push($groupeStudents, $student);
            }
            $allStudents = array_merge($allStudents, $groupeStudents);
        }
        return $allStudents;
    }

    public function array(): array
    {
        return $this->getStudents();
    }
}
