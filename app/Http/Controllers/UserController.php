<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Menampilkan daftar semua user.
     */
    public function index()
    {
        $users = User::with('roles')->latest()->get();
        $roles = Role::all();

        // PERBAIKAN: Kirimkan variabel $roles ke view
        return view('users.index', compact('users', 'roles'));
    }

    /**
     * Menyimpan user baru ke database.
     */
    public function store(Request $request)
    {
        // PERBAIKAN: Sesuaikan validasi untuk checkbox roles
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|digits_between:10,15',
            'password' => 'required|string|min:8',
            'roles' => 'required|array', // Pastikan roles adalah array
            'roles.*' => 'exists:roles,name' // Pastikan setiap role ada di database
        ]);

        // Buat user baru. Password akan di-hash otomatis oleh Model User.
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'password' => $validatedData['password'],
        ]);

        // PERBAIKAN: Berikan role ke user baru menggunakan Spatie
        $user->assignRole($validatedData['roles']);

        return redirect()->route('users.index')->with('success', 'User baru berhasil ditambahkan.');
    }

    /**
     * Memperbarui data user di database.
     */
    public function update(Request $request, User $user)
    {
        // Kode ini sudah benar, tidak ada perubahan
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => 'nullable|digits_between:10,15',
            'password' => 'nullable|string|min:8',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,name'
        ]);

        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->phone = $validatedData['phone'];

        if (!empty($validatedData['password'])) {
            $user->password = $validatedData['password'];
        }

        $user->save();
        $user->syncRoles($validatedData['roles']);

        return redirect()->route('users.index')->with('success', 'Data user berhasil diperbarui.');
    }

    public function toggleStatus(User $user)
    {
        // Kode ini sudah benar
        $user->is_active = !$user->is_active;
        $user->save();
        return back()->with('success', 'Status user berhasil diperbarui.');
    }

    /**
     * Menghapus user dari database.
     */
    public function destroy(User $user)
    {
        // Kode ini sudah benar
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }
}
