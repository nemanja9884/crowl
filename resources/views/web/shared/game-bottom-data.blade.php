<div class="float-right mt-1 d-flex" style="align-items: center;">
    <p class="points" style="margin-right: 10px;"><b>{{trans('home.Points:')}}</b> <b class="color-black">{{$points}}</b></p>
    <p class="badges" data-bs-toggle="modal" data-bs-target="#badgeModal"><b>{{trans('home.Badge')}}:</b>
        @if(!$userBadge)
            <b class="color-black">--</b>
        @else
            <img src="{{$userBadge->image}}" style="max-width: 49px;"/>
        @endif
    </p>
</div>
