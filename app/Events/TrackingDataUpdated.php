<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TrackingDataUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $trackingData;

    /**
     * Create a new event instance.
     */
    public function __construct($trackingData)
    {
        $this->trackingData = $trackingData;
    }

    /**
     * Get the channel the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('tracking-data');
    }
}
