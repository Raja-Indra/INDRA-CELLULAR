<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dist/js/demo.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>

<!-- DataTables -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
    });
</script>

{{-- Modal Create Provider, Produk --}}
<script>
    document.getElementById('createForm').addEventListener('submit', function(event) {
        const isConfirmed = window.confirm('Apakah Anda yakin ingin menyimpan data provider ini?');

        if (!isConfirmed) {
            event.preventDefault();
        }
    });
</script>

{{-- Modal Lihat Provider --}}
<script>
    $(document).on('click', '.btn-view', function () {
        var providerId = $(this).data('id');
        var providerName = $(this).data('nama');

        // Masukkan data ke modal
        $('#viewProviderModal #view_provider_id').val(providerId);
        $('#viewProviderModal #view_nama_provider').val(providerName);

        // Tampilkan modal
        $('#viewProviderModal').modal('show');
    });
</script>

{{-- Modal Lihat Produk --}}
<script>
    function tampilkanDetailProduk(id, provider, nama, harga_modal, harga_jual, stok, jenis) {
        document.getElementById('view_produk_id').value = id;
        document.getElementById('view_provider').value = provider;
        document.getElementById('view_nama_produk').value = nama;
        document.getElementById('view_harga_modal').value = harga_modal;
        document.getElementById('view_harga_jual').value = harga_jual;
        document.getElementById('view_stok').value = stok;
        document.getElementById('view_jenis').value = jenis;
        $('#viewProdukModal').modal('show');
    }
</script>

{{-- Modal Edit Provider --}}
<script>
$(document).ready(function() {
    $('.btn-edit').click(function() {
        let providerId = $(this).data('id');
        let providerName = $(this).data('nama'); // Ganti 'name' menjadi 'nama'


        console.log("ID Provider:", providerId);
        console.log("Nama Provider:", providerName);
        // Set nilai form
        $('#provider_id_display').val(providerId);
        $('#nama_provider').val(providerName);
        $('#editProviderForm').attr('action', `/providers/${providerId}`);


        // Tampilkan modal
        $('#editProviderModal').modal('show');
    });

    // Event submit tetap berjalan di luar event click
    $('#editProviderForm').submit(function(event) {
        if (!confirm("Apakah Anda yakin ingin menyimpan perubahan ini?")) {
            event.preventDefault(); // Batalkan submit jika user menekan "Batal"
        }
    });
});

</script>

{{-- Modal Edit Produk --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".btn-edit").forEach(button => {
            button.addEventListener("click", function () {
                let produkId = this.getAttribute("data-id");
                let providerId = this.getAttribute("data-provider_id");
                let produkNama = this.getAttribute("data-nama_produk");
                let produkHargaModal = this.getAttribute("data-harga_modal");
                let produkHargaJual = this.getAttribute("data-harga_jual");
                let produkStok = this.getAttribute("data-stok");
                let produkJenis = this.getAttribute("data-jenis");

                document.getElementById("produkId").value = produkId;
                document.getElementById("providerId").value = providerId;
                document.getElementById("namaProduk").value = produkNama;
                document.getElementById("hargaModalProduk").value = produkHargaModal;
                document.getElementById("hargaJualProduk").value = produkHargaJual;
                document.getElementById("stokProduk").value = produkStok;
                document.getElementById("jenisProduk").value = produkJenis;

                document.getElementById("editForm").setAttribute("action", `/produks/${produkId}`);

                let modal = new bootstrap.Modal(document.getElementById("editProdukModal"));
                modal.show();
            });
        });

        document.getElementById("editForm").addEventListener("submit", function (event) {
            let confirmation = confirm("Apakah Anda yakin ingin menyimpan perubahan?");
            if (!confirmation) {
                event.preventDefault();
            }
        });

    });
</script>


{{-- Providers Delete Provider --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("providerForm").addEventListener("submit", function(event) {
            event.preventDefault(); // Mencegah submit langsung

            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Data provider akan disimpan.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#28a745",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Simpan!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.submit(); // Kirim form jika user mengonfirmasi
                }
            });
        });
    });
</script>

{{-- Produk Delete --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("produkForm").addEventListener("submit", function(event) {
            event.preventDefault(); // Mencegah submit langsung

            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Data produk akan disimpan.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#28a745",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Simpan!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.submit(); // Kirim form jika user mengonfirmasi
                }
            });
        });
    });
</script>


