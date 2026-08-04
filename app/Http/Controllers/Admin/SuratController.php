<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Surat;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    public function index(Request $request)
    {
        $query = Surat::with('jenisSurat');

        if ($status = $request->get('status')) {
            $query->where('status', $status);
        }

        if ($search = $request->get('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_pemohon', 'like', "%{$search}%")
                  ->orWhere('kode_tracking', 'like', "%{$search}%");
            });
        }

        if ($dari = $request->get('dari_tanggal')) {
            $query->whereDate('created_at', '>=', $dari);
        }

        if ($sampai = $request->get('sampai_tanggal')) {
            $query->whereDate('created_at', '<=', $sampai);
        }

        $surats = $query->latest()->paginate(15)->withQueryString();

        return view('admin.surat.index', compact('surats', 'status', 'search'));
    }

    public function show(Surat $surat)
    {
        $surat->load('jenisSurat', 'penduduk');

        return view('admin.surat.show', compact('surat'));
    }

    public function updateStatus(Request $request, Surat $surat)
    {
        $data = $request->validate([
            'status' => 'required|in:diajukan,diproses,disetujui,ditolak,selesai',
            'catatan_admin' => 'nullable|string',
            'nomor_surat' => 'nullable|string|max:255',
        ]);

        if ($data['status'] === 'selesai' && ! $surat->tanggal_selesai) {
            $data['tanggal_selesai'] = now();
        }

        $surat->update($data);

        return back()->with('success', 'Status surat berhasil diperbarui.');
    }
}
