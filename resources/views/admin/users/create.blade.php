@extends('admin.layouts.app')
@section('content')
    <div id="right-panel" class="right-panel">
        @include('admin.layouts.header')
        <div class="col-lg-12 mt-3">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">Add new user</div>
                    <div class="card-body card-block">
                        <form action="{{ route('admin.users.store') }}" method="post" class="">
                            @csrf
                            @method('POST')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="form-control-label">First Name</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                            <input type="text" id="name" name="name" placeholder="First Name"
                                                   class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last_name" class="form-control-label">Last Name</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                            <input type="text" id="last_name" name="last_name" placeholder="Last Name"
                                                   class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email" class="form-control-label">Email</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                                            <input type="email" id="email" name="email" placeholder="Email"
                                                   class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status" class="form-control-label">Status</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-android"></i></div>
                                            <select name="status" id="status" class="form-control">
                                                <option value="0">Inactive
                                                </option>
                                                <option value="1">Active
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password" class="form-control-label">Password</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-asterisk"></i></div>
                                            <input type="password" id="password" name="password" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions form-group">
                                <button type="submit" class="btn btn-success btn-sm">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
