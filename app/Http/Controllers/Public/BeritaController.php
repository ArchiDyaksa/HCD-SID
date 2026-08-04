<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $query = Berita::terbit();

        if ($search = $request->get('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('konten', 'like', "%{$search}%");
            });
        }

        if ($kategori = $request->get('kategori')) {
            $query->where('kategori', $kategori);
        }

        $beritas = $query->latest('tanggal_publish')->paginate(9)->withQueryString();
        $kategoriList = Berita::terbit()->whereNotNull('kategori')->where('kategori', '!=', '')->distinct()->pluck('kategori');

        return view('public.berita.index', compact('beritas', 'kategoriList', 'search', 'kategori'));
    }

    public function show(string $slug)
    {
        $berita = Berita::terbit()->where('slug', $slug)->firstOrFail();
        $berita->increment('dilihat');

        $terkait = Berita::terbit()
            ->where('id', '!=', $berita->id)
            ->latest('tanggal_publish')
            ->take(3)
            ->get();

        return view('public.berita.show', compact('berita', 'terkait'));
    }
}
