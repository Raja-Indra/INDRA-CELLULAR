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
        // 1. Validasi input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2. Mencoba melakukan autentikasi
        if (Auth::attempt($credentials)) {
            $user = Auth::user(); // Ambil data user yang berhasil login

            // 3. PENTING: Cek apakah user aktif
            if (!$user->is_active) {
                // Jika tidak aktif, paksa logout dan beri pesan error
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return back()->withErrors([
                    'email' => 'Akun Anda saat ini tidak aktif. Silakan hubungi administrator.',
                ])->onlyInput('email');
            }

            // 4. Regenerasi session untuk keamanan
            $request->session()->regenerate();

            // 5. Redirect ke dashboard untuk semua user yang berhasil login
            return redirect()->intended(route('dashboard'));
        }

        // 6. Jika autentikasi gagal, kembali ke halaman login
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
