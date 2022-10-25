<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Sentence update</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body1">
    <form action="{{ route('admin.sentences.update', $sentence->id) }}" method="post"
          enctype="multipart/form-data" class="form-horizontal">
        @csrf
        @method('PUT')
        <div class="col form-group">
            <label for="sentence" class="form-control-label">Sentence</label>
            <textarea name="sentence" id="sentence" rows="3" class="form-control"
                      required>{{$sentence->sentence}}</textarea>
        </div>

        <div class="col form-group">
            <label for="language_id" class="form-control-label">Language</label>
            <select name="language_id" id="language_id" class="form-control" required>
                @foreach($languages as $language)
                    <option value="{{$language->id}}"
                            @if($sentence->language_id == $language->id) selected @endif>{{$language->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="col form-group">
            <label for="word_reliability" class="form-control-label">Gdex score</label>
            <input type="number" id="word_reliability" name="word_reliability"
                   placeholder="Gdex score" class="form-control" step="any" value="{{$sentence->word_reliability}}" required>
        </div>

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
