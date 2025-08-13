<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.head')
    <title>Indra Cellular | Provider</title>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

    @include('layouts.navigation')
    @include('layouts.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="mb-2 row">
                <div class="col-sm-6">
                    <h1>Data Provider</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('layouts.app') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Provider</li>
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
                            <h3 class="card-title">Data Provider</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
                                    <i class="fas fa-plus"></i> Tambah Provider
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @include('layouts.notifikasi')
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th style="width: 4%;">#</th>
                                        <th style="width: 15%;">ID</th>
                                        <th style="width: 57%;">Nama Provider</th>
                                        <th style="width: 18;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pr as $provider)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">{{ $provider->id }}</td>
                                        <td>{{ $provider->nama_provider }}</td>
                                        <td class="text-center">

                                            <a href="#" class="btn btn-info btn-sm btn-view" data-id="{{ $provider->id }}" data-nama="{{ $provider->nama_provider }}">
                                                <i class="fas fa-eye"></i> Lihat
                                            </a>
                                            <a href="#" class="btn btn-warning btn-sm btn-edit" data-id="{{ $provider->id }}" data-nama="{{ $provider->nama_provider }}">
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

                            {{-- Modal Create --}}
                            <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createLabel" aria-hidden="true">
                                <div class="modal-dialog">
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
                                                <!-- Input Nama Provider -->
                                                <div class="form-group">
                                                    <label for="nama_provider">Nama Provider</label>
                                                    <input type="text" class="form-control" id="nama_provider" name="nama_provider" required>
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

                            <!-- Modal Lihat -->
                            <div class="modal fade" id="viewProviderModal" tabindex="-1" aria-labelledby="viewProviderLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="viewProviderLabel">Detail Provider</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="view_provider_id">ID Provider</label>
                                                <input type="text" class="form-control" id="view_provider_id" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="view_nama_provider">Nama Provider</label>
                                                <input type="text" class="form-control" id="view_nama_provider" disabled>
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

                            {{-- Modal Edit --}}
                            <div class="modal fade" id="editProviderModal" tabindex="-1" aria-labelledby="editProviderLabel" aria-hidden="true">
                                <div class="modal-dialog">
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

                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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
