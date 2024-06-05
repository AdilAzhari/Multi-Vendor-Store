<?php

namespace App\Listeners;

use App\Events\OrderEvent;
use App\Facades\Cart;
use App\Models\Order;
use App\Models\product;
use App\Models\User;
use App\Repositories\Cart\CartModelRepository;
use Illuminate\Support\Facades\DB;

class DeductProductQuantityListener
{

    /**
     * Handle the event.
     */
    public function handle(Order $order, User $user): void
    {
        foreach (Cart::get() as $item) {
            product::where('id', $item->product_id)
                ->update([
                    'quantity' => DB::raw('quantity - ' . $item->quantity)
                ]);
        }
    }
}
