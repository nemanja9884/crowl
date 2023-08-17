@extends('web.layouts.app')

@section('content')
    <main class="px-3">
        <div class="card color-black">
            <div class="card-header">
                Test
            </div>
            <div class="card-body">
                {{$message}}

                <form action="{{route('startGame', $langCode)}}" method="POST">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="level" value="{{$level}}" checked>
                    <button type="submit" class="btn btn-primary mt-3 float-left">{{trans('home.Continue')}}</button>
                </form>
            </div>
        </div>
    </main>
@endsection
