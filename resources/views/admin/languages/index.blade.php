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
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <strong>Add language</strong>
                </div>
                <div class="col-md-12 card-body card-block">
                    <form action="{{ route('admin.languages.store') }}" method="post"
                          enctype="multipart/form-data"
                          class="form-horizontal">
                        @csrf
                        <div class="col form-group">
                            <label for="name" class="form-control-label">Language name</label>
                            <input type="text" id="name" name="name"
                                   placeholder="Language name" class="form-control" required>
                        </div>

                        <div class="col form-group">
                            <label for="lang_code" class="form-control-label">Language code</label>
                            <input type="text" id="lang_code" name="lang_code"
                                   placeholder="Language code" class="form-control" required>
                        </div>

                        <div class="col form-group">
                            <label for="intro" class="form-control-label">Intro text</label>
                            <textarea name="intro" id="intro" rows="3"
                                      placeholder="Intro..."
                                      class="form-control"></textarea>
                        </div>

                        <div class="col form-group">
                            <label for="textarea-input" class="form-control-label">Content</label>
                            <textarea name="content" id="textarea-input" rows="3"
                                      placeholder="content..."
                                      class="form-control"></textarea>
                        </div>

                        <div class="col form-group">
                            <label class="textarea-input-1">Additional info page content</label>
                            <textarea name="additional_info_content" rows="6" id="textarea-input-1"
                                      placeholder="Additional info page content"
                                      class="form-control"></textarea>
                        </div>

                        <div class="col form-group">
                            <label for="status" class="form-control-label">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1" selected>Published</option>
                                <option value="0">Draft</option>
                            </select>
                        </div>

                        <div class="col form-group">
                            <label for="sort" class="form-control-label">Sort</label>
                            <input type="number" id="sort" name="sort"
                                   placeholder="Sort" class="form-control" required>
                        </div>

                        <div class="col-md-12 text-center form-group" style="margin: 0 auto;">
                            <div class="col col-md-12"><label for="file-input" class=" form-control-label">Add
                                    image for
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
                                <div id="holder2" style="margin-top:15px;max-height:100px;"></div>
                            </div>
                        </div>
                        <div class="card-footer col-12 text-center">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fa fa-dot-circle-o"></i> Save
                            </button>
                            <button type="reset" class="btn btn-danger btn-sm">
                                <i class="fa fa-ban"></i> Reset
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Languages list</h5>
                    <div class="fluid-container styled-table">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col" class="d-none d-md-table-cell">
                                    <input class="styled-checkbox" id="selectAll" type="checkbox">
                                    <label for="selectAll"></label>
                                </th>
                                <th scope="col">Name</th>
                                <th scope="col">Image</th>
                                <th scope="col">Status</th>
                                <th scope="col" class="d-none d-md-table-cell">Created</th>
                                <th scope="col" style="text-align: right">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($languages as $language)
                                <tr>
                                    <td class="d-none d-md-table-cell">
                                        <input class="styled-checkbox" id="category-{{$language->id}}"
                                               type="checkbox">
                                        <label for="category-{{$language->id}}"></label>
                                    </td>
                                    <td>{{$language->name}}</td>
                                    <td><img class="img-fluid" src="{{$language->image}}"
                                             style="max-width: 50px;"/>
                                    </td>
                                    <td>
                                        @if($language->status == 0)
                                            <span class="badge badge-secondary">Draft</span>
                                        @elseif($language->status == 1)
                                            <span class="badge badge-success">Published</span>
                                        @endif
                                    </td>
                                    <td class="d-none d-md-table-cell">{{$language->created_at->format('d M Y H:i')}}</td>
                                    <td style="min-width: 110px;">
                                        <div class="float-right">
                                            <button class="btn btn-outline-primary btn-sm edit"
                                                    data-toggle="modal"
                                                    data-target="#exampleModal1" data-id="{{$language->id}}"><i
                                                    class="fa fa-magic"></i>&nbsp;Edit
                                            </button>
                                            <button type="button" class="btn btn-outline-danger btn-sm delete"
                                                    data-id="{{$language->id}}" data-toggle="modal"
                                                    data-target="#exampleModal"><i class="fa fa-warning"></i>&nbsp;
                                                Delete
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $languages->appends(request()->except('page'))->links() }}
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this language?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal2cont">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Language update</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script>
        window.onload = function () {
            $(document).ready(function () {
                $(".delete").click(function () {
                    let id = $(this).data("id");
                    let url = '{{ route("admin.languages.destroy", ":id") }}';
                    url = url.replace(':id', id);
                    $(".modal-footer").html('<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button><form class="d-inline pull-right" action="' + url + '" method="POST">\n' +
                        '                                        @csrf\n' +
                        '                                        @method("DELETE")\n' +
                        '                                        <button type="submit" class="btn btn-outline-danger">\n' +
                        '                                            Delete\n' +
                        '                                        </button>\n' +
                        '                                    </form>')
                });

                $(".edit").click(function () {
                    let id = $(this).data("id");
                    let url = '{{ route("admin.languages.edit", ":id") }}';
                    url = url.replace(':id', id);
                    $.ajax({
                        type: "GET",
                        url: url,
                        success: function (data) {
                            $(".modal2cont").html(data);
                            lfm('lfm4', 'file', {prefix: route_prefix});
                            tinymce.remove('#textarea-input');
                            // tinymce.init(editor_config);
                            tinymce.remove('#textarea-input-1');
                            tinymce.init(editor_config);
                        },
                        error: function () {
                            alert('Some error occurred, please try again.');
                        }
                    });
                });
            });
        }
    </script>
@endsection
