<div class="card">
    <div class="card-header">
        <h5 class="mt-3"><b>Leaderboard - {{$language->name}}</b></h5>
    </div>
    <div class="card-body">
        @foreach($pointsCountry as $points)
            <h5><b>{{$points->username}} - {{$points->points}} points</b></h5>
        @endforeach
    </div>
</div>
