<?php

namespace App\Events;

use App\Http\Resources\WatcherResource;
use App\Models\Watcher;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PriceChanged implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $watcher;

    /**
     * Create a new event instance.
     *
     * @param WatcherResource $watcher
     */
    public function __construct(WatcherResource $watcher)
    {
        $this->watcher = $watcher;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('watchers.' . $this->watcher->id);
    }

    public function broadcastAs()
    {
        return 'price-changed';
    }
}
