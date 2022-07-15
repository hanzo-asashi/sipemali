<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8" />
    <title> @yield('title') | Pemerintah Kabupaten Kolaka Utara</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="Sistem Pembayaran Air Online PERUMDA TIRTA OMPO Kabupaten Soppeng" name="description" />
    <meta content="RESOMETODA" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('favicon.png') }}">
    @include('layouts.head-css')
    @livewireStyles
    <style type="text/css">
        .unstyle {
            list-style: none;
            margin: 0;
            padding: 0;
        }
        .unstyle li {
            padding-bottom: 10px;
        }
        .unstyle li b {
            display: inline-block;
            width: 180px !important;
        }
        .unstyle li b:after {
            content: " :";
            float: right !important;
        }

        .bg-card-img {
            background-image: url("../../assets/images/bg-kolutkab-dark.jpg") !important;
            /*background-image: url('../../assets/images/bg-kolutkab-dark.jpg') !important;*/
            background-position: 50%;
            background-size: cover;
            background-repeat: no-repeat;
        }

        .auth-bg {
            background-image: url("../../assets/images/bg-kolutkab.jpg");
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
        }

        .auth-bg .bg-overlay {
            opacity: 0.9;
        }

        @media (min-width: 768px) {
            .auth-bg {
                height: 100vh;
            }
        }
    </style>
    {!! ReCaptcha::htmlScriptTagJsApi() !!}
</head>

<body @if(request()->is('confirm')) class="auth-body-bg" @endif>

@yield('content')
@include('layouts.vendor-script-without-nav')
@livewireScripts
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r121/three.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vanta@latest/dist/vanta.birds.min.js"></script>
<script>
    VANTA.BIRDS({
        el: "#vanta",
        mouseControls: true,
        touchControls: true,
        gyroControls: true,
        minHeight: 200.00,
        minWidth: 200.00,
        colorMode: "variance",
        birdSize: 1.60,
        // color1: 0xcdb60a,
        // color2: 0xff2d00,
        scale: 1.00,
        scaleMobile: 1.00,
        wingSpan: 40.00,
        speedLimit: 10.00,
        separation: 67.00,
        alignment: 18.00,
        cohesion: 10.00,
        quantity: 3.00,
        backgroundAlpha: 0.00,
        backgroundColor: 0.00,
    })
</script>
</body>
</html>
