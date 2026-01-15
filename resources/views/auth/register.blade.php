@extends('web.layouts.app')

@section('css')
    <style>
        body {
            font-family: "Anton", sans-serif;
            font-weight: 100 !important;
            font-style: normal;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            background-attachment: fixed;
            background-size: cover;
            min-height: 100vh;
        }

        .register-container {
            padding: 3rem 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .register-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 10px 40px rgba(31, 38, 135, 0.2);
            padding: 3rem;
            max-width: 600px;
            width: 100%;
            animation: slideInUp 0.6s ease-out;
        }

        .register-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .register-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            color: white;
            margin: 0 auto 1rem;
            box-shadow: 0 8px 20px rgba(56, 239, 125, 0.4);
        }

        .register-title {
            font-size: 2rem;
            font-weight: bold;
            color: #11998e;
            margin-bottom: 0.5rem;
        }

        .register-subtitle {
            color: #6c757d;
            font-size: 1rem;
        }

        /* Info box */
        .info-box {
            background: linear-gradient(135deg, #e3f2fd 0%, #f3e5f5 100%);
            border-left: 4px solid #667eea;
            border-radius: 10px;
            padding: 1rem 1.5rem;
            margin-bottom: 2rem;
            font-size: 0.95rem;
            color: #333;
        }

        .info-box a {
            color: #667eea;
            font-weight: 600;
            text-decoration: none;
        }

        .info-box a:hover {
            text-decoration: underline;
        }

        /* Form styling */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 0.5rem;
            display: block;
            font-size: 0.95rem;
        }

        .required {
            color: #dc3545;
        }

        .form-control-modern {
            width: 100%;
            padding: 1rem 1.25rem;
            font-size: 1rem;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            transition: all 0.3s ease;
            background: white;
            color: #333;
            box-sizing: border-box;
        }

        .form-control-modern:focus {
            outline: none;
            border-color: #11998e;
            box-shadow: 0 0 0 3px rgba(17, 153, 142, 0.1);
        }

        .form-control-modern.is-invalid {
            border-color: #dc3545;
        }

        .invalid-feedback {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.5rem;
            display: block;
        }

        /* Select styling */
        select.form-control-modern {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%2311998e' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 12px;
            padding-right: 3rem;
        }

        /* Section titles */
        .section-title {
            font-size: 1.1rem;
            font-weight: bold;
            color: #11998e;
            margin: 2rem 0 1rem 0;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #e0e0e0;
        }

        /* Buttons */
        .btn-register {
            width: 100%;
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            color: white;
            border: none;
            padding: 1rem;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            box-shadow: 0 5px 15px rgba(56, 239, 125, 0.4);
            transition: all 0.3s ease;
            cursor: pointer;
            margin-bottom: 1rem;
        }

        .btn-register:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(56, 239, 125, 0.6);
        }

        .btn-google {
            width: 100%;
            background: white;
            color: #333;
            border: 2px solid #e0e0e0;
            padding: 1rem;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            text-decoration: none;
            margin-top: 1rem;
        }

        .btn-google:hover {
            background: #f8f9fa;
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
            color: #333;
        }

        .btn-google img {
            width: 24px;
            height: 24px;
        }

        /* Links */
        .login-link {
            text-align: center;
            margin: 1.5rem 0;
            padding-top: 1.5rem;
            border-top: 2px solid #f0f0f0;
        }

        .login-link p {
            color: #6c757d;
            margin: 0;
        }

        .login-link a {
            color: #11998e;
            font-weight: 600;
            text-decoration: none;
        }

        .login-link a:hover {
            color: #38ef7d;
            text-decoration: underline;
        }

        /* Divider */
        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 1.5rem 0;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 2px solid #e0e0e0;
        }

        .divider span {
            padding: 0 1rem;
            color: #6c757d;
            font-weight: 500;
        }

        /* Animations */
        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .register-card {
                padding: 2rem 1.5rem;
                margin: 1rem;
            }

            .register-icon {
                width: 70px;
                height: 70px;
                font-size: 2rem;
            }

            .register-title {
                font-size: 1.6rem;
            }
        }
    </style>
@endsection

