@extends('layouts.admin')

@section('title', 'Pengajuan Surat')

@section('content')

<!-- Header Filter & Search -->
<div class="flex flex-col sm:flex-row items-center justify-between gap-4 mb-8">
    <form method="GET" class="w-full flex flex-col md:flex-row flex-wrap gap-3">
        <div class="relative flex-grow min-w-[200px]">
            <i class="ti ti-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-lg"></i>
            <input type="text" name="q" value="{{ $search ?? '' }}" placeholder="Cari kode / pemohon / NIK..."
                   class="w-full border border-slate-200 rounded-2xl pl-11 pr-4 py-2.5 text-xs focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none transition-all">
        </div>
        
        <div class="relative min-w-[180px]">
            <select name="status" class="w-full border border-slate-200 rounded-2xl pl-4 pr-8 py-2.5 text-xs focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none appearance-none cursor-pointer transition-all">
                <option value="">Semua Status</option>
                @foreach (['diajukan' => 'Menunggu Verifikasi', 'diproses' => 'Sedang Diproses', 'disetujui' => 'Disetujui', 'ditolak' => 'Ditolak', 'selesai' => 'Selesai'] as $val => $label)
                    <option value="{{ $val }}" {{ ($status ?? '') === $val ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
            <i class="ti ti-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none"></i>
        </div>

        <div class="flex items-center gap-2">
            <input type="date" name="dari_tanggal" value="{{ request('dari_tanggal') }}" placeholder="Dari Tgl"
                   class="border border-slate-200 rounded-2xl px-3 py-2 text-xs text-slate-600 focus:ring-2 focus:ring-emerald-500 focus:outline-none">
            <span class="text-xs text-slate-400 font-bold">s/d</span>
            <input type="date" name="sampai_tanggal" value="{{ request('sampai_tanggal') }}" placeholder="Sampai Tgl"
                   class="border border-slate-200 rounded-2xl px-3 py-2 text-xs text-slate-600 focus:ring-2 focus:ring-emerald-500 focus:outline-none">
        </div>

        <button class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold px-6 py-2.5 rounded-2xl text-xs transition-colors flex items-center justify-center gap-1.5">
            <i class="ti ti-filter"></i>
            <span>Filter</span>
        </button>
    </form>
</div>

<!-- Table Card -->
<div class="bg-white rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/30 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-xs">
            <thead class="bg-slate-50/80 text-slate-400 uppercase font-bold tracking-wider border-b border-slate-100">
                <tr>
                    <th class="px-6 py-4">Kode Tracking</th>
                    <th class="px-6 py-4">Nama Pemohon</th>
                    <th class="px-6 py-4">Jenis Surat</th>
                    <th class="px-6 py-4">Tanggal Masuk</th>
                    <th class="px-6 py-4">Status Pengerjaan</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                @forelse ($surats as $s)
                <tr class="hover:bg-slate-50/80 transition-colors">
                    <td class="px-6 py-4 font-mono font-bold text-emerald-800">{{ $s->kode_tracking }}</td>
                    <td class="px-6 py-4 font-bold text-slate-900">{{ $s->nama_pemohon }}</td>
                    <td class="px-6 py-4">{{ $s->jenisSurat->nama_surat }}</td>
                    <td class="px-6 py-4 text-slate-500">{{ $s->tanggal_pengajuan->format('d/m/Y H:i') }} WIB</td>
                    <td class="px-6 py-4">
                        <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold {{ $s->statusColor() }}">
                            {{ $s->statusLabel() }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right whitespace-nowrap">
                        <a href="{{ route('admin.surat.show', $s) }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-xl bg-slate-100 hover:bg-emerald-50 text-slate-600 hover:text-emerald-700 font-bold text-[11px] transition-colors">
                            <i class="ti ti-adjustments"></i> Kelola Status
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-slate-400">Belum ada pengajuan surat yang masuk.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6">{{ $surats->links() }}</div>

@endsection

