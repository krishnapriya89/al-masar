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
                                                                    <td>{{ $quotation_detail->product->product_code }}
                                                                    </td>
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
                                                                    <li><span>Specifications:</span>{{ $quotation_detail->specification }}
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
                                    <div class="ltB billing-address-div">
                                        @include('frontend::includes.billing-address-list')
                                    </div>
                                    <div class="rtB">
                                        <div class="newAdress">
                                            <a href="javascript:void(0)" class="billing-address-accordion">
                                                <div class="icon">+</div>
                                                <div class="ttxc">Add New Address</div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item addAddress">
                                    <div id="BillingAddAddress"
                                        class="accordion-collapse collapse {{ $billing_addresses->count() == 0 ? 'show' : '' }}"
                                        data-bs-parent="#BillingAddAddressAcord">
                                        <div class="accordion-body">
                                            @include('frontend::includes.billing-address-form')
                                        </div>
                                    </div>
                                </div>
                                <div class="agree">
                                    <input type="checkbox" class="billing_shipping_same" id="billing_shipping_same"
                                        name="billing_shipping_same">
                                    <label for="billing_shipping_same">My billing and shipping address are the same
                                    </label>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="AddressFlx">
                                    <div class="ltB shipping-address-div">
                                        @include('frontend::includes.shipping-address-list')
                                    </div>
                                    <div class="rtB shipping-add-new-address-div">
                                        <div class="newAdress">
                                            <a href="javascript:void(0)" class="shipping-address-accordion">
                                                <div class="icon">+</div>
                                                <div class="ttxc">Add New Address</div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item addAddress">
                                    <div id="ShippingAddAddress"
                                        class="accordion-collapse collapse {{ $shipping_addresses->count() == 0 ? 'show' : '' }}"
                                        data-bs-parent="#ShippingAddAddressAcord">
                                        <div class="accordion-body">
                                            @include('frontend::includes.shipping-address-form')
                                        </div>
                                    </div>
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
                                                <input type="radio" id="p{{ $loop->iteration }}" name="payment_method"
                                                    {{ $loop->first ? 'checked' : '' }} value="{{ $payment_method->id }}">
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
                            <li class="">
                                <div class="lt">Price ({{ $quotation->acceptedQuotationDetails->count() }} Items)
                                </div>
                                <div class="rt">
                                    {{ $quotation->priceWithSymbol($quotation->converted_total_bid_price) }}
                                </div>
                            </li>
                            <li class="tax-details-li">
                                @if ($total_tax_amount > 0)
                                    <div class="lt">
                                        <span>
                                            @if ($site_settings->tax_name && ($site_settings->tax_percentage || $site_settings->tax_amount))
                                                {{ $site_settings->tax_name }}
                                                ({{ $site_settings->tax_percentage ? $site_settings->tax_percentage . '%' : '' }})
                                                {{ $site_settings->tax_amount ? ' + ' . $quotation->priceWithSymbol($site_settings->tax_amount) : '' }}
                                            @endif
                                        </span>
                                    </div>
                                    <div class="rt">
                                        <span>{{ $quotation->priceWithSymbol($total_tax_amount * $quotation->currency_rate) }}</span>
                                    </div>
                                @endif
                            </li>
                            <li></li>
                            <li class="total">
                                <div class="lt">Total</div>
                                <div class="rt  total-amount-div">
                                    {{ $quotation->priceWithSymbol($quotation->converted_total_bid_price + $total_tax_amount * $quotation->currency_rate) }}
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
                            <form action="{{ route('checkout.submission') }}" id="CheckoutForm" method="POST">
                                @csrf
                            <input type="hidden" name="selected_billing_address">
                            <input type="hidden" name="selected_shipping_address">
                            <input type="hidden" name="selected_billing_shipping_same">
                            <input type="hidden" name="selected_payment_method">
                            <input type="hidden" name="quotation_uid" value="{{ $quotation->uid }}">
                            <div class="agree">
                                <input type="checkbox" id="terms_and_condition" name="terms_and_condition">
                                <label for="terms_and_condition">*I agree to the <a href="{{ route('terms-and-conditions') }}" target="_blank">Terms
                                        and
                                        Conditions.</a>
                                </label>
                            </div>
                            <div class="buttonFlx">
                                <div class="item w100">
                                    <button type="button" class="confirm hoveranim checkout-form-btn"><span>MAke
                                            Payment</span></button>
                                </div>
                            </div>
                        </form>
                        <div class="checkout-form-error-span">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('js')
    <script>
        //select state of billing address
        $('body').on('change', '.billing-country', function() {
            var selectedCountry = $(".billing-country option:selected").val();
            $.ajax({
                type: "GET",
                url: "/select-state",
                data: {
                    countryId: selectedCountry
                },
                dataType: "json",
                success: function(result) {
                    $('.billing_state').empty();
                    $('.billing_state').append('<option selected value=""> State* </option>');
                    $.each(result, function(key, value) {
                        $('.billing_state').append('<option value= ' + value.id +
                            ' > ' + value.title + ' </option>');
                    });
                }
            });
        });
        //select state of shipping address
        $('body').on('change', '.shipping-country', function() {
            var selectedCountry = $(".shipping-country option:selected").val();
            $.ajax({
                type: "GET",
                url: "/select-state",
                data: {
                    countryId: selectedCountry
                },
                dataType: "json",
                success: function(result) {
                    $('.shipping_state').empty();
                    $('.shipping_state').append('<option selected value=""> State* </option>');
                    $.each(result, function(key, value) {
                        $('.shipping_state').append('<option value= ' + value.id +
                            ' > ' + value.title + ' </option>');
                    });
                }
            });
        });
        //billing address form submission both create and update
        var billingDebounceTimer;
        $('body').on('click', '.billing-address-submit', function(e) {
            clearTimeout(billingDebounceTimer);
            e.preventDefault();
            var _this = $(this);
            _this.prop('disabled', true);
            var form = document.getElementById("BillingForm");
            var action = $('#BillingForm').attr('action');
            let formData = new FormData(form);
            billingDebounceTimer = setTimeout(function() {
                $.ajax({
                        type: 'POST',
                        url: action,
                        data: formData,
                        contentType: false,
                        processData: false,
                        beforeSend: function() {
                            $('#BillingForm').find('input, select, textarea').removeClass(
                                'is-invalid');
                            $('.invalid-feedback').remove();
                        }
                    })
                    .done(function(response) {
                        if (response.status) {
                            $('#BillingForm')[0].reset();
                            $('.shipping-country').val('').trigger("change");
                            _this.prop("disabled", false);
                            $('.accordion-item #BillingAddAddress').removeClass('show')
                            $('.billing-address-div').empty().html(response.address);
                            toastr.success('Billing Address created successfully');
                        } else {
                            toastr.error('Something went wrong');
                        }
                    })
                    .fail(function(response) {
                        _this.prop("disabled", false);
                        $.each(response.responseJSON.errors, function(field_name, error) {
                            var msg = '<span class="error invalid-feedback" for="' +
                                field_name + '">' + error + '</span>';
                            $("#BillingForm").find('input[name="' + field_name +
                                    '"], select[name="' + field_name + '"], textarea[name="' +
                                    field_name + '"]')
                                .removeClass('is-valid').addClass('is-invalid').attr(
                                    "aria-invalid", "true").after(msg);
                        });
                    });
            }, 300);
        });
        //shipping address form submission both create and update
        var shippingDebounceTimer;
        $('body').on('click', '.shipping-address-submit', function(e) {
            clearTimeout(shippingDebounceTimer);
            e.preventDefault();
            var _this = $(this);
            _this.prop('disabled', true);
            var form = document.getElementById("ShippingForm");
            let formData = new FormData(form);
            var action = $('#ShippingForm').attr('action');
            shippingDebounceTimer = setTimeout(function() {
                $.ajax({
                        type: 'POST',
                        url: action,
                        data: formData,
                        contentType: false,
                        processData: false,
                        beforeSend: function() {
                            $('#ShippingForm').find('input, select, textarea').removeClass(
                                'is-invalid');
                            $('.invalid-feedback').remove();
                        }
                    })
                    .done(function(response) {
                        if (response.status) {
                            $('#ShippingForm')[0].reset();
                            $('.shipping-country').val('').trigger("change");
                            _this.prop("disabled", false);
                            $('.accordion-item #ShippingAddAddress').removeClass('show')
                            $('.shipping-address-div').empty().html(response.address);
                            toastr.success('Shipping Address created successfully');
                        } else {
                            toastr.error('Something went wrong');
                        }
                    })
                    .fail(function(response) {
                        _this.prop("disabled", false);
                        $.each(response.responseJSON.errors, function(field_name, error) {
                            var msg = '<span class="error invalid-feedback" for="' +
                                field_name + '">' + error + '</span>';
                            $("#ShippingForm").find('input[name="' + field_name +
                                    '"], select[name="' + field_name + '"], textarea[name="' +
                                    field_name + '"]')
                                .removeClass('is-valid').addClass('is-invalid').attr(
                                    "aria-invalid", "true").after(msg);
                        });
                    });
            }, 300);
        });
        //billing address create accordion
        $('.billing-address-accordion').click(function(e) {
            var renderedContent = `@php echo addslashes(view('frontend::includes.billing-address-form', compact('countries'))->render()); @endphp`;
            $('#BillingAddAddress .accordion-body').html(renderedContent);
            $('#BillingAddAddress .accordion-body #BillingForm').attr('action',
                '{{ route('store-billing-address', '') }}');
            $('#BillingAddAddress').addClass('show');
        });
        //shipping address create accordion
        $('.shipping-address-accordion').click(function(e) {
            var renderedContent = `@php echo addslashes(view('frontend::includes.shipping-address-form', compact('countries'))->render()); @endphp`;
            $('#ShippingAddAddress .accordion-body').html(renderedContent);
            $('#ShippingAddAddress .accordion-body #ShippingForm').attr('action',
                '{{ route('store-shipping-address', '') }}');
            $('#ShippingAddAddress').addClass('show');
        });
        //billing address edit get form
        var editBillingDebounceTimer;
        $('body').on('click', '.checkout-edit-billing-address', function(e) {
            clearTimeout(editBillingDebounceTimer);
            e.preventDefault();
            var _this = $(this);
            _this.prop('disabled', true);
            let id = _this.data('id');
            editBillingDebounceTimer = setTimeout(function() {
                $.ajax({
                    type: "GET",
                    url: "/get-address-data",
                    data: {
                        id: id,
                        type: 1
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.status) {
                            _this.prop('disabled', false);
                            $('#BillingAddAddress .accordion-body').html(response.address);
                            $('#BillingAddAddress .accordion-body #BillingForm').attr('action',
                                '{{ route('update-billing-address', '') }}/' + id);
                            $('#BillingAddAddress').addClass('show');
                        }
                    }
                });
            }, 300);
        });
        //shipping address edit get form
        var editShippingDebounceTimer;
        $('body').on('click', '.checkout-edit-shipping-address', function(e) {
            clearTimeout(editShippingDebounceTimer);
            e.preventDefault();
            var _this = $(this);
            _this.prop('disabled', true);
            let id = _this.data('id');
            editShippingDebounceTimer = setTimeout(function() {
                $.ajax({
                    type: "GET",
                    url: "/get-address-data",
                    data: {
                        id: id,
                        type: 2
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.status) {
                            _this.prop('disabled', false);
                            $('#ShippingAddAddress .accordion-body').html(response.address);
                            $('#ShippingAddAddress .accordion-body #ShippingForm').attr(
                                'action', '{{ route('update-shipping-address', '') }}/' +
                                id);
                            $('#ShippingAddAddress').addClass('show');
                        }
                    }
                });
            }, 300);
        });
        //check tax value of shipping address
        $('body').on('click', '.shipping_address', function(e) {
            var address_id = $(this).data('id');
            checkTaxApplicableForTax(address_id);
        });
        //check tax value of a address if same as billing
        $('body').on('click', '.billing_address', function(e) {
            if($('input[name=billing_shipping_same]:checked').val()) {
                var address_id = $(this).data('id');
                checkTaxApplicableForTax(address_id);
            }
        });

        //same as billing - functionality
        $('.billing_shipping_same').change(function() {
            if ($(this).prop('checked') == true) {
                $('.shipping-address-div').hide();
                $('.shipping-add-new-address-div').hide();
                var billingInput = $('input[name=billing_address]:checked');
                if (billingInput.length > 0) {
                    checkTaxApplicableForTax(billingInput.val());
                } else {
                    $('.tax-details-li').empty();
                }
            } else {
                $('.shipping-address-div').show();
                $('.shipping-add-new-address-div').show();
                var shippingInput = $('input[name=shipping_address]:checked');
                if (shippingInput.length > 0) {
                    checkTaxApplicableForTax(shippingInput.val());
                } else {
                    $('.tax-details-li').empty();
                }
            }
        });

        //checking tax changing shipping address or same as billing
        function checkTaxApplicableForTax(address_id) {
            $.ajax({
                type: "GET",
                url: "{{ route('check-tax-applicable-for-address') }}",
                data: {
                    address_id: address_id,
                    quotation_uid: '{{ $quotation->uid }}'
                },
                dataType: "json",
                success: function(response) {
                    $('.tax-details-li').empty();
                    if (response.status) {
                        var tax_percentage = '';
                        if (response.tax.tax_percentage) {
                            tax_percentage += ' (' + response.tax.tax_percentage + '%)';
                        }
                        var tax_value = '';
                        if (response.converted_tax_value) {
                            tax_value += ' + ' + response.converted_tax_value;
                        }

                        $('.tax-details-li').html(`
                        <div class="lt">
                            <span>
                                ` + response.tax.tax_name + tax_percentage + tax_value + `
                            </span>
                        </div>
                        <div class="rt">
                            <span>` + response.converted_total_tax_amount + `</span>
                        </div>`);
                    }
                    $('.total-amount-div').html(response.converted_total_amount);
                }
            });
        }

        //checkout form submit
        var checkoutFormDebounceTimer;
        $('.checkout-form-btn').on('click', function(e) {
            clearTimeout(checkoutFormDebounceTimer);
            e.preventDefault();
            var _this = $(this);
            $('input[name="selected_billing_address"]').val($('input[name="billing_address"]:checked').val());
            $('input[name="selected_shipping_address"]').val($('input[name="shipping_address"]:checked').val());
            $('input[name="selected_billing_shipping_same"]').val($('input[name="billing_shipping_same"]:checked').val());
            $('input[name="selected_payment_method"]').val($('input[name="payment_method"]:checked').val());
            _this.prop('disabled', true);
            _this.html(`<span>Processing</span>`);
            var form = document.getElementById("CheckoutForm");
            let formData = new FormData(form);

            checkoutFormDebounceTimer = setTimeout(function() {
                $.ajax({
                        type: 'POST',
                        url: '{{ route('checkout.validation') }}',
                        data: formData,
                        contentType: false,
                        processData: false,
                        beforeSend: function() {
                            $('.checkout-form-error-span').empty();
                        }
                    })
                    .done(function(response) {
                        if (response.status) {
                            $('#CheckoutForm').submit();
                        } else {
                            toastr.error('Something went wrong');
                        }
                    })
                    .fail(function(response) {
                        _this.prop("disabled", false);
                        _this.html(`<span>Make Payment</span>`);
                        $.each(response.responseJSON.errors, function(field_name, error) {
                            var msg = '</br><span class="error" style="color:red;">' + error + '</span>';
                            $(".checkout-form-error-span").append(msg);
                        });
                    });
            }, 300);
        });
    </script>
@endpush
