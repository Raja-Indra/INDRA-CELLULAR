<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.head')
    <title>Indra Cellular | Provider</title>
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
                                <h3 class="card-title">Data Provider</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
                                        <i class="fas fa-plus"></i> Tambah Provider
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                @include('layouts.notifikasi')
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr class="text-center">
                                            <th style="width: 5%;">#</th>
                                            <th style="width: 15%;">ID</th>
                                            <th>Nama Provider</th>
                                            <th style="width: 20%;">Kategori</th> {{-- KOLOM BARU --}}
                                            <th style="width: 20%;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pr as $provider)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">{{ $provider->id }}</td>
                                            <td>{{ $provider->nama_provider }}</td>
                                            <td class="text-center">{{ ucwords($provider->kategori) }}</td> {{-- DATA BARU --}}
                                            <td class="text-center">
                                                {{-- Tombol Aksi (data-kategori ditambahkan) --}}
                                                <a href="#" class="btn btn-info btn-sm btn-view"
                                                   data-id="{{ $provider->id }}"
                                                   data-nama="{{ $provider->nama_provider }}"
                                                   data-kategori="{{ $provider->kategori }}">
                                                    <i class="fas fa-eye"></i> Lihat
                                                </a>
                                                <a href="#" class="btn btn-warning btn-sm btn-edit"
                                                   data-id="{{ $provider->id }}"
                                                   data-nama="{{ $provider->nama_provider }}"
                                                   data-kategori="{{ $provider->kategori }}">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <form action="{{ route('providers.destroy', $provider->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus provider ini?')">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                {{-- ============================================= --}}
                                {{-- MODAL CREATE (dengan field Kategori) --}}
                                {{-- ============================================= --}}
                                <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="createLabel">Tambah Provider</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="createForm" action="{{ route('providers.store') }}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="nama_provider">Nama Provider</label>
                                                        <input type="text" class="form-control" id="nama_provider" name="nama_provider" required>
                                                    </div>
                                                    {{-- INPUT KATEGORI BARU --}}
                                                    <div class="form-group">
                                                        <label for="kategori">Kategori</label>
                                                        <select class="form-control" id="kategori" name="kategori" required>
                                                            <option value="" disabled selected>Pilih Kategori</option>
                                                            <option value="pulsa">Pulsa</option>
                                                            <option value="paket data">Paket Data</option>
                                                            <option value="voucher">Voucher</option>
                                                            <option value="saldo">Saldo</option>
                                                            <option value="aksesoris">Aksesoris</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                {{-- ============================================= --}}
                                {{-- MODAL LIHAT (dengan field Kategori) --}}
                                {{-- ============================================= --}}
                                <div class="modal fade" id="viewProviderModal" tabindex="-1" aria-labelledby="viewProviderLabel" aria-hidden="true">
                                     <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="viewProviderLabel">Detail Provider</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>ID Provider</label>
                                                    <input type="text" class="form-control" id="view_provider_id" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label>Nama Provider</label>
                                                    <input type="text" class="form-control" id="view_nama_provider" disabled>
                                                </div>
                                                {{-- TAMPILAN KATEGORI BARU --}}
                                                <div class="form-group">
                                                    <label>Kategori</label>
                                                    <input type="text" class="form-control" id="view_kategori" disabled>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- ============================================= --}}
                                {{-- MODAL EDIT (dengan field Kategori) --}}
                                {{-- ============================================= --}}
                                <div class="modal fade" id="editProviderModal" tabindex="-1" aria-labelledby="editProviderLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editProviderLabel">Edit Provider</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="editProviderForm" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                        <label for="providerId">ID Provider</label>
                                                        <input type="text" class="form-control" id="provider_id_display" disabled>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="edit_nama_provider">Nama Provider</label>
                                                        <input type="text" class="form-control" id="edit_nama_provider" name="nama_provider" required>
                                                    </div>
                                                    {{-- INPUT KATEGORI BARU --}}
                                                    <div class="form-group">
                                                        <label for="edit_kategori">Kategori</label>
                                                        <select class="form-control" id="edit_kategori" name="kategori" required>
                                                            <option value="" disabled>Pilih Kategori</option>
                                                            <option value="pulsa">Pulsa</option>
                                                            <option value="paket data">Paket Data</option>
                                                            <option value="voucher">Voucher</option>
                                                            <option value="saldo">Saldo</option>
                                                            <option value="aksesoris">Aksesoris</option>

                                                        </select>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Perubahan</button>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
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
                </div>
            </section>
        </div>

    <footer class="main-footer">
        @include('layouts.footer')
    </footer>
    <aside class="control-sidebar control-sidebar-dark">
    </aside>
</div>
    @include('layouts.script')
</body>
</html>
