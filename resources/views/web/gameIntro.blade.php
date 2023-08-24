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
                @include('web.shared.game-intro')
            </div>
            <div class="col-md-3">
                @include('web.layouts.right_column')
            </div>
        </div>

        <div class="row game-page-mobile">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">@include('web.layouts.left_column')</div>
                    <div class="swiper-slide">@include('web.shared.game-intro')</div>
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
    </script>
@endsection
