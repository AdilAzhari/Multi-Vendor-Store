<?php

namespace App\Observers;

use App\Models\order;

class OrderObserver
{
    public function creating(order $order): void
    {
        // $or = order::pluck('order_number')->split('-')->last();
        // dd($or);
        $order->status = 'pending';
        $order->order_number = uniqid('ORD-') . '-' . now()->format('Y') . '-' . $order->id;
        $order->user_id = auth()->id();
    }
}
