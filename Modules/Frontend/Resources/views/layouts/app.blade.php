<!DOCTYPE html>
<html lang="en">
<!--
 ██╗███╗░░██╗████████╗███████╗██████╗░░██████╗███╗░░░███╗░█████╗░██████╗░████████╗
 ██║████╗░██║╚══██╔══╝██╔════╝██╔══██╗██╔════╝████╗░████║██╔══██╗██╔══██╗╚══██╔══╝
 ██║██╔██╗██║░░░██║░░░█████╗░░██████╔╝╚█████╗░██╔████╔██║███████║██████╔╝░░░██║░░░
 ██║██║╚████║░░░██║░░░██╔══╝░░██╔══██╗░╚═══██╗██║╚██╔╝██║██╔══██║██╔══██╗░░░██║░░░
 ██║██║░╚███║░░░██║░░░███████╗██║░░██║██████╔╝██║░╚═╝░██║██║░░██║██║░░██║░░░██║░░░
 ╚═╝╚═╝░░╚══╝░░░╚═╝░░░╚══════╝╚═╝░░╚═╝╚═════╝░╚═╝░░░░░╚═╝╚═╝░░╚═╝╚═╝░░╚═╝░░░╚═╝░░░
 -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, shrink-to-fit=no, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Remove when go to live -->
    <meta name="robots" content="noindex">
    <meta name="googlebot" content="noindex">
    <!-- end section -->

    <title>@yield('meta_title', \App\Helpers\AdminHelper::getValueByKey('website_name'))</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('meta_description')">
    <meta name="keywords" content="@yield('meta_keywords')">
    @yield('other_meta_tags')
    <link rel="icon" href="{{ asset('frontend/images/favicon.ico') }}" type="image/x-icon">
    <link rel="manifest" href="manifest.webmanifest">
    <meta name="msapplication-TileColor" content="#E7151F">
    <meta name="theme-color" content="#E7151F">

    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Wix+Madefor+Display:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link href="//cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel=" stylesheet" href="{{ asset('backend/plugins/toastr/toastr.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <style>
        /* Inline critical CSS here */
    </style>
    @stack('css')
    <!-- INCLUDES -->
    <link rel="stylesheet preload" href="{{ asset('frontend/css/app.min.css') }}" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="{{ asset('frontend/css/app.min.css') }}">
    </noscript>
    <!-- JQUERY --->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/jquery-validate-1.19.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/jquery-additional-methods-1.19.5.min.js') }}"></script>
</head>

<body class="{{ Session::get('theme') }} {{ Nav::isRoute('home', 'HomePg') }}">
    {{-- header --}}
    @if (Auth::guard('web')->check())
        @include('frontend::layouts.header')
    @else
        @include('frontend::layouts.home-header')
    @endif

    <div id="viewport">

        {{-- content --}}
        @yield('content')
        {{-- footer --}}
        @include('frontend::layouts.footer')
    </div>
    {{-- toastr --}}
    @include('frontend::layouts.toastr-message')
    <!-- BOOTSTRAP --->

    <script src="//cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"
        integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- LAZY LOAD --->
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/intersection-observer@0.7.0/intersection-observer.min.js">
    </script>
    <script src="//cdn.jsdelivr.net/npm/vanilla-lazyload@17.8.3/dist/lazyload.min.js"></script>

    <!-- GSAP --->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollTrigger/1.0.6/ScrollTrigger.min.js"
        integrity="sha512-+LXqbM6YLduaaxq6kNcjMsQgZQUTdZp7FTaArWYFt1nxyFKlQSMdIF/WQ/VgsReERwRD8w/9H9cahFx25UDd+g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"
        integrity="sha512-16esztaSRplJROstbIIdwX3N97V1+pZvV33ABoG1H2OyTttBxEGkTsoIVsiP1iaTtM8b3+hu2kB6pQ4Clr5yug=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- CUSTOME --->
    <script type="text/javascript" src="{{ asset('frontend/js/app.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('backend/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    {{-- Toastr --}}
    <script src="{{ asset('backend/plugins/toastr/toastr.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/custom.js') }}"></script>
    @stack('js')
    <script>
        var fc_path = "{{ asset('/') }}";
        var base_path = "{{ url('/') }}";
    </script>
    <script>
        $(".select").select2({
            minimumResultsForSearch: Infinity,
            theme: "bootstrap-5",
            containerCssClass: "select2--small",
            selectionCssClass: "select2--small",
            dropdownCssClass: "select2--small",
        });

        $(function() {
            $('.selectpicker').selectpicker();
        });

        var isAuthenticated = @json(auth()->check());

        var $hamburger = $(".MenuBtn");
        TweenLite.set("#MainMenu .MainMenuLinks li", {
                autoAlpha: 0,
                x: -110
            }),
            TweenLite.set("#MainMenu .MenuBtn", {
                autoAlpha: 0,
                x: -110
            })
        var hamburgerMotion = new TimelineMax()
            .from("#MainMenu", 0.4, {
                autoAlpha: 0,
                x: "-100%"
            }, 0.2, 0.5)
            .staggerTo("#MainMenu .MainMenuLinks li", 0.2, {
                autoAlpha: 1,
                x: 0,
                ease: Sine.easeOut
            }, 0.1, 0.3)
            .to("#MainMenu .MenuBtn", 0.3, {
                autoAlpha: 1,
                x: 0
            }, 1, 0.3)
            .reverse();
        $hamburger.on("click", function(e) {
            hamburgerMotion.reversed(!hamburgerMotion.reversed());
        });

        if (!isAuthenticated) {
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
            });


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
            });
        }
    </script>
</body>

</html>
