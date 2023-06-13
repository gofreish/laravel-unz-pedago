<?php

/*
    Cet controlleur Permet d'automatiser la sélection de l'ECU

    Utilisation:

        <!-- ECU -->
        <div class="form-group row">
            <label class="col-md-3 col-form-label" for="ECU">ECU</label>
            <div class="col-md-9">
                @if( isset($ecus) )
                    <select class="form-control" id="ECU" name="ecu">
                        @forelse($ecus as $ecu)
                            <option value="{{$ecu->id}}">{{$ecu->nom}}</option>
                        @empty
                            <option value="">Pas d'ECU enregistrée</option>
                        @endforelse
                    </select>
                @else
                    <x-SelectECU destinataire="unz_st.formulaires.programme" />
                @endif
            </div>
        </div>
*/

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Http\Request;


class SelectECU extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Request $request, $destinataire )
    {
        $request->session()->put('destinataire_ecu', $destinataire);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.select-e-c-u');
    }
}
