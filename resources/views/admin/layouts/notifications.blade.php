<div class="dropdown for-notification">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="notification"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-bell"></i>
        <span class="count bg-danger">{{$final_count}}</span>
    </button>
    <div class="dropdown-menu" aria-labelledby="notification">
        <p class="red">You have {{$final_count}} Notification</p>
        @foreach($food_res as $res)
            <a class="dropdown-item media bg-flat-color-1"
               href="{{url('selectNotification/foodDelivery/'.$res->id)}}">
                <i class="fa fa-check"></i>
                <p style="color: black;">{{$res->cart->first_name}} {{$res->cart->last_name}} -
                    Rezervacija hrane</p>
            </a>
        @endforeach

        <a class="dropdown-item media bg-flat-color-4" href="#">
            <i class="fa fa-info"></i>
            <p>Server #2 overloaded.</p>
        </a>
        <a class="dropdown-item media bg-flat-color-5" href="#">
            <i class="fa fa-warning"></i>
            <p>Server #3 overloaded.</p>
        </a>
    </div>
</div>
