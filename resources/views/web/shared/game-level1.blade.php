<div class="card color-black">
    <div class="card-header">
        <div class="game-page-desktop">
            <div class="d-flex w-100">
                <div class="col-5">
                    <p>{{trans('home.LEVEL 1')}}</p>
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
            {{trans('home.LEVEL 1')}}
            <div class="buttons mt-2">
                <a href="{{route('index')}}" type="button" class="btn btn-danger">{{trans('home.Exit game')}}</a>
                <a href="{{route('gameIntro', $language->lang_code)}}" type="button" class="btn btn-secondary ml-2" style="color: white; margin-right: 5px;">{{trans('home.Level choose')}}</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form action="{{route('answerLevel1', ['code' => $language->lang_code, 'level' => $level])}}" method="POST">
            @csrf
            @method('POST')
            <input type="hidden" name="firstSentenceId" value="{{$firstSentence->id}}"/>
            <input type="hidden" name="secondSentenceId" value="{{$secondSentence->id}}"/>
            <h4 class="question">{{trans('home.Which sentence wouldn\'t you choose for teaching English?')}}</h4>
            <div class="form-check sentence">
                <input class="form-check-input answer" type="radio" name="answer" id="answer" value="{{$secondSentence->id}}">
                <label class="form-check-label answer-label" for="answer">
                    {{$firstSentence->sentence}}
                </label>
            </div>

            <div class="form-check sentence">
                <input class="form-check-input answer" type="radio" name="answer" id="answer" value="{{$firstSentence->id}}">
                <label class="form-check-label answer-label" for="answer">
                    {{$secondSentence->sentence}}
                </label>
            </div>
            <button type="{{$submit}}" class="btn btn-primary mt-3 {{$choose}}">{{trans('home.Choose')}}</button>
            <button type="{{$submit}}" name="noneOfThem" value="{{$firstSentence->id}},{{$secondSentence->id}}" class="btn btn-primary mt-3">{{trans('home.None of them')}}</button>
            <button type="{{$submit}}" name="bothOfThem" value="{{$firstSentence->id}},{{$secondSentence->id}}" class="btn btn-primary mt-3">{{trans('home.Both of them')}}</button>
            @include('web.shared.game-bottom-data')
        </form>
    </div>
</div>
