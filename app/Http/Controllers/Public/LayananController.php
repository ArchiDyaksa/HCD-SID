<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\JenisSurat;
use App\Models\Surat;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    public function index()
    {
        $jenisSurats = JenisSurat::where('aktif', true)->orderBy('nama_surat')->get();

        return view('public.layanan.index', compact('jenisSurats'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'jenis_surat_id' => 'required|exists:jenis_surats,id',
            'nama_pemohon' => 'required|string|max:255',
            'nik_pemohon' => 'required|digits:16',
            'no_hp' => 'nullable|string|max:20',
            'keperluan' => 'required|string',
        ]);

        $surat = Surat::create($data + [
            'status' => 'diajukan',
            'tanggal_pengajuan' => now(),
        ]);

        return redirect()
            ->route('layanan.sukses', $surat->kode_tracking)
            ->with('success', 'Pengajuan surat berhasil dikirim.');
    }

    public function sukses(string $kode)
    {
        $surat = Surat::with('jenisSurat')->where('kode_tracking', $kode)->firstOrFail();

        return view('public.layanan.sukses', compact('surat'));
    }

    public function form(JenisSurat $jenisSurat)
    {
        if (! $jenisSurat->aktif) {
            abort(404);
        }

        return redirect()->route('layanan.index', ['open_id' => $jenisSurat->id]);
    }

    public function cekStatusForm()
    {
        return view('public.layanan.cek-status');
    }

    public function cekStatus(Request $request)
    {
        $request->validate([
            'kode_tracking' => 'required|string',
        ]);

        $surat = Surat::with('jenisSurat')
            ->where('kode_tracking', strtoupper($request->kode_tracking))
            ->first();

        return view('public.layanan.cek-status', compact('surat'));
    }

    public function cetak(string $kode)
    {
        $surat = Surat::with('jenisSurat')->where('kode_tracking', strtoupper($kode))->firstOrFail();
        $profile = \App\Models\DesaProfile::current();

        return view('public.layanan.cetak', compact('surat', 'profile'));
    }
}
