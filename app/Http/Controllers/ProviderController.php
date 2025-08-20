<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    public function index()
    {
        $pr = Provider::all();
        return view('providers.index', compact('pr'));
    }

    public function store(Request $request)
    {
        // TAMBAHKAN VALIDASI UNTUK KATEGORI
        $request->validate([
            'nama_provider' => 'required|string|max:255|unique:providers',
            'kategori' => 'required|string|in:pulsa,paket data,voucher,saldo,aksesoris',
        ]);

        Provider::create($request->all());

        return redirect()->route('providers.index')
                         ->with('success', 'Provider berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $provider = Provider::findOrFail($id);

        // TAMBAHKAN VALIDASI UNTUK KATEGORI
        $request->validate([
            'nama_provider' => 'required|string|max:255|unique:providers,nama_provider,' . $id,
            'kategori' => 'required|string|in:pulsa,paket data,voucher,saldo,aksesoris',
        ]);

        $provider->update($request->all());

        return redirect()->route('providers.index')
                         ->with('success', 'Provider berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $provider = Provider::findOrFail($id);
        $provider->delete();

        return redirect()->route('providers.index')
                         ->with('success', 'Provider berhasil dihapus.');
    }
}
