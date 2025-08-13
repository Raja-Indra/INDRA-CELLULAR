<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('layouts.app') }}" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a>
        </li>
    </ul>

    <ul class="ml-auto navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>
        {{-- Bungkus seluruh dropdown profil di dalam @auth --}}
        @auth
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <img src="{{ Auth::user()->profile_photo_path ? asset('storage/' . Auth::user()->profile_photo_path) : asset('dist/img/avatar5.png') }}"
                        class="img-circle elevation-2"
                        alt="User Image"
                        style="width: 28px; height: 28px;">
                    <span class="ml-2">{{ Auth::user()->name }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-header">Pengaturan Pengguna</span>
                    <div class="dropdown-divider"></div>

                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="mr-2 fas fa-user"></i> Profil Saya
                    </a>

                    <div class="dropdown-divider"></div>

                    <a href="{{ route('logout') }}" class="dropdown-item dropdown-footer bg-danger"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="mr-2 fas fa-sign-out-alt"></i> Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        @endauth
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>
</nav>
