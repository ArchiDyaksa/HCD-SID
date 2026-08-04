<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function index(Request $request)
    {
        $query = Galeri::query();

        if ($search = trim($request->input('q'))) {
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        if ($kategori = $request->input('kategori')) {
            $query->where('kategori', $kategori);
        }

        $kategoriList = Galeri::distinct()->whereNotNull('kategori')->where('kategori', '!=', '')->pluck('kategori');
        $galeris = $query->latest()->paginate(12)->withQueryString();
        $search = $request->input('q');
        $selectedKategori = $request->input('kategori');

        return view('public.galeri', compact('galeris', 'kategoriList', 'search', 'selectedKategori'));
    }
}
