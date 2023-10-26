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
                                @if (!$product->detail_page_image && $product_galleries->isEmpty())
                                <div data-slide-id="zoom" class="zoom_gallery_slide active">
                                    <a id="Zoom-1" class="MagicZoom" title="" href="{{ $product->detail_page_image_value }}"
                                        data-zoom-image-8x="{{ $product->detail_page_image_value }}"
                                        data-image-8x="{{ $product->detail_page_image_value }}">
                                        <img src="{{ $product->detail_page_image_value }}" class="lazy" loading="lazy"
                                            data-src="{{ $product->detail_page_image_value }}" srcset="{{ $product->detail_page_image_value }}" alt="" />
                                    </a>
                                </div>
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
                            @if($product->product_code)
                            <div class="pcode">Product Code:<span>{{ $product->product_code }}</span></div>
                            @endif
                            @if($product->model_number)
                            <div class="mdlNu">Model Number:<span>{{ $product->model_number }}</span></div>
                            @endif
                            @if($product->sku)
                            <div class="sku">SKU:{{ $product->sku }}</div>
                            @endif
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
                            @endif
                                <div class="flxBx">
                                    <div class="priceD">
                                        <div class="cPrice">@currencySymbolWithConvertedPrice($product->price)</div>
                                        @if ($product->base_price > $product->price)
                                            <div class="oPrice">@currencySymbolWithConvertedPrice($product->base_price)</div>
                                        @endif
                                    </div>
                                    @if ($product->is_instock)
                                        <div class="totalP payable-amount-div">
                                            <div class="lbl">Payable Amount</div>
                                            <div class="price product-total-price-div">@currencySymbolWithConvertedPrice($product->min_product_price)</div>
                                        </div>
                                    @endif
                                </div>
                            @if ($product->is_instock)
                                <div class="expectedP">
                                    <div class="lbl">Bid Price (Per Unit):</div>
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
                                    <a href="javascript:void(0)" class="quote hoveranim add-to-quote-product-detail"
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
                                    <a href="javascript:void(0)" class="notify notify-me hoveranim" id="notify"
                                        data-id={{ $product->slug }}>
                                        <span>Notify Me</span>
                                        <svg viewBox="0 0 100 101">
                                            <g>
                                                <path d="m31.0636 12.3681c.381.7356.0935 1.6409-.6421 2.0219-4.35 2.2532-8.1111 5.495-10.9812 9.465-2.8702 3.9701-4.7695 8.5579-5.5454 13.395-.1312.818-.9007 1.3747-1.7187 1.2435s-1.3747-.9007-1.2435-1.7187c.8502-5.3002 2.9314-10.3272 6.0764-14.6774 3.1449-4.3502 7.2661-7.9023 12.0326-10.3713.7356-.381 1.6408-.0936 2.0219.642z"></path>
                                                <path d="m33.9002 17.8446c.381.7356.0936 1.6408-.642 2.0218-3.4938 1.8097-6.5146 4.4134-8.8198 7.6021-2.3053 3.1886-3.8307 6.8734-4.4539 10.7584-.1312.8179-.9007 1.3747-1.7187 1.2434-.8179-.1312-1.3746-.9006-1.2434-1.7186.6974-4.3481 2.4047-8.4721 4.9848-12.0409 2.58-3.5687 5.9609-6.4828 9.8712-8.5082.7356-.3811 1.6408-.0936 2.0218.642z"></path>
                                                <path d="m66.7424 19.8664c-.7356-.381-1.023-1.2862-.642-2.0218s1.2863-1.0231 2.0219-.642c3.9102 2.0254 7.2911 4.9395 9.8712 8.5082 2.58 3.5688 4.2873 7.6928 4.9848 12.0409.1312.818-.4255 1.5874-1.2435 1.7186-.818.1313-1.5874-.4255-1.7186-1.2434-.6232-3.885-2.1487-7.5698-4.4539-10.7584-2.3053-3.1887-5.3261-5.7924-8.8199-7.6021z"></path>
                                                <path d="m68.9371 12.3681c-.381.7356-.0936 1.6409.642 2.0219 4.35 2.2532 8.1111 5.495 10.9813 9.465 2.8702 3.9701 4.7695 8.5579 5.5454 13.395.1312.818.9007 1.3747 1.7186 1.2435.818-.1312 1.3747-.9007 1.2435-1.7187-.8502-5.3002-2.9313-10.3272-6.0763-14.6774s-7.2662-7.9023-12.0327-10.3713c-.7356-.381-1.6408-.0936-2.0218.642z"></path>
                                                <path clip-rule="evenodd" d="m26.5739 46.2372v14.6765h-.2419c-2.8197 0-5.1056 2.2859-5.1056 5.1056s2.2858 5.1056 5.1056 5.1056h47.3364c2.8198 0 5.1056-2.2859 5.1056-5.1056s-2.2858-5.1056-5.1056-5.1056h-.2417v-14.6765c0-12.938-10.4884-23.4264-23.4264-23.4264-12.9381 0-23.4264 10.4884-23.4264 23.4264zm3 17.6765v-17.6765c0-11.2812 9.1452-20.4264 20.4264-20.4264 11.2811 0 20.4264 9.1453 20.4264 20.4264v17.6765h3.2417c1.1629 0 2.1056.9427 2.1056 2.1056s-.9427 2.1056-2.1056 2.1056h-47.3364c-1.1629 0-2.1056-.9427-2.1056-2.1056s.9427-2.1056 2.1056-2.1056z" fill-rule="evenodd"></path>
                                                <path clip-rule="evenodd" d="m39.6352 76.5417c-.2816-.9731-.4254-1.983-.4254-3h21.5805c0 1.017-.1437 2.0269-.4254 3-.1108.3827-.2429.7597-.3959 1.1292-.5423 1.3092-1.3371 2.4987-2.3391 3.5006-1.0019 1.002-2.1914 1.7968-3.5006 2.3391-1.3091.5422-2.7122.8213-4.1292.8213s-2.8201-.2791-4.1293-.8213c-1.3091-.5423-2.4986-1.3371-3.5006-2.3391-1.002-1.0019-1.7968-2.1914-2.339-3.5006-.1531-.3695-.2852-.7465-.396-1.1292zm15.8734 2.5085c.7186-.7186 1.2896-1.5708 1.6809-2.5085h-14.3789c.3913.9377.9623 1.7899 1.6809 2.5085.7234.7234 1.5822 1.2972 2.5274 1.6887.9451.3915 1.9581.593 2.9812.593 1.023 0 2.036-.2015 2.9812-.593.9451-.3915 1.8039-.9653 2.5273-1.6887z" fill-rule="evenodd"></path>
                                                <path d="m47.6478 17.1807c-.8284 0-1.5.6716-1.5 1.5s.6716 1.5 1.5 1.5h4.7053c.8284 0 1.5-.6716 1.5-1.5s-.6716-1.5-1.5-1.5z"></path>
                                            </g>
                                        </svg>
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
