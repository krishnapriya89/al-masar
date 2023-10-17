@extends('frontend::layouts.app')
@section('title', 'About Us')
@section('meta_title',@$about->meta_title)
@section('meta_keywords',@$about->meta_keywords)
@section('meta_description',@$about->meta_description)
@section('other_meta_tags')
    {!! @$about->other_meta_tags !!}
@endsection

@section('content')

<div id="pageWrapper" class="aboutPage InnerPage">
    <!-- Common Banner Section  -->
    <section id="cmnBanner">
        <div class="bannerImg">
            @if(@$about->banner_image)
            <picture>
                <source media="(min-width: 468px)" srcset="{{Storage::disk('public')->exists($about->banner_image)?Storage::url($about->banner_image):asset($about->banner_image)}}"
                    data-srcset="{{Storage::disk('public')->exists($about->banner_image)?Storage::url($about->banner_image):asset($about->banner_image)}}" />
                <img alt="A lazy image" class="lazy" src="{{Storage::disk('public')->exists($about->banner_image)?Storage::url($about->banner_image):asset($about->banner_image)}}"
                    data-src="{{Storage::disk('public')->exists($about->banner_image)?Storage::url($about->banner_image):asset($about->banner_image)}}" />
            </picture>
            @endif
            <div class="bannerCnt">
                <div class="container">
                    <div class="Title">{{@$about->banner_title}}</div>
                    <div class="subT">{!! @$about->banner_description !!}</div>
                </div>
            </div>
        </div>
    </section>
    <!-- Common Banner Section  -->
    <div class="breadCrumb">
        <div class="container">
            <ul>
                <li>
                    <a href="{{ route('home')}}">Home</a>
                </li>
                <li>
                    <a href="javascript:void(0)">Who We Are</a>
                </li>
            </ul>
        </div>
    </div>

    <section id="AboutSec">
        <div class="container">
            <div class="MainHead center">
                <div class="Tagline">{{@$about->sub_title}}</div>
                <div class="Head">{!!@$about->title!!}</div>
            </div>
            <div class="row">
                <div class="col-lg-5">
                    <div class="lftB">
                        @if(@$about->image)
                        <div class="imgBx">
                            <img src="{{Storage::disk('public')->exists($about->image)?Storage::url($about->image):asset($about->image)}}" alt="">
                        </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="ritBx">
                        <div class="flxBx">
                            <div class="ltB">
                                <p>{!! @$about->description!!}</p>

                                {{-- <a href="#!" class="vmore">{{@$about->home_page_button_name}}
                                    <div class="icon">
                                        <img src="assets/images/arwR.svg" alt="">
                                    </div>
                                </a> --}}
                            </div>
                            <div class="rtB">
                                <div class="flxGrid">
                                    <div class="item active">
                                        <div class="flb">
                                            <div class="count" data-count="{{@$about->section_one_value_one}}">0</div>
                                            <div class="pls">+</div>
                                        </div>
                                        <div class="txt">{{@$about->section_one_title_one}}</div>
                                    </div>
                                    <div class="item">
                                        <div class="flb">
                                            <div class="count" data-count="{{@$about->section_one_value_two}}">0</div>
                                            <div class="pls">+</div>
                                        </div>
                                        <div class="txt">{{@$about->section_one_title_two}}</div>
                                    </div>
                                    <div class="item">
                                        <div class="flb">
                                            <div class="count" data-count="{{@$about->section_one_value_three}}">0</div>
                                            <div class="pls">+</div>
                                        </div>
                                        <div class="txt">{{@$about->section_one_title_three}}</div>
                                    </div>
                                    <div class="item">
                                        <div class="flb">
                                            <div class="count" data-count="{{@$about->section_one_value_four}}">0</div>
                                            <div class="pls">+</div>
                                        </div>
                                        <div class="txt">{{@$about->section_one_title_four}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flxWrap">
                <div class="itemBx">
                    <div class="item">
                        <div class="bgImg">
                            @if(@$about->vision_bg_image)
                            <img src="{{Storage::disk('public')->exists($about->vision_bg_image)? Storage::url($about->vision_bg_image):asset($about->vision_bg_image)}}" alt="">
                            @endif
                        </div>
                        <div class="txtBx">
                            <div class="title">{{@$about->vision_title}}</div>
                            <p>{!!@$about->vision_description!!}</p>
                        </div>
                    </div>
                </div>
                <div class="itemBx">
                    <div class="item">
                        <div class="bgImg">
                            @if(@$about->mission_bg_image)
                            <img src="{{Storage::disk('public')->exists($about->mission_bg_image)? Storage::url($about->mission_bg_image):asset($about->mission_bg_image)}}" alt="">
                            @endif
                        </div>
                        <div class="txtBx">
                            <div class="title">{{@$about->mission_title}}</div>
                            <p>{!!@$about->mission_description!!} </p>
                        </div>
                    </div>
                </div>
                <div class="itemBx">
                    <div class="item">
                        <div class="bgImg">
                            @if(@$about->values_bg_image)
                            <img src="{{Storage::disk('public')->exists($about->values_bg_image)? Storage::url($about->values_bg_image):asset($about->values_bg_image)}}" alt="">
                            @endif
                        </div>
                        <div class="txtBx">
                            <div class="title">{{ @$about->values_title}}</div>
                            <p>{!!@$about->values_description!!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SCROLL_MAGIC -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.8/ScrollMagic.min.js"></script>
    <script>
    var controller = new ScrollMagic.Controller();
    var scene = new ScrollMagic.Scene({
            triggerElement: '#AboutSec',
            triggerHook: 0.6
        })
        .setClassToggle('#AboutSec', 'isVisible')
        .on("enter", function() {
            $('.item .count').each(function() {
                var $this = $(this),
                    countTo = $this.attr('data-count');

                $({
                    countNum: $this.text()
                }).animate({
                    countNum: countTo
                }, {

                    duration: 2000,
                    easing: 'linear',
                    step: function() {
                        $this.text(Math.floor(this.countNum));
                    },
                    complete: function() {
                        $this.text(this.countNum);
                        //alert('finished');
                    }

                });
            });
        })
        .addTo(controller);
    </script>
</div>

@endsection
