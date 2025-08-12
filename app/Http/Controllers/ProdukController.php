<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Provider;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Menampilkan daftar produk.
     */
    public function index()
    {
        // Ambil semua data produk beserta relasi provider
        $pk = Produk::with('provider')->get();
        $pr = Provider::all(); // Ambil semua provider

        return view('produks.index', compact('pk', 'pr'));
    }

    /**
     * Menampilkan form untuk membuat produk baru.
     */
    // public function create()
    // {
    //     // Ambil data provider untuk dropdown
    //     $pr = Provider::all();
    //     return view('produks.create', compact('pk'));
    // }

    /**
     * Menyimpan produk baru ke database.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        // Validasi input
        $request->validate([
            'provider_id' => 'required|string|exists:providers,id',
            'nama_produk' => 'required|string|max:255',
            'harga_modal' => 'required|numeric|min:1',
            'harga_jual' => 'required|numeric|min:1',
            'stok' => 'required|integer|min:0',
            'jenis' => 'required|string|in:Pulsa,Paket Data,Voucher',
        ]);

        // Simpan produk baru
        Produk::create($request->all());

        return redirect()->route('produks.index')
                         ->with('success', 'Produk berhasil dibuat.');
    }

    /**
     * Menampilkan detail produk.
     */
    public function show(Produk $pk)
    {
        return view('produks.show', compact('pk'));
    }

    /**
     * Menampilkan form untuk mengedit produk.
     */
    public function edit($id)
    {
        // Ambil data provider untuk dropdown
        $pr = Provider::all();
        return view('produks.edit', compact('pr'));
    }

    /**
     * Memperbarui produk di database.
     */
    public function update(Request $request, $id)
    {

        // dd($request->all());
        $pk = Produk::findOrFail($id); // Jika produk tidak ditemukan, akan langsung 404

        // Validasi input
        $request->validate([
            'provider_id' => 'required|string|exists:providers,id',
            'nama_produk' => 'required|string|max:255',
            'harga_modal' => 'required|numeric|min:1',
            'harga_jual' => 'required|numeric|min:1',
            'stok' => 'required|integer|min:0',
            'jenis' => 'required|string|in:Pulsa,Paket Data,Voucher',
        ]);

        // Perbarui data produk
        $pk->update($request->all());

        return redirect()->route('produks.index')
                         ->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Menghapus produk dari database.
     */
    public function destroy($id)
    {
        $pk = Produk::find($id);
        $pk->delete();

        return redirect()->route('produks.index')
                         ->with('success', 'Produk berhasil dihapus.');
    }
}
