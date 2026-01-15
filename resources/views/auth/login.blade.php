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

        .login-container {
            padding: 3rem 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 10px 40px rgba(31, 38, 135, 0.2);
            padding: 3rem;
            max-width: 500px;
            width: 100%;
            animation: slideInUp 0.6s ease-out;
        }

        .login-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .login-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            color: white;
            margin: 0 auto 1rem;
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        }

        .login-title {
            font-size: 2rem;
            font-weight: bold;
            color: #667eea;
            margin-bottom: 0.5rem;
        }

        .login-subtitle {
            color: #6c757d;
            font-size: 1rem;
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

        .form-control-modern {
            width: 100%;
            padding: 1rem 1.25rem;
            font-size: 1rem;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            transition: all 0.3s ease;
            background: white;
            color: #333;
        }

        .form-control-modern:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
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

        /* Checkbox */
        .remember-me {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .remember-me input[type="checkbox"] {
            width: 18px;
            height: 18px;
            margin-right: 0.5rem;
            cursor: pointer;
        }

        .remember-me label {
            margin: 0;
            cursor: pointer;
            color: #333;
        }

        /* Buttons */
        .btn-login {
            width: 100%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 1rem;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
            transition: all 0.3s ease;
            cursor: pointer;
            margin-bottom: 1rem;
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.6);
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
        .forgot-password {
            text-align: center;
            margin: 1rem 0;
        }

        .forgot-password a {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .forgot-password a:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        .register-link {
            text-align: center;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 2px solid #f0f0f0;
        }

        .register-link p {
            color: #6c757d;
            margin: 0;
        }

        .register-link a {
            color: #667eea;
            font-weight: 600;
            text-decoration: none;
        }

        .register-link a:hover {
            color: #764ba2;
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
            .login-card {
                padding: 2rem 1.5rem;
                margin: 1rem;
            }

            .login-icon {
                width: 70px;
                height: 70px;
                font-size: 2rem;
            }

            .login-title {
                font-size: 1.6rem;
            }
        }
    </style>
@endsection

@section('content')
    <main class="login-container px-3">
        <div class="login-card">
            <!-- Header -->
            <div class="login-header">
                <div class="login-icon">
                    🔐
                </div>
                <h1 class="login-title">{{ trans('home.Login') }}</h1>
                <p class="login-subtitle">{{ trans('home.Welcome back!') }}</p>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="form-group">
                    <label for="email" class="form-label">{{ trans('home.Email Address') }}</label>
                    <input id="email"
                           type="email"
                           class="form-control-modern @error('email') is-invalid @enderror"
                           name="email"
                           value="{{ old('email') }}"
                           placeholder="your@email.com"
                           required
                           autocomplete="email"
                           autofocus>
                    @error('email')
                    <span class="invalid-feedback">
                            <strong>{{trans('home.' . $message)}}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password" class="form-label">{{ trans('home.Password') }}</label>
                    <input id="password"
                           type="password"
                           class="form-control-modern @error('password') is-invalid @enderror"
                           name="password"
                           placeholder="••••••••"
                           required
                           autocomplete="current-password">
                    @error('password')
                    <span class="invalid-feedback">
                            <strong>{{trans('home.' . $message)}}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="remember-me">
                    <input type="checkbox"
                           name="remember"
                           id="remember"
                        {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember">
                        {{ trans('home.Remember Me') }}
                    </label>
                </div>

                <!-- Login Button -->
                <button type="submit" class="btn-login">
                    {{ trans('home.Login') }} →
                </button>

                <!-- Forgot Password -->
                @if (Route::has('password.request'))
                    <div class="forgot-password">
                        <a href="{{ route('password.request') }}">
                            {{ trans('home.Forgot Your Password?') }}
                        </a>
                    </div>
                @endif

                <!-- Divider -->
                <div class="divider">
                    <span>{{ trans('home.OR') }}</span>
                </div>

                <!-- Google Sign-in -->
                <a href="{{url('redirect/google')}}" class="btn-google">
                    <img src="https://img.icons8.com/color/24/000000/google-logo.png" alt="Google">
                    {{trans('home.SIGN-IN VIA GOOGLE')}}
                </a>

                <!-- Register Link -->
                <div class="register-link">
                    <p>
                        {{trans('home.Don\'t have an account? Register')}}
                        <a href="{{route('register')}}">{{trans('home.here')}}</a>
                    </p>
                </div>
            </form>
        </div>
    </main>
@endsection
