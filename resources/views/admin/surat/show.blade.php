@extends('layouts.admin')

@section('title', 'Kelola Status Pengajuan Surat')

@section('content')

<!-- Back Link -->
<div class="mb-6">
    <a href="{{ route('admin.surat.index') }}" class="inline-flex items-center gap-1.5 text-xs text-slate-500 hover:text-emerald-700 font-bold transition-colors group">
        <i class="ti ti-arrow-left group-hover:-translate-x-1 transition-transform"></i>
        <span>Kembali ke Daftar Surat</span>
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Detail Info Card -->
    <div class="lg:col-span-2 bg-white rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/30 p-6 md:p-8 space-y-6">
        <div class="flex items-center justify-between pb-6 border-b border-slate-100">
            <div>
                <span class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Detail Permohonan Surat</span>
                <h2 class="text-xl font-extrabold text-slate-800 tracking-tight mt-0.5">{{ $surat->jenisSurat->nama_surat }}</h2>
            </div>
            <span class="px-3.5 py-1.5 rounded-full text-xs font-extrabold shadow-sm {{ $surat->statusColor() }}">
                {{ $surat->statusLabel() }}
            </span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-4 gap-x-6 text-xs bg-slate-50/70 p-5 rounded-2xl border border-slate-100">
            <div>
                <span class="text-slate-400 block mb-0.5">Kode Pelacakan Tracking</span>
                <span class="font-mono font-bold text-emerald-800 text-sm">{{ $surat->kode_tracking }}</span>
            </div>
            <div>
                <span class="text-slate-400 block mb-0.5">Tanggal Pengajuan</span>
                <span class="font-semibold text-slate-700">{{ $surat->tanggal_pengajuan->translatedFormat('d F Y, H:i') }} WIB</span>
            </div>
            <div>
                <span class="text-slate-400 block mb-0.5">Nama Lengkap Pemohon</span>
                <span class="font-bold text-slate-900 text-sm">{{ $surat->nama_pemohon }}</span>
            </div>
            <div>
                <span class="text-slate-400 block mb-0.5">NIK Pemohon</span>
                <span class="font-mono font-semibold text-slate-800">{{ $surat->nik_pemohon }}</span>
            </div>
            <div>
                <span class="text-slate-400 block mb-0.5">Nomor HP / WhatsApp</span>
                <span class="font-semibold text-slate-700 flex items-center gap-1.5">
                    {{ $surat->no_hp ?: '-' }}
                    @if($surat->no_hp)
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $surat->no_hp) }}" target="_blank" class="text-emerald-600 hover:text-emerald-700 text-xs font-bold flex items-center gap-0.5">
                            <i class="ti ti-brand-whatsapp"></i> Chat
                        </a>
                    @endif
                </span>
            </div>
            @if ($surat->penduduk)
            <div>
                <span class="text-slate-400 block mb-0.5">Status Data Penduduk</span>
                <a href="{{ route('admin.penduduk.edit', $surat->penduduk) }}" class="text-emerald-700 hover:text-emerald-800 font-bold inline-flex items-center gap-1">
                    <i class="ti ti-user-check"></i> Terdaftar di Database
                </a>
            </div>
            @endif
        </div>

        <div class="pt-2">
            <span class="text-xs font-bold text-slate-700 uppercase tracking-wider block mb-2">Keperluan / Alasan Pengajuan</span>
            <div class="p-5 rounded-2xl bg-white border border-slate-200/80 text-slate-700 text-xs leading-relaxed font-medium">
                {{ $surat->keperluan }}
            </div>
        </div>
    </div>

    <!-- Update Form Card -->
    <div class="bg-white rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/30 p-6 md:p-8">
        <div class="mb-6 pb-4 border-b border-slate-100">
            <h3 class="font-extrabold text-slate-800 text-base tracking-tight">Perbarui Status Surat</h3>
            <p class="text-xs text-slate-400 mt-0.5">Ubah progres dan berikan catatan.</p>
        </div>

        <form method="POST" action="{{ route('admin.surat.status', $surat) }}" class="space-y-5">
            @csrf @method('PATCH')

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Status Pengerjaan</label>
                <div class="relative">
                    <select name="status" class="w-full border border-slate-200 rounded-2xl pl-4 pr-8 py-3 text-xs font-semibold focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none appearance-none cursor-pointer">
                        @foreach (['diajukan' => 'Menunggu Verifikasi', 'diproses' => 'Sedang Diproses', 'disetujui' => 'Disetujui', 'ditolak' => 'Ditolak', 'selesai' => 'Selesai'] as $val => $label)
                            <option value="{{ $val }}" {{ $surat->status === $val ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    <i class="ti ti-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none"></i>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nomor Surat Resmi</label>
                <input type="text" name="nomor_surat" value="{{ old('nomor_surat', $surat->nomor_surat) }}"
                       placeholder="Contoh: 140/021/DS/2026"
                       class="w-full border border-slate-200 rounded-2xl px-4 py-3 text-xs focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Catatan untuk Pemohon</label>
                <textarea name="catatan_admin" rows="4"
                          placeholder="Tulis pesan atau alasan jika ditolak..."
                          class="w-full border border-slate-200 rounded-2xl p-4 text-xs focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none">{{ old('catatan_admin', $surat->catatan_admin) }}</textarea>
            </div>

            <button type="submit" class="w-full bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-bold py-3.5 rounded-2xl shadow-lg shadow-emerald-700/20 hover:scale-[1.01] active:scale-[0.99] transition-all text-xs flex items-center justify-center gap-2">
                <i class="ti ti-device-floppy"></i>
                <span>Simpan Perubahan</span>
            </button>
        </form>
    </div>
</div>

@endsection

