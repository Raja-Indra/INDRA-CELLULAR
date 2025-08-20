<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TransaksiController extends Controller
{
    /**
     * Menampilkan halaman daftar transaksi.
     */
    public function index()
    {
        // Mengambil data dengan relasi untuk menghindari N+1 query problem
        $transaksis = Transaksi::with('user', 'produks.provider')->latest()->get();
        $users = User::all();
        $produks = Produk::with('provider')->where('stok', '>', 0)->get(); // Hanya tampilkan produk yang ada stok

        return view('transaksis.index', compact('transaksis', 'users', 'produks'));
    }

    /**
     * Menyimpan transaksi baru ke dalam database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 1. Aturan Validasi
        $rules = [
            'user_id'         => 'required|string|exists:users,id',
            'nomor_pelanggan' => 'required|string|max:25',
            'total_harga'     => 'required|numeric|min:1',
            'produks'         => 'required|array|min:1',
            // Perbaikan: Validasi sebagai string, bukan integer
            'produks.*.id'    => 'required|string|exists:produks,id'
        ];

        // 2. Pesan Kustom untuk Error
        $messages = [
            'produks.required' => 'Keranjang transaksi tidak boleh kosong.',
            'produks.min'      => 'Anda harus menambahkan setidaknya satu produk ke transaksi.',
            'produks.*.id.exists' => 'Salah satu produk yang dipilih tidak valid atau sudah tidak ada.'
        ];

        // 3. Menjalankan Validasi
        $validatedData = $request->validate($rules, $messages);

        // 4. Menggunakan Database Transaction
        // Ini memastikan semua operasi (buat transaksi, kurangi stok, simpan relasi) berhasil.
        // Jika ada satu yang gagal, semua akan dibatalkan (rollback).
        try {
            DB::beginTransaction();

            // Buat transaksi utama
            $transaksi = Transaksi::create([
                'id'              => 'TRN-' . now()->format('YmdHis') . '-' . Str::random(5),
                'user_id'         => $validatedData['user_id'],
                'nomor_pelanggan' => $validatedData['nomor_pelanggan'],
                'total_harga'     => $validatedData['total_harga'],
                'status'          => 'success', // Status default
            ]);

            // Ambil semua ID produk dari request
            $produkIds = collect($validatedData['produks'])->pluck('id');

            // Lampirkan semua produk ke transaksi (mengisi tabel pivot 'produk_transaksi')
            $transaksi->produks()->attach($produkIds);

            // Kurangi stok untuk setiap produk yang terjual
            foreach ($produkIds as $produkId) {
                $produk = Produk::find($produkId);
                if ($produk && $produk->stok > 0) {
                    $produk->decrement('stok'); // Mengurangi stok sebanyak 1
                } else {
                    // Jika stok habis saat proses, batalkan transaksi
                    throw new \Exception("Stok untuk produk {$produk->nama_produk} tidak mencukupi.");
                }
            }

            DB::commit(); // Simpan semua perubahan jika tidak ada error

            return redirect()->route('transaksis.index')->with('success', 'Transaksi berhasil ditambahkan.');

        } catch (\Exception $e) {
            DB::rollBack(); // Batalkan semua operasi jika terjadi error

            // Redirect kembali dengan pesan error
            return redirect()->back()->with('error', 'Gagal menyimpan transaksi: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Menghapus transaksi dari database.
     */
    public function destroy(Transaksi $transaksi)
    {
        // Note: Mengembalikan stok saat transaksi dihapus bisa jadi kompleks
        // (misal: apakah produk masih ada, dll). Untuk saat ini, kita hanya hapus.
        // Jika diperlukan, logika pengembalian stok bisa ditambahkan di sini.

        // Hapus relasi di tabel pivot terlebih dahulu
        $transaksi->produks()->detach();

        // Hapus transaksi utama
        $transaksi->delete();

        return redirect()->route('transaksis.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}
