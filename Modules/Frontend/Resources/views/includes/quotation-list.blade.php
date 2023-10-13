@forelse ($quotations as $quotation)
    <div class="accordion-item">
        <h2 class="accordion-header" id="heading{{ $loop->iteration }}">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapse{{ $loop->iteration }}" aria-expanded="false"
                aria-controls="collapse{{ $loop->iteration }}">
                <div class="item">{{ $quotation->uid }}</div>
                <div class="item">{{ $quotation->quotation_received }}</div>
                <div class="item">{{ $quotation->quotationDetails->count() }}</div>
                <div class="item quotation-price-{{ $quotation->uid }}">
                    {{ $quotation->priceWithSymbol($quotation->converted_total_bid_price) }}
                </div>
                <div class="item quotation-status-{{ $quotation->uid }}">
                    <div class="status {{ $quotation->status_class }}">
                        {{ $quotation->status_value }}</div>
                </div>
                <div class="item">
                    @if ($quotation->quotationDetails->where('remarks', '!=', null)->count() > 0)
                        <a href="javascript:void(0)" class="notification">
                            <img src="{{ asset('frontend/images/noti.svg') }}" alt="">
                        </a>
                    @endif
                </div>
            </button>
        </h2>
        <div id="collapse{{ $loop->iteration }}" class="accordion-collapse collapse "
            aria-labelledby="heading{{ $loop->iteration }}" data-bs-parent="#Quatationaccordion">
            <div class="accordion-body">
                <div class="title">Order ID: {{ $quotation->uid }}</div>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <th>Product Name</th>
                            <th>Product Code</th>
                            <th>Specifications</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Action</th>
                            <th>Admin Approved Price</th>
                            <th>Notifications</th>
                        </thead>
                        <tbody>
                            @foreach ($quotation->quotationDetails as $quotation_detail)
                                <tr>
                                    <td>{{ $quotation_detail->product->title }}</td>
                                    <td>{{ $quotation_detail->product->product_code }}</td>
                                    <td>{{ $quotation_detail->product->specification }}
                                    </td>
                                    <td>{{ $quotation_detail->quantity }}</td>
                                    <td>{{ $quotation_detail->priceWithSymbol($quotation_detail->converted_bid_price) }}
                                    </td>
                                    <td class="quotation-detail-status-{{ $quotation_detail->id }}">
                                        <div class="status {{ $quotation_detail->status_class }}">
                                            {{ $quotation_detail->status_value }}</div>
                                    </td>
                                    <td class="quotation-detail-action-{{ $quotation_detail->id }}">
                                        @if ($quotation_detail->status == 1)
                                            <div class="flxB">
                                                <a href="javascript:void(0)" data-value="agree"
                                                    data-id="{{ $quotation_detail->id }}"
                                                    data-price="{{ $quotation_detail->priceWithSymbol($quotation_detail->converted_admin_approved_price) }}"
                                                    class="agree vendor-action">Agree</a>
                                                <a href="javascript:void(0)" data-value="reject"
                                                    data-id="{{ $quotation_detail->id }}"
                                                    data-price="{{ $quotation_detail->priceWithSymbol($quotation_detail->converted_admin_approved_price) }}"
                                                    class="reject vendor-action">Reject</a>
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{ $quotation_detail->admin_approved_price != 0 ? $quotation_detail->priceWithSymbol($quotation_detail->converted_admin_approved_price) : '--' }}
                                    </td>
                                    <td>
                                        @if ($quotation_detail->remarks)
                                            <a href="javascript:void(0)" class="notification">
                                                <img src="{{ asset('frontend/images/noti.svg') }}" alt="">
                                                <abbr data-title="{{ $quotation_detail->remarks }}"></abbr>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="submit-quotation-div">
                    @if (
                        $quotation->quotationDetails->whereIn('status', [0, 1])->count() < 1 &&
                            $quotation->acceptedQuotationDetails->count() > 0)
                        <a href="{{ route('checkout', $quotation->uid) }}" class="continue hoveranim"><span>Continue
                                to Checkout</span></a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@empty
    No quotation found ...
@endforelse
