@forelse ($products as $product)
    <div class="accordion-item {{ !$product->is_instock ? 'unavailable' : '' }}">
        <h2 class="accordion-header" id="heading{{ $loop->iteration }}">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapse{{ $loop->iteration }}" aria-expanded="false"
                aria-controls="collapse{{ $loop->iteration }}">
                <div class="flxBx">
                    <div class="ltBx">
                        <div class="icon">
                            <img src="{{ $product->listing_image_value }}" alt="">
                        </div>
                        <div class="txtBx">
                            <div class="txt">Product Name</div>
                            <div class="name">{{ $product->title }}</div>
                        </div>
                    </div>
                    <div class="rtBx">
                        <div class="txt">Actual Price(Per Unit)</div>
                        <div class="price">@currencySymbolWithConvertedPrice($product->price)</div>
                    </div>
                </div>
                @if (!$product->is_instock)
                    <a href="javascript:void(0)" data-id={{ $product->slug }} class="notify-me notify hoveranim"><span>Notify Me</span></a>
                @endif
            </button>
        </h2>
        <div id="collapse{{ $loop->iteration }}" class="accordion-collapse collapse "
            aria-labelledby="heading{{ $loop->iteration }}" data-bs-parent="#Productaccordion">
            <div class="accordion-body">
                <div class="dBlock">
                    <div class="flxBx">
                        <div class="ltbx">
                            <div class="lbl">Product Code</div>
                            <div class="txt">{{ $product->product_code }}</div>
                        </div>
                        <div class="rtbx">
                            @if ($product->is_instock)
                                <div class="lbl">Bid Price(Per Unit)</div>
                                <input type="text" name="bid_price" id="bid_price" placeholder="" class="bid bid-price amountField product-bid-price-{{ $product->slug }}" value=""  data-product="{{ $product->slug }}">
                                <div class="total">Total Price <span class="product-total-price-div-{{ $product->slug }}">@currencySymbolWithConvertedPrice($product->userQuote && $product->userQuote->count() > 0 ? $product->userQuote->product_total_price : $product->min_product_price)</span></div>
                            @endif
                        </div>
                    </div>
                    <div class="flxBx">
                        <div class="ltbx">
                            <div class="lbl">Model No.</div>
                            <div class="txt">{{ $product->model_number }}</div>
                        </div>
                        <div class="rtbx">
                            @if ($product->is_instock)
                                <div class="lbl">Required Qty</div>
                                <div class="quantity buttons_added">
                                    <input type="button" value="-" class="minus change-quantity"  data-operation="minus" data-product="{{ $product->slug }}">
                                    <input type="number" step="1" min="{{ $product->min_quantity_to_buy }}" name="quantity"
                                    value="{{ $product->min_quantity_to_buy }}" title="Qty" class="input-text qty text change-quantity-input quantityField product-quantity-{{ $product->slug }}" size="4"
                                        pattern="" inputmode="" data-product="{{ $product->slug }}">
                                    <input type="button" value="+" class="plus change-quantity"  data-operation="plus" data-product="{{ $product->slug }}">
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="spec">
                        <div class="ttle">Specifications</div>
                        {!! $product->specification !!}
                    </div>
                    <div class="btnBx">
                        <a href="{{ route('product-detail', $product->slug) }}" target="_blank" class="vdtails hoveranim"><span>VIEW
                                DETAILS</span></a>
                        @if ($product->is_instock)
                            <button type="" class="cart list-add-to-quote" data-product="{{ $product->slug }}">
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
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@empty
    No Products Found...
@endforelse