@section('content')
    <main class="register-container px-3">
        <div class="register-card">
            <!-- Header -->
            <div class="register-header">
                <div class="register-icon">
                    ✨
                </div>
                <h1 class="register-title">{{ trans('home.Register') }}</h1>
                <p class="register-subtitle">{{ trans('home.Create your account') }}</p>
            </div>

            <!-- Info Box -->
            @php
                $locale = \Illuminate\Support\Facades\App::getLocale();
                $lang = \App\Models\Language::where('lang_code', $locale)->first();
            @endphp
            <div class="info-box">
                ℹ️ {{trans('home.This information is important to us. Click')}}
                <a href="{{route('additionalInfo', ['code' => $lang->lang_code])}}" target="_blank">{{trans('home.here')}}</a>
                {{trans('home.to know why')}}
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Account Information -->
                <div class="section-title">👤 {{trans('home.Account Information')}}</div>

                <!-- Email -->
                <div class="form-group">
                    <label for="email" class="form-label">
                        {{trans('home.Email')}} <span class="required">*</span>
                    </label>
                    <input id="email"
                           type="email"
                           class="form-control-modern @error('email') is-invalid @enderror"
                           name="email"
                           value="{{ old('email') }}"
                           placeholder="your@email.com"
                           required
                           autocomplete="email">
                    @error('email')
                    <span class="invalid-feedback">
                            <strong>{{trans('home.' . $message)}}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password" class="form-label">
                        {{trans('home.Password')}} <span class="required">*</span>
                    </label>
                    <input id="password"
                           type="password"
                           class="form-control-modern @error('password') is-invalid @enderror"
                           name="password"
                           placeholder="••••••••"
                           required
                           autocomplete="new-password">
                    @error('password')
                    <span class="invalid-feedback">
                            <strong>{{trans('home.' . $message)}}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <label for="password-confirm" class="form-label">
                        {{trans('home.Confirm password')}} <span class="required">*</span>
                    </label>
                    <input id="password-confirm"
                           type="password"
                           class="form-control-modern"
                           name="password_confirmation"
                           placeholder="••••••••"
                           required
                           autocomplete="new-password">
                </div>

                <!-- Personal Information -->
                <div class="section-title">📋 {{trans('home.Personal Information')}}</div>

                <!-- Age -->
                <div class="form-group">
                    <label for="age" class="form-label">{{trans('home.What is your age?')}}</label>
                    <select name="age" id="age" class="form-control-modern">
                        <option value="18-24">18-24</option>
                        <option value="25-34">25-34</option>
                        <option value="35-44">35-44</option>
                        <option value="45-54">45-54</option>
                        <option value="55-64">55-64</option>
                        <option value="above65">{{trans('home.65 and above')}}</option>
                    </select>
                </div>

                <!-- Language & Teaching Background -->
                <div class="section-title">📚 {{trans('home.Language & Teaching Background')}}</div>

                <!-- University Degree -->
                <div class="form-group">
                    <label for="working_on_university" class="form-label">
                        {{trans('home.Have you completed, or are you working towards, a university degree with a major component in language or linguistics?')}}
                    </label>
                    <select name="working_on_university" id="working_on_university" class="form-control-modern">
                        <option value="1">{{trans('home.Yes')}}</option>
                        <option value="0" selected>{{trans('home.No')}}</option>
                    </select>
                </div>

                <!-- Language Teacher -->
                <div class="form-group">
                    <label for="language_teacher" class="form-label">
                        {{trans('home.Are you a language teacher?')}}
                    </label>
                    <select name="language_teacher" id="language_teacher" class="form-control-modern">
                        <option value="1">{{trans('home.Yes')}}</option>
                        <option value="0" selected>{{trans('home.No')}}</option>
                    </select>
                </div>

                <!-- Dominant Language -->
                <div class="form-group">
                    <label for="dominant_language" class="form-label">
                        {{trans("home.Is $lang->name your first/dominant language?")}}
                    </label>
                    <select name="dominant_language" id="dominant_language" class="form-control-modern">
                        <option value="1" selected>{{trans('home.Yes')}}</option>
                        <option value="0">{{trans('home.No')}}</option>
                    </select>
                </div>

                <!-- Register Button -->
                <button type="submit" class="btn-register">
                    ✨ {{trans('home.Register')}}
                </button>

                <!-- Login Link -->
                <div class="login-link">
                    <p>
                        {{trans('home.Already have an account? Login')}}
                        <a href="{{route('login')}}">{{trans('home.here')}}</a>
                    </p>
                </div>

                <!-- Divider -->
                <div class="divider">
                    <span>{{ trans('home.OR') }}</span>
                </div>

                <!-- Google Sign-up -->
                <a href="{{url('redirect/google')}}" class="btn-google">
                    <img src="https://img.icons8.com/color/24/000000/google-logo.png" alt="Google">
                    {{trans('home.Sign-up via Google')}}
                </a>
            </form>
        </div>
    </main>
@endsection
