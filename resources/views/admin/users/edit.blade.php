@extends('admin.layouts.app')
@section('content')
    <div id="right-panel" class="right-panel">
        @include('admin.layouts.header')
        <div class="col-lg-12 mt-3">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">Edit user - {{$user->name}}</div>
                    <div class="card-body card-block">
                        <form action="{{ route('admin.users.update', $user->id) }}" method="post" class="">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="username" class="form-control-label">Username</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                            <input type="text" id="username" name="username" placeholder="Username"
                                                   class="form-control"
                                                   value="{{$user->username}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email" class="form-control-label">Email</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                                            <input type="email" id="email" name="email" placeholder="Email"
                                                   class="form-control"
                                                   value="{{$user->email}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status" class="form-control-label">Status</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-android"></i></div>
                                            <select name="status" id="status" class="form-control">
                                                <option value="0" @if($user->status == 0) selected @endif>Inactive
                                                </option>
                                                <option value="1" @if($user->status == 1) selected @endif>Active
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

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="age" class="form-control-label">What is your age?</label>
                                        <div class="input-group">
                                            <select name="age" id="age" class="form-control">
                                                <option value="below20" @if($user->age == 'below20') selected @endif>Below 20</option>
                                                <option value="20-40" @if($user->age == '20-40') selected @endif>20-40</option>
                                                <option value="41-60" @if($user->age == '41-60') selected @endif>41-60</option>
                                                <option value="above60" @if($user->age == 'above60') selected @endif>Above 60</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="working_on_university" class="form-control-label">Have you completed, or are you working towards, a university degree with a major component in language or linguistics?</label>
                                        <div class="input-group">
                                            <select name="working_on_university" id="working_on_university" class="form-control">
                                                <option value="1" @if($user->working_on_university == 1) selected @endif>Yes</option>
                                                <option value="0" @if($user->working_on_university == 0) selected @endif>No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="language_teacher" class="form-control-label">Are you a language teacher?</label>
                                        <div class="input-group">
                                            <select name="language_teacher" id="language_teacher" class="form-control">
                                                <option value="1" @if($user->language_teacher == 1) selected @endif>Yes</option>
                                                <option value="0" @if($user->language_teacher == 0) selected @endif>No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dominant_language" class="form-control-label">Is {{$user->language}} your first/dominant language?</label>
                                        <div class="input-group">
                                            <select name="dominant_language" id="dominant_language" class="form-control">
                                                <option value="1" @if($user->dominant_language == 1) selected @endif>Yes</option>
                                                <option value="0" @if($user->dominant_language == 0) selected @endif>No</option>
                                            </select>
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
