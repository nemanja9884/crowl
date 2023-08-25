<div class="card card-statistic">
    <div class="card-header">
        <h5 class="mt-3"><b>Leaderboard International Competition</b></h5>
    </div>
    <div class="card-body card-body-statistic">
        @foreach($sumCountriesPoints as $key => $item)
            <h5><b>@if(isset($medals[$key])) {{$medals[$key]}} - @endif {{$item->language_name}}</b></h5>
        @endforeach
    </div>
</div>
