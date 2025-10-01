@extends('web.layouts.app')

@section('css')
    <link rel="stylesheet" href="{{asset('plugins/swiper-slider/swiper-bundle.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('custom_css/game.css?v=1')}}"/>
    <style>
        body {
            font-family: "Anton", sans-serif;
            font-weight: 100 !important;
            font-style: normal;
        }
    </style>
@endsection
@section('content')
    <main class="px-3">
        <div class="row game-page-desktop">
            <div class="col-md-3">
                @include('web.layouts.left_column')
            </div>
            <div class="col-md-6">
                @include('web.shared.game-level1', ['submit' => 'submit', 'choose' => 'choose'])
            </div>
            <div class="col-md-3">
                @include('web.layouts.right_column')
            </div>
        </div>

        <div class="row game-page-mobile">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">@include('web.layouts.left_column')</div>
                    <div
                        class="swiper-slide">@include('web.shared.game-level1', ['submit' => 'submit-mobile', 'choose' => 'choose-mobile'])</div>
                    <div class="swiper-slide">@include('web.layouts.right_column')</div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </main>
@endsection
@section('javascript')
    <script src="{{asset('plugins/swiper-slider/swiper-bundle.min.js')}}"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            pagination: {
                el: ".swiper-pagination",
            },
            initialSlide: 1,
        });

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
