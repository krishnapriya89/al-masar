
@extends('frontend::layouts.app')
@section('title', 'Order Success')

@section('content')
<div id="pageWrapper" class="orderInfoPage InnerPage">
    <section id="infoB">
        <div class="container">
            <div class="row">
                <div class="allBx thnkBx">
                    <div class="emptyBx">
                        <div class="icon">
                            <img src="{{ asset('frontend/images/scs.svg') }}" alt="">
                        </div>
                        <p>Thank you!<br>
                            Your order was successfully submitted</p>
                        <div class="title"><a href="{{ route('user.order') }}/#{{$order->uid}}">Order Number <span>#{{ $order->uid }}</span></a></div>
                        <div class="subT">You will receive the order<br>
                            Status Updations through Email </div><br>
                        @if ($order->payment_id == 2)
                            <div class="subT"><strong>Please upload a file of the payment completed data against the order in the My Order page</strong></div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
