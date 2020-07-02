<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Argon Dashboard') }}</title>
    <!-- Favicon -->

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
{{--    <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">--}}
    <script src="https://kit.fontawesome.com/f5d5be0339.js" crossorigin="anonymous"></script>{{--    <!-- Argon CSS -->--}}
{{--    <link type="text/css" href="{{ asset('argon') }}/css/argon.css?v=1.0.0" rel="stylesheet">--}}
    <link rel="stylesheet" href="/css/all.css">
</head>
<body class="{{ $class ?? '' }}">






@include('layouts.navbars.sidebar')


<div class="main-content">
    @include('layouts.navbars.navbar')

        @yield('content')

</div>


@shared
{{--<script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>--}}
{{--<script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>--}}
{{--<script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>--}}
<script src="/js/all.js"></script>


@stack('js')

<!-- Argon JS -->
{{--<script src="{{ asset('argon') }}/js/argon.js?v=1.0.0"></script>--}}

</body>
</html>


