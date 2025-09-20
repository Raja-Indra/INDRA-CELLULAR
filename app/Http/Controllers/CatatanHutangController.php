<?php

namespace App\Http\Controllers;

use App\Models\CatatanHutang;
use Illuminate\Http\Request;

class CatatanHutangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $catatanHutangs = CatatanHutang::latest()->paginate(10);
        return view('catatan_hutangs.index', compact('catatanHutangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // This method will typically return a view for a modal or a dedicated creation page.
        // For now, we'll just return an empty response or a simple view if needed.
        return view('catatan_hutangs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'nomor_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'keterangan' => 'nullable|string',
            'nominal_hutang' => 'required|numeric|min:0',
        ]);

        CatatanHutang::create($request->all());

        return redirect()->route('catatan_hutangs.index')
                         ->with('success', 'Catatan hutang berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(CatatanHutang $catatanHutang)
    {
        return view('catatan_hutangs.show', compact('catatanHutang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CatatanHutang $catatanHutang)
    {
        return view('catatan_hutangs.edit', compact('catatanHutang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CatatanHutang $catatanHutang)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'nomor_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'keterangan' => 'nullable|string',
            'nominal_hutang' => 'required|numeric|min:0',
        ]);

        $catatanHutang->update($request->all());

        return redirect()->route('catatan_hutangs.index')
                         ->with('success', 'Catatan hutang berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CatatanHutang $catatanHutang)
    {
        $catatanHutang->delete();

        return redirect()->route('catatan_hutangs.index')
                         ->with('success', 'Catatan hutang berhasil dihapus.');
    }
}
