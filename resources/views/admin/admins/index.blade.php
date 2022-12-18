@extends('admin.layouts.app')
@section('content')
    <div id="right-panel" class="right-panel">
        @include('admin.layouts.header')
        <div class="col-lg-12">
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
            <div class="content mt-3">
                <div class="animated fadeIn">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <strong class="card-title">Users</strong>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="bootstrap-data-table-export"
                                               class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>First name</th>
                                                <th>Last name</th>
                                                <th>Email</th>
                                                <th>Created at</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($users as $user)
                                                <tr>
                                                    <td>{{$user->id}}</td>
                                                    <td>{{$user->name}}</td>
                                                    <td>{{$user->lastname}}</td>
                                                    <td>{{$user->email}}</td>
                                                    <td>{{$user->created_at}}</td>
                                                    <td><a href="{{route('admin.admins.edit', $user->id)}}"
                                                           type="button" class="btn btn-outline-primary"><i
                                                                class="fa fa-magic"></i>&nbsp;
                                                            Edit
                                                        </a>
                                                        <button type="button" class="btn btn-outline-danger delete"
                                                                data-id="{{$user->id}}"
                                                                data-toggle="modal" data-target="#exampleModal"><i
                                                                class="fa fa-warning"></i>&nbsp;
                                                            Delete
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    {!! $users->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- .animated -->
            </div><!-- .content -->
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this user?</h5>
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
            $(".delete").click(function () {
                let id = $(this).data("id");
                let url = '{{ route("admin.admins.destroy", ":id") }}';
                url = url.replace(':id', id);
                $(".modal-footer").html('<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button><form class="d-inline pull-right" action="' + url + '" method="POST">\n' +
                    '                                        @csrf\n' +
                    '                                        @method("DELETE")\n' +
                    '                                        <button type="submit" class="btn btn-outline-danger">\n' +
                    '                                            Delete\n' +
                    '                                        </button>\n' +
                    '                                    </form>')
            });
        }
    </script>
@endsection
