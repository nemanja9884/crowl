@extends('admin.layouts.app_login')
@section('content')
    <div class="container-fluid thirdContainer" style="min-height: 1000px;">
        <div class="sufee-login d-flex align-content-center flex-wrap">
            <div class="container">
                <div class="login-content">
                    <div class="login-logo">
                    </div>
                    <div class="login-form">
                        <div class="text-center">
                            <img src="{{asset('images/logo_vertical.png')}}" style="width: 60%;" alt="Logo">
                        </div>
                        <form class="mt-3" method="POST" action="{{ route('admin.register') }}">
                            @csrf
                            <div class="form-group">
                                <label>Ime</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                       value="{{ old('name') }}" required autocomplete="name" autofocus
                                       placeholder="">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Email adresa</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Lozinka</label>
                                <input id="password" type="password"
                                       class="form-control @error('password') is-invalid @enderror" name="password"
                                       required
                                       autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Ponovite lozinku</label>
                                <input id="password-confirm" type="password" class="form-control"
                                       name="password_confirmation" required autocomplete="new-password">
                            </div>
                            <!--<div class="checkbox">
                                <label>
                                    <input type="checkbox"> Agree the terms and policy
                                </label>
                            </div>-->
                            <button type="submit"
                                    class="btn btn-primary btn-flat m-b-30 mt-3">{{ __('Registruj se') }}</button>
                            <div class="register-link m-t-15 text-center">
                                <p>Već imate nalog? <a href="/login"> Ulogujte se</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
