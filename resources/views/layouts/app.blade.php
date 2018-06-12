<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="app_locale" content="{{ app()->getLocale() }}">
    @yield('meta')
    <title>@section('title') :: {{ config('app.name', 'Predictor') }} @show</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/pnotify.css') }}" rel="stylesheet">
    {{--@include('layouts.partials.googleanalytics')--}}
    @include('layouts.partials.googletagmanager')
    <link rel="shortcut icon" href="/favicon.ico"/>
{{--    @include('layouts.partials.googletags')--}}

</head>
<body>
  <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5MKGX35"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<div id="app" style="display:none;" :class="{'show':loaded}">
    <!-- /6881/rd.univision_section_deportes/futbol/mundialrusia2018/predictordemisionrusia -->
    {{--<div id='div-gpt-ad-1528227919403-0' style="width: 728px; height: 90px">--}}
        {{--<script>--}}
          {{--googletag.cmd.push(function() { googletag.display('div-gpt-ad-1528227919403-0'); });--}}
        {{--</script>--}}
    {{--</div>--}}
    @include('layouts.partials.language')
    @include('layouts.partials.header')
    @yield('content')
    @include('layouts.partials.footer')
</div>
<!-- Scripts -->
<script src="{{ mix('js/messages.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/pnotify.js') }}"></script>
<script>
  $(document).foundation();
</script>
@yield('scripts')
</body>
</html>
