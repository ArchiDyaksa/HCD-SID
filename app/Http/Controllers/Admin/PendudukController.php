<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penduduk;
use Illuminate\Http\Request;

class PendudukController extends Controller
{
    public function index(Request $request)
    {
        $query = Penduduk::query();

        if ($search = $request->get('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nik', 'like', "%{$search}%")
                  ->orWhere('no_kk', 'like', "%{$search}%");
            });
        }

        $penduduks = $query->orderBy('nama')->paginate(15)->withQueryString();

        return view('admin.penduduk.index', compact('penduduks', 'search'));
    }

    public function create()
    {
        return view('admin.penduduk.form', ['penduduk' => new Penduduk()]);
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        $data['foto'] = $this->handleUpload($request);

        Penduduk::create($data);

        return redirect()->route('admin.penduduk.index')->with('success', 'Data penduduk berhasil ditambahkan.');
    }

    public function edit(Penduduk $penduduk)
    {
        return view('admin.penduduk.form', compact('penduduk'));
    }

    public function update(Request $request, Penduduk $penduduk)
    {
        $data = $this->validateData($request, $penduduk->id);

        if ($foto = $this->handleUpload($request)) {
            $data['foto'] = $foto;
        }

        $penduduk->update($data);

        return redirect()->route('admin.penduduk.index')->with('success', 'Data penduduk berhasil diperbarui.');
    }

    public function destroy(Penduduk $penduduk)
    {
        $penduduk->delete();

        return back()->with('success', 'Data penduduk berhasil dihapus.');
    }

    private function validateData(Request $request, $ignoreId = null): array
    {
        return $request->validate([
            'nik' => 'required|digits:16|unique:penduduks,nik' . ($ignoreId ? ",{$ignoreId}" : ''),
            'no_kk' => 'nullable|digits:16',
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'nullable|string',
            'rt' => 'nullable|string|max:3',
            'rw' => 'nullable|string|max:3',
            'agama' => 'nullable|string|max:255',
            'status_perkawinan' => 'nullable|string|max:255',
            'pekerjaan' => 'nullable|string|max:255',
            'pendidikan_terakhir' => 'nullable|string|max:255',
            'foto' => 'nullable|image|max:2048',
        ]);
    }

    private function handleUpload(Request $request): ?string
    {
        if ($request->hasFile('foto')) {
            return $request->file('foto')->store('penduduk', 'public');
        }
        return null;
    }
}
