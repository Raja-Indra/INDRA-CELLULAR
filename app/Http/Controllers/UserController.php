<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // <-- WAJIB TAMBAHKAN INI
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Menampilkan daftar semua user.
     */
    public function index()
    {
        $users = User::latest()->get();
        return view('users.index', compact('users'));
    }

    /**
     * Menyimpan user baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string|in:admin,karyawan', // Disesuaikan
        ]);

        // Enkripsi password secara manual sebelum disimpan
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Membuat user baru (ID akan dibuat otomatis oleh Model)
        User::create($validatedData);

        return redirect()->route('users.index')->with('success', 'User baru berhasil ditambahkan.');
    }

    /**
     * Memperbarui data user di database.
     */
    public function update(Request $request, User $user)
    {
        // Validasi input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'role' => 'required|string|in:admin,karyawan', // Disesuaikan
            'password' => 'nullable|string|min:8',
        ]);

        // Update data user
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->role = $validatedData['role'];

        // Jika ada password baru yang diinput, enkripsi dan perbarui
        if (!empty($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'Data user berhasil diperbarui.');
    }

    /**
     * Menghapus user dari database.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }
}
