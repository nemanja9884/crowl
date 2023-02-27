@extends('web.layouts.app')

@section('content')
    <main class="px-3">
        <div class="row mt-3">
            @foreach($languages as $language)
                <div class="col-md-3 mt-3">
                    <a class="none-decoration" href="{{route('languageIndex', ['id' => $language->id, 'code' => $language->lang_code])}}">
                        <div class="card">
                            <img src="{{$language->image}}" class="card-img-top"
                                 alt="{{$language->name}}">
                            <div class="card-body">
                                <h5 class="card-title">{{$language->name}}</h5>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        @guest
            <div class="text-center mt-3">
                <a href="{{route('login')}}" type="button" class="btn btn-primary">{{trans('home.Login')}}</a>
                <a href="{{route('register')}}" type="button" class="btn btn-success">{{trans('home.Register')}}</a>
            </div>
        @endguest
    </main>
@endsection
