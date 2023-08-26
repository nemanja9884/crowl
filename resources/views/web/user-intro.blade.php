@extends('web.layouts.app')
@section('content')
    <main class="px-3">
        <div class="card color-black">
            <div class="card-body">
                <h5>{{trans('home.Dear player,')}}</h5><br>
                <h5>{{trans('home.In this game, you can gather points for each of your actions. As you reach certain scores, you’ll be awarded badges.')}}</h5>
                <h5>{{trans('home.The points you score will count for England’s rank in the international competition. Let’s get England a golden medal!')}}</h5>
                <a href="{{route('gameIntro', $language->lang_code)}}" type="button"
                   class="btn btn-primary mt-3">{{trans('home.Start game')}}</a>
            </div>
        </div>
    </main>
@endsection
