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
    <link rel="icon" href="{{asset('images/logo_vertical.png')}}">
    <link rel="shortcut icon" href="{{asset('images/logo_vertical.png')}}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{asset('images/logo_vertical.png')}}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,100..700;1,100..700&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('custom_css/game.css?v=3')}}"/>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @yield('css')
</head>
<body class="d-flex main-container" style="min-height: 100%;">
<div class="cover-container d-flex w-100 p-3 mx-auto flex-column">
    @include('web.layouts.header')

    @yield('content')

    @include('web.layouts.footer')
</div>
<!-- Badges Modal -->
<div class="modal fade" id="badgeModal" tabindex="-1" aria-labelledby="Badges" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content modern-modal">
            <div class="modal-header modern-modal-header">
                <h5 class="modal-title">
                    <span class="modal-icon">🏆</span>
                    {{trans('home.Badges')}}
                </h5>
                <button type="button" class="btn-close-modern" data-bs-dismiss="modal" aria-label="Close">
                    ✕
                </button>
            </div>
            <div class="modal-body modal-body-badges">
                @foreach($badges as $badge)
                    <div class="badge-item">
                        <div class="badge-header">
                            <div class="badge-image-container">
                                <img src="{{$badge->image}}" alt="{{$badge->name}}" class="badge-image" />
                            </div>
                            <div class="badge-info">
                                <h5 class="badge-title">
                                    {{trans('home.Badge') . " " . $loop->iteration}}: {{trans('home.' . $badge->name)}}
                                </h5>
                                <div class="badge-requirement">
                                    <span class="requirement-icon">🎯</span>
                                    <strong>{{trans('home.Requirements: Reach')}} {{$badge->points}} {{trans('home.points')}}</strong>
                                </div>
                            </div>
                        </div>
                        <div class="badge-description">
                            <span class="description-icon">📝</span>
                            <p>{{trans('home.' . $badge->description)}}</p>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="modal-footer modern-modal-footer">
                <button type="button" class="btn-close-modal" data-bs-dismiss="modal">
                    {{trans('home.Close')}}
                </button>
            </div>
        </div>
    </div>
</div>

@yield('javascript')
<script>
    function setLeaderboardMaxHeight() {
        // Čekaj da se DOM učita
        const gameIntro = document.querySelector('.col-lg-6 .glass-card');
        const leftLeaderboard = document.getElementById('leftLeaderboardList');
        const rightLeaderboard = document.getElementById('rightLeaderboardList');

        if (gameIntro && leftLeaderboard && rightLeaderboard) {
            // Uzmi visinu game-intro kartice
            const gameIntroHeight = gameIntro.offsetHeight;

            // Uzmi padding i header visinu
            const leftColumn = document.getElementById('leftColumn');
            const rightColumn = document.getElementById('rightColumn');

            const leftHeader = leftColumn.querySelector('.text-center');
            const rightHeader = rightColumn.querySelector('.text-center');

            // Izračunaj max-height za liste (visina kartice - padding - header)
            const leftMaxHeight = gameIntroHeight - leftHeader.offsetHeight - 64; // 64px = padding (32px * 2)
            const rightMaxHeight = gameIntroHeight - rightHeader.offsetHeight - 64;

            leftLeaderboard.style.maxHeight = leftMaxHeight + 'px';
            rightLeaderboard.style.maxHeight = rightMaxHeight + 'px';
        }
    }

    // Pozovi kada se stranica učita
    window.addEventListener('load', setLeaderboardMaxHeight);

    // Ponovo pozovi kada se prozor promeni (resize)
    window.addEventListener('resize', setLeaderboardMaxHeight);
</script>
</body>
</html>
