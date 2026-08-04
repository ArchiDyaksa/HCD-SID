<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function index(Request $request)
    {
        $query = Kegiatan::query();

        if ($search = trim($request->input('q'))) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_kegiatan', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%")
                  ->orWhere('penyelenggara', 'like', "%{$search}%");
            });
        }

        if ($status = $request->input('status')) {
            if ($status === 'mendatang') {
                $query->where('tanggal', '>=', now()->toDateString());
            } elseif ($status === 'selesai') {
                $query->where('tanggal', '<', now()->toDateString());
            }
        }

        $kegiatans = $query->orderBy('tanggal', 'asc')->paginate(12)->withQueryString();
        $search = $request->input('q');
        $selectedStatus = $request->input('status');

        return view('public.kegiatan.index', compact('kegiatans', 'search', 'selectedStatus'));
    }
}
