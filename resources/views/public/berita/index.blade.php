@extends('layouts.public')

@section('title', 'Berita Desa')

@section('content')
<!-- Header Section -->
<section class="relative bg-gradient-to-br from-emerald-950 via-teal-900 to-slate-900 text-white py-16 px-6 overflow-hidden">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_30%,rgba(16,185,129,0.15),transparent_50%)]"></div>
    <div class="max-w-6xl mx-auto relative z-10 text-center">
        <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 text-xs font-extrabold uppercase tracking-widest mb-4">
            <i class="ti ti-news"></i> Informasi Publik
        </span>
        <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight">Kabar & Berita Desa</h1>
        <p class="text-slate-300 text-sm md:text-base max-w-2xl mx-auto mt-3">Informasi resmi seputar pembangunan, pelayanan, dan kegiatan warga desa.</p>
    </div>
</section>

<section class="max-w-6xl mx-auto px-6 py-12">
    <!-- Filter Form -->
    <form method="GET" action="{{ route('berita.index') }}" class="flex flex-col sm:flex-row gap-4 mb-12 bg-white p-4 rounded-3xl border border-slate-100 shadow-lg shadow-slate-200/40">
        <div class="relative flex-grow">
            <i class="ti ti-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-lg"></i>
            <input type="text" name="q" value="{{ $search ?? '' }}" placeholder="Cari judul atau isi berita..."
                   class="w-full border border-slate-200 rounded-2xl pl-11 pr-4 py-3 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none text-sm transition-all duration-300">
        </div>
        <div class="relative min-w-[220px]">
            <i class="ti ti-category absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-lg"></i>
            <select name="kategori" onchange="this.form.submit()" class="w-full border border-slate-200 rounded-2xl pl-11 pr-8 py-3 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none text-sm appearance-none cursor-pointer transition-all duration-300">
                <option value="">Semua Kategori ({{ $kategoriList->count() }})</option>
                @foreach ($kategoriList as $kat)
                    <option value="{{ $kat }}" {{ ($kategori ?? '') === $kat ? 'selected' : '' }}>{{ $kat }}</option>
                @endforeach
            </select>
            <i class="ti ti-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none"></i>
        </div>
        <button type="submit" class="bg-gradient-to-r from-emerald-600 to-teal-600 text-white px-8 py-3 rounded-2xl font-bold text-sm hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center justify-center gap-2">
            <i class="ti ti-filter"></i>
            <span>Filter</span>
        </button>
        @if(!empty($search) || !empty($kategori))
            <a href="{{ route('berita.index') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-600 px-5 py-3 rounded-2xl font-bold text-sm transition-all flex items-center justify-center gap-1">
                <i class="ti ti-refresh"></i>
                <span>Reset</span>
            </a>
        @endif
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
            <article class="bg-white border border-slate-100 rounded-3xl overflow-hidden hover:shadow-2xl hover:shadow-slate-200/60 hover:-translate-y-1.5 hover:border-emerald-200 transition-all duration-300 flex flex-col group">
                <div class="h-52 bg-slate-100 overflow-hidden relative cursor-pointer"
                     onclick="openBeritaModal('{{ $berita->gambar ? asset('storage/' . $berita->gambar) : '' }}', '{{ addslashes($berita->judul) }}', '{{ $berita->kategori }}', '{{ $berita->tanggal_publish?->translatedFormat('d F Y') }}', '{{ $berita->dilihat }}', '{{ addslashes(strip_tags($berita->konten)) }}', '{{ route('berita.show', $berita->slug) }}')">
                    @if($berita->gambar)
                        <img src="{{ asset('storage/' . $berita->gambar) }}" class="w-full h-full object-cover" alt="{{ $berita->judul }}">
                    @else
                        <div class="w-full h-full bg-emerald-50 text-emerald-600 flex items-center justify-center">
                            <i class="ti ti-photo-off text-4xl"></i>
                        </div>
                    @endif
                    <div class="absolute top-4 left-4">
                        <span class="px-3 py-1.5 rounded-xl bg-white/95 text-emerald-800 text-[10px] font-bold uppercase tracking-wider shadow-sm backdrop-blur-sm">{{ $berita->kategori }}</span>
                    </div>
                    <div class="absolute inset-0 bg-emerald-950/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white gap-2 font-bold text-xs">
                        <i class="ti ti-zoom-in text-2xl"></i>
                        <span>Pratinjau Berita</span>
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
                    <div class="flex items-center justify-between pt-3 border-t border-slate-100 gap-2">
                        <button type="button"
                                onclick="openBeritaModal('{{ $berita->gambar ? asset('storage/' . $berita->gambar) : '' }}', '{{ addslashes($berita->judul) }}', '{{ $berita->kategori }}', '{{ $berita->tanggal_publish?->translatedFormat('d F Y') }}', '{{ $berita->dilihat }}', '{{ addslashes(strip_tags($berita->konten)) }}', '{{ route('berita.show', $berita->slug) }}')"
                                class="inline-flex items-center gap-1 text-slate-500 hover:text-emerald-700 font-bold text-xs">
                            <i class="ti ti-eye"></i> Pratinjau
                        </button>
                        <div class="flex items-center gap-1">
                            <button type="button" 
                                    onclick="shareToWhatsapp('{{ addslashes($berita->judul) }}', '{{ route('berita.show', $berita->slug) }}', 'Berita Desa')"
                                    title="Bagikan via WhatsApp"
                                    class="w-7 h-7 rounded-lg bg-emerald-50 text-emerald-600 hover:bg-emerald-600 hover:text-white flex items-center justify-center transition-colors text-sm">
                                <i class="ti ti-brand-whatsapp"></i>
                            </button>
                            <button type="button" 
                                    onclick="copyToClipboard('{{ route('berita.show', $berita->slug) }}', 'Link berita berhasil disalin!')"
                                    title="Salin Link"
                                    class="w-7 h-7 rounded-lg bg-slate-100 text-slate-600 hover:bg-slate-700 hover:text-white flex items-center justify-center transition-colors text-sm">
                                <i class="ti ti-link"></i>
                            </button>
                            <a href="{{ route('berita.show', $berita->slug) }}" class="inline-flex items-center gap-1 text-emerald-700 hover:text-emerald-800 font-extrabold text-xs group/btn ml-1">
                                <span>Baca</span>
                                <i class="ti ti-chevron-right group-hover/btn:translate-x-0.5 transition-transform"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </article>
            @endforeach
        </div>
        
        <div class="mt-8">
            {{ $beritas->links() }}
        </div>
    @endif
