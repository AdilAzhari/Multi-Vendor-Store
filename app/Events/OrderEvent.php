<?php

namespace App\Events;

use App\Listeners\DeductProductQuantityListener;
use App\Listeners\EmptyCartListener;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Event;

class OrderEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    /**
     * Create a new event instance.
     */
    protected $listen = [
        // OrderEvent::class => [
        DeductProductQuantityListener::class,
        EmptyCartListener::class,
        // ],
    ];
    public function __construct()
    {
        // $this->orderId = $orderId;
    }

}
