<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm fixed-top w-100">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold me-5" href="{{url('#')}}">🧩 SimpleCRM</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
                aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item me-5">
                    <a class="nav-link text-white sidebar-link" href="{{route('clients.index')}}">{{ __('navbar.clients') }}</a>
                </li>
                <li class="nav-item me-5">
                    <a class="nav-link text-white sidebar-link" href="{{route('orders.index')}}">{{ __('navbar.orders') }}</a>
                </li>
                <li class="nav-item me-5">
                    <a class="nav-link text-white sidebar-link" href="{{route('tasks.index')}}">{{ __('navbar.tasks') }}</a>
                </li>
            </ul>

            <form class="d-flex ms-3" role="search" method="GET" action="#">
                <input class="form-control me-2" type="search" name="query" placeholder="{{ __('navbar.search') }}" aria-label="{{ __('navbar.search') }}">
                <button class="btn btn-outline-success" type="submit">{{ __('navbar.search') }}</button>
            </form>


            <div class="ms-3">
                <a href="{{ route('lang.switch', 'en') }}" class="btn btn-outline-light btn-sm me-2">EN</a>
                <a href="{{ route('lang.switch', 'lv') }}" class="btn btn-outline-light btn-sm">LV</a>
            </div>


{{----------------------------}}
            <div class="d-flex ms-auto">
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('users.index') }}" class="btn btn-outline-warning me-2">
                            <i class="bi bi-person-plus"></i> {{ __('navbar.show_users') }}
                        </a>

                    @endif
                @endauth

            <ul class="navbar-nav ms-auto">
                @auth
                    <i class="bi bi-bell fs-5 text-light"></i>

                    <span class="navbar-text text-light ms-3">
            <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name }}
        </span>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-outline-light btn-sm ms-2">{{ __('navbar.logout') }}</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item me-2">
                        <a class="btn btn-outline-light btn-sm" href="{{ route('login.form') }}">{{ __('navbar.login') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-success btn-sm" href="{{ route('register.form') }}">{{ __('navbar.register') }}</a>
                    </li>
                @endauth
            </ul>

        </div>
    </div>
</nav>
