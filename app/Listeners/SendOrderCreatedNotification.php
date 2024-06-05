<?php

namespace App\Listeners;

use App\Events\OrderEvent;
use App\Models\User;
use App\Notifications\OrderCreatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendOrderCreatedNotification
{
    public function handle(OrderEvent $event): void
    {
        $order = $event->order;
        // dd($order->store_id);
        $user = User::where('store_id', $order->store_id)->get();
        if (!is_null($user)) {
            // dd($user, $order);
            Notification::send($user, new OrderCreatedNotification($order));
        } else {
            info('User not found');
        }

    }
}
