<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Menampilkan form untuk mengedit profil pengguna yang sedang login.
     */
    public function edit()
    {
        // KOREKSI: Path view diubah agar sesuai dengan file Anda.
        // 'profile.index' akan merujuk ke 'resources/views/profile/index.blade.php'
        return view('profile.index', [
            'user' => Auth::user()
        ]);
    }

    /**
     * Memperbarui data profil pengguna di database.
     */
    public function update(Request $request)
    {
        // 1. Simpan objek user ke variabel $user
        $user = Auth::user();

        // 2. Simpan hasil validasi ke variabel BARU, contohnya $validatedData
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:15'], // <-- TAMBAHKAN INI
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        // 3. Perbarui properti objek $user menggunakan data dari request
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone; // <-- TAMBAHKAN INI


          // 3. PASTIKAN LOGIKA INI ADA: Cek jika ada file foto baru yang diunggah
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada untuk menghemat ruang penyimpanan
            if ($user->profile_photo_path) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }

            // Simpan foto baru di folder 'storage/app/public/profile-photos'
            // dan simpan path-nya ke variabel
            $path = $request->file('photo')->store('profile-photos', 'public');

            // Simpan path baru ke database
            $user->profile_photo_path = $path;
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // 4. Panggil save() pada objek $user yang asli. Ini akan berhasil.
        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui!');
    }
}
