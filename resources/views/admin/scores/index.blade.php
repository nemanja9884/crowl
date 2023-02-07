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
            <div class="collapse @if($page == 'search') show @endif" id="searchBox">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Search</h4>
                        <form class="forms-sample" method="GET" action="{{ route('admin.scores.index')}}">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user">User</label>
                                        <select name="user" id="user" class="form-control">
                                            <option value="" selected>Choose user</option>
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}"
                                                        @if(isset($_GET['user']) && $_GET['user'] == $user->id) selected @endif>{{$user->username}}</option>
                                            @endforeach
                                        </select>
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

                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary mr-2">Search</button>
                                    <a class="btn btn-light"
                                       href="{{ route('admin.scores.index') }}">Reset</a>
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
                    <h5 class="card-title">Score list</h5>
                    <div class="fluid-container styled-table">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">User</th>
                                <th scope="col">Language</th>
                                <th scope="col">Points</th>
                                <th scope="col">Created</th>
                                <th scope="col">Updated</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($scores as $score)
                                <tr>
                                    <td>{{$score->id}}</td>
                                    <td><a href="{{route('admin.users.edit', $user->id)}}" target="_blank">{{$score->user->username}}</a></td>
                                    <td>{{$score->language->name}}</td>
                                    <td>{{$score->points}}</td>
                                    <td>{{$score->created_at}}</td>
                                    <td>{{$score->updated_at}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $scores->appends(request()->except('page'))->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
