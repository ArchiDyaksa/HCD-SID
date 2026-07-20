<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $query = Berita::query();

        if ($search = $request->get('q')) {
            $query->where('judul', 'like', "%{$search}%");
        }

        $beritas = $query->latest()->paginate(10)->withQueryString();

        return view('admin.berita.index', compact('beritas', 'search'));
    }

    public function create()
    {
        return view('admin.berita.form', ['berita' => new Berita()]);
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        $data['gambar'] = $this->handleUpload($request);
        $data['penulis'] = $data['penulis'] ?? $request->user()->name;

        if ($data['status'] === 'terbit' && empty($data['tanggal_publish'])) {
            $data['tanggal_publish'] = now();
        }

        Berita::create($data);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dipublikasikan.');
    }

    public function edit(Berita $berita)
    {
        return view('admin.berita.form', compact('berita'));
    }

    public function update(Request $request, Berita $berita)
    {
        $data = $this->validateData($request);

        if ($gambar = $this->handleUpload($request)) {
            $data['gambar'] = $gambar;
        }

        if ($data['status'] === 'terbit' && ! $berita->tanggal_publish) {
            $data['tanggal_publish'] = now();
        }

        $berita->update($data);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(Berita $berita)
    {
        $berita->delete();

        return back()->with('success', 'Berita berhasil dihapus.');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:255',
            'konten' => 'required|string',
            'penulis' => 'nullable|string|max:255',
            'status' => 'required|in:draft,terbit',
            'gambar' => 'nullable|image|max:2048',
        ]);
    }

    private function handleUpload(Request $request): ?string
    {
        if ($request->hasFile('gambar')) {
            return $request->file('gambar')->store('berita', 'public');
        }
        return null;
    }
}
