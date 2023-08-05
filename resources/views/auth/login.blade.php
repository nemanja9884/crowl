@extends('web.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ trans('home.Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ trans('home.Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{trans('home.' . $message)}}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ trans('home.Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{trans('home.' . $message)}}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ trans('home.Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ trans('home.Login') }}
                                </button>
                            </div>
                        </div>

                        @if (Route::has('password.request'))
                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-3">
                                    <div class="form-check">
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ trans('home.Forgot Your Password?') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="text-center">
                            <p>{{trans('home.Don\'t have an account? Register')}} <a
                                    href="{{route('register')}}">{{trans('home.here')}}</a></p>
                        </div>

                        <div class="social-login-content text-center mt-3">
                            <div class="social-button">
                                <a href="{{url('redirect/google')}}"
                                   class="btn btn-lg btn-google btn-block text-uppercase btn-light mb-3"><img
                                        src="https://img.icons8.com/color/16/000000/google-logo.png" style="width: 20px;"> {{trans('home.Sign-in via Google')}}
                                </a>
{{--                                <a href="{{url('redirect/facebook')}}"--}}
{{--                                   class="btn btn-lg btn-google btn-block text-uppercase btn-light mb-3"><img--}}
{{--                                        src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/05/Facebook_Logo_%282019%29.png/1024px-Facebook_Logo_%282019%29.png" style="width: 20px;"> {{trans('home.Register with facebook')}}--}}
{{--                                </a>--}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
