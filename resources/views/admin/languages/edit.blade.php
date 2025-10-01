@extends('admin.layouts.app')
@section('content')
    <div id="right-panel" class="right-panel">
        @include('admin.layouts.header')
        @foreach ($errors->all() as $error)
            <div class="col-md-12 alert alert-danger" role="alert">
                {!! $error !!}
            </div>
        @endforeach
        @if(Session::has('message'))
            <div class="col-md-12 alert alert-{{ Session::get('alert-class') }}" role="alert">
                {{ Session::get('message') }}
            </div>
        @endif
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong>Edit language</strong>
                </div>
                <div class="col-md-12 card-body card-block">
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
                            <label for="lang_code" class="form-control-label">Language code</label>
                            <input type="text" id="lang_code" name="lang_code"
                                   placeholder="Language code" class="form-control" value="{{$language->lang_code}}">
                        </div>

                        <div class="col form-group">
                            <label for="intro" class="form-control-label">Intro text</label>
                            <textarea name="intro" id="intro" rows="3"
                                      placeholder="Intro..."
                                      class="form-control">{{$language->intro}}</textarea>
                        </div>

                        <div class="col form-group">
                            <label for="textarea-input" class="form-control-label">Content</label>
                            <textarea name="content" id="textarea-input" rows="3"
                                      placeholder="content..."
                                      class="form-control">{{$language->content}}</textarea>
                        </div>

                        <div class="col form-group">
                            <label class="textarea-input-1">Additional info page content</label>
                            <textarea name="additional_info_content" rows="6" id="textarea-input-1"
                                      placeholder="Additional info page content"
                                      class="form-control">{{$language->additional_info_content}}</textarea>
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
                                        <a id="lfm2" data-input="thumbnail2" data-preview="holder2"
                                           class="btn btn-primary text-white col-md-12" style="margin: 0 auto;">
                                            <i class="fa fa-picture-o"></i> Choose photo
                                        </a>
                                    </span>
                                    <input id="thumbnail2" name="image" class="form-control" type="text"
                                           style="display: none;">
                                </div>
                                <div id="holder4" style="margin-top:15px;max-height:100px;"></div>
                            </div>
                        </div>
                        @if($language->image)
                            <div class="col-md-12 text-center" style="margin: 0 auto;">
                                <img src="{{$language->image}}" class="img-thumbnail" alt="..."
                                     style="width: 200px; margin: 0 auto;">
                            </div>
                        @endif
                        <div class="card-footer col-12 text-center">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fa fa-dot-circle-o"></i> Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
