@extends('web.layouts.app')

@section('content')
    <main class="px-3 text-white">
        <h1>What is Lorem Ipsum?</h1>
        <p class="lead">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
            the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
            scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into
            electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of
            Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like
            Aldus PageMaker including versions of Lorem Ipsum.</p>

        <a href="{{route('login')}}" type="button" class="btn btn-primary">Login</a>
        <a href="{{route('register')}}" type="button" class="btn btn-success">Register</a>
        <a href="{{route('startGame')}}" type="button" class="btn btn-secondary">Continue as guest</a>

    </main>
@endsection
