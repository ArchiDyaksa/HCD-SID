@extends('layouts.admin')

@section('title', $galeri->exists ? 'Edit Dokumentasi Galeri' : 'Upload Dokumentasi Galeri')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('admin.galeri.index') }}" class="inline-flex items-center gap-1 text-xs text-slate-500 hover:text-emerald-700 font-bold">
            <i class="ti ti-arrow-left"></i> Kembali ke Galeri
        </a>
    </div>

    <form method="POST" action="{{ $galeri->exists ? route('admin.galeri.update', $galeri) : route('admin.galeri.store') }}" enctype="multipart/form-data" class="bg-white rounded-3xl border border-slate-100 shadow-xl p-6 md:p-8 space-y-6 text-xs">
        @csrf
        @if ($galeri->exists) @method('PUT') @endif

        <div>
            <label class="block font-bold text-slate-700 uppercase tracking-wider mb-2">Judul Dokumentasi Foto <span class="text-red-500">*</span></label>
            <input type="text" name="judul" value="{{ old('judul', $galeri->judul) }}" placeholder="Contoh: Gotong Royong Kerja Bakti RT 02" required
                   class="w-full border border-slate-200 rounded-2xl px-4 py-3 font-semibold focus:ring-2 focus:ring-emerald-500 focus:outline-none">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block font-bold text-slate-700 uppercase tracking-wider mb-2">Kategori Dokumentasi</label>
                <input type="text" name="kategori" value="{{ old('kategori', $galeri->kategori) }}" placeholder="Contoh: Kegiatan Desa / Pembangunan"
                       class="w-full border border-slate-200 rounded-2xl px-4 py-3 font-semibold focus:ring-2 focus:ring-emerald-500 focus:outline-none">
            </div>

            <div>
                <label class="block font-bold text-slate-700 uppercase tracking-wider mb-2">Tanggal Pelaksanaan</label>
                <input type="date" name="tanggal" value="{{ old('tanggal', $galeri->tanggal ? $galeri->tanggal->format('Y-m-d') : '') }}"
                       class="w-full border border-slate-200 rounded-2xl px-4 py-3 font-semibold focus:ring-2 focus:ring-emerald-500 focus:outline-none">
            </div>
        </div>

        <div>
            <label class="block font-bold text-slate-700 uppercase tracking-wider mb-2">Upload Foto (Opsional)</label>
            <input type="file" name="foto" accept="image/*"
                   class="w-full border border-slate-200 rounded-2xl p-3 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
            @if ($galeri->foto)
            <div class="mt-3 flex items-center gap-3">
                <span class="text-slate-400 text-[11px]">Foto saat ini:</span>
                <img src="{{ asset('storage/' . $galeri->foto) }}" class="w-16 h-12 object-cover rounded-lg border">
            </div>
            @endif
        </div>

        <div>
            <label class="block font-bold text-slate-700 uppercase tracking-wider mb-2">Keterangan / Deskripsi Foto</label>
            <textarea name="deskripsi" rows="3" placeholder="Penjelasan singkat mengenai dokumentasi foto ini..."
                      class="w-full border border-slate-200 rounded-2xl p-4 font-medium focus:ring-2 focus:ring-emerald-500 focus:outline-none">{{ old('deskripsi', $galeri->deskripsi) }}</textarea>
        </div>

        <div class="flex justify-end pt-4 border-t border-slate-100">
            <button type="submit" class="bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-bold px-8 py-3.5 rounded-2xl shadow-lg shadow-emerald-700/20 text-xs">
                Simpan Dokumentasi
            </button>
        </div>
    </form>
</div>
@endsection
