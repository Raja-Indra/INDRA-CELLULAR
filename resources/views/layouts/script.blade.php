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
    // Kode untuk preloader
    $(window).on('load', function() {
        $('.preloader').addClass('preloader-hidden');
    });
</script>
{{-- Konfirmasi submit --}}
<script>
    $('#createForm, #editForm').on('submit', function(e) {
        if (!confirm('Apakah Anda yakin dengan data ini?')) {
            e.preventDefault(); // Batalkan submit jika user memilih "Batal"
        }
    });
</script>

{{-- ========================================================== --}}
{{-- Halaman User --}}
{{-- ========================================================== --}}
@push('scripts')
<script>
$(function() {
    // Tombol lihat detail user
    $('.btn-view').on('click', function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        let name = $(this).data('name');
        let email = $(this).data('email');
        let phone = $(this).data('phone');
        let role = $(this).data('role');

        $('#view_id').val(id);
        $('#view_name').val(name);
        $('#view_email').val(email);
        $('#view_phone').val(phone);
        $('#view_role').val(role.charAt(0).toUpperCase() + role.slice(1));
        $('#viewUserModal').modal('show');
    });

    // Tombol tambah user
    $('.btn-create').on('click', function() {
        $('#createForm .form-control').removeClass('is-invalid');
        $('#createForm .invalid-feedback').text('');
        $('#createForm')[0].reset();
    });

    // Tombol edit user
    $('.btn-edit').on('click', function(e) {
        e.preventDefault();
        $('#editForm .form-control').removeClass('is-invalid');
        $('#editForm .invalid-feedback').text('');

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
        $('#editForm [name="password"]').val('');
        $('#editUserModal').modal('show');
    });
});
</script>
@endpush


{{-- ========================================================== --}}
{{-- Halaman Providers --}}
{{-- ========================================================== --}}
<script>
$(function() {
    // MENANGANI TOMBOL LIHAT (VIEW)
    $('.btn-view').on('click', function () {
        var providerId = $(this).data('id');
        var providerName = $(this).data('nama');
        var providerKategori = $(this).data('kategori');

        function capitalize(text) {
            if (!text) return '';
            return text.charAt(0).toUpperCase() + text.slice(1);
        }

        $('#view_provider_id').val(providerId);
        $('#view_nama_provider').val(providerName);
        $('#view_kategori').val(capitalize(providerKategori));

        $('#viewProviderModal').modal('show');
    });

    // MENANGANI TOMBOL EDIT
    $('.btn-edit').on('click', function(e) {
        e.preventDefault();

        let providerId = $(this).data('id');
        let providerName = $(this).data('nama');
        let providerKategori = $(this).data('kategori');

        $('#editProviderForm').attr('action', `/providers/${providerId}`);
        $('#provider_id_display').val(providerId);
        $('#edit_nama_provider').val(providerName);
        $('#edit_kategori').val(providerKategori);

        $('#editProviderModal').modal('show');
    });

    // ==========================================================
    // KODE BARU: Menambahkan konfirmasi saat submit form edit
    // ==========================================================
    $('#editProviderForm').on('submit', function(e) {
        if (!confirm('Apakah Anda yakin ingin menyimpan perubahan ini?')) {
            e.preventDefault(); // Batalkan submit jika user memilih "Batal"
        }
    });
});
</script>

