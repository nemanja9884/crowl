@extends('web.layouts.app')

@section('content')
    <main class="px-3">
        <div class="card color-black">
            <div class="card-header">
                GAME INTRO
            </div>
            <div class="card-body text-left">
                <h5 class="card-title">You can choose between 3 levels of game. 1,2 or 3 level, or you can take 1 + 2 or 2
                    3 or 1 + 2 + 3. Good luck!</h5>
                <form action="{{route('startGame', $language->lang_code)}}" method="POST">
                    @csrf
                    @method('POST')
                    <h5>Please choose your level:</h5>
                    <div class="form-check sentence">
                        <input class="form-check-input" type="radio" name="level" id="gameLevel" value="1" checked>
                        <label class="form-check-label" for="gameLevel">
                            1
                        </label>
                    </div>
                    <div class="form-check sentence">
                        <input class="form-check-input" type="radio" name="level" id="gameLevel" value="2">
                        <label class="form-check-label" for="gameLevel">
                            2
                        </label>
                    </div>
                    <div class="form-check sentence">
                        <input class="form-check-input" type="radio" name="level" id="gameLevel" value="3">
                        <label class="form-check-label" for="gameLevel">
                            3
                        </label>
                    </div>
                    <div class="form-check sentence">
                        <input class="form-check-input" type="radio" name="level" id="gameLevel" value="1+2">
                        <label class="form-check-label" for="gameLevel">
                            1 + 2
                        </label>
                    </div>
                    <div class="form-check sentence">
                        <input class="form-check-input" type="radio" name="level" id="gameLevel" value="2+3">
                        <label class="form-check-label" for="gameLevel">
                            2 + 3
                        </label>
                    </div>
                    <div class="form-check sentence">
                        <input class="form-check-input" type="radio" name="level" id="gameLevel" value="1+2+3">
                        <label class="form-check-label" for="gameLevel">
                            1 + 2 + 3
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">{{trans('home.Start Game!')}}</button>
                </form>

            </div>
        </div>
    </main>
@endsection
