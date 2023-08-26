<div class="float-right mt-1 d-flex" style="align-items: center;">
    <p class="points" style="margin-right: 10px;"><b>Points:</b> <b class="color-black">{{$points}}</b></p>
    <p class="badges" data-bs-toggle="modal" data-bs-target="#badgeModal"><b>Badge:</b>
        @if(!$userBadge)
            <b class="color-black">--</b>
        @else
            <img src="{{$userBadge->image}}" style="max-width: 49px;"/>
        @endif
    </p>
</div>


<!-- Badges Modal -->
<div class="modal fade" id="badgeModal" tabindex="-1" aria-labelledby="Badges" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{trans('home.Badges')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modal-body-badges">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{trans('home.Close')}}</button>
            </div>
        </div>
    </div>
</div>
@section('javascript')
    <script>
        window.onload = function() {
            $(".badges").click(function () {
                let url = '{{ route("badges") }}';
                $.ajax({
                    type: "GET",
                    url: url,
                    success: function (data) {
                        $(".modal-body-badges").html(data);
                    },
                    error: function () {
                        alert('Some error occurred, please try again.');
                    }
                });
            });
        };
    </script>
@endsection
