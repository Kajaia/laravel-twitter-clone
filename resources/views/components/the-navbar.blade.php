<!-- Navbar -->
<nav class="navbar navbar-expand navbar-white bg-white">
    <div class="container">
        <a class="navbar-brand" href="/">
            <i class="fab fa-twitter"></i>
            {{ config('app.name') }}
        </a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto">
                @auth
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img class="rounded-3 me-1" width="24" height="24" src="{{ config('services.ui_avatar') . auth()->user()->name }}" alt="{{ auth()->user()->name }}">
                        {{ auth()->user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end rounded-5 shadow-sm border-0 mt-3" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><a class="dropdown-item" href="#">Notifications</a></li>
                        <li><hr class="dropdown-divider bg-light"></li>
                        <li>
                            <a class="dropdown-item cursor-pointer" onclick="document.querySelector('#logout-form').submit();">Logout</a>
                            <form id="logout-form" class="d-none" action="{{ route('logout') }}" method="post">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
                @else
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                @endif
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                @endif
                @endauth
            </ul>
        </div>
    </div>
</nav>
<!-- /Navbar -->