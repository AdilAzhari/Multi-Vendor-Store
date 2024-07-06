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

        try {
            if (is_null($order)) {
                throw new \Exception('Order is null');
            }

            info('Order ID: ' . $order->id . ', Store ID: ' . $order->store_id);

            $user = User::where('store_id', $order->store_id)->get();

            if ($user->isEmpty()) {
                throw new \Exception('No users found for store_id: ' . $order->store_id);
            }

            Notification::send($user, new OrderCreatedNotification($order));
        } catch (\Exception $e) {
            info('Error sending notification: ' . $e->getMessage());
        }
    }
}
