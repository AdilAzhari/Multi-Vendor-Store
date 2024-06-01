<div class="cart-items">
    <a href="javascript:void(0)" class="main-btn">
        <i class="lni lni-cart"></i>
        <span class="total-items">2</span>
    </a>
    <!-- Shopping Item -->
    <div class="shopping-item">
        <div class="dropdown-cart-header">
            <span>{{ $items->count() }} Items</span>
            <a href="{{ route('cart.index') }}">View Cart</a>
        </div>
        <ul class="shopping-list">
            @foreach ($items as $item)
                <li>
                    <a href="javascript:void(0)" class="remove" title="Remove this item"><i
                            class="lni lni-close"></i></a>
                    <div class="cart-img-head">
                        <a class="cart-img" href="{{ route('products.show',$item) }}"><img
                                src="{{ $item->product->image_url }}" alt="#"></a>
                    </div>

                    <div class="content">
                        <h4><a href="product-details.html">
                               {{ $item->product->name }}</a></h4>
                        <p class="quantity">{{ $item->qantity }}x - <span class="amount">{{ currency::format($item->product->price,'') }}</span>
                        </p>
                    </div>
                </li>
            @endforeach

            <li>
                <a href="javascript:void(0)" class="remove" title="Remove this item"><i class="lni lni-close"></i></a>
                <div class="cart-img-head">
                    <a class="cart-img" href="product-details.html"><img
                            src="{{ asset('images/header/cart-items/item2.jpg') }}" alt="#"></a>
                </div>
                <div class="content">
                    <h4><a href="product-details.html">Wi-Fi Smart Camera</a></h4>
                    <p class="quantity">1x - <span class="amount">$35.00</span>
                    </p>
                </div>
            </li>
        </ul>
        <div class="bottom">
            <div class="total">
                <span>Total</span>
                <span class="total-amount">$134.00</span>
                <span class="total-amount">{{ Currency::FORMAT($total, '') }}</span>
            </div>
            <div class="button">
                <a href="{{ route('cart.index') }}" class="btn animate">Checkout</a>
            </div>
        </div>
    </div>
    <!--/ End Shopping Item -->
</div>
