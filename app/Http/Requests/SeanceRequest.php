<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\EcuProgrammeSeance;
use Illuminate\Http\Request;



class SeanceRequest extends FormRequest
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
    {
        return [
            'ecu' => ['required'],
            'date' => ['required', new EcuProgrammeSeance(Request::input('date'))],
            'heure_debut' => ['required'],
            'heure_fin' => ['required','after_or_equal:heure_debut'],
            'contenu' => ['required']
        ];
    }
}
