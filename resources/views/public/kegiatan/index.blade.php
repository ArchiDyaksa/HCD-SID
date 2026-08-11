@extends('layouts.public')

@section('title', 'Kalender & Agenda Kegiatan Desa')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-br from-emerald-950 via-teal-900 to-slate-900 text-white py-16 px-6 overflow-hidden">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_30%,rgba(16,185,129,0.15),transparent_50%)]"></div>
    <div class="max-w-6xl mx-auto relative z-10 text-center">
        <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 text-xs font-extrabold uppercase tracking-widest mb-4">
            <i class="ti ti-calendar-event"></i> Jadwal Kegiatan Masyarakat
        </span>
        <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight">Kalender & Agenda Desa</h1>
        <p class="text-slate-300 text-sm md:text-base max-w-2xl mx-auto mt-3">Pantau seluruh jadwal kegiatan kemasyarakatan, musyawarah desa, gotong royong, dan pelayanan publik secara transparan.</p>
    </div>
</section>

<!-- Main Content -->
<section class="max-w-6xl mx-auto px-6 py-12">
    <!-- Filter Form -->
    <form method="GET" action="{{ route('kegiatan.index') }}" class="flex flex-col sm:flex-row gap-4 mb-12 bg-white p-4 rounded-3xl border border-slate-100 shadow-lg shadow-slate-200/40">
        <div class="relative flex-grow">
            <i class="ti ti-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-lg"></i>
            <input type="text" name="q" value="{{ $search ?? '' }}" placeholder="Cari nama kegiatan, lokasi, atau penyelenggara..."
                   class="w-full border border-slate-200 rounded-2xl pl-11 pr-4 py-3 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none text-sm transition-all duration-300">
        </div>
        <div class="relative min-w-[200px]">
            <i class="ti ti-calendar-stats absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-lg"></i>
            <select name="status" onchange="this.form.submit()" class="w-full border border-slate-200 rounded-2xl pl-11 pr-8 py-3 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none text-sm appearance-none cursor-pointer transition-all duration-300">
                <option value="">Semua Status Agenda</option>
                <option value="mendatang" {{ ($selectedStatus ?? '') === 'mendatang' ? 'selected' : '' }}>Mendatang</option>
                <option value="selesai" {{ ($selectedStatus ?? '') === 'selesai' ? 'selected' : '' }}>Sudah Lewat / Selesai</option>
            </select>
            <i class="ti ti-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none"></i>
        </div>
        <button type="submit" class="bg-gradient-to-r from-emerald-600 to-teal-600 text-white px-8 py-3 rounded-2xl font-bold text-sm hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center justify-center gap-2">
            <i class="ti ti-filter"></i>
            <span>Filter</span>
        </button>
        @if(!empty($search) || !empty($selectedStatus))
            <a href="{{ route('kegiatan.index') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-600 px-5 py-3 rounded-2xl font-bold text-sm transition-all flex items-center justify-center gap-1">
                <i class="ti ti-refresh"></i>
                <span>Reset</span>
            </a>
        @endif
    </form>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($kegiatans as $kegiatan)
        <div id="kegiatan-{{ $kegiatan->id }}" class="scroll-mt-28 bg-white rounded-3xl border border-slate-100 p-6 shadow-xl shadow-slate-200/30 hover:-translate-y-1 hover:border-emerald-200 hover:shadow-2xl transition-all duration-300 flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between gap-3 mb-4">
                    <span class="px-3.5 py-1.5 rounded-2xl bg-emerald-50 text-emerald-800 text-xs font-extrabold flex items-center gap-1.5">
                        <i class="ti ti-calendar"></i> {{ $kegiatan->tanggal->translatedFormat('d F Y') }}
                    </span>
                    @if ($kegiatan->waktu)
                    <span class="text-xs font-bold text-slate-400 flex items-center gap-1">
                        <i class="ti ti-clock"></i> {{ $kegiatan->waktu }}
                    </span>
                    @endif
                </div>

                <h3 class="text-lg font-extrabold text-slate-800 tracking-tight mb-2">{{ $kegiatan->nama_kegiatan }}</h3>
                <p class="text-slate-500 text-xs leading-relaxed mb-4 line-clamp-3">{{ $kegiatan->deskripsi ?: 'Tidak ada deskripsi tambahan.' }}</p>
            </div>

            <div class="pt-4 border-t border-slate-100 text-xs space-y-3">
                <div class="space-y-2">
                    @if ($kegiatan->lokasi)
                    <div class="flex items-center gap-2 text-slate-600 font-semibold">
                        <i class="ti ti-map-pin text-emerald-600 text-base"></i>
                        <span>{{ $kegiatan->lokasi }}</span>
                    </div>
                    @endif

                    @if ($kegiatan->penyelenggara)
                    <div class="flex items-center gap-2 text-slate-400 font-medium">
                        <i class="ti ti-building text-base"></i>
                        <span>Oleh: {{ $kegiatan->penyelenggara }}</span>
                    </div>
                    @endif
                </div>

                @php
                    $kegiatanUrl = url('/kegiatan#kegiatan-' . $kegiatan->id);
                    $waExtra = "📅 Tanggal: " . $kegiatan->tanggal->translatedFormat('d F Y') 
                             . ($kegiatan->waktu ? "\n⏰ Waktu: " . $kegiatan->waktu : "")
                             . ($kegiatan->lokasi ? "\n📍 Lokasi: " . $kegiatan->lokasi : "");
                @endphp

                <!-- Action Share Buttons -->
                <div class="pt-3 border-t border-slate-100 flex items-center justify-between gap-2">
                    <button type="button" 
                            onclick="shareToWhatsapp('Agenda Desa: {{ addslashes($kegiatan->nama_kegiatan) }}', '{{ $kegiatanUrl }}', '{{ addslashes($waExtra) }}')"
                            class="flex-1 bg-[#25D366] hover:bg-[#20bd5a] text-white font-bold py-2 px-3 rounded-xl transition-all flex items-center justify-center gap-1 text-[11px] shadow-sm">
                        <i class="ti ti-brand-whatsapp text-sm"></i>
                        <span>Bagikan WA</span>
                    </button>
                    <button type="button" 
                            onclick="copyToClipboard('{{ $kegiatanUrl }}', 'Link agenda kegiatan berhasil disalin!')"
                            class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold py-2 px-3 rounded-xl transition-colors flex items-center justify-center gap-1 text-[11px]"
                            title="Salin Tautan Agenda">
                        <i class="ti ti-link text-sm"></i>
                        <span>Salin Link</span>
                    </button>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full bg-white rounded-3xl border border-slate-100 p-12 text-center text-slate-400 shadow-sm">
            <div class="w-16 h-16 rounded-2xl bg-slate-50 text-slate-400 flex items-center justify-center text-3xl mx-auto mb-4">
                <i class="ti ti-calendar-off"></i>
            </div>
            <h3 class="font-bold text-slate-800 text-lg">Tidak Ada Agenda Ditemukan</h3>
            <p class="text-slate-400 text-sm mt-2">Maaf, tidak ada agenda kegiatan yang sesuai dengan pencarian atau filter Anda.</p>
        </div>
        @endforelse
    </div>

    <div class="mt-8">{{ $kegiatans->links() }}</div>
</section>
@endsection
