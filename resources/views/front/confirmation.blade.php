<x-front-layout>
    <x-slot:breadcrumb>
        <!-- Start Breadcrumbs -->
        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                            <h1 class="page-title">Order Confirmation</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <ul class="breadcrumb-nav">
                            <li><a href="{{ route('home') }}"><i class="lni lni-home"></i> Home</a></li>
                            <li><a href="{{ route('front.products.index') }}">Shop</a></li>
                            <li>Order Confirmation</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Breadcrumbs -->
    </x-slot:breadcrumb>

    <!--====== Order Confirmation Part Start ======-->
    <section class="order-confirmation section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="confirmation-content">
                        <h2>Thank you for your order!</h2>
                        <p>Your order has been placed successfully.</p>
                        <div class="order-details">
                            <h4>Order Details</h4>
                            <ul>
                                <li><strong>Order Number:</strong> {{ $order->id }}</li>
                                <li><strong>Date:</strong> {{ $order->created_at->format('F j, Y') }}</li>
                                <li><strong>Total:</strong> {{ Currency::format($order->total) }}</li>
                                <li><strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}</li>
                            </ul>
                        </div>
                        <div class="order-items">
                            <h4>Items</h4>
                            <ul>
                                @foreach ($order->items as $item)
                                    <li>
                                        <strong>{{ $item->product_name }}</strong>
                                        <p>Quantity: {{ $item->quantity }}</p>
                                        <p>Price: {{ Currency::format($item->price) }}</p>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="billing-address">
                            <h4>Billing Address</h4>
                            <ul>
                                <li>{{ $order->billingAddress->first_name }} {{ $order->billingAddress->last_name }}</li>
                                <li>{{ $order->billingAddress->street_address }}</li>
                                <li>{{ $order->billingAddress->city }}, {{ $order->billingAddress->state }}</li>
                                <li>{{ $order->billingAddress->postal_code }}</li>
                                <li>{{ $order->billingAddress->country }}</li>
                                <li>Email: {{ $order->billingAddress->email }}</li>
                                <li>Phone: {{ $order->billingAddress->phone_number }}</li>
                            </ul>
                        </div>
                        @if($order->shippingAddress)
                        <div class="shipping-address">
                            <h4>Shipping Address</h4>
                            <ul>
                                <li>{{ $order->shippingAddress->first_name }} {{ $order->shippingAddress->last_name }}</li>
                                <li>{{ $order->shippingAddress->street_address }}</li>
                                <li>{{ $order->shippingAddress->city }}, {{ $order->shippingAddress->state }}</li>
                                <li>{{ $order->shippingAddress->postal_code }}</li>
                                <li>{{ $order->shippingAddress->country }}</li>
                                <li>Email: {{ $order->shippingAddress->email }}</li>
                                <li>Phone: {{ $order->shippingAddress->phone_number }}</li>
                            </ul>
                        </div>
                        @endif
                        <div class="order-actions">
                            <a href="{{ route('front.products.index') }}" class="btn btn-primary">Continue Shopping</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== Order Confirmation Part Ends ======-->
</x-front-layout>
