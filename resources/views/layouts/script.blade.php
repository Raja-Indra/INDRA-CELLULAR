<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
<script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('dist/js/adminlte.js') }}"></script>
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(function () {
    $("#example1").DataTable({
        "responsive": true,
        "autoWidth": false,
    });
});
</script>

<script>
    // Kode BARU yang lebih bersih dan efektif
    $(window).on('load', function() {
    // Cukup tambahkan kelas untuk menyembunyikan preloader
    // CSS akan menangani semua animasi dan persembunyiannya
    $('.preloader').addClass('preloader-hidden');
});
</script>
{{-- Tambah Data --}}
<script>
    // MENANGANI KONFIRMASI SUBMIT
    $('#createForm, #editForm').on('submit', function(e) {
        if (!confirm('Apakah Anda yakin dengan data ini?')) {
            e.preventDefault(); // Batalkan submit jika user memilih "Batal"
        }
    });
</script>

{{-- Halaman User --}}
@push('scripts')
<script>
$(function() {

     // LOGIKA BARU UNTUK TOMBOL LIHAT DETAIL
    // -----------------------------------------------------------------
    $('.btn-view').on('click', function(e) {
        e.preventDefault();

        // 1. Ambil data dari tombol
        let id = $(this).data('id');
        let name = $(this).data('name');
        let email = $(this).data('email');
        let phone = $(this).data('phone');
        let role = $(this).data('role');

        // 2. Isi field di dalam modal lihat data
        $('#view_id').val(id);
        $('#view_name').val(name);
        $('#view_email').val(email);
        $('#view_phone').val(phone);
        // Mengubah teks role agar lebih mudah dibaca (Admin, Karyawan)
        $('#view_role').val(role.charAt(0).toUpperCase() + role.slice(1));

        // 3. Tampilkan modal
        $('#viewUserModal').modal('show');
    });

    // -----------------------------------------------------------------
    // LOGIKA UNTUK TOMBOL TAMBAH USER (BARU)
    // -----------------------------------------------------------------
    $('.btn-create').on('click', function() {
        // 1. Bersihkan form tambah user dari error lama
        $('#createForm .form-control').removeClass('is-invalid');
        $('#createForm .invalid-feedback').text('');

        // 2. Reset semua isi field di form tambah user
        $('#createForm')[0].reset();
    });


    // -----------------------------------------------------------------
    // LOGIKA UNTUK TOMBOL EDIT USER (DIPERBAIKI)
    // -----------------------------------------------------------------
    $('.btn-edit').on('click', function(e) {
        e.preventDefault();

        // 1. Bersihkan form edit dari error lama (HANYA form edit)
        $('#editForm .form-control').removeClass('is-invalid');
        $('#editForm .invalid-feedback').text('');

        // 2. Ambil data dari tombol dan isi form edit
        let id = $(this).data('id');
        let name = $(this).data('name');
        let email = $(this).data('email');
        let phone = $(this).data('phone');
        let role = $(this).data('role');

        let url = `/users/${id}`;
        $('#editForm').attr('action', url);
        $('#edit_user_id_display').val(id);
        $('#edit_name').val(name);
        $('#edit_email').val(email);
        $('#edit_phone').val(phone);
        $('#edit_role').val(role);

        // Kosongkan field password HANYA di form edit
        $('#editForm [name="password"]').val('');

        // 3. Tampilkan modal edit
        $('#editUserModal').modal('show');
    });

});
</script>
@endpush


{{-- Halaman Providers --}}
<script>
$(function() {
    // MENANGANI TOMBOL LIHAT (VIEW)
    $('.btn-view').on('click', function () {
        var providerId = $(this).data('id');
        var providerName = $(this).data('nama');
        $('#view_provider_id').val(providerId);
        $('#view_nama_provider').val(providerName);
        $('#viewProviderModal').modal('show');
    });

    // MENANGANI TOMBOL EDIT
    $('.btn-edit').on('click', function(e) {
        e.preventDefault();
        let providerId = $(this).data('id');
        let providerName = $(this).data('nama');
        $('#editProviderForm').attr('action', `/providers/${providerId}`);
        $('#provider_id_display').val(providerId);
        $('#edit_nama_provider').val(providerName);
        $('#editProviderModal').modal('show');
    });
});
</script>

{{-- Halaman Produk --}}
<script>
// --- FUNGSI BANTUAN KHUSUS HALAMAN PRODUK ---
function formatRupiah(angka) {
    if (isNaN(angka)) return "Rp 0";
    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0, maximumFractionDigits: 0 }).format(angka);
}

function hitungKeuntungan(modalSelector, jualSelector, displaySelector) {
    const hargaModal = parseFloat($(modalSelector).val()) || 0;
    const hargaJual = parseFloat($(jualSelector).val()) || 0;
    const keuntungan = hargaJual - hargaModal;
    $(displaySelector).val(formatRupiah(keuntungan));
}

