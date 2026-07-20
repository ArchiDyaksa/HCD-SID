@extends('layouts.admin')

@section('title', 'Dashboard Overview')

@section('content')

<!-- Stat Cards Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Card 1: Penduduk -->
    <div class="bg-white rounded-3xl border border-slate-100 p-6 shadow-xl shadow-slate-200/30 flex items-center justify-between group hover:border-emerald-200 transition-colors duration-300">
        <div>
            <div class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Total Penduduk</div>
            <div class="text-3xl font-extrabold text-slate-800 tracking-tight">{{ number_format($totalPenduduk) }}</div>
            <div class="text-[11px] font-semibold text-slate-400 mt-1 flex items-center gap-1">
                <span>{{ $lakiLaki }} Laki-laki</span> &bull; <span>{{ $perempuan }} Perempuan</span>
            </div>
        </div>
        <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-2xl group-hover:scale-105 transition-transform">
            <i class="ti ti-users"></i>
        </div>
    </div>

    <!-- Card 2: Surat Pending -->
    <div class="bg-white rounded-3xl border border-slate-100 p-6 shadow-xl shadow-slate-200/30 flex items-center justify-between group hover:border-amber-200 transition-colors duration-300">
        <div>
            <div class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Menunggu / Diproses</div>
            <div class="text-3xl font-extrabold text-amber-600 tracking-tight">{{ number_format($suratPending) }}</div>
            <a href="{{ route('admin.surat.index') }}" class="text-xs font-bold text-emerald-700 hover:text-emerald-800 mt-1 inline-flex items-center gap-1 group/link">
                <span>Proses Surat</span>
                <i class="ti ti-arrow-right group-hover/link:translate-x-0.5 transition-transform"></i>
            </a>
        </div>
        <div class="w-14 h-14 rounded-2xl bg-amber-50 text-amber-700 flex items-center justify-center text-2xl group-hover:scale-105 transition-transform">
            <i class="ti ti-clock"></i>
        </div>
    </div>

    <!-- Card 3: Surat Selesai Bulan Ini -->
    <div class="bg-white rounded-3xl border border-slate-100 p-6 shadow-xl shadow-slate-200/30 flex items-center justify-between group hover:border-teal-200 transition-colors duration-300">
        <div>
            <div class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Selesai Bulan Ini</div>
            <div class="text-3xl font-extrabold text-teal-700 tracking-tight">{{ number_format($suratSelesaiBulanIni) }}</div>
            <div class="text-[11px] font-semibold text-teal-600 mt-1">Status Disetujui</div>
        </div>
        <div class="w-14 h-14 rounded-2xl bg-teal-50 text-teal-700 flex items-center justify-center text-2xl group-hover:scale-105 transition-transform">
            <i class="ti ti-square-check"></i>
        </div>
    </div>

    <!-- Card 4: Berita Terbit -->
    <div class="bg-white rounded-3xl border border-slate-100 p-6 shadow-xl shadow-slate-200/30 flex items-center justify-between group hover:border-blue-200 transition-colors duration-300">
        <div>
            <div class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Berita Terbit</div>
            <div class="text-3xl font-extrabold text-blue-700 tracking-tight">{{ number_format($totalBerita) }}</div>
            <a href="{{ route('admin.berita.index') }}" class="text-xs font-bold text-emerald-700 hover:text-emerald-800 mt-1 inline-flex items-center gap-1 group/link">
                <span>Kelola Berita</span>
                <i class="ti ti-arrow-right group-hover/link:translate-x-0.5 transition-transform"></i>
            </a>
        </div>
        <div class="w-14 h-14 rounded-2xl bg-blue-50 text-blue-700 flex items-center justify-center text-2xl group-hover:scale-105 transition-transform">
            <i class="ti ti-news"></i>
        </div>
    </div>
</div>

<!-- Main Content Grid -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Left Column: Recent Applications -->
    <div class="lg:col-span-2 bg-white rounded-3xl border border-slate-100 p-6 md:p-8 shadow-xl shadow-slate-200/30">
        <div class="flex items-center justify-between mb-6 pb-4 border-b border-slate-100">
            <div>
                <h2 class="font-extrabold text-slate-800 text-lg tracking-tight">Pengajuan Surat Terbaru</h2>
                <p class="text-xs text-slate-400 mt-0.5">Permohonan warga yang perlu ditindaklanjuti.</p>
            </div>
            <a href="{{ route('admin.surat.index') }}" class="text-xs font-bold text-emerald-700 hover:text-emerald-800 flex items-center gap-1">
                <span>Lihat Semua</span>
                <i class="ti ti-chevron-right"></i>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="text-slate-400 uppercase font-bold tracking-wider border-b border-slate-100">
                        <th class="pb-3 px-2">Kode</th>
                        <th class="pb-3 px-2">Pemohon</th>
                        <th class="pb-3 px-2">Jenis Surat</th>
                        <th class="pb-3 px-2">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                    @forelse ($suratTerbaru as $surat)
                    <tr class="hover:bg-slate-50/80 transition-colors">
                        <td class="py-3.5 px-2 font-mono font-bold">
                            <a href="{{ route('admin.surat.show', $surat) }}" class="text-emerald-700 hover:text-emerald-900 underline underline-offset-2">
                                {{ $surat->kode_tracking }}
                            </a>
                        </td>
                        <td class="py-3.5 px-2 font-bold text-slate-800">{{ $surat->nama_pemohon }}</td>
                        <td class="py-3.5 px-2">{{ $surat->jenisSurat->nama_surat }}</td>
                        <td class="py-3.5 px-2">
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold {{ $surat->statusColor() }}">
                                {{ $surat->statusLabel() }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-8 text-center text-slate-400">Belum ada pengajuan surat terbaru.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Right Column: Distribution -->
    <div class="bg-white rounded-3xl border border-slate-100 p-6 md:p-8 shadow-xl shadow-slate-200/30">
        <div class="mb-6 pb-4 border-b border-slate-100">
            <h2 class="font-extrabold text-slate-800 text-lg tracking-tight">Surat per Jenis</h2>
            <p class="text-xs text-slate-400 mt-0.5">Distribusi permohonan surat warga.</p>
        </div>

        <div class="space-y-4">
            @forelse ($suratPerJenis as $item)
                @php $max = $suratPerJenis->max('total') ?: 1; @endphp
                <div>
                    <div class="flex justify-between text-xs font-semibold mb-1.5">
                        <span class="text-slate-700">{{ $item->jenisSurat->nama_surat ?? '-' }}</span>
                        <span class="font-bold text-emerald-800">{{ $item->total }}</span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden">
                        <div class="bg-gradient-to-r from-emerald-500 to-teal-500 h-2 rounded-full transition-all duration-500" style="width: {{ ($item->total / $max) * 100 }}%"></div>
                    </div>
                </div>
            @empty
                <p class="text-slate-400 text-xs text-center py-6">Belum ada data distribusi jenis surat.</p>
            @endforelse
        </div>
    </div>
</div>

@endsection

