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
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Answers list</h5>
                    <div class="fluid-container styled-table table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Sentence</th>
                                <th scope="col">Language</th>
                                <th scope="col">User</th>
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
                                    <td>{{$answer->user ? $answer->user->name : ''}}</td>
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