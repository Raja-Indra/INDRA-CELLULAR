<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\User;
use App\Models\Produk;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $t = Transaksi::with(['user', 'produk'])->get();
        return view('transaksis.index', compact('t'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $u = User::all();
        $pk = Produk::all();
        return view('transaksis.create', compact('u', 'pk'));    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'produk_id' => 'required|exists:produks,id',
            'nomor_pelanggan' => 'required|string|max:15',
            'total_harga' => 'required|numeric',
            'status' => 'required|string|max:50',
        ]);

        // Simpan transaksi baru
        Transaksi::create($request->all());

        return redirect()->route('transaksis.index')
                         ->with('success', 'Transaksi berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaksi $t)
    {
        return view('transaksis.show', compact('t'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $t)
    {
        // Ambil data user dan produk untuk dropdown
        $u = User::all();
        $pk = Produk::all();
        return view('transaksis.edit', compact('t', 'u', 'pk'));    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaksi $t)
    {
         // Validasi input
         $request->validate([
            'user_id' => 'required|exists:users,id',
            'produk_id' => 'required|exists:produks,id',
            'nomor_pelanggan' => 'required|string|max:15',
            'total_harga' => 'required|numeric',
            'status' => 'required|string|max:50',
        ]);

        // Perbarui data transaksi
        $t->update($request->all());

        return redirect()->route('transaksis.index')
                         ->with('success', 'Transaksi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $t = Transaksi::find($id);
        $t->delete();

        return redirect()->route('transaksis.index')
                         ->with('success', 'Transaksi berhasil dihapus.');

    }
}
