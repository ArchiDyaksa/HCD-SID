<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Penduduk;
use App\Models\Surat;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPenduduk = Penduduk::count();
        $lakiLaki = Penduduk::where('jenis_kelamin', 'Laki-laki')->count();
        $perempuan = Penduduk::where('jenis_kelamin', 'Perempuan')->count();

        $suratPending = Surat::whereIn('status', ['diajukan', 'diproses'])->count();
        $suratSelesaiBulanIni = Surat::where('status', 'selesai')
            ->whereMonth('tanggal_selesai', now()->month)
            ->whereYear('tanggal_selesai', now()->year)
            ->count();

        $suratPerJenis = Surat::select('jenis_surat_id', DB::raw('count(*) as total'))
            ->with('jenisSurat:id,nama_surat')
            ->groupBy('jenis_surat_id')
            ->get();

        $suratTerbaru = Surat::with('jenisSurat')->latest()->take(6)->get();
        $totalBerita = Berita::terbit()->count();

        return view('admin.dashboard', compact(
            'totalPenduduk',
            'lakiLaki',
            'perempuan',
            'suratPending',
            'suratSelesaiBulanIni',
            'suratPerJenis',
            'suratTerbaru',
            'totalBerita'
        ));
    }
}
