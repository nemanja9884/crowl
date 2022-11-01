@extends('web.layouts.app')

@section('content')
    <main class="px-3">
        <div class="card color-black">
            <div class="card-header">
                {{trans('home.LEVEL 1')}}
                <a href="{{route('gameIntro', $language->lang_code)}}" class="btn btn-secondary float-right">{{trans('home.Level choose')}}</a>
            </div>
            <div class="card-body">
                <form action="{{route('answerLevel1', ['code' => $language->lang_code, 'level' => $level])}}" method="POST">
                    @csrf
                    @method('POST')
                    <h4>{{trans('home.Which sentence would you choose for teaching English?')}}</h4>
                    <div class="form-check sentence">
                        <input class="form-check-input" type="radio" name="answer" id="answer" value="{{$firstSentence->id}}">
                        <label class="form-check-label" for="answer">
                            {{$firstSentence->sentence}} ({{$firstSentence->word_reliability}})
                        </label>
                    </div>

                    <div class="form-check sentence">
                        <input class="form-check-input" type="radio" name="answer" id="answer" value="{{$secondSentence->id}}">
                        <label class="form-check-label" for="answer">
                            {{$secondSentence->sentence}} ({{$secondSentence->word_reliability}})
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">{{trans('home.Choose')}}</button>
                    <button type="submit" name="noneOfThem" value="{{$firstSentence->id}},{{$secondSentence->id}}" class="btn btn-primary mt-3">{{trans('home.None of them')}}</button>
                    <button type="submit" name="bothOfThem" value="{{$firstSentence->id}},{{$secondSentence->id}}" class="btn btn-primary mt-3">{{trans('home.Both of them')}}</button>
                </form>
            </div>
        </div>
    </main>
@endsection
