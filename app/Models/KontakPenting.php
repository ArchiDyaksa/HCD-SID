<?php

namespace App\Models;

use App\Traits\BelongsToDesa;
use Illuminate\Database\Eloquent\Model;

class KontakPenting extends Model
{
    use BelongsToDesa;

    protected $fillable = [
        'desa_profile_id',
        'kategori',
        'nama',
        'jabatan_peran',
        'no_telp',
        'alamat',
    ];
}
