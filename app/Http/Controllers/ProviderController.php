<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pr = Provider::all();
        return view('providers.index', compact('pr'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('providers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_provider' => 'required',
        ]);

        Provider::create($request->all());
        return redirect()->route('providers.index')->with('success', 'Provider berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Provider $pr)
    {
        return view('providers.show', compact('pr'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pr = Provider::findOrFail($id); // Menemukan provider berdasarkan ID
        return view('providers.edit', compact('pr'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_provider' => 'required',
        ]);

        $pr = Provider::findOrFail($id);
        $pr->update($request->all());
        return redirect()->route('providers.index')->with('success', 'Provider berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pr = Provider::find($id);
        $pr->delete();
        return redirect()->route('providers.index')->with('success', 'Provider berhasil dihapus.');
    }
}
