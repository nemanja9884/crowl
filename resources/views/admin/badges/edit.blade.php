<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Badge update</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body1">
    <form action="{{ route('admin.badges.update', $badge->id) }}" method="post"
          enctype="multipart/form-data" class="form-horizontal">
        @csrf
        @method('PUT')
        <div class="col form-group">
            <label for="name" class="form-control-label">Name</label>
            <input type="text" id="name" name="name"
                   placeholder="Name" class="form-control" value="{{$badge->name}}" required>
        </div>

        <div class="col form-group">
            <label for="textarea-input" class="form-control-label">Description</label>
            <textarea name="description" id="textarea-input" rows="3"
                      placeholder="Description..."
                      class="form-control">{!! $badge->description !!}</textarea>
        </div>

        <div class="col form-group">
            <label for="points" class="form-control-label">Points</label>
            <input type="number" id="points" name="points"
                   placeholder="Points" class="form-control" value="{{$badge->points}}" required>
        </div>

        <div class="col-md-12 text-center form-group" style="margin: 0 auto;">
            <div class="col col-md-12"><label for="file-input" class=" form-control-label">Add new badge</label></div>
            <div class="col-12 col-md-12">
                <div class="input-group" style="margin: 0 auto;">
                                    <span class="input-group-btn" style="margin: 0 auto;">
                                        <a id="lfm4" data-input="thumbnail4" data-preview="holder4"
                                           class="btn btn-primary text-white col-md-12" style="margin: 0 auto;">
                                            <i class="fa fa-picture-o"></i> Choose photo
                                        </a>
                                    </span>
                    <input id="thumbnail4" name="image" class="form-control" type="text"
                           style="display: none;">
                </div>
                <div id="holder4" style="margin-top:15px;max-height:100px;"></div>
            </div>
        </div>
        @if($badge->image)
            <div class="col-md-12 text-center" style="margin: 0 auto;">
                <img src="{{$badge->image}}" class="img-thumbnail" alt="..."
                     style="width: 200px; margin: 0 auto;">
            </div>
        @endif
        <div class="card-footer col-12 text-center">
            <div class="modal-footer1">
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fa fa-dot-circle-o"></i> Save
                </button>
                <button type="reset" class="btn btn-danger btn-sm" data-dismiss="modal">
                    <i class="fa fa-ban"></i> Close
                </button>
            </div>
        </div>
    </form>
</div>
