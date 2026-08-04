<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class DesaProfile extends Model
{
    protected static ?self $overrideCurrent = null;

    protected $fillable = [
        'nama_desa',
        'slug',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'sejarah',
        'visi',
        'misi',
        'luas_wilayah',
        'logo',
        'alamat_kantor',
        'no_telp',
        'email',
    ];

    protected static function booted(): void
    {
        static::saving(function (self $profile) {
            if (empty($profile->slug) || $profile->isDirty('nama_desa')) {
                $profile->slug = Str::slug($profile->nama_desa ?: 'desa');
            }
        });
    }

    public static function setCurrent(?self $profile): void
    {
        static::$overrideCurrent = $profile;
    }

    public static function current(): self
    {
        if (static::$overrideCurrent) {
            return static::$overrideCurrent;
        }

        $slug = null;
        try {
            if (request()->route()) {
                $slug = request()->route('desa_slug');
            }
        } catch (\Throwable $e) {}

        if ($slug) {
            $profile = static::where('slug', $slug)->first();
            if ($profile) {
                return $profile;
            }
        }

        $profile = static::first();
        if (!$profile) {
            $profile = static::create([
                'nama_desa' => 'Nama Desa',
                'slug' => 'nama-desa',
            ]);
        } elseif (empty($profile->slug)) {
            $profile->slug = Str::slug($profile->nama_desa ?: 'desa');
            $profile->save();
        }

        return $profile;
    }
}
