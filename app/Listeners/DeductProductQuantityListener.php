<?php

namespace App\Listeners;

use App\Events\OrderEvent;
use App\Facades\Cart;
use App\Models\product;
use App\Repositories\Cart\CartModelRepository;
use Illuminate\Support\Facades\DB;

class DeductProductQuantityListener
{

    /**
     * Handle the event.
     */
    public function handle(OrderEvent $event): void
    {

        foreach (Cart::get() as $item) {
            // dd($item->product_id);
            product::where('id', $item->product_id)
                ->update([
                    'quantity' => DB::raw('quantity - ' . $item->quantity)
                ]);
        }
    }

}
