<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Answer details</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    @if(count($answerDetails) > 0)
        <div class="fluid-container styled-table table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Sentence</th>
                    <th scope="col">Reason</th>
                    <th scope="col">Sentence bad part</th>
                    <th scope="col" class="d-none d-md-table-cell">Created</th>
                </tr>
                </thead>
                <tbody>

                @foreach($answerDetails as $detail)
                    <tr>
                        <td>{{$detail->answer->sentence->sentence}}</td>
                        <td>{{$detail->reason}}</td>
                        <td>{{$detail->sentence_bad_part}}</td>
                        <td class="d-none d-md-table-cell">{{$detail->created_at?->format('d M Y H:i')}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-warning" role="alert">
            <h4 class="alert-heading">No answers on level 2 or level 3!</h4>
            <p>There is no answer details</p>
        </div>
    @endif
    <div class="card-footer col-12 text-center">
        <div class="modal-footer">
            <button type="reset" class="btn btn-danger btn-sm" data-dismiss="modal">
                <i class="fa fa-ban"></i> Close
            </button>
        </div>
    </div>
</div>
