@extends('admin.layouts.app_login')
@section('content')
    <div class="container-fluid thirdContainer">
        <div class="sufee-login d-flex align-content-center flex-wrap">
            <div class="container">
                <div class="login-content">
                    <div class="login-logo">
                    </div>
                    <div class="login-form">
                        <img class="w-100" src="" alt="Logo">
                        <form class="mt-3" method="POST" action="{{ route('admin.login') }}">
                            @csrf
                            <div class="form-group">
                                <label>Email</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                       placeholder="Email" name="email" value="{{ old('email') }}" required
                                       autocomplete="email" autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mt-3">
                                <label>Password</label>
                                <input id="password" type="password"
                                       class="form-control @error('password') is-invalid @enderror" name="password"
                                       required
                                       autocomplete="current-password" placeholder="Password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="checkbox mt-3">
                                <label>
                                    <input type="checkbox" name="remember"
                                           id="remember" {{ old('remember') ? 'checked' : '' }}> Remember me
                                </label>
                                @if (Route::has('admin.password.request'))
                                    <label class="pull-right">
                                        <a href="{{ route('admin.password.request') }}">Forgot password?</a>
                                    </label>
                                @endif

                            </div>
                            <button type="submit" class="btn btn-success btn-flat m-b-30 mt-3">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
