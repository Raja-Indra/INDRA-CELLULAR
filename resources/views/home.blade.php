@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="info-box" style="background: linear-gradient(50deg, #ff6456, #e85a4d); color: white;">
    <div class="info-box-content">
        <span class="info-box-number" style="font-size: 1.9rem;">
            Selamat datang kembali, <strong>{{ Auth::user()->name }}!</strong>
        </span>

        <span class="mt-1" style="font-size: 0.9rem; opacity: 0.85;">
            Inilah yang terjadi dengan sistem Anda hari ini.
        </span>

        <span id="current-date-display" style="font-size: 0.9rem; opacity: 0.85; margin-top: 6px; display: block;">
        </span>
    </div>

    <span class="info-box-icon"><i class="far fa-smile"></i></span>
</div>
                </div>
            </div>
         </div>
     </div>

    <section class="content">
        <div class="container-fluid">
         <div class="row">
    <div class="col-lg-4 col-md-6">
        <div class="info-box">
            <span class="info-box-icon bg-success"><i class="ion ion-stats-bars"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Jumlah Providers</span>
                <span class="info-box-number">{{ $providers }}</span>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6">
        <div class="info-box">
            <span class="info-box-icon bg-warning"><i class="ion ion-person-add"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Jumlah User</span>
                <span class="info-box-number">{{ $users }}</span>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6">
        <div class="info-box">
            <span class="info-box-icon bg-info"><i class="ion ion-cube"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Jumlah Produk</span>
                <span class="info-box-number">{{ $produks }}</span>
            </div>
        </div>
    </div>
</div>
            <div class="row">
                {{-- Konten dashboard lainnya bisa ditambahkan di sini --}}
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    // Pastikan script berjalan setelah halaman selesai dimuat
    document.addEventListener('DOMContentLoaded', function() {
        // Ambil elemen dimana tanggal akan ditampilkan
        const dateDisplayElement = document.getElementById('current-date-display');

        // Buat objek tanggal baru untuk mendapatkan waktu saat ini
        const now = new Date();

        // Atur opsi format untuk menampilkan hari, tanggal, bulan, dan tahun dalam Bahasa Indonesia
        const options = {
            weekday: 'long', // 'long' untuk "Sabtu", 'short' untuk "Sab"
            day: 'numeric',
            month: 'long',   // 'long' untuk "September", 'short' untuk "Sep"
            year: 'numeric'
        };

        // Format tanggal ke dalam string dengan lokal 'id-ID' (Indonesia)
        const formattedDate = now.toLocaleDateString('id-ID', options);

        // Masukkan tanggal yang sudah diformat ke dalam elemen HTML
        dateDisplayElement.textContent = formattedDate;
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dateDisplayElement = document.getElementById('current-date-display');
        const now = new Date();
        const options = {
            weekday: 'long',
            day: 'numeric',
            month: 'long',
            year: 'numeric'
        };
        const formattedDate = now.toLocaleDateString('id-ID', options);

        // --- PERUBAHAN DI SINI ---
        // Kita menggunakan .innerHTML untuk menyisipkan HTML (ikon) bersama dengan teks tanggal.
        dateDisplayElement.innerHTML = `<i class="mr-1 far fa-clock"></i> ${formattedDate}`;
    });
</script>
@endpush

@push('styles')
    {{-- Style yang tidak lagi dibutuhkan bisa dihapus --}}
@endpush
