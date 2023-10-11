
@extends('frontend::layouts.app')
@section('title', 'Order Failed')

@section('content')
<div id="pageWrapper" class="orderInfoPage InnerPage">
    <section id="infoB">
        <div class="container">
            <div class="row">
                <div class="allBx fldBx">
                    <div class="emptyBx">
                        <div class="icon">
                            <img src="{{ asset('frontend/images/fld.svg') }}" alt="">
                        </div>
                        <div class="failedtitle">Oops...</div>
                        <div class="subT">Something Went wrong.<br>
                            Please try again.</div>
                        <a href="{{ user.quotation }}" class="back hoveranim"><span>Try Again</span></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
