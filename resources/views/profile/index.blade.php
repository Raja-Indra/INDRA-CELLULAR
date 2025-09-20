@extends('layouts.app')
@section('title', 'Profil Saya')

@section('content')
<section class="content-header">
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="card card-primary card-outline">
                    <div class="text-center card-body box-profile">
                        <img id="profile-preview" class="profile-user-img img-fluid img-circle"
                            src="{{ $user->profile_photo_path ? asset('storage/' . $user->profile_photo_path) : asset('dist/img/avatar5.png') }}"
                            alt="User profile picture" style="width: 128px; height: 128px; object-fit: cover;">

                        <h3 class="mt-3 text-center profile-username">{{ $user->name }}</h3>
                        <p class="text-center text-muted">{{ ucfirst($user->role) }}</p>

                        <ul class="mb-3 list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Email</b>
                                {{-- Menghapus class="float-right" dan mengubah tag <a> menjadi <p> --}}
                                <p class="mb-0 text-muted">{{ $user->email }}</p>
                            </li>
                            <li class="list-group-item">
                                <b>Bergabung Sejak</b>
                                {{-- Melakukan hal yang sama untuk item list kedua --}}
                                <p class="mb-0 text-muted">{{ $user->created_at->isoFormat('D MMMM YYYY') }}</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="p-2 card-header">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#info" data-toggle="tab"><i class="mr-1 fas fa-user-edit"></i> Informasi Akun</a></li>
                            <li class="nav-item"><a class="nav-link" href="#password" data-toggle="tab"><i class="mr-1 fas fa-key"></i> Ubah Password</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                <i class="mr-2 fas fa-check-circle"></i>{{ session('success') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form class="form-horizontal" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="tab-content">
                                <div class="active tab-pane" id="info">
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-3 col-form-label">Nama</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                </div>
                                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                                </div>
                                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="phone" class="col-sm-3 col-form-label">No. Telepon</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                </div>
                                                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="Contoh: 081234567890">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="photo" class="col-sm-3 col-form-label">Ganti Foto Profil</label>
                                        <div class="col-sm-9">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="photo" name="photo" accept="image/*">
                                                <label class="custom-file-label" for="photo">Pilih gambar...</label>
                                            </div>
                                            <small class="text-muted">Format: JPG, PNG. Maks: 2MB.</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="password">
                                    <p class="text-muted">Kosongkan jika Anda tidak ingin mengubah password.</p>
                                    <div class="form-group row">
                                        <label for="password" class="col-sm-3 col-form-label">Password Baru</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <input type="password" class="form-control" id="password1" name="password">
                                                <div class="input-group-append">
                                                    <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="password_confirmation" class="col-sm-3 col-form-label">Konfirmasi Password</label>
                                        <div class="col-sm-9">
                                           <div class="input-group">
                                               <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                                               <div class="input-group-append">
                                                   <button type="button" class="btn btn-outline-secondary" id="togglePasswordConfirmation">
                                                       <i class="fas fa-eye"></i>
                                                   </button>
                                               </div>
                                           </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3 form-group row">
                                <div class="offset-sm-3 col-sm-9">
                                    <button type="submit" class="btn btn-primary"><i class="mr-1 fas fa-save"></i> Simpan Perubahan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Skrip untuk pratinjau gambar
        const photoInput = document.getElementById('photo');
        const profilePreview = document.getElementById('profile-preview');
        const customFileLabel = document.querySelector('.custom-file-label');

        photoInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    profilePreview.src = e.target.result;
                }
                reader.readAsDataURL(file);
                customFileLabel.textContent = file.name;
            }
        });

          // Fungsi ini bisa digunakan ulang untuk setiap tombol password
        function setupPasswordToggle(toggleButtonId, passwordInputId) {
            const toggleButton = document.getElementById(toggleButtonId);
            const passwordInput = document.getElementById(passwordInputId);
            const icon = toggleButton.querySelector('i');

            // Jika elemen tidak ditemukan, hentikan fungsi
            if (!toggleButton || !passwordInput) {
                return;
            }

            toggleButton.addEventListener('click', function() {
                // Cek tipe input saat ini
                if (passwordInput.type === 'password') {
                    // Jika password, ubah menjadi teks
                    passwordInput.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    // Jika teks, ubah kembali menjadi password
                    passwordInput.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        }

        setupPasswordToggle('togglePassword', 'password1');
        setupPasswordToggle('togglePasswordConfirmation', 'password_confirmation');
    });
</script>
@endpush
