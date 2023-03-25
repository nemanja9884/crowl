@extends('web.layouts.app')

@section('content')
    <main class="px-3 text-white text-center">
        <img src="{{$language->image}}" class="card-img-top mb-4"
             alt="{{$language->name}}" style="max-width: 200px;">

        {!! $language->content !!}

        @guest
            <a href="{{route('login')}}" type="button" class="btn btn-primary mb-2">{{trans('home.Login')}}</a>
            <a href="{{route('register')}}" type="button" class="btn btn-success mb-2">{{trans('home.Register')}}</a>
            <a href="{{url('redirect/google')}}"
               class="btn btn-google btn-block btn-light mb-2"><img
                    src="https://img.icons8.com/color/16/000000/google-logo.png" style="width: 20px;"> {{trans('home.Register with google')}}
            </a>
            <a href="{{url('redirect/facebook')}}"
               class="btn btn-google btn-block btn-light mb-2"><img
                    src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/05/Facebook_Logo_%282019%29.png/1024px-Facebook_Logo_%282019%29.png" style="width: 20px;"> {{trans('home.Register with facebook')}}
            </a>
            <a href="{{route('gameIntro', $language->lang_code)}}" type="button" class="btn btn-secondary mb-2">{{trans('home.Continue as
                guest')}}</a>
        @else
            <a href="{{route('gameIntro', $language->lang_code)}}" type="button"
               class="btn btn-primary">{{trans('home.Start game')}}</a>
        @endguest
    </main>
@endsection
