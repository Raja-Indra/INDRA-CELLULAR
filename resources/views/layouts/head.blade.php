<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

{{-- Google Font: Source Sans Pro --}}
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
{{-- Font Awesome --}}
<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
{{-- Ionicons --}}
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
{{-- Tempusdominus Bootstrap 4 --}}
<link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
{{-- iCheck Bootstrap 4 --}}
<link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
{{-- JQVMap --}}
<link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
{{-- Theme style --}}
<link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
{{-- overlayScrollbars --}}
<link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
{{-- Daterange picker --}}
<link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
{{-- summernote --}}
<link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
{{-- DataTables --}}
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">

{{-- **INI BAGIAN PENTINGNYA** --}}
{{-- CSS Kustom Anda --}}
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">

<style>
    /* New animated background for login page */
    body.login-page {
        background: linear-gradient(150deg, #ff8e78, #ff6456);
        overflow: hidden; /* Hide scrollbars from the animation */
    }

    .bg-bubbles {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 0; /* Behind login box */
    }

    .bg-bubbles li {
        position: absolute;
        list-style: none;
        display: block;
        width: 40px;
        height: 40px;
        background-color: rgba(255, 255, 255, 0.15);
        bottom: -160px;
        border-radius: 50%;
        animation: square 25s infinite;
        transition-timing-function: linear;
    }
    .bg-bubbles li:nth-child(1) { left: 10%; }
    .bg-bubbles li:nth-child(2) { left: 20%; width: 80px; height: 80px; animation-delay: 2s; animation-duration: 17s; }
    .bg-bubbles li:nth-child(3) { left: 25%; animation-delay: 4s; }
    .bg-bubbles li:nth-child(4) { left: 40%; width: 60px; height: 60px; animation-duration: 22s; background-color: rgba(255, 255, 255, 0.25); }
    .bg-bubbles li:nth-child(5) { left: 70%; }
    .bg-bubbles li:nth-child(6) { left: 80%; width: 120px; height: 120px; animation-delay: 3s; background-color: rgba(255, 255, 255, 0.2); }
    .bg-bubbles li:nth-child(7) { left: 32%; width: 160px; height: 160px; animation-delay: 7s; }
    .bg-bubbles li:nth-child(8) { left: 55%; width: 20px; height: 20px; animation-delay: 15s; animation-duration: 40s; }
    .bg-bubbles li:nth-child(9) { left: 25%; width: 10px; height: 10px; animation-delay: 2s; animation-duration: 40s; background-color: rgba(255, 255, 255, 0.3); }
    .bg-bubbles li:nth-child(10) { left: 90%; width: 160px; height: 160px; animation-delay: 11s; }

    @keyframes square {
        0%   { transform: translateY(0); }
        100% { transform: translateY(-1080px) rotate(600deg); }
    }

    /* CSS UNTUK MEMPERJELAS JUDUL */
    .login-logo a {
        color: #FFFFFF; /* Mengubah warna teks menjadi putih */
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);
        font-size: 2.5rem; 
        font-weight: bold;
    }

    /* CSS UNTUK FORM CARD */
    .login-box .card {
        background-color: rgba(255, 255, 255, 0.9);
        border-radius: 0.5rem;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease-in-out;
    }

    .login-box .card:hover {
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.25);
    }

    /* Warna latar belakang utama sidebar */
    .main-sidebar.sidebar-custom-blue {
        background: linear-gradient(150deg, #ff8e78, #ff6456);
    }

    /* Warna untuk brand-link, teks menu, dan ikon */
    .sidebar-custom-blue .brand-link,
    .sidebar-custom-blue .nav-sidebar .nav-link p,
    .sidebar-custom-blue .nav-sidebar .nav-link i {
        color: #ffffff; /* Warna putih agar kontras dengan biru */
    }

    /* Efek saat kursor mouse menyentuh menu (hover) */
    .sidebar-custom-blue .nav-sidebar .nav-item .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.1); /* Putih transparan tipis */
    }

    /* Latar belakang untuk menu yang sedang aktif/dipilih */
    .sidebar-custom-blue .nav-sidebar > .nav-item > .nav-link.active,
    .sidebar-custom-blue .nav-sidebar > .nav-item .nav-treeview > .nav-item > .nav-link.active {
        background-color: rgba(255, 255, 255, 0.403); /* Putih transparan seperti permintaan Anda */
        color: #ffffff;
    }

    .custom-header-gradient {
        background-color: #ff6456;
        background-image: linear-gradient(to right, #ff6456, #ff8e78);
        color: white;
    }
</style>
