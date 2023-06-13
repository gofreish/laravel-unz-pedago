<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Occuper;
use App\Rules\RequireIfNotExam;
use App\Rules\RequireIfNotAutre;
use App\Rules\ProgrammeRule;
use Illuminate\Http\Request;

class ProgrammeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {//, new Occuper(Request::input('type'),Request::input('date_debut'),Request::input('heure_debut_matin'), Request::input('salle')) Request::input('type') || 'required_unless:type,AUTRE'
        return [
            'ecu' => [new RequireIfNotAutre(Request::input('type'))],
            'promotion' => [new RequireIfNotAutre(Request::input('type'))],
            'enseignant' => [new RequireIfNotAutre(Request::input('type'))],
            'date_debut' => ['required'],
            'date_fin' => [new RequireIfNotExam(Request::input('type'))],
            'heure_debut_matin' => [],
            'heure_fin_matin' => ['required_with:heure_debut_matin'],
            'heure_debut_soir' => [],
            'heure_fin_soir' => ['required_with:heure_debut_soir'],
            'salle' => [new RequireIfNotExam(Request::input('type'))],
            'commentaire' => ["required_if:type,AUTRE"],
            'type' => [
                'required', 
                new Occuper(
                    Request::input('date_debut'),
                    Request::input('heure_debut_matin'),
                    Request::input('heure_debut_soir'),
                    Request::input('salle')
                )]
        ];
    }
}
