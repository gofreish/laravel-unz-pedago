<?php
/*
    Cet controlleur Permet d'automatiser la sélection de l'UE

    Utilisation:
        
        <!-- UE -->
        <div class="form-group row">
            <label class="col-md-3 col-form-label" for="ue">UE</label>
            <div class="col-md-9">
            @if( isset($ue) )
                <input type="hidden" name="ue" value="{{$ue->id}}">
                <h1><span class="badge bg-success">{{$ue->nom}}</span></h1>
            @else
                <x-SelectUE destinataire="unz_st.formulaires.ecu"/>
            @endif
            </div>
        </div>

*/
namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Http\Request;

class SelectUE extends Component
{

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Request $request, $destinataire )
    {
        //
        $request->session()->put('destinataire', $destinataire);
        //dd($request->session()->all()['destinataire']);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.select-u-e');
    }
}
