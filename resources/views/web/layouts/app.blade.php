<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @yield('css')
</head>
<body class="d-flex main-container bg-dark" style="min-height: 100%;">
<div class="cover-container d-flex w-100 p-3 mx-auto flex-column">
    @include('web.layouts.header')

    @yield('content')

    @include('web.layouts.footer')
</div>
<!-- Badges Modal -->
<div class="modal fade" id="badgeModal" tabindex="-1" aria-labelledby="Badges" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{trans('home.Badges')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modal-body-badges">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{trans('home.Close')}}</button>
            </div>
        </div>
    </div>
</div>
@yield('javascript')
</body>
</html>
