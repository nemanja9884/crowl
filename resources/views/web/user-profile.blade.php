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

        .profile-container {
            padding: 3rem 0;
            min-height: 100vh;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
            padding: 3rem;
        }

        .profile-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .profile-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            color: white;
            font-weight: bold;
            margin: 0 auto 1rem;
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        }

        .profile-title {
            font-size: 1.8rem;
            font-weight: bold;
            color: #667eea;
            margin-bottom: 0.5rem;
        }

        .profile-username {
            font-size: 1.2rem;
            color: #6c757d;
        }

        /* Form Groups */
        .form-group {
            margin-bottom: 1.5rem;
            width: 100%; /* DODATO */
        }

        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 0.75rem;
            display: block;
            font-size: 1rem;
        }

        .form-control-modern {
            width: 100% !important; /* Dodao !important */
            max-width: 100%; /* DODATO */
            padding: 1rem 1.25rem;
            font-size: 1rem;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            transition: all 0.3s ease;
            background: white;
            color: #333;
            box-sizing: border-box; /* DODATO - važno! */
        }

        .form-control-modern:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-control-modern:disabled,
        .form-control-modern[readonly] {
            background: #f8f9fa;
            cursor: not-allowed;
            color: #6c757d;
        }

        /* Select Styling */
        select.form-control-modern {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%23667eea' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 12px;
            padding-right: 3rem;
        }

        /* Submit Button */
        .btn-save {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            color: white;
            border: none;
            padding: 1rem 3rem;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            box-shadow: 0 5px 15px rgba(56, 239, 125, 0.4);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-save:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(56, 239, 125, 0.6);
        }

        /* Section Divider */
        .section-divider {
            height: 2px;
            background: linear-gradient(to right, transparent, #667eea, transparent);
            margin: 2.5rem 0;
        }

        .section-title {
            font-size: 1.2rem;
            font-weight: bold;
            color: #667eea;
            margin-bottom: 1.5rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .glass-card {
                padding: 2rem 1.5rem;
            }

            .profile-avatar {
                width: 80px;
                height: 80px;
                font-size: 2rem;
            }

            .profile-title {
                font-size: 1.5rem;
            }

            .btn-save {
                width: 100%;
            }
        }

        /* Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .glass-card {
            animation: fadeInUp 0.6s ease-out;
        }

        .row {
            margin-left: 0;
            margin-right: 0;
        }

        .row > [class*='col-'] {
            padding-left: 0.75rem;
            padding-right: 0.75rem;
        }
    </style>
@endsection

@section('content')
    <main class="profile-container px-3">
        <div class="container" style="max-width: 900px;">
            <div class="glass-card">
                <!-- Profile Header -->
                <div class="profile-header">
                    <div class="profile-avatar">
                        {{ strtoupper(substr($user->username, 0, 2)) }}
                    </div>
                    <h1 class="profile-title">{{trans('home.Your profile')}}</h1>
                    <p class="profile-username">{{$user->username}}</p>
                </div>

                <!-- Profile Form -->
                <form action="{{route('updateProfile')}}" method="POST">
                    @csrf
                    @method('POST')

                    <!-- Account Information -->
                    <div class="section-title">
                        👤 {{trans('home.Account Information')}}
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="username" class="form-label">{{trans('home.Username')}}</label>
                                <input type="text"
                                       id="username"
                                       name="username"
                                       placeholder="Username"
                                       class="form-control-modern"
                                       value="{{$user->username}}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email" class="form-label">{{trans('home.Email')}}</label>
                                <input type="email"
                                       id="email"
                                       placeholder="{{trans('home.Email')}}"
                                       class="form-control-modern"
                                       value="{{$user->email}}"
                                       readonly>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password" class="form-label">{{trans('home.Set new password')}}</label>
                                <input type="password"
                                       id="password"
                                       name="password"
                                       placeholder="••••••••"
                                       class="form-control-modern">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="age" class="form-label">{{trans('home.What is your age?')}}</label>
                                <select name="age" id="age" class="form-control-modern">
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

                    <div class="section-divider"></div>

                    <!-- Language & Teaching Background -->
                    <div class="section-title">
                        📚 {{trans('home.Language & Teaching Background')}}
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="working_on_university" class="form-label">
                                    {{trans('home.Have you completed, or are you working towards, a university degree with a major component in language or linguistics?')}}
                                </label>
                                <select name="working_on_university" id="working_on_university" class="form-control-modern">
                                    <option value="1" @if($user->working_on_university == 1) selected @endif>{{trans('home.Yes')}}</option>
                                    <option value="0" @if($user->working_on_university == 0) selected @endif>{{trans('home.No')}}</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="language_teacher" class="form-label">
                                    {{trans('home.Are you a language teacher?')}}
                                </label>
                                <select name="language_teacher" id="language_teacher" class="form-control-modern">
                                    <option value="1" @if($user->language_teacher == 1) selected @endif>{{trans('home.Yes')}}</option>
                                    <option value="0" @if($user->language_teacher == 0) selected @endif>{{trans('home.No')}}</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="dominant_language" class="form-label">
                                    {{trans("home.Is $user->language your first/dominant language?")}}
                                </label>
                                <select name="dominant_language" id="dominant_language" class="form-control-modern">
                                    <option value="1" @if($user->dominant_language == 1) selected @endif>{{trans('home.Yes')}}</option>
                                    <option value="0" @if($user->dominant_language == 0) selected @endif>{{trans('home.No')}}</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center mt-4">
                        <button type="submit" class="btn-save">
                            💾 {{trans('home.Save Changes')}}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
