<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    // Izinkan pengisian massal untuk kolom key dan value
    protected $fillable = [
        'key',
        'value',
    ];
}
