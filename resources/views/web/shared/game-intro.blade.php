<div class="card color-black">
    <div class="card-header">
        {{trans('home.Game intro')}}
    </div>
    <div class="card-body text-left">
        <h5 class="card-title question">{{trans('home.You can choose between 3 levels of game. 1,2 or 3 level, or you can take 1 + 2 or 2 3 or 1 + 2 + 3. Good luck!')}}</h5>
        <form action="{{route('startGame', $language->lang_code)}}" method="POST">
            @csrf
            @method('POST')
            <h5 class="question">{{trans('home.Please choose your level:')}}</h5>
            <div class="form-check sentence">
                <input class="form-check-input" type="radio" name="level" id="gameLevel1" value="1"
                       @if(!Auth::guard('web')->user()) disabled @else checked @endif>
                <label class="form-check-label answer-label" for="gameLevel1">
                    {{trans('home.1- I\'m curious!')}}
                </label>
            </div>
            <div class="form-check sentence">
                <input class="form-check-input" type="radio" name="level" id="gameLevel2" value="2"
                       @if(!Auth::guard('web')->user()) disabled @endif>
                <label class="form-check-label answer-label" for="gameLevel2">
                    {{trans('home.2- I\'m eager to help!')}}
                </label>
            </div>
            <div class="form-check sentence">
                <input class="form-check-input" type="radio" name="level" id="gameLevel3" value="3"
                       @if(!Auth::guard('web')->user()) disabled @endif>
                <label class="form-check-label answer-label" for="gameLevel3">
                    {{trans('home.3- I\'m feeling enthusiastic!')}}
                </label>
            </div>
            <div class="form-check sentence">
                <input class="form-check-input" type="radio" name="level" id="gameLevel12" value="1+2"
                       @if(!Auth::guard('web')->user()) disabled @endif>
                <label class="form-check-label answer-label" for="gameLevel23">
                    {{trans('home.1+2 - I\'m curious and eager to help!')}}
                </label>
            </div>
            <div class="form-check sentence">
                <input class="form-check-input" type="radio" name="level" id="gameLevel23" value="2+3"
                       @if(!Auth::guard('web')->user()) disabled @endif>
                <label class="form-check-label answer-label" for="gameLevel23">
                    {{trans('home.2+3 - I\'m eager to help and feeling enthusiastic!')}}
                </label>
            </div>
            <div class="form-check sentence">
                <input class="form-check-input" type="radio" name="level" id="gameLevel123" value="1+2+3"
                       @if(!Auth::guard('web')->user()) checked @endif>
                <label class="form-check-label answer-label" for="gameLevel123">
                    {{trans('home.1+2+3 - I\'m curious, eager to help and feeling enthusiastic!')}}
                </label>
            </div>
            <button type="submit" class="btn btn-primary mt-3 float-left">{{trans('home.Start Game!')}}</button>
            @include('web.shared.game-bottom-data')
        </form>
    </div>
</div>
