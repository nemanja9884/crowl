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

        .home-container {
            padding: 3rem 0;
            min-height: 100vh;
        }

        /* Hero Section */
        .hero-section {
            text-align: center;
            margin-bottom: 4rem;
            color: white;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: bold;
            margin-bottom: 1rem;
            text-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .hero-subtitle {
            font-size: 1.3rem;
            opacity: 0.95;
            margin-bottom: 2rem;
        }

        /* Language Cards */
        .language-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
            transition: all 0.4s ease;
            overflow: hidden;
            height: 100%;
            text-decoration: none;
            display: block;
        }

        .language-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4);
            border-color: #667eea;
        }

        .language-card-image {
            width: 100%;
            height: 200px;
            object-fit: contain; /* Promenio sa 'cover' na 'contain' */
            background: #f8f9fa; /* Dodao background za prazan prostor */
            border-radius: 20px 20px 0 0;
            padding: 1rem; /* Dodao padding da slika ima prostora */
        }

        .language-card-body {
            padding: 1.5rem;
            text-align: center;
        }

        .language-card-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #667eea;
            margin-bottom: 0.75rem;
        }

        .language-card-intro {
            color: #6c757d;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        /* Content Section */
        .content-section {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
            padding: 3rem;
            margin-top: 4rem;
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

        /* Responsive */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1.1rem;
            }

            .language-card-image {
                height: 150px;
            }

            .content-section {
                padding: 2rem 1.5rem;
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

        .language-card {
            animation: fadeInUp 0.6s ease-out;
        }

        .language-card:nth-child(1) { animation-delay: 0.1s; }
        .language-card:nth-child(2) { animation-delay: 0.2s; }
        .language-card:nth-child(3) { animation-delay: 0.3s; }
        .language-card:nth-child(4) { animation-delay: 0.4s; }
        .language-card:nth-child(5) { animation-delay: 0.5s; }
        .language-card:nth-child(6) { animation-delay: 0.6s; }





        /* Home Page Content Styling */
        .content-section table {
            width: 100% !important;
            border: none !important;
            border-collapse: collapse;
            margin: 2rem 0;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .content-section table td {
            padding: 2.5rem !important;
            border: none !important;
            background: linear-gradient(135deg, #fff5f5 0%, #ffe0e0 100%) !important;
            text-align: center !important;
        }

        .content-section table span {
            color: #c0392b !important;
            font-weight: 600;
            font-size: 1.1rem;
            line-height: 1.8;
            display: block;
        }

        /* Warning icon */
        .content-section table::before {
            content: "⚠️";
            font-size: 3rem;
            display: block;
            text-align: center;
            margin-bottom: 1rem;
        }

        /* Add border accent */
        .content-section table td {
            border-left: 5px solid #e74c3c !important;
            position: relative;
        }

        /* Pulse animation for warning */
        @keyframes pulse {
            0%, 100% {
                box-shadow: 0 8px 25px rgba(231, 76, 60, 0.3);
            }
            50% {
                box-shadow: 0 8px 35px rgba(231, 76, 60, 0.5);
            }
        }

        .content-section table {
            animation: pulse 2s ease-in-out infinite;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .content-section table td {
                padding: 1.5rem !important;
            }

            .content-section table span {
                font-size: 1rem;
            }
        }
    </style>
@endsection

@section('content')
    <main class="home-container px-3">
        <div class="container">
            <!-- Hero Section -->
            <div class="hero-section">
                <h1 class="hero-title">🌍 Choose Your Language</h1>
                <p class="hero-subtitle">Start your language learning journey today!</p>
            </div>

            <!-- First Row of Languages -->
            <div class="row g-4 mb-4">
                @foreach($languagesFirstRow as $language)
                    <div class="col-md-4">
                        <a href="{{route('languageIndex', ['id' => $language->id, 'code' => $language->lang_code])}}"
                           class="language-card">
                            <img src="{{$language->image}}"
                                 class="language-card-image"
                                 alt="{{$language->name}}">
                            <div class="language-card-body">
                                <h5 class="language-card-title">{{$language->name}}</h5>
                                <p class="language-card-intro">{{$language->intro}}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            <!-- Second Row of Languages (Centered) -->
            @if($languagesSecondRow->count() > 0)
                <div class="row g-4 justify-content-center mb-4">
                    @foreach($languagesSecondRow as $language)
                        <div class="col-md-4 col-lg-4">
                            <a href="{{route('languageIndex', ['id' => $language->id, 'code' => $language->lang_code])}}"
                               class="language-card">
                                <img src="{{$language->image}}"
                                     class="language-card-image"
                                     alt="{{$language->name}}">
                                <div class="language-card-body">
                                    <h5 class="language-card-title">{{$language->name}}</h5>
                                    <p class="language-card-intro">{{$language->intro}}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Content Section -->
            @if($settings->index_content)
                <div class="content-section">
                    {!! $settings->index_content !!}
                </div>
            @endif
        </div>
    </main>
@endsection
