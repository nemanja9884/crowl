@extends('web.layouts.app')

@section('content')
    <main class="px-3">
        <div class="card color-black">
            <div class="card-header">
                GAME INTRO
            </div>
            <div class="card-body text-left">
                <h5 class="card-title">{{trans('home.You can choose between 3 levels of game. 1,2 or 3 level, or you can take 1 + 2 or 2
                    3 or 1 + 2 + 3. Good luck!')}}</h5>
                <form action="{{route('startGame', $language->lang_code)}}" method="POST">
                    @csrf
                    @method('POST')
                    <h5>{{trans('home.Please choose your level:')}}</h5>
                    <div class="form-check sentence">
                        <input class="form-check-input" type="radio" name="level" id="gameLevel1" value="1" @if(!Auth::guard('web')->user()) disabled @else checked @endif>
                        <label class="form-check-label" for="gameLevel1">
                            1
                        </label>
                    </div>
                    <div class="form-check sentence">
                        <input class="form-check-input" type="radio" name="level" id="gameLevel2" value="2" @if(!Auth::guard('web')->user()) disabled @endif>
                        <label class="form-check-label" for="gameLevel2">
                            2
                        </label>
                    </div>
                    <div class="form-check sentence">
                        <input class="form-check-input" type="radio" name="level" id="gameLevel3" value="3" @if(!Auth::guard('web')->user()) disabled @endif>
                        <label class="form-check-label" for="gameLevel3">
                            3
                        </label>
                    </div>
                    <div class="form-check sentence">
                        <input class="form-check-input" type="radio" name="level" id="gameLevel12" value="1+2" @if(!Auth::guard('web')->user()) disabled @endif>
                        <label class="form-check-label" for="gameLevel23">
                            1 + 2
                        </label>
                    </div>
                    <div class="form-check sentence">
                        <input class="form-check-input" type="radio" name="level" id="gameLevel23" value="2+3" @if(!Auth::guard('web')->user()) disabled @endif>
                        <label class="form-check-label" for="gameLevel23">
                            2 + 3
                        </label>
                    </div>
                    <div class="form-check sentence">
                        <input class="form-check-input" type="radio" name="level" id="gameLevel123" value="1+2+3" @if(!Auth::guard('web')->user()) checked @endif>
                        <label class="form-check-label" for="gameLevel123">
                            1 + 2 + 3
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3 float-left">{{trans('home.Start Game!')}}</button>
                    <p class="float-right mt-3">{{trans('home.Points:')}} <b>{{$points}}</b></p>
                </form>
            </div>
        </div>
    </main>
@endsection
