@extends('web.layouts.app')

@section('content')
    <main class="px-3">
        <div class="card color-black">
            <div class="card-header">
                Question
            </div>
            <div class="card-body">
                <form action="{{route('answerLevel1', ['code' => $language->lang_code, 'level' => $level])}}" method="POST">
                    @csrf
                    @method('POST')
                    <label>Which sentence would you choose for teaching English?</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="answer" id="answer" value="{{$firstSentence->id}}">
                        <label class="form-check-label" for="answer">
                            {{$firstSentence->sentence}}
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="answer" id="answer" value="{{$secondSentence->id}}">
                        <label class="form-check-label" for="answer">
                            {{$secondSentence->sentence}}
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Choose</button>
                    <button type="submit" name="noneOfThem" value="[{{$firstSentence->id}}, {{$secondSentence->id}}]" class="btn btn-primary mt-3">None of them</button>
                    <button type="submit" name="bothOfThem" value="bothOfThem" class="btn btn-primary mt-3">Both of them</button>
                </form>
            </div>
        </div>
    </main>
@endsection
