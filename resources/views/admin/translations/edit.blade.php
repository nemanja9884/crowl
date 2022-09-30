<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Translation update</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body1">
    <form action="{{ route('admin.translations.update', $translation->id) }}" method="post"
          enctype="multipart/form-data" class="form-horizontal">
        @csrf
        @method('PUT')
        <div class="col form-group">
            <label for="english_word" class="form-control-label">English word</label>
            <input type="text" id="english_word" name="english_word"
                   placeholder="English word" class="form-control" value="{{$translation->english_word}}">
        </div>

        <div class="col form-group">
            <label for="language" class="form-control-label">Language</label>
            <select name="language" id="language" class="form-control">
                @foreach($languages as $language)
                    <option value="{{$language->id}}" @if($language->id == $translation->language_id) selected @endif>
                        {{$language->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="col form-group">
            <label for="translation" class="form-control-label">Translation</label>
            <input type="text" id="translation" name="translation"
                   placeholder="Translation" class="form-control" value="{{$translation->translation}}">
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
