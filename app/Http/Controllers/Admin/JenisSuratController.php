<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisSurat;
use Illuminate\Http\Request;

class JenisSuratController extends Controller
{
    public function index()
    {
        $jenisSurats = JenisSurat::orderBy('nama_surat')->paginate(15);

        return view('admin.jenissurat.index', compact('jenisSurats'));
    }

    public function create()
    {
        return view('admin.jenissurat.form', ['jenisSurat' => new JenisSurat()]);
    }

   

    public function edit(JenisSurat $jenissurat)
    {
        return view('admin.jenissurat.form', ['jenisSurat' => $jenissurat]);
    }

    public function update(Request $request, JenisSurat $jenissurat)
    {
        $data = $this->validateData($request, $jenissurat->id);
        $jenissurat->update($data);

        return redirect()->route('admin.jenissurat.index')->with('success', 'Jenis surat diperbarui.');
    }

    public function destroy(JenisSurat $jenissurat)
    {
        $jenissurat->delete();

        return back()->with('success', 'Jenis surat dihapus.');
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        JenisSurat::create($data);

        return redirect()->route('admin.jenissurat.index')->with('success', 'Jenis surat ditambahkan.');
    }

    private function validateData(Request $request, $ignoreId = null): array
    {
        return $request->validate([
            'kode' => 'required|string|max:20|unique:jenis_surats,kode' . ($ignoreId ? ",{$ignoreId}" : ''),
            'nama_surat' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'persyaratan' => 'nullable|string',
            'aktif' => 'boolean',
        ]);
    }
}
