@extends('frontend::layouts.app')
@section('title', 'Privacy Policy')
@section('meta_title',@$privacy_policy->meta_title)
@section('meta_keywords',@$privacy_policy->meta_keywords)
@section('meta_description',@$privacy_policy->meta_description)
@section('other_meta_tags')
    {!! @$privacy_policy->other_meta_tags !!}
@endsection

@section('content')

<div id="pageWrapper" class="privacyPage InnerPage">


    <!-- Common Contents Section  -->
    <div class="headBx">
        <div class="container">
            <div class="mainT">{{ @$privacy_policy->title}}</div>
        </div>
    </div>
    <section class="cmnCntSec">
        <div class="container">

            <p>{!!@$privacy_policy->description!!}</p>

        </div>
    </section>
    <!-- Common Contents Section  -->


</div>

@endsection
