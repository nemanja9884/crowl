@extends('web.layouts.app')

@section('css')
    <link rel="stylesheet" href="{{asset('plugins/swiper-slider/swiper-bundle.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('custom_css/game.css?v=2')}}"/>
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

        /* Checkbox cards */
        .checkbox-card {
            display: block;
            width: 100%;
            transition: all 0.3s ease;
            cursor: pointer;
            border-radius: 15px;
            padding: 1rem 1.5rem;
            margin-bottom: 0.75rem;
            background: #fff;
            border: 2px solid #e0e0e0;
            position: relative;
        }

        .checkbox-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            border-color: #667eea;
        }

        .checkbox-card input[type="checkbox"]:checked ~ .checkbox-content {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white !important;
            border-radius: 10px;
            padding: 0.75rem;
            margin: -0.75rem;
        }

        .checkbox-card input[type="checkbox"]:checked ~ .checkbox-content label,
        .checkbox-card input[type="checkbox"]:checked ~ .checkbox-content .info-icon {
            color: white !important;
        }

        .checkbox-card input[type="checkbox"]:checked ~ .checkbox-content .info-icon svg path {
            fill: white !important;
        }

        .sentence-display {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            border-radius: 15px;
            padding: 1.5rem;
            color: white;
            font-size: 1.2rem;
            font-weight: 500;
            text-align: center;
            margin-bottom: 1.5rem;
            box-shadow: 0 5px 15px rgba(240, 147, 251, 0.3);
        }

        .info-icon {
            cursor: pointer;
            margin-left: 0.5rem;
            transition: transform 0.2s;
            position: relative;
            display: inline-flex;
            align-items: center;
            flex-shrink: 0;
        }

        .info-icon:hover {
            transform: scale(1.1);
        }

        .info-icon:hover .tooltip-custom {
            display: block !important;
        }

        .tooltip-custom {
            position: absolute;
            right: 0;
            bottom: calc(100% + 10px);
            background: rgba(30, 30, 40, 0.96);
            color: white;
            padding: 0.6rem 1rem;
            border-radius: 8px;
            font-size: 0.82rem;
            white-space: normal;
            width: max-content;
            max-width: min(220px, 80vw);
            text-align: left;
            z-index: 9999;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.25);
            pointer-events: none;
            animation: fadeIn 0.2s ease;
        }

        .tooltip-custom::after {
            content: '';
            position: absolute;
            top: 100%;
            right: 8px;
            border: 6px solid transparent;
            border-top-color: rgba(30, 30, 40, 0.96);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(4px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .checkbox-card {
            overflow: visible;
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
                    @include('web.shared.game-level2', ['submit' => 'submit', 'fine' => 'fine'])
                </div>
                <div class="col-lg-3">
                    @include('web.layouts.right_column')
                </div>
            </div>

            <!-- Mobile verzija -->
            <div class="game-page-mobile">
                <div class="mobile-game-intro mb-4">
                    @include('web.shared.game-level2', ['submit' => 'submit-mobile', 'fine' => 'fineMobile'])
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
    <script>
        function submit(submit) {
            $('#' + submit).click(function (e) {
                let checked = $(".answer").is(":checked");
                if (checked === true) {
                    $("#form-" + submit).submit();
                } else {
                    e.preventDefault();
                    alert("{{trans('home.You must select something')}}");
                }
            });
        }

        function change(fine) {
            $('.answer').on('change', function () {
                if ($(this).prop('checked') === true && $(this).val() === 'fine') {
                    $('.answer').not(this).prop('checked', false);
                } else if ($(this).prop('checked') === true && $(this).val() !== 'fine') {
                    $(fine).prop('checked', false);
                }
            });
        }

        window.onload = function () {
            $(document).ready(function () {
                submit('submit');
                submit('submit-mobile');
                change('#fine');
                change('#fineMobile');

                $('.show-tool-tip').click(function (e) {
                    e.stopPropagation();
                    e.preventDefault();
                    var tip = $(this).find('.tooltip-custom');
                    var isVisible = tip.is(':visible');
                    $('.tooltip-custom').hide();
                    if (!isVisible) {
                        tip.show();
                    }
                });

                $(document).click(function () {
                    $('.tooltip-custom').hide();
                });

                var answerCheckboxes = $('.answer');
                var chooseButton = $('.choose-button');

                function checkSelection() {
                    if (answerCheckboxes.is(':checked')) {
                        chooseButton.prop('disabled', false);
                    } else {
                        chooseButton.prop('disabled', true);
                    }
                }

                checkSelection();

                answerCheckboxes.on('change', function() {
                    checkSelection();
                });
            });
        }
    </script>
@endsection
