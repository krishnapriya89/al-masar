@extends('frontend::layouts.app')
@section('title', 'Home')
@push('css')
<style>
    label.error {
         color: #dc3545;
         font-size: 14px;
    }
</style>
@endpush

@section('content')

<div id="pageWrapper" class="homePage">

    <section id="MainSlider">
        <div id="bannerCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
                @if($home_banners->isNotEmpty())
                @foreach ($home_banners as $banner)
                <div class="carousel-item {{$loop->first ? 'active' :''}}" data-bs-slide="{{$loop->iteration}}">
                    <div class="bnrSld">
                        <picture>
                            <source media="(min-width: 576px)" srcset="{{$banner->image_value}}"
                                data-srcset="{{$banner->image_value}}" />
                            <img alt="A lazy image" class="lazy bnrBg" src="{{$banner->mobile_image_value}}"
                                data-src="{{$banner->mobile_image_value}}" />
                        </picture>
                        <div class="cntBx">
                            <div class="container">
                                <div class="tleWrp">
                                    <div class="subT">{{@$banner->sub_title}}</div>
                                    <h1 class="mTle">{!!@$banner->title!!}</h1>
                                    @if (@$banner->button_name)
                                        <a href="{{ @$banner->button_link}}" class="about hoveranim"><span>{{ @$banner->button_name}}</span></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                @endif
            </div>
            <div class="carousel-indicators">
                <div class="container">
                    @foreach ($home_banners as $banner)
                    <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="{{$loop->index}}" class="{{ $loop->first ? 'active' : '' }}"
                        aria-current="{{ $loop->first ? 'true' : '' }}" aria-label="Slide {{$loop->iteration}}"><span></span></button>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @getEmailLogo()
    <section id="AboutSec">
        <div class="container">
            <div class="MainHead center">
                <div class="Tagline">{{@$about_us_common->sub_title}}</div>
                <div class="Head">{!!@$about_us_common->title!!}</div>
            </div>
            <div class="row">
                <div class="col-lg-5">
                    <div class="lftB">

                        @if(@$about_us_common->image)
                        <div class="imgBx">
                            <img src="{{ Storage::disk('public')->exists($about_us_common->image) ? Storage::url($about_us_common->image):asset($about_us_common->image)}}" alt="">
                        </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="ritBx">
                        <div class="flxBx">
                            <div class="ltB">
                                <p>{!!@$about_us_common->description!!}</p>
                                @if (Auth::guard('web')->check())
                                <a href="{{ route('about')}}" class="vmore">{{@$about_us_common->home_page_button_name}}
                                    <div class="icon">
                                        <img src="{{asset('frontend/images/arwR.svg')}}" alt="">
                                    </div>
                                </a>
                                @endif

                            </div>
                            <div class="rtB">
                                <div class="flxGrid">
                                    <div class="item active">
                                        <div class="flb">
                                            <div class="count" data-count="{{@$about_us_common->section_one_value_one}}">0</div>
                                            <div class="pls">+</div>
                                        </div>
                                        <div class="txt">{{@$about_us_common->section_one_title_one}}</div>
                                    </div>
                                    <div class="item">
                                        <div class="flb">
                                            <div class="count" data-count="{{@$about_us_common->section_one_value_two}}">0</div>
                                            <div class="pls">+</div>
                                        </div>
                                        <div class="txt">{{@$about_us_common->section_one_title_two}}</div>
                                    </div>
                                    <div class="item">
                                        <div class="flb">
                                            <div class="count" data-count="{{@$about_us_common->section_one_value_three}}">0</div>
                                            <div class="pls">+</div>
                                        </div>
                                        <div class="txt">{{@$about_us_common->section_one_title_three}}</div>
                                    </div>
                                    <div class="item">
                                        <div class="flb">
                                            <div class="count" data-count="{{@$about_us_common->section_one_value_four}}">0</div>
                                            <div class="pls">+</div>
                                        </div>
                                        <div class="txt">{{@$about_us_common->section_one_title_four}}</div>
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
                            @if(@$about_us_common->vision_bg_image)
                            <img src="{{Storage::disk('public')->exists($about_us_common->vision_bg_image) ? Storage::url($about_us_common->vision_bg_image):asset($about_us_common->vision_bg_image)}}" alt="">
                            @endif
                        </div>
                        <div class="txtBx">
                            <div class="title">{{@$about_us_common->vision_title}}</div>
                            <p>{!!@$about_us_common->vision_description!!}</p>
                        </div>
                    </div>
                </div>
                <div class="itemBx">
                    <div class="item">
                        <div class="bgImg">
                            @if(@$about_us_common->mission_bg_image)
                            <img src="{{Storage::disk('public')->exists($about_us_common->mission_bg_image) ? Storage::url($about_us_common->mission_bg_image):asset($about_us_common->mission_bg_image)}}" alt="">
                            @endif
                        </div>
                        <div class="txtBx">
                            <div class="title">{{@$about_us_common->mission_title}}</div>
                            <p>{!!@$about_us_common->mission_description!!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="WhyChooseSec">
        <div class="bgLog">
            <img src="{{asset('frontend/images/log.svg')}}" alt="">
        </div>
        <div class="container">
            <div class="MainHead center">
                <div class="Head">{{@$why_choose->title}}</div>
                <p>{!!@$why_choose->sub_title!!}</p>
            </div>
            <div class="flxBx">
                <div class="item active">
                    <div class="serviceBox">
                        <div class="hxLine">
                            <div class="contenBx">
                                <div class="content">
                                    <div class="icon">
                                        @if(@$why_choose->section_one_image)
                                        <img src="{{Storage::disk('public')->exists($why_choose->section_one_image) ? Storage::url($why_choose->section_one_image):asset($why_choose->section_one_image)}}" alt="">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="txtBx">
                        <div class="title">{{@$why_choose->section_one_title}}</div>
                        <p>{!!@$why_choose->section_one_description!!}</p>
                    </div>
                </div>
                <div class="item">
                    <div class="serviceBox">
                        <div class="hxLine">
                            <div class="contenBx">
                                <div class="content">
                                    <div class="icon">
                                        @if(@$why_choose->section_two_image)
                                        <img src="{{Storage::disk('public')->exists($why_choose->section_two_image) ? Storage::url($why_choose->section_two_image):asset($why_choose->section_one_image)}}" alt="">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="txtBx">
                        <div class="title">{{@$why_choose->section_two_title}}</div>
                        <p>{!!@$why_choose->section_two_description!!}
                        </p>
                    </div>
                </div>
                <div class="item">
                    <div class="serviceBox">
                        <div class="hxLine">
                            <div class="contenBx">
                                <div class="content">
                                    <div class="icon">
                                        @if(@$why_choose->section_three_image)
                                        <img src="{{Storage::disk('public')->exists($why_choose->section_three_image) ? Storage::url($why_choose->section_three_image):asset($why_choose->section_three_image)}}" alt="">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="txtBx">
                        <div class="title">{{@$why_choose->section_three_title}}</div>
                        <p>{!!@$why_choose->section_three_description!!}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="HowToBuy">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="lftBx">
                        <div class="imgBx">
                            @if(@$how_to_buy->image)
                            <img src="{{Storage::disk('public')->exists($how_to_buy->image) ? Storage::url($how_to_buy->image):asset($how_to_buy->image)}}" alt="">
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ritBx">
                        <div class="MainHead">
                            <div class="Head">{{@$how_to_buy->title}}</div>
                            <p>{!!@$how_to_buy->sub_title!!}</p>
                        </div>
                        <div class="blck_bx">
                            <div class="cmn_bx active">
                                <div class="inner_bx">
                                    <div class="icon">
                                        <svg viewBox="0 0 44 44">
                                            <path id="Path_101876" data-name="Path 101876"
                                                d="M22.917,34.833A11.917,11.917,0,1,1,34.833,22.917,11.93,11.93,0,0,1,22.917,34.833Zm0-22A10.083,10.083,0,1,0,33,22.917,10.1,10.1,0,0,0,22.917,12.833Z"
                                                transform="translate(9.167 9.167)" />
                                            <path id="Path_101877" data-name="Path 101877"
                                                d="M18.584,24.167a.926.926,0,0,1-.649-.268l-3.667-3.667a.917.917,0,1,1,1.3-1.3l2.974,2.974,5.771-6.6A.917.917,0,0,1,25.69,16.52l-6.417,7.333a.923.923,0,0,1-.66.313h-.029Z"
                                                transform="translate(11.666 12.5)" />
                                            <path id="Path_101878" data-name="Path 101878"
                                                d="M17.417,36H4.583A4.589,4.589,0,0,1,0,31.417V7.583A4.589,4.589,0,0,1,4.583,3H8.25a.917.917,0,1,1,0,1.833H4.583a2.753,2.753,0,0,0-2.75,2.75V31.417a2.753,2.753,0,0,0,2.75,2.75H17.417a.917.917,0,1,1,0,1.833Z"
                                                transform="translate(0 2.5)" />
                                            <path id="Path_101879" data-name="Path 101879"
                                                d="M20.25,14a.917.917,0,0,1-.917-.917v-5.5a2.753,2.753,0,0,0-2.75-2.75H12.917a.917.917,0,1,1,0-1.833h3.667a4.589,4.589,0,0,1,4.583,4.583v5.5A.917.917,0,0,1,20.25,14Z"
                                                transform="translate(10 2.5)" />
                                            <path id="Path_101880" data-name="Path 101880"
                                                d="M17.75,11h-11A2.753,2.753,0,0,1,4,8.25V4.583a.917.917,0,0,1,.917-.917H7.758a4.584,4.584,0,0,1,8.983,0h2.842a.917.917,0,0,1,.917.917V8.25A2.753,2.753,0,0,1,17.75,11ZM5.833,5.5V8.25a.918.918,0,0,0,.917.917h11a.918.918,0,0,0,.917-.917V5.5h-2.75A.917.917,0,0,1,15,4.583a2.75,2.75,0,1,0-5.5,0,.917.917,0,0,1-.917.917Z"
                                                transform="translate(3.333)" />
                                            <path id="Path_101881" data-name="Path 101881"
                                                d="M22.25,9.833H3.917A.917.917,0,1,1,3.917,8H22.25a.917.917,0,1,1,0,1.833Z"
                                                transform="translate(2.5 6.667)" />
                                            <path id="Path_101882" data-name="Path 101882"
                                                d="M16.75,12.833H3.917a.917.917,0,1,1,0-1.833H16.75a.917.917,0,1,1,0,1.833Z"
                                                transform="translate(2.5 9.167)" />
                                            <path id="Path_101883" data-name="Path 101883"
                                                d="M13.083,15.833H3.917a.917.917,0,1,1,0-1.833h9.167a.917.917,0,1,1,0,1.833Z"
                                                transform="translate(2.5 11.667)" />
                                        </svg>
                                    </div>
                                    <div class="prgrs"></div>
                                    <div class="txt_bx">
                                        <div class="tag">Step 01</div>
                                        <div class="title">{{@$how_to_buy->section_one_title}}</div>
                                        <p>{!!@$how_to_buy->section_one_description!!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="cmn_bx">
                                <div class="inner_bx">
                                    <div class="icon">
                                        <svg viewBox="0 0 51.154 51.154">
                                            <defs>
                                                <clipPath id="clip-path">
                                                    <path id="path5790" class="cls-1" d="M0-682.665H51.154v51.154H0Z"
                                                        transform="translate(0 682.665)" />
                                                </clipPath>
                                            </defs>
                                            <g id="g5784" transform="translate(0 682.665)">
                                                <g id="g5786" transform="translate(0 -682.665)">
                                                    <g id="g5788" class="cls-2">
                                                        <g id="g5794" transform="translate(28.832 4.004)">
                                                            <path id="path5796" class="cls-1"
                                                                d="M-147.672-67.825a.749.749,0,0,1-.749-.749v-4l-10.463-.052a.749.749,0,0,1-.749-.749.749.749,0,0,1,.749-.749h10.412a1.552,1.552,0,0,1,1.55,1.55v4A.749.749,0,0,1-147.672-67.825Z"
                                                                transform="translate(159.634 74.129)" />
                                                        </g>
                                                        <g id="g5798" transform="translate(7.208 12.014)">
                                                            <path id="path5800" class="cls-1"
                                                                d="M15.715-155.76H-8.45A1.552,1.552,0,0,1-10-157.31v-20.022a.749.749,0,0,1,.749-.749.749.749,0,0,1,.749.749v20.022l24.216.052a.847.847,0,0,0,.6-.25l6.27-6.27a.847.847,0,0,0,.25-.6v-26.567a.749.749,0,0,1,.749-.749.749.749,0,0,1,.749.749v26.567a2.336,2.336,0,0,1-.689,1.663l-6.27,6.269A2.336,2.336,0,0,1,15.715-155.76Z"
                                                                transform="translate(10 191.697)" />
                                                        </g>
                                                        <g id="g5802" transform="translate(32.837 39.244)">
                                                            <path id="path5804" class="cls-1"
                                                                d="M-9.251-91.925A.749.749,0,0,1-10-92.674v-5.957a1.552,1.552,0,0,1,1.55-1.55h5.982a.749.749,0,0,1,.749.749.749.749,0,0,1-.749.749H-8.45L-8.5-92.674A.749.749,0,0,1-9.251-91.925Z"
                                                                transform="translate(10 100.181)" />
                                                        </g>
                                                        <g id="g5806" transform="translate(9.611 0)">
                                                            <path id="path5808" class="cls-1"
                                                                d="M-48.8-122.342a3.957,3.957,0,0,1-3.953-3.953V-134.3a3.957,3.957,0,0,1,3.953-3.953,3.957,3.957,0,0,1,3.953,3.953.749.749,0,0,1-.749.749.749.749,0,0,1-.749-.749,2.457,2.457,0,0,0-2.454-2.454,2.457,2.457,0,0,0-2.454,2.454v8.009a2.457,2.457,0,0,0,2.454,2.454,2.457,2.457,0,0,0,2.454-2.454v-3.2a.853.853,0,0,0-.852-.852.853.853,0,0,0-.852.852v1.6a.749.749,0,0,1-.749.749.749.749,0,0,1-.749-.749v-1.6A2.354,2.354,0,0,1-47.2-131.85a2.354,2.354,0,0,1,2.351,2.351v3.2A3.957,3.957,0,0,1-48.8-122.342Z"
                                                                transform="translate(52.753 138.257)" />
                                                        </g>
                                                        <g id="g5810" transform="translate(6.407 3.204)">
                                                            <path id="path5812" class="cls-1"
                                                                d="M-73.128,13.924H-93.951a1.552,1.552,0,0,1-1.55-1.55V-8.45A1.552,1.552,0,0,1-93.951-10h2.4a.749.749,0,0,1,.749.749.749.749,0,0,1-.749.749h-2.4L-94,12.373l20.875.052.052-20.875L-88.345-8.5a.749.749,0,0,1-.749-.749A.749.749,0,0,1-88.345-10h15.217a1.552,1.552,0,0,1,1.55,1.55V12.373A1.552,1.552,0,0,1-73.128,13.924Z"
                                                                transform="translate(95.501 10)" />
                                                        </g>
                                                        <g id="g5814" transform="translate(10.412 7.208)">
                                                            <path id="path5816" class="cls-1"
                                                                d="M22.785-489.775H-8.45a1.552,1.552,0,0,1-1.55-1.55v-2.4a.749.749,0,0,1,.749-.749.749.749,0,0,1,.749.749v2.4l31.286.052.052-40.9-2.454-.052a.749.749,0,0,1-.749-.749.749.749,0,0,1,.749-.749h2.4a1.552,1.552,0,0,1,1.55,1.55v40.845A1.552,1.552,0,0,1,22.785-489.775Z"
                                                                transform="translate(10 533.721)" />
                                                        </g>
                                                        <g id="g5818" transform="translate(20.022 10.412)">
                                                            <path id="path5820" class="cls-1"
                                                                d="M-5.246-8.5h-4A.749.749,0,0,1-10-9.251.749.749,0,0,1-9.251-10h4a.749.749,0,0,1,.749.749A.749.749,0,0,1-5.246-8.5Z"
                                                                transform="translate(10 10)" />
                                                        </g>
                                                        <g id="g5822" transform="translate(20.022 14.416)">
                                                            <path id="path5824" class="cls-1"
                                                                d="M-5.246-8.5h-4A.749.749,0,0,1-10-9.251.749.749,0,0,1-9.251-10h4a.749.749,0,0,1,.749.749A.749.749,0,0,1-5.246-8.5Z"
                                                                transform="translate(10 10)" />
                                                        </g>
                                                        <g id="g5826" transform="translate(11.212 18.421)">
                                                            <path id="path5828" class="cls-1"
                                                                d="M3.564-8.5H-9.251A.749.749,0,0,1-10-9.251.749.749,0,0,1-9.251-10H3.564a.749.749,0,0,1,.749.749A.749.749,0,0,1,3.564-8.5Z"
                                                                transform="translate(10 10)" />
                                                        </g>
                                                        <g id="g5830" transform="translate(33.637 18.421)">
                                                            <path id="path5832" class="cls-1"
                                                                d="M-7.649-8.5h-1.6A.749.749,0,0,1-10-9.251.749.749,0,0,1-9.251-10h1.6a.749.749,0,0,1,.749.749A.749.749,0,0,1-7.649-8.5Z"
                                                                transform="translate(10 10)" />
                                                        </g>
                                                        <g id="g5834" transform="translate(33.637 10.412)">
                                                            <path id="path5836" class="cls-1"
                                                                d="M-7.649-8.5h-1.6A.749.749,0,0,1-10-9.251.749.749,0,0,1-9.251-10h1.6a.749.749,0,0,1,.749.749A.749.749,0,0,1-7.649-8.5Z"
                                                                transform="translate(10 10)" />
                                                        </g>
                                                        <g id="g5838" transform="translate(33.637 14.416)">
                                                            <path id="path5840" class="cls-1"
                                                                d="M-7.649-8.5h-1.6A.749.749,0,0,1-10-9.251.749.749,0,0,1-9.251-10h1.6a.749.749,0,0,1,.749.749A.749.749,0,0,1-7.649-8.5Z"
                                                                transform="translate(10 10)" />
                                                        </g>
                                                        <g id="g5842" transform="translate(33.637 22.425)">
                                                            <path id="path5844" class="cls-1"
                                                                d="M-7.649-8.5h-1.6A.749.749,0,0,1-10-9.251.749.749,0,0,1-9.251-10h1.6a.749.749,0,0,1,.749.749A.749.749,0,0,1-7.649-8.5Z"
                                                                transform="translate(10 10)" />
                                                        </g>
                                                        <g id="g5846" transform="translate(12.013 29.633)">
                                                            <path id="path5848" class="cls-1"
                                                                d="M-7.649-8.5h-1.6A.749.749,0,0,1-10-9.251.749.749,0,0,1-9.251-10h1.6a.749.749,0,0,1,.749.749A.749.749,0,0,1-7.649-8.5Z"
                                                                transform="translate(10 10)" />
                                                        </g>
                                                        <g id="g5850" transform="translate(12.013 37.642)">
                                                            <path id="path5852" class="cls-1"
                                                                d="M-7.649-8.5h-1.6A.749.749,0,0,1-10-9.251.749.749,0,0,1-9.251-10h1.6a.749.749,0,0,1,.749.749A.749.749,0,0,1-7.649-8.5Z"
                                                                transform="translate(10 10)" />
                                                        </g>
                                                        <g id="g5854" transform="translate(12.013 33.637)">
                                                            <path id="path5856" class="cls-1"
                                                                d="M-7.649-8.5h-1.6A.749.749,0,0,1-10-9.251.749.749,0,0,1-9.251-10h1.6a.749.749,0,0,1,.749.749A.749.749,0,0,1-7.649-8.5Z"
                                                                transform="translate(10 10)" />
                                                        </g>
                                                        <g id="g5858" transform="translate(17.62 29.633)">
                                                            <path id="path5860" class="cls-1"
                                                                d="M8.369-8.5H-9.251A.749.749,0,0,1-10-9.251.749.749,0,0,1-9.251-10H8.369a.749.749,0,0,1,.749.749A.749.749,0,0,1,8.369-8.5Z"
                                                                transform="translate(10 10)" />
                                                        </g>
                                                        <g id="g5862" transform="translate(17.62 37.642)">
                                                            <path id="path5864" class="cls-1"
                                                                d="M1.962-8.5H-9.251A.749.749,0,0,1-10-9.251.749.749,0,0,1-9.251-10H1.962a.749.749,0,0,1,.749.749A.749.749,0,0,1,1.962-8.5Z"
                                                                transform="translate(10 10)" />
                                                        </g>
                                                        <g id="g5866" transform="translate(17.62 33.637)">
                                                            <path id="path5868" class="cls-1"
                                                                d="M8.369-8.5H-9.251A.749.749,0,0,1-10-9.251.749.749,0,0,1-9.251-10H8.369a.749.749,0,0,1,.749.749A.749.749,0,0,1,8.369-8.5Z"
                                                                transform="translate(10 10)" />
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="prgrs"></div>
                                    <div class="txt_bx">
                                        <div class="tag">Step 02</div>
                                        <div class="title">{{@$how_to_buy->section_two_title}}</div>
                                        <p>{!!@$how_to_buy->section_two_description!!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="cmn_bx">
                                <div class="inner_bx">
                                    <div class="icon">
                                        <svg viewBox="0 0 48.667 48.667">
                                            <g id="brand-identity" transform="translate(-16 -16)">
                                                <path id="Path_101884" data-name="Path 101884"
                                                    d="M16.185,64.371a.811.811,0,0,0,.626.3H63.856a.811.811,0,0,0,.8-.967l-7.3-37.311a.811.811,0,0,0-.8-.655H50.067V21.678a5.675,5.675,0,0,0-7.706-5.3,5.675,5.675,0,0,0-7.706,5.3v4.056H24.111a.811.811,0,0,0-.8.655L16.015,63.7a.811.811,0,0,0,.17.671ZM26.544,56.8l7.493,6.244H19.051ZM55.888,27.355l6.983,35.689H36.946L29.963,27.355h8.748v4.867H37.089v1.622h4.867V32.222H40.333V27.355h8.111v4.867H46.822v1.622h4.867V32.222H50.067V27.355ZM42.361,18.168a4.057,4.057,0,0,1,2.028,3.51v4.056H40.333V21.678a4.057,4.057,0,0,1,2.028-3.51Zm2.028-.546a4.06,4.06,0,0,1,4.056,4.056v4.056H46.011V21.678A5.66,5.66,0,0,0,44.3,17.624l.085,0Zm-8.111,4.056a4.06,4.06,0,0,1,4.056-4.056l.085,0a5.66,5.66,0,0,0-1.707,4.053v4.056H36.278Zm-11.5,5.678h.954V41.144h1.622V27.355h.954l6.734,34.416-7.688-6.407V46.822H25.733v8.542l-7.688,6.407Z"
                                                    transform="translate(0 0)" />
                                                <path id="Path_101885" data-name="Path 101885"
                                                    d="M112,280h1.622v1.622H112Z"
                                                    transform="translate(-86.267 -237.233)" />
                                                <path id="Path_101886" data-name="Path 101886"
                                                    d="M292.056,240.111A4.056,4.056,0,1,0,288,236.056,4.056,4.056,0,0,0,292.056,240.111Zm0-6.489a2.433,2.433,0,1,1-2.433,2.433A2.433,2.433,0,0,1,292.056,233.622Z"
                                                    transform="translate(-244.422 -194.1)" />
                                                <path id="Path_101887" data-name="Path 101887"
                                                    d="M264,336h4.056v1.622H264Z"
                                                    transform="translate(-222.855 -287.556)" />
                                                <path id="Path_101888" data-name="Path 101888"
                                                    d="M320,336h8.111v1.622H320Z"
                                                    transform="translate(-273.178 -287.556)" />
                                                <path id="Path_101889" data-name="Path 101889"
                                                    d="M248,368h9.733v1.622H248Z"
                                                    transform="translate(-208.478 -316.311)" />
                                                <path id="Path_101890" data-name="Path 101890"
                                                    d="M360,368h6.489v1.622H360Z"
                                                    transform="translate(-309.122 -316.311)" />
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="prgrs"></div>
                                    <div class="txt_bx">
                                        <div class="tag">Step 03</div>
                                        <div class="title">{{@$how_to_buy->section_three_title}}</div>
                                        <p>{!!@$how_to_buy->section_three_description!!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="contactSec">
        <div class="container">
            <div class="flxBx">
                <div class="lftB">
                    <div class="MainHead">
                        <div class="Head">{{@$contact->application_form_title}}</div>
                    </div>
                    <form action="{{ route('contact-enquiry')}}" method="post" id="contactForm">
                        @csrf
                        <div class="formGrp">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Name" name="name" value="{{old('name')}}">
                                        <div class="help-block d-none">Invalid Input</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Email" name="email" value="{{old('email')}}">
                                        <div class="help-block d-none">Invalid Input</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Phone" name="phone" value="{{old('phone')}}">
                                        <div class="help-block d-none">Invalid Input</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="mobile_code" placeholder="Subject" name="subject" value="{{old('subject')}}">
                                        <div class="help-block d-none">Invalid Input</div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control" placeholder="Message" name="message">{{old('message')}}</textarea>
                                        <div class="help-block d-none">Invalid Input</div>
                                    </div>
                                </div>
                            </div>
                            <button class="sendBtn hoveranim" type="submit"><span>SEND MESSAGE</span></button>
                        </div>
                    </form>

                </div>
                <div class="ritB">
                    <div class="inFbx">
                        <div class="bglogo">
                            <img src="{{asset('frontend/images/wlogo.svg')}}" alt="">
                        </div>
                        <div class="title">{{@$contact->title}}</div>
                        <p>{!!@$contact->description!!}</p>
                        <div class="cBx">
                            <div class="label">Call Now</div>
                            <a href="tel:{{@$contact->phone}}" class="call">{{@$contact->phone}}</a>
                        </div>
                        <div class="cBx">
                            <div class="label">Mail Us</div>
                            <a href="mailto:{{@$contact->email}}" class="mail">{{@$contact->email}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- TOUCH_SWIPE-->
    <script type=" text/javascript"
        src="//cdnjs.cloudflare.com/ajax/libs/jquery.touchswipe/1.6.19/jquery.touchSwipe.min.js">
    </script>

    <!-- SCROLL_MAGIC -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.8/ScrollMagic.min.js"></script>



    <script>
    $(".carousel").swipe({
        swipe: function(event, direction, distance, duration, fingerCount,
            fingerData) {
            if (direction == 'left') $(this).carousel('next');
            if (direction == 'right') $(this).carousel('prev');
        },
        allowPageScroll: "vertical"
    })

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

    $(function() {
        var lis_count = $('#WhyChooseSec .item').length;
        var active_li_index = 0;

        setInterval(function() {
            if ($('#WhyChooseSec .item.active').index() == lis_count - 1)
                active_li_index = 0;
            else
                active_li_index++;

            $('#WhyChooseSec .item.active').removeClass('active');
            $('#WhyChooseSec .item').eq(active_li_index).addClass('active');
        }, 4000);
    })


    $(function() {
        var lis_count = $('#HowToBuy .cmn_bx').length;
        var active_li_index = 0;

        setInterval(function() {
            if ($('#HowToBuy .cmn_bx.active').index() == lis_count - 1)
                active_li_index = 0;
            else
                active_li_index++;

            $('#HowToBuy .cmn_bx.active').removeClass('active');
            $('#HowToBuy .cmn_bx').eq(active_li_index).addClass('active');
        }, 4000);
    })
    </script>


</div>
@endsection
