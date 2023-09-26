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
    <meta name="description" content="Your website description goes here">
    <meta name="keywords" content="your, keywords, go, here">
    <link rel="icon" href="{{ asset('frontend/images/favicon.ico') }}" type="image/x-icon">

    <title> Al Masar Al Saree Trading L.L.C</title>

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

        @stack('css')

    <!-- JQUERY --->
    <script type="text/javascript" src="{{asset('frontend/js/jquery-3.7.0.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/jquery-validate-1.19.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/jquery-additional-methods-1.19.5.min.js') }}"></script>
    <!-- BOOTSTRAP --->

    <script src="//cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"
        integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous">
    </script>

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

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

    <!-- ANIMATE CSS --->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <style>
        /* Inline critical CSS here */
    </style>

    <!-- INCLUDES -->
    <link rel="stylesheet preload" href="{{ asset('frontend/css/app.min.css') }}" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="{{ asset('frontend/css/app.min.css') }}">
    </noscript>

</head>

<body>


    <div id="viewport">
        {{-- header --}}
        @include('frontend::layouts.header')
        {{-- content --}}
        @yield('content')
        {{-- footer --}}
        @include('frontend::layouts.footer')
        <!-- CUSTOME --->
        <script type="text/javascript" src="{{ asset('frontend/js/app.min.js') }}"></script>
        @stack('js')
        <script type="text/javascript" src="{{asset('frontend/js/custom.js')}}"></script>
        <script>
            function wcqib_refresh_quantity_increments() {
                jQuery("div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)").each(function(a, b) {
                    var c = jQuery(b);
                    c.addClass("buttons_added"), c.children().first().before(
                        '<input type="button" value="-" class="minus" />'), c.children().last().after(
                        '<input type="button" value="+" class="plus" />')
                })
            }
            String.prototype.getDecimals || (String.prototype.getDecimals = function() {
                var a = this,
                    b = ("" + a).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
                return b ? Math.max(0, (b[1] ? b[1].length : 0) - (b[2] ? +b[2] : 0)) : 0
            }), jQuery(document).ready(function() {
                wcqib_refresh_quantity_increments()
            }), jQuery(document).on("updated_wc_div", function() {
                wcqib_refresh_quantity_increments()
            }), jQuery(document).on("click", ".plus, .minus", function() {
                var a = jQuery(this).closest(".quantity").find(".qty"),
                    b = parseFloat(a.val()),
                    c = parseFloat(a.attr("max")),
                    d = parseFloat(a.attr("min")),
                    e = a.attr("step");
                b && "" !== b && "NaN" !== b || (b = 0), "" !== c && "NaN" !== c || (c = ""), "" !== d && "NaN" !== d ||
                    (
                        d = 0), "any" !== e && "" !== e && void 0 !== e && "NaN" !== parseFloat(e) || (e = 1), jQuery(
                        this)
                    .is(".plus") ? c && b >= c ? a.val(c) : a.val((b + parseFloat(e)).toFixed(e.getDecimals())) : d &&
                    b <=
                    d ? a.val(d) : b > 0 && a.val((b - parseFloat(e)).toFixed(e.getDecimals())), a.trigger("change")
            });
        </script>
</body>

</html>