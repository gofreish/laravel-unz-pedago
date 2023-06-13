<?php

namespace App\Http\Livewire\Scolarite;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\ECU;
use App\Models\UE;
use App\Models\Filiere;
use App\Models\Cycle;
use App\Models\Semestre;
use App\Models\StudentGroup;
use App\Models\Copie;
use App\Models\Programme;
use App\Models\TypeProgramme;
use App\Models\Promotion;
use App\Imports\Note\NotesImport;
use App\Exports\ListeDePresenceExport;
use App\Exports\Note\NotesExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Deliberation\Deliberation;
use App\Events\DeliberationEvent;

class ReleveNotesIndex extends Component
{
    use WithFileUploads;

    public $areRecup = "false";
    public $areReturn = "false";
    public $hasNote = false;
    public $copies;
    public $notes;
    public $idCopie;
    public $uploadSuccessMsg = null;
    public $uploadErrorMsg = null;

    public function mount(){
        $this->copies = collect();
    }

    public function updatedHasNote( $hasNote ){
        if( $this->hasNote ){
            $this->copies_recup = "true";
        }
    }

    public function updatedAreReturn( $isReturn ){
        if( $isReturn == 'true' ){
            $this->areRecup = 'true';
        }
    }

    public function updatedAreRecup( $isRecup ){
        if( $isRecup == 'false' ){
            $this->areReturn = 'false';
            $this->hasNote = false;
        }
    }

    public function showNotes(){
        $informations = DB::table("programmes")
        ->where("programmes.enseignant_id", auth()->user()->id)
        ->join("copies", "copies.programme_id", "programmes.id");

        //
        if( $this->hasNote ){
            $informations = $informations->where('copies.has_note', true);
        }

        if( $this->areReturn == "true" ){
            $informations = $informations->whereNotNull('copies.date_retour');
        }else{
            $informations = $informations->whereNull('copies.date_retour');
        }

        if( $this->areRecup == "true" ){
            $informations = $informations->whereNotNull('copies.date_sortie');
        }else{
            $informations = $informations->whereNull('copies.date_sortie');
        }

        $informations = $informations
            ->join("e_c_u_s", "e_c_u_s.id", "programmes.e_c_u_id")
            ->orderBy('programmes.dateDebut', 'desc')
            ->select(
                "programmes.dateDebut as date",
                "e_c_u_s.nom as nomECU",
                "copies.id as copie_id",
                "copies.is_normal as is_normal",
                "copies.date_sortie as date_sortie",
                "copies.date_retour as date_retour",
                "copies.has_note as has_note"
            )
            ->get();
        $this->copies = [];
        foreach ($informations as $key => $info) {
            $nbrCopies = StudentGroup::selectRaw('sum(nbr_copie) as nbr_copie')
                            ->groupBy('copie_id')
                            ->having('copie_id', '=', $info->copie_id)
                            ->pluck('nbr_copie')
                            ->first();
            $copie = (array)$info;
            $copie['nbr_copie'] = $nbrCopies;
            array_push($this->copies, $copie);
        }
    }

    public function downloadReleve( $copie_id ){
        $copie = Copie::find($copie_id);
        $prog = Programme::find($copie->programme_id);
        $promotion = Promotion::find($prog->promotion_id);
        $ecu = ECU::find($prog->e_c_u_id);
        $fileName = "Liste de presence ".$ecu->nom." P:".$promotion->annee_entrer.".xlsx";
        return Excel::download(new ListeDePresenceExport($copie_id), $fileName);
    }

    public function downloadOldReleve($copie_id){
        $copie = Copie::find($copie_id);
        $prog = Programme::find($copie->programme_id);
        $promotion = Promotion::find($prog->promotion_id);
        $ecu = ECU::find($prog->e_c_u_id);
        $fileName = "Relevé de note ".$ecu->nom." P:".$promotion->annee_entrer.".xlsx";
        return Excel::download(new NotesExport($copie_id), $fileName);
    }

    public function uploadNotes( $idCopie ){
        $this->reset('uploadSuccessMsg');
        $this->reset('uploadErrorMsg');
        $this->validate([
            'notes' => 'required|file|mimes:xlsx',
        ]);

        $copie = Copie::find($idCopie);
        $import = new NotesImport($idCopie);
        Excel::import($import, $this->notes);
        if( $import->isSuccess ){
            $copie->has_note = true;
            $copie->save();
            $this->uploadSuccessMsg = $import->message;
            $this->showNotes();
        }else{
            $this->uploadErrorMsg = $import->message;
        }
        

        //event( new DeliberationEvent($program->promotion_id, $program->semestre_id, $program->cycle_id, $program->session) );
    }

    private function canDeliberate($idCopie){
        //Vérification si une délibération est calculable
        $copie = Copie::find($idCopie);
        $prog = Programme::find($copie->programme_id);
        $ecu = ECU::find($prog->e_c_u_id);
        $ue = UE::find($ecu->u_e_id);
       
        $allECU = DB::table("u_e_s")
        ->where('u_e_s.filiere_id', $ue->filiere_id)
        ->where('u_e_s.cycle_id', $ue->cycle_id)
        ->where('u_e_s.semestre_id', $ue->semestre_id)
        ->join('e_c_u_s', 'e_c_u_s.u_e_id', 'u_e_s.id')
        ->select(
            'e_c_u_s.id as ecu_id'
        )
        ->get();
        $examen_type_id = TypeProgramme::where('type', 'EXAMEN')->first()->id;
        //On cherche si un evaluation a deja ete programmée
        foreach ($allECU as $key => $ecu) {
            $exam_prog = DB::table('programmes')
            ->where('programmes.e_c_u_id', $ecu->ecu_id)
            ->where('programmes.type_programme_id', $examen_type_id)
            ->where('programmes.promotion_id', $prog->promotion_id)
            ->join('copies', 'copies.programme_id', 'programmes.id')
            ->where('copies.has_note', true)
            ->get();
            //Si la requete ne donne rien alors on arrete tous
            if( $exam_prog->isEmpty() ){
                return false;
            }
        }
        //Si toute les ecu on des notes alors on peut deliberer
        return true;
    }


    //####### OLD

    public function downloadReleveOLD( $id ){
        $copie = $this->copies[$id];
        $ecu = ECU::find($copie['idECU']);
        $ue = UE::find( $ecu->u_e_id );
        $filiere = Filiere::find($ue->filiere_id)->name;
        $cycle = Cycle::find($ue->cycle_id)->cycle;
        $semestre = Semestre::find($ue->semestre_id)->intitule;
        $nomECU = $ecu->nom;
        $path = 'root/exports/evaluation/'.
            $filiere.'/'.
            $cycle.'/'.
            $semestre.'/'.
            $nomECU.'/'.
            $copie['date'].'/groupes.xlsx';
        if( Storage::disk('local')->exists( $path ) ){
            $cop = Copie::find($copie['idCopie']);
            $cop->releve = "downlaod";
            $cop->save();
            return Storage::disk('local')->download($path, "Relevé:".$filiere.' | '.$nomECU.'('.$copie['nombre'].")copies.xlsx");
        }
    }
    
    public function render()
    {
        return view('livewire.scolarite.releve-notes-index');
    }
}
