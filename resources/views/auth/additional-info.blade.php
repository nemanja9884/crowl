@extends('web.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{trans('home.Additional information')}}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('additional-user-info', $user->id) }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="age" class="col-md-4 col-form-label text-md-end">{{trans('home.What is your age?')}}</label>
                            <div class="col-md-6">
                                <select name="age" id="age" class="form-control">
                                    <option value="18-30">18-30</option>
                                    <option value="31-40">31-40</option>
                                    <option value="41-50">41-50</option>
                                    <option value="51-60">51-60</option>
                                    <option value="51-60">51-60</option>
                                    <option value="above70">{{trans('home.Above 70')}}</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="working_on_university" class="col-md-7 col-form-label text-md-end">{{trans('home.Have you completed, or are you working towards, a university degree with a major component in language or linguistics?')}}</label>
                            <div class="col-md-3">
                                <select name="working_on_university" id="working_on_university" class="form-control">
                                    <option value="1">{{trans('home.Yes')}}</option>
                                    <option value="0">{{trans('home.No')}}</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="language_teacher" class="col-md-4 col-form-label text-md-end">{{ __('Are you a language teacher?') }}</label>
                            <div class="col-md-6">
                                <select name="language_teacher" id="language_teacher" class="form-control">
                                    <option value="1">{{trans('home.Yes')}}</option>
                                    <option value="0">{{trans('home.No')}}</option>
                                </select>
                            </div>
                        </div>
                        @php
                        $locale = \Illuminate\Support\Facades\App::getLocale();
                        $lang = \App\Models\Language::where('lang_code', $locale)->first();
                        @endphp
                        <div class="row mb-3">
                            <label for="dominant_language" class="col-md-4 col-form-label text-md-end">{{trans("home.Is $lang->name your first/dominant language?")}}</label>
                            <div class="col-md-6">
                                <select name="dominant_language" id="dominant_language" class="form-control">
                                    <option value="1">{{trans('home.Yes')}}</option>
                                    <option value="0">{{trans('home.No')}}</option>
                                </select>
                            </div>
                        </div>

                        <p>This information is important to us. Click <a href="{{route('languageIndex', ['id' => $lang->id, 'code' => $lang->lang_code])}}">here</a> to know why</p>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{trans('home.Save')}}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
