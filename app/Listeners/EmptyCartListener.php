<?php

namespace App\Listeners;

use App\Events\OrderEvent;
use App\Models\Order;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class EmptyCartListener
{
    /**
     * Handle the event.
     */
    public function handle(OrderEvent $event): void
    {

        dd($event);
    }
}
