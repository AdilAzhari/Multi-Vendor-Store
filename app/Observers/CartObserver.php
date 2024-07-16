<?php

namespace App\Observers;

use App\Models\cart;
use Illuminate\Support\Str;
class CartObserver
{
    public function creating(cart $cart){
        $cart->id = (string) Str::uuid();
    }
}
