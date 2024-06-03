<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Repositories\Cart\CartModelRepository;
use App\Repositories\Cart\CartsRepository;
use Illuminate\Http\Request;
use Symfony\Component\Intl\Countries;

class CheckoutController extends Controller
{
    public function create(CartModelRepository $cartModelRepository)
    {
        return view('front.checkout', [
            'cart' => $cartModelRepository,
            'countries' => Countries::getNames(),
        ]);
    }

    public function store(Request $request, CartModelRepository $cartModelRepository)
    {
        $request->validate([
            'shipping_fullname' => 'required',
            'shipping_address' => 'required',
            'shipping_city' => 'required',
            'shipping_state' => 'required',
            'shipping_zipcode' => 'required',
            'shipping_phone' => 'required',
            'payment_method' => 'required',
        ]);

        $order = $cartModelRepository->storeOrder($request);

        return redirect()->route('front.confirmation.index', $order->number);
    }
}
