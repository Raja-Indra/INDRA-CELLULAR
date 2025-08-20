<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.head')
    <title>Indra Cellular | Transaksi</title>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    @include('layouts.preloader')
    @include('layouts.navigation')
    @include('layouts.sidebar')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <h1>Daftar Transaksi</h1>
                {{-- Breadcrumb --}}
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Daftar Transaksi</h3>
                                <div class="card-tools">
                                    {{-- Tombol ini sekarang membuka modal, bukan link --}}
                                    <button type="button" class="btn btn-primary btn-create" data-toggle="modal" data-target="#createTransaksiModal">
                                        <i class="fas fa-plus"></i> Tambah Transaksi
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                @include('layouts.notifikasi')
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Waktu</th>
                                            <th>User</th>
                                            <th>Produk</th>
                                            <th>Nomor Pelanggan</th>
                                            <th>Total Harga</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($t as $transaksi)
                                        <tr>
                                            <td>{{ $transaksi->id }}</td>
                                            <td>{{ $transaksi->created_at->format('d M Y, H:i') }}</td>
                                            <td>{{ $transaksi->user->name }}</td>
                                            <td>
                                                {{ $transaksi->produk->nama_produk ?? $transaksi->produk->provider->nama_provider . ' ' . number_format($transaksi->produk->stok, 0) }}
                                            </td>
                                            <td>{{ $transaksi->nomor_pelanggan }}</td>
                                            <td>Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
                                            <td>
                                                @if($transaksi->status == 'pending') <span class="badge badge-warning">Pending</span>
                                                @elseif($transaksi->status == 'success') <span class="badge badge-success">Success</span>
                                                @else <span class="badge badge-danger">Failed</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{-- Tombol Lihat dan Edit sekarang memicu JavaScript --}}
                                                <a href="#" class="btn btn-info btn-sm btn-view" data-transaksi='{{ json_encode($transaksi) }}'>
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="#" class="btn btn-warning btn-sm btn-edit" data-transaksi='{{ json_encode($transaksi) }}'>
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('transaksis.destroy', $transaksi->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus transaksi ini?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @include('layouts.footer')
</div>

{{-- MODAL TAMBAH TRANSAKSI --}}
<div class="modal fade" id="createTransaksiModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Transaksi Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form id="createForm" action="{{ route('transaksis.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    {{-- Form Tambah Transaksi (sama seperti create.blade.php) --}}
                    <div class="form-group">
                        <label for="create_user_id">User (Karyawan)</label>
                        <select name="user_id" id="create_user_id" class="form-control @error('user_id') is-invalid @enderror" required>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                         @error('user_id')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="create_produk_id">Produk</label>
                        <select name="produk_id" id="create_produk_id" class="form-control @error('produk_id') is-invalid @enderror" required>
                            <option value="" data-harga="0">Pilih Produk</option>
                            @foreach($produks as $produk)
                                <option value="{{ $produk->id }}" data-harga="{{ $produk->harga_jual }}">{{ $produk->nama_produk ?? $produk->provider->nama_provider . ' ' . number_format($produk->stok, 0) }}</option>
                            @endforeach
                        </select>
                         @error('produk_id')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="create_nomor_pelanggan">Nomor Pelanggan</label>
                        <input type="text" name="nomor_pelanggan" id="create_nomor_pelanggan" class="form-control @error('nomor_pelanggan') is-invalid @enderror" required value="{{ old('nomor_pelanggan') }}">
                        @error('nomor_pelanggan')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                    </div>
                     <div class="form-group">
                        <label>Total Harga</label>
                        <input type="text" id="create_display_harga" class="form-control" disabled style="font-weight: bold; color: blue;">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- MODAL EDIT TRANSAKSI (Kosong, akan diisi JS) --}}
<div class="modal fade" id="editTransaksiModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Status Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <p><strong>ID Transaksi:</strong> <span id="edit_id"></span></p>
                    <p><strong>Produk:</strong> <span id="edit_produk"></span></p>
                    <p><strong>Nomor Pelanggan:</strong> <span id="edit_nomor_pelanggan"></span></p>
                    <div class="form-group">
                        <label for="edit_status">Status</label>
                        <select name="status" id="edit_status" class="form-control" required>
                            <option value="pending">Pending</option>
                            <option value="success">Success</option>
                            <option value="failed">Failed</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Update Status</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('layouts.script')

</body>
</html>
