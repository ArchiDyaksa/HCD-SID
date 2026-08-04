@extends('layouts.admin')

@section('title', 'Detail Profil Warga')

@section('content')

<div class="mb-6">
    <a href="{{ route('admin.penduduk.index') }}" class="inline-flex items-center gap-1.5 text-xs text-slate-500 hover:text-emerald-700 font-bold transition-colors group">
        <i class="ti ti-arrow-left group-hover:-translate-x-1 transition-transform"></i>
        <span>Kembali ke Data Penduduk</span>
    </a>
</div>

<div class="max-w-4xl mx-auto space-y-6">
    <!-- Main Card -->
    <div class="bg-white rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/30 p-6 md:p-8">
        <div class="flex flex-col md:flex-row items-start gap-6 border-b border-slate-100 pb-6 mb-6">
            <div class="w-24 h-24 rounded-2xl bg-emerald-50 text-emerald-700 border border-emerald-100 flex items-center justify-center text-4xl flex-shrink-0 overflow-hidden shadow-inner">
                @if ($penduduk->foto)
                    <img src="{{ asset('storage/' . $penduduk->foto) }}" alt="{{ $penduduk->nama }}" class="w-full h-full object-cover">
                @else
                    <i class="ti ti-user"></i>
                @endif
            </div>

            <div class="flex-grow">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                    <div>
                        <span class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Profil Demografis Warga</span>
                        <h1 class="text-2xl font-extrabold text-slate-800 tracking-tight mt-0.5">{{ $penduduk->nama }}</h1>
                    </div>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.penduduk.edit', $penduduk) }}" class="inline-flex items-center gap-1 px-4 py-2 rounded-xl bg-slate-100 hover:bg-emerald-50 text-slate-700 hover:text-emerald-700 font-bold text-xs transition-colors">
                            <i class="ti ti-edit"></i> Edit Data
                        </a>
                    </div>
                </div>

                <div class="flex flex-wrap items-center gap-3 mt-4 text-xs font-semibold">
                    <span class="px-3 py-1 rounded-full {{ $penduduk->jenis_kelamin === 'Laki-laki' ? 'bg-blue-50 text-blue-700' : 'bg-pink-50 text-pink-700' }}">
                        <i class="ti {{ $penduduk->jenis_kelamin === 'Laki-laki' ? 'ti-gender-male' : 'ti-gender-female' }}"></i> {{ $penduduk->jenis_kelamin }}
                    </span>
                    <span class="px-3 py-1 rounded-full bg-slate-100 text-slate-600">
                        NIK: <span class="font-mono font-bold text-slate-800">{{ $penduduk->nik }}</span>
                    </span>
                    @if ($penduduk->no_kk)
                    <span class="px-3 py-1 rounded-full bg-emerald-50 text-emerald-800">
                        No. KK: <span class="font-mono font-bold">{{ $penduduk->no_kk }}</span>
                    </span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Detail Data Demografi Grid -->
        <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">Informasi Lengkap Kependudukan</h3>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 text-xs bg-slate-50/70 p-6 rounded-2xl border border-slate-100">
            <div>
                <span class="text-slate-400 block mb-1">Tempat, Tanggal Lahir</span>
                <span class="font-bold text-slate-800">
                    {{ $penduduk->tempat_lahir ?: '-' }}, {{ $penduduk->tanggal_lahir ? $penduduk->tanggal_lahir->translatedFormat('d F Y') : '-' }}
                </span>
            </div>

            <div>
                <span class="text-slate-400 block mb-1">Agama</span>
                <span class="font-bold text-slate-800">{{ $penduduk->agama ?: '-' }}</span>
            </div>

            <div>
                <span class="text-slate-400 block mb-1">Status Perkawinan</span>
                <span class="font-bold text-slate-800">{{ $penduduk->status_perkawinan ?: '-' }}</span>
            </div>

            <div>
                <span class="text-slate-400 block mb-1">Pekerjaan</span>
                <span class="font-bold text-slate-800">{{ $penduduk->pekerjaan ?: '-' }}</span>
            </div>

            <div>
                <span class="text-slate-400 block mb-1">Pendidikan Terakhir</span>
                <span class="font-bold text-slate-800">{{ $penduduk->pendidikan_terakhir ?: '-' }}</span>
            </div>

            <div>
                <span class="text-slate-400 block mb-1">RT / RW</span>
                <span class="font-bold text-slate-800">RT {{ $penduduk->rt ?: '0' }} / RW {{ $penduduk->rw ?: '0' }}</span>
            </div>

            <div class="sm:col-span-2 md:col-span-3">
                <span class="text-slate-400 block mb-1">Alamat Tempat Tinggal</span>
                <span class="font-bold text-slate-800 leading-relaxed">{{ $penduduk->alamat ?: '-' }}</span>
            </div>
        </div>
    </div>

    <!-- Anggota Keluarga Serumah (Kartu Keluarga) -->
    @if ($anggotaKeluarga->count())
    <div class="bg-white rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/30 p-6 md:p-8">
        <div class="flex items-center justify-between mb-4 pb-3 border-b border-slate-100">
            <div>
                <h3 class="font-bold text-slate-800 text-sm tracking-tight">Anggota Keluarga (KK: {{ $penduduk->no_kk }})</h3>
                <p class="text-xs text-slate-400">Daftar anggota keluarga yang terdaftar dalam satu Kartu Keluarga.</p>
            </div>
            <a href="{{ route('admin.penduduk.kk') }}?q={{ $penduduk->no_kk }}" class="text-xs font-bold text-emerald-700 hover:underline">Lihat Struktur KK</a>
        </div>

        <div class="divide-y divide-slate-100 text-xs font-medium">
            @foreach ($anggotaKeluarga as $anggota)
            <div class="py-3 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-slate-100 text-slate-600 flex items-center justify-center font-bold">
                        <i class="ti ti-user"></i>
                    </div>
                    <div>
                        <a href="{{ route('admin.penduduk.show', $anggota) }}" class="font-bold text-slate-800 hover:text-emerald-700">{{ $anggota->nama }}</a>
                        <span class="text-slate-400 block text-[11px]">NIK: {{ $anggota->nik }}</span>
                    </div>
                </div>
                <div class="text-slate-500">
                    {{ $anggota->jenis_kelamin }}
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>

@endsection
