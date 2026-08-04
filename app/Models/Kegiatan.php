<?php

namespace App\Models;

use App\Traits\BelongsToDesa;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use BelongsToDesa;

    protected $fillable = [
        'desa_profile_id',
        'nama_kegiatan',
        'tanggal',
        'waktu',
        'lokasi',
        'deskripsi',
        'penyelenggara',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];
}
