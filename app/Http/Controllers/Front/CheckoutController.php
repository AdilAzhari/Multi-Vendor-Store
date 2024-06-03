<?php

namespace App\Http\Controllers\front;

use App\Events\OrderEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\storeCheckoutRequest;
use App\Models\Order;
use App\Repositories\Cart\CartModelRepository;
use App\Repositories\Cart\CartsRepository;
use Illuminate\Http\Request;
use Symfony\Component\Intl\Countries;

class CheckoutController extends Controller
{
    public function create(CartModelRepository $cartModelRepository)
    {
        if($cartModelRepository->get()->isEmpty())
        {
            return redirect()->route('cart.index');
        }
        return view('front.checkout', [
            'cart' => $cartModelRepository,
            'countries' => Countries::getNames(),
        ]);
    }

    public function store(storeCheckoutRequest $storeCheckoutRequest, CartModelRepository $cartModelRepository)
    {

        $storeCheckoutRequest->validated();

        $order = $cartModelRepository->storeOrder($storeCheckoutRequest);
        // $this->empty();
        // dd($order);
        // return view('front.confirmation', compact('order'));
        return redirect()->route('cart.index')->with('success', 'Order has been placed successfully');
    }

    public function confirmation($orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)->first();
        return view('front.confirmation', compact('order'));
    }
}
