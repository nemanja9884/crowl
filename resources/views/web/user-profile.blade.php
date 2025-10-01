@extends('web.layouts.app')

@section('content')
    <main class="px-3">
        <div class="card color-black">
            <div class="card-header">
                <h5 class="card-title">{{trans('home.Your profile')}}: {{$user->username}}</h5>
            </div>
            <div class="card-body text-left">
                <form action="{{route('updateProfile')}}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="username" class="form-control-label">{{trans('home.Username')}}</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                    <input type="text" id="username" name="username" placeholder="Username"
                                           class="form-control"
                                           value="{{$user->username}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-3">
                            <div class="form-group">
                                <label for="email" class="form-control-label">{{trans('home.Email')}}</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                                    <input type="email" id="email" placeholder="{{trans('home.Email')}}"
                                           class="form-control"
                                           value="{{$user->email}}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-3">
                            <div class="form-group">
                                <label for="password" class="form-control-label">{{trans('home.Set new password')}}</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-asterisk"></i></div>
                                    <input type="password" id="password" name="password" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="form-group">
                                <label for="age" class="form-control-label">{{trans('home.What is your age?')}}</label>
                                <div class="input-group">
                                    <select name="age" id="age" class="form-control">
                                        <option value="18-24" @if($user->age == '18-24') selected @endif>18-24</option>
                                        <option value="25-34" @if($user->age == '25-34') selected @endif>25-34</option>
                                        <option value="35-44" @if($user->age == '35-44') selected @endif>35-44</option>
                                        <option value="45-54" @if($user->age == '45-54') selected @endif>45-54</option>
                                        <option value="55-64" @if($user->age == '55-64') selected @endif>55-64</option>
                                        <option value="above65" @if($user->age == 'above65') selected @endif>{{trans('home.65 and above')}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="form-group">
                                <label for="working_on_university" class="form-control-label">{{trans('home.Have you completed, or are you working towards, a university degree with a major component in language or linguistics?')}}</label>
                                <div class="input-group">
                                    <select name="working_on_university" id="working_on_university"
                                            class="form-control">
                                        <option value="1" @if($user->working_on_university == 1) selected @endif>{{trans('home.Yes')}}
                                        </option>
                                        <option value="0" @if($user->working_on_university == 0) selected @endif>{{trans('home.No')}}
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="form-group">
                                <label for="language_teacher" class="form-control-label">{{trans('home.Are you a language teacher?')}}</label>
                                <div class="input-group">
                                    <select name="language_teacher" id="language_teacher" class="form-control">
                                        <option value="1" @if($user->language_teacher == 1) selected @endif>{{trans('home.Yes')}}</option>
                                        <option value="0" @if($user->language_teacher == 0) selected @endif>{{trans('home.No')}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="form-group">
                                <label for="dominant_language" class="form-control-label">{{trans("home.Is $user->language your first/dominant language?")}}</label>
                                <div class="input-group">
                                    <select name="dominant_language" id="dominant_language" class="form-control">
                                        <option value="1" @if($user->dominant_language == 1) selected @endif>{{trans('home.Yes')}}
                                        </option>
                                        <option value="0" @if($user->dominant_language == 0) selected @endif>{{trans('home.No')}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success mt-3 float-left">{{trans('home.Save')}}</button>
                </form>
            </div>
        </div>
    </main>
@endsection
