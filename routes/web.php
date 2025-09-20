<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\CatatanHutangController;

// --- Rute Publik (Bisa diakses tanpa login) ---
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.process');

// Rute Lupa Password
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');


// --- Rute Terproteksi (Hanya bisa diakses setelah login) ---
Route::middleware(['auth'])->group(function () {

    // Rute utama (/) dan /home sekarang sama-sama memanggil HomeController.
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Rute Resource (CRUD)
    Route::resource('transaksis', TransaksiController::class);
    Route::resource('providers', ProviderController::class);
    Route::resource('produks', ProdukController::class);
    Route::resource('users', UserController::class);
    Route::resource('catatan_hutangs', CatatanHutangController::class);

    // Rute untuk logout
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

