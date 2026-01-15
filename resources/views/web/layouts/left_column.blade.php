<!-- layouts/left_column.blade.php -->
<div class="glass-card p-4" id="leftColumn">
    <div class="text-center mb-4">
        <h4 class="fw-bold">🏆 {{trans('home.Leaderboard')}}</h4>
        <p class="text-muted mb-0">{{$language->name}}</p>
    </div>

    <div class="leaderboard-list" id="leftLeaderboardList">
        @foreach($pointsCountry as $index => $item)
            <div class="leaderboard-item @if($index === 0) gold @elseif($index === 1) silver @elseif($index === 2) bronze @endif">
                <div class="d-flex align-items-center">
                    <span class="fw-bold me-3 fs-4">
                        @if($index === 0) 🥇
                        @elseif($index === 1) 🥈
                        @elseif($index === 2) 🥉
                        @else {{$index + 1}}.
                        @endif
                    </span>
                    <span class="fw-bold">{{$item->username}}</span>
                </div>
                <span class="badge bg-primary rounded-pill">{{$item->points}} pts</span>
            </div>
        @endforeach
    </div>
</div>
