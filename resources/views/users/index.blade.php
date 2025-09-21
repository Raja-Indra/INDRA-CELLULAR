<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.head')
    <title>Indra Cellular | Data User</title>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    @include('layouts.preloader')
    @include('layouts.navigation')
    @include('layouts.sidebar')

    <div class="content-wrapper">
        <section class="content-header">

        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header custom-header-gradient">
                                <h3 class="card-title">Daftar Pengguna Sistem</h3>
                                <div class="card-tools">
                                    {{-- Tombol diubah menjadi btn-light agar lebih kontras --}}
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createUserModal">
                                        <i class="fas fa-plus"></i> Tambah User
                                    </button>
                                </div>
                            </div>
                            {{-- ================================================================ --}}

                            <div class="card-body">
                                @include('layouts.notifikasi')
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>No. Telepon</th>
                                            <th>Role</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone }}</td>

                                            <td class="text-center">
                                                {{-- Loop semua role milik user, jika tidak ada, tampilkan pesan --}}
                                                @forelse ($user->roles as $role)
                                                    <span class="badge {{ $role->name == 'admin' ? 'badge-success' : 'badge-info' }}">
                                                        {{ $role->name }}
                                                    </span>
                                                @empty
                                                    <span class="badge badge-secondary">No Role</span>
                                                @endforelse
                                            </td>
                                            <td class="text-center">
                                                {{-- Tombol Edit --}}
                                                <a href="#" class="btn btn-warning btn-sm btn-edit"
                                                data-id="{{ $user->id }}"
                                                data-name="{{ $user->name }}"
                                                data-email="{{ $user->email }}"
                                                data-phone="{{ $user->phone }}"
                                                data-role="{{ $user->roles->pluck('name')->implode(', ') }}">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>

                                                {{-- Form untuk Aktifkan/Nonaktifkan --}}
                                                <form action="{{ route('users.toggleStatus', $user->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('PATCH')
                                                    @if ($user->is_active)
                                                        {{-- Jika user aktif, tampilkan tombol untuk menonaktifkan --}}
                                                        <button type="submit" class="btn btn-secondary btn-sm" onclick="return confirm('Anda yakin ingin menonaktifkan user ini?')">
                                                            <i class="fas fa-toggle-off"></i> Nonaktifkan
                                                        </button>
                                                    @else
                                                        {{-- Jika user nonaktif, tampilkan tombol untuk mengaktifkan --}}
                                                        <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Anda yakin ingin mengaktifkan user ini?')">
                                                            <i class="fas fa-toggle-on"></i> Aktifkan
                                                        </button>
                                                    @endif
                                                </form>

                                                {{-- Form Hapus --}}
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                {{-- MODAL LIHAT DETAIL USER --}}
                                <div class="modal fade" id="viewUserModal" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Detail Data User</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>ID User</label>
                                                    <input type="text" class="form-control" id="view_id" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Nama Lengkap</label>
                                                    <input type="text" class="form-control" id="view_name" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="email" class="form-control" id="view_email" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>No. Telp</label>
                                                    <input type="tel" class="form-control" id="view_phone" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Role</label>
                                                    <input type="text" class="form-control" id="view_role" readonly>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- ============== MODAL TAMBAH USER BARU ================= --}}
                                {{-- ======================================================= --}}
                                <div class="modal fade" id="createUserModal" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Tambah User Baru</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <form action="{{ route('users.store') }}" id="createForm" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    {{-- Nama, Email, No. Telp, Password Fields (tidak berubah) --}}
                                                    <div class="form-group">
                                                        <label for="name">Nama Lengkap</label>
                                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" required value="{{ old('name') }}">
                                                        @error('name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email">Email</label>
                                                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" required value="{{ old('email') }}">
                                                        @error('email')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="phone">No. Telp</label>
                                                        <input type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}">
                                                        @error('phone')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password">Password</label>
                                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required minlength="8">
                                                        <small class="form-text text-muted">Minimal 8 karakter.</small>
                                                        @error('password')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                                    </div>

                                                    {{-- BAGIAN ROLE YANG DIPERBARUI --}}
                                                    <div class="form-group">
                                                        <label>Roles</label>
                                                        <div class="flex-wrap d-flex">
                                                            @foreach ($roles as $role)
                                                                <div class="mr-3 form-check">
                                                                    <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->name }}" id="create_role_{{ $role->id }}">
                                                                    <label class="form-check-label" for="create_role_{{ $role->id }}">
                                                                        {{ $role->name }}
                                                                    </label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        @error('roles')<span class="mt-1 text-danger d-block"><strong>{{ $message }}</strong></span>@enderror
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                                {{-- ======================================================= --}}
                                {{-- ================= MODAL EDIT USER ===================== --}}
                                {{-- ======================================================= --}}
                                <div class="modal fade" id="editUserModal" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Data User</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <form id="editForm" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    {{-- Nama, Email, No. Telp Fields (tidak berubah) --}}
                                                    <div class="form-group">
                                                        <label for="edit_name">Nama Lengkap</label>
                                                        <input type="text" class="form-control" id="edit_name" name="name" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="edit_email">Email</label>
                                                        <input type="email" class="form-control" id="edit_email" name="email" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="edit_phone">No. Telp</label>
                                                        <input type="tel" class="form-control" id="edit_phone" name="phone">
                                                    </div>

                                                    {{-- BAGIAN ROLE YANG DIPERBARUI --}}
                                                    <div class="form-group">
                                                        <label>Roles</label>
                                                        <div id="edit_roles_container" class="flex-wrap d-flex">
                                                            {{-- Checkbox akan di-generate oleh JavaScript, tapi strukturnya seperti ini --}}
                                                            @foreach ($roles as $role)
                                                                <div class="mr-3 form-check">
                                                                    <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->name }}" id="edit_role_{{ $role->id }}">
                                                                    <label class="form-check-label" for="edit_role_{{ $role->id }}">
                                                                        {{ $role->name }}
                                                                    </label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="edit_password">Password Baru</label>
                                                        <input type="password" class="form-control" name="password" minlength="8">
                                                        <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah password.</small>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <footer class="main-footer">@include('layouts.footer')</footer>
</div>

    @include('layouts.script')
    @stack('scripts')

</body>
</html>
