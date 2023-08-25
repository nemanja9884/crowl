@extends('web.layouts.app')
@section('content')
    <main class="px-3">
        <div class="card color-black">
            <div class="card-header">
                <a href="{{route('index')}}" type="button"
                   class="btn btn-danger float-right ml-2">{{trans('home.Exit game')}}</a>
                <a href="{{route('gameIntro', $langCode)}}" type="button"
                   class="btn btn-secondary float-right mr-2"
                   style="color: white; margin-right: 5px;">{{trans('home.Level choose')}}</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <p style="font-size: 20px; font-weight: 800;">{{$message}}</p>
                        <form action="{{route('startGame', $langCode)}}" method="POST">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="level" value="{{$level}}" checked>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary mt-3 ml-5 float-left">{{trans('home.Continue')}}</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4 text-center">
                        <img class="mt-3" src="{{asset('images/game/percent.png')}}" style="max-width: 50%;"/>
                    </div>
                </div>
                @include('web.shared.game-bottom-data')
            </div>
        </div>
    </main>
@endsection
