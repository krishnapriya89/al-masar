@forelse ($products as $product)
<div class="accordion-item">
    <h2 class="accordion-header" id="heading{{ $loop->iteration }}">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $loop->iteration }}"
            aria-expanded="false" aria-controls="collapse{{ $loop->iteration }}">
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
                    <div class="txt">Actual Price</div>
                    <div class="price">@currencySymbolWithConvertedPrice($product->price)</div>
                </div>
            </div>
        </button>
    </h2>
    <div id="collapse{{ $loop->iteration }}" class="accordion-collapse collapse " aria-labelledby="heading{{ $loop->iteration }}"
        data-bs-parent="#Productaccordion">
        <div class="accordion-body">
            <div class="dBlock">
                <div class="flxBx">
                    <div class="ltbx">
                        <div class="lbl">Product Code</div>
                        <div class="txt">A14322</div>
                    </div>
                    <div class="rtbx">
                        <div class="lbl">Bid Price</div>
                        <input type="text" placeholder="" class="bid" value="$">
                        <div class="total">Total Price <span>$800</span></div>
                    </div>
                </div>
                <div class="flxBx">
                    <div class="ltbx">
                        <div class="lbl">Model No.</div>
                        <div class="txt">A14322</div>
                    </div>
                    <div class="rtbx">
                        <div class="lbl">Required Qty</div>
                        <div class="quantity buttons_added">
                            <input type="button" value="-" class="minus">
                            <input type="number" step="1" min="1" max="10" name="quantity"
                                value="1" title="Qty" class="input-text qty text" size="4" pattern=""
                                inputmode="">
                            <input type="button" value="+" class="plus">
                        </div>
                    </div>
                </div>
                <div class="spec">
                    <div class="ttle">Specifications</div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Graecum enim hunc
                        versum nos tis omnesuavis</p>
                </div>
                <a href="#!" class="notify hoveranim"><span>Notify Me</span></a>
                <div class="btnBx">
                    <a href="javascript:void(0)" class="vdtails hoveranim"><span>VIEW
                            DETAILS</span></a>
                    <button type="" class="cart">
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
                </div>
            </div>
        </div>
    </div>
</div>
@empty
    No Products Found...
@endforelse
