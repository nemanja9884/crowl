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
                        <form class="forms-sample" method="GET" action="{{ route('admin.answers.index')}}">
                            <div class="row">
                                {{--                                <div class="col-md-6">--}}
                                {{--                                    <div class="form-group">--}}
                                {{--                                        <label for="sentence">Sentence</label>--}}
                                {{--                                        <input type="search" class="form-control" name="sentence" id="sentence"--}}
                                {{--                                               placeholder="Sentence" value="{{$_GET['sentence'] ?? ''}}">--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}

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
                                        <label for="positive_answer">Positive answers</label>
                                        <select name="positive_answer" id="positive_answer" class="form-control">
                                            <option value="">Choose</option>
                                            <option value="1"
                                                    @if(isset($_GET['positive_answer']) && $_GET['positive_answer'] == 1) selected @endif>
                                                Yes
                                            </option>
                                            <option value="0"
                                                    @if(isset($_GET['positive_answer']) && $_GET['positive_answer'] == 0) selected @endif>
                                                No
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="negative_answer">Negative answers</label>
                                        <select name="negative_answer" id="negative_answer" class="form-control">
                                            <option value="">Choose</option>
                                            <option value="1"
                                                    @if(isset($_GET['negative_answer']) && $_GET['negative_answer'] == 1) selected @endif>
                                                Yes
                                            </option>
                                            <option value="0"
                                                    @if(isset($_GET['negative_answer']) && $_GET['negative_answer'] == 0) selected @endif>
                                                No
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sentence">Date From</label>
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
                                    <button type="submit" class="btn btn-primary">Search</button>
                                    <button type="submit" class="btn btn-success" name="export" value="1">Export to
                                        excel
                                    </button>
                                    <a class="btn btn-secondary"
                                       href="{{ route('admin.answers.index') }}">Reset</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Answers list</h5>
                    <div class="fluid-container styled-table table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Sentence</th>
                                <th scope="col">Language</th>
                                <th scope="col">User ID</th>
                                <th scope="col">IP Address</th>
                                <th scope="col">Positive answer</th>
                                <th scope="col">Negative answer</th>
                                <th scope="col" class="d-none d-md-table-cell">Created</th>
                                <th scope="col" style="text-align: right">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($answers as $answer)
                                <tr>
                                    <td>{{$answer->sentence->sentence}}</td>
                                    <td>{{$answer->language->name}}</td>
                                    <td>{{$answer->user_id}}</td>
                                    {{--                                    <td>{{$answer->user ? $answer->user->email : ''}}</td>--}}
                                    <td>{{$answer->ip_address}}</td>
                                    <td>
                                        @if($answer->positive_answer)
                                            <span class="badge badge-success">True</span>
                                        @else
                                            <span class="badge badge-secondary">False</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($answer->negative_answer)
                                            <span class="badge badge-success">True</span>
                                        @else
                                            <span class="badge badge-secondary">False</span>
                                        @endif
                                    </td>
                                    <td class="d-none d-md-table-cell">{{$answer->created_at?->format('d M Y H:i')}}</td>
                                    <td style="min-width: 110px;">
                                        <div class="float-right">
                                            <button class="btn btn-outline-primary btn-sm edit" data-toggle="modal"
                                                    data-target="#exampleModal1" data-id="{{$answer->id}}"><i
                                                    class="fa fa-magic"></i>&nbsp;Answer details
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $answers->appends(request()->except('page'))->links() }}
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content modal2cont">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Answer details</h5>
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
                $(".edit").click(function () {
                    let id = $(this).data("id");
                    let url = '{{ route("admin.answers.details", ":id") }}';
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
            });
        }
    </script>
@endsection
