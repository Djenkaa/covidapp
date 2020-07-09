<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="author" content="Gedeon">
    <meta name="publisher" content="Gedeon">
    <meta name="copyright" content="Gedeon">
    <meta name="robots" content="index, follow">
    <meta name="keywords" content="corona, virus, symptoms, statistics, analytics, people, die, percentage, coronavirus, covid, 19, confirmed, case, recovered, deaths, country, travel, alert, hospital, testing, tips, tracking">
    <meta name="description" content="We collect and process data around the clock, 24 hours a day, 7 days a week. Multiple updates per 10 minutes are performed on average by our team of analysts and researchers who validate the data from an ever-growing list of sources under the constant solicitation of users who alert us as soon as an official announcement is made anywhere around the world.">

    <meta property="og:title" content="Covid-19" />
    <meta property="og:description" content="Detailed statistics for the Covid-19 virus">
    <meta property="og:image" content="/img/covid.jpg">

    @yield('meta_tag')

    <title>{{ config('app.name', 'Argon Dashboard') }} - @yield('title')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <script src="https://kit.fontawesome.com/f5d5be0339.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/all.css">
</head>
<body class="{{ $class ?? '' }}">






@include('layouts.navbars.sidebar')


<div class="main-content">
    @include('layouts.navbars.navbar')

        @yield('content')

</div>


@shared
<script src="/js/all.js"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-144192815-2"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-144192815-2');
</script>


@stack('js')
</body>
</html>


