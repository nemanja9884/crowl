@extends('web.layouts.app')

@section('content')
    <main class="px-3">
        <div class="card color-black">
            <div class="card-header">
                Featured
            </div>
            <div class="card-body">
                <form action="{{route('next-question', ['code' => $language->lang_code, 'level' => $level])}}" method="POST">
                    @csrf
                    @method('POST')
                    <label>Which sentence would you choose for teaching English?</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="offensive" name="answer" value="offensive">
                        <label class="form-check-label" for="offensive">
                            Offensive
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="vulgar" name="answer" value="vulgar">
                        <label class="form-check-label" for="vulgar">
                            Vulgar
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="sensitiveContent" name="answer" value="sensitiveContent">
                        <label class="form-check-label" for="sensitiveContent">
                            Sensitive content
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="spelling/grammarProblems" name="answer" value="spelling/grammarProblems">
                        <label class="form-check-label" for="spelling/grammarProblems">
                            Spelling/grammar problems
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="lackOfContext/incomprehensible" name="answer" value="lackOfContext/incomprehensible">
                        <label class="form-check-label" for="lackOfContext/incomprehensible">
                            Lack of context/incomprehensible
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Choose</button>
                </form>
            </div>
        </div>
    </main>
@endsection
