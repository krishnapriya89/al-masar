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
                                        <div class="savedAddBx">
                                            @foreach ($billing_addresses as $billing_address)
                                                <div class="item" id="address-{{ $billing_address->id }}">
                                                    <div class="adresBox">
                                                        <input type="radio"
                                                            id="add{{ base64_encode($billing_address->id) }}"
                                                            class="address-{{ $billing_address->id }} billing-address-radio-btn"
                                                            name="address"
                                                            {{ $billing_address->is_default ? 'checked' : '' }}>
                                                        <label for="add{{ base64_encode($billing_address->id) }}">
                                                            <div class="topBFlx">
                                                                <div class="setDefault billingAddress"
                                                                    data-id="{{ $billing_address->id }}"
                                                                    data-type="{{ $billing_address->type }}">
                                                                    @if ($billing_address->is_default)
                                                                        <div class="dfault">
                                                                            <img src="{{ asset('frontend/images/dflt.svg') }}"
                                                                                alt="">
                                                                            <div class="txt">Default</div>
                                                                        </div>
                                                                    @else
                                                                        <div class="txt">Set as Default</div>
                                                                    @endif
                                                                </div>
                                                                <div class="rtB">
                                                                    <a href="{{ route('edit-billing-address', encrypt($billing_address->id)) }}"
                                                                        class="edit">
                                                                        <img src="{{ asset('frontend/images/edit.svg') }}"
                                                                            alt="">
                                                                    </a>
                                                                    <a href="javascript:void(0)"
                                                                        class="dlt address-delete-btn"
                                                                        data-id="{{ $billing_address->id }}">
                                                                        <img src="{{ asset('frontend/images/delete.svg') }}"
                                                                            alt="">
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="txtBx">
                                                                <div class="name">{{ $billing_address->full_name }}</div>
                                                                <div class="addres">
                                                                    {{ $billing_address->full_address }}<br>{{ $billing_address->state->title }},{{ $billing_address->country->title }}
                                                                </div>
                                                            </div>
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                        <div class="savedAddBx">
                                            @foreach ($shipping_addresses as $shipping_address)
                                                <div class="item" id="address-{{ $shipping_address->id }}">
                                                    <div class="adresBox">
                                                        <input type="radio"
                                                            id="add{{ base64_encode($shipping_address->id) }}"
                                                            class="shippingaddress-{{ $shipping_address->id }} shipping-address-radio-btn"
                                                            name="address"
                                                            {{ $shipping_address->is_default ? 'checked' : '' }}>
                                                        <label for="add{{ base64_encode($shipping_address->id) }}">
                                                            <div class="topBFlx">
                                                                <div class="setDefault shippingAddress"
                                                                    data-id="{{ $shipping_address->id }}"
                                                                    data-type="{{ $shipping_address->type }}">
                                                                    @if ($shipping_address->is_default)
                                                                        <div class="dfault">
                                                                            <img src="{{ asset('frontend/images/dflt.svg') }}"
                                                                                alt="">
                                                                            <div class="txt">Default</div>
                                                                        </div>
                                                                    @else
                                                                        <div class="txt">Set as Default</div>
                                                                    @endif
                                                                </div>
                                                                <div class="rtB">
                                                                    <a href="{{ route('edit-shipping-address', encrypt($shipping_address->id)) }}"
                                                                        class="edit">
                                                                        <img src="{{ asset('frontend/images/edit.svg') }}"
                                                                            alt="">
                                                                    </a>
                                                                    <a href="javascript:void(0)"
                                                                        class="dlt address-delete-btn"
                                                                        data-id="{{ $shipping_address->id }}">
                                                                        <img src="{{ asset('frontend/images/delete.svg') }}"
                                                                            alt="">
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="txtBx">
                                                                <div class="name">{{ $shipping_address->full_name }}
                                                                </div>
                                                                <div class="addres">
                                                                    {{ $shipping_address->full_address }}<br>{{ $shipping_address->state->title }},{{ $shipping_address->country->title }}
                                                                </div>
                                                            </div>
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
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
