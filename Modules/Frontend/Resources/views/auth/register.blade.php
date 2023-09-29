@extends('frontend::layouts.app')
@section('title', 'Home')

@section('content')
    <div id="pageWrapper" class="registerPage InnerPage">
        <section id="UserLogin">
            <div class="container">
                <div class="FormBx">
                    <div class="flxBx">
                        <div class="lftBx">
                            <img src="{{ asset('frontend/images/reg.jpg') }}" alt="">
                        </div>
                        <div class="ritBx">
                            <div class="title">Register</div>
                            <form action="{{ route('user.register.store') }}" id="RegisterForm" name="RegisterForm"
                                enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" id="name" name="name" value="{{ old('name') }}"
                                                class="form-control @error('name') is-invalid @enderror"
                                                placeholder="Name*">
                                            @error('name')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" id="company" name="company" value="{{ old('company') }}"
                                                class="form-control @error('company') is-invalid @enderror"
                                                placeholder="Organization/Company*">
                                            @error('company')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" id="address" name="address" value="{{ old('address') }}"
                                                placeholder="Address*"
                                                class="form-control @error('address') is-invalid @enderror">
                                            @error('address')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select name="country" id="country"
                                                class="select @error('country') is-invalid @enderror">
                                                <option value="" selected disabled>Country*</option>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}"
                                                        {{ old('country') == $country->id ? 'selected' : '' }}>
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
                                            <input type="text" id="email" name="email" value="{{ old('email') }}"
                                                class="form-control @error('email') is-invalid @enderror"
                                                placeholder="Mail Id*">
                                            @error('email')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
                                                class="form-control @error('phone') is-invalid @enderror"
                                                placeholder="Phone*">
                                            @error('phone')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" id="office_phone" name="office_phone"
                                                value="{{ old('office_phone') }}"
                                                class="form-control @error('office_phone') is-invalid @enderror"
                                                placeholder="Procurement Office Number*">
                                            @error('office_phone')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="fileUploadInput">
                                                <label for="file-upload" class="custom-file-upload">
                                                    <i class="fa fa-cloud-upload"></i> Attachment
                                                </label>
                                                <input id="attachment" name='attachment' type="file" class="fileInput">
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
                                            {{-- <input type="file" id="attachment" name="attachment"
                                                value="{{ old('attachment') }}"
                                                class="form-control @error('attachment') is-invalid @enderror"
                                                placeholder="attachment*">
                                            @error('attachment')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror --}}
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="btnBx">
                                            <button type="submit" class="hoveranim btn-submit"><span>SUBMIT</span></button>
                                            <p>Do You Have an Account? <a href="{{ route('user.login.form') }}"
                                                    class="login">Login</a></p>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('js')
    <script>
        $('#attachment').change(function() {
            var i = $(this).prev('label').clone();
            var file = $('#attachment')[0].files[0].name;
            $(this).prev('label').text(file);
        });

        $(document).ready(function() {
            $("#RegisterForm").validate({
                rules: {
                    name: 'required',
                    company: 'required',
                    address: 'required',
                    country: 'required',
                    email: {
                        required: true,
                        email: true
                    },
                    phone: {
                        required: true,
                        phoneDigitsOnly: true
                    },
                    office_phone: {
                        required: true,
                        phoneDigitsOnly: true,
                        notEqual: "#phone",
                    },
                    attachment: {
                        extension: "pdf"
                    }
                },
                messages: {
                    attachment: {
                        extension: 'Please choose file type of pdf'
                    }
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
