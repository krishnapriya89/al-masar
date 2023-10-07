@extends('frontend::layouts.app')
@section('title', 'Quote')

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
                                    <select name="quotaion_filter" id="quotaion_filter" class="select">
                                        <option value="1">Action from Vendor</option>
                                        <option value="0">Waiting for Approval</option>
                                        <option value="2">Accepted</option>
                                        <option value="3">Rejected</option>
                                        <option value="">All</option>
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
                            <div class="accordion" id="Quatationaccordion">
                                @foreach ($quotations as $quotation)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading{{ $loop->iteration }}">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapse{{ $loop->iteration }}"
                                                aria-expanded="false" aria-controls="collapse{{ $loop->iteration }}">
                                                <div class="item">{{ $quotation->uid }}</div>
                                                <div class="item">{{ $quotation->quotation_received }}</div>
                                                <div class="item">{{ $quotation->quotationDetails->count() }}</div>
                                                <div class="item quotation-price-{{ $quotation->uid }}">{{ $quotation->priceWithSymbol($quotation->total_bid_price) }}
                                                </div>
                                                <div class="item quotation-status-{{ $quotation->uid }}">
                                                    <div class="status {{ $quotation->status_class }}">
                                                        {{ $quotation->status_value }}</div>
                                                </div>
                                                <div class="item">
                                                    @if ($quotation->quotationDetails->where('remarks', '!=', NULL)->count() > 0)
                                                        <a href="javascript:void(0)" class="notification">
                                                            <img src="{{ asset('frontend/images/noti.svg') }}"
                                                                alt="">
                                                        </a>
                                                    @endif
                                                </div>
                                            </button>
                                        </h2>
                                        <div id="collapse{{ $loop->iteration }}" class="accordion-collapse collapse "
                                            aria-labelledby="heading{{ $loop->iteration }}"
                                            data-bs-parent="#Quatationaccordion">
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
                                                                        <div class="status {{ $quotation_detail->status_class }}">{{ $quotation_detail->status_value }}</div>
                                                                    </td>
                                                                    <td class="quotation-detail-action-{{ $quotation_detail->id }}">
                                                                        @if ($quotation_detail->status == 1)
                                                                            <div class="flxB">
                                                                                <a href="javascript:void(0)" data-value="agree" data-id="{{ $quotation_detail->id }}" data-price="{{ $quotation_detail->priceWithSymbol($quotation_detail->admin_approved_price) }}" class="agree vendor-action">Agree</a>
                                                                                <a href="javascript:void(0)" data-value="reject" data-id="{{ $quotation_detail->id }}" data-price="{{ $quotation_detail->priceWithSymbol($quotation_detail->admin_approved_price) }}" class="reject vendor-action">Reject</a>
                                                                            </div>
                                                                        @endif
                                                                    </td>
                                                                    <td>{{ $quotation_detail->admin_approved_price != 0 ? $quotation_detail->priceWithSymbol($quotation_detail->converted_admin_approved_price) : '--' }}
                                                                    </td>
                                                                    <td>
                                                                        @if ($quotation_detail->remarks)
                                                                            <a href="javascript:void(0)" class="notification">
                                                                                <img src="{{ asset('frontend/images/noti.svg') }}"
                                                                                    alt="">
                                                                                <abbr
                                                                                    data-title="{{ $quotation_detail->remarks }}"></abbr>
                                                                            </a>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="submit-quotation-div">
                                                    @if ($quotation->quotationDetails->whereIn('status', [0,1])->count() < 1 && $quotation->quotationDetails->where('status', 2)->count() > 0)
                                                        <a href="{{ route('user.submit-quotation')}}" class="continue hoveranim"><span>Continue
                                                        to Checkout</span></a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mobVew">
                    <div class="accordion" id="Productaccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    <div class="flxBx">
                                        <div class="ltBx">
                                            <div class="ordrId"><span>Order ID: </span>AMAS0245794
                                            </div>
                                        </div>
                                        <div class="rtBx">
                                            <a href="javascript:void(0)" class="notification">
                                                <img src="assets/images/noti.svg" alt="">
                                                <abbr
                                                    data-title="Lorem ipsum dolor
                                                    sit amet, conse ctetur adipis cing elit. Bork Placet"></abbr>
                                            </a>
                                        </div>
                                    </div>
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse " aria-labelledby="headingOne"
                                data-bs-parent="#Productaccordion">
                                <div class="accordion-body">
                                    <div class="dBlock">
                                        <ul>
                                            <li><span>Date:</span>14.09.2023</li>
                                            <li><span>No. of Items:</span>4</li>
                                            <li><span>Total Price:</span>$900</li>
                                            <li><span>Status:</span>
                                                <div class="sts clr1">Action from Vendor</div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="accordion accordion-flush" id="dtailAccord">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-headingOne">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                                    aria-expanded="false" aria-controls="flush-collapseOne">
                                                    View Details
                                                </button>
                                            </h2>
                                            <div id="flush-collapseOne" class="accordion-collapse collapse"
                                                aria-labelledby="flush-headingOne" data-bs-parent="#dtailAccord">
                                                <div class="accordion-body">
                                                    <ul>
                                                        <li><span>Product Name:</span>iPhone 14 Pro</li>
                                                        <li><span>Product Code:</span>A2894</li>
                                                        <li><span>Qty:</span>20</li>
                                                        <li><span>Price:</span>$400</li>
                                                        <li><span>Status:</span>
                                                            <div class="sts clr1">Action from Vendor</div>
                                                        </li>
                                                        <li><span>Admin Approved Price:</span>$400</li>
                                                        <li><span>Specifications:</span>Lorem ipsum dolor sit amet</li>
                                                    </ul>
                                                    <div class="btnBx">
                                                        <div class="item">
                                                            <button type=""
                                                                class="agree"><span>Agree</span></button>
                                                        </div>
                                                        <div class="item">
                                                            <button type=""
                                                                class="reject"><span>Reject</span></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <div class="flxBx">
                                        <div class="ltBx">
                                            <div class="ordrId"><span>Order ID: </span>AMAS0245794
                                            </div>
                                        </div>
                                        <div class="rtBx">
                                            <a href="javascript:void(0)" class="notification">
                                                <img src="assets/images/noti.svg" alt="">
                                                <abbr
                                                    data-title="Lorem ipsum dolor
                                                    sit amet, conse ctetur adipis cing elit. Bork Placet"></abbr>
                                            </a>
                                        </div>
                                    </div>
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#Productaccordion">
                                <div class="accordion-body">
                                    <div class="dBlock">
                                        <ul>
                                            <li><span>Date:</span>14.09.2023</li>
                                            <li><span>No. of Items:</span>4</li>
                                            <li><span>Total Price:</span>$900</li>
                                            <li><span>Status:</span>
                                                <div class="sts clr1">Action from Vendor</div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="accordion accordion-flush" id="dtailAccord">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-headingTwo">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo"
                                                    aria-expanded="false" aria-controls="flush-collapseTwo">
                                                    View Details
                                                </button>
                                            </h2>
                                            <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                                aria-labelledby="flush-headingTwo" data-bs-parent="#dtailAccord">
                                                <div class="accordion-body">
                                                    <ul>
                                                        <li><span>Product Name:</span>iPhone 14 Pro</li>
                                                        <li><span>Product Code:</span>A2894</li>
                                                        <li><span>Qty:</span>20</li>
                                                        <li><span>Price:</span>$400</li>
                                                        <li><span>Status:</span>
                                                            <div class="sts clr1">Action from Vendor</div>
                                                        </li>
                                                        <li><span>Admin Approved Price:</span>$400</li>
                                                        <li><span>Specifications:</span>Lorem ipsum dolor sit amet</li>
                                                    </ul>
                                                    <div class="btnBx">
                                                        <div class="item">
                                                            <button type=""
                                                                class="agree"><span>Agree</span></button>
                                                        </div>
                                                        <div class="item">
                                                            <button type=""
                                                                class="reject"><span>Reject</span></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <div class="flxBx">
                                        <div class="ltBx">
                                            <div class="ordrId"><span>Order ID: </span>AMAS0245794
                                            </div>
                                        </div>
                                        <div class="rtBx">
                                            <a href="javascript:void(0)" class="notification">
                                                <img src="assets/images/noti.svg" alt="">
                                                <abbr
                                                    data-title="Lorem ipsum dolor
                                                    sit amet, conse ctetur adipis cing elit. Bork Placet"></abbr>
                                            </a>
                                        </div>
                                    </div>
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-bs-parent="#Productaccordion">
                                <div class="accordion-body">
                                    <div class="dBlock">
                                        <ul>
                                            <li><span>Date:</span>14.09.2023</li>
                                            <li><span>No. of Items:</span>4</li>
                                            <li><span>Total Price:</span>$900</li>
                                            <li><span>Status:</span>
                                                <div class="sts clr1">Action from Vendor</div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="accordion accordion-flush" id="dtailAccord">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-headingThree">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#flush-collapseThree"
                                                    aria-expanded="false" aria-controls="flush-collapseThree">
                                                    View Details
                                                </button>
                                            </h2>
                                            <div id="flush-collapseThree" class="accordion-collapse collapse"
                                                aria-labelledby="flush-headingThree" data-bs-parent="#dtailAccord">
                                                <div class="accordion-body">
                                                    <ul>
                                                        <li><span>Product Name:</span>iPhone 14 Pro</li>
                                                        <li><span>Product Code:</span>A2894</li>
                                                        <li><span>Qty:</span>20</li>
                                                        <li><span>Price:</span>$400</li>
                                                        <li><span>Status:</span>
                                                            <div class="sts clr1">Action from Vendor</div>
                                                        </li>
                                                        <li><span>Admin Approved Price:</span>$400</li>
                                                        <li><span>Specifications:</span>Lorem ipsum dolor sit amet</li>
                                                    </ul>
                                                    <div class="btnBx">
                                                        <div class="item">
                                                            <button type=""
                                                                class="agree"><span>Agree</span></button>
                                                        </div>
                                                        <div class="item">
                                                            <button type=""
                                                                class="reject"><span>Reject</span></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                        data-bs-target="#Category" aria-expanded="false" aria-controls="CategoryFilter">
                                        Status
                                    </button>
                                </div>

                                <div id="Category" class="collapse" aria-labelledby="headingOne"
                                    data-bs-parent="#filterAccodion1">
                                    <div class="card-body">
                                        <ul>
                                            <li><a href="javascript:void(0)" data-value="1">Action from Vendor</a>
                                            </li>
                                            <li><a href="javascript:void(0)" data-value="0">Waiting for Approval</a>
                                            </li>
                                            <li><a href="javascript:void(0)" data-value="2">Accepted</a></li>
                                            <li><a href="javascript:void(0)" data-value="3">Rejected</a></li>
                                            <li><a href="javascript:void(0)" data-value="">All</a></li>
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
                                        $('.submit-quotation-div').html(`<a href="{{ route('user.submit-quotation')}}" class="continue hoveranim"><span>Continue
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
        })
    </script>
@endpush