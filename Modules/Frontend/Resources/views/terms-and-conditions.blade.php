@extends('frontend::layouts.app')
@section('title', 'Privacy Policy')
@section('meta_title',@$terms_conditions->meta_title)
@section('meta_keywords',@$terms_conditions->meta_keywords)
@section('meta_description',@$terms_conditions->meta_description)
@section('other_meta_tags')
    {!! @$terms_conditions->other_meta_tags !!}
@endsection

@section('content')

<div id="pageWrapper" class="privacyPage">

    <!-- Breadcrumbs Section  -->
    <div class="breadCrumbs">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Terms And Conditions</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Breadcrumbs Section  -->

    <!-- Common Contents Section  -->
    <section class="cmnCntSec">
        <div class="container">
            <div class="Head">{{@$terms_conditions->title}}</div>

            <p>{!!@$terms_conditions->description!!}</p>
        </div>
    </section>
    <!-- Common Contents Section  -->


</div>

@endsection
