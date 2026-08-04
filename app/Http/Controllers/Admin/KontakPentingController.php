<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KontakPenting;
use Illuminate\Http\Request;

class KontakPentingController extends Controller
{
    public function index()
    {
        $kontaks = KontakPenting::orderBy('kategori')->paginate(15);

        return view('admin.kontak.index', compact('kontaks'));
    }

    public function create()
    {
        return view('admin.kontak.form', ['kontak' => new KontakPenting()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kategori' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'jabatan_peran' => 'nullable|string|max:255',
            'no_telp' => 'required|string|max:255',
            'alamat' => 'nullable|string',
        ]);

        KontakPenting::create($data);

        return redirect()->route('admin.kontak.index')->with('success', 'Kontak penting berhasil ditambahkan.');
    }

    public function edit(KontakPenting $kontak)
    {
        return view('admin.kontak.form', compact('kontak'));
    }

    public function update(Request $request, KontakPenting $kontak)
    {
        $data = $request->validate([
            'kategori' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'jabatan_peran' => 'nullable|string|max:255',
            'no_telp' => 'required|string|max:255',
            'alamat' => 'nullable|string',
        ]);

        $kontak->update($data);

        return redirect()->route('admin.kontak.index')->with('success', 'Kontak penting berhasil diperbarui.');
    }

    public function destroy(KontakPenting $kontak)
    {
        $kontak->delete();

        return back()->with('success', 'Kontak penting berhasil dihapus.');
    }
}
