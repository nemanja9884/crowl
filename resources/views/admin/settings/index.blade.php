@extends('admin.layouts.app')

@section('content')
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        @include('admin.layouts.header')
        @foreach ($errors->all() as $error)
            <div class="col-md-12 alert alert-danger" role="alert">
                {!! $errors->first() !!}
            </div>
        @endforeach
        @if(Session::has('message'))
            <div class="col-md-12 alert alert-{{ Session::get('alert-class') }}" role="alert">
                {{ Session::get('message') }}
            </div>
        @endif
        <div class="container mt-5 mb-5">
            <form id="settingsForm" action="{{route('admin.settings.update', $settings->id)}}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="finished_ration" class="form-label">Finished ration</label>
                            <input type="text" class="form-control" id="finished_ration" name="finished_ration"
                                   value="{{$settings->finished_ration}}">
                            <small>Ration for finished game</small>
                        </div>
                        <div class="mb-3">
                            <label for="guests_plays_cycles" class="form-label">Guests plays cycles</label>
                            <input type="text" class="form-control" id="guests_plays_cycles" name="guests_plays_cycles"
                                   value="{{$settings->guests_plays_cycles}}">
                            <small>Number of cycles guest users can play</small>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-5">Sačuvaj</button>
            </form>
        </div>
@endsection
