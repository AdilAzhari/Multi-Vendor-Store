<?php

namespace App\Listeners;

use App\Events\OrderEvent;
use App\Facades\Cart as FacadesCart;
use App\Models\cart;

class EmptyCartListener
{

    /**
     * Handle the event.
     */
    public function handle(OrderEvent $event): void
    {
        // FacadesCart::empty();
    }
}
