<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\ProdukController;

Route::get('/', function () {
    return view('layouts.app');
});
Route::get('/layouts/app', function () {
    return view('layouts.app'); // Pastikan ada file resources/views/layouts/app.blade.php
})->name('layouts.app');

// Transaksi
Route::resource('transaksis', TransaksiController::class);
// Route::get('/transaksis', [TransaksiController::class, 'index'])->name('transaksis.index');
// Route::get('/transaksis/create', [TransaksiController::class, 'create'])->name('transaksis.create');
// Route::post('/transaksis', [TransaksiController::class, 'store'])->name('transaksis.store');
// Route::get('/transaksis/{t}', [TransaksiController::class, 'show'])->name('transaksis.show');
// Route::get('/transaksis/{t}/edit', [TransaksiController::class, 'edit'])->name('transaksis.edit');
// Route::put('/transaksis/{t}', [TransaksiController::class, 'update'])->name('transaksis.update');
// Route::delete('/transaksis/{t}', [TransaksiController::class, 'destroy'])->name('transaksis.destroy');

// Provider
Route::resource('providers', ProviderController::class);
// Route::delete('/providers/{pr}', [ProviderController::class, 'destroy'])->name('providers.destroy');
// Route::put('providers/{pr}', [ProviderController::class, 'update'])->name('pr.update');

// Produk
Route::resource('produks', ProdukController::class);
