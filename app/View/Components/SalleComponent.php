<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Http\Request;

class SalleComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Request $request, $destinataire)
    {
        //
        $request->session()->put('destinataire_salle', $destinataire);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.salle-component');
    }
}
