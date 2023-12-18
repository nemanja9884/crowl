@extends('admin.layouts.app')
@section('content')
    <div id="right-panel" class="right-panel">
        @include('admin.layouts.header')
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
            <a class="nav-link btn btn-outline-danger mb-3" data-toggle="collapse"
               href="#deleteBox"
               role="button" aria-expanded="false" aria-controls="deleteBox">
                <i class="mdi mdi-magnify"></i> Delete
            </a>
            <div class="collapse @if($page == 'search') show @endif" id="searchBox">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Search</h4>
                        <form class="forms-sample" method="GET" action="{{ route('admin.sentences.index')}}">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sentence">Sentence</label>
                                        <input type="search" class="form-control" name="sentence" id="sentence"
                                               placeholder="Sentence" value="{{$_GET['sentence'] ?? ''}}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="language">Language</label>
                                        <select name="language" id="language" class="form-control">
                                            <option value="" selected>Choose language</option>
                                            @foreach($languages as $language)
                                                <option value="{{$language->id}}"
                                                        @if(isset($_GET['language']) && $_GET['language'] == $language->id) selected @endif>{{$language->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="finished">Finished</label>
                                        <select name="finished" id="finished" class="form-control">
                                            <option value="">Choose</option>
                                            <option value="1"
                                                    @if(isset($_GET['finished']) && $_GET['finished'] == 1) selected @endif>
                                                Yes
                                            </option>
                                            <option value="0"
                                                    @if(isset($_GET['finished']) && $_GET['finished'] == 0) selected @endif>
                                                No
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="date_from">Date From</label>
                                        <input type="date" class="form-control" name="date_from" id="date_from"
                                               placeholder="Date From" value="{{$_GET['date_from'] ?? ''}}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="date_to">Date To</label>
                                        <input type="date" class="form-control" name="date_to" id="date_to"
                                               placeholder="Date To" value="{{$_GET['date_to'] ?? ''}}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary mr-2">Search</button>
                                    <a class="btn btn-light"
                                       href="{{ route('admin.sentences.index') }}">Reset</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="collapse" id="deleteBox">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Delete</h4>
                        <form id="deleteSentences" class="forms-sample" method="post" action="{{ route('admin.delete.sentences')}}">
                            @csrf
                            @method('DELETE')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="language">Language</label>
                                        <select name="language" id="language" class="form-control">
                                            <option value="" selected>Choose language</option>
                                            @foreach($languages as $language)
                                                <option value="{{$language->id}}"
                                                        @if(isset($_GET['language']) && $_GET['language'] == $language->id) selected @endif>{{$language->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="date_from">Date From</label>
                                        <input type="date" class="form-control" name="date_from" id="date_from"
                                               placeholder="Date From" value="{{$_GET['date_from'] ?? ''}}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="date_to">Date To</label>
                                        <input type="date" class="form-control" name="date_to" id="date_to"
                                               placeholder="Date To" value="{{$_GET['date_to'] ?? ''}}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-danger mr-2">Delete</button>
                                    <a class="btn btn-light"
                                       href="{{ route('admin.sentences.index') }}">Reset</a>
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
                    <strong>Add sentence</strong>
                </div>
                <div class="col-md-12 card-body card-block">
                    <div class="alert alert-info">
                        <form action="{{ route('admin.sentences.import') }}" method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="file">Upload CSV</label>
                                <input type="file" name="file" id="file" />
                            </div>
                            <div class="form-group">
                                <label for="language_id" class="form-control-label">Language</label>
                                <select name="language_id" id="language_id" class="form-control" required>
                                    <option value="" selected>Choose language</option>
                                    @foreach($languages as $language)
                                        <option value="{{$language->id}}">{{$language->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-success">Import</button>
                            </div>
                        </form>
                    </div>

                    <form action="{{ route('admin.sentences.store') }}" method="post" enctype="multipart/form-data"
                          class="form-horizontal">
                        @csrf
                        <div class="col form-group">
                            <label for="sentence" class="form-control-label">Sentence</label>
                            <textarea name="sentence" id="sentence" rows="3" class="form-control" placeholder="Sentence"
                                      required></textarea>
                        </div>

                        <div class="col form-group">
                            <label for="language_id" class="form-control-label">Language</label>
                            <select name="language_id" id="language_id" class="form-control" required>
                                <option value="0" selected>Choose language</option>
                                @foreach($languages as $language)
                                    <option value="{{$language->id}}">{{$language->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col form-group">
                            <label for="word_reliability" class="form-control-label">Gdex score</label>
                            <input type="number" id="word_reliability" name="word_reliability"
                                   placeholder="Gdex score" class="form-control" step="any" required>
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
                    <h5 class="card-title">Sentences list</h5>
                    <p><b>Total senteneces: {{$sentences->total()}}</b></p>
                    <div class="fluid-container styled-table">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Sentence</th>
                                <th scope="col">Language</th>
                                <th scope="col">Gdex score</th>
                                <th scope="col">Finished</th>
                                <th scope="col">Status</th>
                                <th scope="col" class="d-none d-md-table-cell">Created</th>
                                <th scope="col" style="text-align: right">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sentences as $sentence)
                                <tr>
                                    <td>{{$sentence->sentence}}</td>
                                    <td>{{$sentence->language->name}}</td>
                                    <td>{{$sentence->word_reliability}}</td>
                                    <td>
                                        @if($sentence->finished)
                                            <span class="badge badge-success">True</span>
                                        @else
                                            <span class="badge badge-secondary">False</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($sentence->returned)
                                            <span class="badge badge-danger">Returned</span>
                                        @elseif($sentence->finished)
                                            <span class="badge badge-primary">Done</span>
                                        @elseif(count($sentence->answers) == 0)
                                            <span class="badge badge-success">New</span>
                                        @elseif(count($sentence->answers) > 0)
                                            <span class="badge badge-secondary">In game</span>
                                        @endif
                                    </td>
                                    <td class="d-none d-md-table-cell">{{$sentence->created_at?->format('d M Y H:i')}}</td>
                                    <td style="min-width: 110px;">
                                        <div class="float-right">
                                            @if($sentence->finished)
                                                <a href="{{route('admin.sentence.return', $sentence->id)}}" class="btn btn-outline-danger btn-sm">Return sentence</a>
                                            @endif
                                            <button class="btn btn-outline-primary btn-sm edit" data-toggle="modal"
                                                    data-target="#exampleModal1" data-id="{{$sentence->id}}"><i
                                                    class="fa fa-magic"></i>&nbsp;Edit
                                            </button>
                                            <button type="button" class="btn btn-outline-danger btn-sm delete"
                                                    data-id="{{$sentence->id}}" data-toggle="modal"
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
                    {{ $sentences->appends(request()->except('page'))->links() }}
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this sentence?</h5>
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
                    <h5 class="modal-title" id="exampleModalLabel">Sentence update</h5>
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
                    let url = '{{ route("admin.sentences.destroy", ":id") }}';
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
                    let url = '{{ route("admin.sentences.edit", ":id") }}';
                    url = url.replace(':id', id);
                    $.ajax({
                        type: "GET",
                        url: url,
                        success: function (data) {
                            $(".modal2cont").html(data);
                        },
                        error: function () {
                            alert('Some error occurred, please try again.');
                        }
                    });
                });

                $('#deleteSentences').submit(function (e) {
                    e.preventDefault();
                    if (confirm("Are you sure you want to delete the sentences? And the answers to those sentences will also be deleted, be sure to export the necessary data!")) {
                        $(this).unbind('submit').submit();
                    }
                });
            });
        }
    </script>
@endsection
