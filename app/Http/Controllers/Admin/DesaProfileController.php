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
            'kecamatan' => 'nullable|string|max:255',
            'kabupaten' => 'nullable|string|max:255',
            'provinsi' => 'nullable|string|max:255',
            'luas_wilayah' => 'nullable|string|max:255',
            'alamat_kantor' => 'nullable|string|max:255',
            'no_telp' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'sejarah' => 'nullable|string',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'logo' => 'nullable|image|max:500',
        ]);

        $data['slug'] = Str::slug($request->nama_desa);

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

        $profile->update($data);

        return redirect()->route('admin.profil.edit')->with('success', 'Informasi, Logo & Profil Desa berhasil diperbarui.');
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
}
