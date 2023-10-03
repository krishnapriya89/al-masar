@forelse ($products as $product)
    <tr>
        <td>
            <div class="pcode {{ $product->stock_class }}">
                {{ $product->product_code }}
            </div>
        </td>
        <td>
            <div class="proFlx {{ $product->stock_class }}">
                <div class="PimgB">
                    <img src="{{ $product->listing_image_value }}" alt="{{ $product->title }}">
                </div>
                <div class="name">{{ $product->title }}</div>
            </div>
        </td>
        <td>
            <div class="txt {{ $product->stock_class }}">{!! $product->specification !!}</div>
        </td>
        <td>
            <div class="txt {{ $product->stock_class }}">{{ $product->model_number }}</div>
        </td>
        <td>
            <div class="txt {{ $product->stock_class }}">
                <div class="quantity buttons_added">
                    <input type="button" value="-" class="minus">
                    <input type="number" step="1" min="{{ $product->min_quantity_to_buy }}" name="quantity"
                        value="{{ $product->min_quantity_to_buy }}" title="Qty" class="input-text qty text"
                        size="4" pattern="" inputmode="">
                    <input type="button" value="+" class="plus">
                </div>
            </div>
        </td>
        <td>
            <div class="txt {{ $product->stock_class }}">@currencySymbolWithConvertedPrice($product->min_product_price)</div>
        </td>
        <td>
            @if ($product->is_instock)
                <input type="text" placeholder="" class="bid" value="">
                <div class="txt">@currencySymbolWithConvertedPrice($product->price)
                    <div class="tmns">@currencySymbolWithConvertedPrice($product->min_product_price)</div>
                </div>
            @else
                <div class="notify">Notify Me</div>
            @endif
        </td>
        <td>
            <a href="{{ route('product-detail', $product->slug) }}" class="vMore">View Details</a>
        </td>
        <td>
            <div class="cart">
                <svg viewBox="0 0 19.169 19.5">
                    <g id="cart" transform="translate(-2.46 -2.25)">
                        <path id="Path_102143" data-name="Path 102143"
                            d="M21.19,5.83a1.751,1.751,0,0,0-1.3-.58H7.54L7.17,4.13A2.754,2.754,0,0,0,4.56,2.25H3.21a.75.75,0,0,0,0,1.5H4.56a1.25,1.25,0,0,1,1.19.85l.52,1.56.79,7.14a2.742,2.742,0,0,0,2.73,2.45h8.42a2.742,2.742,0,0,0,2.73-2.45l.68-6.11a1.746,1.746,0,0,0-.44-1.36Zm-1.73,7.31a1.246,1.246,0,0,1-1.24,1.11H9.8a1.246,1.246,0,0,1-1.24-1.11L7.85,6.75H19.89a.26.26,0,0,1,.19.08.24.24,0,0,1,.06.19l-.68,6.11Z" />
                        <path id="Path_102144" data-name="Path 102144"
                            d="M9.5,17.25a2.25,2.25,0,1,0,2.25,2.25A2.253,2.253,0,0,0,9.5,17.25Zm0,3a.75.75,0,1,1,.75-.75A.755.755,0,0,1,9.5,20.25Z" />
                        <path id="Path_102145" data-name="Path 102145"
                            d="M18.5,17.25a2.25,2.25,0,1,0,2.25,2.25A2.253,2.253,0,0,0,18.5,17.25Zm0,3a.75.75,0,1,1,.75-.75A.755.755,0,0,1,18.5,20.25Z" />
                    </g>
                </svg>
            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="9">
            No Products Found...
        </td>
    </tr>
@endforelse