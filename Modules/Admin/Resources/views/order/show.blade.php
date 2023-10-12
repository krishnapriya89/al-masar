@extends('admin::layouts.app')
@section('title', 'Order Detail')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('order-management.index') }}">Orders</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">

                    <div class="card-tools">
                        <a href="{{ route('order-management.index') }}" class="btn btn-primary btn-sm">
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
                                    <span class="badge bg-primary">{{ $order->payment->title }}</span>
                                </small>
                            </h4>
                        </div>
                    </div>
                    <div class="row">

                       <div class="col-md-4">
                            <h5>Billing Address:</h5> <strong>{{ $order->billing_address->full_name }}</strong>
                            <br> {!! $order->full_billing_address !!}

                        </div>
                        <div class="col-md-4">
                            <h5>Shipping Address:</h5>
                            <strong>{{ $order->shipping_address->full_name }}</strong><br> {!! $order->full_shipping_address !!}

                        </div>
                        <div class="col-sm-4 invoice-col">
                            <div class="table-responsive">
                                <table class="table" id="orderSummary">
                                    <tr>
                                        <th style="width:50%">Subtotal:</th>
                                        <td>$ @formattedPrice($order->sub_total)</td>
                                    </tr>

                                        <tr>
                                            <th>Tax Amount</th>
                                            <td>$ @formattedPrice($order->tax_amount)</td>
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
                                        <th>Total</th>
                                        <th>Order Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($order->orderDetails as $order_detail)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $order_detail->orderProduct->title }}</td>
                                            <td><img src="{{ Storage::url($order_detail->product->listing_image) }}" class=""
                                                     alt="" height="51">
                                            <td>{{ $order_detail->quantity }}</td>
                                            <td>$ @formattedPrice($order_detail->price)</td>
                                            <td>$ @formattedPrice($order_detail->total)</td>
                                            <td id="order-status-{{ $order_detail->id }}">
                                                @if ($order_detail->order_status_id == 1)
                                                    <div class="form-group">
                                                        <select class="custom-select form-control-border orderStatus"
                                                                data-order-detail-id="{{ $order_detail->id }}">
                                                            @foreach ($order_statuses as $order_status)
                                                                <option value="{{ $order_status->id }}">
                                                                    {{ $order_status->title }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                @elseif ($order_detail->order_status_id == 2)
                                                    <span
                                                        class="badge bg-success">{{ $order_detail->orderStatus->title }}</span>
                                                @elseif ($order_detail->order_status_id == 3)
                                                    <span
                                                        class="badge bg-danger">{{ $order_detail->orderStatus->title }}</span>
                                                @endif
                                            </td>
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

                    <!--
                    <div class="row">
                        <div class="col-6">
                            <p class="lead">Payment Method:</p>
                            <p> {{ $order->payment->title }} </p>
                        </div>
                        <div class="col-6">
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <th>Sub Total:</th>
                                        <td>$@priceConvert($order->sub_total)</td>
                                    </tr>
                                    <tr>
                                        <th>Tax:</th>
                                        <td>0%</td>
                                    </tr>
                                    <tr>
                                        <th>Discount:</th>
                                        <td>$@priceConvert(0)</td>
                                    </tr>
                                    <tr>
                                        <th>Grand Total:</th>
                                        <td>$@priceConvert($order->grand_total)</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    -->
                    <div class="row no-print">
                        <div class="col-12">
                            <a href="javascript:void(0)" rel="noopener" target="_blank" class="btn btn-default"><i
                                    class="fas fa-print"></i> Print</a>
                            {{-- @if ($next_order)
                                <a href="{{ route('order.show', $next_order->uid) }}"
                                   class="btn btn-primary float-right"> <i class="far fa-arrow-alt-circle-right"></i>
                                </a>
                            @endif
                            @if ($prev_order)
                                <a href="{{ route('order.show', $prev_order->uid) }}"
                                   class="btn btn-primary float-right" style="margin-right: 5px;">
                                    <i class="far fa-arrow-alt-circle-left"></i>
                                </a>
                            @endif --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            var options = {
                // buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
            };
            initializeDataTable(options);

            $(document).on("change", ".orderStatus", function() {
                const order_detail_id = $(this).data('order-detail-id');
                const order_status = parseInt($(this).val());
                if (order_detail_id && order_status && order_status > 1) {
                    if (order_status == 2) {
                        var message = 'Do you want to change the order status to Completed?';
                    } else if (order_status == 3) {
                        var message = 'Do you want to change the order status to Cancelled?';
                    }
                    Swal.fire({
                        title: "Change Order Status",
                        text: message,
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: '#28a745',
                        cancelButtonColor: primary_color,
                        confirmButtonText: "Update",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: "POST",
                                data: {
                                    order_detail_id: order_detail_id,
                                    order_status: order_status,
                                },
                                success: function(response) {
                                    $('#order-status-' + order_detail_id).empty().html(
                                        response
                                            .updated_status)
                                },
                                error: function(xhr, status, error) {
                                    Swal.fire({
                                        icon: "error",
                                        title: `An error occurred while updating the status.`,
                                        showConfirmButton: false,
                                        timer: 3000,
                                    });
                                },
                            });
                        } else {
                            $('select[data-order-detail-id=' + order_detail_id + ']').val(1)
                        }
                    });
                }
            });
        });
    </script>
@endpush
