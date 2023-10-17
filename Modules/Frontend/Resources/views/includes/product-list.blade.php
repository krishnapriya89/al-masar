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
                <a href="{{ route('product-detail', $product->slug) }}" target="_blank"
                    class="name">{{ $product->title }}</a>
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
                    <input type="button" value="-" class="minus change-quantity" data-operation="minus"
                        data-product="{{ $product->slug }}">
                    <input type="number" step="1" min="{{ $product->min_quantity_to_buy }}" name="quantity"
                        value="{{ $product->min_quantity_to_buy }}" title="Qty"
                        min="{{ $product->min_quantity_to_buy }}" class="input-text qty text change-quantity-input quantityField"
                        size="4" pattern="" inputmode="" data-product="{{ $product->slug }}">
                    <input type="button" value="+" class="plus change-quantity" data-operation="plus"
                        data-product="{{ $product->slug }}">
                </div>
            </div>
        </td>
        <td>
            <div class="txt {{ $product->stock_class }}">@currencySymbolWithConvertedPrice($product->price)</div>
        </td>
        <td>
            @if ($product->is_instock)
                <div class="iputBx">
                    <div class="symb">@currencySymbol</div>
                    <input type="text" name="bid_price" id="bid_price" placeholder="" class="bid bid-price amountField" value="{{ $product->userQuote && $product->userQuote->count() > 0 ? $product->userQuote->bid_price : '' }}" data-product="{{ $product->slug }}">
                </div>
                <div class="txt">Total
                    <div class="tmns product-total-price-div">@currencySymbolWithConvertedPrice($product->userQuote && $product->userQuote->count() > 0 ? $product->userQuote->product_total_price : $product->min_product_price)</div>
                </div>
            @else
                <div class="notify notify-me" data-id={{ $product->slug }} style="cursor:pointer;">Notify Me</div>
            @endif
        </td>
        <td>
            <a href="{{ route('product-detail', $product->slug) }}" target="_blank" class="vMore">View Details</a>
        </td>
        <td>
            @if ($product->is_instock)
                <div class="cart">
                    <a href="javascript:void(0)" class="list-add-to-quote" data-product="{{ $product->slug }}">
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
                    </a>
                    @if($product->userQuote && $product->userQuote->count() > 0)
                        <div class="count product-quote-count">{{ $product->userQuote->quantity }}</div>
                    @endif
                </div>
            @endif
        </td>
    </tr>
@empty
    <tr>
        <td colspan="9">
            No Products Found...
        </td>
    </tr>
@endforelse
