<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
{{--        <link rel="stylesheet" href="{{ asset('css/app.css') }}">--}}
        <link rel="stylesheet" href="{{ asset('css/uikit.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
        <!-- Scripts -->
{{--        <script src="{{ asset('js/app.js') }}" defer></script>--}}
        <script src="{{ asset('js/uikit.min.js') }}" defer></script>
        <script src="{{ asset('js/uikit-icons.min.js') }}" defer></script>
    </head>
    <body>
    <div data-src="{{ asset('img/background.jpg') }}" uk-height-viewport="expand: true" uk-img uk-grid>
        <div>
            <div class="uk-card uk-card-default uk-card-body uk-position-center	 uk-width-1-1">
                @include('layouts.navigation')
            </div>
        </div>

        @yield('content')
    </div>
    </body>
</html>
