@extends('frontend::layouts.app')
@section('title', 'Home')

@section('content')
<div id="pageWrapper" class="registerPage">
    <section id="loginRegSec">
        <div class="container">
            <div class="flxSec">
                <div class="lftSec">
                    <div class="imgBx">
                        <img src="{{ asset('frontend/images/machine.svg') }}" alt="Machine" width="841" height="542"
                            class="lazy"
                            loading="lazy" data-src="{{ asset('frontend/images/machine.svg') }}">
                    </div>
                </div>
                <div class="ritSec">
                    <div class="loginRegBx">
                        <div class="title">Register</div>
                        <form action="{{ route('user.register.store') }}" id="RegisterForm" name="RegisterForm" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="name" class="form-label">Name*</label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}"
                                    class="form-control @error('name') is-invalid @enderror" placeholder="Enter Name">
                                @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="company" class="form-label">Organization/Company*</label>
                                <input type="text" id="company" name="company" value="{{ old('company') }}"
                                    class="form-control @error('company') is-invalid @enderror" placeholder="Enter Organization/Company">
                                @error('company')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="address" class="form-label">Address*</label>
                                <textarea id="address" name="address" class="form-control @error('address') is-invalid @enderror"
                                    placeholder="Enter Address">{{ old('address') }}</textarea>
                                @error('address')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="username" class="form-label">Country*</label>
                                <select name="country" id="country" class="form-control @error('country') is-invalid @enderror">
                                    <option value="" selected disabled>Select Country</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}" {{ old('country') == $country->id ? 'selected' : '' }}>{{ $country->title }}</option>
                                    @endforeach
                                </select>
                                @error('country')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email" class="form-label">Mail Id*</label>
                                <input type="text" id="email" name="email" value="{{ old('email') }}"
                                    class="form-control @error('email') is-invalid @enderror" placeholder="Enter Email Address">
                                @error('email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="phone" class="form-label">Phone*</label>
                                <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
                                    class="form-control @error('phone') is-invalid @enderror" placeholder="Enter Phone">
                                @error('phone')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="office_phone" class="form-label">Procurement Office Number*</label>
                                <input type="text" id="office_phone" name="office_phone" value="{{ old('office_phone') }}"
                                    class="form-control @error('office_phone') is-invalid @enderror" placeholder="Enter Procurement Office Number">
                                @error('office_phone')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="attachment" class="form-label">Attachment</label>
                                <input type="file" id="attachment" name="attachment" value="{{ old('attachment') }}"
                                    class="form-control @error('attachment') is-invalid @enderror" placeholder="Enter attachment">
                                @error('attachment')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="baseBtn hoveranim"><span>Register</span></button>
                            <div class="signSec">
                                <div class="leftSec">
                                    <p>Already Have Account? <a href="{{ route('user.login.form') }}">Sign In</a></p>
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
        $(document).ready(function(){
            $("#RegisterForm").validate({
                rules: {
                    name: 'required',
                    company : 'required',
                    address: 'required',
                    country: 'required',
                    email: {
                        required:true,
                        email:true
                    },
                    phone:{
                        required: true,
                        phoneDigitsOnly: true
                    },
                    office_phone:{
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
                        extension: 'Please choose file type of docx,doc,pdf'
                    }
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endpush