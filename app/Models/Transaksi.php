<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'user_id', 'produk_id', 'nomor_pelanggan', 'total_harga', 'status'];
    public $incrementing = false; // Matikan auto-increment untuk ID
    protected $keyType = 'string'; // Pastikan ID adalah string

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($transaksi) {
            $transaksi->id = 'TRN' . time(); // Contoh: PR1706958743
        });
    }
    // Relasi ke tabel User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke tabel Produk
    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }

}
