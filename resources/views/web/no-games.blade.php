@extends('web.layouts.app')

@section('content')
    <main class="px-3">
        <div class="alert alert-warning" role="alert">
            <h4 class="alert-heading">{{trans('home.No more games!')}}</h4>
            <p>{{trans('home.Sorry, there is no more games on this level. Please, try again later!')}}</p>
            <hr>
            <p class="mb-0">{{trans('home.Feel free to contact us on this test@test.com')}}</p>
        </div>
    </main>
@endsection
