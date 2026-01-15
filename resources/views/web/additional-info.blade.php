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

        .additional-info-container {
            padding: 3rem 0;
            min-height: 100vh;
        }

        .info-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 10px 40px rgba(31, 38, 135, 0.2);
            padding: 3rem;
            max-width: 900px;
            margin: 0 auto;
            animation: slideInUp 0.6s ease-out;
        }

        .info-header {
            text-align: center;
            margin-bottom: 3rem;
            padding-bottom: 2rem;
            border-bottom: 2px solid #e0e0e0;
        }

        .info-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            color: white;
            margin: 0 auto 1.5rem;
            box-shadow: 0 8px 20px rgba(52, 152, 219, 0.4);
        }

        .info-title {
            font-size: 2.5rem;
            font-weight: bold;
            color: #3498db;
            margin-bottom: 0.5rem;
        }

        .info-subtitle {
            color: #6c757d;
            font-size: 1.1rem;
        }

        /* Content styling */
        .info-content {
            color: #333;
            font-size: 1.05rem;
            line-height: 1.8;
        }

        .info-content h1,
        .info-content h2,
        .info-content h3,
        .info-content h4 {
            color: #3498db;
            margin-top: 2rem;
            margin-bottom: 1rem;
            font-weight: bold;
        }

        .info-content h1 {
            font-size: 2rem;
        }

        .info-content h2 {
            font-size: 1.7rem;
        }

        .info-content h3 {
            font-size: 1.4rem;
        }

        .info-content h4 {
            font-size: 1.2rem;
        }

        .info-content p {
            margin-bottom: 1.5rem;
            text-align: justify;
        }

        .info-content ul,
        .info-content ol {
            margin-bottom: 1.5rem;
            padding-left: 2rem;
        }

        .info-content li {
            margin-bottom: 0.75rem;
        }

        .info-content strong {
            color: #3498db;
            font-weight: 600;
        }

        .info-content a {
            color: #3498db;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .info-content a:hover {
            color: #2980b9;
            text-decoration: underline;
        }

        /* TinyMCE tables styling */
        .info-content table {
            width: 100% !important;
            border-collapse: collapse;
            margin: 2rem 0;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .info-content table td {
            padding: 1.5rem !important;
            border: none !important;
            background: linear-gradient(135deg, #e3f2fd 0%, #f3e5f5 100%) !important;
        }

        .info-content table td p {
            margin-bottom: 0.5rem;
        }

        /* Home button */
        .btn-home {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 1rem 3rem;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
            transition: all 0.3s ease;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 2rem;
        }

        .btn-home:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.6);
            color: white;
        }

        .button-container {
            text-align: center;
            padding-top: 2rem;
            border-top: 2px solid #e0e0e0;
            margin-top: 3rem;
        }

        /* Info boxes for highlighted content */
        .info-content blockquote {
            background: linear-gradient(135deg, #fff3cd 0%, #ffe69c 100%);
            border-left: 5px solid #ffc107;
            border-radius: 12px;
            padding: 1.5rem;
            margin: 2rem 0;
            font-style: italic;
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
            .info-card {
                padding: 2rem 1.5rem;
                margin: 1rem;
            }

            .info-icon {
                width: 70px;
                height: 70px;
                font-size: 2rem;
            }

            .info-title {
                font-size: 2rem;
            }

            .info-content {
                font-size: 1rem;
            }

            .info-content h1 {
                font-size: 1.6rem;
            }

            .info-content h2 {
                font-size: 1.4rem;
            }

            .btn-home {
                width: 100%;
                justify-content: center;
            }
        }

        /* Remove inline styles from TinyMCE */
        .info-content * {
            max-width: 100% !important;
        }
    </style>
@endsection

@section('content')
    <main class="additional-info-container px-3">
        <div class="info-card">
            <!-- Header -->
            <div class="info-header">
                <div class="info-icon">
                    ℹ️
                </div>
                <h1 class="info-title">{{trans('home.Additional info')}}</h1>
                <p class="info-subtitle">{{trans('home.Important information about data collection and privacy')}}</p>
            </div>

            <!-- Content -->
            <div class="info-content">
                {!! $language->additional_info_content !!}
            </div>

            <!-- Home Button -->
            <div class="button-container">
                <a href="{{route('index')}}" class="btn-home">
                    🏠 {{trans('home.Home')}}
                </a>
            </div>
        </div>
    </main>
@endsection

@section('javascript')
    <script>
        $(document).ready(function() {
            // Ukloni inline stilove iz TinyMCE sadržaja
            $('.info-content table').removeAttr('style');
            $('.info-content td').removeAttr('style');
            $('.info-content span').each(function() {
                if ($(this).attr('style')) {
                    $(this).removeAttr('style');
                }
            });
        });
    </script>
@endsection
