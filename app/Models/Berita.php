<?php

namespace App\Models;

use App\Traits\BelongsToDesa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Berita extends Model
{
    use BelongsToDesa, HasFactory;

    protected $fillable = [
        'desa_profile_id',
        'judul',
        'slug',
        'kategori',
        'konten',
        'gambar',
        'penulis',
        'dilihat',
        'status',
        'tanggal_publish',
    ];

    protected $casts = [
        'tanggal_publish' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (Berita $berita) {
            if (empty($berita->slug)) {
                $base = Str::slug($berita->judul);
                $slug = $base;
                $i = 1;
                while (static::where('slug', $slug)->exists()) {
                    $slug = $base . '-' . $i++;
                }
                $berita->slug = $slug;
            }
        });
    }

    public function scopeTerbit($query)
    {
        return $query->where('status', 'terbit')
            ->where('tanggal_publish', '<=', now());
    }
}
