<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

// --- Rute Publik (Bisa diakses tanpa login) ---
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.process');

// RUTE BARU UNTUK LUPA PASSWORD
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// --- Rute Terproteksi (Hanya bisa diakses setelah login) ---
Route::middleware(['auth'])->group(function () {

    // Rute utama setelah login
    Route::get('/', function () {
        return view('layouts.app');
    });
    Route::get('/layouts/app', function () {
        return view('layouts.app');
    })->name('layouts.app');

    // RUTE BARU YANG DITAMBAHKAN UNTUK MENGATASI 404
    Route::get('/dashboard', function () {
        return view('layouts.app');
    })->name('dashboard');

    Route::get('/admin/dashboard', function () {
        // Anda bisa mengarahkan ini ke view khusus admin jika ada
        return view('layouts.app');
    })->name('admin.dashboard');

    // Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Transaksi
    Route::resource('transaksis', TransaksiController::class);

    // Provider
    Route::resource('providers', ProviderController::class);

    // Produk
    Route::resource('produks', ProdukController::class);

    // Users
    Route::resource('users', UserController::class);

    // Rute untuk logout (harus di dalam grup auth)
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

