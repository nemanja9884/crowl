@extends('web.layouts.app')

@section('css')
    <link rel="stylesheet" href="{{asset('plugins/swiper-slider/swiper-bundle.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('custom_css/game.css')}}"/>
@endsection
@section('content')
    <main class="px-3">
        <div class="row game-page-desktop">
            <div class="col-md-3">
                @include('web.layouts.left_column')
            </div>
            <div class="col-md-6">
                @include('web.shared.game-level2', ['submit' => 'submit', 'fine' => 'fine'])
            </div>
            <div class="col-md-3">
                @include('web.layouts.right_column')
            </div>
        </div>

        <div class="row game-page-mobile">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">@include('web.layouts.left_column')</div>
                    <div class="swiper-slide">@include('web.shared.game-level2', ['submit' => 'submit-mobile', 'fine' => 'fineMobile'])</div>
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

        function submit(submit) {
            $('#' + submit).click(function (e) {
                let checked = $(".answer").is(":checked");
                if (checked === true) {
                    $("#form-" + submit).submit();
                } else {
                    e.preventDefault();
                    alert('You must select something');
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

                $('.show-tool-tip').click(function () {
                    $('.tooltip-title').hide();
                    $(this).children('.tooltip-title').show();
                });
            });
        }
    </script>
@endsection
