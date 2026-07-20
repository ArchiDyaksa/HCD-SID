@extends('layouts.public')

@section('title', 'Cek Status Pengajuan')

@section('content')
<!-- Header Section -->
<section class="bg-gradient-to-r from-emerald-800 to-teal-900 text-white py-16">
    <div class="max-w-xl mx-auto px-6 text-center">
        <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight">Pelacakan Status Surat</h1>
        <p class="text-emerald-100 mt-2 text-sm md:text-base font-medium">Pantau tahap pengerjaan surat permohonan Anda secara langsung.</p>
    </div>
</section>

<section class="max-w-2xl mx-auto px-6 py-12">
    <!-- Search Form -->
    <form method="POST" action="{{ route('layanan.cek-status.submit') }}" class="bg-white border border-slate-100 rounded-3xl p-6 shadow-xl shadow-slate-200/40 mb-10">
        @csrf
        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Masukkan Kode Pelacakan</label>
        <div class="flex flex-col sm:flex-row gap-3">
            <div class="relative flex-grow">
                <i class="ti ti-barcode absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-xl"></i>
                <input type="text" name="kode_tracking" value="{{ request('kode_tracking') ?? old('kode_tracking') }}" placeholder="Contoh: SRT-AB12CD" required
                       class="w-full border border-slate-200 rounded-2xl pl-12 pr-4 py-3.5 text-base font-mono font-bold uppercase focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none transition-all duration-300">
            </div>
            <button class="bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-bold px-8 py-3.5 rounded-2xl shadow-lg shadow-emerald-700/20 hover:scale-[1.02] active:scale-[0.98] transition-all text-sm flex items-center justify-center gap-2">
                <i class="ti ti-search"></i>
                <span>Cari</span>
            </button>
        </div>
    </form>

    @isset($surat)
        @if ($surat)
            <!-- Status Card -->
            <div class="bg-white border border-slate-100 rounded-3xl p-6 md:p-8 shadow-xl shadow-slate-200/40 space-y-8">
                <!-- Header Info -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-slate-100">
                    <div>
                        <span class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Hasil Pelacakan</span>
                        <h2 class="font-extrabold text-slate-800 text-xl tracking-tight mt-0.5">{{ $surat->jenisSurat->nama_surat }}</h2>
                        <span class="text-xs font-mono text-slate-400 font-semibold">Kode: {{ $surat->kode_tracking }}</span>
                    </div>
                    <div>
                        <span class="px-3.5 py-1.5 rounded-full text-xs font-bold shadow-sm {{ $surat->statusColor() }}">
                            {{ $surat->statusLabel() }}
                        </span>
                    </div>
                </div>

                <!-- Visual Timeline Progress -->
                <div>
                    <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-6">Progres Pengerjaan Surat</h3>
                    
                    @php
                        $steps = [
                            'diajukan' => ['label' => 'Diajukan', 'icon' => 'ti-send'],
                            'diproses' => ['label' => 'Diproses', 'icon' => 'ti-rotate-clockwise-2'],
                            'disetujui' => ['label' => 'Disetujui', 'icon' => 'ti-file-check'],
                            'selesai' => ['label' => 'Selesai', 'icon' => 'ti-circle-check']
                        ];
                        
                        $statusOrder = ['diajukan' => 1, 'diproses' => 2, 'disetujui' => 3, 'selesai' => 4, 'ditolak' => -1];
                        $currentStep = $statusOrder[$surat->status] ?? 1;
                    @endphp

                    @if($surat->status === 'ditolak')
                        <div class="bg-red-50 border border-red-200/80 rounded-2xl p-5 flex items-start gap-3">
                            <i class="ti ti-circle-x text-2xl text-red-600 mt-0.5"></i>
                            <div>
                                <h4 class="font-bold text-red-900 text-sm">Pengajuan Ditolak</h4>
                                <p class="text-xs text-red-700/90 mt-1">Maaf, permohonan surat Anda ditolak. Silakan hubungi kantor desa atau periksa catatan di bawah.</p>
                            </div>
                        </div>
                    @else
                        <div class="grid grid-cols-4 gap-2 text-center relative">
                            @foreach ($steps as $key => $step)
                                @php
                                    $stepNum = $statusOrder[$key];
                                    $isDone = $currentStep >= $stepNum;
                                    $isCurrent = $currentStep === $stepNum;
                                @endphp
                                <div class="flex flex-col items-center">
                                    <div class="w-10 h-10 rounded-2xl flex items-center justify-center text-lg mb-2 transition-all duration-300 {{ $isDone ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-600/30' : 'bg-slate-100 text-slate-400' }} {{ $isCurrent ? 'ring-4 ring-emerald-100 font-bold scale-110' : '' }}">
                                        <i class="ti {{ $step['icon'] }}"></i>
                                    </div>
                                    <span class="text-[11px] font-bold {{ $isDone ? 'text-emerald-900' : 'text-slate-400' }}">{{ $step['label'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Detail Metadata -->
                <div class="bg-slate-50/70 border border-slate-100 rounded-2xl p-5 space-y-3 text-xs">
                    <div class="flex justify-between border-b border-slate-200/60 pb-2">
                        <span class="text-slate-400">Nama Pemohon:</span>
                        <span class="font-bold text-slate-700">{{ $surat->nama_pemohon }}</span>
                    </div>
                    <div class="flex justify-between border-b border-slate-200/60 pb-2">
                        <span class="text-slate-400">Tanggal Pengajuan:</span>
                        <span class="font-semibold text-slate-700">{{ $surat->tanggal_pengajuan->translatedFormat('d F Y, H:i') }} WIB</span>
                    </div>
                    @if ($surat->nomor_surat)
                    <div class="flex justify-between border-b border-slate-200/60 pb-2">
                        <span class="text-slate-400">Nomor Surat Resmi:</span>
                        <span class="font-mono font-bold text-emerald-800">{{ $surat->nomor_surat }}</span>
                    </div>
                    @endif
                    @if ($surat->catatan_admin)
                    <div class="pt-1">
                        <span class="text-slate-400 block mb-1">Catatan Petugas Admin:</span>
                        <div class="p-3 rounded-xl bg-white border border-slate-200/80 text-slate-700 font-medium italic">
                            "{{ $surat->catatan_admin }}"
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        @else
            <!-- Error State -->
            <div class="bg-amber-50 border border-amber-200/80 rounded-3xl p-8 text-center text-amber-900 shadow-sm">
                <div class="w-12 h-12 rounded-2xl bg-amber-100 text-amber-700 flex items-center justify-center text-2xl mx-auto mb-3">
                    <i class="ti ti-alert-triangle"></i>
                </div>
                <h3 class="font-bold text-base">Kode Pelacakan Tidak Ditemukan</h3>
                <p class="text-xs text-amber-800/80 mt-1">Pastikan Anda memasukkan kode tracking dengan benar (contoh: SRT-XXXXXX).</p>
            </div>
        @endif
    @endisset
</section>
@endsection

