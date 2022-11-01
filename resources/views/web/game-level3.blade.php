@extends('web.layouts.app')

@section('content')
    <main class="px-3">
        <div class="card color-black">
            <div class="card-header">
                {{trans('home.LEVEL 3')}}
                <a href="{{route('gameIntro', $language->lang_code)}}" class="btn btn-secondary float-right">{{trans('home.Level choose')}}</a>
            </div>
            <div class="card-body">
                <form id="gameForm" action="{{route('answerLevel3', ['code' => $language->lang_code, 'level' => $level])}}"
                      method="POST">
                    @csrf
                    @method('POST')
                    <h4>{{trans('home.Tap or click where the problem is')}} ({{$answerDetail->reason}})</h4>
                    <p id="selectable-sentence" class="sentence">{{$sentence->sentence}}</p>
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
                    <input type="hidden" name="problematicWords" id="problematicWords" />
                    <button id="submit" class="btn btn-primary mt-3">{{trans('home.Choose')}}</button>
                    <button id="removeBtn" class="btn btn-primary mt-3">{{trans('home.Remove markers')}}</button>
                </form>
            </div>
        </div>
    </main>
@endsection
@section('javascript')
    <script>
        window.onload = function (){
            $(document).ready(function(){
                (function () {
                    var removeBtn = document.getElementById('removeBtn');
                    var sandbox = document.getElementById('selectable-sentence');
                    var hltr = new TextHighlighter(sandbox);

                    removeBtn.addEventListener('click', function (e) {
                        e.preventDefault();
                        hltr.removeHighlights();
                    });
                })();

                $('#submit').click(function (e){
                    var str = "";
                    $('.highlighted').each(function(){
                        str += $(this).text() + ", ";
                    });
                    let problematicWords = $('#problematicWords');
                    problematicWords.val(str);
                    if(problematicWords.val() === "") {
                        e.preventDefault();
                        alert('Please select problematic words, then press button "choose"');
                    } else {
                        $("#gameForm").submit();
                    }
                });
            });
        }
    </script>
@endsection
