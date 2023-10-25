@extends('frontend::layouts.app')
@section('title', 'Phone Verification')
@section('meta_title',@$auth_page_cms->meta_title)
@section('meta_keywords',@$auth_page_cms->meta_keywords)
@section('meta_description',@$auth_page_cms->meta_description)
@section('other_meta_tags')
    {!! @$auth_page_cms->other_meta_tags !!}
@endsection
@section('content')
    <div id="pageWrapper" class="registerPage InnerPage">
        <section id="UserLogin">
            <div class="container">
                <div class="OtpFormBx">
                    <div class="flxBx">
                        <div class="lftBx">
                            <img src="{{ $auth_page_cms->image_value }}" alt="">
                        </div>
                        <div class="ritBx">
                            <div class="title">Login {{ $auth_page_cms->form_title ?? ' OTP Verification' }}</div>
                            <div class="subT">Enter the OTP send to {{ $method }}: <span>{{ $identifier }}</span>
                            </div>
                            <form action="{{ route('user.verify-login-otp') }}" id="LoginOtpForm" class="optB"
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
                            <p>OTP not yet received? <a href="javascript:void(0)" class="resend login-resend-otp-btn">RESEND
                                    OTP</a></p>
                            <button type="button"
                                class="hoveranim btn-submit login-otp-form-btn"><span>Login</span></button>
                            <span class="error-span" style="color: red;">
                                @if ($errors->any())
                                    Please enter OTP
                                @endif
                            </span>
                        </div>
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
                ele[val].focus()
            } else if (ele[val - 1].value == '') {
                ele[val - 2].focus()
            }
        }

        var loginOtpDebounceTimer;
        $('.login-resend-otp-btn').on('click', function() {
            clearTimeout(loginOtpDebounceTimer);

            loginOtpDebounceTimer = setTimeout(function() {
                $.ajax({
                    type: 'POST',
                    url: '/resend-login-otp',
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

        var debounceTimer;
        $('.login-otp-form-btn').on('click', function(e) {
            var required = 0;
            // Loop through each input field with class "otp"
            $(".otp").each(function(index) {
                if ($(this).val() == undefined || $(this).val() == '')
                    required++;
            });

            if (required == 0) {

                clearTimeout(debounceTimer);
                e.preventDefault();

                $(".login-otp-form-btn").prop("disabled", true);

                var _this = $(this);
                let formData = $("#LoginOtpForm").serialize();
                debounceTimer = setTimeout(function() {
                    $.ajax({
                            type: 'POST',
                            url: '{{ route('user.verify-login-otp') }}',
                            data: formData,
                            beforeSend: function() {
                                $('.error-span').empty();
                            }
                        })
                        .done(function(response) {
                            $(".login-otp-form-btn").prop("disabled", false);
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
                            $(".login-otp-form-btn").prop("disabled", false);
                            if (response.responseJSON.errors.length > 0)
                                $('.error-span').empty().html('Please enter OTP');
                            setTimeout(function() {
                                $('.error-span').empty()
                            }, 1000);
                        });
                }, 300);
            } else
                $('.error-span').empty().html('Please enter OTP');
        });
    </script>
@endpush
