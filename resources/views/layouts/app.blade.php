<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="app_locale" content="{{ app()->getLocale() }}">
    <title>@section('title') :: {{ config('app.name', 'Predictor') }} @show</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{--@include('layouts.partials.googleanalytics')--}}
</head>
<body>
    <div id="app">
        @include('layouts.partials.language')
        @include('layouts.partials.header')
        @yield('content')
        @include('layouts.partials.footer')
    </div>
    <!-- Scripts -->
    <script src="{{ mix('js/messages.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        $(document).foundation();
    </script>
    @yield('scripts')
</body>
</html>
