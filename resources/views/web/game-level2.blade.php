@extends('web.layouts.app')

@section('content')
    <main class="px-3">
        <div class="card color-black">
            <div class="card-header">
                {{trans('home.LEVEL 2')}}
                <a href="{{route('gameIntro', $language->lang_code)}}"
                   class="btn btn-secondary float-right">{{trans('home.Level choose')}}</a>
            </div>
            <div class="card-body">
                <form id="form" action="{{route('answerLevel2', ['code' => $language->lang_code, 'level' => $level])}}"
                      method="POST">
                    @csrf
                    @method('POST')
                    <h4>{{trans('home.Why not this one?')}}</h4>
                    <p class="sentence">{{$sentence->sentence}}</p>
                    <input type="hidden" name="answerId" value="{{$answerId}}"/>
                    @if(is_array($answersIds))
                        @foreach($answersIds as $item)
                            <input type="hidden" name="answersIds[]" value="{{$item}}"/>
                        @endforeach
                    @else
                        <input type="hidden" name="answersIds" value="{{$answersIds}}"/>
                    @endif
                    <div class="form-check sentence">
                        <input class="form-check-input answer" type="checkbox" id="offensive" name="answer[]"
                               value="offensive">
                        <label class="form-check-label" for="offensive">
                            {{trans('home.Offensive')}}
                        </label>
                    </div>
                    <div class="form-check sentence">
                        <input class="form-check-input answer" type="checkbox" id="vulgar" name="answer[]"
                               value="vulgar">
                        <label class="form-check-label" for="vulgar">
                            {{trans('home.Vulgar')}}
                        </label>
                    </div>
                    <div class="form-check sentence">
                        <input class="form-check-input answer" type="checkbox" id="sensitiveContent"
                               name="answer[]"
                               value="sensitiveContent">
                        <label class="form-check-label" for="sensitiveContent">
                            {{trans('home.Sensitive content')}}
                        </label>
                    </div>
                    <div class="form-check sentence">
                        <input class="form-check-input answer" type="checkbox" id="spelling/grammarProblems"
                               name="answer[]"
                               value="spelling/grammarProblems">
                        <label class="form-check-label" for="spelling/grammarProblems">
                            {{trans('home.Spelling/grammar problems')}}
                        </label>
                    </div>
                    <div class="form-check sentence">
                        <input class="form-check-input answer" type="checkbox"
                               id="lackOfContext/incomprehensible"
                               name="answer[]" value="lackOfContext/incomprehensible">
                        <label class="form-check-label" for="lackOfContext/incomprehensible">
                            {{trans('home.Lack of context/incomprehensible')}}
                        </label>
                    </div>
                    <div class="form-check sentence">
                        <input class="form-check-input answer" type="checkbox"
                               id="fine"
                               name="answer[]" value="fine">
                        <label class="form-check-label" for="fine">
                            {{trans('home.This sentence is fine')}}
                        </label>
                    </div>
                    <button id="submit" type="submit" class="btn btn-primary mt-3">{{trans('home.Choose')}}</button>
                </form>
            </div>
        </div>
    </main>
@endsection
@section('javascript')
    <script>
        window.onload = function () {
            $(document).ready(function () {
                $("#submit").click(function (e) {
                    let checked = $(".answer").is(":checked");
                    if (checked === true) {
                        $("#form").submit();
                    } else {
                        e.preventDefault();
                        alert('You must select something');
                        // toastr.error('You must select something');
                    }
                });
            });
        }
    </script>
@endsection
