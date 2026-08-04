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
                <input type="text" id="input_nama" name="nama_pemohon" value="{{ old('nama_pemohon') }}" required
                       placeholder="Masukkan nama lengkap sesuai KTP"
                       class="w-full border border-slate-200 rounded-2xl pl-11 pr-4 py-3 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none text-sm transition-all duration-300">
            </div>
            <span class="text-[10px] text-slate-400 font-semibold mt-1 block">Pastikan ejaan nama sesuai dengan dokumen KTP/KK resmi.</span>
            @error('nama_pemohon') <p class="text-red-600 text-xs mt-1.5 flex items-center gap-1"><i class="ti ti-alert-circle"></i> {{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">NIK Pemohon (16 Digit) <span class="text-red-500">*</span></label>
            <div class="relative">
                <i class="ti ti-id absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-lg"></i>
                <input type="text" id="input_nik" name="nik_pemohon" value="{{ old('nik_pemohon') }}" required inputmode="numeric" maxlength="16"
                       placeholder="Masukkan 16 digit NIK"
                       class="w-full border border-slate-200 rounded-2xl pl-11 pr-4 py-3 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none text-sm transition-all duration-300">
            </div>
            <span class="text-[10px] text-slate-400 font-semibold mt-1 block">NIK berjumlah tepat 16 angka tanpa spasi.</span>
            @error('nik_pemohon') <p class="text-red-600 text-xs mt-1.5 flex items-center gap-1"><i class="ti ti-alert-circle"></i> {{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nomor HP / WhatsApp (Aktif)</label>
            <div class="relative">
                <i class="ti ti-brand-whatsapp absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-lg"></i>
                <input type="text" id="input_hp" name="no_hp" value="{{ old('no_hp') }}"
                       placeholder="Contoh: 081234567890"
                       class="w-full border border-slate-200 rounded-2xl pl-11 pr-4 py-3 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none text-sm transition-all duration-300">
            </div>
            <span class="text-[10px] text-slate-400 font-semibold mt-1 block">Digunakan untuk notifikasi dan koordinasi pengerjaan surat.</span>
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Keperluan / Keterangan Tambahan <span class="text-red-500">*</span></label>
            <div class="relative">
                <textarea id="input_keperluan" name="keperluan" rows="4" required
                          placeholder="Tuliskan tujuan pembuatan surat secara jelas (misal: pengurusan beasiswa anak, pembuatan paspor, dll.)"
                          class="w-full border border-slate-200 rounded-2xl p-4 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none text-sm transition-all duration-300">{{ old('keperluan') }}</textarea>
            </div>
            @error('keperluan') <p class="text-red-600 text-xs mt-1.5 flex items-center gap-1"><i class="ti ti-alert-circle"></i> {{ $message }}</p> @enderror
        </div>

        <button type="button" onclick="showPreviewModal()" class="w-full bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-bold py-4 rounded-2xl shadow-lg shadow-emerald-700/20 hover:scale-[1.01] active:scale-[0.99] transition-all flex items-center justify-center gap-2">
            <i class="ti ti-eye text-base"></i>
            <span>Pratinjau & Kirim Permohonan</span>
        </button>

        <!-- Modal Pratinjau Permohonan -->
        <div id="modal-preview" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 flex items-center justify-center p-4 hidden">
            <div class="bg-white rounded-3xl border border-slate-100 shadow-2xl max-w-lg w-full p-6 md:p-8 animate-fadeIn space-y-6">
                <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-xl">
                        <i class="ti ti-file-text"></i>
                    </div>
                    <div>
                        <h3 class="font-extrabold text-slate-800 text-base">Pratinjau Data Permohonan</h3>
                        <p class="text-[11px] text-slate-400">Periksa kembali data Anda sebelum dikirim secara resmi.</p>
                    </div>
                </div>

                <div class="space-y-3 text-xs bg-slate-50 p-4 rounded-2xl border border-slate-100">
                    <div class="flex justify-between">
                        <span class="text-slate-400">Jenis Surat:</span>
                        <span class="font-bold text-slate-800">{{ $jenisSurat->nama_surat }}</span>
                    </div>
                    <div class="flex justify-between border-t border-slate-200/60 pt-2">
                        <span class="text-slate-400">Nama Pemohon:</span>
                        <span class="font-bold text-slate-800" id="preview_nama">-</span>
                    </div>
                    <div class="flex justify-between border-t border-slate-200/60 pt-2">
                        <span class="text-slate-400">NIK Pemohon:</span>
                        <span class="font-mono font-bold text-slate-800" id="preview_nik">-</span>
                    </div>
                    <div class="flex justify-between border-t border-slate-200/60 pt-2">
                        <span class="text-slate-400">No. WhatsApp:</span>
                        <span class="font-semibold text-slate-700" id="preview_hp">-</span>
                    </div>
                    <div class="border-t border-slate-200/60 pt-2">
                        <span class="text-slate-400 block mb-1">Keperluan:</span>
                        <span class="font-medium text-slate-700 leading-relaxed block" id="preview_keperluan">-</span>
                    </div>
                </div>

                <div class="flex gap-3">
                    <button type="button" onclick="hidePreviewModal()" class="w-1/2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold py-3 rounded-2xl text-xs transition-colors">
                        Perbaiki Data
                    </button>
                    <button type="submit" class="w-1/2 bg-emerald-700 hover:bg-emerald-800 text-white font-bold py-3 rounded-2xl text-xs shadow-md transition-all flex items-center justify-center gap-1.5">
                        <i class="ti ti-send"></i> Ya, Kirim Sekarang
                    </button>
                </div>
            </div>
        </div>
    </form>
</section>

<script>
function showPreviewModal() {
    const nama = document.getElementById('input_nama').value.trim();
    const nik = document.getElementById('input_nik').value.trim();
    const hp = document.getElementById('input_hp').value.trim();
    const keperluan = document.getElementById('input_keperluan').value.trim();

    if(!nama || !nik || !keperluan) {
        alert('Mohon lengkapi seluruh kolom bertanda * sebelum melihat pratinjau.');
        return;
    }

    document.getElementById('preview_nama').innerText = nama;
    document.getElementById('preview_nik').innerText = nik;
    document.getElementById('preview_hp').innerText = hp || '-';
    document.getElementById('preview_keperluan').innerText = keperluan;

    document.getElementById('modal-preview').classList.remove('hidden');
}

function hidePreviewModal() {
    document.getElementById('modal-preview').classList.add('hidden');
}
</script>
@endsection

