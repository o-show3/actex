<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
</head>
<body>
@include('common.navbar')
<div class="columns">
    <div class="column is-2">
        @include('common.sidemenu')
    </div>
    <div class="column">
        <div class="column is-full">
            <section class="hero is-primary is-small">
                <div class="hero-body">
                    <p class="title">
                        @yield('title')
                    </p>
                    <p class="subtitle">
                        @yield('subtitle')
                    </p>
                </div>
            </section>
        </div>

        <div class="column is-full">
            @yield('content')
        </div>
    </div>
</div>
</body>
</html>
