    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    <style>
    /* CSS UNTUK LATAR BELAKANG */
    body.login-page {
        background-image: url('{{ asset('dist/img/spanduk.jpg') }}');
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
</style>
