<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Transaksi extends Model
{
    use HasFactory;

    /**
     * Kolom yang dapat diisi secara massal.
     * 'produk_id' dihapus karena kita akan menggunakan relasi Many-to-Many.
     */
    protected $fillable = [
        'id',
        'user_id',
        'nomor_pelanggan',
        'total_harga',
        'status'
    ];

    /**
     * Memberitahu Eloquent bahwa primary key (ID) bukan auto-incrementing.
     * @var bool
     */
    public $incrementing = false;

    /**
     * Memberitahu Eloquent bahwa tipe data primary key adalah string.
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Boot the model.
     * Fungsi ini akan berjalan otomatis saat model diinisialisasi.
     */
    protected static function boot()
    {
        parent::boot();

        /**
         * Event 'creating' ini akan berjalan SETIAP KALI sebuah transaksi baru akan dibuat.
         * Ini akan men-generate ID unik secara otomatis sebelum data disimpan ke database.
         */
        static::creating(function ($transaksi) {
            // Cek untuk memastikan ID belum di-set secara manual
            if (empty($transaksi->id)) {
                // Format ID: TRN-TAHUNBULANTANGGALJAMMENITDETIK-5KarakterAcak
                // Contoh: TRN-20250820144300-aB1xZ
                $transaksi->id = 'TRN-' . now()->format('YmdHis') . '-' . Str::random(5);
            }
        });
    }

    /**
     * Mendefinisikan relasi "belongsTo" ke model User.
     * Setiap transaksi dimiliki oleh satu user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Mendefinisikan relasi "belongsToMany" ke model Produk.
     * Satu transaksi bisa memiliki banyak produk.
     * Pastikan Anda memiliki tabel pivot bernama 'produk_transaksi'
     * dengan kolom 'transaksi_id' dan 'produk_id'.
     */
    public function produks()
    {
        // Nama tabel pivot (argumen kedua) dan foreign key (opsional) bisa disesuaikan
    return $this->belongsToMany(Produk::class)->withPivot('jumlah', 'harga'); // DIUBAH
    }
}
