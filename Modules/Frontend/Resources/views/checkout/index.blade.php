@extends('frontend::layouts.app')
@section('title', 'Checkout')

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
                            <a href="javascript:void(0)">Checkout</a>
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
                                                data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                                aria-expanded="false" aria-controls="collapseOne">
                                                <div class="item">{{ $quotation->uid }}</div>
                                                <div class="item">{{ $quotation->acceptedQuotationDetails->count() }}
                                                </div>
                                                <div class="item">
                                                    {{ $quotation->priceWithSymbol($quotation->total_bid_price) }}
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
                                                            <th>Total Price</th>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($quotation->acceptedQuotationDetails as $quotation_detail)
                                                                <tr>
                                                                    <td>{{ $quotation_detail->product->title }}</td>
                                                                    <td>{{ $quotation_detail->product->product_code }}</td>
                                                                    <td>{{ $quotation_detail->product->sku }}</td>
                                                                    <td>{{ $quotation_detail->product->specification }}
                                                                    </td>
                                                                    <td>{{ $quotation_detail->quantity }}</td>
                                                                    <td>{{ $quotation_detail->priceWithSymbol($quotation_detail->converted_admin_approved_price) }}
                                                                    </td>
                                                                    <td>{{ $quotation_detail->priceWithSymbol($quotation_detail->converted_product_total_bid_price) }}
                                                                    </td>
                                                                </tr>
                                                            @endforeach
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
                                                    <div class="ordrId"><span>Order ID: </span>{{ $quotation->uid }}
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
                                                    <li><span>No. of
                                                            Items:</span>{{ $quotation->acceptedQuotationDetails->count() }}
                                                    </li>
                                                    <li><span>Total
                                                            Amount:</span>{{ $quotation->priceWithSymbol($quotation->converted_total_bid_price) }}
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

                                                            @foreach ($quotation->acceptedQuotationDetails as $quotation_detail)
                                                                <ul>
                                                                    <li><span>Product
                                                                            Name:</span>{{ $quotation_detail->product->title }}
                                                                    </li>
                                                                    <li><span>Product
                                                                            Code:</span>{{ $quotation_detail->product->product_code }}
                                                                    </li>
                                                                    <li><span>Qty:</span>{{ $quotation_detail->quantity }}
                                                                    </li>
                                                                    <li><span>Price:</span>{{ $quotation_detail->priceWithSymbol($quotation_detail->converted_admin_approved_price) }}
                                                                    </li>
                                                                    <li><span>Total
                                                                            Price:</span>{{ $quotation_detail->priceWithSymbol($quotation_detail->converted_product_total_bid_price) }}
                                                                    </li>
                                                                    <li><span>Specifications:</span>Lorem ipsum dolor sit
                                                                        amet
                                                                    </li>
                                                                </ul>
                                                            @endforeach

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
                            <div class="tab-pane fade show active" id="home" role="tabpanel"
                                aria-labelledby="home-tab">
                                <div class="AddressFlx">
                                    <div class="ltB">
                                        @foreach ($billing_addresses as $billing_address)
                                            <div class="item">
                                                <div class="adresBox">
                                                    <input type="radio" id="add{{ $loop->iteration }}"
                                                        name="billing_address"
                                                        {{ $billing_address->is_default ? 'checked' : '' }}>
                                                    <label for="add1">
                                                        <div class="topBFlx">
                                                            <div class="dfault">
                                                                <img src="{{ asset('frontend/images/dflt.svg') }}"
                                                                    alt="">
                                                            </div>
                                                            <div class="rtB">
                                                                <a href="javascript:void(0)" class="edit">
                                                                    <img src="{{ asset('frontend/images/edit.svg') }}"
                                                                        alt="">
                                                                </a>
                                                                <a href="javascript:void(0)" class="dlt">
                                                                    <img src="{{ asset('frontend/images/delete.svg') }}"
                                                                        alt="">
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="txtBx">
                                                            <div class="name">{{ $billing_address->full_name }}</div>
                                                            <div class="addres">{{ $billing_address->full_address }},
                                                                <br>{{ $billing_address->state->title }},
                                                                {{ $billing_address->country->title }}
                                                            </div>
                                                            <div class="tele">Mobile:
                                                                <span>{{ $billing_address->phone_number }}</span>
                                                            </div>
                                                            <div class="tele">Email:
                                                                <span>{{ $billing_address->email }}</span>
                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="rtB">
                                        <div class="newAdress">
                                            <a href="javascript:void(0)" data-bs-toggle="collapse"
                                                data-bs-target="#BillingAddAddress" aria-expanded="false"
                                                aria-controls="BillingAddAddress">
                                                <div class="icon">+</div>
                                                <div class="ttxc">Add New Address</div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item addAddress">
                                    <div id="BillingAddAddress" class="accordion-collapse collapse"
                                        data-bs-parent="#BillingAddAddressAcord">
                                        <div class="accordion-body">
                                            <form action="" method="post">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="Name"
                                                                name="Name" placeholder="Name" required="">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="Email"
                                                                name="Email" placeholder="Email" required="">
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
                                                            <textarea name="Address" class="form-control" id="Address" cols="30" placeholder="Address" rows="10"></textarea>
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
                                        @foreach ($shipping_addresses as $shipping_address)
                                            <div class="item">
                                                <div class="adresBox">
                                                    <input type="radio"
                                                        id="add{{ $billing_addresses->count() + $loop->iteration }}"
                                                        name="shipping_address"
                                                        {{ $shipping_address->is_default ? 'checked' : '' }}>
                                                    <label for="add1">
                                                        <div class="topBFlx">
                                                            <div class="dfault">
                                                                <img src="{{ asset('frontend/images/dflt.svg') }}"
                                                                    alt="">
                                                            </div>
                                                            <div class="rtB">
                                                                <a href="javascript:void(0)" class="edit">
                                                                    <img src="{{ asset('frontend/images/edit.svg') }}"
                                                                        alt="">
                                                                </a>
                                                                <a href="javascript:void(0)" class="dlt">
                                                                    <img src="{{ asset('frontend/images/delete.svg') }}"
                                                                        alt="">
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="txtBx">
                                                            <div class="name">{{ $shipping_address->full_name }}</div>
                                                            <div class="addres">{{ $shipping_address->full_address }},
                                                                <br>{{ $shipping_address->state->title }},
                                                                {{ $shipping_address->country->title }}
                                                            </div>
                                                            <div class="tele">Mobile:
                                                                <span>{{ $shipping_address->phone_number }}</span>
                                                            </div>
                                                            <div class="tele">Email:
                                                                <span>{{ $shipping_address->email }}</span>
                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="rtB">
                                        <div class="newAdress">
                                            <a href="javascript:void(0)" data-bs-toggle="collapse"
                                                data-bs-target="#ShippingAddAddress" aria-expanded="false"
                                                aria-controls="ShippingAddAddress">
                                                <div class="icon">+</div>
                                                <div class="ttxc">Add New Address</div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item addAddress">
                                    <div id="ShippingAddAddress" class="accordion-collapse collapse"
                                        data-bs-parent="#ShippingAddAddressAcord">
                                        <div class="accordion-body">
                                            <form action="" method="post">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <input type="text" id="" class="form-control"
                                                                placeholder="First Name*" name="first_name">
                                                        </div>
                                                        @error('first_name')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <input type="text" id="" class="form-control"
                                                                placeholder="Last Name*" name="last_name">
                                                        </div>
                                                        @error('last_name')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <input type="text" id="" class="form-control"
                                                                placeholder="Address*" name="address_one">
                                                        </div>
                                                        @error('address_one')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <input type="text" id="" class="form-control"
                                                                placeholder="Address2" name="address_two">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <input type="email" id="" class="form-control"
                                                                placeholder="Email*" name="email">
                                                        </div>
                                                        @error('email')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <input type="text" id="" class="form-control"
                                                                placeholder="Phone Number*" name="phone_number">
                                                        </div>
                                                        @error('phone_number')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-lg-4 col-sm-6">
                                                        <div class="form-group">
                                                            <input type="text" id="" class="form-control"
                                                                placeholder="City*" name="city">
                                                        </div>
                                                        @error('city')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-lg-4 col-sm-6">
                                                        <div class="form-group">
                                                            <select class="select country" data-select2-id="select2-Due1"
                                                                aria-label="Default select example" name="country">
                                                                <option selected value="" disabled>Country*</option>
                                                                @foreach ($countries as $country)
                                                                    <option value="{{ $country->id }}">
                                                                        {{ $country->title }}</option>
                                                                @endforeach
                                                            </select>

                                                        </div>
                                                        @error('country')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <input type="text" id="" class="form-control"
                                                                placeholder="Zip Code*" name="zip_code">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <select class="select" data-select2-id="select2-Due2"
                                                                aria-label="Default select example" name="state"
                                                                id="state">
                                                                <option selected value="" disabled>State*</option>
                                                            </select>
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
                        </div>

                        <div class="paymentBx">
                            <div class="Title">Select Payment Method</div>
                            <div class="paymentBox">
                                <ul>
                                    @foreach ($payment_methods as $payment_method)
                                        <li>
                                            <div class="rdBtn">
                                                <input type="radio" id="p{{ $loop->iteration }}" name="payment"
                                                    {{ $loop->first ? 'checked' : '' }}>
                                                <label for="p{{ $loop->iteration }}">
                                                    <div class="label">
                                                        <div class="icon">
                                                            <img src="{{ $payment_method->image_value }}" alt="cards">
                                                        </div>
                                                        {{ $payment_method->title }}
                                                    </div>
                                                </label>
                                            </div>
                                        </li>
                                        @if ($payment_method->description)
                                            <div class="bankAddress">
                                                {{ $payment_method->description }}
                                            </div>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="ritBx">
                        <div class="title">Price Details</div>
                        <ul>
                            <li>
                                <div class="lt">Price ({{ $quotation->acceptedQuotationDetails->count() }} Items)
                                    @if ($site_settings->tax_name && ($site_settings->tax_percentage || $site_settings->tax_amount))
                                        <span>{{ $site_settings->tax_name }}
                                            ({{ $site_settings->tax_percentage ? $site_settings->tax_percentage . '%' : '' }})
                                            {{ $site_settings->tax_amount ? ' +' . $site_settings->tax_amount . 'AED' : '' }}</span>
                                    @endif
                                </div>
                                <div class="rt">
                                    {{ $quotation->priceWithSymbol($quotation->converted_total_bid_price) }}
                                    <span>
                                        @if ($total_tax_amount != 0)
                                            @currencySymbolWithConvertedPrice($total_tax_amount)
                                        @endif
                                    </span>
                                </div>
                            </li>
                            <li></li>
                            <li class="total">
                                <div class="lt">Total</div>
                                <div class="rt">
                                    {{ $quotation->priceWithSymbol($quotation->converted_total_bid_price + $total_tax_amount) }}
                                </div>
                            </li>
                            <li>
                                {{--
                            <div class="lt"><span>Minimum amount<br>
                                    to be paid (10%)</span></div>
                            <div class="rt">
                                $509.00
                            </div> --}}
                            </li>
                        </ul>
                        {{-- <div class="txt"><span>Delivery by9 Sep, Saturday</span> if ordered before 5:39 PM</div> --}}
                        <div class="agree">
                            <input type="checkbox" id="a2" name="c2" value="" required="">
                            <label for="a2">*I agree to the <a href="{{ route('terms-and-conditions') }}">Terms and
                                    Conditions</a>.
                            </label>
                        </div>
                        <div class="buttonFlx">
                            <div class="item w100">
                                <button type="submit" class="confirm hoveranim"><span>MAke Payment</span></button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>




    </div>

@endsection

@push('js')
    <script>
        $('.country').change(function() {
            var selectedCountry = $(".country option:selected").val();
            $.ajax({
                type: "GET",
                url: "/select-state",
                data: {
                    countryId: selectedCountry
                },
                dataType: "json",
                success: function(result) {
                    console.log(result);
                    $('#state').empty();
                    var state_id = '';
                    @if (old('state'))
                        state_id = '{{ old('state') }}';
                    @endif
                    $('#state').append('<option selected value=""> State* </option>');
                    var selected_value = '';
                    $.each(result, function(key, value) {
                        if (state_id == value.id)
                            var selected_value = 'selected';
                        $('#state').append('<option ' + selected_value + ' value= ' + value.id +
                            ' > ' + value.title + ' </option>');
                    });
                }

            });
        });
    </script>
@endpush
