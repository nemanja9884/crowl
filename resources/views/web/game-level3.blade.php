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
                @include('web.shared.game-level3')
            </div>
            <div class="col-md-3">
                @include('web.layouts.right_column')
            </div>
        </div>

        <div class="row game-page-mobile">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">@include('web.layouts.left_column')</div>
                    <div class="swiper-slide">@include('web.shared.game-level3')</div>
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

        window.onload = function () {
            $(document).ready(function () {
                (function () {
                    var removeBtn = document.getElementById('removeBtn');
                    var sandbox = document.getElementById('selectable-sentence');
                    var hltr = new TextHighlighter(sandbox);

                    removeBtn.addEventListener('click', function (e) {
                        e.preventDefault();
                        hltr.removeHighlights();
                    });
                })();

                $('#submit').click(function (e) {
                    var str = "";
                    $('.highlighted').each(function () {
                        str += $(this).text() + "| ";
                    });
                    let problematicWords = $('#problematicWords');
                    problematicWords.val(str);
                    if (problematicWords.val() === "" && $('#fine').is(":checked") === false) {
                        e.preventDefault();
                        alert('Please select problematic words, then press button "choose"');
                    } else {
                        $("#gameForm").submit();
                    }
                });
            });
        }
    </script>
@endsection
