<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function create(Order $order)
    {
        return view('front.payments.create', compact('order'));
    }

    public function createStripePaymentIntent(Order $order)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $amount = $order->total * 100; // Convert to cents

        $paymentIntent = PaymentIntent::create([
            'amount' => $amount,
            'currency' => strtolower(config('app.currency')),
            'metadata' => ['order_id' => $order->id],
        ]);

        return response()->json(['clientSecret' => $paymentIntent->client_secret]);
    }

    public function confirmPayment(Request $request, Order $order)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $paymentIntent = PaymentIntent::retrieve($request->payment_intent);

        if ($paymentIntent->status === 'succeeded') {
            $order->update(['payment_status' => 'paid']);
            return redirect()->route('orders.confirmation', $order->id)->with('success', 'Payment successful!');
        }

        return redirect()->route('orders.payments.create', $order->id)->with('error', 'Payment failed. Please try again.');
    }
}
