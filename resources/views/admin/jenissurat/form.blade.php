@extends('layouts.admin')

@section('title', $jenisSurat->exists ? 'Ubah Jenis Surat' : 'Tambah Jenis Surat')

@section('content')

<form method="POST"
      action="{{ $jenisSurat->exists ? route('admin.jenissurat.update', $jenisSurat) : route('admin.jenissurat.store') }}"
      class="bg-white rounded-2xl shadow p-6 md:p-8 max-w-2xl space-y-5">
    @csrf
    @if ($jenisSurat->exists) @method('PUT') @endif

    <div>
        <label class="block font-semibold mb-1 text-sm">Kode Surat *</label>
        <input type="text" name="kode" value="{{ old('kode', $jenisSurat->kode) }}" required
               class="w-full border border-gray-300 rounded-lg px-4 py-2.5">
    </div>

    <div>
        <label class="block font-semibold mb-1 text-sm">Nama Surat *</label>
        <input type="text" name="nama_surat" value="{{ old('nama_surat', $jenisSurat->nama_surat) }}" required
               class="w-full border border-gray-300 rounded-lg px-4 py-2.5">
    </div>

    <div>
        <label class="block font-semibold mb-1 text-sm">Deskripsi</label>
        <textarea name="deskripsi" rows="2" class="w-full border border-gray-300 rounded-lg px-4 py-2.5">{{ old('deskripsi', $jenisSurat->deskripsi) }}</textarea>
    </div>

    <div>
        <label class="block font-semibold mb-1 text-sm">Persyaratan (satu per baris)</label>
        <textarea name="persyaratan" rows="4" class="w-full border border-gray-300 rounded-lg px-4 py-2.5">{{ old('persyaratan', $jenisSurat->persyaratan) }}</textarea>
    </div>

    <label class="flex items-center gap-2">
        <input type="checkbox" name="aktif" value="1" {{ old('aktif', $jenisSurat->aktif ?? true) ? 'checked' : '' }}>
        <span class="font-semibold text-sm">Aktifkan layanan ini untuk warga</span>
    </label>

    <div class="flex gap-3 pt-2">
        <button type="submit" class="bg-emerald-700 text-white font-bold px-6 py-2.5 rounded-lg hover:bg-emerald-800">Simpan</button>
        <a href="{{ route('admin.jenissurat.index') }}" class="bg-gray-200 px-6 py-2.5 rounded-lg font-semibold hover:bg-gray-300">Batal</a>
    </div>
</form>

@endsection
