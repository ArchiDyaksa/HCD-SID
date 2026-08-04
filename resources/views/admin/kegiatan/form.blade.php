@extends('layouts.admin')

@section('title', $kegiatan->exists ? 'Edit Agenda Kegiatan' : 'Tambah Agenda Kegiatan')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('admin.kegiatan.index') }}" class="inline-flex items-center gap-1 text-xs text-slate-500 hover:text-emerald-700 font-bold">
            <i class="ti ti-arrow-left"></i> Kembali ke Daftar Agenda
        </a>
    </div>

    <form method="POST" action="{{ $kegiatan->exists ? route('admin.kegiatan.update', $kegiatan) : route('admin.kegiatan.store') }}" class="bg-white rounded-3xl border border-slate-100 shadow-xl p-6 md:p-8 space-y-6 text-xs">
        @csrf
        @if ($kegiatan->exists) @method('PUT') @endif

        <div>
            <label class="block font-bold text-slate-700 uppercase tracking-wider mb-2">Nama Kegiatan <span class="text-red-500">*</span></label>
            <input type="text" name="nama_kegiatan" value="{{ old('nama_kegiatan', $kegiatan->nama_kegiatan) }}" required
                   class="w-full border border-slate-200 rounded-2xl px-4 py-3 font-semibold focus:ring-2 focus:ring-emerald-500 focus:outline-none">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block font-bold text-slate-700 uppercase tracking-wider mb-2">Tanggal Kegiatan <span class="text-red-500">*</span></label>
                <input type="date" name="tanggal" value="{{ old('tanggal', $kegiatan->tanggal ? $kegiatan->tanggal->format('Y-m-d') : '') }}" required
                       class="w-full border border-slate-200 rounded-2xl px-4 py-3 font-semibold focus:ring-2 focus:ring-emerald-500 focus:outline-none">
            </div>

            <div>
                <label class="block font-bold text-slate-700 uppercase tracking-wider mb-2">Waktu Pelaksanaan</label>
                <input type="text" name="waktu" value="{{ old('waktu', $kegiatan->waktu) }}" placeholder="Contoh: 08:00 - Selesai WIB"
                       class="w-full border border-slate-200 rounded-2xl px-4 py-3 font-semibold focus:ring-2 focus:ring-emerald-500 focus:outline-none">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block font-bold text-slate-700 uppercase tracking-wider mb-2">Lokasi Tempat</label>
                <input type="text" name="lokasi" value="{{ old('lokasi', $kegiatan->lokasi) }}" placeholder="Contoh: Balai Desa Sukamaju"
                       class="w-full border border-slate-200 rounded-2xl px-4 py-3 font-semibold focus:ring-2 focus:ring-emerald-500 focus:outline-none">
            </div>

            <div>
                <label class="block font-bold text-slate-700 uppercase tracking-wider mb-2">Penyelenggara</label>
                <input type="text" name="penyelenggara" value="{{ old('penyelenggara', $kegiatan->penyelenggara) }}" placeholder="Contoh: Karang Taruna / Pemdes"
                       class="w-full border border-slate-200 rounded-2xl px-4 py-3 font-semibold focus:ring-2 focus:ring-emerald-500 focus:outline-none">
            </div>
        </div>

        <div>
            <label class="block font-bold text-slate-700 uppercase tracking-wider mb-2">Deskripsi Kegiatan</label>
            <textarea name="deskripsi" rows="4" placeholder="Keterangan agenda..."
                      class="w-full border border-slate-200 rounded-2xl p-4 font-medium focus:ring-2 focus:ring-emerald-500 focus:outline-none">{{ old('deskripsi', $kegiatan->deskripsi) }}</textarea>
        </div>

        <div class="flex justify-end pt-4 border-t border-slate-100">
            <button type="submit" class="bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-bold px-8 py-3.5 rounded-2xl shadow-lg shadow-emerald-700/20 text-xs">
                Simpan Agenda
            </button>
        </div>
    </form>
</div>
@endsection
