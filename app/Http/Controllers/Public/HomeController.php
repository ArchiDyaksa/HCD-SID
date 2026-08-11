<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\DesaProfile;
use App\Models\JenisSurat;
use App\Models\Kegiatan;
use App\Models\Penduduk;

class HomeController extends Controller
{
    public function index()
    {
        $profile = DesaProfile::current();
        $beritaTerbaru = Berita::terbit()->latest('tanggal_publish')->take(3)->get();
        $semuaBerita = Berita::terbit()->latest('tanggal_publish')->get(['id', 'judul', 'slug', 'kategori']);
        $jenisSurat = JenisSurat::where('aktif', true)->get();
        $kegiatanMendatang = Kegiatan::latest()->take(3)->get();
        $semuaKegiatan = Kegiatan::latest()->get(['id', 'nama_kegiatan', 'tanggal', 'lokasi']);

        $statistik = [
            'total_penduduk' => Penduduk::count(),
            'laki_laki' => Penduduk::where('jenis_kelamin', 'Laki-laki')->count(),
            'perempuan' => Penduduk::where('jenis_kelamin', 'Perempuan')->count(),
        ];

        return view('public.home', compact('profile', 'beritaTerbaru', 'semuaBerita', 'jenisSurat', 'kegiatanMendatang', 'semuaKegiatan', 'statistik'));
    }

    public function profil()
    {
        $profile = DesaProfile::current();

        return view('public.profil', compact('profile'));
    }
}
