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

        .no-games-container {
            padding: 3rem 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .info-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            border: 3px solid #3498db;
            box-shadow: 0 10px 40px rgba(52, 152, 219, 0.3);
            padding: 3rem;
            max-width: 600px;
            text-align: center;
            animation: slideInUp 0.6s ease-out;
            position: relative;
            overflow: hidden;
        }

        /* Info badge */
        .info-badge {
            position: absolute;
            top: -15px;
            left: 50%;
            transform: translateX(-50%);
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            color: white;
            font-weight: bold;
            font-size: 1.1rem;
            padding: 0.75rem 2rem;
            border-radius: 50px;
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.4);
            z-index: 1;
        }

        .info-icon {
            font-size: 5rem;
            margin-bottom: 1.5rem;
            animation: pulse 2s ease-in-out infinite;
        }

        .info-title {
            font-size: 2rem;
            font-weight: bold;
            color: #3498db;
            margin-bottom: 1rem;
            margin-top: 1rem;
        }

        .info-text {
            font-size: 1.2rem;
            color: #555;
            line-height: 1.8;
            margin-bottom: 2rem;
        }

        .divider {
            height: 2px;
            background: linear-gradient(to right, transparent, #3498db, transparent);
            margin: 2rem 0;
        }

        /* Contact box */
        .contact-box {
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border-left: 5px solid #3498db;
        }

        .contact-box p {
            margin: 0;
            font-size: 1.05rem;
            color: #333;
            font-weight: 500;
        }

        .contact-box a {
            color: #3498db;
            font-weight: bold;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .contact-box a:hover {
            color: #2980b9;
            text-decoration: underline;
        }

        /* Buttons */
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-custom:hover {
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

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .info-card {
                padding: 2rem 1.5rem;
                margin: 1rem;
            }

            .info-icon {
                font-size: 4rem;
            }

            .info-title {
                font-size: 1.6rem;
            }

            .info-text {
                font-size: 1.1rem;
            }

            .btn-custom {
                width: 100%;
            }

            .info-badge {
                font-size: 0.95rem;
                padding: 0.6rem 1.5rem;
                top: -12px;
            }
        }

        /* Decorative elements */
        .decorative-circle {
            position: absolute;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(52, 152, 219, 0.1) 0%, rgba(41, 128, 185, 0.1) 100%);
            z-index: 0;
        }

        .decorative-circle:nth-child(1) {
            top: -50px;
            right: -50px;
        }

        .decorative-circle:nth-child(2) {
            bottom: -50px;
            left: -50px;
        }
    </style>
@endsection

@section('content')
    <main class="no-games-container px-3">
        <div class="info-card">
            <div class="decorative-circle"></div>
            <div class="decorative-circle"></div>

            <div class="info-badge">
                ℹ️ {{trans('home.INFORMATION')}}
            </div>

            <div class="info-icon">
                🎯
            </div>

            <h1 class="info-title">
                {{trans('home.No more games!')}}
            </h1>

            <p class="info-text">
                {{trans('home.Sorry, there is no more games on this level. Please, try again later!')}}
            </p>

            <div class="divider"></div>

            <div class="contact-box">
                <p>
                    📧 {{trans('home.Feel free to contact us on this')}}
                    <a href="mailto:test@test.com">test@test.com</a>
                </p>
            </div>

            <div class="text-center">
                <a href="{{route('gameIntro', $language->lang_code)}}" class="btn-custom">
                    ← {{trans('home.Level choose')}}
                </a>
            </div>
        </div>
    </main>
@endsection
