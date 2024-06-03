<?php

namespace App\Observers;

use App\Models\order;

class OrderObserver
{
    /**
     * Handle the order "created" event.
     */
    public function creating(order $order): void
    {


        // $or = order::pluck('order_number')->split('-')->last();
        // dd($or);
        $order->status = 'pending';
        $order->order_number = uniqid('ORD-') . '-' . now()->format('Y') . '-' . $order->id;
        // $order->getNextOrderNumberAttribute();
        $order->user_id = auth()->id();
    }

    /**
     * Handle the order "updated" event.
     */
    public function updated(order $order): void
    {
        //
    }

    /**
     * Handle the order "deleted" event.
     */
    public function deleted(order $order): void
    {
        //
    }

    /**
     * Handle the order "restored" event.
     */
    public function restored(order $order): void
    {
        //
    }

    /**
     * Handle the order "force deleted" event.
     */
    public function forceDeleted(order $order): void
    {
        //
    }
}
