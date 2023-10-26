@extends('frontend::layouts.app')
@section('title', 'Quotaion')

@section('content')
    @if ($quotations->isNotEmpty())
        <div id="pageWrapper" class="DashBoard InnerPage">
            <section id="proListing">
                <div class="breadCrumb">
                    <div class="container">
                        <ul>
                            <li>
                                <a href="{{ route('home') }}">Home </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">My Quotation</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="container">
                    <div class="all_products">
                        <div class="bdfgBx">
                            <div class="Stitle">My Quotation</div>
                        </div>
                        <div class="bdfgRtBx">
                            <div class="ltb DskTop">
                                <div class="display">
                                    <div class="txt">Filter By</div>
                                    <select name="status_web" id="status_web" class="select quotation-filter-web">
                                        <option value="">All</option>
                                        <option value="0">Waiting for approval</option>
                                        <option value="1">Action From Vendor</option>
                                        <option value="2">Accepted</option>
                                        <option value="3">Rejected</option>
                                        <option value="4">Rejected by Vendor</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mobVew">
                                <button type="button" class="filterOption" data-bs-toggle="modal"
                                    data-bs-target="#filterAccodionModal">
                                    <svg viewBox="0 0 8 8.178">
                                        <path id="filter"
                                            d="M10.24,3.245H4.26a1.012,1.012,0,0,0-.768,1.669L5.856,7.67a.588.588,0,0,1,.137.37v2.578a.8.8,0,0,0,.379.681.813.813,0,0,0,.421.119.761.761,0,0,0,.357-.087l.914-.457a.8.8,0,0,0,.443-.718V8.035a.57.57,0,0,1,.137-.37l2.363-2.757A1.012,1.012,0,0,0,10.24,3.24Zm.247,1.221L8.123,7.222a1.248,1.248,0,0,0-.3.818v2.121a.105.105,0,0,1-.064.1l-.914.457a.1.1,0,0,1-.11,0,.116.116,0,0,1-.055-.1V8.04a1.248,1.248,0,0,0-.3-.818L4.013,4.465A.324.324,0,0,1,4.26,3.93H10.24a.324.324,0,0,1,.247.535Z"
                                            transform="translate(-3.25 -3.24)" />
                                    </svg>
                                    Filter
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="tableAccordionBx DskTop">
                        <div class="headBxFlx">
                            <div class="item">Order ID</div>
                            <div class="item">Date</div>
                            <div class="item">No. of Items</div>
                            <div class="item">Total Price</div>
                            <div class="item">Status</div>
                            <div class="item">Notifications</div>
                        </div>
                        <div class="detailFlx">
                            <div class="accordion" id="QuotationAccordionWeb">
                                @include('frontend::includes.quotation-list')
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mobVew">
                    <div class="accordion" id="QuotationAccordionMob">
                        @include('frontend::includes.quotation-list-mob')
                    </div>
                </div>
        </div>
        </section>
        <div class="modal fade" id="filterAccodionModal" tabindex="-1" aria-labelledby="filterAccodionModal"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="ModalHeader">
                        <div class="title">
                            <div class="icon">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                            Filter By
                        </div>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="accordion" id="filterAccodion">
                            <div class="card">
                                <div class="cardHeader">
                                    <button class="btn btn-link" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#Category" aria-expanded="true" aria-controls="CategoryFilter">
                                        Status
                                    </button>
                                </div>
                                <div id="Category" class="collapse show" aria-labelledby="headingOne"
                                    data-bs-parent="#filterAccodion1">
                                    <div class="card-body">
                                        <ul>
                                            <li><a href="javascript:void(0)" class="quotation-filter-mob" data-value="">All</a></li>
                                            <li><a href="javascript:void(0)" class="quotation-filter-mob" data-value="0">Waiting for approval</a></li>
                                            <li><a href="javascript:void(0)" class="quotation-filter-mob" data-value="1">Action From Vendor</a></li>
                                            <li><a href="javascript:void(0)" class="quotation-filter-mob" data-value="2">Accepted</a></li>
                                            <li><a href="javascript:void(0)" class="quotation-filter-mob" data-value="3">Rejected</a></li>
                                            <li><a href="javascript:void(0)" class="quotation-filter-mob" data-value="4">Rejected by Vendor</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    @else
        <div id="pageWrapper" class="orderInfoPage InnerPage empty-quote-div">
            <section id="infoB">
                <div class="container">
                    <div class="row">
                        <div class="allBx etyBx">
                            <div class="emptyBx">
                                <div class="icon">
                                    <img src="{{ asset('frontend/images/empty.svg') }}" alt="">
                                </div>
                                <div class="emptytitle">Your Quotation is <span>Empty</span></div>
                                <div class="subT">Add items to get Started</div>
                                <a href="{{ route('product') }}" class="back hoveranim"><span>Back to Products</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    @endif
@endsection
@push('js')
    <script>
        //vendor agree or rejecting the order
        $('.vendor-action').click(function () {
            var _this = $(this);
            var id = _this.data('id');
            var status_value = _this.data('value');
            var price =  _this.data('price');
            var status = status_value == 'agree' ? 2 : 4;

            Swal.fire({
                    title: capitalizeWords(status_value) +" Quotation",
                    html: 'Are you sure to <b>' + capitalizeWords(status_value) + price + '</b> this amount</br>You will not be able to recover this!',
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#1d1926',
                    confirmButtonText: "Update",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('user.quotation.vendor-action') }}",
                            type: "POST",
                            data: {
                                id: id,
                                status: status,
                            },
                            success: function(response) {
                                if(response.status) {
                                    toastr.success(response.message);
                                    $('.quotation-detail-action-' + id).html('');
                                    $('.quotation-detail-status-' + id).html(
                                        `<div class="status ` + response
                                        .quotation_detail_status_class + `">` + response
                                        .quotation_detail_status + `</div>`);
                                    $('.quotation-status-' + response.quotation_uid).html(
                                        `<div class="status ` + response
                                        .quotation_status_class + `">` + response
                                        .quotation_status + `</div>`);
                                    $('.quotation-price-' + response.quotation_uid).html(
                                        response.quotation_total_bid_price);

                                    if(response.submit_quotation) {

                                        var route_val = '{{ route('checkout', '')}}/'+ response.quotation_uid;

                                        $('.submit-quotation-div').html(`<a href="`+route_val+`" class="continue hoveranim"><span>Continue
                                                    to Checkout</span></a>`);
                                    }
                                } else {
                                    toastr.error(response.message);
                                }
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
        });

        $('.quotation-filter-web').on('change', function() {
            var status = $('#status_web').val();

            $.ajax({
                url: "{{ route('user.quotation.filter' )}}",
                type: "GET",
                data: {
                    status: status,
                },
                dataType: 'html',
                success: function(response) {
                    $('#QuotationAccordionWeb').html(response);
                }
            });
        });

        $('.quotation-filter-mob').on('click', function() {
            var status = $(this).data('value');
            $.ajax({
                url: "{{ route('user.quotation.filter.mob' )}}",
                type: "GET",
                data: {
                    status: status,
                },
                dataType: 'html',
                success: function(response) {
                    $('#QuotationAccordionMob').html(response);
                    $('#filterAccodionModal').modal('hide');
                }
            });
        });
    </script>
@endpush
