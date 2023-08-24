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
                @include('web.shared.game-level2')
            </div>
            <div class="col-md-3">
                @include('web.layouts.right_column')
            </div>
        </div>

        <div class="row game-page-mobile">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">@include('web.layouts.left_column')</div>
                    <div class="swiper-slide">@include('web.shared.game-level2')</div>
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
                $("#submit").click(function (e) {
                    let checked = $(".answer").is(":checked");
                    if (checked === true) {
                        $("#form").submit();
                    } else {
                        e.preventDefault();
                        alert('You must select something');
                        // toastr.error('You must select something');
                    }
                });


                $('.show-tool-tip').click(function () {
                    $('.tooltip-title').hide();
                    $(this).children('.tooltip-title').show();
                });

                $('.answer').on('change', function() {
                    if($(this).prop('checked') === true && $(this).val() === 'fine') {
                        $('.answer').not(this).prop('checked', false);
                    } else if($(this).prop('checked') === true && $(this).val() !== 'fine') {
                        $('#fine').prop('checked', false);
                    }
                });
            });
        }
    </script>
@endsection
