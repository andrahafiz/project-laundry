<div class="navbar-bg">
</div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                        class="fas fa-search"></i></a></li>
        </ul>
        <h4 class="text-light">@auth
            {{ auth()->user()->roles }} @endauth </h4>
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown dropdown-list-toggle">
            @if (Auth::user()->roles == 'CUSTOMER')
                <a href="{{ route(Helper::AdminOrUser('cart.index')) }}" class="nav-link nav-link-lg beep">
                    <i class="fas fa-basket-shopping"></i>
                </a>
            @endif

        </li>
        <li class="dropdown"><a href="#" data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="{{ asset('img/avatar/avatar-1.png') }}" class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->name }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title">Logged in 5 min ago</div>
                <a href="#" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profile
                </a>
                <div class="dropdown-divider"></div>
                <form action="{{ route('logout') }}" id="logout" method="POST">
                    @csrf
                    <a type="submit" class="dropdown-item has-icon text-danger" role="button"
                        onclick="document.getElementById('logout').submit();">
                        <i class="fas fa-sign-out-alt"></i> Logout

                    </a>
                </form>
            </div>
        </li>
    </ul>
</nav>
