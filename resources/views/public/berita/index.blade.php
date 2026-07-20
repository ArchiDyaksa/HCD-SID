@extends('layouts.public')

@section('title', 'Berita Desa')

@section('content')
<!-- Header Section -->
<section class="bg-gradient-to-r from-emerald-800 to-teal-900 text-white py-16">
    <div class="max-w-6xl mx-auto px-6 text-center">
        <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight">Kabar & Berita Desa</h1>
        <p class="text-emerald-100 mt-2 text-sm md:text-base font-medium">Informasi resmi seputar pembangunan dan kegiatan warga desa</p>
    </div>
</section>

<section class="max-w-6xl mx-auto px-6 py-12">
    <!-- Filter Form -->
    <form method="GET" class="flex flex-col sm:flex-row gap-4 mb-12 bg-white p-4 rounded-3xl border border-slate-100 shadow-lg shadow-slate-200/40">
        <div class="relative flex-grow">
            <i class="ti ti-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-lg"></i>
            <input type="text" name="q" value="{{ $search ?? '' }}" placeholder="Cari judul berita..."
                   class="w-full border border-slate-200 rounded-2xl pl-11 pr-4 py-3 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none text-sm transition-all duration-300">
        </div>
        <div class="relative min-w-[200px]">
            <i class="ti ti-category absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-lg"></i>
            <select name="kategori" class="w-full border border-slate-200 rounded-2xl pl-11 pr-8 py-3 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none text-sm appearance-none cursor-pointer transition-all duration-300">
                <option value="">Semua Kategori</option>
                @foreach ($kategoriList as $kat)
                    <option value="{{ $kat }}" {{ ($kategori ?? '') === $kat ? 'selected' : '' }}>{{ $kat }}</option>
                @endforeach
            </select>
            <i class="ti ti-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none"></i>
        </div>
        <button class="bg-gradient-to-r from-emerald-600 to-teal-600 text-white px-8 py-3 rounded-2xl font-bold text-sm hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center justify-center gap-2">
            <i class="ti ti-filter"></i>
            <span>Filter</span>
        </button>
    </form>

    <!-- News Grid -->
    @if ($beritas->isEmpty())
        <div class="bg-white rounded-3xl border border-slate-100 shadow p-16 text-center">
            <div class="w-16 h-16 rounded-2xl bg-slate-50 text-slate-400 flex items-center justify-center text-3xl mx-auto mb-4">
                <i class="ti ti-mood-empty"></i>
            </div>
            <h3 class="font-bold text-slate-800 text-lg">Tidak Ada Hasil</h3>
            <p class="text-slate-400 text-sm mt-2">Maaf, kami tidak dapat menemukan berita yang sesuai dengan pencarian Anda.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            @foreach ($beritas as $berita)
            <article class="bg-white border border-slate-100 rounded-3xl overflow-hidden hover:shadow-2xl hover:shadow-slate-200/60 hover:-translate-y-1.5 transition-all duration-300 flex flex-col group">
                <div class="h-52 bg-slate-100 overflow-hidden relative">
                    @if($berita->gambar)
                        <img src="{{ asset('storage/' . $berita->gambar) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="{{ $berita->judul }}">
                    @else
                        <div class="w-full h-full bg-emerald-50 text-emerald-600 flex items-center justify-center">
                            <i class="ti ti-photo-off text-4xl"></i>
                        </div>
                    @endif
                    <div class="absolute top-4 left-4">
                        <span class="px-3 py-1.5 rounded-xl bg-white/95 text-emerald-800 text-[10px] font-bold uppercase tracking-wider shadow-sm backdrop-blur-sm">{{ $berita->kategori }}</span>
                    </div>
                </div>
                <div class="p-6 flex-grow flex flex-col">
                    <div class="text-[11px] font-semibold text-slate-400 mb-2 flex items-center gap-3">
                        <span class="flex items-center gap-1"><i class="ti ti-calendar-event"></i> {{ $berita->tanggal_publish?->translatedFormat('d F Y') }}</span>
                        <span class="flex items-center gap-1"><i class="ti ti-eye"></i> {{ $berita->dilihat }} kali</span>
                    </div>
                    <h3 class="font-extrabold text-slate-800 text-lg leading-snug mb-3 group-hover:text-emerald-800 transition-colors">
                        <a href="{{ route('berita.show', $berita->slug) }}">{{ $berita->judul }}</a>
                    </h3>
                    <p class="text-slate-400 text-xs leading-relaxed mb-6 flex-grow">
                        {{ Str::limit(strip_tags($berita->konten), 120) }}
                    </p>
                    <a href="{{ route('berita.show', $berita->slug) }}" class="inline-flex items-center gap-1 text-emerald-700 hover:text-emerald-800 font-extrabold text-xs group/btn">
                        <span>Baca Selengkapnya</span>
                        <i class="ti ti-chevron-right group-hover/btn:translate-x-0.5 transition-transform"></i>
                    </a>
                </div>
            </article>
            @endforeach
        </div>
        
        <div class="mt-8">
            {{ $beritas->links() }}
        </div>
    @endif
</section>
@endsection

