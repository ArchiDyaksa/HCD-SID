@extends('layouts.admin')

@section('title', 'Data Kartu Keluarga (KK)')

@section('content')

<!-- Header Action & Tabs -->
<div class="flex flex-col sm:flex-row items-center justify-between gap-4 mb-6">
    <!-- Sub-navigation Tabs -->
    <div class="flex items-center gap-2 bg-slate-200/60 p-1.5 rounded-2xl w-full sm:w-auto text-xs font-bold">
        <a href="{{ route('admin.penduduk.index') }}" class="px-5 py-2.5 rounded-xl text-slate-600 hover:text-slate-900 transition-all">
            <i class="ti ti-users"></i> Data Per Orang
        </a>
        <a href="{{ route('admin.penduduk.kk') }}" class="px-5 py-2.5 rounded-xl bg-white text-emerald-800 shadow-sm transition-all">
            <i class="ti ti-id-badge-2"></i> Data Kartu Keluarga (KK)
        </a>
    </div>

    <!-- Search Form -->
    <form method="GET" class="w-full sm:w-auto flex gap-2">
        <div class="relative flex-grow sm:w-80">
            <i class="ti ti-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-lg"></i>
            <input type="text" name="q" value="{{ $search ?? '' }}" placeholder="Cari No. KK / Nama Kepala Keluarga..."
                   class="w-full border border-slate-200 rounded-2xl pl-11 pr-4 py-2.5 text-xs focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none transition-all">
        </div>
        <button class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold px-5 py-2.5 rounded-2xl text-xs transition-colors">
            Cari
        </button>
    </form>
</div>

<!-- KK Cards List -->
<div class="space-y-6">
    @forelse ($kkData as $kk)
    <div class="bg-white rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/30 overflow-hidden">
        <!-- KK Header -->
        <div class="bg-gradient-to-r from-emerald-900 to-teal-900 text-white p-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-white/10 flex items-center justify-center text-2xl font-bold backdrop-blur-sm">
                    <i class="ti ti-home"></i>
                </div>
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-widest text-emerald-300">Nomor Kartu Keluarga</span>
                    <h2 class="text-xl font-mono font-extrabold tracking-wider">{{ $kk['no_kk'] }}</h2>
                    <span class="text-xs text-slate-200 font-medium">Kepala Keluarga: <strong>{{ $kk['kepala_keluarga'] }}</strong></span>
                </div>
            </div>
            <div class="text-right">
                <span class="px-3.5 py-1.5 rounded-full bg-white/20 text-white text-xs font-extrabold backdrop-blur-sm">
                    {{ $kk['total_anggota'] }} Anggota Keluarga
                </span>
                <div class="text-xs text-emerald-200 mt-1">RT {{ $kk['rt'] }}/RW {{ $kk['rw'] }}</div>
            </div>
        </div>

        <!-- Members Table -->
        <div class="p-6">
            <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">Anggota Keluarga Terdaftar</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-50 text-slate-400 uppercase font-bold tracking-wider border-b border-slate-100">
                        <tr>
                            <th class="py-3 px-4">NIK</th>
                            <th class="py-3 px-4">Nama Lengkap</th>
                            <th class="py-3 px-4">Jenis Kelamin</th>
                            <th class="py-3 px-4">Tanggal Lahir</th>
                            <th class="py-3 px-4">Pekerjaan</th>
                            <th class="py-3 px-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                        @foreach ($kk['members'] as $idx => $member)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="py-3 px-4 font-mono font-bold text-slate-800">{{ $member->nik }}</td>
                            <td class="py-3 px-4 font-bold text-slate-900 flex items-center gap-2">
                                <span>{{ $member->nama }}</span>
                                @if($idx === 0)
                                    <span class="px-2 py-0.5 rounded-md bg-emerald-50 text-emerald-700 text-[10px] font-extrabold">Kepala Keluarga</span>
                                @endif
                            </td>
                            <td class="py-3 px-4">{{ $member->jenis_kelamin }}</td>
                            <td class="py-3 px-4 text-slate-500">{{ $member->tanggal_lahir ? $member->tanggal_lahir->translatedFormat('d/m/Y') : '-' }}</td>
                            <td class="py-3 px-4">{{ $member->pekerjaan ?: '-' }}</td>
                            <td class="py-3 px-4 text-right">
                                <a href="{{ route('admin.penduduk.show', $member) }}" class="inline-flex items-center gap-1 text-emerald-700 font-bold hover:underline">
                                    <i class="ti ti-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @empty
    <div class="bg-white rounded-3xl border border-slate-100 shadow p-12 text-center text-slate-400">
        Belum ada data Kartu Keluarga (KK) yang terdaftar.
    </div>
    @endforelse
</div>

<div class="mt-6">{{ $kkList->links() }}</div>

@endsection
