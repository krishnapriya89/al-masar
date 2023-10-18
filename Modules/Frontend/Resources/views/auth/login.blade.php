@extends('frontend::layouts.app')
@section('title', 'Login')

@section('content')
    <div id="pageWrapper" class="registerPage InnerPage">
        <section id="UserLogin">
            <div class="container">
                <div class="LoginFormBx">
                    <div class="flxBx">
                        <div class="lftBx">
                            <img src="{{ asset('frontend/images/log.jpg') }}" alt="">
                        </div>
                        <div class="ritBx">
                            <div class="topB">
                                <form action="{{ route('user.login') }}" id="UserLoginForm" name="UserLoginForm"
                                    method="POST">
                                    @csrf
                                    <div class="title">Login</div>
                                    <div class="form-group">
                                        <input type="text" name="login" id="login"
                                            placeholder="Phone Number or Email Id"
                                            class="form-control @error('login') is-invalid @enderror" value="{{ old('login') }}">
                                        @error('login')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="hoveranim btn-submit"><span>REQUEST OTP</span></button>
                                </form>
                            </div>
                            <div class="btmB">
                                <p>New to Al Masar Al Saree? <a href="{{ route('user.register.form') }}"
                                        class="create">Create an Account</a></p>
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
    $(document).ready(function() {
        $("#UserLoginForm").validate({
            rules: {
                login: 'required',
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
    });
</script>
@endpush
