<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = ['id', 'name', 'email', 'password', 'role'];
    public $incrementing = false; // Matikan auto-increment untuk ID
    protected $keyType = 'string'; // Pastikan ID adalah string

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            // Logika untuk menentukan prefix ID berdasarkan role
            if ($user->role === 'karyawan') {
                $prefix = 'KYN';
            } elseif ($user->role === 'admin') {
                $prefix = 'ADN';
            } else {
                $prefix = 'USR'; // Default prefix jika role tidak dikenali
            }

            // Gabungkan prefix dengan timestamp untuk membuat ID unik
            $user->id = $prefix . time();
        });
    }


    // Relasi ke tabel Transaksi
    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }
}
