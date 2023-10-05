@extends('admin::layouts.app')
@section('title', 'Quotation Management')
@push('css')
    <style>
        .status{
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
        .clr1{
            background: #ffd5d7;
        }
        .clr2{
            background: #ceddff
        }
        .clr3{
            background: rgba(104,255,195,.38)
        }
        .clr4{
            background: #ffe7d6;
        }
        .clr5{
            background: #ffe7d6;
        }
        .remarks { font-size: 10px; }
        .amountField { font-size: 10px; margin-top: 1px; }
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
                                    <td>$@formattedPrice($quotation->total)</td>
                                    <td class="quotation-{{ $quotation->uid }}"><div class="status {{ $quotation->status_class }}">
                                        {{ $quotation->status_value }}</div>
                                    </td>
                                    <td><button class="btn btn-default btn-sm"><i class="fa fa-chevron-down"></i></button></td>
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
                                                        <th>Specifications</th>
                                                        <th>Qty</th>
                                                        <th>Price</th>
                                                        <th>Total</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($quotation->quotationDetails as $quotation_detail)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $quotation_detail->product->title }}</td>
                                                            <td>{{ $quotation_detail->product->product_code }}</td>
                                                            <td>{{ $quotation_detail->product->specification }}</td>
                                                            <td>{{ $quotation_detail->quantity }}</td>
                                                            <td>$@formattedPrice($quotation_detail->bid_price)</td>
                                                            <td>$@formattedPrice($quotation_detail->total)</td>
                                                            <td id="quotation-detail-{{ $quotation_detail->id }}">
                                                                @if ($quotation_detail->status == 0)
                                                                    <div class="form-group">
                                                                        <select class="custom-select form-control-border quotation-detail-status-{{ $quotation_detail->id }} quotation-detail-status-select"
                                                                                data-quotation-detail-id="{{ $quotation_detail->id }}">
                                                                            <option value="0" selected disabled>Waiting For Approval</option>
                                                                            <option value="2">Accept</option>
                                                                            <option value="4">Requote</option>
                                                                            <option value="3">Reject</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group quotation-detail-div-{{ $quotation_detail->id }} d-none">
                                                                        <textarea class="form-control remarks" placeholder="Remarks"></textarea>
                                                                        <input type="number" data-bid-price={{ $quotation_detail->bid_price }} class="form-control amountField amount-{{ $quotation_detail->id }} d-none" placeholder="Requote amount">
                                                                        <button type="button" class="btn btn-xs btn-success quotation-status-change-btn" data-quotation-detail-id="{{ $quotation_detail->id }}">Submit</button>
                                                                    </div>
                                                                @else
                                                                    <div class="status {{ $quotation->status_class }}">
                                                                        {{ $quotation->status_value }}</div>
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

        //quotation detail dropdown
        $(document).on("change", ".quotation-detail-status-select", function() {
            let quotation_detail_id = $(this).data('quotation-detail-id');
            $('.quotation-detail-div-'+quotation_detail_id).removeClass('d-none');
            if($(this).val() == 4)
                $('.amount-'+quotation_detail_id).removeClass('d-none');
            else
                $('.amount-'+quotation_detail_id).addClass('d-none');
        });

        //quotaion detail submit button
        $(document).on('click', '.quotation-status-change-btn', function() {
            var _this = $(this);
            $('.amountFieldErrorSpan').remove();
            var quotation_detail_id = _this.data('quotation-detail-id');
            var remarks = _this.parent().find('.remarks').val();
            var amount = _this.parent().find('.amountField').val();
            var status = $('.quotation-detail-status-'+quotation_detail_id).val();
            _this.parent().find('.remarks').removeClass('is-invalid');
            _this.parent().find('.amountField').removeClass('is-invalid');
            var fields_valid = true;

            if(status == 4 && (amount == '' || amount == undefined)) {
                _this.parent().find('.amountField').addClass('is-invalid');
                fields_valid = false;
            }
                
            if(status == 3 && (remarks == '' || remarks == undefined)){
                _this.parent().find('.remarks').addClass('is-invalid');
                fields_valid = false;
            }

            if(amount != '' && amount != undefined) {
                var bid_price = _this.parent().find('.amountField').data('bid-price');
                console.log(amount);
                console.log(bid_price);
                amount = parseInt(amount);
                if(amount < parseInt(bid_price) || amount < 1){
                    _this.parent().find('.amountField').addClass('is-invalid');
                    _this.parent().append('<span class="amountFieldErrorSpan" style="color: red; font-size: 10px;">Please enter amount greater than of bid amount.</span>');
                    fields_valid = false;
                }
            }
            
            if(fields_valid){
                _this.attr('disabled', true);
                $.ajax({
                    url: "{{ route('quotation-management.change-status') }}",
                    type: "POST",
                    data: {
                        quotation_detail_id: quotation_detail_id,
                        status: status,
                        remarks: remarks,
                        amount: amount,
                    },
                    success: function(response) {
                        toastr.success(response.message);
                        $('.quotation-detail-'+quotation_detail_id).html('<div class="status clr2">'+response.detail_status+'</div>')
                        _this.attr('disabled', false);
                    },
                    error: function(xhr, status, error) {
                        toastr.error(response.message);
                        _this.attr('disabled', false);
                    },
                });
            }
        });
    </script>
@endpush
