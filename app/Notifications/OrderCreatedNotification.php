<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCreatedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct( public $order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $address = $this->order->billingAddress;
        return (new MailMessage)
            ->subject('Order has been placed successfully')
            ->greeting('Hello ' . $address->getFullNameAttribute())
            ->line('Order has been placed successfully')
            ->line('Order Number: ' . $this->order->order_number)
            ->line('Order Total: ' . $this->order->total)
            ->line('Billing Address: ' . $address->getFullAddressAttribute())
            ->action('View Order', url('/'))
            ->line('Thank you for using our application!');
    }

    public function toDatabase(object $notifiable): array
    {
        $address = $this->order->billingAddress;

        return [
            'order_number' => $this->order->order_number,
            'total' => $this->order->total,
            'icon' => 'fa fa-shopping-cart',
            'body' => 'A new Order $this->order->order_number has been placed successfully created by ' . $notifiable->first_name . ' ' . $notifiable->last_name . ' from' .  $this->order->billingAddress->getFullAddressAttribute(),
            'url' => url('/'),
        ];
    }
    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            $notifiable->id => $this->order->order_number,
        ];
    }
}
