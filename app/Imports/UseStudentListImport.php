<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use App\Models\Etudiant;
use App\Exports\studentAllGroupExport;
use Maatwebsite\Excel\Facades\Excel;

class UseStudentListImport implements ToCollection, WithHeadingRow, ShouldAutoSize
{
    private $nombre=0;
    private $groupSize=0;
    private $filiereName;
    private $cycleName;
    private $semestreName;
    private $ecuName;
    private $date;
    private array $students = array();
    private $path;
    
    public function __construct($groupSize, $filiereName, $cycleName, $semestreName, $ecuName, $date){
        $this->groupSize = $groupSize;
        $this->filiereName = $filiereName;
        $this->cycleName = $cycleName;
        $this->semestreName = $semestreName;
        $this->ecuName = $ecuName;
        $this->date = $date;
    }

    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $key => $row) {
            array_push($this->students, Etudiant::make([
                    'ine' => $row['ine'],
                    'genre' => $row['genre'],
                    'nom' => $row['nom'],
                    'prenom' => $row['prenom'],
                    'nee_le' => $row['date_de_naissance'],
                ])
            );
            $this->nombre++;
        }
        $this->path = 'root/exports/evaluation/'.
                        $this->filiereName.'/'.
                        $this->cycleName.'/'.
                        $this->semestreName.'/'.
                        $this->ecuName.'/'.
                        $this->date.'/groupes.xlsx';
        Excel::store(new studentAllGroupExport($this->students, $this->groupSize), $this->path);
    }

    public function getPath(){return $this->path;}

    public function getNombreStudents(){
        return $this->nombre;
    }

    public function downloadGroupsList(){
        $groupsListClass = new studentAllGroupExport($this->students, $this->groupSize);
        $groupsListClass->download();
    }
}
