@extends('web.layouts.app')

@section('content')
    <main class="px-3">
        <div class="card color-black">
            <div class="card-header">
                {{trans('home.LEVEL 3')}}
                <a href="{{route('index')}}" type="button" class="btn btn-danger float-right ml-2">{{trans('home.Exit game')}}</a>
                <a href="{{route('gameIntro', $language->lang_code)}}" type="button" class="btn btn-secondary float-right mr-2" style="color: white; margin-right: 5px;">{{trans('home.Level choose')}}</a>
            </div>
            <div class="card-body">
                <form id="gameForm"
                      action="{{route('answerLevel3', ['code' => $language->lang_code, 'level' => $level])}}"
                      method="POST">
                    @csrf
                    @method('POST')
                    <h4>{{trans("home.This sentence has been considered $answerDetail->reason for teaching English. Tap or click where the problem is.")}}</h4>
                    <p id="selectable-sentence" class="sentence">{{$sentence->sentence}}</p>
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
                                   id="fine"
                                   name="fine" value="1">
                            <label class="form-check-label" for="fine">
                                {{trans('home.This sentence is fine')}}
                            </label>
                        </div>
                    @endif
                    <input type="hidden" name="problematicWords" id="problematicWords"/>
                    <button id="submit" class="btn btn-primary mt-3">{{trans('home.Save')}}</button>
                    <button id="removeBtn" class="btn btn-primary mt-3">{{trans('home.Remove markers')}}</button>
                    <p class="float-right mt-3">Points: <b>{{$points}}</b></p>
                </form>
            </div>
        </div>
    </main>
@endsection
@section('javascript')
    <script>
        window.onload = function () {
            $(document).ready(function () {
                (function () {
                    var removeBtn = document.getElementById('removeBtn');
                    var sandbox = document.getElementById('selectable-sentence');
                    var hltr = new TextHighlighter(sandbox);

                    removeBtn.addEventListener('click', function (e) {
                        e.preventDefault();
                        hltr.removeHighlights();
                    });
                })();

                $('#submit').click(function (e) {
                    var str = "";
                    $('.highlighted').each(function () {
                        str += $(this).text() + "| ";
                    });
                    let problematicWords = $('#problematicWords');
                    problematicWords.val(str);
                    if (problematicWords.val() === "" && $('#fine').is(":checked") === false) {
                        e.preventDefault();
                        // toastr.error('Please select problematic words, then press button "choose"');
                        alert('Please select problematic words, then press button "choose"');
                    } else {
                        $("#gameForm").submit();
                    }
                });
            });
        }
    </script>
@endsection
