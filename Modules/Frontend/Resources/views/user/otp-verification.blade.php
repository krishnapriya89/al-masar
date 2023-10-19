@extends('frontend::layouts.app')
@section('title', 'Profile Settings OTP Verification')

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
                            <a href="{{ route('user.profile') }}"> Profile Settings</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"> OTP Verification</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="container">
                <div class="otpFLxBx">
                    <div class="otpBx">
                        <div class="title">OTP Verification</div>
                        <div class="subT">Enter the OTP send to {{ str_replace('_',' ',ucwords($field,'_')) }}: <span>{{ $identifier }}</span></div>
                        <form action="{{ route('user.profile.verify-otp') }}" id="ProfileOtpForm" class="optB"
                                method="POST" autocomplete="off">
                                @csrf
                                <input class="otp" name="otp1" value="{{ old('otp1') }}" type="text"
                                    oninput='digitValidate(this)' onkeyup='tabChange(1)' maxlength=1>
                                <input class="otp" name="otp2" value="{{ old('otp2') }}" type="text"
                                    oninput='digitValidate(this)' onkeyup='tabChange(2)' maxlength=1>
                                <input class="otp" name="otp3" value="{{ old('otp3') }}" type="text"
                                    oninput='digitValidate(this)' onkeyup='tabChange(3)' maxlength=1>
                                <input class="otp" name="otp4" value="{{ old('otp4') }}" type="text"
                                    oninput='digitValidate(this)' onkeyup='tabChange(4)' maxlength=1>
                            </form>
                        <p>OTP not yet received? <a href="javascript:void(0)" class="resend profile-resend-otp-btn">RESEND OTP</a></p>
                        <button type="button" class="hoveranim btn-submit profile-otp-form-btn"><span>Verify</span></button>
                        <span class="error-span" style="color: red;">
                            @if ($errors->any())
                                Please enter otp
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('js')
    <script>
        let digitValidate = function(ele) {
            ele.value = ele.value.replace(/[^0-9]/g, '');
        }

        let tabChange = function(val) {
            let ele = document.querySelectorAll('.otp');
            if (ele[val - 1].value != '') {
                if(ele[val])
                    ele[val].focus()
            } else if (ele[val - 1].value == '') {
                if(ele[val - 2])
                    ele[val - 2].focus()
            }
        }

        var profileOtpResendDebounceTimer;
        $('.profile-resend-otp-btn').on('click', function() {
            clearTimeout(profileOtpResendDebounceTimer);

            profileOtpResendDebounceTimer = setTimeout(function() {
                $.ajax({
                    type: 'POST',
                    url: '{{ route('user.profile.otp.resend' )}}',
                    dataType: 'json',
                    success: function(response) {
                        if (response.status) {
                            if (response.message && response.message != '') {
                                toastr.success(response.message);
                            }
                            if (response.otp && response.otp != '') {
                                $('.otp-cls').html(response.otp);
                            }
                        } else {
                            if (response.message && response.message != '') {
                                toastr.error(response.message);
                            }
                            if (response.url != '') {
                                window.location.href = response.url;
                            }
                        }
                    }
                });
            });
        });

        var profileOtpVerifydebounceTimer;
        $('.profile-otp-form-btn').on('click', function(e) {
            var required = 0;
            // Loop through each input field with class "otp"
            $(".otp").each(function(index) {
                if ($(this).val() == undefined || $(this).val() == '')
                    required++;
            });

            if (required == 0) {
                clearTimeout(profileOtpVerifydebounceTimer);
                e.preventDefault();

                $(".profile-otp-form-btn").prop("disabled", true);

                var _this = $(this);
                let formData = $("#ProfileOtpForm").serialize();

                profileOtpVerifydebounceTimer = setTimeout(function() {
                    $.ajax({
                            type: 'POST',
                            url: '{{ route('user.profile.verify-otp') }}',
                            data: formData,
                            dataType: 'json',
                            beforeSend: function() {
                                $('.error-span').empty();
                            }
                        })
                        .done(function(response) {
                            $(".profile-otp-form-btn").prop("disabled", false);
                            if (response.status) {
                                if (response.message && response.message != '') {
                                    toastr.success(response.message);
                                }
                                if (response.url && response.url != '') {
                                    window.location.href = response.url;
                                }
                            } else {
                                if (response.message && response.message != '') {
                                    toastr.error(response.message);
                                }
                                if (response.url && response.url != '') {
                                    window.location.href = response.url;
                                }
                            }
                        })
                        .fail(function(response) {
                            $(".profile-otp-form-btn").prop("disabled", false);
                            if (response.responseJSON.length > 0)
                                $('.error-span').empty().html('Please enter otp');
                            setTimeout(function() {
                                $('.error-span').empty()
                            }, 1000);
                        });
                }, 300);
            } else
                $('.error-span').empty().html('Please enter otp');
        });
    </script>
@endpush
