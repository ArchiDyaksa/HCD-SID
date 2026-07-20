<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\DesaProfile;
use App\Models\Penduduk;

class HomeController extends Controller
{
    public function index()
    {
        $profile = DesaProfile::current();
        $beritaTerbaru = Berita::terbit()->latest('tanggal_publish')->take(3)->get();

        $statistik = [
            'total_penduduk' => Penduduk::count(),
            'laki_laki' => Penduduk::where('jenis_kelamin', 'Laki-laki')->count(),
            'perempuan' => Penduduk::where('jenis_kelamin', 'Perempuan')->count(),
        ];

        return view('public.home', compact('profile', 'beritaTerbaru', 'statistik'));
    }

    public function profil()
    {
        $profile = DesaProfile::current();

        return view('public.profil', compact('profile'));
    }
}
