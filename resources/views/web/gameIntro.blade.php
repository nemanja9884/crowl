<!-- Main Layout (game.blade.php) -->
@extends('web.layouts.app')

@section('css')

    <style>
        body {
            font-family: "Anton", sans-serif;
            font-weight: 100 !important;
            font-style: normal;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            background-attachment: fixed; /* DODATO - pozadina ostaje fiksirana */
            background-size: cover; /* DODATO */
            min-height: 100vh;
        }

        .game-container {
            padding: 2rem 0;
            min-height: 100vh; /* DODATO - da content pokriva ceo ekran */
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
        }

        .level-card {
            display: block;
            width: 100%;
            transition: all 0.3s ease;
            cursor: pointer;
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            background: #fff;
            border: 2px solid #e0e0e0;
        }

        .level-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            border-color: #667eea;
        }

        .level-card input[type="radio"]:checked ~ .level-content {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white !important;
            border-radius: 10px;
            padding: 1rem;
        }

        .level-card input[type="radio"]:checked ~ .level-content h5,
        .level-card input[type="radio"]:checked ~ .level-content small {
            color: white !important;
        }

        .leaderboard-item {
            background: white;
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: transform 0.2s;
            border-left: 4px solid #667eea;
        }

        .leaderboard-item:hover {
            transform: translateX(5px);
        }

        .leaderboard-item.gold { border-left-color: #FFD700; }
        .leaderboard-item.silver { border-left-color: #C0C0C0; }
        .leaderboard-item.bronze { border-left-color: #CD7F32; }

        .badge-container {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            border-radius: 15px;
            padding: 1.5rem;
            color: white;
            text-align: center;
        }

        .badge-image {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 4px solid white;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .points-display {
            font-size: 2rem;
            font-weight: bold;
            background: white;
            color: #667eea;
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            display: inline-block;
            margin-bottom: 1rem;
        }

        .start-game-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 1rem 3rem;
            border-radius: 50px;
            font-size: 1.25rem;
            font-weight: bold;
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
            transition: all 0.3s;
        }

        .start-game-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.6);
        }

        /* Ovo možeš obrisati iz style sekcije */
        /* Dugme stil */
        .btn-outline-light {
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: white;
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 0.75rem 2rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-outline-light:hover {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.5);
            color: white;
            transform: translateY(-2px);
        }

        .btn-outline-light i {
            transition: transform 0.3s ease;
        }

        .btn-outline-light[aria-expanded="true"] .bi-chevron-down {
            transform: rotate(180deg);
        }
    </style>
@endsection

@section('content')
    <main class="game-container">
        <div class="container-fluid">
            <!-- Desktop verzija - 3 kolone -->
            <div class="row g-4 game-page-desktop">
                <div class="col-lg-3">
                    @include('web.layouts.left_column')
                </div>
                <div class="col-lg-6">
                    @include('web.shared.game-intro')
                </div>
                <div class="col-lg-3">
                    @include('web.layouts.right_column')
                </div>
            </div>

            <!-- Mobile verzija - sve uvek prikazano -->
            <div class="game-page-mobile">
                <!-- Game Intro - uvek vidljiv -->
                <div class="mobile-game-intro mb-4">
                    @include('web.shared.game-intro')
                </div>

                <!-- Leaderboards - uvek prikazani -->
                <div class="row g-3">
                    <div class="col-12">
                        @include('web.layouts.left_column')
                    </div>
                    <div class="col-12">
                        @include('web.layouts.right_column')
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
