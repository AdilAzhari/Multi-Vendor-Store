<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class PaymentController extends Controller
{
    public function create(Order $order)
    {
        return view('front.payments.create', compact('order'));
    }

    public function createStripePaymentIntent(Order $order)
    {
        Stripe::setApiKey(config('services.stripe.Secret_key'));

        $amount = $order->total * 100; // Convert to cents

        $paymentIntent = PaymentIntent::create([
            'amount' => $amount,
            'currency' => strtolower(config('app.currency')),
            'metadata' => ['order_id' => $order->id],
            'payment_method_types' => ['card'],
        ]);

        return ['clientSecret' => $paymentIntent->client_secret];
    }

    public function confirmPayment(Request $request, Order $order)
    {
        Stripe::setApiKey(config('services.stripe.Secret_key'));

        $paymentIntent = PaymentIntent::retrieve($request->payment_intent);

        if ($paymentIntent->status === 'succeeded') {
            $order->update(['payment_status' => 'paid']);
            $order->payments()->create([
                'amount' => $paymentIntent->amount / 100,
                'currency' => $paymentIntent->currency,
                'payment_method' => 'stripe',
                'status' => 'paid',
                'transaction_id' => $paymentIntent->id,
                'transaction_data' => json_encode($paymentIntent),
                'paid_at' => now(),
            ]);
            return to_route('orders.confirmation', $order->id)->with('success', 'Payment successful!');
        }
        return to_route('orders.payments.create', ['order' => $order->id,
            'status' => 'Payment-failed'
        ])->with('error', 'Payment failed. Please try again.');
    }
}
