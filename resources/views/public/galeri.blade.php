@extends('layouts.public')

@section('title', 'Galeri Foto Kegiatan Desa')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-br from-emerald-950 via-teal-900 to-slate-900 text-white py-16 px-6 overflow-hidden">
    <div class="max-w-6xl mx-auto relative z-10 text-center">
        <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 text-xs font-extrabold uppercase tracking-widest mb-4">
            <i class="ti ti-photo-heart"></i> Dokumentasi Desa
        </span>
        <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight">Galeri Foto Kegiatan Desa</h1>
        <p class="text-slate-300 text-sm md:text-base max-w-2xl mx-auto mt-3">Dokumentasi momen, program pembangunan, gotong royong, dan kegiatan kemasyarakatan desa.</p>
    </div>
</section>

<!-- Main Content -->
<section class="max-w-6xl mx-auto px-6 py-12">
    <!-- Filter Form -->
    <form method="GET" action="{{ route('galeri.index') }}" class="flex flex-col sm:flex-row gap-4 mb-12 bg-white p-4 rounded-3xl border border-slate-100 shadow-lg shadow-slate-200/40">
        <div class="relative flex-grow">
            <i class="ti ti-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-lg"></i>
            <input type="text" name="q" value="{{ $search ?? '' }}" placeholder="Cari judul dokumentasi atau deskripsi foto..."
                   class="w-full border border-slate-200 rounded-2xl pl-11 pr-4 py-3 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none text-sm transition-all duration-300">
        </div>
        <div class="relative min-w-[220px]">
            <i class="ti ti-category absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-lg"></i>
            <select name="kategori" onchange="this.form.submit()" class="w-full border border-slate-200 rounded-2xl pl-11 pr-8 py-3 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none text-sm appearance-none cursor-pointer transition-all duration-300">
                <option value="">Semua Kategori ({{ $kategoriList->count() }})</option>
                @foreach ($kategoriList as $kat)
                    <option value="{{ $kat }}" {{ ($selectedKategori ?? '') === $kat ? 'selected' : '' }}>{{ $kat }}</option>
                @endforeach
            </select>
            <i class="ti ti-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none"></i>
        </div>
        <button type="submit" class="bg-gradient-to-r from-emerald-600 to-teal-600 text-white px-8 py-3 rounded-2xl font-bold text-sm hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center justify-center gap-2">
            <i class="ti ti-filter"></i>
            <span>Filter</span>
        </button>
        @if(!empty($search) || !empty($selectedKategori))
            <a href="{{ route('galeri.index') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-600 px-5 py-3 rounded-2xl font-bold text-sm transition-all flex items-center justify-center gap-1">
                <i class="ti ti-refresh"></i>
                <span>Reset</span>
            </a>
        @endif
    </form>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @forelse ($galeris as $galeri)
        <div onclick="openGaleriModal('{{ $galeri->foto ? asset('storage/' . $galeri->foto) : '' }}', '{{ addslashes($galeri->judul) }}', '{{ $galeri->kategori }}', '{{ $galeri->tanggal ? $galeri->tanggal->translatedFormat('d F Y') : '-' }}', '{{ addslashes($galeri->deskripsi ?: 'Tidak ada deskripsi tambahan.') }}')"
             class="bg-white rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/30 overflow-hidden group hover:-translate-y-1 hover:border-emerald-200 hover:shadow-2xl transition-all duration-300 cursor-pointer">
            <div class="h-52 bg-slate-100 overflow-hidden relative">
                @if ($galeri->foto)
                    <img src="{{ asset('storage/' . $galeri->foto) }}" alt="{{ $galeri->judul }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center text-slate-300 bg-slate-50 text-4xl">
                        <i class="ti ti-photo"></i>
                    </div>
                @endif
                <span class="absolute top-3 right-3 px-3 py-1 rounded-full bg-slate-900/60 backdrop-blur-md text-white text-[10px] font-bold">
                    {{ $galeri->kategori }}
                </span>
                <div class="absolute inset-0 bg-emerald-950/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white gap-2 font-bold text-xs">
                    <i class="ti ti-zoom-in text-2xl"></i>
                    <span>Klik Untuk Detail</span>
                </div>
            </div>

            <div class="p-6">
                <span class="text-[10px] text-slate-400 font-bold uppercase block mb-1">
                    {{ $galeri->tanggal ? $galeri->tanggal->translatedFormat('d F Y') : '-' }}
                </span>
                <h3 class="text-base font-extrabold text-slate-800 tracking-tight mb-2 group-hover:text-emerald-700 transition-colors">{{ $galeri->judul }}</h3>
                <p class="text-slate-500 text-xs leading-relaxed line-clamp-2">{{ $galeri->deskripsi ?: '-' }}</p>
            </div>
        </div>
        @empty
        <div class="col-span-full bg-white rounded-3xl border border-slate-100 p-12 text-center text-slate-400 shadow-sm">
            <div class="w-16 h-16 rounded-2xl bg-slate-50 text-slate-400 flex items-center justify-center text-3xl mx-auto mb-4">
                <i class="ti ti-photo-off"></i>
            </div>
            <h3 class="font-bold text-slate-800 text-lg">Tidak Ada Galeri Ditemukan</h3>
            <p class="text-slate-400 text-sm mt-2">Maaf, tidak ada foto dokumentasi yang sesuai dengan pencarian atau filter Anda.</p>
        </div>
        @endforelse
    </div>

    <div class="mt-8">{{ $galeris->links() }}</div>
