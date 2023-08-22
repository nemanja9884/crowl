@extends('web.layouts.app')

@section('content')
    <style>
        .cover-container {
            max-width: unset !important;
        }

        header {
            max-width: 60em;
            width: 100%;
            margin: 0 auto;
        }

        .col-md-3 .card {
            height: 70vh;
            border: 6px solid black;
            background-color: #00a8f3;
            border-radius: 30px;
        }

        .col-md-3 .card .card-body {
            overflow-y: auto;
        }

        .col-md-6 {
            display: flex;
            align-items: center;
        }
    </style>
    <main class="px-3">
        <div class="row">
            <div class="col-md-3">
                @include('web.layouts.left_column')
            </div>
            <div class="col-md-6">
                <div class="card color-black">
                    <div class="card-header">
                        {{trans('home.Game intro')}}
                    </div>
                    <div class="card-body text-left">
                        <h5 class="card-title">{{trans('home.You can choose between 3 levels of game. 1,2 or 3 level, or you can take 1 + 2 or 2 3 or 1 + 2 + 3. Good luck!')}}</h5>
                        <form action="{{route('startGame', $language->lang_code)}}" method="POST">
                            @csrf
                            @method('POST')
                            <h5>{{trans('home.Please choose your level:')}}</h5>
                            <div class="form-check sentence">
                                <input class="form-check-input" type="radio" name="level" id="gameLevel1" value="1" @if(!Auth::guard('web')->user()) disabled @else checked @endif>
                                <label class="form-check-label" for="gameLevel1">
                                    {{trans('home.1- I\'m curious!')}}
                                </label>
                            </div>
                            <div class="form-check sentence">
                                <input class="form-check-input" type="radio" name="level" id="gameLevel2" value="2" @if(!Auth::guard('web')->user()) disabled @endif>
                                <label class="form-check-label" for="gameLevel2">
                                    {{trans('home.2- I\'m eager to help!')}}
                                </label>
                            </div>
                            <div class="form-check sentence">
                                <input class="form-check-input" type="radio" name="level" id="gameLevel3" value="3" @if(!Auth::guard('web')->user()) disabled @endif>
                                <label class="form-check-label" for="gameLevel3">
                                    {{trans('home.3- I\'m feeling enthusiastic!')}}
                                </label>
                            </div>
                            <div class="form-check sentence">
                                <input class="form-check-input" type="radio" name="level" id="gameLevel12" value="1+2" @if(!Auth::guard('web')->user()) disabled @endif>
                                <label class="form-check-label" for="gameLevel23">
                                    {{trans('home.1+2 - I\'m curious and eager to help!')}}
                                </label>
                            </div>
                            <div class="form-check sentence">
                                <input class="form-check-input" type="radio" name="level" id="gameLevel23" value="2+3" @if(!Auth::guard('web')->user()) disabled @endif>
                                <label class="form-check-label" for="gameLevel23">
                                    {{trans('home.2+3 - I\'m eager to help and feeling enthusiastic!')}}
                                </label>
                            </div>
                            <div class="form-check sentence">
                                <input class="form-check-input" type="radio" name="level" id="gameLevel123" value="1+2+3" @if(!Auth::guard('web')->user()) checked @endif>
                                <label class="form-check-label" for="gameLevel123">
                                    {{trans('home.1+2+3 - I\'m curious, eager to help and feeling enthusiastic!')}}
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3 float-left">{{trans('home.Start Game!')}}</button>
                            <p class="float-right mt-3">{{trans('home.Points:')}} <b>{{$points}}</b></p>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                @include('web.layouts.right_column')
            </div>
        </div>
    </main>
@endsection
