<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.head')
    <title>Indra Cellular | Data User</title>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

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
                                            <td class="text-center">
                                                @if($user->role == 'admin')
                                                    <span class="badge badge-success">{{ ucfirst($user->role) }}</span>
                                                @else
                                                    <span class="badge badge-info">{{ ucfirst($user->role) }}</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="#" class="btn btn-warning btn-sm btn-edit"
                                                    data-id="{{ $user->id }}"
                                                    data-name="{{ $user->name }}"
                                                    data-email="{{ $user->email }}"
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

                                {{-- MODAL TAMBAH USER --}}
                                <div class="modal fade" id="createUserModal" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Tambah User Baru</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <form id="createForm" action="{{ route('users.store') }}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="name">Nama Lengkap</label>
                                                        <input type="text" class="form-control" name="name" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email">Email</label>
                                                        <input type="email" class="form-control" name="email" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password">Password</label>
                                                        <input type="password" class="form-control" name="password" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="role">Role</label>
                                                        <select class="form-control" name="role" required>
                                                            <option value="" disabled selected>Pilih Role</option>
                                                            <option value="admin">Admin</option>
                                                            {{-- DIUBAH DARI KASIR MENJADI KARYAWAN --}}
                                                            <option value="karyawan">Karyawan</option>
                                                        </select>
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
                                            <form id="editForm" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>ID User</label>
                                                        <input type="text" class="form-control" id="edit_user_id_display" disabled>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="edit_name">Nama Lengkap</label>
                                                        <input type="text" class="form-control" id="edit_name" name="name" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="edit_email">Email</label>
                                                        <input type="email" class="form-control" id="edit_email" name="email" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="edit_role">Role</label>
                                                        <select class="form-control" id="edit_role" name="role" required>
                                                            <option value="admin">Admin</option>
                                                            {{-- DIUBAH DARI KASIR MENJADI KARYAWAN --}}
                                                            <option value="karyawan">Karyawan</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password">Password Baru</label>
                                                        <input type="password" class="form-control" name="password">
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
