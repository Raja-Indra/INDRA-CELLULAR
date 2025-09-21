@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header custom-header-gradient">
                        <h3 class="card-title">Catatan Hutang</h3>
                    <div class="card-tools">
                        {{-- Tombol diubah menjadi btn-light agar lebih kontras --}}
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createCatatanHutangModal">
                            <i class="fas fa-plus"></i> Catatan Hutang
                        </button>
                    </div>
                    </div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Nomor HP</th>
                                    <th>Alamat</th>
                                    <th>Keterangan</th>
                                    <th>Nominal Hutang</th>
                                    <th width="200px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($catatanHutangs as $catatanHutang)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $catatanHutang->nama_pelanggan }}</td>
                                    <td>{{ $catatanHutang->nomor_hp }}</td>
                                    <td>{{ $catatanHutang->alamat }}</td>
                                    <td>{{ $catatanHutang->keterangan }}</td>
                                    <td>Rp {{ number_format($catatanHutang->nominal_hutang, 2, ',', '.') }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editCatatanHutangModal{{ $catatanHutang->id }}">
                                            Edit
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteCatatanHutangModal{{ $catatanHutang->id }}">
                                            Hapus
                                        </button>
                                    </td>
                                </tr>

                                <!-- Edit Catatan Hutang Modal -->
                                <div class="modal fade" id="editCatatanHutangModal{{ $catatanHutang->id }}" tabindex="-1" role="dialog" aria-labelledby="editCatatanHutangModalLabel{{ $catatanHutang->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editCatatanHutangModalLabel{{ $catatanHutang->id }}">Edit Catatan Hutang</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('catatan_hutangs.update', $catatanHutang->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="nama_pelanggan">Nama Pelanggan</label>
                                                        <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" value="{{ $catatanHutang->nama_pelanggan }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nomor_hp">Nomor HP</label>
                                                        <input type="text" class="form-control" id="nomor_hp" name="nomor_hp" value="{{ $catatanHutang->nomor_hp }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="alamat">Alamat</label>
                                                        <textarea class="form-control" id="alamat" name="alamat">{{ $catatanHutang->alamat }}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="keterangan">Keterangan</label>
                                                        <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nominal_hutang">Nominal Hutang</label>
                                                        <input type="number" step="0.01" class="form-control" id="nominal_hutang" name="nominal_hutang" value="{{ $catatanHutang->nominal_hutang }}" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Delete Catatan Hutang Modal -->
                            <div class="modal fade" id="deleteCatatanHutangModal{{ $catatanHutang->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteCatatanHutangModalLabel{{ $catatanHutang->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteCatatanHutangModalLabel{{ $catatanHutang->id }}">Hapus Catatan Hutang</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin ingin menghapus catatan hutang untuk <strong>{{ $catatanHutang->nama_pelanggan }}</strong>?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <form action="{{ route('catatan_hutangs.destroy', $catatanHutang->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                        </table>

                        {{ $catatanHutangs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- Create Catatan Hutang Modal -->
<div class="modal fade" id="createCatatanHutangModal" tabindex="-1" role="dialog" aria-labelledby="createCatatanHutangModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createCatatanHutangModalLabel">Tambah Catatan Hutang Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('catatan_hutangs.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_pelanggan">Nama Pelanggan</label>
                        <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" required>
                    </div>
                    <div class="form-group">
                        <label for="nomor_hp">Nomor HP</label>
                        <input type="text" class="form-control" id="nomor_hp" name="nomor_hp">
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="nominal_hutang">Nominal Hutang</label>
                        <input type="number" step="0.01" class="form-control" id="nominal_hutang" name="nominal_hutang" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
