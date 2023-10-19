@extends('frontend::layouts.app')
@section('title', 'Add Billing Address')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        label.error {
            color: #dc3545;
            font-size: 14px;
        }
    </style>
@endpush
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
                            <a href="{{ route('address') }}"> Address</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"> Add Billing Address</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="container">
                <div class="dashBoardFlx">
                    @include('frontend::includes.sidebar')
                    <div class="rtBx">
                        <div class="addressFormBx">
                            <div class="formBx">
                                <div class="title">Add Billing Address</div>
                                <form action="{{ route('store-billing-address') }}" method="post" id="billingForm">
                                    @csrf
                                    <div class="row">
                                        <input type="hidden" name="type" value="1">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" id="" class="form-control"
                                                    placeholder="First Name*" name="first_name">
                                            </div>
                                            @error('first_name')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" id="" class="form-control"
                                                    placeholder="Last Name*" name="last_name">
                                            </div>
                                            @error('last_name')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <input type="text" id="" class="form-control"
                                                    placeholder="Address*" name="address_one">
                                            </div>
                                            @error('address_one')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <input type="text" id="" class="form-control"
                                                    placeholder="Address2" name="address_two">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="email" id="" class="form-control"
                                                    placeholder="Email*" name="email">
                                            </div>
                                            @error('email')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" id="" class="form-control"
                                                    placeholder="Phone Number*" name="phone_number">
                                            </div>
                                            @error('phone_number')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="form-group">
                                                <input type="text" id="" class="form-control"
                                                    placeholder="City*" name="city">
                                            </div>
                                            @error('city')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="form-group">
                                                <select class="select2 country" data-select2-id="select2-Due1"
                                                    aria-label="Default select example" name="country">
                                                    <option selected value="" disabled>Country*</option>
                                                    @foreach ($countries as $country)
                                                        <option value="{{ $country->id }}">{{ $country->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('country')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <input type="text" id="" class="form-control"
                                                    placeholder="Zip Code*" name="zip_code">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <select class="select2" data-select2-id="select2-Due2"
                                                    aria-label="Default select example" name="state" id="state">
                                                    <option selected value="" disabled>State*</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="btnBx">
                                                <button class="save hoveranim" type="submit"><span>SAVE</span></button>
                                                <button class="cancel hoveranim"><span>CANCEL</span></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(".select2").select2({
            minimumResultsForSearch: 3,
            maximumSelectionLength: 3,
            theme: "bootstrap-5",
            containerCssClass: "select2--small",
            selectionCssClass: "select2--small",
            dropdownCssClass: "select2--small",
        });
        $("#billingForm").validate({
            rules: {
                first_name: "required",
                last_name: "required",
                address_one: "required",
                city: "required",
                country: "required",
                zip_code: "required",
                state: "required",
                phone_number: {
                    required: true,
                    phoneDigitsOnly: true
                },
                email: {
                    required: true,
                    email: true
                },
            },
            messages: {
                country: "Please select a country", // Customize the error message for the country field
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                element.parent().find('.invalid-feedback').html('');
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
        // Custom validation method for phone number
        $.validator.addMethod("phoneDigitsOnly", function(value, element) {
            var digitsOnly = /^\+?[0-9]{1,4}[-\s]?[0-9]{6,14}$/;
            return digitsOnly.test(value);
        }, "Please enter a valid phone number with digits only.");
        //select state
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
