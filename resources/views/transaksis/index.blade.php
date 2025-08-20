<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.head')
    <title>Indra Cellular | Transaksi</title>
    <style>
        #produk-cart a { color: #dc3545; }
        .produk-list ul { padding-left: 15px; margin-bottom: 0; }
        .summary-row {
            padding: 10px 0;
            border-top: 2px solid #dee2e6;
            margin-top: 10px;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    @include('layouts.preloader')
    @include('layouts.navigation')
    @include('layouts.sidebar')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <h1>Daftar & Tambah Transaksi</h1>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">

                @include('layouts.notifikasi')

                {{-- FORM TAMBAH TRANSAKSI BARU --}}
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-plus-circle"></i> Buat Transaksi Baru</h3>
                    </div>
                    <form action="{{ route('transaksis.store') }}" method="POST" id="createTransaksiForm">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                {{-- Kolom Kiri: Info Pelanggan & Produk --}}
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="user_id">User (Karyawan)</label>
                                        <select name="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror" required>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('user_id')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="nomor_pelanggan">Nomor Pelanggan</label>
                                        <input type="text" name="nomor_pelanggan" id="nomor_pelanggan" class="form-control @error('nomor_pelanggan') is-invalid @enderror" required value="{{ old('nomor_pelanggan') }}">
                                        @error('nomor_pelanggan')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                                    </div>
                                    <hr>
                                    <h5>Pilih Produk</h5>
                                    <div class="form-group">
                                        <label for="produk_select">Produk</label>
                                        <select id="produk_select" class="form-control">
                                            <option value="" data-harga="0" data-nama="">Pilih Produk untuk Ditambahkan</option>
                                            @foreach($produks as $produk)
                                                <option value="{{ $produk->id }}"
                                                        data-harga="{{ $produk->harga_jual }}"
                                                        data-nama="{{ $produk->provider->nama_provider }} - {{ $produk->nama_produk ?? 'Stok ' . number_format($produk->stok, 0) }}">
                                                    {{ $produk->provider->nama_provider }} - {{ $produk->nama_produk ?? 'Stok ' . number_format($produk->stok, 0) }} (Rp {{ number_format($produk->harga_jual) }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="button" id="tambah-produk-btn" class="btn btn-info btn-block"><i class="fas fa-plus"></i> Tambahkan ke Transaksi</button>
                                </div>

                                {{-- Kolom Kanan: Daftar Produk & Total --}}
                                <div class="col-md-7">
                                    <h5>Produk dalam Transaksi</h5>
                                    <table class="table table-sm table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Produk</th>
                                                <th style="width: 120px;">Harga</th>
                                                <th style="width: 50px;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="produk-cart"></tbody>
                                    </table>
                                    <hr>
                                    <div class="summary-row">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <h4 class="mb-0">Total Belanja:</h4>
                                            <h4 id="total-harga-display" class="mb-0" style="font-weight: bold; color: blue;">Rp 0</h4>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label for="uang_bayar" class="col-sm-4 col-form-label"><h5 class="mb-0">Uang Bayar:</h5></label>
                                            <div class="col-sm-8">
                                                <input type="number" id="uang_bayar" class="form-control form-control-lg" placeholder="Masukkan jumlah uang...">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mt-3" style="background-color: #f0f0f0; padding: 10px; border-radius: 5px;">
                                            <h4 class="mb-0">Kembalian:</h4>
                                            <h4 id="kembalian-display" class="mb-0" style="font-weight: bold; color: green;">Rp 0</h4>
                                        </div>
                                    </div>
                                    <input type="hidden" name="total_harga" id="total_harga_input" value="0">
                                </div>
                            </div>
                        </div>
                        <div class="text-right card-footer">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-save"></i> Simpan Transaksi
                            </button>
                        </div>
                    </form>
                </div>

                {{-- DAFTAR TRANSAKSI YANG SUDAH ADA --}}
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Riwayat Transaksi</h3>
                    </div>
                    <div class="card-body">
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
                                {{-- INI BAGIAN YANG SEBELUMNYA HILANG --}}
                                @foreach($transaksis as $transaksi)
                                <tr>
                                    <td>{{ $transaksi->id }}</td>
                                    <td>{{ $transaksi->created_at->format('d M Y, H:i') }}</td>
                                    <td>{{ $transaksi->user->name ?? 'N/A' }}</td>
                                    <td class="produk-list">
                                        @if($transaksi->produks->isNotEmpty())
                                            <ul>
                                            @foreach($transaksi->produks as $produk)
                                                <li>{{ $produk->provider->nama_provider }} - {{ $produk->nama_produk ?? 'Stok ' . number_format($produk->stok, 0) }}</li>
                                            @endforeach
                                            </ul>
                                        @else
                                            -
                                        @endif
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
                                        <form action="{{ route('transaksis.destroy', $transaksi->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus transaksi ini?')" title="Hapus">
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
        </section>
    </div>

    @include('layouts.footer')
</div>

@include('layouts.script')

{{-- JAVASCRIPT UNTUK FITUR TRANSAKSI --}}
<script>
$(document).ready(function() {
    let totalHarga = 0;
    let produkList = [];

    function formatRupiah(angka) {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(angka);
    }

    function hitungKembalian() {
        const uangBayar = parseFloat($('#uang_bayar').val()) || 0;
        const kembalian = uangBayar - totalHarga;
        $('#kembalian-display').text(kembalian >= 0 ? formatRupiah(kembalian) : 'Rp 0');
    }

    function updateTotal() {
        totalHarga = 0;
        produkList.forEach(item => {
            totalHarga += parseFloat(item.harga);
        });
        $('#total-harga-display').text(formatRupiah(totalHarga));
        $('#total_harga_input').val(totalHarga);
        hitungKembalian();
    }

    function renderCart() {
        $('#produk-cart').empty();
        produkList.forEach((item, index) => {
            let row = `
                <tr>
                    <td>
                        ${item.nama}
                        <input type="hidden" name="produks[${index}][id]" value="${item.id}">
                    </td>
                    <td>${formatRupiah(item.harga)}</td>
                    <td>
                        <a href="#" class="hapus-produk" data-index="${index}"><i class="fas fa-times-circle"></i></a>
                    </td>
                </tr>
            `;
            $('#produk-cart').append(row);
        });
        updateTotal();
    }

    $('#tambah-produk-btn').on('click', function() {
        const selectedOption = $('#produk_select').find('option:selected');
        const produkId = selectedOption.val();
        if (produkId) {
            produkList.push({
                id: produkId,
                nama: selectedOption.data('nama'),
                harga: selectedOption.data('harga')
            });
            renderCart();
            $('#produk_select').val('');
        } else {
            alert('Silakan pilih produk terlebih dahulu.');
        }
    });

    $(document).on('click', '.hapus-produk', function(e) {
        e.preventDefault();
        const indexToRemove = $(this).data('index');
        produkList.splice(indexToRemove, 1);
        renderCart();
    });

    $('#uang_bayar').on('keyup', hitungKembalian);
});
</script>

</body>
</html>
