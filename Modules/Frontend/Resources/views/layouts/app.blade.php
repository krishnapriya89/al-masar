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

<body>
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

        // function wcqib_refresh_quantity_increments() {
        //     jQuery("div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)").each(function(a, b) {
        //         var c = jQuery(b);
        //         c.addClass("buttons_added"), c.children().first().before(
        //             '<input type="button" value="-" class="minus" />'), c.children().last().after(
        //             '<input type="button" value="+" class="plus" />')
        //     })
        // }
        // String.prototype.getDecimals || (String.prototype.getDecimals = function() {
        //     var a = this,
        //         b = ("" + a).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
        //     return b ? Math.max(0, (b[1] ? b[1].length : 0) - (b[2] ? +b[2] : 0)) : 0
        // }), jQuery(document).ready(function() {
        //     wcqib_refresh_quantity_increments()
        // }), jQuery(document).on("updated_wc_div", function() {
        //     wcqib_refresh_quantity_increments()
        // }), jQuery(document).on("click", ".plus, .minus", function() {
        //     var a = jQuery(this).closest(".quantity").find(".qty"),
        //         b = parseFloat(a.val()),
        //         c = parseFloat(a.attr("max")),
        //         d = parseFloat(a.attr("min")),
        //         e = a.attr("step");
        //     b && "" !== b && "NaN" !== b || (b = 0), "" !== c && "NaN" !== c || (c = ""), "" !== d && "NaN" !== d ||
        //         (
        //             d = 0), "any" !== e && "" !== e && void 0 !== e && "NaN" !== parseFloat(e) || (e = 1), jQuery(
        //             this)
        //         .is(".plus") ? c && b >= c ? a.val(c) : a.val((b + parseFloat(e)).toFixed(e.getDecimals())) : d &&
        //         b <=
        //         d ? a.val(d) : b > 0 && a.val((b - parseFloat(e)).toFixed(e.getDecimals())), a.trigger("change")
        // });
    </script>
</body>

</html>
