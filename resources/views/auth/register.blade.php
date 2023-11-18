@extends('web.layouts.app')

@section('content')
    <div class="container mt-3 mb-3">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ trans('home.Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            @php
                                $locale = \Illuminate\Support\Facades\App::getLocale();
                                $lang = \App\Models\Language::where('lang_code', $locale)->first();
                            @endphp
                            <p>{{trans('home.This information is important to us. Click')}} <a
                                    href="{{route('additionalInfo', ['code' => $lang->lang_code])}}" target="_blank">{{trans('home.here')}}</a>
                                {{trans('home.to know why')}}</p>

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{trans('home.Username')}}
                                    (*)</label>

                                <div class="col-md-6">
                                    <input id="username" type="text"
                                           class="form-control @error('username') is-invalid @enderror" name="username"
                                           value="{{ old('username') }}" required autocomplete="username" autofocus>

                                    @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{trans('home.' . $message)}}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{trans('home.Email')}}
                                    (*)</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{trans('home.' . $message)}}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-end">{{trans('home.Password')}}(*)</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{trans('home.' . $message)}}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm"
                                       class="col-md-4 col-form-label text-md-end">{{trans('home.Confirm password')}}
                                    (*)</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="age"
                                       class="col-md-4 col-form-label text-md-end">{{trans('home.What is your age?')}}</label>
                                <div class="col-md-6">
                                    <select name="age" id="age" class="form-control">
                                        <option value="below20">{{trans('home.Below 20')}}</option>
                                        <option value="20-40">20-40</option>
                                        <option value="41-60">41-60</option>
                                        <option value="above60">{{trans('home.Above 60')}}</option>
                                    </select>
                                    <div class="ageMessageDiv"></div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="working_on_university"
                                       class="col-md-7 col-form-label text-md-end">{{trans('home.Have you completed, or are you working towards, a university degree with a major component in language or linguistics?')}}</label>
                                <div class="col-md-3">
                                    <select name="working_on_university" id="working_on_university"
                                            class="form-control">
                                        <option value="1">{{trans('home.Yes')}}</option>
                                        <option value="0">{{trans('home.No')}}</option>
                                    </select>
                                    <div class="universityMessageDiv"></div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="language_teacher"
                                       class="col-md-4 col-form-label text-md-end">{{trans('home.Are you a language teacher?')}}</label>
                                <div class="col-md-6">
                                    <select name="language_teacher" id="language_teacher" class="form-control">
                                        <option value="1">{{trans('home.Yes')}}</option>
                                        <option value="0">{{trans('home.No')}}</option>
                                    </select>
                                    <div class="teacherMessageDiv"></div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="dominant_language"
                                       class="col-md-4 col-form-label text-md-end">{{trans("home.Is $lang->name your first/dominant language?")}}</label>
                                <div class="col-md-6">
                                    <select name="dominant_language" id="dominant_language" class="form-control">
                                        <option value="1">{{trans('home.Yes')}}</option>
                                        <option value="0">{{trans('home.No')}}</option>
                                    </select>
                                    <div class="domLanguageMessageDiv"></div>
                                </div>
                            </div>

                            <p>{{trans('home.Already have an account? Login')}} <a
                                href="{{route('login')}}">{{trans('home.here')}}</a></p>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{trans('home.Register')}}
                                    </button>
                                </div>
                            </div>

                            <div class="social-login-content text-center mt-3">
                                <div class="social-button">
                                    <a href="{{url('redirect/google')}}"
                                       class="btn btn-lg btn-google btn-block text-uppercase btn-light mb-3"><img
                                            src="https://img.icons8.com/color/16/000000/google-logo.png"
                                            style="width: 20px;"> {{trans('home.Sign-up via Google')}}
                                    </a>
{{--                                    <a href="{{url('redirect/facebook')}}"--}}
{{--                                       class="btn btn-lg btn-google btn-block text-uppercase btn-light mb-3"><img--}}
{{--                                            src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/05/Facebook_Logo_%282019%29.png/1024px-Facebook_Logo_%282019%29.png"--}}
{{--                                            style="width: 20px;"> {{trans('home.Register with facebook')}}--}}
{{--                                    </a>--}}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script>
        window.onload = function () {
            $(document).ready(function () {
                $('#age').on('change', function () {
                    let value = $(this).val();
                    let key = 'age';
                    $.fn.myfunction(key, value, '.ageMessageDiv');
                });

                $('#dominant_language').on('change', function () {
                    let value = $(this).val();
                    let key = 'dominant_language';
                    $.fn.myfunction(key, value, '.domLanguageMessageDiv');
                });

                $('#language_teacher').on('change', function () {
                    let value = $(this).val();
                    let key = 'language_teacher';
                    $.fn.myfunction(key, value, '.teacherMessageDiv');
                });

                $('#working_on_university').on('change', function () {
                    let value = $(this).val();
                    let key = 'working_on_university';
                    $.fn.myfunction(key, value, '.universityMessageDiv');
                });

                    $.fn.myfunction = function(key, value, messageDiv) {
                        let url = "{{url('additional-info-data')}}/" + key + "/" + value;
                        $.ajax({
                            type: "GET",
                            url: url,
                            success: function (data) {
                                $(messageDiv).html("<p style='color: red;'>" + data + "% of people chose the same</p>");
                            },
                            error: function () {
                                alert('Some error occurred, please try again.');
                            }
                        });
                    };
            });
        }
    </script>
@endsection