// Lihat produk
function tampilkanDetailProduk(id, provider_id, nama, harga_modal, harga_jual, stok, jenis) {
    const providerNama = $(`a[data-id="${id}"].btn-edit`).closest('tr').find('td:nth-child(4)').text();

    // --- Referensi ke elemen div pembungkus (.form-group) ---
    const namaProdukGroup = $('#view_nama_produk').closest('.form-group');
    const hargaModalGroup = $('#view_harga_modal').closest('.form-group');
    const hargaJualGroup = $('#view_harga_jual').closest('.form-group');
    const keuntunganGroup = $('#view_keuntungan').closest('.form-group');
    const stokGroup = $('#view_stok').closest('.form-group');

    // --- Isi data yang selalu tampil ---
    $('#view_produk_id').val(id);
    $('#view_jenis').val(jenis);
    $('#view_provider').val(providerNama);

    // --- Logika dinamis untuk menampilkan/menyembunyikan field ---
    if (jenis === 'Saldo') {
        // Jika jenisnya Saldo, sembunyikan field yang tidak perlu
        namaProdukGroup.hide();
        hargaModalGroup.hide();
        hargaJualGroup.hide();
        keuntunganGroup.hide();

        // Tampilkan field stok dan ubah label serta formatnya
        stokGroup.show();
        stokGroup.find('label').text('Nominal Saldo');
        $('#view_stok').val(formatRupiah(stok));

    } else { // Untuk jenis lain (Pulsa, Paket Data, dll)
        // Tampilkan semua field
        namaProdukGroup.show();
        hargaModalGroup.show();
        hargaJualGroup.show();
        keuntunganGroup.show();
        stokGroup.show();

        // Isi data untuk field yang ditampilkan
        $('#view_nama_produk').val(nama || '-'); // Tampilkan '-' jika null
        $('#view_harga_modal').val(formatRupiah(harga_modal));
        $('#view_harga_jual').val(formatRupiah(harga_jual));
        const keuntungan = parseFloat(harga_jual) - parseFloat(harga_modal);
        $('#view_keuntungan').val(formatRupiah(keuntungan));

        // Atur label dan nilai stok seperti biasa
        stokGroup.find('label').text('Stok');
        $('#view_stok').val(stok);
    }

    // Tampilkan modal
    $('#viewProdukModal').modal('show');
}

// --- EVENT LISTENER & LOGIKA HALAMAN ---
$(function() {
    // LOGIKA PERHITUNGAN KEUNTUNGAN REAL-TIME
    $('#createModal #harga_modal, #createModal #harga_jual').on('keyup change', function() {
        hitungKeuntungan('#createModal #harga_modal', '#createModal #harga_jual', '#create_keuntungan');
    });
    $('#editProdukModal #hargaModalProduk, #editProdukModal #hargaJualProduk').on('keyup change', function() {
        hitungKeuntungan('#editProdukModal #hargaModalProduk', '#editProdukModal #hargaJualProduk', '#edit_keuntungan');
    });

    // LOGIKA DINAMIS UNTUK FORM TAMBAH PRODUK
    $('#createModal #jenis').on('change', function() {
        let jenisTerpilih = $(this).val();
        const fieldsWrapper = $('#detail-produk-fields');
        const requiredInputs = fieldsWrapper.find('input[name="nama_produk"], input[name="harga_modal"], input[name="harga_jual"]');

        // --- LOGIKA BARU UNTUK SHOW/HIDE ---
        if (jenisTerpilih === 'Saldo') {
            fieldsWrapper.hide();
            requiredInputs.prop('required', false);
        } else {
            fieldsWrapper.show();
            requiredInputs.prop('required', true);
        }
        // --- AKHIR LOGIKA BARU ---

        let providerDropdown = $('#createModal #provider_id');
        let labelStok = $('#createModal #label_stok_saldo');
        labelStok.text(jenisTerpilih === 'Saldo' ? 'Nominal Saldo' : 'Stok');
        let kategoriFilter = jenisTerpilih.toLowerCase().replace(' ', '');
        providerDropdown.val('');
        providerDropdown.find('option').each(function() {
            let option = $(this);
            let kategoriProvider = option.data('kategori');
            if (option.val() === "" || kategoriProvider === kategoriFilter) {
                option.show();
            } else {
                option.hide();
            }
        });
    });

    // LOGIKA DINAMIS UNTUK FORM EDIT PRODUK
    $('#editProdukModal #jenisProduk').on('change', function() {
        let jenisTerpilih = $(this).val();
        const fieldsWrapper = $('#edit-detail-produk-fields'); // Pastikan ID ini ada di modal edit Anda
        const requiredInputs = fieldsWrapper.find('input[name="nama_produk"], input[name="harga_modal"], input[name="harga_jual"]');

        // --- LOGIKA BARU UNTUK SHOW/HIDE ---
        if (jenisTerpilih === 'Saldo') {
            fieldsWrapper.hide();
            requiredInputs.prop('required', false);
        } else {
            fieldsWrapper.show();
            requiredInputs.prop('required', true);
        }
        // --- AKHIR LOGIKA BARU ---

        let providerDropdown = $('#editProdukModal #providerId');
        let labelStok = $('#editProdukModal #edit_label_stok_saldo');
        labelStok.text(jenisTerpilih === 'Saldo' ? 'Nominal Saldo' : 'Stok');
        let kategoriFilter = jenisTerpilih.toLowerCase().replace(' ', '');
        providerDropdown.find('option').each(function() {
            let option = $(this);
            let kategoriProvider = option.data('kategori');
            if (option.val() === "" || kategoriProvider === kategoriFilter) {
                option.show();
            } else {
                option.hide();
            }
        });
    });

    // MENANGANI TOMBOL EDIT PRODUK
    $('.btn-edit').on('click', function(e) {
        e.preventDefault();
        const data = $(this).data();
        $("#editForm").attr("action", `/produks/${data.id}`);
        $("#produkId").val(data.id);
        $("#namaProduk").val(data.nama_produk);
        $("#hargaModalProduk").val(data.harga_modal);
        $("#hargaJualProduk").val(data.harga_jual);
        $("#stokProduk").val(data.stok);
        $("#jenisProduk").val(data.jenis);
        $("#providerId").val(data.provider_id);

        $("#jenisProduk").trigger('change'); // Trigger ini akan menjalankan semua logika dinamis

        hitungKeuntungan('#editProdukModal #hargaModalProduk', '#editProdukModal #hargaJualProduk', '#edit_keuntungan');
        $('#editProdukModal').modal('show');
    });
});
</script>



