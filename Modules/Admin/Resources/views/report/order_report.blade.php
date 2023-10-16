@extends('admin::layouts.app')
@section('title', 'Order Report')
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
    </style>
@endpush
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    <form action="{{ route('report.index') }}" method="GET" autocomplete="off">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select name="user_id" class="form-control select2bs4" style="width: 100%;">
                                        <option value="">Select User</option>
                                        @foreach ($users as $user)
                                            <option value="{{ base64_encode($user->id) }}"
                                                @if (request()->input('user_id') == base64_encode($user->id)) selected @endif>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <div class="input-group date" id="from_date" data-target-input="nearest">
                                        <input name="from_date" type="text" placeholder="From Date"
                                            class="form-control datetimepicker-input" data-target="#from_date"
                                            @if (request()->has('from_date')) value="{{ request('from_date') }}" @endif />
                                        <div class="input-group-append" data-target="#from_date"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <div class="input-group date" id="to_date" data-target-input="nearest">
                                        <input name="to_date" type="text" placeholder="To Date"
                                            class="form-control datetimepicker-input" data-target="#to_date"
                                            @if (request()->has('to_date')) value="{{ request('to_date') }}" @endif />
                                        <div class="input-group-append" data-target="#to_date"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <select name="payment_mode" class="form-control">
                                        <option value="">Select Payment Mode</option>
                                        @foreach ($payment_methods as $payment_method)
                                            <option value="{{ base64_encode($payment_method->id) }}" @if (request()->input('payment_mode') == base64_encode($payment_method->id)) selected @endif>{{ $payment_method->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <select name="order_status_id" class="form-control">
                                        <option value="">Select Order Status</option>
                                        @foreach ($order_statuses as $order_status)
                                            <option value="{{ $order_status->id }}"
                                                @if (request()->input('order_status_id') == $order_status->id) selected @endif>
                                                {{ $order_status->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-block btn-success btn-sm">Search</button>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="button" class="btn btn-block btn-secondary btn-sm"
                                            onclick="window.location='{{ route('report.index') }}'">Reset</button>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="button" class="btn btn-block btn-info btn-sm"
                                            onclick="window.location='{{ route('report.export') }}'">
                                            CSV
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-body">
                    <div class="card-header">
                        <h3 class="card-title">Order</h3>
                    </div>
                    <table id="dataTable" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                                <th>SN</th>
                                <th>Order#</th>
                                <th>Date</th>
                                <th>User</th>
                                <th>Subtotal</th>
                                <th>Grand Total</th>
                                <th>Payment Mode</th>
                                <th>Order Status</th>
                            </tr>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $order->uid }}</td>
                                    <td>{{ date('d/m/Y', strtotime($order->created_at)) }}</td>
                                    <td>{{ $order->user ? $order->user->name : 'No User Found!' }}</td>
                                    <td>$@formattedPrice($order->bid_sub_total)</td>
                                    <td>$@formattedPrice($order->grand_total)</td>
                                    <td>{{ $order->payment->title }}</td>
                                    <td>
                                        <span class="status {{ $order->status_class }}">{{ $order->orderStatus->title }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">No data found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
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

        //Date picker
        $('#from_date,#to_date').datetimepicker({
                format: 'L'
            });
    </script>
@endpush
