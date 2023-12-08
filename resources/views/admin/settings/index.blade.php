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
                    <div class="col-md-12">
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
                        <div class="form-group mb-3">
                            <label for="textarea-input" class="form-control-label">Content</label>
                            <textarea name="index_content" id="textarea-input" rows="3"
                                      placeholder="content..."
                                      class="form-control">{{$settings->index_content}}</textarea>
                        </div>

{{--                        <div class="form-group mb-3">--}}
{{--                            <label class="form-control-label">Additional info page content</label>--}}
{{--                            <textarea name="additional_info_content" rows="6"--}}
{{--                                      placeholder="content..."--}}
{{--                                      class="form-control">{{$settings->additional_info_content}}</textarea>--}}
{{--                        </div>--}}
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-5">Save</button>
            </form>
        </div>
@endsection
