<?php

namespace App\Models;

use App\Traits\BelongsToDesa;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    use BelongsToDesa;

    protected $fillable = [
        'desa_profile_id',
        'judul',
        'foto',
        'tanggal',
        'kategori',
        'deskripsi',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];
}
