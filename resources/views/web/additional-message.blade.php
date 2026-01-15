@extends('web.layouts.app')

@section('css')
    <style>
        body {
            font-family: "Anton", sans-serif;
            font-weight: 100 !important;
            font-style: normal;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            background-attachment: fixed;
            background-size: cover;
            min-height: 100vh;
        }

        .level-transition-container {
            padding: 3rem 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .transition-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 10px 40px rgba(31, 38, 135, 0.2);
            padding: 3rem;
            max-width: 700px;
            width: 100%;
            animation: slideInUp 0.6s ease-out;
        }

        /* Header with buttons */
        .transition-header {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 2px solid #e0e0e0;
        }

        .btn-header {
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            border: none;
            transition: all 0.3s ease;
            font-size: 1rem;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-level-choose {
            background: rgba(108, 117, 125, 0.9);
            color: white;
            box-shadow: 0 3px 10px rgba(108, 117, 125, 0.3);
        }

        .btn-level-choose:hover {
            background: rgba(108, 117, 125, 1);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(108, 117, 125, 0.5);
            color: white;
        }

        .btn-exit {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            box-shadow: 0 3px 10px rgba(245, 87, 108, 0.3);
        }

        .btn-exit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(245, 87, 108, 0.5);
            color: white;
        }

        /* Content area */
        .transition-content {
            text-align: center;
        }

        .celebration-icon {
            font-size: 5rem;
            margin-bottom: 1.5rem;
            animation: bounce 2s ease-in-out infinite;
        }

        .transition-message {
            font-size: 1.8rem;
            font-weight: bold;
            color: #667eea;
            margin-bottom: 2rem;
            line-height: 1.4;
        }

        .progress-image {
            max-width: 200px;
            margin: 2rem auto;
            animation: float 3s ease-in-out infinite;
        }

        .progress-image img {
            width: 100%;
            height: auto;
            filter: drop-shadow(0 10px 20px rgba(0, 0, 0, 0.1));
        }

        /* Continue button */
        .btn-continue {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 1.25rem 3rem;
            border-radius: 50px;
            font-size: 1.2rem;
            font-weight: 600;
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
            transition: all 0.3s ease;
            cursor: pointer;
            margin: 2rem 0;
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
        }

        .btn-continue:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.6);
        }

        /* Stats box */
        .stats-box {
            background: linear-gradient(135deg, #e3f2fd 0%, #f3e5f5 100%);
            border-radius: 15px;
            padding: 2rem;
            margin-top: 2rem;
        }

        /* Animations */
        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes bounce {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-20px);
            }
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-15px);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .transition-card {
                padding: 2rem 1.5rem;
                margin: 1rem;
            }

            .transition-header {
                flex-direction: column;
            }

            .btn-header {
                width: 100%;
                justify-content: center;
            }

            .celebration-icon {
                font-size: 4rem;
            }

            .transition-message {
                font-size: 1.4rem;
            }

            .btn-continue {
                width: 100%;
                justify-content: center;
            }

            .progress-image {
                max-width: 150px;
            }
        }
    </style>
@endsection

@section('content')
    <main class="level-transition-container px-3">
        <div class="transition-card">
            <!-- Header with action buttons -->
            <div class="transition-header">
                <a href="{{route('gameIntro', $langCode)}}" class="btn-header btn-level-choose">
                    ← {{trans('home.Level choose')}}
                </a>
                <a href="{{route('index')}}" class="btn-header btn-exit">
                    {{trans('home.Exit game')}} ✕
                </a>
            </div>

            <!-- Main content -->
            <div class="transition-content">
                <div class="celebration-icon">
                    🎉
                </div>

                <p class="transition-message">
                    {{$message}}
                </p>

                <div class="progress-image">
                    <img src="{{asset('images/game/percent.png')}}" alt="Progress">
                </div>

                <form action="{{route('startGame', $langCode)}}" method="POST">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="level" value="{{$level}}">

                    <button type="submit" class="btn-continue">
                        {{trans('home.Continue')}} →
                    </button>
                </form>
            </div>

            <!-- Game stats -->
            <div class="stats-box">
                @include('web.shared.game-bottom-data')
            </div>
        </div>
    </main>
@endsection
