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

        .language-container {
            padding: 3rem 0;
            min-height: 100vh;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
        }

        /* Language Header */
        .language-header {
            text-align: center;
            margin-bottom: 3rem;
            color: white;
        }

        .language-flag {
            width: 200px;
            height: 200px;
            object-fit: contain;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            padding: 1rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            margin-bottom: 1.5rem;
        }

        .language-title {
            font-size: 2.5rem;
            font-weight: bold;
            text-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            margin-bottom: 2rem;
        }

        /* Auth Buttons Section */
        .auth-section {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
            padding: 2.5rem;
            margin-bottom: 2rem;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        .auth-section h4 {
            color: #667eea;
            margin-bottom: 1.5rem;
            font-weight: bold;
        }

        /* Buttons */
        .game-btn {
            width: 100%;
            padding: 1rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            border: none;
            transition: all 0.3s ease;
            font-size: 1.1rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .game-btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .game-btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.6);
        }

        .game-btn-success {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            color: white;
            box-shadow: 0 5px 15px rgba(56, 239, 125, 0.4);
        }

        .game-btn-success:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(56, 239, 125, 0.6);
        }

        .game-btn-google {
            background: white;
            color: #333;
            border: 2px solid #e0e0e0;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .game-btn-google:hover {
            background: #f8f9fa;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .game-btn-secondary {
            background: rgba(108, 117, 125, 0.9);
            color: white;
            box-shadow: 0 5px 15px rgba(108, 117, 125, 0.4);
        }

        .game-btn-secondary:hover {
            background: rgba(108, 117, 125, 1);
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(108, 117, 125, 0.6);
        }

        .game-btn-large {
            font-size: 1.3rem;
            padding: 1.25rem 3rem;
            margin-bottom: 2rem;
        }

        /* Content Section */
        .content-section {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
            padding: 3rem;
            max-width: 900px;
            margin: 0 auto;
            color: #333;
        }

        .content-section h1,
        .content-section h2,
        .content-section h3 {
            color: #667eea;
            margin-bottom: 1rem;
        }

        .content-section p {
            line-height: 1.8;
            margin-bottom: 1rem;
        }

        .divider {
            height: 2px;
            background: linear-gradient(to right, transparent, #667eea, transparent);
            margin: 2rem 0;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .language-flag {
                width: 150px;
                height: 150px;
            }

            .language-title {
                font-size: 2rem;
            }

            .auth-section {
                padding: 1.5rem;
            }

            .content-section {
                padding: 2rem 1.5rem;
            }

            .game-btn {
                font-size: 1rem;
                padding: 0.85rem 1.5rem;
            }

            .game-btn-large {
                font-size: 1.1rem;
                padding: 1rem 2rem;
            }
        }

        /* Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .language-flag,
        .auth-section,
        .content-section {
            animation: fadeInUp 0.6s ease-out;
        }

        .language-flag { animation-delay: 0.1s; }
        .auth-section { animation-delay: 0.2s; }
        .content-section { animation-delay: 0.3s; }







        /* Content Section - Enhanced Styling */
        .content-section {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
            padding: 3rem;
            max-width: 900px;
            margin: 0 auto;
            color: #333;
        }

        .content-section h1,
        .content-section h2,
        .content-section h3 {
            color: #667eea;
            margin-bottom: 1rem;
            font-weight: bold;
        }

        .content-section p {
            line-height: 1.8;
            margin-bottom: 1.5rem;
            text-align: justify;
        }

        /* TinyMCE Tables Styling */
        .content-section table {
            width: 100% !important;
            border-collapse: collapse;
            margin: 2rem 0;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .content-section table td {
            padding: 2rem !important;
            border: none !important;
        }

        /* Warning Box (first table) */
        .content-section table:first-of-type {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            margin-bottom: 2rem;
        }

        .content-section table:first-of-type td {
            color: white !important;
            font-weight: 600;
            font-size: 1.1rem;
            text-align: center;
            border-style: none !important;
        }

        /* Main Content Box (second table) */
        .content-section table:nth-of-type(2) {
            background: linear-gradient(135deg, #e3f2fd 0%, #f3e5f5 100%);
        }

        .content-section table:nth-of-type(2) td {
            color: #333 !important;
            line-height: 1.8;
        }

        .content-section table:nth-of-type(2) strong {
            color: #667eea;
            font-weight: 700;
        }

        .content-section table:nth-of-type(2) p {
            margin-bottom: 1.5rem;
        }

        .content-section table:nth-of-type(2) p:last-child {
            margin-bottom: 0;
        }

        /* Style for title paragraph */
        .content-section table:nth-of-type(2) p:first-child {
            font-size: 1.5rem;
            font-weight: bold;
            color: #667eea;
            margin-bottom: 2rem;
        }

        /* Remove inline styles precedence */
        .content-section table,
        .content-section table td,
        .content-section table p,
        .content-section table span {
            background-color: transparent !important;
            border-color: transparent !important;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .content-section {
                padding: 2rem 1.5rem;
            }

            .content-section table td {
                padding: 1.5rem !important;
            }

            .content-section table:nth-of-type(2) p:first-child {
                font-size: 1.2rem;
            }
        }
    </style>
@endsection

@section('content')
    <main class="language-container">
        <div class="container">
            <!-- Language Header -->
            <div class="language-header">
                <img src="{{$language->image}}"
                     class="language-flag"
                     alt="{{$language->name}}">
                <h1 class="language-title">{{$language->name}}</h1>
            </div>

            <!-- Authenticated User - Start Game Button -->
            @auth
                <div class="text-center mb-4">
                    <a href="{{route('gameIntro', $language->lang_code)}}"
                       class="btn game-btn game-btn-primary game-btn-large d-inline-flex">
                        🎮 {{trans('home.Start game')}}
                    </a>
                </div>
            @endauth

            <!-- Guest User - Authentication Options -->
            @guest
                <div class="auth-section">
                    <h4 class="text-center">🔐 {{trans('home.Get Started')}}</h4>

                    <a href="{{route('login')}}" class="btn game-btn game-btn-primary">
                        📧 {{trans('home.Sign-in via email')}}
                    </a>

                    <a href="{{route('register')}}" class="btn game-btn game-btn-success">
                        ✨ {{trans('home.Sign-up via email')}}
                    </a>

                    <a href="{{url('redirect/google')}}" class="btn game-btn game-btn-google">
                        <img src="https://img.icons8.com/color/24/000000/google-logo.png" alt="Google">
                        {{trans('home.Sign-up via Google')}}
                    </a>

                    <div class="divider"></div>

                    <a href="{{route('gameIntro', $language->lang_code)}}" class="btn game-btn game-btn-secondary">
                        👤 {{trans('home.Sign-up as a guest')}}
                    </a>
                </div>
            @endguest

            <!-- Language Content -->
            @if($language->content)
                <div class="content-section">
                    {!! $language->content !!}
                </div>
            @endif
        </div>
    </main>
@endsection
