<!-- shared/game-intro.blade.php -->
<div class="glass-card p-4">
    <div class="text-center mb-4">
        <h2 class="fw-bold text-primary">🎮 {{trans('home.Game intro')}}</h2>
        <p class="text-muted">{{trans('home.You can choose between 3 levels of game. 1,2 or 3 level, or you can take 1 + 2 or 2 3 or 1 + 2 + 3. Good luck!')}}</p>
    </div>

    <form id="levelSelectForm" action="{{route('startGame', $language->lang_code)}}" method="POST">
        @csrf
        @method('POST')

        <div class="levels-container">
            <!-- Level 1 -->
            <label class="level-card">
                <input class="form-check-input d-none level-radio" type="radio" name="level" value="1"
                       @if(!Auth::guard('web')->user()) disabled @else checked @endif>
                <div class="level-content d-flex align-items-center">
                    <span class="fs-1 me-3">🔍</span>
                    <div>
                        <h5 class="mb-0">{{trans('home.1- I\'m curious!')}}</h5>
                        <small class="text-muted">Beginner level</small>
                    </div>
                </div>
            </label>

            <!-- Level 2 -->
            <label class="level-card">
                <input class="form-check-input d-none level-radio" type="radio" name="level" value="2"
                       @if(!Auth::guard('web')->user()) disabled @endif>
                <div class="level-content d-flex align-items-center">
                    <span class="fs-1 me-3">💪</span>
                    <div>
                        <h5 class="mb-0">{{trans('home.2- I\'m eager to help!')}}</h5>
                        <small class="text-muted">Intermediate level</small>
                    </div>
                </div>
            </label>

            <!-- Level 3 -->
            <label class="level-card">
                <input class="form-check-input d-none level-radio" type="radio" name="level" value="3"
                       @if(!Auth::guard('web')->user()) disabled @endif>
                <div class="level-content d-flex align-items-center">
                    <span class="fs-1 me-3">🚀</span>
                    <div>
                        <h5 class="mb-0">{{trans('home.3- I\'m feeling enthusiastic!')}}</h5>
                        <small class="text-muted">Advanced level</small>
                    </div>
                </div>
            </label>

            <!-- Level 1+2 -->
            <label class="level-card">
                <input class="form-check-input d-none level-radio" type="radio" name="level" value="1+2"
                       @if(!Auth::guard('web')->user()) disabled @endif>
                <div class="level-content d-flex align-items-center">
                    <span class="fs-1 me-3">🔍💪</span>
                    <div>
                        <h5 class="mb-0">{{trans('home.1+2 - I\'m curious and eager to help!')}}</h5>
                        <small class="text-muted">Combined challenge</small>
                    </div>
                </div>
            </label>

            <!-- Level 2+3 -->
            <label class="level-card">
                <input class="form-check-input d-none level-radio" type="radio" name="level" value="2+3"
                       @if(!Auth::guard('web')->user()) disabled @endif>
                <div class="level-content d-flex align-items-center">
                    <span class="fs-1 me-3">💪🚀</span>
                    <div>
                        <h5 class="mb-0">{{trans('home.2+3 - I\'m eager to help and feeling enthusiastic!')}}</h5>
                        <small class="text-muted">Expert challenge</small>
                    </div>
                </div>
            </label>

            <!-- Level 1+2+3 -->
            <label class="level-card">
                <input class="form-check-input d-none level-radio" type="radio" name="level" value="1+2+3"
                       @if(!Auth::guard('web')->user()) checked @endif>
                <div class="level-content d-flex align-items-center">
                    <span class="fs-1 me-3">🔍💪🚀</span>
                    <div>
                        <h5 class="mb-0">{{trans('home.1+2+3 - I\'m curious, eager to help and feeling enthusiastic!')}}</h5>
                        <small class="text-muted">Ultimate challenge</small>
                    </div>
                </div>
            </label>
        </div>

        <!-- Submit button uklonjen -->

        <div class="mt-4">
            @include('web.shared.game-bottom-data')
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.level-card').forEach(function(label) {
            label.addEventListener('click', function() {
                var radio = this.querySelector('.level-radio');
                if (radio && !radio.disabled) {
                    var form = this.closest('form');
                    setTimeout(function() {
                        form.submit();
                    }, 300);
                }
            });
        });
    });
</script>
