@extends('layouts.public')

@section('title', 'Layanan Surat')

@section('content')
<!-- Header Section -->
<section class="bg-gradient-to-r from-emerald-800 to-teal-900 text-white py-16">
    <div class="max-w-5xl mx-auto px-6 text-center">
        <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight">Layanan Mandiri Pengajuan Surat</h1>
        <p class="text-emerald-100 mt-2 text-sm md:text-base font-medium">Buat permohonan surat administrasi desa secara daring, cepat, dan transparan.</p>
    </div>
</section>

<section class="max-w-5xl mx-auto px-6 py-12">
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
        @foreach ($jenisSurats as $jenis)
        <div class="bg-white rounded-3xl border border-slate-100 shadow-lg shadow-slate-200/40 p-8 flex flex-col hover:border-emerald-200 transition-colors duration-300 group">
            <div class="flex items-center gap-3.5 mb-5">
                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-xl group-hover:scale-105 transition-transform">
                    <i class="ti ti-file-text"></i>
                </div>
                <h2 class="font-extrabold text-slate-800 text-lg leading-tight">{{ $jenis->nama_surat }}</h2>
            </div>
            
            <p class="text-slate-400 text-xs leading-relaxed mb-6 flex-grow">{{ $jenis->deskripsi }}</p>

            @if ($jenis->persyaratan)
            <div class="mb-6 bg-slate-50/70 p-5 rounded-2xl border border-slate-100">
                <div class="text-xs font-bold text-slate-700 uppercase tracking-wider mb-2 flex items-center gap-1.5">
                    <i class="ti ti-clipboard-list text-emerald-600"></i> Persyaratan Dokumen
                </div>
                <ul class="text-xs text-slate-500 space-y-2">
                    @foreach ($jenis->persyaratan_array as $syarat)
                        <li class="flex items-start gap-2">
                            <i class="ti ti-check text-emerald-600 mt-0.5"></i>
                            <span>{{ $syarat }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
            @endif

            <a href="{{ route('layanan.form', $jenis) }}" class="w-full bg-slate-50 hover:bg-emerald-700 text-slate-700 hover:text-white font-bold py-3 px-5 rounded-2xl text-center text-xs flex items-center justify-center gap-2 border border-slate-200/60 hover:border-emerald-700 hover:shadow-lg hover:shadow-emerald-700/20 transition-all duration-300">
                <span>Ajukan Surat Ini</span>
                <i class="ti ti-arrow-right"></i>
            </a>
        </div>
        @endforeach
    </div>
</section>
@endsection

