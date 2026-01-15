<!-- shared/game-level3.blade.php -->
<div class="glass-card p-3">
    <!-- Header -->
    <div class="mb-4">
        <div class="text-center mb-3">
            <span class="level-badge">🎮 {{trans('home.LEVEL 3')}}</span>
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

    <!-- Instructions -->
    <div class="instruction-box">
        <p class="mb-0">
            <strong>📌 {{trans("home.This sentence has been considered")}}</strong>
            <span style="color: #f5576c; font-weight: bold;">{{trans("home.$answerDetail->reason")}}</span>
            <strong>{{trans("home.for teaching English. Tap or click where the problem is.")}}</strong>
        </p>
    </div>

    <!-- Form -->
    <form id="gameForm{{$submit}}" action="{{route('answerLevel3', ['code' => $language->lang_code, 'level' => $level])}}" method="POST">
        @csrf
        @method('POST')

        <!-- Hidden Inputs -->
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
        <input type="hidden" name="problematicWords" id="{{$problematicWords}}"/>

        <!-- Selectable Sentence -->
        <div class="mb-4">
            <div class="text-center mb-2">
                <small class="text-muted">
                    <i class="bi bi-cursor-text me-1"></i>
                    {{trans('home.Select the problematic words by clicking/tapping')}}
                </small>
            </div>
            <div id="{{$selectableSentence}}" class="selectable-sentence-box">
                {{$sentence->sentence}}
            </div>
        </div>

        <!-- Fine Option (conditional) -->
        @if($level == 3)
            <div class="mb-4">
                <label class="fine-checkbox-card">
                    <input class="form-check-input d-none answer" type="checkbox" id="{{$fine}}" name="fine" value="1">
                    <div class="checkbox-content d-flex align-items-center">
                        <span class="me-3">✅</span>
                        <span>{{trans('home.This sentence doesn\'t have any problem of this type.')}}</span>
                    </div>
                </label>
            </div>
        @endif

        <!-- Action Buttons -->
        <div class="action-buttons mb-4">
            <button id="{{$submit}}" type="button" class="btn game-btn game-btn-primary" disabled>
                💾 {{trans('home.Save')}}
            </button>
            <button id="{{$removeBtn}}" type="button" class="btn game-btn game-btn-warning">
                🗑️ {{trans('home.Remove markers')}}
            </button>
        </div>

        <!-- Bottom Data -->
        <div class="mt-4">
            @include('web.shared.game-bottom-data')
        </div>
    </form>
</div>
