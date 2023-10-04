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
                            <form action="javascript:void(0);">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" id="" class="form-control" placeholder="First Name*">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" id="" class="form-control" placeholder="Last Name*">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input type="text" id="" class="form-control" placeholder="Address*">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input type="text" id="" class="form-control" placeholder="Address2">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-group">
                                            <input type="text" id="" class="form-control" placeholder="City*">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-group">
                                            <select class="select" data-select2-id="select2-Due1"
                                                aria-label="Default select example">
                                                <option selected>Country</option>
                                                <option value="1">Country 1</option>
                                                <option value="2">Country 2</option>
                                                <option value="3">Country 3</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <input type="text" id="" class="form-control" placeholder="Zip Code*">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <select class="select" data-select2-id="select2-Due2"
                                                aria-label="Default select example">
                                                <option selected>State*</option>
                                                <option value="1">Country 1</option>
                                                <option value="2">Country 2</option>
                                                <option value="3">Country 3</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="btnBx">
                                            <button class="save hoveranim"><span>SAVE</span></button>
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
