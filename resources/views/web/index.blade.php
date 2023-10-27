@extends('web.layouts.app')

@section('content')
    <main class="px-3">
        <div class="row mt-3">
            @foreach($languages as $language)
                <div class="col-md-3 mt-3 text-center">
                    <a class="none-decoration" href="{{route('languageIndex', ['id' => $language->id, 'code' => $language->lang_code])}}">
                        <div class="card card-flags">
                            <img src="{{$language->image}}" class="card-img-top"
                                 alt="{{$language->name}}">
                            <div class="card-body">
                                <h5 class="card-title card-flags-title">{{$language->name}}</h5>
                                <p class="mt-2 card-flags-title">{{$language->intro}}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach

            <div class="index-content mt-5 white-color">
                {!! $settings->index_content !!}
            </div>
        </div>
    </main>
@endsection
