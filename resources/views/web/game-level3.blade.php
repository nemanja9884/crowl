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

        /* Selectable sentence box */
        .selectable-sentence-box {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            border-radius: 15px;
            padding: 2rem;
            color: white;
            font-size: 1.3rem;
            font-weight: 500;
            line-height: 1.8;
            margin-bottom: 1.5rem;
            box-shadow: 0 5px 15px rgba(240, 147, 251, 0.3);
            cursor: text;
            user-select: text;
        }

        .selectable-sentence-box::selection {
            background: rgba(255, 255, 255, 0.3);
        }

        /* Highlighted text */
        .highlighted {
            background: #FFD700 !important;
            color: #000 !important;
            padding: 2px 4px;
            border-radius: 4px;
            font-weight: 600;
        }

        /* Fine checkbox card */
        .fine-checkbox-card {
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

        .fine-checkbox-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            border-color: #667eea;
        }

        .fine-checkbox-card input[type="checkbox"]:checked ~ .checkbox-content {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white !important;
            border-radius: 10px;
            padding: 1rem;
            margin: -1rem;
        }

        .fine-checkbox-card input[type="checkbox"]:checked ~ .checkbox-content span {
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

        .game-btn-warning {
            background: linear-gradient(135deg, #f5af19 0%, #f12711 100%);
            color: white;
            box-shadow: 0 5px 15px rgba(241, 39, 17, 0.4);
        }

        .game-btn-warning:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(241, 39, 17, 0.6);
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

        .instruction-box {
            background: rgba(102, 126, 234, 0.1);
            border-left: 4px solid #667eea;
            border-radius: 10px;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
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

            .selectable-sentence-box {
                font-size: 1.1rem;
                padding: 1.5rem;
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
                    @include('web.shared.game-level3', [
                        'selectableSentence' => 'selectable-sentence-desktop',
                        'removeBtn' => 'remove-btn-desktop',
                        'submit' => 'submit-desktop',
                        'problematicWords' => 'problematicWords-desktop',
                        'fine' => 'fine-desktop'
                    ])
                </div>
                <div class="col-lg-3">
                    @include('web.layouts.right_column')
                </div>
            </div>

            <!-- Mobile verzija -->
            <div class="game-page-mobile">
                <div class="mobile-game-intro mb-4">
                    @include('web.shared.game-level3', [
                        'selectableSentence' => 'selectable-sentence-mobile',
                        'removeBtn' => 'remove-btn-mobile',
                        'submit' => 'submit-mobile',
                        'problematicWords' => 'problematicWords-mobile',
                        'fine' => 'fine-mobile'
                    ])
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
        function checkFormValidity(saveButton) {
            var isHighlighted = $('.highlighted').length > 0;
            if (isHighlighted) {
                saveButton.prop('disabled', false);
            } else {
                saveButton.prop('disabled', true);
            }
        }

        function marker(element, rmwBtn, saveBtn) {
            (function () {
                var removeBtn = document.getElementById(rmwBtn);
                var sandbox = document.getElementById(element);
                var saveButton = $('#' + saveBtn);
                var hltr = new TextHighlighter(sandbox);

                sandbox.addEventListener('mouseup', function () {
                    checkFormValidity(saveButton);
                });

                sandbox.addEventListener('touchend', function () {
                    checkFormValidity(saveButton);
                });

                checkFormValidity(saveButton);

                removeBtn.addEventListener('click', function (e) {
                    e.preventDefault();
                    hltr.removeHighlights();
                    checkFormValidity(saveButton);
                });
            })();
        }

        function submit(submit, probWords, fine) {
            $('#' + submit).click(function (e) {
                var str = "";
                $('.highlighted').each(function () {
                    str += $(this).text() + "| ";
                });
                let problematicWords = $(probWords);
                problematicWords.val(str);
                if (problematicWords.val() === "" && $(fine).is(":checked") === false) {
                    e.preventDefault();
                    alert("{{trans('home.Please select problematic words, then press button choose')}}");
                } else {
                    $("#gameForm" + submit).submit();
                }
            });
        }

        window.onload = function () {
            $(document).ready(function () {
                // Desktop
                marker('selectable-sentence-desktop', 'remove-btn-desktop', 'submit-desktop');
                submit('submit-desktop', '#problematicWords-desktop', '#fine-desktop');

                // Mobile
                marker('selectable-sentence-mobile', 'remove-btn-mobile', 'submit-mobile');
                submit('submit-mobile', '#problematicWords-mobile', '#fine-mobile');
            });
        }
    </script>
@endsection
