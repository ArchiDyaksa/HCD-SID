<?php

namespace App\Models;

use App\Traits\BelongsToDesa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisSurat extends Model
{
    use BelongsToDesa, HasFactory;

    protected $fillable = [
        'desa_profile_id',
        'kode',
        'nama_surat',
        'deskripsi',
        'persyaratan',
        'aktif',
    ];

    protected $casts = [
        'aktif' => 'boolean',
    ];

    public function surats()
    {
        return $this->hasMany(Surat::class);
    }

    public function getPersyaratanArrayAttribute(): array
    {
        return $this->persyaratan ? array_filter(explode("\n", $this->persyaratan)) : [];
    }
}
