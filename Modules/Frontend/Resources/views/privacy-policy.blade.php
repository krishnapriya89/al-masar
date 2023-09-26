@extends('frontend::layouts.app')
@section('title', 'Privacy Policy')
@section('meta_title',@$privacy_policy->meta_title)
@section('meta_keywords',@$privacy_policy->meta_keywords)
@section('meta_description',@$privacy_policy->meta_description)
@section('other_meta_tags')
    {!! @$about->other_meta_tags !!}
@endsection

@section('content')

<div id="pageWrapper" class="privacyPage">

    <!-- Breadcrumbs Section  -->
    <div class="breadCrumbs">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Privacy Policies</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Breadcrumbs Section  -->

    <!-- Common Contents Section  -->
    <section class="cmnCntSec">
        <div class="container">
            <div class="Head">{{@$privacy_policy->title}}</div>
            <p>{!!@$privacy_policy->description!!} </p>
        </div>
    </section>
    <!-- Common Contents Section  -->


</div>

@endsection
