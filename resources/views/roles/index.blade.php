<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.head')
    <title>Indra Cellular | Role & Izin</title>
    <style>
        .permission-group {
            margin-bottom: 1rem;
        }
        .permission-group-title {
            font-size: 1rem; /* Slightly smaller font size */
            font-weight: 500; /* Normal font-weight, not bold */
            border-bottom: 1px solid #dee2e6;
            padding-bottom: 0.5rem;
            margin-bottom: 0.75rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .permissions-list {
            display: grid;
            grid-template-columns: repeat(2, 1fr); /* 2-column layout */
            gap: 0.5rem; /* Space between items */
            max-height: 220px;
            overflow-y: auto;
            padding: 0.5rem;
        }
        .permissions-list .custom-control {
            padding-left: 1.75rem; /* Adjust padding for alignment */
        }
        .permissions-list .custom-control-label {
            font-weight: 400 !important; /* Force override to ensure label text is not bold */
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
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header custom-header-gradient">
                                <h3 class="card-title">Daftar Role Sistem</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createRoleModal">
                                        <i class="fas fa-plus"></i> Tambah Role
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                @include('layouts.notifikasi')
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Nama Role</th>
                                            <th>Deskripsi</th>
                                            <th>Izin</th>
                                            <th>User</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($roles as $role)
                                        <tr>
                                            <td>{{ $role->name }}</td>
                                            <td>{{ $role->description }}</td>
                                            <td class="text-center">
                                                <span class="badge badge-primary">{{ $role->permissions->count() }} Izin</span>
                                            </td>
                                            <td>{{ $role->users->count() }}</td>
                                            <td class="text-center">
                                                <button class="btn btn-warning btn-sm btn-edit-role"
                                                   data-id="{{ $role->id }}"
                                                   data-name="{{ $role->name }}"
                                                   data-description="{{ $role->description }}"
                                                   data-permissions='{{ json_encode($role->permissions->pluck("name")) }}'>
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>

                                                <form action="{{ route('roles.toggleStatus', $role) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    @if ($role->is_active)
                                                        <button type="submit" class="btn btn-secondary btn-sm" onclick="return confirm('Anda yakin ingin menonaktifkan role ini?')">
                                                            <i class="fas fa-toggle-off"></i> Nonaktifkan
                                                        </button>
                                                    @else
                                                        <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Anda yakin ingin mengaktifkan role ini?')">
                                                            <i class="fas fa-toggle-on"></i> Aktifkan
                                                        </button>
                                                    @endif
                                                </form>

                                                <a href="#" class="btn btn-danger btn-sm btn-delete-role" data-id="{{ $role->id }}" data-name="{{ $role->name }}"><i class="fas fa-trash"></i> Hapus</a>
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

    @php
        $groupedPermissions = [];
        foreach ($permissions as $permission) {
            $group = explode('-', $permission->name)[0];
            $groupedPermissions[$group][] = $permission;
        }
    @endphp

    {{-- Modal Edit Role --}}
    <div class="modal fade" id="editRoleModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Role: <span id="edit_role_name_title"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form id="editRoleForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit_name">Nama Role</label>
                            <input type="text" class="form-control" id="edit_name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_description">Deskripsi</label>
                            <input type="text" class="form-control" id="edit_description" name="description">
                        </div>
                        <div class="form-group">
                            <label>Izin</label>
                            @foreach ($groupedPermissions as $group => $groupPermissions)
                                <div class="permission-group">
                                    <div class="permission-group-title">
                                        <span>{{ ucfirst($group) }}</span>
                                        <button type="button" class="btn btn-xs btn-outline-primary check-all" data-group="edit-{{ $group }}">Pilih Semua</button>
                                    </div>
                                    <div class="permissions-list">
                                        @foreach ($groupPermissions as $permission)
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input permission-checkbox" type="checkbox" name="permissions[]" id="edit_perm_{{ $permission->id }}" value="{{ $permission->name }}" data-group="edit-{{ $group }}">
                                                <label class="custom-control-label" for="edit_perm_{{ $permission->id }}">{{ $permission->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
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

    {{-- Modal Tambah Role --}}
    <div class="modal fade" id="createRoleModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Role Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('roles.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Nama Role</label>
                            <input type="text" class="form-control" id="name" name="name" required placeholder="e.g., admin, kasir">
                        </div>
                        <div class="form-group">
                            <label for="description">Deskripsi</label>
                            <input type="text" class="form-control" id="description" name="description" placeholder="Deskripsi singkat role">
                        </div>
                        <div class="form-group">
                            <label>Izin</label>
                             @foreach ($groupedPermissions as $group => $groupPermissions)
                                <div class="permission-group">
                                    <div class="permission-group-title">
                                        <span>{{ ucfirst($group) }}</span>
                                        <button type="button" class="btn btn-xs btn-outline-primary check-all" data-group="create-{{ $group }}">Pilih Semua</button>
                                    </div>
                                    <div class="permissions-list">
                                        @foreach ($groupPermissions as $permission)
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input permission-checkbox" type="checkbox" name="permissions[]" id="create_perm_{{ $permission->id }}" value="{{ $permission->name }}" data-group="create-{{ $group }}">
                                                <label class="custom-control-label" for="create_perm_{{ $permission->id }}">{{ $permission->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
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

    <footer class="main-footer">@include('layouts.footer')</footer>
</div>

@include('layouts.script')

<script>
    $(document).ready(function() {
        // URL Templates
        const updateUrlTemplate = "{{ route('roles.update', ['role' => 'PLACEHOLDER']) }}";
        const destroyUrlTemplate = "{{ route('roles.destroy', ['role' => 'PLACEHOLDER']) }}";

        // Script untuk modal edit
        $('.btn-edit-role').on('click', function(e) {
            e.preventDefault();

            var roleId = $(this).data('id');
            var roleName = $(this).data('name');
            var roleDescription = $(this).data('description');
            var rolePermissions = $(this).data('permissions');

            // Set action form
            $('#editRoleForm').attr('action', updateUrlTemplate.replace('PLACEHOLDER', roleId));

            // Set data di form
            $('#edit_role_name_title').text(roleName);
            $('#edit_name').val(roleName);
            $('#edit_description').val(roleDescription);

            // Uncheck semua permission dulu
            $('#editRoleForm input[type=checkbox]').prop('checked', false);

            // Check permission yang dimiliki role
            if (rolePermissions) {
                rolePermissions.forEach(function(permission) {
                    $('#editRoleForm input[value="' + permission + '"]').prop('checked', true);
                });
            }

            // Tampilkan modal
            $('#editRoleModal').modal('show');
        });

        // Script untuk hapus role
        $('.btn-delete-role').on('click', function(e) {
            e.preventDefault();
            var roleId = $(this).data('id');
            var roleName = $(this).data('name');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            Swal.fire({
                title: 'Anda yakin ingin menghapus role ' + roleName + '?',
                text: "User yang memiliki role ini akan kehilangan hak aksesnya!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    var form = document.createElement('form');
                    form.action = destroyUrlTemplate.replace('PLACEHOLDER', roleId);
                    form.method = 'POST';

                    var methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'DELETE';
                    form.appendChild(methodInput);

                    var tokenInput = document.createElement('input');
                    tokenInput.type = 'hidden';
                    tokenInput.name = '_token';
                    tokenInput.value = csrfToken;
                    form.appendChild(tokenInput);

                    document.body.appendChild(form);
                    form.submit();
                }
            });
        });

        // Script untuk check-all button
        document.querySelectorAll('.check-all').forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                const group = this.getAttribute('data-group');
                const checkboxes = document.querySelectorAll(`.permission-checkbox[data-group="${group}"]`);
                const allChecked = Array.from(checkboxes).every(checkbox => checkbox.checked);

                checkboxes.forEach(checkbox => {
                    checkbox.checked = !allChecked;
                });

                this.textContent = allChecked ? 'Pilih Semua' : 'Batal Pilih Semua';
            });
        });
    });
</script>

</body>
</html>
