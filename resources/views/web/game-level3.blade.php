@extends('web.layouts.app')

@section('content')
    <main class="px-3">
        <div class="card color-black">
            <div class="card-header">
                Featured
            </div>
            <div class="card-body">
                <form id="gameForm" action="{{route('answerLevel3', ['code' => $language->lang_code, 'level' => $level])}}"
                      method="POST">
                    @csrf
                    @method('POST')
                    <label>Why not this one?</label>
                    <p id="selectable-sentence">{{$sentence->sentence}}</p>
                    <input type="hidden" name="answerId" value="{{$answerId}}"/>
                    @if(is_array($answersIds))
                        @foreach($answersIds as $item)
                            <input type="hidden" name="answersIds[]" value="{{$item}}"/>
                        @endforeach
                    @else
                        <input type="hidden" name="answersIds" value="{{$answersIds}}"/>
                    @endif
                    <input type="hidden" name="problematicWords" id="problematicWords" />
                    <button id="submit" class="btn btn-primary mt-3">Choose</button>
                    <button id="removeBtn" class="btn btn-primary mt-3">Remove markers</button>
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
