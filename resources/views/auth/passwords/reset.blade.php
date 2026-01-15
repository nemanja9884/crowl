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

        .reset-password-container {
            padding: 3rem 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .reset-password-card {
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

        .reset-password-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .reset-password-icon {
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

        .reset-password-title {
            font-size: 2rem;
            font-weight: bold;
            color: #667eea;
            margin-bottom: 0.5rem;
        }

        .reset-password-subtitle {
            color: #6c757d;
            font-size: 1rem;
            line-height: 1.6;
        }

        /* Info box */
        .security-info {
            background: linear-gradient(135deg, #e3f2fd 0%, #f3e5f5 100%);
            border-left: 5px solid #667eea;
            border-radius: 12px;
            padding: 1rem 1.5rem;
            margin-bottom: 2rem;
            font-size: 0.9rem;
            color: #333;
        }

        .security-info ul {
            margin: 0.5rem 0 0 0;
            padding-left: 1.5rem;
        }

        .security-info li {
            margin-bottom: 0.25rem;
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
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-control-modern.is-invalid {
            border-color: #dc3545;
        }

        .form-control-modern[readonly] {
            background: #f8f9fa;
            cursor: not-allowed;
        }

        .invalid-feedback {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.5rem;
            display: block;
        }

        /* Password strength indicator */
        .password-strength {
            height: 4px;
            background: #e0e0e0;
            border-radius: 2px;
            margin-top: 0.5rem;
            overflow: hidden;
        }

        .password-strength-bar {
            height: 100%;
            width: 0%;
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        .password-strength-bar.weak {
            width: 33%;
            background: #dc3545;
        }

        .password-strength-bar.medium {
            width: 66%;
            background: #ffc107;
        }

        .password-strength-bar.strong {
            width: 100%;
            background: #28a745;
        }

        /* Button */
        .btn-reset-password {
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
            margin-top: 1rem;
        }

        .btn-reset-password:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.6);
        }

        /* Success message */
        .success-message {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            border-left: 5px solid #28a745;
            border-radius: 15px;
            padding: 1.5rem;
            margin-top: 1.5rem;
            color: #155724;
            text-align: center;
            display: none;
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
            .reset-password-card {
                padding: 2rem 1.5rem;
                margin: 1rem;
            }

            .reset-password-icon {
                width: 70px;
                height: 70px;
                font-size: 2rem;
            }

            .reset-password-title {
                font-size: 1.6rem;
            }
        }
    </style>
@endsection

@section('content')
    <main class="reset-password-container px-3">
        <div class="reset-password-card">
            <!-- Header -->
            <div class="reset-password-header">
                <div class="reset-password-icon">
                    🔒
                </div>
                <h1 class="reset-password-title">{{trans('home.Reset Password')}}</h1>
                <p class="reset-password-subtitle">
                    {{trans('home.Create a new secure password for your account.')}}
                </p>
            </div>

            <!-- Security Info -->
            <div class="security-info">
                <strong>🛡️ {{trans('home.Password Requirements:')}}</strong>
                <ul>
                    <li>{{trans('home.At least 8 characters long')}}</li>
                    <li>{{trans('home.Mix of letters, numbers, and symbols')}}</li>
                    <li>{{trans('home.Not easily guessable')}}</li>
                </ul>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <!-- Email (readonly) -->
                <div class="form-group">
                    <label for="email" class="form-label">
                        {{trans('home.Email Address')}}
                    </label>
                    <input id="email"
                           type="email"
                           class="form-control-modern @error('email') is-invalid @enderror"
                           name="email"
                           value="{{ $email ?? old('email') }}"
                           required
                           autocomplete="email"
                           readonly>
                    @error('email')
                    <span class="invalid-feedback">
                            <strong>{{trans('home.' . $message)}}</strong>
                        </span>
                    @enderror
                </div>

                <!-- New Password -->
                <div class="form-group">
                    <label for="password" class="form-label">
                        {{trans('home.New Password')}}
                    </label>
                    <input id="password"
                           type="password"
                           class="form-control-modern @error('password') is-invalid @enderror"
                           name="password"
                           placeholder="••••••••"
                           required
                           autocomplete="new-password">
                    <div class="password-strength">
                        <div class="password-strength-bar" id="strengthBar"></div>
                    </div>
                    @error('password')
                    <span class="invalid-feedback">
                            <strong>{{trans('home.' . $message)}}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <label for="password-confirm" class="form-label">
                        {{trans('home.Confirm Password')}}
                    </label>
                    <input id="password-confirm"
                           type="password"
                           class="form-control-modern"
                           name="password_confirmation"
                           placeholder="••••••••"
                           required
                           autocomplete="new-password">
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-reset-password">
                    🔐 {{trans('home.Reset Password')}}
                </button>
            </form>
        </div>
    </main>
@endsection

@section('javascript')
    <script>
        // Password strength indicator
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const strengthBar = document.getElementById('strengthBar');

            let strength = 0;

            // Check length
            if (password.length >= 8) strength++;
            if (password.length >= 12) strength++;

            // Check for numbers
            if (/\d/.test(password)) strength++;

            // Check for lowercase and uppercase
            if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;

            // Check for special characters
            if (/[^A-Za-z0-9]/.test(password)) strength++;

            // Update bar
            strengthBar.className = 'password-strength-bar';
            if (strength <= 2) {
                strengthBar.classList.add('weak');
            } else if (strength <= 4) {
                strengthBar.classList.add('medium');
            } else {
                strengthBar.classList.add('strong');
            }
        });

        // Password confirmation validation
        document.getElementById('password-confirm').addEventListener('input', function() {
            const password = document.getElementById('password').value;
            const confirm = this.value;

            if (confirm && password !== confirm) {
                this.style.borderColor = '#dc3545';
            } else {
                this.style.borderColor = '#e0e0e0';
            }
        });
    </script>
@endsection
