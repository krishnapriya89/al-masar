@forelse ($orders as $order)
<div class="accordion-item"  id="{{ $order->uid }}">
    <h2 class="accordion-header" id="heading{{ $loop->iteration }}">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapse{{ $loop->iteration }}" aria-expanded="false" aria-controls="collapse{{ $loop->iteration }}">
            <div class="flxBx">
                <div class="ltBx">
                    <div class="ordrId"><span>Order ID: </span>{{ $order->uid }}
                    </div>
                </div>
            </div>
        </button>
    </h2>
    <div id="collapse{{ $loop->iteration }}" class="accordion-collapse collapse " aria-labelledby="heading{{ $loop->iteration }}"
        data-bs-parent="#Productaccordion">
        <div class="accordion-body">
            <div class="dBlock">
                <ul>
                    <li><span>Date:</span>{{ $order->order_received_date }}</li>
                    <li><span>No. of Items:</span>{{ $order->orderDetails->count() }}</li>
                    <li><span>Total Price:</span> {{ $order->priceWithSymbol($order->converted_grand_total) }}</li>
                    <li><span>Status:</span><div class="status {{ $order->status_class }}">{{ $order->orderStatus->title }}</div></li>
                    <li><span>Amount Paid</span> {{ $order->priceWithSymbol($order->converted_received_amount) }}</li>
                    <li><span>Amount to be Paid</span> {{ $order->priceWithSymbol($order->converted_amount_to_be_paid) }}</li>
                    <li><span>Payment Mode:</span>{{ $order->payment->title }}</li>
                    @if ($order->admin_remarks)
                        <li><span>Notifications:</span>
                            <a href="javascript:void(0)" class="notification">
                                <img src="{{ asset('frontend/images/noti.svg') }}" alt="">
                                <abbr data-title="{{ $order->admin_remarks }}"></abbr>
                            </a>
                        </li>
                    @endif
                    @if ($order->payment_id == 2 && ($order->attachment == '' || $order->attachment == NULL))
                    <li><span>Files:</span>
                        <div class="fileUploadInput fileUploadInput{{ $order->uid }}">
                            <label for="file-upload{{ $loop->iteration }}" class="custom-file-upload">
                                Upload
                            </label>
                            <input id="file-upload{{ $loop->iteration }}" name='order_attachment' type="file"
                            class="fileInput order-attachment" data-uid="{{ $order->uid }}"  accept="image/jpeg,image/png,application/pdf">
                            <div class="iconBx">
                                <svg viewBox="0 0 11.201 12">
                                    <g id="_x38_2_attachment" transform="translate(-2.001 -1)">
                                        <path id="Path_101992" data-name="Path 101992"
                                            d="M13.2,4.2a3.179,3.179,0,0,1-.937,2.263L6.5,12.3A2.4,2.4,0,1,1,3.1,8.9L7.268,4.763a1.574,1.574,0,0,1,2.216-.045,1.488,1.488,0,0,1,.433,1.109,1.629,1.629,0,0,1-.481,1.105L5.484,10.884a.4.4,0,1,1-.566-.566L8.87,6.366A.83.83,0,0,0,9.117,5.8a.7.7,0,0,0-.2-.52.774.774,0,0,0-1.086.047L3.668,9.47a1.6,1.6,0,0,0,2.264,2.262L11.7,5.9A2.4,2.4,0,1,0,8.3,2.5L2.682,8.085a.4.4,0,0,1-.564-.568L7.74,1.937A3.2,3.2,0,0,1,13.2,4.2Z" />
                                    </g>
                                </svg>
                            </div>
                        </div>
                    </li>
                    @elseif ($order->attachment)
                        <li><span>Files:</span>
                            <div class="fileUploadInput">
                                <a href="{{ Storage::url($order->attachment) }}" target="_blank" download=""><i class="fa fa-download">Download</i></a>
                            </div>
                        </li>
                    @endif
                </ul>
            </div>
            <div class="accordion accordion-flush" id="dtailAccord">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-heading{{ $loop->iteration }}">
                        <button class="accordion-button collapsed" type="button"
                            data-bs-toggle="collapse" data-bs-target="#flush-collapse{{ $loop->iteration }}"
                            aria-expanded="false" aria-controls="flush-collapse{{ $loop->iteration }}">
                            View Details
                        </button>
                    </h2>
                    <div id="flush-collapse{{ $loop->iteration }}" class="accordion-collapse collapse"
                        aria-labelledby="flush-heading{{ $loop->iteration }}" data-bs-parent="#dtailAccord">
                        @foreach ($order->orderDetails as $order_detail)
                            <div class="accordion-body">
                                <ul>
                                    <li><span>Product Name:</span>{{ $order_detail->orderProduct->title }}</li>
                                    <li><span>Product Code:</span>{{ $order_detail->orderProduct->product_code }}</li>
                                    <li><span>SKU:</span>{{ $order_detail->orderProduct->sku }}</li>
                                    <li><span>Specifications:</span>{{ $order_detail->orderProduct->specification }}</li>
                                    <li><span>Qty:</span>{{ $order_detail->quantity }}</li>
                                    <li><span>Price:</span>{{ $order_detail->priceWithSymbol($order_detail->converted_product_total_bid_price) }}</li>
                                </ul>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@empty
    No Orders Found...
@endforelse
