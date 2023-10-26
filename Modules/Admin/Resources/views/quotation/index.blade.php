@extends('admin::layouts.app')
@section('title', 'Quotation Management')
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
                <div class="card-body">
                    <div class="card-header">
                        <h3 class="card-title">Quotation Management</h3>
                    </div>
                    <table id="dataTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Order Id</th>
                                <th>Date</th>
                                <th>No. of Items</th>
                                <th>User</th>
                                <th>Total Price</th>
                                <th>Total Bid Price</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($quotations as $quotation)
                                <tr data-toggle="collapse" data-target="#demo{{ $loop->iteration }}" class="accordion-toggle">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $quotation->uid }}</td>
                                    <td>{{ $quotation->quotation_received }}</td>
                                    <td>{{ $quotation->quotationDetails->count() }}</td>
                                    <td>{{ $quotation->user->name }}</td>
                                    <td>$@formattedPrice($quotation->total_price)</td>
                                    <td class="quotation-total-bid-price-{{ $quotation->uid }}">$@formattedPrice($quotation->total_bid_price)</td>
                                    <td class="quotation-{{ $quotation->uid }}">
                                        @if ($quotation->quotationDetails->where('status', '!=', 0)->count() < 1)
                                            <div class="form-group">
                                                <select class="custom-select form-control-border quotation-status-select quotation-status-{{ $quotation->uid }}"
                                                    data-quotation-uid="{{ $quotation->uid }}">
                                                    <option value="0" selected disabled>Waiting
                                                        For Approval</option>
                                                    <option value="2">Accept All </option>
                                                    <option value="3">Reject All</option>
                                                </select>
                                            </div>
                                            <div class="form-group quotation-div-{{ $quotation->uid }} d-none">
                                                <textarea class="form-control remarks" placeholder="Remarks"></textarea>
                                                <button type="button"
                                                    class="btn btn-xs btn-success quotation-status-form-btn"
                                                    data-quotation-uid="{{ $quotation->uid }}">Submit</button>
                                            </div>
                                        @else
                                            @if ($quotation->quotationDetails->where('status',  0)->count() > 0)
                                                <div class="status clr4">Waiting for approval</div>
                                            @else
                                                <div class="status {{ $quotation->status_class }}">
                                                    {{ $quotation->admin_status_value }}</div>
                                            @endif
                                        @endif
                                    </td>
                                    <td><button class="btn btn-default btn-sm"><i class="fa fa-chevron-down"></i></button>
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
                                                        <th>Bid Price</th>
                                                        {{-- <th>Total Price</th>
                                                        <th>Total Bid Price</th> --}}
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($quotation->quotationDetails as $quotation_detail)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td title="{{ $quotation_detail->product->specification }}">
                                                                {{ $quotation_detail->product->title }}</td>
                                                            <td>{{ $quotation_detail->product->product_code }}</td>
                                                            <td>{{ $quotation_detail->quantity }}</td>
                                                            <td>$@formattedPrice($quotation_detail->price)</td>
                                                            <td
                                                                class="quotation-detail-bid-price-{{ $quotation_detail->id }}">
                                                                $@formattedPrice($quotation_detail->bid_price)</td>
                                                            {{-- <td>$@formattedPrice($quotation_detail->total_price)</td> --}}
                                                            {{-- <td
                                                                class="quotation-detail-total-bid-price-{{ $quotation_detail->id }}">
                                                                $@formattedPrice($quotation_detail->total_bid_price)</td> --}}
                                                            <td class="quotation-detail-{{ $quotation_detail->id }}">
                                                                @if ($quotation_detail->status == 0)
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
                                                                @endif
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

        //quotaion dropdown
        $(document).on("change", ".quotation-status-select", function() {
            let quotation_uid = $(this).data('quotation-uid');
            $('.quotation-div-' + quotation_uid).removeClass('d-none');
        });

        //quotaion detail submit button
        $(document).on('click', '.quotation-status-form-btn', function() {
            var _this = $(this);
            var quotation_uid = _this.data('quotation-uid');
            var remarks = _this.parent().find('.remarks').val();
            var status = $('.quotation-status-' + quotation_uid).val();
            var status_text = $('.quotation-status-' + quotation_uid + ' :selected').text();

            _this.parent().find('.remarks').removeClass('is-invalid');
            var fields_valid = true;

            //reject
            if (status == 3 && (remarks == '' || remarks == undefined)) {
                _this.parent().find('.remarks').addClass('is-invalid');
                fields_valid = false;
            }

            if (fields_valid) {
                _this.attr('disabled', true);

                var message = 'Do you want to change the quotation status to <strong>' + status_text +
                    '</strong>?</br>You will not be able to recover this!';
                if (remarks)
                    message += '</br> Remarks: <strong>' + remarks + '</strong>';

                Swal.fire({
                    title: "Change Quotation Status",
                    html: message,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: primary_color,
                    confirmButtonText: "Update",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('quotation-management.change-quotation-status') }}",
                            type: "POST",
                            data: {
                                quotation_uid: quotation_uid,
                                status: status,
                                remarks: remarks,
                            },
                            success: function(response) {
                                if(!response.status && response.message)
                                    toastr.error(response.message);
                                else
                                    location.reload();
                            },
                            error: function(xhr, status, error) {
                                toastr.error('Something went wrong');
                                location.reload();
                                _this.attr('disabled', false);
                            },
                        });
                    } else {
                        _this.attr('disabled', false);
                    }
                });
            }
        });

        //quotation detail dropdown
        $(document).on("change", ".quotation-detail-status-select", function() {
            let quotation_detail_id = $(this).data('quotation-detail-id');
            $('.quotation-detail-div-' + quotation_detail_id).removeClass('d-none');
            if ($(this).val() == 1)
                $('.amount-' + quotation_detail_id).removeClass('d-none');
            else
                $('.amount-' + quotation_detail_id).addClass('d-none');
        });

        //quotaion detail submit button
        $(document).on('click', '.quotation-detail-status-form-btn', function() {
            var _this = $(this);
            console.log($('.amountFieldErrorSpan'));
            $('.amountFieldErrorSpan').remove();
            var quotation_detail_id = _this.data('quotation-detail-id');
            var remarks = _this.parent().find('.remarks').val();
            var amount = _this.parent().find('.amountField').val();
            var status = $('.quotation-detail-status-' + quotation_detail_id).val();
            var status_text = $('.quotation-detail-status-' + quotation_detail_id + ' :selected').text();

            _this.parent().find('.remarks').removeClass('is-invalid');
            _this.parent().find('.amountField').removeClass('is-invalid');
            var fields_valid = true;

            //requote
            if (status == 1 && (amount == '' || amount == undefined)) {
                _this.parent().find('.amountField').addClass('is-invalid');
                fields_valid = false;
            }

            //reject
            if (status == 3 && (remarks == '' || remarks == undefined)) {
                _this.parent().find('.remarks').addClass('is-invalid');
                fields_valid = false;
            }

            //check amount is valid or not
            if (status == 1 && amount != '' && amount != undefined) {
                var bid_price = _this.parent().find('.amountField').data('bid-price');
                var price = _this.parent().find('.amountField').data('price');
                amount = parseInt(amount);
                if (amount <= parseInt(bid_price) || amount < 1 || amount > parseInt(price)) {
                    _this.parent().find('.amountField').addClass('is-invalid');
                    _this.parent().append(
                        '<span class="amountFieldErrorSpan" style="color: red; font-size: 12px;">Please enter the amount between the Bid Price and Unit Price</span>'
                    );
                    fields_valid = false;
                }
            }

            if (fields_valid) {
                _this.attr('disabled', true);

                var message = 'Do you want to change the quotation status to <strong>' + status_text +
                    '</strong>?</br>You will not be able to recover this!';
                if (remarks)
                    message += '</br> Remarks: <strong>' + remarks + '</strong>';
                if (status == 1 && amount)
                    message += '</br> Amount: <strong>$' + amount + '</strong>';

                Swal.fire({
                    title: "Change Quotation Status",
                    html: message,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: primary_color,
                    confirmButtonText: "Update",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('quotation-management.change-quotation-detail-status') }}",
                            type: "POST",
                            data: {
                                quotation_detail_id: quotation_detail_id,
                                status: status,
                                remarks: remarks,
                                amount: amount,
                            },
                            success: function(response) {
                                if(response.status) {
                                    toastr.success(response.message);
                                    $('.quotation-detail-' + quotation_detail_id).html(
                                        `<div class="status ` + response
                                        .quotation_detail_status_class + `">` + response
                                        .quotation_detail_status + `</div>`);
                                    $('.quotation-' + response.quotation_uid).html(
                                        `<div class="status ` + response
                                        .quotation_status_class + `">` + response
                                        .quotation_status + `</div>`);
                                    $('.quotation-total-bid-price-' + response.quotation_uid).html(
                                        response.quotation_total_bid_price);
                                    $('.quotation-detail-bid-price-' + quotation_detail_id).html(
                                        response.quotation_detail_bid_price);
                                    $('.quotation-detail-total-bid-price-' + quotation_detail_id)
                                        .html(response.quotation_detail_total_bid_price);
                                }
                                else {
                                    toastr.error(response.message);
                                }
                                    _this.attr('disabled', false);
                            },
                            error: function(xhr, status, error) {
                                toastr.error('Something went wrong');
                                _this.attr('disabled', false);
                            },
                        });
                    } else {
                        _this.attr('disabled', false);
                    }
                });
            }
        });
    </script>
@endpush
