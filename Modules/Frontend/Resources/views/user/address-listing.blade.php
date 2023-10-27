@extends('frontend::layouts.app')
@section('title', 'Add New Address')
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
                            <div class="allAddress">
                                <div class="headFlx">
                                    <div class="title">Add New Address</div>
                                    <a href="{{ route('add-billing-address') }}" class="addNew hoveranim "
                                        id="addressBtn"><span>+ Add New</span></a>
                                </div>
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active btnLink" id="home-tab" data-bs-toggle="tab"
                                            data-bs-target="#home" type="button" role="tab" aria-controls="home"
                                            aria-selected="true" data-url="{{ route('add-billing-address') }}">Billing
                                            Address</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link  btnLink" id="profile-tab" data-bs-toggle="tab"
                                            data-bs-target="#profile" type="button" role="tab" aria-controls="profile"
                                            aria-selected="false" data-url="{{ route('add-shipping-address') }}">Shipping
                                            Address</button>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel"
                                        aria-labelledby="home-tab">
                                        <div class="savedAddBx billing-address-div">
                                            @include('frontend::includes.billing-address-list-dashboard')
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                        <div class="savedAddBx shipping-address-div">
                                            @include('frontend::includes.shipping-address-list-dashboard')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
