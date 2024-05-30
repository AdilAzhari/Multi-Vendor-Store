<?php

namespace App\Repositories\Cart;

use App\Models\cart;
use App\Models\product;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class CartModelRepository implements CartsRepository
{
    public function get()
    {
        return cart::with('product')->where('cookie_id', $this->getCookieId())->get();
    }
    public function delete(product $product)
    {
        return Cart::where('cookie_id', $this->getCookieId())->where('product_id', $product->id)
            ->delete();
    }
    public function add(product $product, $quantity = 1)
    {
        $item = cart::where('cookie_id', $this->getCookieId())
            ->where('product_id', $product->id)
            ->where('user_id', auth()->id())
            ->first();

        if ($item) {
            $this->update($product,$quantity);
        }if(!$item){
            return Cart::updateOrCreate([
                'user_id' => auth()->id(),
                'product_id' => $product->id,
                'quantity' => $quantity,
                'cookie_id' => $this->getCookieId(),
            ]);
        }
        return $item->increment('quantity',$quantity);
    }
    public function update(product $product,$quantity = 1)
    {
        return Cart::where('cookie_id', $this->getCookieId())->where('product_id', $product->id)
            ->update([
                'quantity' => request()->quantity,
            ]);
    }
    public function empty()
    {
    }
    public function total(): float
    {
        return (float) Cart::where('cookie_id', $this->getCookieId())
            ->join('products', 'products.id', '=', 'carts.product_id')
            ->selectRaw('SUM(carts.quantity * products.price) as total')
            ->value('total');
    }

    protected function getCookieId()
    {
        $cookie_id = Cookie::get('cart_id');
        if (!$cookie_id) {
            $cookie_id = str::uuid();
            Cookie::queue(Cookie::make('cart_id', $cookie_id, 60 * 24 * 7));
        }
        return $cookie_id;
    }
}