</section>

<!-- Modal Detail Galeri Foto -->
<div id="modal-galeri" class="fixed inset-0 bg-slate-950/80 backdrop-blur-md z-50 flex items-center justify-center p-4 hidden animate-fadeIn" onclick="closeGaleriModalOnBackdrop(event)">
    <div class="bg-white rounded-3xl border border-slate-100 shadow-2xl max-w-2xl w-full overflow-hidden relative" onclick="event.stopPropagation()">
        <!-- Close Button -->
        <button onclick="closeGaleriModal()" class="absolute top-4 right-4 z-10 w-9 h-9 rounded-full bg-slate-900/60 hover:bg-slate-900 text-white flex items-center justify-center transition-colors">
            <i class="ti ti-x text-lg"></i>
        </button>

        <!-- Image Container -->
        <div id="modal-galeri-img-container" class="w-full h-72 md:h-96 bg-slate-900 flex items-center justify-center relative overflow-hidden">
            <img id="modal-galeri-img" src="" alt="" class="w-full h-full object-cover">
            <div id="modal-galeri-placeholder" class="hidden text-slate-400 flex flex-col items-center gap-2">
                <i class="ti ti-photo text-5xl"></i>
                <span class="text-xs font-semibold">Tidak ada foto dokumentasi</span>
            </div>
        </div>

        <!-- Details Container -->
        <div class="p-6 md:p-8 space-y-4">
            <div class="flex items-center justify-between gap-3 text-xs">
                <span id="modal-galeri-kategori" class="px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 font-extrabold"></span>
                <span id="modal-galeri-tanggal" class="text-slate-400 font-semibold"></span>
            </div>

            <h2 id="modal-galeri-judul" class="text-xl md:text-2xl font-extrabold text-slate-800 tracking-tight"></h2>

            <p id="modal-galeri-deskripsi" class="text-slate-600 text-xs md:text-sm leading-relaxed whitespace-pre-line bg-slate-50 p-4 rounded-2xl border border-slate-100"></p>

            <div class="pt-2 flex justify-end">
                <button onclick="closeGaleriModal()" class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold px-6 py-2.5 rounded-2xl text-xs transition-colors">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function openGaleriModal(fotoUrl, judul, kategori, tanggal, deskripsi) {
    const imgEl = document.getElementById('modal-galeri-img');
    const placeholderEl = document.getElementById('modal-galeri-placeholder');

    if (fotoUrl) {
        imgEl.src = fotoUrl;
        imgEl.classList.remove('hidden');
        placeholderEl.classList.add('hidden');
    } else {
        imgEl.classList.add('hidden');
        placeholderEl.classList.remove('hidden');
    }

    document.getElementById('modal-galeri-judul').innerText = judul;
    document.getElementById('modal-galeri-kategori').innerText = kategori;
    document.getElementById('modal-galeri-tanggal').innerText = tanggal;
    document.getElementById('modal-galeri-deskripsi').innerText = deskripsi;

    document.getElementById('modal-galeri').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeGaleriModal() {
    document.getElementById('modal-galeri').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

function closeGaleriModalOnBackdrop(e) {
    if (e.target.id === 'modal-galeri') {
        closeGaleriModal();
    }
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeGaleriModal();
    }
});
</script>
@endsection
