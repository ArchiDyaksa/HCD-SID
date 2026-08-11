<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\DesaProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class DesaProfileController extends Controller
{
    public function edit()
    {
        $profile = DesaProfile::current();
        return view('admin.profil.edit', compact('profile'));
    }
    public function update(Request $request)
    {
        $data = $request->validate([
            'nama_desa' => 'required|string|max:255',
            'nama_kepala_desa' => 'nullable|string|max:255',
            'nip_kepala_desa' => 'nullable|string|max:255',
            'kecamatan' => 'nullable|string|max:255',
            'kabupaten' => 'nullable|string|max:255',
            'provinsi' => 'nullable|string|max:255',
            'luas_wilayah' => 'nullable|string|max:255',
            'alamat_kantor' => 'nullable|string|max:255',
            'peta_embed' => 'nullable|string',
            'no_telp' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'sejarah' => 'nullable|string',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'logo' => 'nullable|image|max:500',
            'struktur_organisasi' => 'nullable|image|max:1024',
        ]);
        $data['slug'] = Str::slug($request->nama_desa);
        // Ekstrak URL iframe jika admin menempelkan full tag <iframe src="...">
        if (!empty($data['peta_embed'])) {
            $embed = trim($data['peta_embed']);
            if (preg_match('/src=["\']([^"\']+)["\']/', $embed, $matches)) {
                $data['peta_embed'] = $matches[1];
            }
        }
        $profile = DesaProfile::current();
        if ($request->boolean('hapus_logo') && $profile->logo) {
            if (\Illuminate\Support\Facades\Storage::disk('public')->exists($profile->logo)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($profile->logo);
            }
            $data['logo'] = null;
        }
        if ($request->hasFile('logo')) {
            if ($profile->logo && \Illuminate\Support\Facades\Storage::disk('public')->exists($profile->logo)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($profile->logo);
            }
            $data['logo'] = $request->file('logo')->store('logo', 'public');
        }
        if ($request->boolean('hapus_struktur') && $profile->struktur_organisasi) {
            if (\Illuminate\Support\Facades\Storage::disk('public')->exists($profile->struktur_organisasi)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($profile->struktur_organisasi);
            }
            $data['struktur_organisasi'] = null;
        }
        if ($request->hasFile('struktur_organisasi')) {
            if ($profile->struktur_organisasi && \Illuminate\Support\Facades\Storage::disk('public')->exists($profile->struktur_organisasi)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($profile->struktur_organisasi);
            }
            $data['struktur_organisasi'] = $request->file('struktur_organisasi')->store('struktur', 'public');
        }
        $profile->update($data);
        return redirect()->route('admin.profil.edit')->with('success', 'Informasi, Logo, Peta Wilayah & Struktur Desa berhasil diperbarui.');
    }
    public function deleteLogo()
    {
        $profile = DesaProfile::current();
        if ($profile->logo) {
            if (\Illuminate\Support\Facades\Storage::disk('public')->exists($profile->logo)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($profile->logo);
            }
            $profile->update(['logo' => null]);
        }
        return redirect()->route('admin.profil.edit')->with('success', 'Logo desa saat ini berhasil dihapus.');
    }
    public function deleteStruktur()
    {
        $profile = DesaProfile::current();
        if ($profile->struktur_organisasi) {
            if (\Illuminate\Support\Facades\Storage::disk('public')->exists($profile->struktur_organisasi)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($profile->struktur_organisasi);
            }
            $profile->update(['struktur_organisasi' => null]);
        }
        return redirect()->route('admin.profil.edit')->with('success', 'Bagan struktur organisasi desa berhasil dihapus.');
    }
}