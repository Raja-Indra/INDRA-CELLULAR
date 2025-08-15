<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ url('/') }}" class="brand-link">
        {{--
            Icon sinyal sebagai pengganti logo gambar,
            menggunakan Font Awesome yang sudah ada di AdminLTE
        --}}
        <i class="fas fa-satellite-dish brand-image img-circle elevation-3" style="opacity: .8"></i>

        {{--
            Teks logo dibagi dua: "INDRA" dibuat tebal dan "CELL" lebih ringan
            untuk menciptakan tampilan yang profesional.
        --}}
        <span class="brand-text">
            <span class="font-weight-bold">INDRA</span>
            <span class="font-weight-light">CELL</span>
        </span>
    </a>

    <div class="sidebar">
      <div class="mb-3 ">

      </div>

      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-item">
            {{-- Tambahkan kelas 'active' jika route saat ini adalah halaman utama ('/') --}}
            <a href="{{ url('/') }}" class="nav-link {{ request()->is('/') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>

          {{--
            PENJELASAN LOGIKA BARU:
            1. request()->is('users*') akan bernilai true jika URL saat ini diawali dengan 'users'. Tanda * adalah wildcard.
            2. 'menu-open' akan ditambahkan ke <li> jika salah satu dari route kelola (users, produks, dll.) sedang aktif.
            3. 'active' akan ditambahkan ke link <a> Kelola jika salah satu route di dalamnya aktif.
          --}}
          <li class="nav-item {{ request()->is('users*') || request()->is('produks*') || request()->is('providers*') || request()->is('transaksis*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->is('users*') || request()->is('produks*') || request()->is('providers*') || request()->is('transaksis*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Kelola
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                {{-- Tambahkan kelas 'active' jika route saat ini adalah bagian dari 'users' --}}
                <a href="{{ route('users.index') }}" class="nav-link {{ request()->is('users*') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Users</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('produks.index') }}" class="nav-link {{ request()->is('produks*') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Produk</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('providers.index') }}" class="nav-link {{ request()->is('providers*') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Provider</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('transaksis.index') }}" class="nav-link {{ request()->is('transaksis*') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Transaksi</p>
                </a>
              </li>
            </ul>
          </li>

        </ul>
      </nav>
      </div>
    </aside>
