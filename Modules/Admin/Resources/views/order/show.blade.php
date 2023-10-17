@extends('admin::layouts.app')
@section('title', 'Order Detail')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('order.index') }}">Orders</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">
                        <a href="{{ route('order.index') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-list"></i> Orders
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row pb-3">
                        <div class="col-12">
                            <h4>
                                <i class="fas fa-hashtag"></i> {{ $order->uid }}
                                <small class="float-right">Placed on: {{ $order->order_received_date }}</small><br>
                                <small class="float-right">
                                    Payment Method: <span class="badge bg-primary">{{ $order->payment->title }}</span>
                                </small>
                            </h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <h5>Billing Address:</h5> <strong>{{ $order->billingAddress->full_name }}</strong>
                            <br> {!! $order->billingAddress->full_address !!}
                            <br>Email : {{ $order->billingAddress->email }}
                            <br>Phone : {{ $order->billingAddress->phone_number }}
                        </div>
                        <div class="col-md-4">
                            <h5>Shipping Address:</h5>
                            <strong>{{ $order->shippingAddress->full_name }}</strong>
                            <br> {!! $order->shippingAddress->full_address !!}
                            <br>Email : {{ $order->shippingAddress->email }}
                            <br>Phone : {{ $order->shippingAddress->phone_number }}
                        </div>
                        <div class="col-sm-4 invoice-col">
                            <div class="table-responsive">
                                <table class="table" id="orderSummary">
                                    <tr>
                                        <th style="width:50%">Subtotal:</th>
                                        <td>$ @formattedPrice($order->sub_total)</td>
                                    </tr>
                                    @if ($order->tax_amount != 0)
                                        <tr>
                                            <th style="width:50%">Tax Amount: <br> {{ $order->tax_name }}
                                                @if ($order->tax_percentage != 0)
                                                    ({{ $order->tax_percentage }}%)
                                                @endif
                                                @if ($order->tax_value != 0)
                                                    +
                                                    {{ $order->priceWithSymbol($order->tax_value * $order->currency_rate) }}
                                                @endif
                                            </th>
                                            <td>$ @formattedPrice($order->tax_amount)</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <th>Grand Total</th>
                                        <td>$ @formattedPrice($order->grand_total)</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <br>
                    @if ($order->orderDetails->isNotEmpty())
                        <div class="row">
                            <div class="col-md-12">
                                <table id="" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Product</th>
                                            <th>Image</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Bid Price</th>
                                            <th>Total</th>
                                            <th>Total Bid Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($order->orderDetails as $order_detail)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $order_detail->orderProduct->title }}</td>
                                                <td><img src="{{ Storage::url($order_detail->product->listing_image) }}"
                                                        class="" alt="" height="51">
                                                <td>{{ $order_detail->quantity }}</td>
                                                <td>$ @formattedPrice($order_detail->price)</td>
                                                <td>$ @formattedPrice($order_detail->bid_price)</td>
                                                <td>$ @formattedPrice($order_detail->total)</td>
                                                <td>$ @formattedPrice($order_detail->total_bid_price)</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">No data found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <br>
                            </div>
                        </div>
                    @endif
                    <div class="row no-print">
                        <div class="col-12">
                            <a href="javascript:void(0)" onclick="window.print()" class="btn btn-default"><i
                                class="fas fa-print"></i> Print</a>
                            @if ($next_order)
                                <a href="{{ route('order.details', $next_order->uid) }}"
                                    class="btn btn-primary float-right"> <i class="far fa-arrow-alt-circle-right"></i>
                                </a>
                            @endif
                            @if ($prev_order)
                                <a href="{{ route('order.details', $prev_order->uid) }}"
                                    class="btn btn-primary float-right" style="margin-right: 5px;">
                                    <i class="far fa-arrow-alt-circle-left"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            var options = {
                // buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
            };
            initializeDataTable(options);
        });
    </script>
@endpush
