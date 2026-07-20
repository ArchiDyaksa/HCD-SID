<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    use HasFactory;

    protected $fillable = [
        'nik',
        'no_kk',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'rt',
        'rw',
        'agama',
        'status_perkawinan',
        'pekerjaan',
        'pendidikan_terakhir',
        'foto',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    public function surats()
    {
        return $this->hasMany(Surat::class);
    }

    public function getUmurAttribute(): ?int
    {
        return $this->tanggal_lahir?->age;
    }
}
