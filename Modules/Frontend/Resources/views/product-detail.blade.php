@extends('frontend::layouts.app')
@section('title', 'Product Detail Page')
@section('content')
    <div id="pageWrapper" class="shopDetailspage InnerPage">
        <section id="shopDtlSec">
            <div class="breadCrumb">
                <div class="container">
                    <ul>
                        <li>
                            <a href="javascript:void(0)">Home </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">iphone</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="container">
                <div class="MainRow">
                    <div class="proSlideSecCol scrollfix">
                        <div class="proSlideSec app-figure DeskSlide" id="zoom-fig">
                            <div class="slider mainSlide">
                                @if ($product->detail_page_image)
                                    <div data-slide-id="zoom" class="zoom_gallery_slide active">
                                        <a id="Zoom-1" class="MagicZoom" title=""
                                            href="{{ $product->detail_page_image_value }}"
                                            data-zoom-image-8x="{{ $product->detail_page_image_value }}"
                                            data-image-8x="{{ $product->detail_page_image_value }}">
                                            <img src="{{ $product->detail_page_image_value }}" class="lazy" loading="lazy"
                                                data-src="{{ $product->detail_page_image_value }}"
                                                srcset="{{ $product->detail_page_image_value }}" alt="" />
                                        </a>
                                    </div>
                                @endif
                                @if ($product_galleries->isNotEmpty())
                                    @foreach ($product_galleries as $gallery)
                                        @if ($gallery->file_type == 'Image')
                                            <div data-slide-id="zoom"
                                                class="zoom_gallery_slide {{ $loop->first && !$product->detail_page_image ? 'active' : '' }}">
                                                <a id="Zoom-1" class="MagicZoom" title=""
                                                    href="{{ $gallery->image_href_value }}"
                                                    data-zoom-image-8x="{{ $gallery->image_value }}"
                                                    data-image-8x="{{ $gallery->image_value }}">
                                                    <img src="{{ $gallery->image_value }}"
                                                        srcset="{{ $gallery->image_value }}" alt="" />
                                                </a>
                                            </div>
                                        @elseif($gallery->file_type == 'Video')
                                            <div data-slide-id="video"
                                                class="zoom_gallery_slide video_slide {{ $loop->first && !$product->detail_page_image ? 'active' : '' }}">
                                                <video src="{{ $gallery->image_value }}" autoplay="true" muted
                                                    preload="auto" controls=""
                                                    poster="{{ $gallery->thumb_image_value }}"></video>

                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            </div>

                            <div class="slider thumbSlide">
                                @if ($product->detail_page_image)
                                    <div class="item">
                                        <a data-zoom-id="Zoom-1" href="{{ $product->detail_page_image_value }}"
                                            data-image="{{ $product->detail_page_image_value }}"
                                            data-zoom-image-2x="{{ $product->detail_page_image_value }}"
                                            data-image-2x="{{ $product->detail_page_image_value }}">
                                            <img srcset="{{ $product->detail_page_image_value }}"
                                                src="{{ $product->detail_page_image_value }}" />
                                        </a>
                                    </div>
                                @endif
                                @if ($product_galleries->isNotEmpty())
                                    @foreach ($product_galleries as $gallery)
                                        @if ($gallery->file_type == 'Image')
                                            <div class="item">
                                                <a data-zoom-id="Zoom-1" href="{{ $gallery->image_value }}"
                                                    data-image="{{ $gallery->image_value }}"
                                                    daḍta-zoom-image-2x="{{ $gallery->image_value }}"
                                                    data-image-2x="{{ $gallery->image_value }}">
                                                    <img srcset="{{ $gallery->image_value }}"
                                                        src="{{ $gallery->image_value }}" />
                                                </a>
                                            </div>
                                        @elseif($gallery->file_type == 'Video')
                                            <div class="item vidBtn">
                                                <a data-zoom-id="video" href="javascript:void(0)"
                                                    data-image="{{ $gallery->thumb_image_value }}" tabindex="0">
                                                    <div class="icon">
                                                        <svg viewBox="0 0 33.242 33.238">
                                                            <path id="Path_1773" data-name="Path 1773" class="cls-1"
                                                                d="M20.772,14.935l-6.9-5.018a.832.832,0,0,0-1.322.671V20.621a.83.83,0,0,0,.455.742.838.838,0,0,0,.378.09.827.827,0,0,0,.489-.162l6.9-5.013a.826.826,0,0,0,0-1.343Z"
                                                                transform="translate(1.332 1.034)" />
                                                            <path id="Path_1774" data-name="Path 1774" class="cls-1"
                                                                d="M16.622,0A16.619,16.619,0,1,0,33.242,16.624,16.62,16.62,0,0,0,16.622,0Zm0,30.465A13.845,13.845,0,1,1,30.465,16.624,13.843,13.843,0,0,1,16.622,30.467Z"
                                                                transform="translate(0 -0.002)" />
                                                        </svg>
                                                    </div>
                                                    <img class="img-fluid" srcset="{{ $gallery->thumb_image_value }}"
                                                        src="{{ $gallery->thumb_image_value }}">
                                                </a>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif

                            </div>
                        </div>

                        <div class="proSlideSec MobSlide">
                            <div class="mainSlide">
                                @if ($product->detail_page_image)
                                    <div class="item">
                                        <a href="{{ $product->detail_page_image_value }}" data-fancybox="proGal">
                                            <img src="{{ $product->detail_page_image_value }}"
                                                data-lazy="{{ $product->detail_page_image_value }}" alt="pro img">
                                        </a>
                                    </div>
                                @endif
                                @if ($product_galleries->isNotEmpty())
                                    @foreach ($product_galleries as $gallery)
                                        @if ($gallery->file_type == 'Image')
                                            <div class="item">
                                                <a href="{{ $gallery->image_value }}" data-fancybox="proGal">
                                                    <img src="{{ $gallery->image_value }}"
                                                        data-lazy="{{ $gallery->image_value }}" alt="pro img">
                                                </a>
                                            </div>

                                            <div class="item">
                                                <a>
                                                    <video src="{{ $product->detail_page_image_value }}" autoplay="true"
                                                        muted preload="auto" controls=""></video>
                                                </a>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                                @if (!$product->detail_page_image && $product_galleries->isEmpty())
                                    <div class="item">
                                        <a href="{{ $product->detail_page_image_value }}" data-fancybox="proGal">
                                            <img src="{{ $product->detail_page_image_value }}"
                                                data-lazy="{{ $product->detail_page_image_value }}">
                                        </a>
                                    </div>
                                @endif
                            </div>
                            <div class="thumbSlide">
                                @if ($product->detail_page_image)
                                    <div class="item">
                                        <a href="javascript:void(0)">
                                            <img src="{{ $product->detail_page_image_value }}"
                                                data-lazy="{{ $product->detail_page_image_value }}" alt="pro img">
                                        </a>
                                    </div>
                                @endif
                                @if ($product_galleries->isNotEmpty())
                                    @foreach ($product_galleries as $gallery)
                                        @if ($gallery->file_type == 'Image')
                                            <div class="item">
                                                <a href="javascript:void(0)">
                                                    <img src="{{ $gallery->image_value }}"
                                                        data-lazy="{{ $gallery->image_value }}" alt="pro img">
                                                </a>
                                            </div>
                                        @elseif($gallery->file_type == 'Video')
                                            <div class="item">
                                                <a href="javascript:void(0)">
                                                    <img src="{{ $gallery->thumb_image_value }}"
                                                        data-lazy="{{ $gallery->thumb_image_value }}" alt="pro img">
                                                    <div class="icon">
                                                        <svg viewBox="0 0 33.242 33.238">
                                                            <path id="Path_1773" data-name="Path 1773" class="cls-1"
                                                                d="M20.772,14.935l-6.9-5.018a.832.832,0,0,0-1.322.671V20.621a.83.83,0,0,0,.455.742.838.838,0,0,0,.378.09.827.827,0,0,0,.489-.162l6.9-5.013a.826.826,0,0,0,0-1.343Z"
                                                                transform="translate(1.332 1.034)" />
                                                            <path id="Path_1774" data-name="Path 1774" class="cls-1"
                                                                d="M16.622,0A16.619,16.619,0,1,0,33.242,16.624,16.62,16.62,0,0,0,16.622,0Zm0,30.465A13.845,13.845,0,1,1,30.465,16.624,13.843,13.843,0,0,1,16.622,30.467Z"
                                                                transform="translate(0 -0.002)" />
                                                        </svg>
                                                    </div>
                                                </a>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="ProInfoSec">
                        <div class="ProInfoSecWrp">
                            <h1 class="name">{{ $product->title }}</h1>
                            <div class="pcode">Product Code:<span>{{ $product->product_code }}</span></div>
                            <div class="mdlNu">Model Number:<span>{{ $product->model_number }}</span></div>
                            <div class="sku">SKU:{{ $product->sku }}</div>
                            @if ($product->is_instock)
                                <div class="quantitySec">
                                    <div class="label">Minimum Quantity:</div>
                                    <div class="quantity buttons_added">
                                        <input type="button" value="-" data-operation="minus"
                                            class="minus change-quantity-detail-page"
                                            data-product="{{ $product->slug }}">
                                        <input type="number" step="1" min="{{ $product->min_quantity_to_buy }}"
                                            name="quantity" value="{{ $product->min_quantity_to_buy }}" title="Qty"
                                            class="input-text qty text change-quantity-input-detail-page quantityField"
                                            size="4" pattern="" inputmode=""
                                            data-product="{{ $product->slug }}">
                                        <input type="button" value="+" data-operation="plus"
                                            class="plus change-quantity-detail-page" data-product="{{ $product->slug }}">
                                    </div>
                                </div>
                                {{-- <div class="deliveryInfo">
                                    Delivery by9 Sep, Saturday
                                    <span>if ordered before 5:39 PM</span>
                                </div> --}}
                                <div class="flxBx">
                                    <div class="priceD">
                                        <div class="cPrice">@currencySymbolWithConvertedPrice($product->price)</div>
                                        @if ($product->base_price > $product->price)
                                            <div class="oPrice">@currencySymbolWithConvertedPrice($product->base_price)</div>
                                        @endif
                                    </div>
                                    <div class="totalP payable-amount-div">
                                        <div class="lbl">Payable Amount</div>
                                        <div class="price product-total-price-div">@currencySymbolWithConvertedPrice($product->min_product_price)</div>
                                    </div>
                                </div>
                                <div class="expectedP">
                                    <div class="lbl">Bid Price:</div>
                                    <input type="text" name="bid_price" id="bid_price"
                                        class="form-control bid-price-detail-page amountField"
                                        data-product="{{ $product->slug }}" placeholder="Enter Amount">

                                </div>
                                <div class="flxBx">
                                    <div class="totalP bid-payable-amount-div d-none">
                                        <div class="lbl">Payable Amount</div>
                                        <div class="price product-total-price-div">@currencySymbolWithConvertedPrice($product->min_product_price)</div>
                                    </div>
                                </div>
                                <div class="btnBx">
                                    <a href="javascript:void(0)" class="quote add-to-quote-product-detail"
                                        data-product="{{ $product->slug }}">
                                        Add to Quote
                                        <svg viewBox="0 0 19.169 19.5">
                                            <g id="cart" transform="translate(-2.46 -2.25)">
                                                <path id="Path_102143" data-name="Path 102143"
                                                    d="M21.19,5.83a1.751,1.751,0,0,0-1.3-.58H7.54L7.17,4.13A2.754,2.754,0,0,0,4.56,2.25H3.21a.75.75,0,0,0,0,1.5H4.56a1.25,1.25,0,0,1,1.19.85l.52,1.56.79,7.14a2.742,2.742,0,0,0,2.73,2.45h8.42a2.742,2.742,0,0,0,2.73-2.45l.68-6.11a1.746,1.746,0,0,0-.44-1.36Zm-1.73,7.31a1.246,1.246,0,0,1-1.24,1.11H9.8a1.246,1.246,0,0,1-1.24-1.11L7.85,6.75H19.89a.26.26,0,0,1,.19.08.24.24,0,0,1,.06.19l-.68,6.11Z" />
                                                <path id="Path_102144" data-name="Path 102144"
                                                    d="M9.5,17.25a2.25,2.25,0,1,0,2.25,2.25A2.253,2.253,0,0,0,9.5,17.25Zm0,3a.75.75,0,1,1,.75-.75A.755.755,0,0,1,9.5,20.25Z" />
                                                <path id="Path_102145" data-name="Path 102145"
                                                    d="M18.5,17.25a2.25,2.25,0,1,0,2.25,2.25A2.253,2.253,0,0,0,18.5,17.25Zm0,3a.75.75,0,1,1,.75-.75A.755.755,0,0,1,18.5,20.25Z" />
                                            </g>
                                        </svg>
                                    </a>
                                </div>
                            @else
                                <div class="btnBx">
                                    <a href="javascript:void(0)" class="quote notify-me" id="notify"
                                        data-id={{ $product->slug }}>
                                        Notify Me
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section id="moreInfoSec">
            <div class="container">
                <!-- <div class="accordion" id="ProAccord">
                                            <div class="FlxBtn">
                                                <div class="buttonSec">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                        Description
                                                    </button>
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                        Specifications
                                                    </button>
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                        Additional Details
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="innerBx">
                                                <div class="accordion-item">
                                                    <div class="accordion-header" id="headingOne">
                                                        <button class="accordion-button mobBtn collapsed" type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                            Description
                                                        </button>
                                                    </div>
                                                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                                        data-bs-parent="#ProAccord">
                                                        <div class="accordion-body">
                                                            <div class="details">
                                                                <div class="specDtail">
                                                                    <p>The iPhone 11 boasts a gorgeous all-screen Liquid Retina LCD that is water
                                                                        resistant up to 2 metres for up to 30 minutes. Moreover, the ultra-wide 13
                                                                        mm lens has a 120-degree field of view for four times more scenes, and the
                                                                        26 mm wide lens provides up to 100% Autofocus in low light.</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <div class="accordion-header" id="headingTwo">
                                                        <button class="accordion-button mobBtn collapsed" type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                            Specifications
                                                        </button>
                                                    </div>
                                                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                                        data-bs-parent="#ProAccord">
                                                        <div class="accordion-body">
                                                            <div class="details">
                                                                <div class="specBx">
                                                                    <div class="cTitle">General</div>
                                                                    <ul class="spec">
                                                                        <li><span>In The Box</span>Handset, USB-C to Lightning Cable, Documentation
                                                                        </li>
                                                                        <li><span>Model Number</span>MPUF3HN/A</li>
                                                                        <li><span>Model Name</span>iPhone 14</li>
                                                                        <li><span>Color</span>Midnight</li>
                                                                        <li><span>Browse Type</span>Smartphones</li>
                                                                        <li><span>SIM Type</span>Dual Sim(Nano + eSIM)</li>
                                                                        <li><span>Hybrid Sim Slot</span>No</li>
                                                                        <li><span>Touchscreen</span>Yes</li>
                                                                        <li><span>OTG Compatible</span>No</li>
                                                                        <li><span>Sound Enhancements</span>Built-in Stereo Speaker</li>
                                                                    </ul>
                                                                    <div class="cTitle">Display Features</div>
                                                                    <ul class="spec">
                                                                        <li><span>Display Size</span>15.49 cm (6.1 inch)</li>
                                                                        <li><span>Resolution</span>2532 x 1170 Pixels</li>
                                                                        <li><span>Resolution Type</span>Super Retina XDR Display</li>
                                                                        <li><span>GPU</span>5 Core</li>
                                                                        <li><span>Display Type</span>Super Retina XDR Display</li>
                                                                        <li><span>Other Display Features</span>HDR Display, True Tone, Wide Colour
                                                                            (P3), Haptic Touch, Contrast Ratio: 20,00,000:1, Max Brightness: 800
                                                                            nits, Peak Brightness: 1,200 nits, Fingerprint Resistant Oleophobic
                                                                            Coating,
                                                                            Support for Display of Multiple Languages and Characters Simultaneously
                                                                        </li>
                                                                    </ul>
                                                                    <div class="cTitle">Os & Processor Features</div>
                                                                    <ul class="spec">
                                                                        <li><span>Operating System</span>iOS 16</li>
                                                                        <li><span>Processor Type</span>A15 Bionic Chip, 6 Core Processor</li>
                                                                        <li><span>Processor Core</span>Hexa Core</li>
                                                                        <li><span>Operating Frequency</span>5G NR (Bands n1, n2, n3, n5, n7, n8,
                                                                            n12, n20, n25, n26, n28, n30, n38, n40, n41, n48, n53, n66, n70, n77,
                                                                            n78, n79), 4G FDD-LTE (B1, B2, B3, B4, B5, B7, B8, B12, B13, B17, B18,
                                                                            B19, B20, B25,
                                                                            B26, B28, B30, B32, B66), 4G TD-LTE (B34, B38, B39, B40, B41, B42, B46,
                                                                            B48, B53), 3G UMTS/HSPA+/DC-HSDPA (850, 900, 1700/2100, 1900, 2100 MHz),
                                                                            2G GSM/EDGE (850,
                                                                            900, 1800, 1900 MHz)</li>
                                                                    </ul>
                                                                    <button type="" class="Readmore"><span>View More Details</span></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <div class="accordion-header" id="headingThree">
                                                        <button class="accordion-button mobBtn collapsed" type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                            Additional Details
                                                        </button>
                                                    </div>
                                                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                                        data-bs-parent="#ProAccord">
                                                        <div class="accordion-body">
                                                            <div class="details">

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->
                @if ($product->description)
                    <div class="title">Description</div>
                    <p>{!! $product->description !!}</p>
                @endif
            </div>
        </section>


        <!-- SLICK-->
        <link rel="stylesheet" type="text/css"
            href="//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

        <!-- OWL-->
        <link rel="stylesheet" type="text/css"
            href="//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
        <!-- FANCY_BOX-->
        <link rel="stylesheet" type="text/css"
            href="//cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.6/jquery.fancybox.min.css">
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.6/jquery.fancybox.min.js"></script>

        <!-- MAGIC_ZOOM-->
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/magiczoom.min.css') }}">
        <script type="text/javascript" src="{{ asset('frontend/js/magiczoom.min.js') }}"></script>
        @push('js')
            <script>
                $('.mainSlide').slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                    fade: true,
                    asNavFor: '.thumbSlide'
                });
                $('.thumbSlide').slick({
                    slidesToShow: 5,
                    infinite: true,
                    slidesToScroll: 1,
                    asNavFor: '.mainSlide',
                    dots: false,
                    vertical: true,
                    arrows: true,
                    focusOnSelect: true,
                    prevArrow: "<button type='button' class='slick-prev pull-left'></button>",
                    nextArrow: "<button type='button' class='slick-next pull-right'></button>",
                    responsive: [{
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 4,
                        }
                    }]
                });
                $('[data-fancybox]').fancybox({
                    protect: true,
                    keyboard: true,
                });
                if ($(window).width() >= 992) {
                    const slider = $(".thumbSlide");
                    slider;
                    slider.on("wheel", function(e) {
                        e.preventDefault();
                        if (e.originalEvent.deltaY < 0) {
                            $(this).slick("slickNext");
                        } else {
                            $(this).slick("slickPrev");
                        }
                    });
                }
                /***************************************/
                /************ PRO_VIDEO ****************/
                /***************************************/
                $('.proSlideSec .thumbSlide a[data-zoom-id="video"]').on("click", function() {
                    $('.proSlideSec [data-slide-id="video"]').addClass("active");
                    $('.proSlideSec [data-slide-id="zoom"]').removeClass("active");
                });
                $('.proSlideSec .thumbSlide a[data-zoom-id="video"]').hover(function() {
                    $('.proSlideSec [data-slide-id="video"]').addClass("active");
                    $('.proSlideSec [data-slide-id="zoom"]').removeClass("active");
                });
                $('.proSlideSec .thumbSlide a[data-zoom-id="Zoom-1"]').on("click", function() {
                    $('.proSlideSec [data-slide-id="video"]').removeClass("active");
                    $('.proSlideSec [data-slide-id="zoom"]').addClass("active");
                    $('.proSlideSec [data-slide-id="video"] video').trigger("pause");
                });
                $('.proSlideSec .thumbSlide a[data-zoom-id="Zoom-1"]').hover(function() {
                    $('.proSlideSec [data-slide-id="video"]').removeClass("active");
                    $('.proSlideSec [data-slide-id="zoom"]').addClass("active");
                    $('.proSlideSec [data-slide-id="video"] video').trigger("pause");
                });
                $('.proSlideSec .thumbSlide a[data-zoom-id="video"]').click(function() {
                    $('.proSlideSec [data-slide-id="video"] video').trigger("play");
                });
                $('.proSlideSec .thumbSlide a[data-zoom-id="video"]').hover(function() {
                    $('.proSlideSec [data-slide-id="video"] video').trigger("play");
                });

                $(".Readmore").on('click', function() {
                    $(this).parent().toggleClass("open");
                    var replaceText = $(this).parent().hasClass('open') ? "View Less Details" : "View More Details";
                    $(".Readmore span").text(replaceText);
                });
            </script>
        @endpush

    </div>

@endsection
