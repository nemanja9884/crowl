<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Language update</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body1">
    <form action="{{ route('admin.languages.update', $language->id) }}" method="post"
          enctype="multipart/form-data" class="form-horizontal">
        @csrf
        @method('PUT')
        <div class="col form-group">
            <label for="name" class="form-control-label">Language name</label>
            <input type="text" id="name" name="name"
                   placeholder="Language name" class="form-control" value="{{$language->name}}">
        </div>

        <div class="col form-group">
            <label for="textarea-input" class="form-control-label">Content</label>
            <textarea name="content" id="textarea-input" rows="3"
                      placeholder="content..."
                      class="form-control">{{$language->content}}</textarea>
            {{--                            <div class="col col-md-3"></div>--}}
            {{--                            <div class="col-12 col-md-9"></div>--}}
        </div>

        <div class="col form-group">
            <label for="status" class="form-control-label">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="1" @if($language->status == 1) selected @endif>Published</option>
                <option value="0" @if($language->status == 0) selected @endif>Draft</option>
            </select>
        </div>

        <div class="col form-group">
            <label for="sort" class="form-control-label">Sort</label>
            <input type="number" id="sort" name="sort"
                   placeholder="Sort" class="form-control" value="{{$language->sort}}">
        </div>

        <div class="col-md-12 text-center form-group" style="margin: 0 auto;">
            <div class="col col-md-12"><label for="file-input" class=" form-control-label">Add image for
                    language</label></div>
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
        @if($language->image)
            <div class="col-md-12 text-center" style="margin: 0 auto;">
                <img src="{{$language->image}}" class="img-thumbnail" alt="..."
                     style="width: 200px; height: 200px; object-fit: cover; margin: 0 auto;">
            </div>
        @endif
        <div class="card-footer col-12 text-center">
            <div class="modal-footer1">
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fa fa-dot-circle-o"></i> Sačuvaj
                </button>
                <button type="reset" class="btn btn-danger btn-sm" data-dismiss="modal">
                    <i class="fa fa-ban"></i> Izađi
                </button>
            </div>
        </div>
    </form>
</div>
