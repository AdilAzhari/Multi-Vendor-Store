<?php

namespace App\Listeners;

use App\Events\OrderEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DeductProductQuantityListener
{
    public static function listen()
    {
        return [
            OrderEvent::class => [
                self::class,
            ],
        ];
    }
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderEvent $event): void
    {
        info('Deduct Product Quantity');
        dd('Deduct Product Quantity');
    }

}
