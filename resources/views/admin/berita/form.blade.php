@extends('layouts.admin')

@section('title', $berita->exists ? 'Ubah Berita' : 'Tulis Berita')

@section('content')

<form method="POST"
      action="{{ $berita->exists ? route('admin.berita.update', $berita) : route('admin.berita.store') }}"
      enctype="multipart/form-data"
      class="bg-white rounded-2xl shadow p-6 md:p-8 max-w-3xl space-y-5">
    @csrf
    @if ($berita->exists) @method('PUT') @endif

    <div>
        <label class="block font-semibold mb-1 text-sm">Judul *</label>
        <input type="text" name="judul" value="{{ old('judul', $berita->judul) }}" required
               class="w-full border border-gray-300 rounded-lg px-4 py-2.5">
    </div>

    <div class="grid md:grid-cols-2 gap-5">
        <div>
            <label class="block font-semibold mb-1 text-sm">Kategori</label>
            <input type="text" name="kategori" value="{{ old('kategori', $berita->kategori ?? 'Umum') }}"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2.5">
        </div>
        <div>
            <label class="block font-semibold mb-1 text-sm">Penulis</label>
            <input type="text" name="penulis" value="{{ old('penulis', $berita->penulis) }}"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2.5">
        </div>
    </div>

    <div>
        <label class="block font-semibold mb-1 text-sm">Isi Berita *</label>
        <textarea name="konten" rows="10" required class="w-full border border-gray-300 rounded-lg px-4 py-2.5">{{ old('konten', $berita->konten) }}</textarea>
    </div>

    <div>
        <label class="block font-semibold mb-1 text-sm">Gambar Sampul</label>
        <input type="file" name="gambar" accept="image/*" class="w-full border border-gray-300 rounded-lg px-4 py-2.5">
        @if ($berita->gambar)
            <img src="{{ asset('storage/' . $berita->gambar) }}" class="h-24 mt-2 rounded-lg">
        @endif
    </div>

    <div>
        <label class="block font-semibold mb-1 text-sm">Status</label>
        <select name="status" class="w-full border border-gray-300 rounded-lg px-4 py-2.5">
            <option value="draft" {{ old('status', $berita->status ?? 'draft') === 'draft' ? 'selected' : '' }}>Draft (belum tampil ke publik)</option>
            <option value="terbit" {{ old('status', $berita->status) === 'terbit' ? 'selected' : '' }}>Terbit</option>
        </select>
    </div>

    <div class="flex gap-3 pt-2">
        <button type="submit" class="bg-emerald-700 text-white font-bold px-6 py-2.5 rounded-lg hover:bg-emerald-800">Simpan</button>
        <a href="{{ route('admin.berita.index') }}" class="bg-gray-200 px-6 py-2.5 rounded-lg font-semibold hover:bg-gray-300">Batal</a>
    </div>
</form>

@endsection
