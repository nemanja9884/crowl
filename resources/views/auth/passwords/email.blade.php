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

        .reset-container {
            padding: 3rem 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .reset-card {
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

        .reset-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .reset-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            color: white;
            margin: 0 auto 1rem;
            box-shadow: 0 8px 20px rgba(245, 87, 108, 0.4);
        }

        .reset-title {
            font-size: 2rem;
            font-weight: bold;
            color: #f5576c;
            margin-bottom: 0.5rem;
        }

        .reset-subtitle {
            color: #6c757d;
            font-size: 1rem;
            line-height: 1.6;
        }

        /* Success Alert */
        .success-box {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            border-left: 5px solid #28a745;
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            color: #155724;
            animation: fadeIn 0.5s ease-out;
        }

        .success-box-icon {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
            display: block;
        }

        .success-box p {
            margin: 0;
            font-size: 1.1rem;
            font-weight: 500;
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
            box-sizing: border-box;
        }

        .form-control-modern:focus {
            outline: none;
            border-color: #f5576c;
            box-shadow: 0 0 0 3px rgba(245, 87, 108, 0.1);
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

        /* Button */
        .btn-reset {
            width: 100%;
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            border: none;
            padding: 1rem;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            box-shadow: 0 5px 15px rgba(245, 87, 108, 0.4);
            transition: all 0.3s ease;
            cursor: pointer;
            margin-bottom: 1rem;
        }

        .btn-reset:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(245, 87, 108, 0.6);
        }

        /* Back to login link */
        .back-link {
            text-align: center;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 2px solid #f0f0f0;
        }

        .back-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .back-link a:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        /* Info box */
        .info-box {
            background: linear-gradient(135deg, #fff3cd 0%, #ffe69c 100%);
            border-left: 5px solid #ffc107;
            border-radius: 12px;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
            color: #856404;
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

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .reset-card {
                padding: 2rem 1.5rem;
                margin: 1rem;
            }

            .reset-icon {
                width: 70px;
                height: 70px;
                font-size: 2rem;
            }

            .reset-title {
                font-size: 1.6rem;
            }
        }
    </style>
@endsection

@section('content')
    <main class="reset-container px-3">
        <div class="reset-card">
            <!-- Header -->
            <div class="reset-header">
                <div class="reset-icon">
                    🔑
                </div>
                <h1 class="reset-title">{{trans('home.Reset Password')}}</h1>
                <p class="reset-subtitle">
                    {{trans('home.Enter your email address and we will send you a link to reset your password.')}}
                </p>
            </div>

            <!-- Success Message -->
            @if (session('status'))
                <div class="success-box">
                    <span class="success-box-icon">✅</span>
                    <p>{{trans('home.' . session('status'))}}</p>
                </div>
            @endif

            <!-- Form -->
            @if(!session('status') || session('status') != 'passwords.sent')
                <div class="info-box">
                    ℹ️ {{trans('home.You will receive an email with instructions on how to reset your password.')}}
                </div>

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email" class="form-label">
                            {{trans('home.Email Address')}}
                        </label>
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

                    <!-- Submit Button -->
                    <button type="submit" class="btn-reset">
                        📧 {{trans('home.Send Password Reset Link')}}
                    </button>
                </form>
            @endif

            <!-- Back to Login -->
            <div class="back-link">
                <a href="{{route('login')}}">
                    ← {{trans('home.Back to Login')}}
                </a>
            </div>
        </div>
    </main>
@endsection
