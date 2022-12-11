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
                   placeholder="English word" class="form-control" value="{{$translation->key}}">
        </div>

        @foreach($languages as $language)
            <div class="col form-group">
                <label for="language{{$language->id}}" class="form-control-label">{{$language->name}}
                    translation</label>
                <input type="text" id="language{{$language->id}}" name="language{{$language->id}}"
                       placeholder="{{$language->name}} translation" class="form-control" value="{{$translation->text[$language->lang_code] ?? ''}}">
            </div>
        @endforeach

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
