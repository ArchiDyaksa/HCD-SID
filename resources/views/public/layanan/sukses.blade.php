@extends('layouts.public')

@section('title', 'Pengajuan Terkirim')

@section('content')
<section class="max-w-xl mx-auto px-6 py-20 text-center">
    <!-- Success Icon -->
    <div class="w-20 h-20 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center text-4xl mx-auto mb-6 shadow-xl shadow-emerald-500/10 animate-bounce">
        <i class="ti ti-circle-check-filled"></i>
    </div>
    
    <h1 class="text-2xl md:text-3xl font-extrabold text-slate-800 tracking-tight mb-2">Pengajuan Berhasil Dikirim!</h1>
    <p class="text-slate-400 text-sm mb-10 max-w-md mx-auto">Simpan kode pelacakan berikut untuk memeriksa status pengajuan surat Anda kapan saja di menu Cek Status.</p>

    <!-- Tracking Code Box -->
    <div class="bg-gradient-to-br from-emerald-50 to-teal-50/50 border-2 border-dashed border-emerald-300 rounded-3xl p-8 mb-8 relative group">
        <div class="text-xs font-bold text-emerald-800 uppercase tracking-widest mb-2">Kode Pelacakan Anda</div>
        <div class="text-3xl md:text-4xl font-mono font-extrabold text-emerald-900 tracking-wider my-3" id="tracking-code">{{ $surat->kode_tracking }}</div>
        
        <button onclick="copyTrackingCode()" id="copy-btn" class="inline-flex items-center gap-1.5 bg-emerald-700 hover:bg-emerald-800 text-white font-bold px-4 py-2 rounded-xl text-xs shadow-md transition-all">
            <i class="ti ti-copy" id="copy-icon"></i>
            <span id="copy-text">Salin Kode</span>
        </button>
    </div>

    <!-- Summary Card -->
    <div class="bg-white border border-slate-100 rounded-3xl p-6 shadow-lg shadow-slate-200/40 text-left mb-10">
        <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4 pb-3 border-b border-slate-100">Ringkasan Pengajuan</h3>
        <div class="space-y-3 text-sm">
            <div class="flex justify-between items-center">
                <span class="text-slate-400">Jenis Surat</span>
                <span class="font-bold text-slate-800">{{ $surat->jenisSurat->nama_surat }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-slate-400">Nama Pemohon</span>
                <span class="font-semibold text-slate-700">{{ $surat->nama_pemohon }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-slate-400">NIK Pemohon</span>
                <span class="font-mono text-slate-700">{{ $surat->nik_pemohon }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-slate-400">Status Saat Ini</span>
                <span class="px-3 py-1 rounded-full text-xs font-bold {{ $surat->statusColor() }}">{{ $surat->statusLabel() }}</span>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex flex-col sm:flex-row justify-center gap-4">
        <a href="{{ route('layanan.cek-status') }}?kode_tracking={{ $surat->kode_tracking }}" class="bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-bold px-8 py-3.5 rounded-2xl shadow-lg shadow-emerald-700/20 hover:scale-[1.02] active:scale-[0.98] transition-all text-sm flex items-center justify-center gap-2">
            <i class="ti ti-search"></i>
            <span>Lacak Status Sekarang</span>
        </a>
        <a href="{{ route('home') }}" class="bg-slate-100 text-slate-700 hover:bg-slate-200 font-bold px-8 py-3.5 rounded-2xl transition-all text-sm flex items-center justify-center gap-2">
            <i class="ti ti-home"></i>
            <span>Kembali ke Beranda</span>
        </a>
    </div>
</section>

<script>
function copyTrackingCode() {
    const code = document.getElementById('tracking-code').innerText;
    navigator.clipboard.writeText(code).then(() => {
        const text = document.getElementById('copy-text');
        const icon = document.getElementById('copy-icon');
        text.innerText = 'Tersalin!';
        icon.className = 'ti ti-check';
        setTimeout(() => {
            text.innerText = 'Salin Kode';
            icon.className = 'ti ti-copy';
        }, 2500);
    });
}
</script>
@endsection

