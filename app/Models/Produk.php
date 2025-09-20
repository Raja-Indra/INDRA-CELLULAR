<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'provider_id', 'nama_produk', 'harga_modal', 'harga_jual', 'stok', 'jenis'];
    public $incrementing = false; // Matikan auto-increment untuk ID
    protected $keyType = 'string'; // Pastikan ID adalah string

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($produk) {
            $produk->id = 'PDK' . time(); // Contoh ID: PDK1706958743
        });
    }

    // Relasi ke tabel Provider
    public function provider()
    {
        return $this->belongsTo(Provider::class, 'provider_id', 'id');
    }

    /**
     * Accessor untuk menghitung keuntungan.
     *
     * @return float
     */
    public function getKeuntunganAttribute()
    {
        return $this->harga_jual - $this->harga_modal;
    }
}
