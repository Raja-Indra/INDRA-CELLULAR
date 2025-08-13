<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman form login.
     */
    public function showLoginForm()
    {
        return view('login.index');
    }

    /**
     * Menangani proses login.
     */
    public function login(Request $request)
    {
        // 1. Validasi input email dan password
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2. Mencoba melakukan autentikasi
        if (Auth::attempt($credentials)) {
            // Regenerasi session untuk keamanan
            $request->session()->regenerate();

            // 3. Jika berhasil, cek role dan arahkan (redirect)
            $user = Auth::user();
            if ($user->role === 'admin') {
                // Jika role adalah admin, arahkan ke dashboard admin
                return redirect()->intended(route('admin.dashboard'));
            }

            // Jika role adalah karyawan (atau role lainnya)
            return redirect()->intended(route('dashboard'));
        }

        // 4. Jika gagal, kembali ke halaman login dengan pesan error
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    /**
     * Menangani proses logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
