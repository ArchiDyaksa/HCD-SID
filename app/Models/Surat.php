<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Surat extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_tracking',
        'nomor_surat',
        'jenis_surat_id',
        'penduduk_id',
        'nama_pemohon',
        'nik_pemohon',
        'no_hp',
        'keperluan',
        'status',
        'catatan_admin',
        'tanggal_pengajuan',
        'tanggal_selesai',
    ];

    protected $casts = [
        'tanggal_pengajuan' => 'datetime',
        'tanggal_selesai' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (Surat $surat) {
            if (empty($surat->kode_tracking)) {
                do {
                    $kode = 'SRT-' . strtoupper(Str::random(6));
                } while (static::where('kode_tracking', $kode)->exists());
                $surat->kode_tracking = $kode;
            }
        });
    }

    public function jenisSurat()
    {
        return $this->belongsTo(JenisSurat::class);
    }

    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class);
    }

    public function statusLabel(): string
    {
        return match ($this->status) {
            'diajukan' => 'Menunggu Verifikasi',
            'diproses' => 'Sedang Diproses',
            'disetujui' => 'Disetujui',
            'ditolak' => 'Ditolak',
            'selesai' => 'Selesai',
            default => ucfirst($this->status),
        };
    }

    public function statusColor(): string
    {
        return match ($this->status) {
            'diajukan' => 'bg-amber-100 text-amber-800',
            'diproses' => 'bg-blue-100 text-blue-800',
            'disetujui' => 'bg-green-100 text-green-800',
            'ditolak' => 'bg-red-100 text-red-800',
            'selesai' => 'bg-emerald-100 text-emerald-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }
}
