<!-- layouts/right_column.blade.php -->
<div class="glass-card p-4" id="rightColumn">
    <div class="text-center mb-4">
        <h4 class="fw-bold">🌍 {{trans('home.International Competition')}}</h4>
    </div>

    <div class="leaderboard-list" id="rightLeaderboardList">
        @foreach($sumCountriesPoints as $key => $item)
            <div class="leaderboard-item @if($key === 0) gold @elseif($key === 1) silver @elseif($key === 2) bronze @endif">
                <div class="d-flex align-items-center">
                    <span class="fw-bold me-3 fs-4">
                        @if(isset($medals[$key]))
                            @if($medals[$key] === 'Gold') 🥇
                            @elseif($medals[$key] === 'Silver') 🥈
                            @elseif($medals[$key] === 'Bronze') 🥉
                            @endif
                        @endif
                    </span>
                    <span class="fw-bold">{{trans("home.$item->language_name")}}</span>
                </div>
            </div>
        @endforeach
    </div>
</div>
