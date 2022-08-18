<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PriceChangedPrivate implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $text;
    public $user;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user, $text)
    {
        $this->user = $user;
        $this->text = $text;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('watchers.'.$this->user->id);
    }

    public function broadcastAs()
    {
        return 'price-changed';
    }
}
