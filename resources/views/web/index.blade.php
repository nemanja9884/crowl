@extends('web.layouts.app')

@section('content')
    <main class="px-3">
        <div class="row mt-3">
            <div class="col-md-4 mt-3">
                <a href="#">
                    <div class="card">
                        <img src="{{asset('images/languages/flag-brazil-M.8a771559.jpg')}}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Brazil</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mt-3">
                <a href="#">
                    <div class="card">
                        <img src="{{asset('images/languages/flag-serbia-M.71846a4b.jpg')}}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Serbia</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mt-3">
                <a href="#">
                    <div class="card">
                        <img src="{{asset('images/languages/flag-estonia-M.32ee36a2.jpg')}}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Estonia</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mt-3">
                <a href="#">
                    <div class="card">
                        <img src="{{asset('images/languages/flag-netherlands-M.13eb0383.jpg')}}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Netherlands</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mt-3">
                <a href="#">
                    <div class="card">
                        <img src="{{asset('images/languages/flag-slovenia-M.11c1a804.jpg')}}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Slovenia</h5>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </main>
@endsection
