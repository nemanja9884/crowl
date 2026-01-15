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

        .instructions-container {
            padding: 3rem 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .instructions-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 10px 40px rgba(31, 38, 135, 0.2);
            padding: 3rem;
            max-width: 700px;
            animation: slideInUp 0.6s ease-out;
        }

        .greeting {
            font-size: 2rem;
            font-weight: bold;
            color: #667eea;
            margin-bottom: 2rem;
            text-align: center;
        }

        .instruction-box {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border-left: 5px solid #667eea;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .instruction-box:hover {
            transform: translateX(5px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.15);
        }

        .instruction-box p {
            margin: 0;
            font-size: 1.1rem;
            color: #333;
            line-height: 1.8;
        }

        .instruction-icon {
            font-size: 2rem;
            margin-right: 1rem;
            float: left;
        }

        .competition-box {
            background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            text-align: center;
            box-shadow: 0 8px 25px rgba(255, 215, 0, 0.3);
            border: 3px solid #FFD700;
        }

        .competition-box p {
            margin: 0;
            font-size: 1.2rem;
            color: #333;
            font-weight: 600;
            line-height: 1.8;
        }

        .competition-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            display: block;
        }

        .btn-start {
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
            text-decoration: none;
            display: inline-block;
            width: 100%;
        }

        .btn-start:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.6);
            color: white;
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

        /* Responsive */
        @media (max-width: 768px) {
            .instructions-card {
                padding: 2rem 1.5rem;
                margin: 1rem;
            }

            .greeting {
                font-size: 1.6rem;
            }

            .instruction-box p {
                font-size: 1rem;
            }

            .instruction-icon {
                font-size: 1.5rem;
                float: none;
                display: block;
                margin-bottom: 0.5rem;
            }

            .competition-box {
                padding: 1.5rem;
            }

            .competition-box p {
                font-size: 1.1rem;
            }
        }

        /* Decorative wave */
        .wave-divider {
            height: 3px;
            background: linear-gradient(to right, transparent, #667eea, transparent);
            margin: 2rem 0;
        }
    </style>
@endsection

@section('content')
    <main class="instructions-container px-3">
        <div class="instructions-card">
            <h1 class="greeting">
                👋 {{trans('home.Dear player,')}}
            </h1>

            <div class="instruction-box">
                <span class="instruction-icon">🎮</span>
                <p>
                    {{trans('home.In this game, you can gather points for each of your actions. As you reach certain scores, you\'ll be awarded badges.')}}
                </p>
            </div>

            <div class="wave-divider"></div>

            <div class="competition-box">
                <span class="competition-icon">🏆</span>
                <p>
                    {{trans('home.The points you score will count for England\'s rank in the international competition. Let\'s get England a golden medal!')}}
                </p>
            </div>

            <a href="{{route('gameIntro', $language->lang_code)}}" class="btn-start">
                🚀 {{trans('home.Start game')}}
            </a>
        </div>
    </main>
@endsection
