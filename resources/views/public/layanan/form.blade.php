@extends('layouts.public')

@section('title', 'Ajukan ' . $jenisSurat->nama_surat)

@section('content')
<!-- Header Back Button -->
<div class="bg-slate-100 border-b border-slate-200/60 py-4">
    <div class="max-w-2xl mx-auto px-6">
        <a href="{{ route('layanan.index') }}" class="inline-flex items-center gap-1.5 text-emerald-700 hover:text-emerald-800 text-sm font-bold group">
            <i class="ti ti-arrow-left group-hover:-translate-x-1 transition-transform"></i>
            <span>Kembali ke Katalog Layanan</span>
        </a>
    </div>
</div>

<section class="max-w-2xl mx-auto px-6 py-12">
    <div class="mb-8">
        <h1 class="text-2xl font-extrabold text-slate-800 tracking-tight">Form Pengajuan: {{ $jenisSurat->nama_surat }}</h1>
        <p class="text-slate-400 text-xs mt-1">Lengkapi data di bawah ini dengan benar. Kolom dengan tanda bintang (<span class="text-red-500">*</span>) wajib diisi.</p>
    </div>

    <form method="POST" action="{{ route('layanan.store') }}" class="bg-white border border-slate-100 rounded-3xl p-6 md:p-8 shadow-xl shadow-slate-200/40 space-y-6">
        @csrf
        <input type="hidden" name="jenis_surat_id" value="{{ $jenisSurat->id }}">

        <div>
            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nama Lengkap Pemohon <span class="text-red-500">*</span></label>
            <div class="relative">
                <i class="ti ti-user absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-lg"></i>
                <input type="text" name="nama_pemohon" value="{{ old('nama_pemohon') }}" required
                       placeholder="Masukkan nama lengkap sesuai KTP"
                       class="w-full border border-slate-200 rounded-2xl pl-11 pr-4 py-3 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none text-sm transition-all duration-300">
            </div>
            @error('nama_pemohon') <p class="text-red-600 text-xs mt-1.5 flex items-center gap-1"><i class="ti ti-alert-circle"></i> {{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">NIK Pemohon (16 Digit) <span class="text-red-500">*</span></label>
            <div class="relative">
                <i class="ti ti-id absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-lg"></i>
                <input type="text" name="nik_pemohon" value="{{ old('nik_pemohon') }}" required inputmode="numeric" maxlength="16"
                       placeholder="Masukkan 16 digit NIK"
                       class="w-full border border-slate-200 rounded-2xl pl-11 pr-4 py-3 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none text-sm transition-all duration-300">
            </div>
            @error('nik_pemohon') <p class="text-red-600 text-xs mt-1.5 flex items-center gap-1"><i class="ti ti-alert-circle"></i> {{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nomor HP / WhatsApp (Aktif)</label>
            <div class="relative">
                <i class="ti ti-brand-whatsapp absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-lg"></i>
                <input type="text" name="no_hp" value="{{ old('no_hp') }}"
                       placeholder="Contoh: 081234567890"
                       class="w-full border border-slate-200 rounded-2xl pl-11 pr-4 py-3 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none text-sm transition-all duration-300">
            </div>
            <span class="text-[10px] text-slate-400 font-semibold mt-1 block">Digunakan untuk koordinasi pengerjaan surat jika diperlukan.</span>
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Keperluan / Keterangan Tambahan <span class="text-red-500">*</span></label>
            <div class="relative">
                <textarea name="keperluan" rows="4" required
                          placeholder="Tuliskan tujuan pembuatan surat secara jelas (misal: pengurusan beasiswa anak, pembuatan paspor, dll.)"
                          class="w-full border border-slate-200 rounded-2xl p-4 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none text-sm transition-all duration-300">{{ old('keperluan') }}</textarea>
            </div>
            @error('keperluan') <p class="text-red-600 text-xs mt-1.5 flex items-center gap-1"><i class="ti ti-alert-circle"></i> {{ $message }}</p> @enderror
        </div>

        <button type="submit" class="w-full bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-bold py-4 rounded-2xl shadow-lg shadow-emerald-700/20 hover:scale-[1.01] active:scale-[0.99] transition-all flex items-center justify-center gap-2">
            <i class="ti ti-send text-base"></i>
            <span>Kirim Permohonan Surat</span>
        </button>
    </form>
</section>
@endsection

