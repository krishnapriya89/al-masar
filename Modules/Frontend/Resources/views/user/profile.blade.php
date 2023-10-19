@extends('frontend::layouts.app')
@section('title', 'Profile')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css">
    <style>
        .invalid-feedback {
            display: block !important;
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
                            <a href="javascript:void(0)">Profile Settings</a>
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
                                <div class="title">User Profile</div>
                                <form action="{{ route('user.profile.update') }}" name="ProfileForm" method="POST"
                                    id="ProfileForm" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" id="name" name="name"
                                                    value="{{ old('name', $user->name) }}"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    placeholder="Name*">
                                                @error('name')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" id="company" name="company"
                                                    value="{{ old('company', $user->company) }}"
                                                    class="form-control @error('company') is-invalid @enderror"
                                                    placeholder="Organization/Company*">
                                                @error('company')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="text" id="address" name="address"
                                                    value="{{ old('address', $user->address) }}" placeholder="Address*"
                                                    class="form-control @error('address') is-invalid @enderror">
                                                @error('address')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <select name="country" id="country"
                                                    class="select2 @error('country') is-invalid @enderror">
                                                    <option value="" selected disabled>Country*</option>
                                                    @foreach ($countries as $country)
                                                        <option value="{{ $country->id }}"
                                                            {{ old('country', $user->country_id) == $country->id ? 'selected' : '' }}>
                                                            {{ $country->title }}</option>
                                                    @endforeach
                                                </select>
                                                @error('country')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                @if ($user->email_verified)
                                                    <div class="Vfd">
                                                        <div class="icon">
                                                            <img src="{{ asset('frontend/images/vfd.svg') }}"
                                                                alt="">
                                                        </div>
                                                        Verified
                                                    </div>
                                                @else
                                                    <a href="javascript:void(0)" class="profile-field-verify-btn"
                                                        data-field="email">
                                                        <div class="ntVfd">
                                                            <div class="icon">
                                                                <img src="{{ asset('frontend/images/ntvfd.svg') }}"
                                                                    alt="">
                                                            </div>
                                                            Verify
                                                        </div>
                                                    </a>
                                                @endif
                                                <input type="text" id="email" name="email"
                                                    value="{{ old('email', $user->email) }}"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    placeholder="Mail Id*">
                                                @error('email')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                @if ($user->phone_verified)
                                                    <div class="Vfd">
                                                        <div class="icon">
                                                            <img src="{{ asset('frontend/images/vfd.svg') }}"
                                                                alt="">
                                                        </div>
                                                        Verified
                                                    </div>
                                                @else
                                                    <a href="javascript:void(0)" class="profile-field-verify-btn"
                                                        data-field="phone">
                                                        <div class="ntVfd">
                                                            <div class="icon">
                                                                <img src="{{ asset('frontend/images/ntvfd.svg') }}"
                                                                    alt="">
                                                            </div>
                                                            Verify
                                                        </div>
                                                    </a>
                                                @endif
                                                <input type="text" id="phone" name="phone"
                                                    value="{{ old('phone') ? old('phone_code') . old('phone') : $user->full_phone_number }}"
                                                    class="form-control @error('phone') is-invalid @enderror"
                                                    placeholder="Phone*">
                                                @error('phone')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <input type="hidden" name="phone_code" id="phone_code"
                                            value="{{ old('phone_code', $user->phone_code) }}">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                @if ($user->office_phone_verified)
                                                    <div class="Vfd">
                                                        <div class="icon">
                                                            <img src="{{ asset('frontend/images/vfd.svg') }}"
                                                                alt="">
                                                        </div>
                                                        Verified
                                                    </div>
                                                @else
                                                    <a href="javascript:void(0)" class="profile-field-verify-btn"
                                                        data-field="office_phone">
                                                        <div class="ntVfd">
                                                            <div class="icon">
                                                                <img src="{{ asset('frontend/images/ntvfd.svg') }}"
                                                                    alt="">
                                                            </div>
                                                            Verify
                                                        </div>
                                                    </a>
                                                @endif
                                                <input type="text" id="office_phone" name="office_phone"
                                                    value="{{ old('office_phone') ? old('office_phone_code') . old('office_phone') : $user->full_office_phone_number }}"
                                                    class="form-control @error('office_phone') is-invalid @enderror"
                                                    placeholder="Procurement Office Number*">
                                                @error('office_phone')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <input type="hidden" name="office_phone_code" id="office_phone_code"
                                            value="{{ old('office_phone_code', $user->office_phone_code) }}">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="fileUploadInput">
                                                    <label for="file-upload"
                                                        class="custom-file-upload  @error('attachment') is-invalid @enderror">
                                                        <i class="fa fa-cloud-upload"></i> Attachment
                                                    </label>
                                                    <input id="attachment" name='attachment' type="file"
                                                        class="fileInput" value="{{ $user->attachment }}" accept="image/jpeg,image/png,application/pdf">
                                                    @error('attachment')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                    <div class="iconBx">
                                                        Choose File
                                                        <svg viewBox="0 0 11.201 12">
                                                            <g id="_x38_2_attachment" transform="translate(-2.001 -1)">
                                                                <path id="Path_101992" data-name="Path 101992"
                                                                    d="M13.2,4.2a3.179,3.179,0,0,1-.937,2.263L6.5,12.3A2.4,2.4,0,1,1,3.1,8.9L7.268,4.763a1.574,1.574,0,0,1,2.216-.045,1.488,1.488,0,0,1,.433,1.109,1.629,1.629,0,0,1-.481,1.105L5.484,10.884a.4.4,0,1,1-.566-.566L8.87,6.366A.83.83,0,0,0,9.117,5.8a.7.7,0,0,0-.2-.52.774.774,0,0,0-1.086.047L3.668,9.47a1.6,1.6,0,0,0,2.264,2.262L11.7,5.9A2.4,2.4,0,1,0,8.3,2.5L2.682,8.085a.4.4,0,0,1-.564-.568L7.74,1.937A3.2,3.2,0,0,1,13.2,4.2Z" />
                                                            </g>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($user->attachment)
                                            <a href="{{ Storage::url($user->attachment) }}" target="_blank" download><i
                                                    class="fa-solid fa-download">Download Attachment</i></a>
                                        @endif
                                        <div class="col-lg-12">
                                            <div class="btnBx">
                                                <button type="submit" class="save hoveranim"><span>SAVE</span></button>
                                                <button type="button"
                                                    class="cancel hoveranim"><span>CANCEL</span></button>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput-jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            //select2 initialization
            $(".select2").select2({
                minimumResultsForSearch: 3,
                maximumSelectionLength: 3,
                theme: "bootstrap-5",
                containerCssClass: "select2--small",
                selectionCssClass: "select2--small",
                dropdownCssClass: "select2--small",
            });

            var phone_input = $("#phone");
            var office_phone_input = $("#office_phone");

            phone_input.intlTelInput({
                separateDialCode: true,
            });

            office_phone_input.intlTelInput({
                separateDialCode: true,
            });

            // Now, extract the initial country code after plugin initialization
            var initialCountryPhoneData = phone_input.intlTelInput("getSelectedCountryData");
            var initialCountryPhoneCode = initialCountryPhoneData.dialCode;
            $('#phone_code').val("+" + initialCountryPhoneCode);

            var initialCountryOfficePhoneData = office_phone_input.intlTelInput("getSelectedCountryData");
            var initialCountryOfficePhoneCode = initialCountryOfficePhoneData.dialCode;
            $('#office_phone_code').val("+" + initialCountryOfficePhoneCode);

            // Add an event listener for the "countrychange" event
            phone_input.on("countrychange", function(e) {
                let selectedCountryData = phone_input.intlTelInput("getSelectedCountryData");
                let selectedCountryCode = selectedCountryData.dialCode;
                $('#phone_code').val("+" + selectedCountryCode);
            });

            office_phone_input.on("countrychange", function(e) {
                let selectedCountryData = office_phone_input.intlTelInput("getSelectedCountryData");
                let selectedCountryCode = selectedCountryData.dialCode;
                $('#office_phone_code').val("+" + selectedCountryCode);
            });

            $('#attachment').change(function() {
                var i = $(this).prev('label').clone();
                var file = $('#attachment')[0].files[0].name;
                $(this).prev('label').text(file);
            });

            var profileOtpVerifyDebounceTimer;
            var ajaxCallMade = false;
            $('body').on('click', '.profile-field-verify-btn', function(e) {
                console.log('yes');
                e.preventDefault();
                clearTimeout(profileOtpVerifyDebounceTimer);
                var _this = $(this);
                $('.profile-field-verify-btn').bind('click', false);
                var field = _this.data('field');
                if (!ajaxCallMade) {
                    ajaxCallMade = true;
                    profileOtpVerifyDebounceTimer = setTimeout(function() {
                        $.ajax({
                            url: '{{ route('user.profile.otp.send') }}',
                            data: {
                                field: field
                            },
                            type: "get",
                            dataType: 'json',
                            success: function(response) {
                                if (response.status) {
                                    window.location.href = response.url;
                                } else {
                                    $('.profile-field-verify-btn').bind('click', true);
                                    toastr.error('Something went wrong');
                                    window.location.reload();
                                }
                            }
                        });
                    });
                }
            });
        });
    </script>
@endpush
