@extends('web.layouts.app')
@section('content')
    <main class="px-3">
        <div class="card color-black">
            <div class="card-header">
                {{trans('home.Additional info')}}
            </div>
            <div class="card-body">
                <div class="row">
                    <p>{{trans("home.$settings->additional_info_content")}}</p>
                    <a href="{{route('index')}}" type="submit"
                       class="btn btn-primary mt-3 ml-5 float-left">{{trans('home.Home')}}</a>
                </div>
            </div>
        </div>
    </main>
@endsection
