@extends('layouts.admin')

@section('title', $kontak->exists ? 'Edit Kontak Penting' : 'Tambah Kontak Penting')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('admin.kontak.index') }}" class="inline-flex items-center gap-1 text-xs text-slate-500 hover:text-emerald-700 font-bold">
            <i class="ti ti-arrow-left"></i> Kembali ke Daftar Kontak
        </a>
    </div>

    <form method="POST" action="{{ $kontak->exists ? route('admin.kontak.update', $kontak) : route('admin.kontak.store') }}" class="bg-white rounded-3xl border border-slate-100 shadow-xl p-6 md:p-8 space-y-6 text-xs">
        @csrf
        @if ($kontak->exists) @method('PUT') @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block font-bold text-slate-700 uppercase tracking-wider mb-2">Kategori Kontak <span class="text-red-500">*</span></label>
                <select name="kategori" required class="w-full border border-slate-200 rounded-2xl px-4 py-3 font-semibold focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                    <option value="Layanan Darurat" {{ old('kategori', $kontak->kategori) === 'Layanan Darurat' ? 'selected' : '' }}>Layanan Darurat</option>
                    <option value="Perangkat Desa" {{ old('kategori', $kontak->kategori) === 'Perangkat Desa' ? 'selected' : '' }}>Perangkat Desa</option>
                    <option value="Fasilitas Umum" {{ old('kategori', $kontak->kategori) === 'Fasilitas Umum' ? 'selected' : '' }}>Fasilitas Umum</option>
                </select>
            </div>

            <div>
                <label class="block font-bold text-slate-700 uppercase tracking-wider mb-2">Nama Kontak / Institusi <span class="text-red-500">*</span></label>
                <input type="text" name="nama" value="{{ old('nama', $kontak->nama) }}" placeholder="Contoh: Puskesmas Desa / Polsek" required
                       class="w-full border border-slate-200 rounded-2xl px-4 py-3 font-semibold focus:ring-2 focus:ring-emerald-500 focus:outline-none">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block font-bold text-slate-700 uppercase tracking-wider mb-2">Jabatan / Peran</label>
                <input type="text" name="jabatan_peran" value="{{ old('jabatan_peran', $kontak->jabatan_peran) }}" placeholder="Contoh: Kepala Desa / UGD 24 Jam"
                       class="w-full border border-slate-200 rounded-2xl px-4 py-3 font-semibold focus:ring-2 focus:ring-emerald-500 focus:outline-none">
            </div>

            <div>
                <label class="block font-bold text-slate-700 uppercase tracking-wider mb-2">Nomor Telepon <span class="text-red-500">*</span></label>
                <input type="text" name="no_telp" value="{{ old('no_telp', $kontak->no_telp) }}" placeholder="Contoh: 081234567890 / 112" required
                       class="w-full border border-slate-200 rounded-2xl px-4 py-3 font-semibold focus:ring-2 focus:ring-emerald-500 focus:outline-none">
            </div>
        </div>

        <div>
            <label class="block font-bold text-slate-700 uppercase tracking-wider mb-2">Alamat Kantor / Lokasi</label>
            <textarea name="alamat" rows="3" placeholder="Alamat lokasi kontak..."
                      class="w-full border border-slate-200 rounded-2xl p-4 font-medium focus:ring-2 focus:ring-emerald-500 focus:outline-none">{{ old('alamat', $kontak->alamat) }}</textarea>
        </div>

        <div class="flex justify-end pt-4 border-t border-slate-100">
            <button type="submit" class="bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-bold px-8 py-3.5 rounded-2xl shadow-lg shadow-emerald-700/20 text-xs">
                Simpan Kontak
            </button>
        </div>
    </form>
</div>
@endsection
