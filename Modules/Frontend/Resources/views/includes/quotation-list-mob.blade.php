@forelse ($quotations as $quotation)
    <div class="accordion-item">
        <h2 class="accordion-header" id="heading{{ $loop->iteration }}">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapse{{ $loop->iteration }}" aria-expanded="false"
                aria-controls="collapse{{ $loop->iteration }}">
                <div class="flxBx">
                    <div class="ltBx">
                        <div class="ordrId"><span>Order ID: </span>{{ $quotation->uid }}
                        </div>
                    </div>
                    <div class="rtBx">
                        @if ($quotation->quotationDetails->where('remarks', '!=', null)->count() > 0)
                            <a href="javascript:void(0)" class="notification">
                                <img src="{{ asset('frontend/images/noti.svg') }}" alt="">
                            </a>
                        @endif
                    </div>
                </div>
            </button>
        </h2>
        <div id="collapse{{ $loop->iteration }}" class="accordion-collapse collapse "
            aria-labelledby="heading{{ $loop->iteration }}" data-bs-parent="#Productaccordion">
            <div class="accordion-body">
                <div class="dBlock">
                    <ul>
                        <li><span>Date:</span>{{ $quotation->quotation_received }}</li>
                        <li><span>No. of Items:</span>{{ $quotation->quotationDetails->count() }}</li>
                        <li><span>Total Price:</span
                                class="quotation-price-{{ $quotation->uid }}">{{ $quotation->priceWithSymbol($quotation->converted_total_bid_price) }}
                        </li>
                        <li><span>Status:</span>
                            <div class="quotation-status-{{ $quotation->uid }}">
                                <div class="sts {{ $quotation->status_class }}">{{ $quotation->status_value }}</div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="accordion accordion-flush" id="dtailAccord">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-heading{{ $loop->iteration }}">
                            <div class="submit-quotation-div">
                                @if (
                                    $quotation->quotationDetails->whereIn('status', [0, 1])->count() < 1 &&
                                        $quotation->acceptedQuotationDetails->count() > 0)
                                    <a href="{{ route('checkout', $quotation->uid) }}"
                                        class="continue hoveranim"><span>Continue to
                                            Checkout</span></a>
                                @endif
                            </div>
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapse{{ $loop->iteration }}" aria-expanded="false"
                                aria-controls="flush-collapse{{ $loop->iteration }}">
                                View Details
                            </button>
                        </h2>
                        <div id="flush-collapse{{ $loop->iteration }}" class="accordion-collapse collapse"
                            aria-labelledby="flush-heading{{ $loop->iteration }}" data-bs-parent="#dtailAccord">
                            @foreach ($quotation->quotationDetails as $quotation_detail)
                                <div class="accordion-body">
                                    <ul>
                                        <li><span>Product Name:</span>{{ $quotation_detail->product->title }}</li>
                                        <li><span>Product Code:</span>{{ $quotation_detail->product->product_code }}
                                        </li>
                                        <li><span>Qty:</span>{{ $quotation_detail->quantity }}</li>
                                        <li><span>Price:</span>{{ $quotation_detail->priceWithSymbol($quotation_detail->converted_bid_price) }}
                                        </li>
                                        <li><span>Status:</span>
                                            <div class="quotation-detail-status-{{ $quotation_detail->id }}">
                                                <div class="sts {{ $quotation_detail->status_class }}">
                                                    {{ $quotation_detail->status_value }}</div>
                                            </div>
                                        </li>
                                        <li><span>Admin Approved
                                                Price:</span>{{ $quotation_detail->admin_approved_price != 0 ? $quotation_detail->priceWithSymbol($quotation_detail->converted_admin_approved_price) : '--' }}
                                        </li>
                                        <li><span>Specifications:</span>{{ $quotation_detail->product->specification }}
                                        </li>
                                        @if ($quotation_detail->remarks)
                                            <li><span>Remarks:</span>{{ $quotation_detail->remarks }}</li>
                                        @endif
                                    </ul>
                                    <div class="btnBx quotation-detail-action-{{ $quotation_detail->id }}">
                                        @if ($quotation_detail->status == 1)
                                            <div class="item">
                                                <button type="button" data-value="agree"
                                                    data-id="{{ $quotation_detail->id }}"
                                                    data-price="{{ $quotation_detail->priceWithSymbol($quotation_detail->converted_admin_approved_price) }}"
                                                    class="agree vendor-action"><span>Agree</span></button>
                                            </div>
                                            <div class="item">
                                                <button type="button" data-value="reject"
                                                    data-id="{{ $quotation_detail->id }}"
                                                    data-price="{{ $quotation_detail->priceWithSymbol($quotation_detail->converted_admin_approved_price) }}"
                                                    class="reject vendor-action"><span>Reject</span></button>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@empty
    No quotation found ...
@endforelse
