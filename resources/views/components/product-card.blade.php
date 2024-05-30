<div class="single-product">
    <div class="product-image">
        <img src="{{ $product->image }}" alt="#">
        @if ($product->compare_price)
            <div class="product-badge">
                <span class="sale-tag">{{ $product->sale_persent }} %</span>
            </div>
        @endif
        @if ($product->new)
            <span class="new-tag">New</span>
        @endif
        <div class="button">
            <a href="{{ route('front.products.show', $product->slug) }}" class="btn"><i class="lni lni-cart"></i>
                Add to
                Cart</a>
        </div>
    </div>
    <div class="product-info">
        <span class="category">{{ $product->category->name }}</span>
        <h4 class="title">
            <a href="{{ route('front.products.show', $product->slug) }}">{{ $product->description }}</a>
        </h4>
        <ul class="review">

            <li><i class="lni lni-star-filled"></i></li>
            <li><i class="lni lni-star-filled"></i></li>
            <li><i class="lni lni-star-filled"></i></li>
            <li><i class="lni lni-star-filled"></i></li>
            <li><i class="lni lni-star"></i></li>
            <li><span>{{ $product->rating }}</span></li>
        </ul>
        <div class="price">
            <span>{{ $product->FormattedPrice }}</span>
            @if ($product->compare_price)
                <span class="discount-price">{{ Currency::format($product->FormattedComparePrice,'') }}</span>
            @endif
        </div>
    </div>
</div>
