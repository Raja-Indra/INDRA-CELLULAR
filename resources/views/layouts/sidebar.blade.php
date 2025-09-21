<aside class="main-sidebar sidebar-custom-blue elevation-4">
    <a class="text-center brand-link" style="background-color: #ff4e3d;">
        <span class="brand-text">
            <span class="font-weight-bold">INDRA</span>
            <span class="font-weight-light">CELL</span>
        </span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link {{ request()->routeIs('dashboard', 'home') ? 'active' : '' }}">
                        {{-- Ikon diubah menjadi 'home' --}}
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                @php
                    $isKelolaActive = request()->routeIs('users.*', 'produks.*', 'providers.*', 'roles.*');
                @endphp
                <li class="nav-item {{ $isKelolaActive ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $isKelolaActive ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cogs"></i> {{-- Ikon diubah menjadi 'cogs' (pengaturan) --}}
                        <p>
                            Kelola
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}"
                                class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                                {{-- Ikon diubah menjadi 'users' --}}
                                <i class="fas fa-users nav-icon"></i>
                                <p>Users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('roles.index') }}"
                                class="nav-link {{ request()->routeIs('roles.*') ? 'active' : '' }}">
                                <i class="fas fa-user-shield nav-icon"></i>
                                <p>Role & Izin</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('produks.index') }}"
                                class="nav-link {{ request()->routeIs('produks.*') ? 'active' : '' }}">
                                {{-- Ikon diubah menjadi 'box-open' (produk) --}}
                                <i class="fas fa-box-open nav-icon"></i>
                                <p>Produk</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('providers.index') }}"
                                class="nav-link {{ request()->routeIs('providers.*') ? 'active' : '' }}">
                                {{-- Ikon diubah menjadi 'truck' (pemasok) --}}
                                <i class="fas fa-truck nav-icon"></i>
                                <p>Provider</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('catatan_hutangs.index') }}"
                        class="nav-link {{ request()->routeIs('catatan_hutangs.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-money-bill-wave"></i>
                        <p>Catatan Hutang</p>
                    </a>
                </li>
            </ul>
        </nav>
        </div>
    </aside>
