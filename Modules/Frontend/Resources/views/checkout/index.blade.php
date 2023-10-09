@extends('frontend::layouts.app')
@section('title', 'Checkout')

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
                        <a href="{{ route('checkout') }}">Checkout</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="container">
            <div class="all_products">
                <div class="bdfgBx">
                    <div class="Stitle">Checkout</div>
                </div>
            </div>

            <div class="cmnFlxBx">
                <div class="lftBx">

                    <div class="tableAccordionBx DskTop mb30">
                        <div class="headBxFlx flx3">
                            <div class="item">Order ID</div>
                            <div class="item">No. of Items</div>
                            <div class="item">Total Amount</div>
                        </div>
                        <div class="detailFlx flx3">
                            <div class="accordion" id="Quatationaccordion">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapse{{ $loop->iteration }}"
                                                aria-expanded="false" aria-controls="collapse{{ $loop->iteration }}">
                                                <div class="item">{{ $quotation->uid }}</div>
                                                <div class="item">{{ $quotation->quotationDetails->count() }}</div>
                                                <div class="item">{{ $quotation->priceWithSymbol($quotation->total_bid_price) }}
                                                </div>
                                            </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse "
                                        aria-labelledby="headingOne" data-bs-parent="#Quatationaccordion">
                                        <div class="accordion-body">
                                            <div class="title">Order ID: AMAS0245797</div>
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
                                                        <tr>
                                                            <td>{{ $quotation_detail->product->title }}</td>
                                                            <td>{{ $quotation_detail->product->product_code }}</td>
                                                            <td>{{ $quotation_detail->product->sku }}</td>
                                                            <td>{{ $quotation_detail->product->specification }}
                                                            </td>
                                                            <td>{{ $quotation_detail->quantity }}</td>
                                                            <td>{{ $quotation_detail->priceWithSymbol($quotation_detail->converted_bid_price) }}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mobVew mb30">
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
                                                <li><span>Order ID:</span>{{ $quotation->uid }}</li>
                                                <li><span>No. of Items:</span>4</li>
                                                <li><span>Total Amount:</span> $900</li>
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
                                                            <li><span>Specifications:</span>Lorem ipsum dolor sit amet
                                                            </li>
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

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                                type="button" role="tab" aria-controls="home" aria-selected="true">Billing
                                Address</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                                type="button" role="tab" aria-controls="profile" aria-selected="false">Shipping
                                Address</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="AddressFlx">
                                <div class="ltB">
                                    <div class="item">
                                        <div class="adresBox">
                                            <input type="radio" id="add1" name="address" checked="">
                                            <label for="add1">
                                                <div class="topBFlx">
                                                    <div class="dfault">
                                                        <img src="assets/images/dflt.svg" alt="">
                                                    </div>
                                                    <div class="rtB">
                                                        <a href="javascript:void(0)" class="edit">
                                                            <img src="assets/images/edit.svg" alt="">
                                                        </a>
                                                        <a href="javascript:void(0)" class="dlt">
                                                            <img src="assets/images/delete.svg" alt="">
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="txtBx">
                                                    <div class="name">Jozin Jose</div>
                                                    <div class="addres">Box No. 236847, Al Fujayrah, <br>Emirates</div>
                                                    <div class="tele">Mobile: <span>+914 25656565</span></div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="adresBox">
                                            <input type="radio" id="add2" name="address">
                                            <label for="add2">
                                                <div class="topBFlx">
                                                    <div class="dfault">
                                                        <img src="assets/images/dflt.svg" alt="">
                                                    </div>
                                                    <div class="rtB">
                                                        <a href="javascript:void(0)" class="edit">
                                                            <img src="assets/images/edit.svg" alt="">
                                                        </a>
                                                        <a href="javascript:void(0)" class="dlt">
                                                            <img src="assets/images/delete.svg" alt="">
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="txtBx">
                                                    <div class="name">Jozin Jose</div>
                                                    <div class="addres">Box No. 236847, Al Fujayrah, <br>Emirates</div>
                                                    <div class="tele">Mobile: <span>+914 25656565</span></div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="rtB">
                                    <div class="newAdress">
                                        <a href="javascript:void(0)" data-bs-toggle="collapse"
                                            data-bs-target="#AddAddress" aria-expanded="false"
                                            aria-controls="AddAddress">
                                            <div class="icon">+</div>
                                            <div class="ttxc">Add New Address</div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item addAddress">
                                <div id="AddAddress" class="accordion-collapse collapse"
                                    data-bs-parent="#AddAddressAcord">
                                    <div class="accordion-body">
                                        <form action="" method="post">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="Name" name="Name"
                                                            placeholder="Name" required="">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="Email" name="Email"
                                                            placeholder="Email" required="">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="Mobile Number"
                                                            placeholder="Mobile Number" name="Mobile Number"
                                                            required="">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <textarea name="Address" class="form-control" id="Address"
                                                            cols="30" placeholder="Address" rows="10"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn-submit hoveranim">
                                                <span>Save address</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="agree">
                                <input type="checkbox" id="a1" name="c1" value="" required="">
                                <label for="a1">My billing and shipping address are the same
                                </label>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="AddressFlx">
                                <div class="ltB">
                                    <div class="item">
                                        <div class="adresBox">
                                            <input type="radio" id="add3" name="address">
                                            <label for="add3">
                                                <div class="topBFlx">
                                                    <div class="dfault">
                                                        <img src="assets/images/dflt.svg" alt="">
                                                    </div>
                                                    <div class="rtB">
                                                        <a href="javascript:void(0)" class="edit">
                                                            <img src="assets/images/edit.svg" alt="">
                                                        </a>
                                                        <a href="javascript:void(0)" class="dlt">
                                                            <img src="assets/images/delete.svg" alt="">
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="txtBx">
                                                    <div class="name">Jozin Jose</div>
                                                    <div class="addres">Box No. 236847, Al Fujayrah, <br>Emirates</div>
                                                    <div class="tele">Mobile: <span>+914 25656565</span></div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="adresBox">
                                            <input type="radio" id="add4" name="address">
                                            <label for="add4">
                                                <div class="topBFlx">
                                                    <div class="dfault">
                                                        <img src="assets/images/dflt.svg" alt="">
                                                    </div>
                                                    <div class="rtB">
                                                        <a href="javascript:void(0)" class="edit">
                                                            <img src="assets/images/edit.svg" alt="">
                                                        </a>
                                                        <a href="javascript:void(0)" class="dlt">
                                                            <img src="assets/images/delete.svg" alt="">
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="txtBx">
                                                    <div class="name">Jozin Jose</div>
                                                    <div class="addres">Box No. 236847, Al Fujayrah, <br>Emirates</div>
                                                    <div class="tele">Mobile: <span>+914 25656565</span></div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="rtB">
                                    <div class="newAdress">
                                        <a href="javascript:void(0)" data-bs-toggle="collapse"
                                            data-bs-target="#AddAddress" aria-expanded="false"
                                            aria-controls="AddAddress">
                                            <div class="icon">+</div>
                                            <div class="ttxc">Add New Address</div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="agree">
                                <input type="checkbox" id="a1" name="c1" value="" required="">
                                <label for="a1">My billing and shipping address are the same
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="paymentBx">
                        <div class="Title">Select Payment Method</div>
                        <div class="paymentBox">
                            <ul>
                                <li>
                                    <div class="rdBtn">
                                        <input type="radio" id="p1" name="payment" checked="">
                                        <label for="p1">
                                            <div class="label">
                                                <div class="icon">
                                                    <img src="assets/images/pay1.png" alt="cards">
                                                </div>
                                                Cryptocurrency
                                            </div>
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="rdBtn">
                                        <input type="radio" id="p2" name="payment">
                                        <label for="p2">
                                            <div class="label">
                                                <div class="icon">
                                                    <img src="assets/images/pay2.png" alt="cod">
                                                </div>
                                                Paypal
                                            </div>
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="rdBtn">
                                        <input type="radio" id="p3" name="payment">
                                        <label for="p3">
                                            <div class="label">
                                                <div class="icon">
                                                    <img src="assets/images/pay3.png" alt="cod">
                                                </div>
                                                Credit Card /debit card
                                            </div>
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="rdBtn">
                                        <input type="radio" id="p4" name="payment">
                                        <label for="p4">
                                            <div class="label">
                                                <div class="icon">
                                                    <img src="assets/images/pay4.png" alt="cod">
                                                </div>
                                                Bank Trasfer
                                            </div>
                                        </label>
                                    </div>
                                </li>
                            </ul>
                            <div class="bankAddress">
                                Bank: Bank of America, NA, 555 California St,
                                San Francisco, CA 94104
                                Business Name: Lizheng Stainless Steel Tube and
                                Coil Corp Business Address: 3902 Henderson Blvd,
                                Suite 208-207, Tampa, Florida, 33629
                                Swift #: BOFAUS3N
                                Account #: 898037918555
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ritBx">
                    <div class="title">Price Details</div>
                    <ul>
                        <li>
                            <div class="lt">Price (3 Items) <span>VAT (5%)</span></div>
                            <div class="rt">$4690.00 <span>$350.00</span></div>
                        </li>
                        <br>
                        <br>
                        <li>
                            <div class="lt">Delivery Fee</div>
                            <div class="rt"><span>$ 50.00</span></div>
                        </li>
                        <li class="total">
                            <div class="lt">Total</div>
                            <div class="rt">$5090.00</div>
                        </li>
                        <li>
                            <div class="lt"><span>Minimum amount<br>
                                    to be paid (10%)</span></div>
                            <div class="rt">
                                $509.00
                            </div>
                        </li>
                    </ul>
                    <div class="txt"><span>Delivery by9 Sep, Saturday</span> if ordered before 5:39 PM</div>
                    <div class="agree">
                        <input type="checkbox" id="a2" name="c2" value="" required="">
                        <label for="a2">*I agree to the <a href="PrivacyPolicy.php">Terms and Conditions</a>.
                        </label>
                    </div>
                    <div class="buttonFlx">
                        <div class="item w100">
                            <button type="" class="confirm hoveranim"><span>MAke Payment</span></button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>




</div>