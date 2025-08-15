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
            <div class="container-fluid">
                <div class="mb-2 row">
                    <div class="col-sm-6">
                        <h1>Data User</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{-- route('layouts.app') --}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">User</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Daftar Pengguna Sistem</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createUserModal">
                                        <i class="fas fa-plus"></i> Tambah User
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                @include('layouts.notifikasi')
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr class="text-center">
                                            <th>ID User</th>
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
                                            <td class="text-center">{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td class="text-center">
                                                @if($user->role == 'admin')
                                                    <span class="badge badge-success">{{ ucfirst($user->role) }}</span>
                                                @else
                                                    <span class="badge badge-info">{{ ucfirst($user->role) }}</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="#" class="btn btn-info btn-sm btn-view"
                                                    data-id="{{ $user->id }}"
                                                    data-name="{{ $user->name }}"
                                                    data-email="{{ $user->email }}"
                                                    data-phone="{{ $user->phone }}"
                                                    data-role="{{ $user->role }}">
                                                    <i class="fas fa-eye"></i> Lihat
                                                </a>
                                                <a href="#" class="btn btn-warning btn-sm btn-edit"
                                                    data-id="{{ $user->id }}"
                                                    data-name="{{ $user->name }}"
                                                    data-email="{{ $user->email }}"
                                                    data-phone="{{ $user->phone }}"
                                                    data-role="{{ $user->role }}">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
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
                                {{-- MODAL TAMBAH USER --}}
                                <div class="modal fade" id="createUserModal" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Tambah User Baru</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <form id="createForm" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="name">Nama Lengkap</label>
                                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" required value="{{ old('name') }}">
                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" required value="{{ old('email') }}">
                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="phone">No. Telp</label>
                                                    <input type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" required
                                                        minlength="10" maxlength="15" pattern="\d{10,15}" title="Nomor telepon harus 10-15 digit angka." value="{{ old('phone') }}">
                                                    @error('phone')
                                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="password">Password</label>
                                                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required minlength="8">
                                                    <small class="form-text text-muted">Minimal 8 karakter.</small>
                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="role">Role</label>
                                                    <select class="form-control @error('role') is-invalid @enderror" name="role" required>
                                                        <option value="" disabled selected>Pilih Role</option>
                                                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                                        <option value="karyawan" {{ old('role') == 'karyawan' ? 'selected' : '' }}>Karyawan</option>
                                                    </select>
                                                    @error('role')
                                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                    @enderror
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

                                {{-- MODAL EDIT USER --}}
                                <div class="modal fade" id="editUserModal" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Data User</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <form id="editForm" method="POST" >
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">

                                                    {{-- ... field ID User dan Nama Lengkap ... --}}
                                                    <div class="form-group">
                                                        <label for="edit_name">Nama Lengkap</label>
                                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="edit_name" name="name" required>
                                                        @error('name')
                                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>

                                                    {{-- EMAIL --}}
                                                    <div class="form-group">
                                                        <label for="edit_email">Email</label>
                                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="edit_email" name="email" required>
                                                        @error('email')
                                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>

                                                    {{-- NO. TELP --}}
                                                    <div class="form-group">
                                                        <label for="edit_phone">No. Telp</label>
                                                        <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="edit_phone" name="phone" required
                                                            minlength="10" maxlength="15" pattern="\d{10,15}" title="Nomor telepon harus 10-15 digit angka.">
                                                        @error('phone')
                                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>

                                                    {{-- ROLE --}}
                                                    <div class="form-group">
                                                        <label for="edit_role">Role</label>
                                                        <select class="form-control" id="edit_role" name="role" required>
                                                            <option value="admin">Admin</option>
                                                            <option value="karyawan">Karyawan</option>
                                                        </select>
                                                    </div>

                                                    {{-- PASSWORD BARU --}}
                                                    <div class="form-group">
                                                        <label for="password">Password Baru</label>
                                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" minlength="8">
                                                        {{-- Teks bantuan diperbarui --}}
                                                        <small class="form-text text-muted">Minimal 8 karakter. Kosongkan jika tidak ingin mengubah password.</small>
                                                        @error('password')
                                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
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
