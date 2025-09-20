<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

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
        /* CSS UNTUK LATAR BELAKANG */
    /* CSS UNTUK LATAR BELAKANG LOGIN */
    body.login-page {
        /* Path relatif dari folder css ke folder dist/img */
        background-image: url('../dist/img/spanduk.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    /* CSS UNTUK MEMPERJELAS JUDUL */
    .login-logo a {
        color: #FFFFFF; /* Mengubah warna teks menjadi putih */
        /* Memberi bayangan pada teks agar kontras dengan background */
        text-shadow: 10px 10px 8px rgba(0, 0, 0, 0.6);
        /* Menambah ukuran font menjadi lebih besar */
        font-size: 2.5rem; /* Anda bisa ganti nilainya, misal: 40px */

        /* Membuat seluruh teks menjadi tebal (bold) */
        font-weight: bold;
    }

    /* CSS UNTUK FORM CARD */
    .login-box .card {
        background-color: #ffffff;
        border-radius: 0.5rem; /* Membuat sudut sedikit lebih tumpul (opsional) */

        /* INI ADALAH EFEK BAYANGANNYA */
        box-shadow: 50 50px 50px rgba(0, 0, 0, 0.2);

        /* Efek transisi halus saat mouse diarahkan (opsional) */
        transition: all 0.3s ease-in-out;
    }

    /* Efek Interaktif (Opsional): bayangan akan sedikit lebih tebal saat mouse di atas form */
    .login-box .card:hover {
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.25);
        transform: translateY(-3px); /* Sedikit mengangkat card ke atas */
    }

        /* Warna latar belakang utama sidebar */
    .main-sidebar.sidebar-custom-blue {
        /* Menggunakan gradasi linear dari atas (warna asli) ke bawah (warna lebih gelap) */
        background: linear-gradient(150deg, #ff6456, #e85a4d);
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

</style>
