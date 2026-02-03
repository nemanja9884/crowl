<!-- Header -->
<header class="modern-header mb-4">
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <!-- Logo -->
            <a class="navbar-brand" href="{{route('index')}}">
                <img src="{{asset('images/logo_horizontal.png')}}" alt="logo" class="logo-img"/>
                <span class="beta-badge">BETA</span>
            </a>

            <!-- Mobile Toggle -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navigation -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('index')}}">
                            <i class="bi bi-house-door me-1"></i>
                            {{trans('home.Home')}}
                        </a>
                    </li>

                    @guest
                        <!-- Ako želiš login/register opcije, otkоmentariši ovde -->
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle user-dropdown" href="#" id="navbarDropdown"
                               role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="user-avatar">
                                    {{ strtoupper(substr(Auth::user()->username, 0, 1)) }}
                                </div>
                                <span class="ms-2">{{ Auth::user()->username }}</span>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end modern-dropdown" aria-labelledby="navbarDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ route('userProfile') }}">
                                        <i class="bi bi-person me-2"></i>
                                        {{ trans('home.Your profile') }}
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="bi bi-box-arrow-right me-2"></i>
                                        {{ trans('home.Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
</header>