</section>

<!-- Modal Detail Pratinjau Berita -->
<div id="modal-berita" class="fixed inset-0 bg-slate-950/80 backdrop-blur-md z-50 flex items-center justify-center p-4 hidden animate-fadeIn" onclick="closeBeritaModalOnBackdrop(event)">
    <div class="bg-white rounded-3xl border border-slate-100 shadow-2xl max-w-2xl w-full overflow-hidden relative" onclick="event.stopPropagation()">
        <!-- Close Button -->
        <button onclick="closeBeritaModal()" class="absolute top-4 right-4 z-10 w-9 h-9 rounded-full bg-slate-900/60 hover:bg-slate-900 text-white flex items-center justify-center transition-colors">
            <i class="ti ti-x text-lg"></i>
        </button>

        <!-- Image Header -->
        <div id="modal-berita-img-container" class="w-full h-64 md:h-80 bg-slate-900 flex items-center justify-center relative overflow-hidden">
            <img id="modal-berita-img" src="" alt="" class="w-full h-full object-cover">
            <div id="modal-berita-placeholder" class="hidden text-slate-400 flex flex-col items-center gap-2">
                <i class="ti ti-news text-5xl"></i>
                <span class="text-xs font-semibold">Berita Resmi Desa</span>
            </div>
        </div>

        <!-- Details Container -->
        <div class="p-6 md:p-8 space-y-4">
            <div class="flex items-center justify-between gap-3 text-xs">
                <span id="modal-berita-kategori" class="px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 font-extrabold"></span>
                <div class="text-slate-400 font-semibold space-x-3">
                    <span id="modal-berita-tanggal"></span>
                    <span id="modal-berita-dilihat"></span>
                </div>
            </div>

            <h2 id="modal-berita-judul" class="text-xl md:text-2xl font-extrabold text-slate-800 tracking-tight leading-snug"></h2>

            <p id="modal-berita-konten" class="text-slate-600 text-xs md:text-sm leading-relaxed whitespace-pre-line bg-slate-50 p-4 rounded-2xl border border-slate-100 max-h-48 overflow-y-auto"></p>

            <div class="pt-3 border-t border-slate-100 flex flex-wrap justify-between items-center gap-3">
                <div class="flex items-center gap-2">
                    <button type="button" id="modal-berita-wa-btn" class="bg-[#25D366] hover:bg-[#20bd5a] text-white font-bold px-4 py-2.5 rounded-2xl text-xs shadow-sm transition-all flex items-center gap-1.5">
                        <i class="ti ti-brand-whatsapp text-base"></i>
                        <span>Bagikan WA</span>
                    </button>
                    <button type="button" id="modal-berita-copy-btn" class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold px-4 py-2.5 rounded-2xl text-xs transition-colors flex items-center gap-1.5">
                        <i class="ti ti-link text-base"></i>
                        <span>Salin Link</span>
                    </button>
                </div>
                <div class="flex items-center gap-2">
                    <button onclick="closeBeritaModal()" class="bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold px-4 py-2.5 rounded-2xl text-xs transition-colors">
                        Tutup
                    </button>
                    <a id="modal-berita-link" href="" class="bg-emerald-700 hover:bg-emerald-800 text-white font-bold px-5 py-2.5 rounded-2xl text-xs shadow-md transition-all flex items-center gap-1.5">
                        <span>Baca Artikel Selengkapnya</span>
                        <i class="ti ti-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function openBeritaModal(fotoUrl, judul, kategori, tanggal, dilihat, konten, linkUrl) {
    const imgEl = document.getElementById('modal-berita-img');
    const placeholderEl = document.getElementById('modal-berita-placeholder');

    if (fotoUrl) {
        imgEl.src = fotoUrl;
        imgEl.classList.remove('hidden');
        placeholderEl.classList.add('hidden');
    } else {
        imgEl.classList.add('hidden');
        placeholderEl.classList.remove('hidden');
    }

    document.getElementById('modal-berita-judul').innerText = judul;
    document.getElementById('modal-berita-kategori').innerText = kategori;
    document.getElementById('modal-berita-tanggal').innerText = tanggal || '';
    document.getElementById('modal-berita-dilihat').innerText = dilihat ? '• ' + dilihat + ' kali dilihat' : '';
    document.getElementById('modal-berita-konten').innerText = konten;
    document.getElementById('modal-berita-link').href = linkUrl;

    document.getElementById('modal-berita-wa-btn').onclick = function() {
        shareToWhatsapp(judul, linkUrl, 'Berita Desa');
    };
    document.getElementById('modal-berita-copy-btn').onclick = function() {
        copyToClipboard(linkUrl, 'Link berita berhasil disalin!');
    };

    document.getElementById('modal-berita').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeBeritaModal() {
    document.getElementById('modal-berita').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

function closeBeritaModalOnBackdrop(e) {
    if (e.target.id === 'modal-berita') {
        closeBeritaModal();
    }
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeBeritaModal();
    }
});
</script>
@endsection

