@extends('frontend::layouts.app')
@section('title', 'Add New Address')

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
                            <a href="javascript:void(0)">My Profile</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"> Settings</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"> Address</a>
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
                                <div class="title">Add New Address</div>
                                <form action="{{ route('store-billing-address') }}" method="post">
                                    @csrf
                                    <div class="row">
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
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <input type="text" id="" class="form-control"
                                                    placeholder="Address*" name="address_one">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <input type="text" id="" class="form-control"
                                                    placeholder="Address2" name="address_two">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="form-group">
                                                <input type="text" id="" class="form-control"
                                                    placeholder="City*" name="city">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="form-group">
                                                <select class="select" data-select2-id="select2-Due1"
                                                    aria-label="Default select example" name="country">
                                                    <option selected>Country*</option>
                                                    @foreach ($countries as $country)
                                                        <option value="{{ $country->id }}">{{ $country->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <input type="text" id="" class="form-control"
                                                    placeholder="Zip Code*" name="zip_code">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <select class="select" data-select2-id="select2-Due2"
                                                    aria-label="Default select example">
                                                    <option selected>State*</option>
                                                    @foreach ($states as $state)
                                                        <option value="{{ $state->id }}">{{ $state->title }}</option>
                                                    @endforeach
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
