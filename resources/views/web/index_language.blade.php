@extends('web.layouts.app')

@section('content')
    <main class="px-3 text-white text-center">
        <img src="{{$language->image}}" class="card-img-top mb-4"
             alt="{{$language->name}}" style="max-width: 200px;">

        {!! $language->content !!}

        @guest
            <a href="{{route('gameIntro', $language->lang_code)}}" type="button" class="btn btn-secondary">{{trans('home.Continue as
                guest')}}</a>
        @else
            <a href="{{route('gameIntro', $language->lang_code)}}" type="button" class="btn btn-primary">{{trans('home.Start game')}}</a>
        @endguest
    </main>
@endsection
