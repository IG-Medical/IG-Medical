<div class="product-card-small">
    <a href="{{ route('product.details', ['slug' => $product->slug]) }}">
        @if($product->main_image_url)
            <img src="{{ $product->main_image_url }}" alt="{{ $product->name }}" class="img-fluid">
        @endif
        <h5>{{ $product->name }}</h5>
        @if($product->price)
            <p class="price">
                @if($product->discount_percentage)
                    <span class="old-price">{{ number_format($product->price, 2) }}</span>
                    <span class="new-price">{{ number_format($product->price_after_discount, 2) }}</span>
                @else
                    <span>{{ number_format($product->price, 2) }}</span>
                @endif
            </p>
        @endif
    </a>
</div>
