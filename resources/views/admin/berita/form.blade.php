@extends('layouts.admin')

@section('title', $berita->exists ? 'Edit Berita Desa' : 'Tulis Berita Desa')

@section('content')

<div class="max-w-3xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('admin.berita.index') }}" class="inline-flex items-center gap-1 text-xs text-slate-500 hover:text-emerald-700 font-bold">
            <i class="ti ti-arrow-left"></i> Kembali ke Berita Desa
        </a>
    </div>

    <form method="POST"
          action="{{ $berita->exists ? route('admin.berita.update', $berita) : route('admin.berita.store') }}"
          enctype="multipart/form-data"
          class="bg-white rounded-3xl border border-slate-100 shadow-xl p-6 md:p-8 space-y-6 text-xs">
        @csrf
        @if ($berita->exists) @method('PUT') @endif

        <div>
            <label class="block font-bold text-slate-700 uppercase tracking-wider mb-2">Judul Berita <span class="text-red-500">*</span></label>
            <input type="text" name="judul" value="{{ old('judul', $berita->judul) }}" required placeholder="Tuliskan judul berita..."
                   class="w-full border border-slate-200 rounded-2xl px-4 py-3 font-semibold focus:ring-2 focus:ring-emerald-500 focus:outline-none">
        </div>

        <div class="grid md:grid-cols-2 gap-5">
            <div>
                <label class="block font-bold text-slate-700 uppercase tracking-wider mb-2">Kategori Berita</label>
                <input type="text" name="kategori" value="{{ old('kategori', $berita->kategori ?? 'Umum') }}" placeholder="Contoh: Pembangunan, Pengumuman, dll."
                       class="w-full border border-slate-200 rounded-2xl px-4 py-3 font-semibold focus:ring-2 focus:ring-emerald-500 focus:outline-none">
            </div>
            <div>
                <label class="block font-bold text-slate-700 uppercase tracking-wider mb-2">Penulis / Redaksi</label>
                <input type="text" name="penulis" value="{{ old('penulis', $berita->penulis ?: auth()->user()->name) }}"
                       class="w-full border border-slate-200 rounded-2xl px-4 py-3 font-semibold focus:ring-2 focus:ring-emerald-500 focus:outline-none">
            </div>
        </div>

        <div>
            <label class="block font-bold text-slate-700 uppercase tracking-wider mb-2">Isi Konten Berita <span class="text-red-500">*</span></label>
            <textarea name="konten" rows="10" required placeholder="Tuliskan isi berita secara lengkap..."
                      class="w-full border border-slate-200 rounded-2xl p-4 font-medium leading-relaxed focus:ring-2 focus:ring-emerald-500 focus:outline-none">{{ old('konten', $berita->konten) }}</textarea>
        </div>

        <div>
            <label class="block font-bold text-slate-700 uppercase tracking-wider mb-2">Gambar Sampul Berita</label>
            <input type="file" name="gambar" accept="image/*"
                   class="w-full border border-slate-200 rounded-2xl p-3 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
            @if ($berita->gambar)
                <div class="mt-3 flex items-center gap-3">
                    <span class="text-slate-400 text-[11px]">Sampul saat ini:</span>
                    <img src="{{ asset('storage/' . $berita->gambar) }}" class="h-16 w-24 object-cover rounded-xl border border-slate-200">
                </div>
            @endif
        </div>

        <div>
            <label class="block font-bold text-slate-700 uppercase tracking-wider mb-2">Status Publikasi</label>
            <select name="status" class="w-full border border-slate-200 rounded-2xl px-4 py-3 font-semibold focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                <option value="terbit" {{ old('status', $berita->status ?? 'terbit') === 'terbit' ? 'selected' : '' }}>Terbit (Tampil ke Publik)</option>
                <option value="draft" {{ old('status', $berita->status) === 'draft' ? 'selected' : '' }}>Draft (Disimpan Internal)</option>
            </select>
        </div>

        <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
            <a href="{{ route('admin.berita.index') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold px-6 py-3 rounded-2xl transition-colors">
                Batal
            </a>
            <button type="submit" class="bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-bold px-8 py-3.5 rounded-2xl shadow-lg shadow-emerald-700/20 hover:scale-[1.02] transition-all">
                Simpan Berita
            </button>
        </div>
    </form>
</div>

@endsection
