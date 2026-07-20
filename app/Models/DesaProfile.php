<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DesaProfile extends Model
{
    protected $fillable = [
        'nama_desa',
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

    public static function current(): self
    {
        return static::first() ?? new static([
            'nama_desa' => 'Nama Desa',
        ]);
    }
}
