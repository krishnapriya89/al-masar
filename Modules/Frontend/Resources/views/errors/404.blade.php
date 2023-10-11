@extends('frontend::layouts.app')
@section('title', 'Products')

@section('content')
    <div id="pageWrapper" class="errorPage InnerPage">
        <section id="infoB">
            <div class="container">
                <div class="row">
                    <div class="allBx errorBx">
                        <div class="emptyBx">
                            <div class="mainT">
                                404
                            </div>
                            <div class="emptytitle">Page Not Found</div>
                            <div class="subT">Oops! Looks like something wrong.
                                We are working on it. Sorry!</div>
                            <a href="{{ route('product') }}" class="back hoveranim"><span>Back to product</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
