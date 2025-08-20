<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Produk;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Penting untuk database transaction

class TransaksiController extends Controller
{
    public function index()
    {
        // Ambil semua data yang dibutuhkan oleh halaman index DAN modal
        $t = Transaksi::with(['user', 'produk.provider'])->latest()->get();
        $users = User::all();
        $produks = Produk::where('stok', '>', 0)->get();

        return view('transaksis.index', compact('t', 'users', 'produks'));

    }

    public function create()
    {
        $users = User::all();
        $produks = Produk::where('stok', '>', 0)->get(); // Hanya produk yang ada stok
        return view('transaksis.create', compact('users', 'produks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'produk_id' => 'required|exists:produks,id',
            'nomor_pelanggan' => 'required|string|min:5|max:20',
        ]);

        // Gunakan Database Transaction untuk memastikan integritas data
        DB::beginTransaction();
        try {
            $produk = Produk::findOrFail($request->produk_id);
            $settingSaldo = Setting::where('key', 'saldo_utama')->first();
            $saldoUtama = $settingSaldo ? (float)$settingSaldo->value : 0;

            // 1. Cek Saldo Utama
            if ($saldoUtama < $produk->harga_modal) {
                throw new \Exception('Transaksi gagal, saldo utama tidak mencukupi.');
            }

            // 2. Cek Stok Produk
            if ($produk->stok <= 0) {
                throw new \Exception('Transaksi gagal, stok produk habis.');
            }

            // 3. Buat Transaksi Baru
            Transaksi::create([
                'user_id' => $request->user_id,
                'produk_id' => $request->produk_id,
                'nomor_pelanggan' => $request->nomor_pelanggan,
                'total_harga' => $produk->harga_jual, // Ambil harga jual dari produk
                'status' => 'success', // Langsung set sukses
            ]);

            // 4. Kurangi Stok Produk
            $produk->decrement('stok');

            // 5. Kurangi Saldo Utama
            $saldoBaru = $saldoUtama - $produk->harga_modal;
            $settingSaldo->update(['value' => $saldoBaru]);

            DB::commit(); // Jika semua berhasil, simpan perubahan

            return redirect()->route('transaksis.index')->with('success', 'Transaksi berhasil dibuat.');

        } catch (\Exception $e) {
            DB::rollBack(); // Jika ada error, batalkan semua perubahan
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function show(Transaksi $transaksi)
    {
        return view('transaksis.show', compact('transaksi'));
    }

    // Menggunakan Route Model Binding
    public function edit(Transaksi $transaksi)
    {
        // Anda perlu mengirimkan data produk dan user untuk form edit
        $users = User::all();
        $produks = Produk::all();
        return view('transaksis.edit', compact('transaksi', 'users', 'produks'));
    }

    // Menggunakan Route Model Binding
    public function update(Request $request, Transaksi $transaksi)
    {
        $request->validate([
            // ... aturan validasi untuk update ...
            'status' => 'required|in:pending,success,failed',
        ]);

        $transaksi->update($request->all());

        return redirect()->route('transaksis.index')->with('success', 'Status transaksi berhasil diperbarui.');
    }

    // Menggunakan Route Model Binding
    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();
        return redirect()->route('transaksis.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}
