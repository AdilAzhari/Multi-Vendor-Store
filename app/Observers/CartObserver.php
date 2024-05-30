<?php

namespace App\Observers;

use App\Models\cart;
use Illuminate\Support\Str;
class CartObserver
{
    /**
     * Handle the cart "created" event.
     */
    public function created(cart $cart): void
    {
        //
    }

    public function creating(cart $cart){
        $cart->id = (string) Str::uuid();
    }
    /**
     * Handle the cart "updated" event.
     */
    public function updated(cart $cart): void
    {
        //
    }

    /**
     * Handle the cart "deleted" event.
     */
    public function deleted(cart $cart): void
    {
        //
    }

    /**
     * Handle the cart "restored" event.
     */
    public function restored(cart $cart): void
    {
        //
    }

    /**
     * Handle the cart "force deleted" event.
     */
    public function forceDeleted(cart $cart): void
    {
        //
    }
}
