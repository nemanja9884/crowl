<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Izmena kategorije</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body1">
    <form action="{{ route('categories.update', $category->id) }}" method="post"
          enctype="multipart/form-data" class="form-horizontal">
        @csrf
        @method('PUT')
        <div class="col form-group">
            <label for="text-input" class="form-control-label">Ime kategorije</label>
            <input type="text" id="name" name="name"
                   placeholder="Ime kategorije" class="form-control" value="{{$category->name}}">
        </div>
        <div class="col form-group">
            <label for="parent_id" class=" form-control-label">Nadkategorija</label>
            <select name="parent_id" id="parent_id" class="form-control">
                @if($category->parent_id == null)
                    <option value="0" selected>Izaberite nadkategoriju</option>
                @else
                    <option value="0" selected>Izaberite nadkategoriju</option>
                @endif
                @foreach($parentCat as $cat)
                    <option value="{{$cat->id}}" @if($category->parent_id == $cat->id) selected @endif>{{$cat->name}} @if(isset($cat->parent)) <b>({{$cat->parent->name}})</b> @endif</option>
                @endforeach
            </select>
        </div>
        <div class="col form-group">
            <label for="type" class=" form-control-label">Tip kategorije</label>
            <select name="type" id="type" class="form-control">
                <option value="{{$category->type}}" selected>{{$category->type}}</option>
                <option value="Članci">Članci</option>
                <option value="Proizvodi">Proizvodi</option>
            </select>
        </div>
        <div class="col form-group">
            <label for="status" class=" form-control-label">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="1" @if($category->status == 1) selected @endif>Objavljeno</option>
                <option value="2" @if($category->status == 2) selected @endif>U pripremi</option>
            </select>
        </div>
        <div class="col form-group">
            <label for="sort" class="form-control-label">Sortiranje</label>
            <input type="number" id="sort" name="sort"
                   placeholder="Sortiranje" class="form-control" value="{{$category->sort}}">
        </div>
        <div class="col-md-12 text-center form-group" style="margin: 0 auto;">
            <div class="col col-md-12"><label for="file-input" class=" form-control-label">Dodajte izdvojenu
                    sliku</label></div>
            <div class="col-12 col-md-12">
                <div class="input-group" style="margin: 0 auto;">
                                    <span class="input-group-btn" style="margin: 0 auto;">
                                        <a id="lfm3" data-input="thumbnail3" data-preview="holder3"
                                           class="btn btn-primary text-white col-md-12" style="margin: 0 auto;">
                                            <i class="fa fa-picture-o"></i> Izaberite sliku
                                        </a>
                                    </span>
                    <input id="thumbnail3" name="image" class="form-control" type="text"
                           style="display: none;">
                </div>
                <div id="holder3" style="margin-top:15px;max-height:100px;"></div>
            </div>
        </div>
        @if($category->featured_image != null)
            <div class="col-md-12 text-center" style="margin: 0 auto;">
                <img src="{{$category->featured_image}}" class="img-thumbnail" alt="..."
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
