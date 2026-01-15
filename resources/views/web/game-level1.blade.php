@extends('web.layouts.app')

@section('css')
    <link rel="stylesheet" href="{{asset('plugins/swiper-slider/swiper-bundle.min.css')}}"/>

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

        .game-container {
            padding: 2rem 0;
            min-height: 100vh;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
        }

        /* Sentence cards */
        .sentence-card {
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

        .sentence-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            border-color: #667eea;
        }

        .sentence-card input[type="radio"]:checked ~ .sentence-content {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white !important;
            border-radius: 10px;
            padding: 1rem;
        }

        .sentence-card input[type="radio"]:checked ~ .sentence-content label {
            color: white !important;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            justify-content: center;
        }

        .game-btn {
            padding: 0.75rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            border: none;
            transition: all 0.3s ease;
            font-size: 1rem;
        }

        .game-btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .game-btn-primary:hover:not(:disabled) {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.6);
        }

        .game-btn-primary:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .game-btn-secondary {
            background: rgba(108, 117, 125, 0.9);
            color: white;
        }

        .game-btn-secondary:hover {
            background: rgba(108, 117, 125, 1);
            transform: translateY(-3px);
        }

        .game-btn-danger {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            box-shadow: 0 5px 15px rgba(245, 87, 108, 0.4);
        }

        .game-btn-danger:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(245, 87, 108, 0.6);
        }

        .level-badge {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 25px;
            font-weight: bold;
            display: inline-block;
            box-shadow: 0 3px 10px rgba(245, 87, 108, 0.3);
        }

        /* Desktop/Mobile toggle */
        .game-page-desktop {
            display: flex;
        }

        .game-page-mobile {
            display: none;
        }

        @media (max-width: 991px) {
            .game-page-desktop {
                display: none;
            }

            .game-page-mobile {
                display: block;
            }

            .action-buttons {
                flex-direction: column;
            }

            .game-btn {
                width: 100%;
            }
        }
    </style>
@endsection

@section('content')
    <main class="game-container">
        <div class="container-fluid">
            <!-- Desktop verzija -->
            <div class="row g-4 game-page-desktop">
                <div class="col-lg-3">
                    @include('web.layouts.left_column')
                </div>
                <div class="col-lg-6">
                    @include('web.shared.game-level1', ['submit' => 'submit', 'choose' => 'choose'])
                </div>
                <div class="col-lg-3">
                    @include('web.layouts.right_column')
                </div>
            </div>

            <!-- Mobile verzija -->
            <div class="game-page-mobile">
                <div class="mobile-game-intro mb-4">
                    @include('web.shared.game-level1', ['submit' => 'submit-mobile', 'choose' => 'choose-mobile'])
                </div>

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

@section('javascript')
    <script src="{{asset('plugins/swiper-slider/swiper-bundle.min.js')}}"></script>
    <script>
        function choose(submit, chooseName) {
            $(chooseName).click(function (e) {
                let checked = $(".answer").is(":checked");
                if (checked === true) {
                    $(submit).submit();
                } else {
                    e.preventDefault();
                    alert("{{trans('home.You must select something')}}");
                }
            });

            var radioButtons = $('input[name="answer"]');
            var chooseButton = $(chooseName);

            function checkSelection() {
                if (radioButtons.is(':checked')) {
                    chooseButton.prop('disabled', false);
                } else {
                    chooseButton.prop('disabled', true);
                }
            }

            checkSelection();

            radioButtons.on('change', function () {
                checkSelection();
            });
        }

        window.onload = function () {
            $(document).ready(function () {
                choose('#submit', '.choose');
                choose('#submit-mobile', '.choose-mobile');
            });
        }
    </script>
@endsection
