<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatatanHutang extends Model
{
    protected $fillable = [
        'nama_pelanggan',
        'nomor_hp',
        'alamat',
        'keterangan',
        'nominal_hutang',
    ];
}
