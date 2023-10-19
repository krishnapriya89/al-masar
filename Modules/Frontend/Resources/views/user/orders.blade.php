@extends('frontend::layouts.app')
@section('title', 'Products')

@section('content')
    <div id="pageWrapper" class="DashBoard InnerPage">
        <section id="proListing">
            <div class="breadCrumb">
                <div class="container">
                    <ul>
                        <li>
                            <a href="{{ route('home') }}">Home </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">My Order</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="container">
                <div class="all_products">
                    <div class="bdfgBx">
                        <div class="Stitle">My Order</div>
                    </div>
                    <div class="bdfgRtBx DskTop">
                        <div class="ltb">
                            <div class="label">Status</div>
                            <div class="display">
                                <div class="txt">Filter By</div>
                                <select name="order_status_web" id="order_status_web" class="select order-filter-web">
                                    <option value="" selected>ALL</option>
                                    @foreach ($order_statuses as $order_status)
                                        <option value="{{ $order_status->id }}">{{ $order_status->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="ltb">
                            <div class="label">Payment Mode</div>
                            <div class="display">
                                <div class="txt">Filter By</div>
                                <select name="payment_mode_web" id="payment_mode_web" class="select order-filter-web">
                                    <option value="" selected>ALL</option>
                                    @foreach ($payment_modes as $payment_mode)
                                        <option value="{{ $payment_mode->id }}">{{ $payment_mode->title }}</option>
                                    @endforeach
                                </select>
                            </div>
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
                <div class="tableAccordionBx DskTop">
                    <div class="headBxFlx flx10">
                        <div class="item">Order ID</div>
                        <div class="item">Date</div>
                        <div class="item">No. of Items</div>
                        <div class="item">Total Price</div>
                        <div class="item">Status</div>
                        <div class="item">Amount Paid</div>
                        <div class="item">Amount to be Paid</div>
                        <div class="item">Payment Mode</div>
                        <div class="item">Notifications</div>
                        <div class="item">Files</div>
                    </div>
                    <div class="detailFlx flx10">
                        <div class="accordion" id="OrderaccordionWeb">
                            @include('frontend::includes.order-list')
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
                                    </div>
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse " aria-labelledby="headingOne"
                                data-bs-parent="#Productaccordion">
                                <div class="accordion-body">
                                    <div class="dBlock">
                                        <ul>
                                            <li><span>Order ID:</span>AMAS0245794</li>
                                            <li><span>Date:</span>14.09.2023</li>
                                            <li><span>No. of Items:</span>4</li>
                                            <li><span>Total Price:</span> $900</li>
                                            <li><span>Status:</span>In Progress</li>
                                            <li><span>Payment Mode:</span>Credit Card</li>
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
                                    </div>
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#Productaccordion">
                                <div class="accordion-body">
                                    <div class="dBlock">
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
                                    </div>
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-bs-parent="#Productaccordion">
                                <div class="accordion-body">
                                    <div class="dBlock">
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
        <div class="modal fade" id="filterAccodionModal" tabindex="-1" role="dialog"
            aria-labelledby="filterAccodionModal" aria-hidden="true">
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
                                            <li><a href="javascript:void(0)">Action from Vendor</a></li>
                                            <li><a href="javascript:void(0)">Waiting for Approval</a></li>
                                            <li><a href="javascript:void(0)">Accept</a></li>
                                            <li><a href="javascript:void(0)">Reject</a></li>
                                            <li><a href="javascript:void(0)">All</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="cardHeader">
                                    <button class="btn btn-link" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#priceFilter" aria-expanded="false" aria-controls="priceFilter">
                                        Payment Mode
                                    </button>
                                </div>
                                <div id="priceFilter" class="collapse" aria-labelledby="headingOne"
                                    data-bs-parent="#filterAccodion3">
                                    <div class="card-body">
                                        <ul>
                                            <li><a href="javascript:void(0)">In Progress</a></li>
                                            <li><a href="javascript:void(0)">Delivered</a></li>
                                            <li><a href="javascript:void(0)">ALL</a></li>
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
@endsection
@push('js')
    <script>
        $('.order-filter-web').on('change', function() {
            var status = $('#order_status_web').val();
            var payment_mode = $('#payment_mode_web').val();

            $.ajax({
                url: "{{ route('user.order.filter') }}",
                type: "GET",
                data: {
                    status: status,
                    payment_mode: payment_mode
                },
                dataType: 'html',
                success: function(response) {
                    $('#OrderaccordionWeb').html(response);
                }
            });
        });

        $('body').on('change', '.order-attachment', function() {
            console.log('yes');
            // file input data taking
            var fileInput = this;
            var uid = $(fileInput).data('uid');
            var file = fileInput.files[0];

            var fileSize = file.size;

            // // Convert fileSize to kilobytes
            var fileSizeKB = fileSize / 1024;

            // // Check if the file size is within a certain limit (e.g., 2MB)
            var maxSizeKB = 2048; // 2MB
            if (fileSizeKB <= maxSizeKB) {

                //setting the file name in the label
                var i = $(fileInput).prev('label').clone();
                var file_name = $(fileInput)[0].files[0].name;
                $(fileInput).prev('label').text(file_name);

                //form data setting
                var formData = new FormData();
                formData.append('attachment', file);
                formData.append('uid', uid);

                //submitting the data
                $.ajax({
                    url: "{{ route('user.order.upload-attachment') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status) {
                            toastr.success(response.message);
                            console.log($(fileInput).parent().parent());
                            if (response.url)
                                $(fileInput).parent().parent().html(`<a href="` + response.url +
                                    `" target="_blank" download=""><i class="fa fa-download">Download</i></a>`
                                    );
                        } else {
                            $(fileInput).prev('label').text('Upload');
                            if (response.message) {
                                toastr.error(response.message)
                            } else if (response.errors) {
                                var errorData = '';
                                $.each(response.errors, function(key, value) {
                                    errorData += '<br>' + value[0];
                                });
                                toastr.error(errorData);
                            }
                        }
                    }
                });
            } else {
                toastr.error('The attachment size must not be greater than 2MB');
            }
        });
    </script>
@endpush
