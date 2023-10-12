@extends('admin::layouts.app')
@section('title', 'Order Management')
@push('css')
    <style>
        .status {
            padding: 3px 6px;
            min-height: 19px;
            width: fit-content;
            width: -moz-fit-content;
            margin: auto;
            display: flex;
            line-height: normal;
            font-size: 12px;
            font-weight: 500;
            color: #000
        }

        .clr1 {
            background: #ffd5d7;
        }

        .clr2 {
            background: #ceddff
        }

        .clr3 {
            background: rgba(104, 255, 195, .38)
        }

        .clr4 {
            background: #ffe7d6;
        }

        .clr5 {
            background: #ffe7d6;
        }

        .remarks {
            font-size: 10px;
        }

        .amountField {
            font-size: 10px;
            margin-top: 1px;
        }

        td[title] {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            cursor: pointer;
            /* Set the cursor to 'pointer' for td with title */
        }

        label.error {
            color: #dc3545;
            font-size: 14px;
        }

        #loader {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 5px;
        }
    </style>
@endpush
@section('content')
    <div id="loader" style="display: none;">
        <!-- Your loader content, e.g., spinner or loading text -->
        Loading...
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Order Management</h3>
                </div>
                <div class="card-body">
                    <table id="dataTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Order #</th>
                                <th>Date</th>
                                <th>User</th>
                                <th>Sub Total</th>
                                <th>Grand Total</th>
                                <th>Payment Method</th>
                                <th>Paid Amount</th>
                                <th>Order Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                                <tr data-toggle="collapse" data-target="#demo{{ $loop->iteration }}"
                                    class="accordion-toggle">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $order->uid }}</td>
                                    <td>{{ $order->order_received_date }}</td>
                                    <td>{{ $order->user_id ? $order->user->name : 'No User Found' }}</td>
                                    <td>$ @formattedPrice($order->sub_total)</td>
                                    <td>$ @formattedPrice($order->grand_total)</td>
                                    <td>{{ $order->payment->title }}</td>
                                    <td>$ @formattedPrice($order->payment_received_amount)</td>
                                    <td id="order-status-{{ $order->uid }}">
                                        @if ($order->order_status_id == 2)
                                            <select
                                                class="custom-select form-control-border order-status-select order-status-select-{{ $order->uid }} changeOrderStatus"
                                                data-order-uid="{{ $order->uid }}">
                                                <option value="1" selected disabled>In Progress</option>
                                                <option value="3">Shipped</option>
                                                <option value="4">Delivered</option>
                                            </select>
                                        @elseif ($order->order_status_id == 3)
                                            <select
                                                class="custom-select form-control-border order-status-select order-status-select-{{ $order->uid }} changeOrderStatus"
                                                data-order-uid="{{ $order->uid }}">
                                                <option value="1" selected disabled>Shipped</option>
                                                <option value="4">Delivered</option>
                                            </select>
                                        @else
                                            <span
                                                class="status {{ $order->status_class }}">{{ $order->orderStatus->title }}</span>
                                        @endif
                                    </td>
                                    <td class="quotation-{{ $order->uid }}">
                                        <button class="btn btn-default btn-sm"><i class="fa fa-chevron-down"></i></button>
                                        <a href="{{ route('order.details', $order->uid) }}" class="btn btn-primary btn-sm "
                                            data-toggle="tooltip" data-placement="top" data-original-title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @if ($order->order_status_id == 1)
                                            <select
                                                class="custom-select form-control-border order-status-select order-status-{{ $order->uid }} acceptOrRejectOrder"
                                                data-order-uid="{{ $order->uid }}">
                                                <option value="0" selected disabled>Waiting
                                                    For Approval</option>
                                                <option value="2">Accept Order</option>
                                                <option value="5">Reject Order</option>
                                            </select>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="12" class="hiddenRow">
                                        <div class="accordian-body collapse" id="demo{{ $loop->iteration }}">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>SN</th>
                                                        <th>Product Name</th>
                                                        <th>Product Code</th>
                                                        <th>Qty</th>
                                                        <th>Price</th>
                                                        <th>Total Price</th>
                                                        <th>Total Bid Price</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($order->orderDetails as $order_detail)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td title="{{ $order_detail->orderProduct->specification }}">
                                                                {{ $order_detail->orderProduct->title }}</td>
                                                            <td>{{ $order_detail->orderProduct->product_code }}</td>
                                                            <td>{{ $order_detail->quantity }}</td>
                                                            <td>$@formattedPrice($order_detail->price)</td>
                                                            <td>$@formattedPrice($order_detail->price)</td>
                                                            <td
                                                                class="quotation-detail-total-bid-price-{{ $order_detail->id }}">
                                                                $@formattedPrice($order_detail->bid_price)</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">No data found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- modal --}}
    <div class="modal" tabindex="-1" role="dialog" id="remarkModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Remark</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('accept-or-reject-order') }}" method="post" id="remarkForm">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="uid" name="uid">
                        <input type="hidden" id="statusId" name="statusId">
                        <textarea name="remark" id="remark" class="form-control"></textarea>
                    </div>
                    @error('remark')
                        <span>{{ $message }}</span>
                    @enderror
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
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
        $('.acceptOrRejectOrder').change(function() {
            var statusId = $(this).val();
            var uid = $(this).data('order-uid');
            $('#remark').empty();
            $('#uid').val(uid);
            $('#statusId').val(statusId);
            $('#remarkModal').modal('show');
        });
        $("#remarkForm").validate({
            rules: {
                remark: "required",
            }
        });
        $('.order-status-select').change(function() {
            var _this = $(this);
            var order_status = $(this).val();
            var uid = $(this).data('order-uid');
            if (uid && order_status && order_status > 1) {
                $('.preloader').show();
                if (order_status == 3) {
                    var message = 'Do you want to change the order status to Shipped?';
                } else if (order_status == 4) {
                    var message = 'Do you want to change the order status to Delivered?';
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
                            url: "{{ route('order.change-status') }}",
                            type: "POST",
                            data: {
                                uid: uid,
                                order_status: order_status,
                            },
                            success: function(response) {
                                if (response.status) {
                                    if (order_status == 4) {
                                        $('#order-status-' + uid).empty().html(response
                                            .updated_status);
                                    } else if (order_status == 3) {
                                        _this.find('option[value="1"]').remove();
                                        _this.find('option[value="3"]').prop('disabled', true);
                                    }

                                    Swal.fire({
                                        icon: "success",
                                        title: `Status changed successfully`,
                                        showConfirmButton: false,
                                        timer: 3000,
                                    });
                                } else {
                                    Swal.fire({
                                        icon: "error",
                                        title: response.message,
                                        showConfirmButton: false,
                                        timer: 3000,
                                    });
                                }
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
                        $('.order-status-select-' + uid).val(1).trigger('change');
                    }
                });
            }
        });
    </script>
@endpush
