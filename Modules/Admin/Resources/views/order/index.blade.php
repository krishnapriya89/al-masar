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
    </style>
@endpush
@section('content')
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
                            {{-- <th>Bid Price</th> --}}
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
                        <tr data-toggle="collapse" data-target="#demo{{ $loop->iteration }}" class="accordion-toggle">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $order->uid }}</td>

                                <td>{{ $order->order_received_date }}</td>
                                <td>{{ $order->user_id ? $order->user->name : 'No User Found' }}</td>
                                <td>$ @formattedPrice($order->bid_sub_total)</td>
                                {{-- <td>$ @formattedPrice($order->sub_total)</td> --}}
                                <td>$ @formattedPrice($order->grand_total)</td>
                                <td>{{ $order->payment->title }}</td>
                                <td>{{ $order->payment_received_amount }}</td>
                                <td>
                                    <span class="">{{ $order->orderStatus->title }}</span>
                                </td>
                                <td class="quotation-{{ $order->uid }}">
                                    <button class="btn btn-default btn-sm"><i class="fa fa-chevron-down"></i></button>
                                    <select class="custom-select form-control-border order-status-select order-status-{{ $order->uid }}"
                                        data-order-uid="{{ $order->uid }}" id="chngeRmark">
                                        <option value="0" selected disabled>Waiting
                                            For Approval</option>
                                        <option value="1">Accept Order</option>
                                        <option value="2">Reject Order</option>
                                    </select>
                                </div>
                                {{-- modal --}}
                                <div class="modal" tabindex="-1" role="dialog" id="remark">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title">Modal title</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                          <p>Modal body text goes here.</p>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-primary">Save changes</button>
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
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
                                                    <th>Action</th>
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
                                                       <td class="quotation-detail-{{ $order_detail->id }}">
                                                            {{-- @if ($order_detail->status == 0)
                                                                <div class="form-group">
                                                                    <select
                                                                        class="custom-select form-control-border quotation-detail-status-{{ $quotation_detail->id }} quotation-detail-status-select"
                                                                        data-quotation-detail-id="{{ $quotation_detail->id }}">
                                                                        <option value="0" selected disabled>Waiting
                                                                            For Approval</option>
                                                                        <option value="2">Accept</option>
                                                                        <option value="1">Requote</option>
                                                                        <option value="3">Reject</option>
                                                                    </select>
                                                                </div>
                                                                <div
                                                                    class="form-group quotation-detail-div-{{ $quotation_detail->id }} d-none">
                                                                    <textarea class="form-control remarks" placeholder="Remarks"></textarea>
                                                                    <input type="number" data-price={{ $quotation_detail->price }}
                                                                        data-bid-price={{ $quotation_detail->bid_price }}
                                                                        class="form-control amountField amount-{{ $quotation_detail->id }} d-none"
                                                                        placeholder="Requote amount">
                                                                    <button type="button"
                                                                        class="btn btn-xs btn-success quotation-detail-status-form-btn"
                                                                        data-quotation-detail-id="{{ $quotation_detail->id }}">Submit</button>
                                                                </div>
                                                            @else
                                                                <div
                                                                    class="status {{ $quotation_detail->status_class }}">
                                                                    {{ $quotation_detail->admin_status_value }}</div>
                                                            @endif --}}
                                                        </td>
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
                    {{--                    @if($orders)--}}
                    {{--                        <div class="container">--}}
                    {{--                            <ul class="pagination">--}}
                    {{--                                {!! $orders->links() !!}--}}
                    {{--                            </ul>--}}
                    {{--                        </div>--}}
                    {{--                    @endif--}}
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
        });
        $('#chngeRmark').change(function(){
           $('#remark').modal('show');
        });
    </script>
@endpush
