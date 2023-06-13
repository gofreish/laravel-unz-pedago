<?php

namespace App\Listeners;

use App\Events\DeliberationEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Deliberation\Deliberation;

class DeliberationListener
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
     * @param  DeliberationEvent  $event
     * @return void
     */
    public function handle(DeliberationEvent $event)
    {
        //
        $delib = new Deliberation($event->promotion_id, $event->semestre_id, $event->cycle_id, $event->session_name);
        //Si tout est bon on dispatch un event pour dire au coordonateur que les relevés sont prêts
    }
}
