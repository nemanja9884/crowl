@extends('admin.layouts.app')
@section('content')
    <div id="right-panel" class="right-panel">
        @include('admin.layouts.header')
        {{--        <nav class="navbar navbar-light bg-light" style="margin: 0 0 10px !important;">--}}
        {{--            <form class="container-fluid justify-content-start">--}}
        {{--                <a href="{{ route('categories.index') }}" class="btn @if($page != 'all') btn-outline-primary @else btn-primary @endif me-2 mr-3" type="button">Sve vrste kategorija</a>--}}
        {{--                <a href="{{ route('categories.index') }}?display=Članci" class="btn @if($page != 'Članci') btn-outline-primary @else btn-primary @endif me-2 mr-3" type="button">Članci</a>--}}
        {{--                <a href="{{ route('categories.index') }}?display=Proizvodi" class="btn @if($page != 'Proizvodi') btn-outline-primary @else btn-primary @endif -primary me-2 mr-3" type="button">Proizvodi</a>--}}
        {{--            </form>--}}
        {{--        </nav>--}}
        @foreach ($errors->all() as $error)
            <div class="col-md-12 alert alert-danger" role="alert">
                {!! $errors->first() !!}
            </div>
        @endforeach
        @if(Session::has('message'))
            <div class="col-md-12 alert alert-{{ Session::get('alert-class') }}" role="alert">
                {{ Session::get('message') }}
            </div>
        @endif

        <div class="col-md-12">
            <a class="nav-link @if($page == 'search') active @endif btn btn-outline-primary mb-3" data-toggle="collapse"
               href="#searchBox"
               role="button" aria-expanded="false" aria-controls="searchBox">
                <i class="mdi mdi-magnify"></i> Search
            </a>
            <div class="collapse @if($page == 'search') show @endif" id="searchBox">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Search</h4>
                        <form class="forms-sample" method="GET" action="{{ route('admin.translations.index')}}">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="key">Key</label>
                                        <input type="search" class="form-control" name="key" id="key"
                                               placeholder="Key" value="{{$_GET['key'] ?? ''}}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary mr-2">Search</button>
                                    <a class="btn btn-light"
                                       href="{{ route('admin.translations.index') }}">Reset</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <strong>Add translation</strong>
                </div>
                <div class="col-md-12 card-body card-block">
                    <div class="alert alert-info">
                        <form action="{{ route('admin.translations.import') }}" method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="file">Upload CSV</label>
                                <input type="file" name="file" id="file"/>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-success">Import</button>
                            </div>
                        </form>
                    </div>

                    <form action="{{ route('admin.translations.store') }}" method="post" enctype="multipart/form-data"
                          class="form-horizontal">
                        @csrf
                        <div class="col form-group">
                            <label for="english_word" class="form-control-label">English word</label>
                            <input type="text" id="english_word" name="english_word"
                                   placeholder="English word" class="form-control">
                        </div>

                        @foreach($languages as $language)
                            <div class="col form-group">
                                <label for="language{{$language->id}}" class="form-control-label">{{$language->name}}
                                    translation</label>
                                <input type="text" id="language{{$language->id}}" name="language{{$language->id}}"
                                       placeholder="{{$language->name}} translation" class="form-control">
                            </div>
                        @endforeach

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
                    <h5 class="card-title">Translations list</h5>
                    <div class="fluid-container styled-table">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col" class="d-none d-md-table-cell">
                                    <input class="styled-checkbox" id="selectAll" type="checkbox">
                                    <label for="selectAll"></label>
                                </th>
                                <th scope="col">Key</th>
                                @foreach($languages as $language)
                                    <th scope="col">{{$language->name}}</th>
                                @endforeach
                                <th scope="col" class="d-none d-md-table-cell">Created</th>
                                <th scope="col" style="text-align: right">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($translations as $translation)
                                <tr>
                                    <td class="d-none d-md-table-cell">
                                        <input class="styled-checkbox" id="category-{{$translation->id}}"
                                               type="checkbox">
                                        <label for="category-{{$translation->id}}"></label>
                                    </td>
                                    <td>{{$translation->key}}</td>
                                    @foreach($languages as $language)
                                        <td>
                                            @foreach($translation->text as $key => $value)
                                                @if($key == $language->lang_code)
                                                    {{$value}}
                                                @endif
                                            @endforeach
                                        </td>
                                    @endforeach
                                    <td class="d-none d-md-table-cell">{{\Carbon\Carbon::parse($translation->created_at)->format('d M Y H:i')}}</td>
                                    <td style="min-width: 110px;">
                                        <div class="float-right">
                                            <button class="btn btn-outline-primary btn-sm edit" data-toggle="modal"
                                                    data-target="#exampleModal1" data-id="{{$translation->id}}"><i
                                                    class="fa fa-magic"></i>&nbsp;Edit
                                            </button>
                                            <button type="button" class="btn btn-outline-danger btn-sm delete"
                                                    data-id="{{$translation->id}}" data-toggle="modal"
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
                    {{ $translations->appends(request()->except('page'))->links() }}
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this
                        translation?</h5>
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
                    <h5 class="modal-title" id="exampleModalLabel">Translation update</h5>
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
                    let url = '{{ route("admin.translations.destroy", ":id") }}';
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
                    let url = '{{ route("admin.translations.edit", ":id") }}';
                    url = url.replace(':id', id);
                    $.ajax({
                        type: "GET",
                        url: url,
                        success: function (data) {
                            $(".modal2cont").html(data);
                            lfm('lfm4', 'file', {prefix: route_prefix});
                            tinymce.remove('#textarea-input');
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
