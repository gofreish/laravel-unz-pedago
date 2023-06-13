<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DeliberationEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $promotion_id;
    public $semestre_id;
    public $cycle_id;
    public $session_name;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct( $promotion_id, $semestre_id, $cycle_id, $session_name )
    {
        $this->promotion_id = $promotion_id;
        $this->semestre_id = $semestre_id;
        $this->cycle_id = $cycle_id;
        $this->session_name = $session_name;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
