<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8" />
    <title> @yield('title') | Pemerintah Kabupaten Kolaka Utara</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="Sistem Pajak Online BAPENDA Kabupaten Kolaka Utara" name="description" />
    <meta content="TIM IT Kolaka Utara" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('assets/images/favicon.ico') }}">
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
            background-image: url(../../assets/images/bg-kolutkab-dark.jpg) !important;
            background-position: 50%;
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>
    {!! ReCaptcha::htmlScriptTagJsApi() !!}
</head>

<body @if(request()->is('confirm')) class="auth-body-bg" @endif>

@yield('content')
@include('layouts.vendor-script-without-nav')
@livewireScripts
</body>
</html>
