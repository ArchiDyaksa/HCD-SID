@extends('layouts.admin')

@section('title', 'Kelola Profil & Informasi Desa')

@section('content')

<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <h2 class="text-xl font-extrabold text-slate-800 tracking-tight">Pengaturan Informasi & Profil Desa</h2>
        <p class="text-xs text-slate-400 mt-1">Perbarui identitas desa, sejarah, visi, misi, serta kontak resmi yang tampil pada situs publik.</p>
    </div>

    <!-- Main Form Card -->
    <form method="POST" action="{{ route('admin.profil.update') }}" enctype="multipart/form-data" class="bg-white rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/30 p-6 md:p-8 space-y-8">
        @csrf @method('PUT')

        <!-- Identitas Utama Desa -->
        <div>
            <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4 pb-2 border-b border-slate-100 flex items-center gap-2">
                <i class="ti ti-building-community text-emerald-600 text-base"></i> Identitas Wilayah & Logo Desa
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 text-xs">
                <div>
                    <label class="block font-bold text-slate-700 uppercase tracking-wider mb-2">Nama Desa <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_desa" value="{{ old('nama_desa', $profile->nama_desa) }}" required
                           class="w-full border border-slate-200 rounded-2xl px-4 py-3 font-semibold focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none">
                    @error('nama_desa') <p class="text-red-600 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block font-bold text-slate-700 uppercase tracking-wider mb-2">Nama Kepala Desa (Penandatangan Dokumen)</label>
                    <input type="text" name="nama_kepala_desa" value="{{ old('nama_kepala_desa', $profile->nama_kepala_desa) }}" placeholder="Contoh: H. AHMAD RIFAI, S.Sos."
                           class="w-full border border-slate-200 rounded-2xl px-4 py-3 font-semibold focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none">
                    @error('nama_kepala_desa') <p class="text-red-600 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block font-bold text-slate-700 uppercase tracking-wider mb-2">NIP / Nomor Identitas Kepala Desa (Opsional)</label>
                    <input type="text" name="nip_kepala_desa" value="{{ old('nip_kepala_desa', $profile->nip_kepala_desa) }}" placeholder="Contoh: 19800512 200501 1 003"
                           class="w-full border border-slate-200 rounded-2xl px-4 py-3 font-semibold focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none">
                    @error('nip_kepala_desa') <p class="text-red-600 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block font-bold text-slate-700 uppercase tracking-wider mb-2">Logo Resmi Desa (Gambar)</label>
                    <input type="file" name="logo" accept="image/*"
                           class="w-full border border-slate-200 rounded-2xl p-2.5 file:mr-4 file:py-1 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-emerald-50 file:text-emerald-700">
                    @if($profile->logo)
                        <div class="mt-3 p-3 bg-slate-50 border border-slate-200/80 rounded-2xl flex items-center justify-between gap-3">
                            <div class="flex items-center gap-3">
                                <img src="{{ asset('storage/' . $profile->logo) }}" class="w-10 h-10 rounded-xl object-cover border border-slate-200 bg-white shadow-sm" alt="Logo Desa">
                                <div>
                                    <span class="block font-bold text-slate-800 text-[11px]">Logo Desa Saat Ini</span>
                                    <span class="block text-[10px] text-slate-400">Tersimpan di sistem storage</span>
                                </div>
                            </div>
                            <button type="button" 
                                    onclick="if(confirm('Apakah Anda yakin ingin menghapus logo desa saat ini?')) document.getElementById('form-delete-logo').submit();"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-red-50 hover:bg-red-100 text-red-600 hover:text-red-700 font-bold text-[11px] border border-red-200/60 transition-colors">
                                <i class="ti ti-trash text-sm"></i>
                                <span>Hapus Logo</span>
                            </button>
                        </div>
                    @endif
                </div>

                <div>
                    <label class="block font-bold text-slate-700 uppercase tracking-wider mb-2">Kecamatan</label>
                    <input type="text" name="kecamatan" value="{{ old('kecamatan', $profile->kecamatan) }}"
                           class="w-full border border-slate-200 rounded-2xl px-4 py-3 font-semibold focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none">
                </div>

                <div>
                    <label class="block font-bold text-slate-700 uppercase tracking-wider mb-2">Kabupaten / Kota</label>
                    <input type="text" name="kabupaten" value="{{ old('kabupaten', $profile->kabupaten) }}"
                           class="w-full border border-slate-200 rounded-2xl px-4 py-3 font-semibold focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none">
                </div>

                <div>
                    <label class="block font-bold text-slate-700 uppercase tracking-wider mb-2">Provinsi</label>
                    <input type="text" name="provinsi" value="{{ old('provinsi', $profile->provinsi) }}"
                           class="w-full border border-slate-200 rounded-2xl px-4 py-3 font-semibold focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none">
                </div>

                <div>
                    <label class="block font-bold text-slate-700 uppercase tracking-wider mb-2">Luas Wilayah</label>
                    <input type="text" name="luas_wilayah" value="{{ old('luas_wilayah', $profile->luas_wilayah) }}" placeholder="Contoh: 12.5 km²"
                           class="w-full border border-slate-200 rounded-2xl px-4 py-3 font-semibold focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                </div>
            </div>
        </div>

        <!-- Kontak & Alamat -->
        <div>
            <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4 pb-2 border-b border-slate-100 flex items-center gap-2">
                <i class="ti ti-address-book text-emerald-600 text-base"></i> Kontak & Alamat Kantor
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 text-xs">
                <div class="md:col-span-2">
                    <label class="block font-bold text-slate-700 uppercase tracking-wider mb-2">Alamat Kantor Desa</label>
                    <input type="text" name="alamat_kantor" value="{{ old('alamat_kantor', $profile->alamat_kantor) }}" placeholder="Jl. Raya Desa No. 1..."
                           class="w-full border border-slate-200 rounded-2xl px-4 py-3 font-semibold focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none">
                </div>

                <div class="md:col-span-2">
                    <label class="block font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Peta Wilayah & Koordinat Balai Desa (Google Maps Embed URL / Iframe)
                    </label>
                    <input type="text" name="peta_embed" value="{{ old('peta_embed', $profile->peta_embed) }}" 
                           placeholder="Contoh: https://www.google.com/maps/embed?pb=... atau tempelkan seluruh kode <iframe>"
                           class="w-full border border-slate-200 rounded-2xl px-4 py-3 font-semibold focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none text-xs">
                    <p class="text-[11px] text-slate-400 mt-1.5 flex items-center gap-1">
                        <i class="ti ti-info-circle text-emerald-600"></i>
                        <span>Buka Google Maps &rarr; Bagikan (*Share*) &rarr; Sematkan Peta (*Embed a map*) &rarr; Salin HTML atau URL sematan ke kolom ini.</span>
                    </p>
                    @if($profile->peta_embed)
                        <div class="mt-3 rounded-2xl overflow-hidden border border-slate-200 h-44 bg-slate-100">
                            <iframe src="{{ $profile->peta_embed }}" class="w-full h-full border-0" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    @endif
                </div>

                <div>
                    <label class="block font-bold text-slate-700 uppercase tracking-wider mb-2">Nomor Telepon Kantor</label>
                    <input type="text" name="no_telp" value="{{ old('no_telp', $profile->no_telp) }}"
                           class="w-full border border-slate-200 rounded-2xl px-4 py-3 font-semibold focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none">
                </div>

                <div>
                    <label class="block font-bold text-slate-700 uppercase tracking-wider mb-2">Email Resmi Desa</label>
                    <input type="email" name="email" value="{{ old('email', $profile->email) }}"
                           class="w-full border border-slate-200 rounded-2xl px-4 py-3 font-semibold focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none">
                </div>
            </div>
        </div>

        <!-- Struktur Organisasi Aparatur Desa -->
        <div>
            <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4 pb-2 border-b border-slate-100 flex items-center gap-2">
                <i class="ti ti-users-group text-emerald-600 text-base"></i> Struktur Kepengurusan Aparatur Desa
            </h3>

            <div class="space-y-4 text-xs">
                <div>
                    <label class="block font-bold text-slate-700 uppercase tracking-wider mb-2">Bagan / Foto Struktur Organisasi Aparatur Desa (Gambar PNG/JPG/WebP, Maks 1 MB)</label>
                    <input type="file" name="struktur_organisasi" accept="image/*"
                           class="w-full border border-slate-200 rounded-2xl p-2.5 file:mr-4 file:py-1 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-emerald-50 file:text-emerald-700">
                    @error('struktur_organisasi') <p class="text-red-600 text-[11px] mt-1">{{ $message }}</p> @enderror

                    @if($profile->struktur_organisasi)
                        <div class="mt-4 p-4 bg-slate-50 border border-slate-200/80 rounded-2xl flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                            <div class="flex items-center gap-3">
                                <img src="{{ asset('storage/' . $profile->struktur_organisasi) }}" class="w-16 h-16 rounded-xl object-cover border border-slate-200 bg-white shadow-sm" alt="Bagan Struktur Organisasi">
                                <div>
                                    <span class="block font-bold text-slate-800 text-xs">Bagan Struktur Aparatur Desa Saat Ini</span>
                                    <span class="block text-[11px] text-slate-400">Tersimpan di sistem storage dan tampil di profil publik</span>
                                </div>
                            </div>
                            <button type="button" 
                                    onclick="if(confirm('Apakah Anda yakin ingin menghapus gambar bagan struktur organisasi desa?')) document.getElementById('form-delete-struktur').submit();"
                                    class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-red-50 hover:bg-red-100 text-red-600 hover:text-red-700 font-bold text-xs border border-red-200/60 transition-colors">
                                <i class="ti ti-trash text-sm"></i>
                                <span>Hapus Bagan</span>
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sejarah, Visi, Misi -->
        <div>
            <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4 pb-2 border-b border-slate-100 flex items-center gap-2">
                <i class="ti ti-file-certificate text-emerald-600 text-base"></i> Sejarah, Visi & Misi Desa
            </h3>

            <div class="space-y-5 text-xs">
                <div>
                    <label class="block font-bold text-slate-700 uppercase tracking-wider mb-2">Sejarah Desa</label>
                    <textarea name="sejarah" rows="5" placeholder="Tuliskan latar belakang dan sejarah perkembangan desa..."
                              class="w-full border border-slate-200 rounded-2xl p-4 font-medium focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none leading-relaxed">{{ old('sejarah', $profile->sejarah) }}</textarea>
                </div>

                <div>
                    <label class="block font-bold text-slate-700 uppercase tracking-wider mb-2">Visi Desa</label>
                    <textarea name="visi" rows="3" placeholder="Tuliskan visi utama desa..."
                              class="w-full border border-slate-200 rounded-2xl p-4 font-medium focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none leading-relaxed">{{ old('visi', $profile->visi) }}</textarea>
                </div>

                <div>
                    <label class="block font-bold text-slate-700 uppercase tracking-wider mb-2">Misi Desa (Gunakan baris baru untuk setiap poin misi)</label>
                    <textarea name="misi" rows="5" placeholder="Poin 1&#10;Poin 2&#10;Poin 3..."
                              class="w-full border border-slate-200 rounded-2xl p-4 font-medium focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none leading-relaxed">{{ old('misi', $profile->misi) }}</textarea>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="pt-4 border-t border-slate-100 flex justify-end">
            <button type="submit" class="bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-bold px-8 py-3.5 rounded-2xl shadow-lg shadow-emerald-700/20 hover:scale-[1.02] active:scale-[0.98] transition-all text-xs flex items-center gap-2">
                <i class="ti ti-device-floppy text-base"></i>
                <span>Simpan Perubahan Profil</span>
            </button>
        </div>
    </form>

    @if($profile->logo)
        <form id="form-delete-logo" action="{{ route('admin.profil.delete-logo') }}" method="POST" class="hidden">
            @csrf
            @method('DELETE')
        </form>
    @endif

    @if($profile->struktur_organisasi)
        <form id="form-delete-struktur" action="{{ route('admin.profil.delete-struktur') }}" method="POST" class="hidden">
            @csrf
            @method('DELETE')
        </form>
    @endif
</div>

@endsection
