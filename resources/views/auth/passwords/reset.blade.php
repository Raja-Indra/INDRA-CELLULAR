<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.head')
    <title>Indra Cellular | Reset Password</title>
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>Indra</b>Cellular</a>
    </div>
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Silakan masukkan password baru Anda.</p>
            <form action="{{ route('password.update') }}" method="post">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="mb-3 input-group">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                    </div>
                    @error('email')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="mb-3 input-group">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="Password Baru">
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-lock"></span></div>
                    </div>
                     @error('password')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="mb-3 input-group">
                    <input type="password" class="form-control" name="password_confirmation" required placeholder="Konfirmasi Password">
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-lock"></span></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
                    </div>
                </div>
            </form>

            <p class="mt-3 mb-1">
                <a href="{{ route('login') }}">Kembali ke Login</a>
            </p>
        </div>
    </div>
</div>

{{-- Script yang dibutuhkan --}}
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
</body>
</html>
