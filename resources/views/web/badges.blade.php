@foreach($badges as $badge)
    <div class="d-flex" style="align-items: center;">
        <img src="{{$badge->image}}" style="max-width: 50px; margin-right: 10px;" /> <h5>{{trans('home.Badge') . " " . $loop->iteration)}} {{$badge->name}}</h5>
    </div>
    <p>- {{trans('home.Requirements: Reach')}} {{$badge->points}} {{trans('home.points')}}</p>
    <p>- {{trans('home.Description:')}} {{trans('home.' . $badge->description)}}</p>
@endforeach
