<!-- shared/game-level2.blade.php -->
<div class="glass-card p-3">
    <!-- Header -->
    <div class="mb-4">
        <div class="text-center mb-3">
            <span class="level-badge">🎮 {{trans('home.LEVEL 2')}}</span>
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
    <div class="text-center mb-3">
        @if($level == 2 || $level == '2+3')
            <h4 class="fw-bold text-primary">{{trans('home.Why can\'t this sentence be used for teaching X?')}}</h4>
        @else
            <h4 class="fw-bold text-primary">{{trans('home.Why not this one?')}}</h4>
        @endif
    </div>

    <!-- Sentence Display -->
    <div class="sentence-display">
        📝 {{$sentence->sentence}}
    </div>

    <!-- Form -->
    <form id="form-{{$submit}}" action="{{route('answerLevel2', ['code' => $language->lang_code, 'level' => $level])}}" method="POST">
        @csrf
        @method('POST')
        <input type="hidden" name="sentenceId" value="{{$sentence->id}}"/>
        <input type="hidden" name="answerId" value="{{$answerId}}"/>
        @if(is_array($answersIds))
            @foreach($answersIds as $item)
                <input type="hidden" name="answersIds[]" value="{{$item}}"/>
            @endforeach
        @else
            <input type="hidden" name="answersIds" value="{{$answersIds}}"/>
        @endif

        <!-- Checkbox Options -->
        <div class="checkboxes-container mb-4">
            <!-- Offensive -->
            <label class="checkbox-card">
                <input class="form-check-input d-none answer" type="checkbox" id="offensive" name="answer[]" value="offensive">
                <div class="checkbox-content d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center flex-grow-1">
                        <span class="me-3">🚫</span>
                        <span>{{trans('home.Offensive')}}</span>
                    </div>
                    <span class="info-icon show-tool-tip">
                        <svg height="20" width="20" viewBox="0 0 16 16">
                            <path fill="#667eea" d="M8 0c-4.4 0-8 3.6-8 8s3.6 8 8 8 8-3.6 8-8-3.6-8-8-8zM8.9 13h-2v-2h2v2zM11 8.1c-0.4 0.4-0.8 0.6-1.2 0.7-0.6 0.4-0.8 0.2-0.8 1.2h-2c0-2 1.2-2.6 2-3 0.3-0.1 0.5-0.2 0.7-0.4 0.1-0.1 0.3-0.3 0.1-0.7-0.2-0.5-0.8-1-1.7-1-1.4 0-1.6 1.2-1.7 1.5l-2-0.3c0.1-1.1 1-3.2 3.6-3.2 1.6 0 3 0.9 3.6 2.2 0.4 1.1 0.2 2.2-0.6 3z"></path>
                        </svg>
                        <small class="tooltip-custom" style="display: none;">{{trans('home.XXXX - offensive')}}</small>
                    </span>
                </div>
            </label>

            <!-- Vulgar -->
            <label class="checkbox-card">
                <input class="form-check-input d-none answer" type="checkbox" id="vulgar" name="answer[]" value="vulgar">
                <div class="checkbox-content d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center flex-grow-1">
                        <span class="me-3">💬</span>
                        <span>{{trans('home.Vulgar')}}</span>
                    </div>
                    <span class="info-icon show-tool-tip">
                        <svg height="20" width="20" viewBox="0 0 16 16">
                            <path fill="#667eea" d="M8 0c-4.4 0-8 3.6-8 8s3.6 8 8 8 8-3.6 8-8-3.6-8-8-8zM8.9 13h-2v-2h2v2zM11 8.1c-0.4 0.4-0.8 0.6-1.2 0.7-0.6 0.4-0.8 0.2-0.8 1.2h-2c0-2 1.2-2.6 2-3 0.3-0.1 0.5-0.2 0.7-0.4 0.1-0.1 0.3-0.3 0.1-0.7-0.2-0.5-0.8-1-1.7-1-1.4 0-1.6 1.2-1.7 1.5l-2-0.3c0.1-1.1 1-3.2 3.6-3.2 1.6 0 3 0.9 3.6 2.2 0.4 1.1 0.2 2.2-0.6 3z"></path>
                        </svg>
                        <small class="tooltip-custom" style="display: none;">{{trans('home.XXXX- vulgar')}}</small>
                    </span>
                </div>
            </label>

            <!-- Sensitive Content -->
            <label class="checkbox-card">
                <input class="form-check-input d-none answer" type="checkbox" id="sensitiveContent" name="answer[]" value="sensitiveContent">
                <div class="checkbox-content d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center flex-grow-1">
                        <span class="me-3">⚠️</span>
                        <span>{{trans('home.Sensitive content')}}</span>
                    </div>
                    <span class="info-icon show-tool-tip">
                        <svg height="20" width="20" viewBox="0 0 16 16">
                            <path fill="#667eea" d="M8 0c-4.4 0-8 3.6-8 8s3.6 8 8 8 8-3.6 8-8-3.6-8-8-8zM8.9 13h-2v-2h2v2zM11 8.1c-0.4 0.4-0.8 0.6-1.2 0.7-0.6 0.4-0.8 0.2-0.8 1.2h-2c0-2 1.2-2.6 2-3 0.3-0.1 0.5-0.2 0.7-0.4 0.1-0.1 0.3-0.3 0.1-0.7-0.2-0.5-0.8-1-1.7-1-1.4 0-1.6 1.2-1.7 1.5l-2-0.3c0.1-1.1 1-3.2 3.6-3.2 1.6 0 3 0.9 3.6 2.2 0.4 1.1 0.2 2.2-0.6 3z"></path>
                        </svg>
                        <small class="tooltip-custom" style="display: none;">{{trans('home.XXXX - sensitive content')}}</small>
                    </span>
                </div>
            </label>

            <!-- Spelling/Grammar -->
            <label class="checkbox-card">
                <input class="form-check-input d-none answer" type="checkbox" id="spelling and/or grammar problems" name="answer[]" value="spelling and/or grammar problems">
                <div class="checkbox-content d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center flex-grow-1">
                        <span class="me-3">✏️</span>
                        <span>{{trans('home.Spelling and/or grammar problems')}}</span>
                    </div>
                    <span class="info-icon show-tool-tip">
                        <svg height="20" width="20" viewBox="0 0 16 16">
                            <path fill="#667eea" d="M8 0c-4.4 0-8 3.6-8 8s3.6 8 8 8 8-3.6 8-8-3.6-8-8-8zM8.9 13h-2v-2h2v2zM11 8.1c-0.4 0.4-0.8 0.6-1.2 0.7-0.6 0.4-0.8 0.2-0.8 1.2h-2c0-2 1.2-2.6 2-3 0.3-0.1 0.5-0.2 0.7-0.4 0.1-0.1 0.3-0.3 0.1-0.7-0.2-0.5-0.8-1-1.7-1-1.4 0-1.6 1.2-1.7 1.5l-2-0.3c0.1-1.1 1-3.2 3.6-3.2 1.6 0 3 0.9 3.6 2.2 0.4 1.1 0.2 2.2-0.6 3z"></path>
                        </svg>
                        <small class="tooltip-custom" style="display: none;">{{trans('home.XXXX- Spelling/grammar problems')}}</small>
                    </span>
                </div>
            </label>

            <!-- Lack of Context -->
            <label class="checkbox-card">
                <input class="form-check-input d-none answer" type="checkbox" id="lack of context and/or incomprehensible" name="answer[]" value="lack of context and/or incomprehensible">
                <div class="checkbox-content d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center flex-grow-1">
                        <span class="me-3">❓</span>
                        <span>{{trans('home.Lack of context and/or incomprehensible')}}</span>
                    </div>
                    <span class="info-icon show-tool-tip">
                        <svg height="20" width="20" viewBox="0 0 16 16">
                            <path fill="#667eea" d="M8 0c-4.4 0-8 3.6-8 8s3.6 8 8 8 8-3.6 8-8-3.6-8-8-8zM8.9 13h-2v-2h2v2zM11 8.1c-0.4 0.4-0.8 0.6-1.2 0.7-0.6 0.4-0.8 0.2-0.8 1.2h-2c0-2 1.2-2.6 2-3 0.3-0.1 0.5-0.2 0.7-0.4 0.1-0.1 0.3-0.3 0.1-0.7-0.2-0.5-0.8-1-1.7-1-1.4 0-1.6 1.2-1.7 1.5l-2-0.3c0.1-1.1 1-3.2 3.6-3.2 1.6 0 3 0.9 3.6 2.2 0.4 1.1 0.2 2.2-0.6 3z"></path>
                        </svg>
                        <small class="tooltip-custom" style="display: none;">{{trans('home.XXXX-Lack of context/incomprehensible')}}</small>
                    </span>
                </div>
            </label>

            <!-- Fine Option (conditional) -->
            @if($level == 2 || $level == '2+3')
                <label class="checkbox-card">
                    <input class="form-check-input d-none answer" type="checkbox" id="{{$fine}}" name="answer[]" value="fine">
                    <div class="checkbox-content d-flex align-items-center">
                        <span class="me-3">✅</span>
                        <span>{{trans('home.This sentence is fine')}}</span>
                    </div>
                </label>
            @endif
        </div>

        <!-- Submit Button -->
        <div class="text-center">
            <button id="{{$submit}}" type="submit" class="btn game-btn game-btn-primary choose-button" disabled>
                ✓ {{trans('home.Choose')}}
            </button>
        </div>

        <!-- Bottom Data -->
        <div class="mt-4">
            @include('web.shared.game-bottom-data')
        </div>
    </form>
</div>
