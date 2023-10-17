@extends('frontend::layouts.app')
@section('title', 'Terms & Conditions')
@section('meta_title',@$terms_conditions->meta_title)
@section('meta_keywords',@$terms_conditions->meta_keywords)
@section('meta_description',@$terms_conditions->meta_description)
@section('other_meta_tags')
    {!! @$terms_conditions->other_meta_tags !!}
@endsection

@section('content')

<div id="pageWrapper" class="privacyPage InnerPage">


    <!-- Common Contents Section  -->
    <div class="headBx">
        <div class="container">
            <div class="mainT">{{ @$terms_conditions->title}}</div>
        </div>
    </div>
    <section class="cmnCntSec">
        <div class="container">

            <p>{!!@$terms_conditions->description!!}</p>

        </div>
    </section>
    <!-- Common Contents Section  -->


</div>

</div>

@endsection
