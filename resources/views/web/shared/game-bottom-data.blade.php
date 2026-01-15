<!-- shared/game-bottom-data.blade.php -->
<div class="badge-container">
    <div class="points-display">
        {{$points}} {{trans('home.Points:')}}
    </div>

    @if($userBadge)
        <div class="mb-3">
            <img src="{{ $userBadge->image }}"
                 alt="User Badge"
                 class="badge-image">
        </div>
    @endif

    <h5 class="fw-bold">
        @if(!$userBadge)
            {{trans('home.No Badge')}}
        @else
            {{$userBadge->name}}
        @endif
    </h5>
</div>
