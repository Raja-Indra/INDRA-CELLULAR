<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.head')
    <title>Indra Cellular | Lupa Password</title>
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>Indra</b>Cellular</a>
    </div>
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Anda lupa password? Di sini Anda bisa meminta link untuk reset password.</p>

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form action="{{ route('password.email') }}" method="post">
                @csrf
                <div class="mb-3 input-group">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="Masukkan Email Anda">
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                    </div>
                    @error('email')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Kirim Link Reset Password</button>
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
