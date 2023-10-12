@extends('frontend::layouts.app')
@section('title', 'Products')

@section('content')
<div id="pageWrapper" class="DashBoard InnerPage">
    <section id="proListing">
        <div class="breadCrumb">
            <div class="container">
                <ul>
                    <li>
                        <a href="javascript:void(0)">Home </a>
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
                            <select name="" id="" class="select">
                                <option value="1">In Progress</option>
                                <option value="2">Delivered</option>
                                <option value="3">ALL</option>
                            </select>
                        </div>
                    </div>
                    <div class="ltb">
                        <div class="label">Payment Mode</div>
                        <div class="display">
                            <div class="txt">Filter By</div>
                            <select name="" id="" class="select">
                                <option value="1">Crypto</option>
                                <option value="2">Direct Transfer</option>
                                <option value="3">Credit Card</option>
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
                <div class="headBxFlx flx8">
                    <div class="item">Order ID</div>
                    <div class="item">Date</div>
                    <div class="item">No. of Items</div>
                    <div class="item">Total Price</div>
                    <div class="item">Status</div>
                    <div class="item">Amount Paid</div>
                    <div class="item">Amount to be Paid</div>
                    <div class="item">Payment Mode</div>
                </div>
                <div class="detailFlx flx8">
                    <div class="accordion" id="Quatationaccordion">
                        @forelse ($orders as $order)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{ $loop->iteration }}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse{{ $loop->iteration }}" aria-expanded="false"
                                        aria-controls="collapse{{ $loop->iteration }}">
                                        <div class="item">{{ $order->uid }}</div>
                                        <div class="item">{{ $order->order_received_date }}</div>
                                        <div class="item">{{ $order->orderDetails->count() }}</div>
                                        <div class="item">{{ $order->priceWithSymbol($order->converted_grand_total) }}
                                        </div>
                                        <div class="item">
                                            <div class="status {{ $order->status_class }}">
                                                {{ $order->orderStatus->title }}</div>
                                        </div>
                                        <div class="item">
                                            {{ $order->priceWithSymbol($order->converted_received_amount) }}</div>
                                        <div class="item">
                                            {{ $order->priceWithSymbol($order->converted_amount_to_be_paid) }}</div>
                                        <div class="item">{{ $order->payment->title }}</div>
                                    </button>
                                </h2>
                                <div id="collapse{{ $loop->iteration }}" class="accordion-collapse collapse "
                                    aria-labelledby="heading{{ $loop->iteration }}"
                                    data-bs-parent="#Quatationaccordion">
                                    <div class="accordion-body">
                                        <div class="title">Order ID: {{ $order->uid }}</div>
                                        <div class="table-responsive">
                                            <table>
                                                <thead>
                                                    <th>Product Name</th>
                                                    <th>Product Code</th>
                                                    <th>SKU</th>
                                                    <th>Specifications</th>
                                                    <th>Quantity</th>
                                                    <th>Price</th>
                                                </thead>
                                                <tbody>
                                                    @foreach ($order->orderDetails as $order_detail)
                                                        <tr>
                                                            <td>{{ $order_detail->orderProduct->title }}</td>
                                                            <td>{{ $order_detail->orderProduct->product_code }}</td>
                                                            <td>{{ $order_detail->orderProduct->sku }}</td>
                                                            <td>{{ $order_detail->orderProduct->specification }}</td>
                                                            <td>{{ $order_detail->quantity }}</td>
                                                            <td>{{ $order_detail->priceWithSymbol($order_detail->converted_product_total_bid_price) }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            No Orders Found...
                        @endforelse
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
