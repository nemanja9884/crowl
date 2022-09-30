@extends('web.layouts.app')

@section('content')
    <main class="px-3 text-white">
        <img src="{{$language->image}}" class="card-img-top mb-4"
             alt="{{$language->name}}" style="max-width: 200px;">

        {!! $language->content !!}

        <a href="{{route('login')}}" type="button" class="btn btn-primary">Login</a>
        <a href="{{route('register')}}" type="button" class="btn btn-success">Register</a>
        <a href="{{route('startGame')}}" type="button" class="btn btn-secondary">Continue as guest</a>

    </main>
@endsection
