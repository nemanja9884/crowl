<header class="mb-auto pb-3">
    <div>
        <h3 class="float-md-start mb-0 text-white"><a href="https://ucpages.uc.pt/celga-iltec/crowll/"
                                                      target="_blank" style="color: white !important; text-decoration: none !important; font-size: 40px;"><img src="{{asset('images/logo_horizontal.png')}}"
                                                                           alt="logo" width="200px"/> BETA</a></h3>
        <nav class="nav nav-masthead justify-content-center float-md-end">
            <li><a class="nav-link active" aria-current="page" href="{{route('index')}}">{{trans('home.Home')}}</a></li>
            {{--            <li><a class="nav-link" href="#">Features</a></li>--}}
            {{--            <li><a class="nav-link" href="#">Contact</a></li>--}}

            @guest
                {{--                @if (Route::has('login'))--}}
                {{--                    <li class="nav-item">--}}
                {{--                        <a class="nav-link" href="{{ route('login') }}">{{trans('home.Login')}}</a>--}}
                {{--                    </li>--}}
                {{--                @endif--}}

                {{--                @if (Route::has('register'))--}}
                {{--                    <li class="nav-item">--}}
                {{--                        <a class="nav-link" href="{{ route('register') }}">{{trans('home.Register')}}</a>--}}
                {{--                    </li>--}}
                {{--                @endif--}}
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                       data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->username }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('userProfile') }}">
                            {{ trans('home.Your profile') }}
                        </a>

                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ trans('home.Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </nav>
    </div>
</header>
