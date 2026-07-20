@extends('layouts.public')

@section('title', $berita->judul)

@section('content')
<!-- Header Back Button -->
<div class="bg-slate-100 border-b border-slate-200/60 py-4">
    <div class="max-w-3xl mx-auto px-6">
        <a href="{{ route('berita.index') }}" class="inline-flex items-center gap-1.5 text-emerald-700 hover:text-emerald-800 text-sm font-bold group">
            <i class="ti ti-arrow-left group-hover:-translate-x-1 transition-transform"></i>
            <span>Kembali ke Berita</span>
        </a>
    </div>
</div>

<article class="max-w-3xl mx-auto px-6 py-12">
    <!-- Meta Info -->
    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-xl bg-emerald-50 text-emerald-800 text-[10px] font-extrabold uppercase tracking-wider mb-4 border border-emerald-100">
        {{ $berita->kategori }}
    </span>
    <h1 class="text-3xl md:text-4xl font-extrabold text-slate-800 tracking-tight leading-tight mb-4">{{ $berita->judul }}</h1>
    
    <div class="flex flex-wrap items-center gap-x-4 gap-y-2 text-xs text-slate-400 font-semibold mb-8 pb-6 border-b border-slate-100">
        <span class="flex items-center gap-1.5"><i class="ti ti-user text-emerald-600"></i> Oleh {{ $berita->penulis ?: 'Admin Desa' }}</span>
        <span class="text-slate-300">&bull;</span>
        <span class="flex items-center gap-1.5"><i class="ti ti-calendar text-emerald-600"></i> {{ $berita->tanggal_publish?->translatedFormat('d F Y') }}</span>
        <span class="text-slate-300">&bull;</span>
        <span class="flex items-center gap-1.5"><i class="ti ti-eye text-emerald-600"></i> {{ $berita->dilihat }} kali dilihat</span>
    </div>

    <!-- Image -->
    @if ($berita->gambar)
        <div class="rounded-3xl overflow-hidden shadow-lg border border-slate-100 mb-8 max-h-[450px]">
            <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" class="w-full h-full object-cover">
        </div>
    @endif

    <!-- Content -->
    <div class="prose max-w-none text-slate-600 leading-relaxed text-sm md:text-base whitespace-pre-line bg-white border border-slate-100 rounded-3xl p-6 md:p-8 shadow-sm">
        {{ $berita->konten }}
    </div>

    <!-- Related News -->
    @if ($terkait->count())
    <div class="mt-16 pt-8 border-t border-slate-100">
        <h2 class="text-xl font-bold text-slate-800 tracking-tight mb-6">Berita Lainnya</h2>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            @foreach ($terkait as $t)
                <a href="{{ route('berita.show', $t->slug) }}" class="bg-white rounded-2xl border border-slate-100 p-5 shadow-sm hover:shadow-md hover:border-emerald-200 transition-all duration-300 block group">
                    <h3 class="font-extrabold text-slate-800 text-sm leading-snug group-hover:text-emerald-700 transition-colors mb-2 line-clamp-2">{{ $t->judul }}</h3>
                    <div class="text-[10px] text-slate-400 font-semibold flex items-center gap-1">
                        <i class="ti ti-calendar"></i>
                        <span>{{ $t->tanggal_publish?->translatedFormat('d F Y') }}</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
    @endif
</article>
@endsection

