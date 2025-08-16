<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Provider extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'nama_provider', 'kategori'];
    public $incrementing = false; // Matikan auto-increment untuk ID
    protected $keyType = 'string'; // Pastikan ID adalah string

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($provider) {
            $provider->id = 'PDR' . time(); // Contoh: PR1706958743
        });
    }

    // Relasi ke tabel Produk
    public function produks()
    {
        return $this->hasMany(Produk::class);
    }

}
