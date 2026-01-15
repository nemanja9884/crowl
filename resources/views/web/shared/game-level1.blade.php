<!-- shared/game-level1.blade.php -->
<div class="glass-card p-3">
    <!-- Header -->
    <div class="mb-4">
        <div class="text-center mb-3">
            <span class="level-badge">🎮 {{trans('home.LEVEL 1')}}</span>
        </div>
        <div class="row g-2">
            <div class="col-12 col-md-6">
                <a href="{{route('gameIntro', $language->lang_code)}}" class="btn game-btn game-btn-secondary w-100">
                    <i class="bi bi-arrow-left me-1"></i>
                    {{trans('home.Level choose')}}
                </a>
            </div>
            <div class="col-12 col-md-6">
                <a href="{{route('index')}}" class="btn game-btn game-btn-danger w-100">
                    <i class="bi bi-box-arrow-right me-1"></i>
                    {{trans('home.Exit game')}}
                </a>
            </div>
        </div>
    </div>

    <!-- Question -->
    <div class="text-center mb-4">
        <h4 class="fw-bold text-primary">{{trans('home.Which sentence wouldn\'t you choose for teaching English?')}}</h4>
    </div>

    <!-- Form -->
    <form id="{{$submit}}" action="{{route('answerLevel1', ['code' => $language->lang_code, 'level' => $level])}}" method="POST">
        @csrf
        @method('POST')
        <input type="hidden" name="firstSentenceId" value="{{$firstSentence->id}}"/>
        <input type="hidden" name="secondSentenceId" value="{{$secondSentence->id}}"/>

        <!-- Sentence Options -->
        <div class="sentences-container mb-4">
            <!-- Sentence 1 -->
            <label class="sentence-card">
                <input class="form-check-input d-none answer" type="radio" name="answer" value="{{$secondSentence->id}}">
                <div class="sentence-content">
                    <div class="d-flex align-items-start">
                        <span class="fs-3 me-3">📝</span>
                        <span class="flex-grow-1" style="cursor: pointer; font-size: 1.1rem;">
                    {{$firstSentence->sentence}}
                </span>
                    </div>
                </div>
            </label>

            <!-- Sentence 2 -->
            <label class="sentence-card">
                <input class="form-check-input d-none answer" type="radio" name="answer" value="{{$firstSentence->id}}">
                <div class="sentence-content">
                    <div class="d-flex align-items-start">
                        <span class="fs-3 me-3">📝</span>
                        <span class="flex-grow-1" style="cursor: pointer; font-size: 1.1rem;">
                    {{$secondSentence->sentence}}
                </span>
                    </div>
                </div>
            </label>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <button type="{{$submit}}" class="btn game-btn game-btn-primary {{$choose}}" disabled>
                ✓ {{trans('home.Choose')}}
            </button>
            <button type="{{$submit}}" name="noneOfThem" value="{{$firstSentence->id}},{{$secondSentence->id}}" class="btn game-btn game-btn-secondary">
                ✗ {{trans('home.None of them')}}
            </button>
            <button type="{{$submit}}" name="bothOfThem" value="{{$firstSentence->id}},{{$secondSentence->id}}" class="btn game-btn game-btn-secondary">
                ✓✓ {{trans('home.Both of them')}}
            </button>
        </div>

        <!-- Bottom Data -->
        <div class="mt-4">
            @include('web.shared.game-bottom-data')
        </div>
    </form>
</div>