{{-- ========================================================== --}}
{{-- HALAMAN PRODUK --}}
{{-- ========================================================== --}}
<script>
$(document).ready(function() {

    // --- FUNGSI-FUNGSI BANTUAN UNTUK HALAMAN PRODUK ---

    /**
     * Memfilter dropdown provider berdasarkan jenis produk yang dipilih.
     * Logika ini sekarang mencocokkan 'Jenis Produk' langsung dengan 'data-kategori'.
     * Contoh: 'Pulsa' akan mencari provider dengan data-kategori 'pulsa'.
     */
    function filterProviderByCategory(jenisTerpilih, providerDropdown) {
        // Langsung gunakan jenis produk yang dipilih (diubah ke huruf kecil) sebagai filter.
        const kategoriFilter = (jenisTerpilih || '').toLowerCase();

        // Tampilkan semua opsi terlebih dahulu, ini penting untuk reset filter.
        providerDropdown.find('option').show();

        if (kategoriFilter) {
            // Lakukan iterasi pada setiap opsi provider untuk memfilter.
            providerDropdown.find('option').each(function() {
                const option = $(this);
                // Ambil data-kategori dari setiap opsi, dan ubah juga ke huruf kecil.
                const kategoriOption = (option.data('kategori') || '').toString().toLowerCase();

                // Sembunyikan opsi jika:
                // 1. Opsi tersebut bukan placeholder (memiliki value)
                // 2. Kategorinya tidak cocok dengan yang kita cari
                if (option.val() && kategoriOption !== kategoriFilter) {
                    option.hide();
                }
            });
        }

        // Selalu reset (kosongkan) pilihan provider setelah filter dijalankan.
        providerDropdown.val('');
    }

    /**
     * Mengatur tampilan field-field dinamis pada form (misal: sembunyikan harga untuk Saldo).
     */
    function toggleDynamicFields(jenisTerpilih, fieldsWrapper, labelStok) {
        const requiredInputs = fieldsWrapper.find('input[name="nama_produk"], input[name="harga_modal"], input[name="harga_jual"]');

        if (jenisTerpilih === 'Saldo') {
            fieldsWrapper.hide();
            requiredInputs.prop('required', false);
            labelStok.text('Nominal Saldo');
        } else {
            fieldsWrapper.show();
            requiredInputs.prop('required', true);
            labelStok.text('Stok');
        }
    }

    /**
     * Menghitung keuntungan dan memformatnya ke Rupiah secara real-time.
     */
    function calculateAndDisplayProfit(modalInput, jualInput, displayElement) {
        const modal = parseFloat($(modalInput).val()) || 0;
        const jual = parseFloat($(jualInput).val()) || 0;
        const keuntungan = jual - modal;
        $(displayElement).val('Rp ' + keuntungan.toLocaleString('id-ID'));
    }

    // --- LOGIKA UNTUK MODAL TAMBAH PRODUK ---
    const createModal = $('#createModal');
    createModal.find('#jenis').on('change', function() {
        const jenis = $(this).val();
        filterProviderByCategory(jenis, createModal.find('#provider_id'));
        toggleDynamicFields(jenis, createModal.find('#detail-produk-fields'), createModal.find('#label_stok_saldo'));
    });

    createModal.find('#harga_modal, #harga_jual').on('input', function() {
        calculateAndDisplayProfit('#harga_modal', '#harga_jual', '#create_keuntungan');
    });

    // --- LOGIKA UNTUK MODAL EDIT PRODUK ---
    const editModal = $('#editProdukModal');
    const editJenisSelect = editModal.find('#jenisProduk');

    editJenisSelect.on('change', function() {
        const jenis = $(this).val();
        filterProviderByCategory(jenis, editModal.find('#providerId'));
        toggleDynamicFields(jenis, editModal.find('#edit-detail-produk-fields'), editModal.find('#edit_label_stok_saldo'));
    });

    editModal.find('#hargaModalProduk, #hargaJualProduk').on('input', function() {
        calculateAndDisplayProfit('#hargaModalProduk', '#hargaJualProduk', '#edit_keuntungan');
    });

    // --- EVENT HANDLER UNTUK TOMBOL AKSI ---

    // Tombol Edit Produk
    $('.btn-edit-produk').on('click', function() {
        const data = $(this).data();

        editModal.find('#editForm').attr('action', `{{ url('produks') }}/${data.id}`);

        editModal.find('#produkId').val(data.id);
        editModal.find('#jenisProduk').val(data.jenis);
        editModal.find('#namaProduk').val(data.nama_produk);
        editModal.find('#hargaModalProduk').val(data.harga_modal);
        editModal.find('#hargaJualProduk').val(data.harga_jual);
        editModal.find('#stokProduk').val(data.stok);

        // WAJIB: Picu 'change' untuk menjalankan filter provider terlebih dahulu.
        editJenisSelect.trigger('change');

        // SETELAH daftar di-filter, baru pilih provider yang benar.
        editModal.find('#providerId').val(data.provider_id);

        // Picu perhitungan keuntungan awal.
        editModal.find('#hargaModalProduk').trigger('input');
        editModal.modal('show');
    });

    // Tombol Lihat Produk
    $('.btn-view-produk').on('click', function() {
        const data = $(this).data();
        const providerNama = $(this).closest('tr').find('td:eq(3)').text();
        const viewModal = $('#viewProdukModal');

        viewModal.find('#view_produk_id').val(data.id);
        viewModal.find('#view_jenis').val(data.jenis);
        viewModal.find('#view_provider').val(providerNama);

        if (data.jenis === 'Saldo') {
            viewModal.find('#view_nama_produk, #view_harga_modal, #view_harga_jual, #view_keuntungan').closest('.form-group').hide();
            viewModal.find('#view_stok').val('Rp ' + (data.stok || 0).toLocaleString('id-ID'));
            viewModal.find('#view_stok').closest('.form-group').find('label').text('Nominal Saldo');
        } else {
            viewModal.find('#view_nama_produk, #view_harga_modal, #view_harga_jual, #view_keuntungan').closest('.form-group').show();
            const keuntungan = parseFloat(data.harga_jual) - parseFloat(data.harga_modal);
            viewModal.find('#view_nama_produk').val(data.nama_produk || '-');
            viewModal.find('#view_harga_modal').val('Rp ' + (data.harga_modal || 0).toLocaleString('id-ID'));
            viewModal.find('#view_harga_jual').val('Rp ' + (data.harga_jual || 0).toLocaleString('id-ID'));
            viewModal.find('#view_keuntungan').val('Rp ' + (keuntungan || 0).toLocaleString('id-ID'));
            viewModal.find('#view_stok').val(data.stok);
            viewModal.find('#view_stok').closest('.form-group').find('label').text('Stok');
        }
        viewModal.modal('show');
    });
});
</script>



