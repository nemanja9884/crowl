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

        .max-rounds-container {
            padding: 3rem 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .warning-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            border: 3px solid #f39c12;
            box-shadow: 0 10px 40px rgba(243, 156, 18, 0.3);
            padding: 3rem;
            max-width: 600px;
            text-align: center;
            animation: slideInUp 0.6s ease-out;
            position: relative;
            overflow: hidden;
        }

        /* Warning badge */
        .warning-badge {
            position: absolute;
            top: -15px;
            left: 50%;
            transform: translateX(-50%);
            background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
            color: white;
            font-weight: bold;
            font-size: 1.1rem;
            padding: 0.75rem 2rem;
            border-radius: 50px;
            box-shadow: 0 5px 15px rgba(243, 156, 18, 0.4);
            z-index: 1;
        }

        .warning-icon {
            font-size: 5rem;
            margin-bottom: 1.5rem;
            animation: bounce 2s ease-in-out infinite;
        }

        .warning-title {
            font-size: 2rem;
            font-weight: bold;
            color: #f39c12;
            margin-bottom: 1rem;
            margin-top: 1rem;
        }

        .warning-text {
            font-size: 1.2rem;
            color: #555;
            line-height: 1.8;
            margin-bottom: 2rem;
        }

        .divider {
            height: 2px;
            background: linear-gradient(to right, transparent, #f39c12, transparent);
            margin: 2rem 0;
        }

        /* Buttons */
        .action-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-custom {
            padding: 1rem 2.5rem;
            border-radius: 50px;
            font-weight: 600;
            border: none;
            transition: all 0.3s ease;
            font-size: 1.1rem;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-register {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            color: white;
            box-shadow: 0 5px 15px rgba(56, 239, 125, 0.4);
        }

        .btn-register:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(56, 239, 125, 0.6);
            color: white;
        }

        .btn-back {
            background: rgba(108, 117, 125, 0.9);
            color: white;
            box-shadow: 0 5px 15px rgba(108, 117, 125, 0.4);
        }

        .btn-back:hover {
            background: rgba(108, 117, 125, 1);
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(108, 117, 125, 0.6);
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

        @keyframes bounce {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-15px);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .warning-card {
                padding: 2rem 1.5rem;
                margin: 1rem;
            }

            .warning-icon {
                font-size: 4rem;
            }

            .warning-title {
                font-size: 1.6rem;
            }

            .warning-text {
                font-size: 1.1rem;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn-custom {
                width: 100%;
            }

            .warning-badge {
                font-size: 0.95rem;
                padding: 0.6rem 1.5rem;
                top: -12px;
            }
        }

        /* Stats box */
        .stats-box {
            background: linear-gradient(135deg, #fff3cd 0%, #ffe69c 100%);
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border-left: 5px solid #f39c12;
        }

        .stats-box p {
            margin: 0.5rem 0;
            font-size: 1.05rem;
            color: #333;
            font-weight: 500;
        }

        .stats-box strong {
            color: #f39c12;
        }
    </style>
@endsection

@section('content')
    <main class="max-rounds-container px-3">
        <div class="warning-card">
            <div class="warning-badge">
                ⚠️ {{trans('home.LIMIT REACHED')}}
            </div>

            <div class="warning-icon">
                🎮
            </div>

            <h1 class="warning-title">
                {{trans('home.Maximum games rounds')}}
            </h1>

            <p class="warning-text">
                {{trans('home.you have played the highest number of rounds, please register to continue')}}
            </p>

            <div class="stats-box">
                <p>✅ <strong>{{trans('home.Great job!')}}</strong> {{trans('home.You have completed the maximum number of guest rounds.')}}</p>
                <p>🎯 {{trans('home.Register now to continue playing and track your progress!')}}</p>
            </div>

            <div class="divider"></div>

            <div class="action-buttons">
                <a href="{{route('register')}}" class="btn-custom btn-register">
                    ✨ {{trans('home.Register')}}
                </a>
                <a href="{{route('gameIntro', $code)}}" class="btn-custom btn-back">
                    ← {{trans('home.Level choose')}}
                </a>
            </div>
        </div>
    </main>
@endsection
