@extends('web.layouts.app')

@section('content')
    <main class="px-3">
        <div class="alert alert-warning" role="alert">
            <h4 class="alert-heading">{{trans('home.Maximum games rounds')}}</h4>
            <p>{{trans('home.you have played the highest number of rounds, please register to continue')}}</p>
            <hr>
            <a href="{{route('register')}}" type="button" class="btn btn-success">{{trans('home.Register')}}</a>
            <a href="{{route('gameIntro', $code)}}" class="btn btn-secondary">{{trans('home.Level choose')}}</a>
        </div>
    </main>
@endsection
