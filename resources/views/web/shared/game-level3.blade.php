<div class="card color-black">
    <div class="card-header">
        <div class="game-page-desktop">
            <div class="d-flex w-100">
                <div class="col-5">
                    <p>{{trans('home.LEVEL 3')}}</p>
                </div>
                <div class="col-7">
                    <div class="buttons float-right d-flex">
                        <a href="{{route('gameIntro', $language->lang_code)}}" type="button" class="btn btn-secondary float-right mr-2" style="color: white; margin-right: 5px;">{{trans('home.Level choose')}}</a>
                        <a href="{{route('index')}}" type="button" class="btn btn-danger float-right ml-2">{{trans('home.Exit game')}}</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="game-page-mobile">
            {{trans('home.LEVEL 3')}}
            <div class="buttons mt-2">
                <a href="{{route('index')}}" type="button" class="btn btn-danger">{{trans('home.Exit game')}}</a>
                <a href="{{route('gameIntro', $language->lang_code)}}" type="button" class="btn btn-secondary ml-2" style="color: white; margin-right: 5px;">{{trans('home.Level choose')}}</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form id="gameForm{{$submit}}"
              action="{{route('answerLevel3', ['code' => $language->lang_code, 'level' => $level])}}"
              method="POST">
            @csrf
            @method('POST')
{{--            <h4>{{trans("home.This sentence has been considered $answerDetail->reason for teaching English. Tap or click where the problem is.")}}</h4>--}}
            <h4>{{trans("home.This sentence has been considered")}} <b><i>{{trans("home.$answerDetail->reason")}}</i></b> {{trans("home.for teaching English. Tap or click where the problem is.")}}</h4>
            <p id="{{$selectableSentence}}" class="sentence">{{$sentence->sentence}}</p>
            <input type="hidden" name="sentenceId" value="{{$sentence->id}}"/>
            <input type="hidden" name="answerId" value="{{$answerId}}"/>
            <input type="hidden" name="reasonId" value="{{$reasonId}}"/>
            @if(is_array($answersIds))
                @foreach($answersIds as $item)
                    <input type="hidden" name="answersIds[]" value="{{$item}}"/>
                @endforeach
            @else
                <input type="hidden" name="answersIds" value="{{$answersIds}}"/>
            @endif
            @foreach($reasons as $reason)
                <input type="hidden" name="reasons[]" value="{{$reason}}"/>
            @endforeach
            @if($level == 3)
                <div class="form-check sentence">
                    <input class="form-check-input answer" type="checkbox"
                           id="{{$fine}}"
                           name="fine" value="1">
                    <label class="form-check-label" for="fine">
                        {{trans('home.This sentence doesn’t have any problem of this type.')}}
                    </label>
                </div>
            @endif
            <input type="hidden" name="problematicWords" id="{{$problematicWords}}"/>
            <button id="{{$submit}}" class="btn btn-primary mt-3">{{trans('home.Save')}}</button>
            <button id="{{$removeBtn}}" class="btn btn-primary mt-3">{{trans('home.Remove markers')}}</button>
            @include('web.shared.game-bottom-data')
        </form>
    </div>
</div>
