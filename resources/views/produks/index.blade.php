<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.head')
    <title>Indra Cellular | Produk</title>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    @include('layouts.preloader')
    @include('layouts.navigation')
    @include('layouts.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="mb-2 row">
                <div class="col-sm-6">
                    <h1>Daftar Produk</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('layouts.app') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Produk</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Produk</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
                                    <i class="fas fa-plus"></i> Tambah Produk
                                </button>

                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @include('layouts.notifikasi')
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th>ID</th>
                                        <th>Nama Produk</th>
                                        <th>Provider</th>
                                        <th>Harga Modal</th>
                                        <th>Harga Jual</th>
                                        <th>Stok</th>
                                        <th>Jenis</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pk as $produk)
                                    <tr>
                                        <td class="text-center">{{ $produk->id }}</td>
                                        <td class="text-center">{{ $produk->nama_produk }}</td>
                                        <td class="text-center">{{ $produk->provider->nama_provider }}</td>
                                        <td class="text-center">{{ number_format($produk->harga_modal, 2) }}</td>
                                        <td class="text-center">{{ number_format($produk->harga_jual, 2) }}</td>
                                        <td class="text-center">{{ $produk->stok }}</td>
                                        <td class="text-center">{{ ucfirst($produk->jenis) }}</td>
                                        <td class="text-center">
                                            <a href="#" class="btn btn-info btn-sm"
                                                onclick="tampilkanDetailProduk('{{ $produk->id }}', '{{ $produk->provider_id }}', '{{ $produk->nama_produk }}', '{{ $produk->harga_modal }}', '{{ $produk->harga_jual }}', '{{ $produk->stok }}', '{{ $produk->jenis }}')">
                                                    <i class="fas fa-eye"></i> Lihat
                                                </a>

                                            <a href="#" class="btn btn-warning btn-sm btn-edit"
                                                data-id="{{ $produk->id }}"
                                                data-provider_id="{{ $produk->provider_id }}"
                                                data-nama_produk="{{ $produk->nama_produk }}"
                                                data-harga_modal="{{ $produk->harga_modal }}"
                                                data-harga_jual="{{ $produk->harga_jual }}"
                                                data-stok="{{ $produk->stok }}"
                                                data-jenis="{{ $produk->jenis }}">
                                                    <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <form action="{{ route('produks.destroy', $produk->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- Modal Tambah Produk -->
                            <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="createLabel">Tambah Produk</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form id="createForm" action="{{ route('produks.store') }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="jenis">Jenis Produk</label>
                                                    <select class="form-control" id="jenis" name="jenis" required>
                                                        <option value="" disabled selected>Pilih Jenis</option>
                                                        <option value="Pulsa">Pulsa</option>
                                                        <option value="Paket Data">Paket Data</option>
                                                        <option value="Voucher">Voucher</option>
                                                        <option value="Voucher">Saldo</option>

                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="provider_id">Provider</label>
                                                    <select class="form-control" id="provider_id" name="provider_id" required>
                                                        <option value="" disabled selected>Pilih Provider</option>
                                                        @foreach($pr as $provider)
                                                            <option value="{{ $provider->id }}">{{ $provider->nama_provider }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="nama_produk">Nama Produk</label>
                                                    <input type="text" class="form-control" id="nama_produk" name="nama_produk" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="harga">Harga Modal</label>
                                                    <input type="number" class="form-control" id="harga_modal" name="harga_modal" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="harga">Harga Jual</label>
                                                    <input type="number" class="form-control" id="harga_jual" name="harga_jual" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Perkiraan Keuntungan</label>
                                                    <input type="text" class="form-control" id="create_keuntungan" disabled style="font-weight: bold; color: green;" placeholder="Rp 0">
                                                </div>
                                                <div class="form-group">
                                                    <label for="stok">Stok</label>
                                                    <input type="number" class="form-control" id="stok" name="stok" required>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-save"></i> Simpan
                                                </button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    <i class="fas fa-times"></i> Batal
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            {{-- Modal Lihat Produk --}}
                            <div class="modal fade" id="viewProdukModal" tabindex="-1" aria-labelledby="viewProdukLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="viewProdukLabel">Detail Produk</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="view_produk_id">ID Produk</label>
                                                <input type="text" class="form-control" id="view_produk_id" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="view_provider">Provider</label>
                                                <input type="text" class="form-control" id="view_provider" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="view_nama_produk">Nama Produk</label>
                                                <input type="text" class="form-control" id="view_nama_produk" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="view_harga">Harga Modal</label>
                                                <input type="text" class="form-control" id="view_harga_modal" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="view_harga">Harga Jual</label>
                                                <input type="text" class="form-control" id="view_harga_jual" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="view_keuntungan">Keuntungan</label>
                                                <input type="text" class="form-control" id="view_keuntungan" disabled style="font-weight: bold; color: green;">
                                            </div>
                                            <div class="form-group">
                                                <label for="view_stok">Stok</label>
                                                <input type="text" class="form-control" id="view_stok" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="view_jenis">Jenis</label>
                                                <input type="text" class="form-control" id="view_jenis" disabled>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                <i class="fas fa-times"></i> Tutup
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Edit Produk -->
                            <div class="modal fade" id="editProdukModal" tabindex="-1" aria-labelledby="editProdukModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editProdukModalLabel">Edit Produk</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="editForm" action="{{ route('produks.update', $produk->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-3">
                                                    <label for="produkId">ID Produk</label>
                                                    <input type="text" class="form-control" id="produkId" disabled>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="providerId" class="form-label">Provider</label>
                                                    <select class="form-control" id="providerId" name="provider_id" required>
                                                        <option value="" disabled>Pilih Provider</option>
                                                        @foreach($pr as $provider)
                                                            <option value="{{ $provider->id }}">{{ $provider->nama_provider }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="namaProduk" class="form-label">Nama Produk</label>
                                                    <input type="text" class="form-control" id="namaProduk" name="nama_produk" value="{{ $produk->nama_produk }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="hargaModalProduk" class="form-label">Harga Modal</label>
                                                    <input type="number" class="form-control" id="hargaModalProduk" name="harga_modal" value="{{ $produk->harga_modal }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="hargaJualProduk" class="form-label">Harga Jual</label>
                                                    <input type="number" class="form-control" id="hargaJualProduk" name="harga_jual" value="{{ $produk->harga_jual }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Perkiraan Keuntungan</label>
                                                    <input type="text" class="form-control" id="edit_keuntungan" disabled style="font-weight: bold; color: green;" placeholder="Rp 0">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="stokProduk" class="form-label">Stok</label>
                                                    <input type="number" class="form-control" id="stokProduk" name="stok" value="{{ $produk->stok }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="jenisProduk">Jenis Produk</label>
                                                    <select class="form-control" id="jenisProduk" name="jenis" value="{{ $produk->jenis }}" required>
                                                        <option value="" disabled selected>Pilih Jenis</option>
                                                        <option value="Pulsa">Pulsa</option>
                                                        <option value="Paket Data">Paket Data</option>
                                                        <option value="Voucher">Voucher</option>
                                                    </select>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="fas fa-save"></i> Simpan
                                                    </button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                        <i class="fas fa-times"></i> Batal
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
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
