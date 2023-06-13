<?php

namespace App\Listeners;

use App\Events\ObsoleteEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Programme;

class ObsoleteListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ObsoleteEvent  $event
     * @return void
     */
    public function handle(ObsoleteEvent $event)
    {
        //Récupération des cours publiés obsolète
        $publicCours = Programme::where('public', 'true')
        ->where('type_programme', '1')
        ->where('dateFin', '<', today())
        ->update(['public' => 'false']);   

        //Récupération des examens publiés obsolète
        $publicExamen = Programme::where('public', 'true')
        ->where('type_programme', '2')
        ->where('dateDebut', '<', today())
        ->update(['public' => 'false']);          
    }
}
