@extends('layouts.public')

@section('title', $profile->nama_desa . ' — Portal Kependudukan & Layanan Desa Mandiri')

@section('content')

<!-- 1. Hero Section Premium + Smart Live Search Bar (HCD Focus) -->
<section class="relative bg-gradient-to-br from-emerald-950 via-emerald-900 to-teal-950 text-white py-20 md:py-28 z-30">
    <!-- Ambient Blur Background Ornaments (Overflow contained) -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute inset-0 opacity-15 bg-[radial-gradient(circle_at_top_right,_var(--tw-gradient-stops))] from-teal-400 via-transparent to-transparent"></div>
        <div class="absolute -top-32 -right-32 w-96 h-96 rounded-full bg-emerald-500/10 blur-3xl"></div>
        <div class="absolute -bottom-32 -left-32 w-96 h-96 rounded-full bg-teal-500/10 blur-3xl"></div>
    </div>

    <div class="max-w-6xl mx-auto px-6 relative z-30 text-center">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-800/60 border border-emerald-500/40 text-emerald-300 text-xs font-bold uppercase tracking-wider mb-6 shadow-sm">
            <i class="ti ti-heart-handshake text-base text-amber-400"></i>
            <span>Portal Kependudukan Berbasis Human-Centered Design (HCD)</span>
        </div>
        <h1 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-tight mb-6">
            Selamat Datang di <span class="bg-gradient-to-r from-emerald-300 via-teal-200 to-emerald-100 bg-clip-text text-transparent">{{ $profile->nama_desa }}</span>
        </h1>
        <p class="text-slate-200 max-w-2xl mx-auto mb-8 text-base md:text-lg leading-relaxed font-light">
            Solusi praktis, cepat, dan transparan untuk pelayanan administrasi warga desa. Ajukan permohonan surat secara mandiri, lacak status pengajuan real-time, dan akses informasi desa terkini.
        </p>

        <!-- HCD Smart Live Global Search Box -->
        <div class="max-w-2xl mx-auto mb-10 relative z-50">
            <div class="relative flex items-center shadow-2xl rounded-2xl">
                <i class="ti ti-search absolute left-4 text-emerald-400 text-xl pointer-events-none"></i>
                <input type="text" 
                       id="heroGlobalSearch" 
                       onkeyup="doGlobalSearch()"
                       onfocus="doGlobalSearch()"
                       placeholder="Cari berita, agenda kegiatan, layanan surat, atau profil desa..." 
                       class="w-full pl-12 pr-12 py-4 rounded-2xl bg-white/15 backdrop-blur-md border border-emerald-400/40 text-white placeholder-slate-300 focus:outline-none focus:ring-4 focus:ring-emerald-500/50 focus:bg-slate-900/95 text-sm md:text-base transition-all">
                <button type="button" onclick="clearGlobalSearch()" id="clearSearchBtn" class="absolute right-4 text-slate-400 hover:text-white hidden">
                    <i class="ti ti-x text-lg"></i>
                </button>
            </div>

            <div class="text-slate-300 text-xs mt-3 flex flex-wrap items-center justify-center gap-1.5">
                <span class="font-medium text-slate-300">💡 Contoh pencarian:</span> 
                <button type="button" onclick="setSearchValue('Surat Domisili')" class="px-2.5 py-1 rounded-lg bg-white/10 hover:bg-white/20 text-emerald-200 transition text-xs font-semibold">Surat Domisili</button>
                <button type="button" onclick="setSearchValue('SKTM')" class="px-2.5 py-1 rounded-lg bg-white/10 hover:bg-white/20 text-emerald-200 transition text-xs font-semibold">SKTM</button>
                <button type="button" onclick="setSearchValue('Berita')" class="px-2.5 py-1 rounded-lg bg-white/10 hover:bg-white/20 text-emerald-200 transition text-xs font-semibold">Berita Desa</button>
                <button type="button" onclick="setSearchValue('Agenda')" class="px-2.5 py-1 rounded-lg bg-white/10 hover:bg-white/20 text-emerald-200 transition text-xs font-semibold">Agenda Kegiatan</button>
                <button type="button" onclick="setSearchValue('Profil')" class="px-2.5 py-1 rounded-lg bg-white/10 hover:bg-white/20 text-emerald-200 transition text-xs font-semibold">Profil Desa</button>
            </div>

            <!-- Dropdown Hasil Pencarian Global -->
            <div id="globalSearchResults" class="absolute left-0 right-0 top-full mt-3 bg-white rounded-3xl border border-slate-200/80 shadow-2xl p-4 hidden text-left text-slate-800 max-h-96 overflow-y-auto z-[9999] animate-fadeIn ring-1 ring-black/5">
            </div>
        </div>

        <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
            <a href="{{ route('layanan.index') }}" class="w-full sm:w-auto bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-400 hover:to-teal-500 text-white font-extrabold px-8 py-4 rounded-2xl shadow-xl shadow-emerald-950/50 hover:scale-[1.02] active:scale-[0.98] transition-all duration-300 flex items-center justify-center gap-2 text-sm md:text-base">
                <i class="ti ti-file-description text-xl"></i>
                <span>Ajukan Surat Mandiri</span>
            </a>
            <a href="{{ route('layanan.cek-status') }}" class="w-full sm:w-auto bg-slate-900/80 hover:bg-slate-900 text-slate-100 hover:text-white font-bold px-8 py-4 rounded-2xl border border-emerald-500/40 hover:border-emerald-400 transition-all duration-300 flex items-center justify-center gap-2 text-sm md:text-base backdrop-blur-md">
                <i class="ti ti-search text-xl text-teal-400"></i>
                <span>Cek Status Surat</span>
            </a>
        </div>
    </div>
</section>

<!-- 2. Data Statistik & Demografi Penduduk (Area Putih) -->
<section class="bg-white py-16 md:py-20 border-b border-slate-100">
    <div class="max-w-6xl mx-auto px-6">
        <!-- 3 Kartu Statistik Ringkas -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-10">
            <div class="bg-slate-50 hover:bg-white rounded-3xl border border-slate-200/80 shadow-sm hover:shadow-xl hover:border-emerald-300 p-6 flex items-center gap-4 group hover:-translate-y-1 transition-all duration-300">
                <div class="w-14 h-14 rounded-2xl bg-emerald-100 text-emerald-700 flex items-center justify-center text-2xl group-hover:scale-110 transition-transform shadow-sm">
                    <i class="ti ti-users"></i>
                </div>
                <div>
                    <div class="text-3xl font-extrabold text-slate-800 tracking-tight">{{ number_format($statistik['total_penduduk']) }}</div>
                    <div class="text-xs text-slate-500 font-semibold">Total Penduduk Desa</div>
                </div>
            </div>

            <div class="bg-slate-50 hover:bg-white rounded-3xl border border-slate-200/80 shadow-sm hover:shadow-xl hover:border-blue-300 p-6 flex items-center gap-4 group hover:-translate-y-1 transition-all duration-300">
                <div class="w-14 h-14 rounded-2xl bg-blue-100 text-blue-700 flex items-center justify-center text-2xl group-hover:scale-110 transition-transform shadow-sm">
                    <i class="ti ti-man"></i>
                </div>
                <div>
                    <div class="text-3xl font-extrabold text-slate-800 tracking-tight">{{ number_format($statistik['laki_laki']) }}</div>
                    <div class="text-xs text-slate-500 font-semibold">Penduduk Laki-laki</div>
                </div>
            </div>

            <div class="bg-slate-50 hover:bg-white rounded-3xl border border-slate-200/80 shadow-sm hover:shadow-xl hover:border-pink-300 p-6 flex items-center gap-4 group hover:-translate-y-1 transition-all duration-300">
                <div class="w-14 h-14 rounded-2xl bg-pink-100 text-pink-700 flex items-center justify-center text-2xl group-hover:scale-110 transition-transform shadow-sm">
                    <i class="ti ti-woman"></i>
                </div>
                <div>
                    <div class="text-3xl font-extrabold text-slate-800 tracking-tight">{{ number_format($statistik['perempuan']) }}</div>
                    <div class="text-xs text-slate-500 font-semibold">Penduduk Perempuan</div>
                </div>
            </div>
        </div>

        <!-- Visualisasi Grafik Demografi Penduduk -->
        <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xl shadow-slate-200/50 p-6 md:p-8">
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-8 pb-6 border-b border-slate-100">
                <div>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 text-emerald-800 text-xs font-bold uppercase tracking-wider mb-2">
                        <i class="ti ti-chart-pie"></i> Visualisasi Data Kependudukan
                    </span>
                    <h3 class="text-xl md:text-2xl font-extrabold text-slate-800 tracking-tight">Grafik Demografi Penduduk</h3>
                    <p class="text-slate-400 text-xs md:text-sm mt-1">Komposisi kependudukan resmi desa {{ $profile->nama_desa }}</p>
                </div>
                <div class="flex flex-wrap items-center gap-4 text-xs font-bold">
                    <div class="flex items-center gap-2 bg-blue-50 text-blue-700 px-3 py-1.5 rounded-xl border border-blue-100">
                        <span class="w-3 h-3 rounded-full bg-blue-500 inline-block"></span>
                        <span>Laki-laki ({{ $statistik['total_penduduk'] > 0 ? round(($statistik['laki_laki'] / $statistik['total_penduduk']) * 100, 1) : 0 }}%)</span>
                    </div>
                    <div class="flex items-center gap-2 bg-pink-50 text-pink-700 px-3 py-1.5 rounded-xl border border-pink-100">
                        <span class="w-3 h-3 rounded-full bg-pink-500 inline-block"></span>
                        <span>Perempuan ({{ $statistik['total_penduduk'] > 0 ? round(($statistik['perempuan'] / $statistik['total_penduduk']) * 100, 1) : 0 }}%)</span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <!-- Canvas Chart.js -->
                <div class="relative h-64 max-w-xs mx-auto w-full flex items-center justify-center">
                    <canvas id="chartGenderHome"></canvas>
                </div>

                <!-- Progress Bar & Detail Stat -->
                <div class="space-y-6">
                    <div class="bg-slate-50 p-5 rounded-2xl border border-slate-100">
                        <div class="flex justify-between text-sm font-extrabold mb-2">
                            <span class="text-blue-700 flex items-center gap-1.5"><i class="ti ti-man"></i> Penduduk Laki-laki</span>
                            <span class="text-slate-800">{{ number_format($statistik['laki_laki']) }} Jiwa</span>
                        </div>
                        <div class="w-full bg-slate-200 rounded-full h-3.5 overflow-hidden p-0.5">
                            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 h-full rounded-full transition-all duration-1000" style="width: {{ $statistik['total_penduduk'] > 0 ? round(($statistik['laki_laki'] / $statistik['total_penduduk']) * 100, 1) : 0 }}%"></div>
                        </div>
                    </div>

                    <div class="bg-slate-50 p-5 rounded-2xl border border-slate-100">
                        <div class="flex justify-between text-sm font-extrabold mb-2">
                            <span class="text-pink-700 flex items-center gap-1.5"><i class="ti ti-woman"></i> Penduduk Perempuan</span>
                            <span class="text-slate-800">{{ number_format($statistik['perempuan']) }} Jiwa</span>
                        </div>
                        <div class="w-full bg-slate-200 rounded-full h-3.5 overflow-hidden p-0.5">
                            <div class="bg-gradient-to-r from-pink-500 to-rose-600 h-full rounded-full transition-all duration-1000" style="width: {{ $statistik['total_penduduk'] > 0 ? round(($statistik['perempuan'] / $statistik['total_penduduk']) * 100, 1) : 0 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const ctx = document.getElementById('chartGenderHome');
        if (ctx) {
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Laki-laki', 'Perempuan'],
                    datasets: [{
                        data: [{{ $statistik['laki_laki'] }}, {{ $statistik['perempuan'] }}],
                        backgroundColor: ['#3b82f6', '#ec4899'],
                        hoverBackgroundColor: ['#2563eb', '#db2777'],
                        borderWidth: 4,
                        borderColor: '#ffffff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let value = context.raw || 0;
                                    let total = {{ $statistik['total_penduduk'] > 0 ? $statistik['total_penduduk'] : 1 }};
                                    let percentage = Math.round((value / total) * 100);
                                    return ' ' + context.label + ': ' + value.toLocaleString('id-ID') + ' Jiwa (' + percentage + '%)';
                                }
                            }
                        }
                    },
                    cutout: '72%'
                }
            });
        }
    });
</script>

<!-- 3. Seksi Panduan HCD: 3 Langkah Mudah Urus Surat Mandiri -->
<section id="panduan-hcd" class="max-w-6xl mx-auto px-6 py-20">
    <div class="text-center mb-16">
        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 text-emerald-800 text-xs font-bold uppercase tracking-wider mb-3">
            <i class="ti ti-map"></i> Panduan Alur Pelayanan Empatik
        </span>
        <h2 class="text-2xl md:text-4xl font-extrabold text-slate-800 tracking-tight">3 Langkah Sederhana Urus Surat Mandiri</h2>
        <div class="w-16 h-1.5 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full mx-auto mt-4"></div>
        <p class="text-slate-400 text-sm mt-4 max-w-xl mx-auto">Dirancang secara khusus agar seluruh warga desa dapat mengurus dokumen kependudukan tanpa kebingungan.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Step 1 -->
        <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-xl shadow-slate-200/40 relative overflow-hidden group hover:border-emerald-300 transition-all duration-300">
            <div class="w-12 h-12 rounded-2xl bg-emerald-500 text-white font-extrabold text-xl flex items-center justify-center mb-6 shadow-lg shadow-emerald-500/30">
                1
            </div>
            <div class="text-xl font-extrabold text-slate-800 mb-3 flex items-center gap-2">
                <span>Pilih Jenis Surat</span>
                <i class="ti ti-file-text text-emerald-600"></i>
            </div>
            <p class="text-xs text-slate-500 leading-relaxed mb-4">
                Pilih jenis surat keterangan yang Anda perlukan dari katalog layanan kami.
            </p>
            <ul class="text-xs text-slate-400 space-y-2">
                <li class="flex items-center gap-2"><i class="ti ti-check text-emerald-500"></i> Surat Domisili & Usaha</li>
                <li class="flex items-center gap-2"><i class="ti ti-check text-emerald-500"></i> SKTM & Keterangan Kematian</li>
            </ul>
        </div>

        <!-- Step 2 -->
        <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-xl shadow-slate-200/40 relative overflow-hidden group hover:border-teal-300 transition-all duration-300">
            <div class="w-12 h-12 rounded-2xl bg-teal-500 text-white font-extrabold text-xl flex items-center justify-center mb-6 shadow-lg shadow-teal-500/30">
                2
            </div>
            <div class="text-xl font-extrabold text-slate-800 mb-3 flex items-center gap-2">
                <span>Isi Form & Syarat</span>
                <i class="ti ti-edit text-teal-600"></i>
            </div>
            <p class="text-xs text-slate-500 leading-relaxed mb-4">
                Lengkapi NIK warga dan unggah dokumen persyaratan sesuai panduan visual.
            </p>
            <ul class="text-xs text-slate-400 space-y-2">
                <li class="flex items-center gap-2"><i class="ti ti-check text-teal-500"></i> Form ramah pengguna</li>
                <li class="flex items-center gap-2"><i class="ti ti-check text-teal-500"></i> Unggah foto KTP / KK mudah</li>
            </ul>
        </div>

        <!-- Step 3 -->
        <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-xl shadow-slate-200/40 relative overflow-hidden group hover:border-blue-300 transition-all duration-300">
            <div class="w-12 h-12 rounded-2xl bg-blue-500 text-white font-extrabold text-xl flex items-center justify-center mb-6 shadow-lg shadow-blue-500/30">
                3
            </div>
            <div class="text-xl font-extrabold text-slate-800 mb-3 flex items-center gap-2">
                <span>Lacak & Terima Surat</span>
                <i class="ti ti-circle-check text-blue-600"></i>
            </div>
            <p class="text-xs text-slate-500 leading-relaxed mb-4">
                Dapatkan Kode Permohonan instan untuk memantau pengerjaan surat hingga selesai.
            </p>
            <ul class="text-xs text-slate-400 space-y-2">
                <li class="flex items-center gap-2"><i class="ti ti-check text-blue-500"></i> Notifikasi progres real-time</li>
                <li class="flex items-center gap-2"><i class="ti ti-check text-blue-500"></i> Cetak dokumen / ambil di balai desa</li>
            </ul>
        </div>
    </div>
</section>

<!-- 6. Berita Terbaru Section -->
@if ($beritaTerbaru->count())
<section class="bg-white py-20 border-t border-slate-100">
    <div class="max-w-6xl mx-auto px-6">
        <div class="flex items-end justify-between mb-12">
            <div>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 text-emerald-800 text-xs font-bold uppercase tracking-wider mb-2">
                    <i class="ti ti-news"></i> Keterbukaan Informasi
                </span>
                <h2 class="text-2xl md:text-3xl font-extrabold text-slate-800 tracking-tight">Kabar & Berita Terkini</h2>
                <p class="text-slate-400 text-xs md:text-sm mt-1">Liputan resmi kegiatan dan pembangunan desa.</p>
            </div>
            <a href="{{ route('berita.index') }}" class="hidden sm:inline-flex items-center gap-1.5 text-emerald-700 hover:text-emerald-800 font-bold text-sm group">
                <span>Lihat semua berita</span>
                <i class="ti ti-arrow-narrow-right text-lg group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach ($beritaTerbaru as $berita)
            <article class="bg-white border border-slate-100 rounded-3xl overflow-hidden hover:shadow-2xl hover:shadow-slate-200/60 hover:-translate-y-1.5 hover:border-emerald-200 transition-all duration-300 flex flex-col group">
                <div class="h-52 bg-slate-100 overflow-hidden relative">
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
                </div>
                <div class="p-6 flex-grow flex flex-col">
                    <div class="text-[11px] font-semibold text-slate-400 mb-2 flex items-center gap-1.5">
                        <i class="ti ti-calendar-event"></i>
                        <span>{{ $berita->tanggal_publish?->translatedFormat('d F Y') }}</span>
                    </div>
                    <h3 class="font-extrabold text-slate-800 text-lg leading-snug mb-3 group-hover:text-emerald-800 transition-colors">
                        <a href="{{ route('berita.show', $berita->slug) }}">{{ $berita->judul }}</a>
                    </h3>
                    <div class="flex items-center justify-between pt-3 border-t border-slate-100 gap-2 mt-auto">
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
                        </div>
                        <a href="{{ route('berita.show', $berita->slug) }}" class="inline-flex items-center gap-1 text-emerald-700 hover:text-emerald-800 font-extrabold text-xs group/btn">
                            <span>Baca Selengkapnya</span>
                            <i class="ti ti-chevron-right group-hover/btn:translate-x-0.5 transition-transform"></i>
                        </a>
                    </div>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Script JavaScript Pencarian Global Portal Desa (HCD Standards) -->
<script>
    const globalData = {
        surat: [
            @if(isset($jenisSurat))
                @foreach($jenisSurat as $s)
                {
                    title: @json($s->nama_surat),
                    desc: @json($s->deskripsi ?: 'Permohonan surat keterangan resmi desa.'),
                    url: @json(route('layanan.form', $s->id)),
                    icon: 'ti-file-certificate',
                    badge: 'Layanan Surat',
                    tags: 'surat layanan pengajuan mandiri ' + @json($s->nama_surat) + ' ' + @json($s->deskripsi)
                },
                @endforeach
            @endif
        ],
        berita: [
            @if(isset($semuaBerita))
                @foreach($semuaBerita as $b)
                {
                    title: @json($b->judul),
                    desc: @json('Kategori: ' . $b->kategori),
                    url: @json(route('berita.show', $b->slug)),
                    icon: 'ti-news',
                    badge: 'Berita Desa',
                    tags: 'berita pengumuman artikel kabar ' + @json($b->judul) + ' ' + @json($b->kategori)
                },
                @endforeach
            @endif
        ],
        kegiatan: [
            @if(isset($semuaKegiatan))
                @foreach($semuaKegiatan as $k)
                {
                    title: @json($k->nama_kegiatan),
                    desc: @json('Lokasi: ' . ($k->lokasi ?: 'Balai Desa')),
                    url: @json(route('kegiatan.index')),
                    icon: 'ti-calendar-event',
                    badge: 'Agenda Kegiatan',
                    tags: 'agenda kegiatan acara jadwal ' + @json($k->nama_kegiatan) + ' ' + @json($k->lokasi)
                },
                @endforeach
            @endif
        ],
        halaman: [
            { title: 'Profil & Sejarah Desa', desc: 'Informasi visi, misi, dan struktur perangkat desa', url: @json(route('profil')), icon: 'ti-building-monument', badge: 'Informasi', tags: 'profil sejarah visi misi struktur aparat perangkat desa' },
            { title: 'Kontak Penting & Darurat', desc: 'Daftar nomor telepon dan alamat kantor balai desa', url: @json(route('kontak.index')), icon: 'ti-phone', badge: 'Informasi', tags: 'kontak telepon nomor darurat alamat balai kantor desa' },
            { title: 'Galeri Foto Kegiatan', desc: 'Kumpulan foto aktivitas dan pembangunan desa', url: @json(route('galeri.index')), icon: 'ti-photo', badge: 'Informasi', tags: 'galeri foto gambar dokumentasi pembangunan kegiatan' },
            { title: 'Cek Status Pengajuan Surat', desc: 'Lacak proses pengerjaan surat permohonan Anda', url: @json(route('layanan.cek-status')), icon: 'ti-search', badge: 'Layanan Surat', tags: 'cek status lacak tracking kode pengajuan surat permohonan' }
        ]
    };

    function setSearchValue(val) {
        const input = document.getElementById('heroGlobalSearch');
        if (input) {
            input.value = val;
            doGlobalSearch();
            input.focus();
        }
    }

    function clearGlobalSearch() {
        const input = document.getElementById('heroGlobalSearch');
        const resultsBox = document.getElementById('globalSearchResults');
        const clearBtn = document.getElementById('clearSearchBtn');
        if (input) input.value = '';
        if (resultsBox) resultsBox.classList.add('hidden');
        if (clearBtn) clearBtn.classList.add('hidden');
    }

    function doGlobalSearch() {
        const input = document.getElementById('heroGlobalSearch');
        const resultsBox = document.getElementById('globalSearchResults');
        const clearBtn = document.getElementById('clearSearchBtn');
        if (!input || !resultsBox) return;

        const query = input.value.toLowerCase().trim();
        const tokens = query.split(/\s+/).filter(t => t.length > 0);

        if (clearBtn) {
            if (query.length > 0) {
                clearBtn.classList.remove('hidden');
            } else {
                clearBtn.classList.add('hidden');
            }
        }

        if (tokens.length === 0) {
            resultsBox.classList.add('hidden');
            return;
        }

        const expandAlias = (str) => {
            let s = str;
            if (s.includes('sktm') || s.includes('tidak mampu')) s += ' miskin bantuan sktm';
            if (s.includes('ktp') || s.includes('kk')) s += ' ktp kk id penduduk';
            if (s.includes('domisili')) s += ' domisili tinggal alamat';
            if (s.includes('usaha')) s += ' usaha sku umkm dagang toko';
            if (s.includes('nikah')) s += ' nikah kawin perkawinan n1';
            if (s.includes('lahir') || s.includes('kelahiran')) s += ' lahir kelahiran akta';
            if (s.includes('kematian') || s.includes('mati')) s += ' kematian mati wafat';
            return s;
        };

        const renderMatches = (matchMode) => {
            let html = '';
            let total = 0;

            const searchCategory = (items, categoryName, badgeColor) => {
                const matches = items.filter(item => {
                    const fullText = expandAlias((item.title + ' ' + item.desc + ' ' + (item.tags || '')).toLowerCase());
                    if (matchMode === 'all') {
                        return tokens.every(token => fullText.includes(token));
                    } else {
                        return tokens.some(token => fullText.includes(token));
                    }
                });

                if (matches.length > 0) {
                    html += `<div class="mb-3">
                        <div class="text-[11px] font-extrabold uppercase tracking-wider text-slate-400 mb-2 flex items-center gap-1">
                            <span>${categoryName}</span>
                        </div>
                        <div class="space-y-1.5">`;
                    matches.forEach(item => {
                        total++;
                        html += `
                            <a href="${item.url}" class="p-3 rounded-2xl bg-slate-50 hover:bg-emerald-50 border border-slate-100 hover:border-emerald-200 transition-all flex items-center justify-between group">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-xl ${badgeColor} flex items-center justify-center text-lg shrink-0">
                                        <i class="ti ${item.icon}"></i>
                                    </div>
                                    <div>
                                        <div class="font-extrabold text-xs md:text-sm text-slate-800 group-hover:text-emerald-800 transition-colors">${item.title}</div>
                                        <div class="text-[11px] text-slate-400 line-clamp-1">${item.desc}</div>
                                    </div>
                                </div>
                                <span class="text-xs text-emerald-600 opacity-0 group-hover:opacity-100 transition-opacity font-bold flex items-center gap-1">
                                    Buka <i class="ti ti-arrow-right"></i>
                                </span>
                            </a>
                        `;
                    });
                    html += `</div></div>`;
                }
            };

            searchCategory(globalData.surat, '📑 Layanan Surat Mandiri', 'bg-emerald-100 text-emerald-700');
            searchCategory(globalData.berita, '📰 Berita & Informasi Desa', 'bg-blue-100 text-blue-700');
            searchCategory(globalData.kegiatan, '📅 Agenda Kegiatan Desa', 'bg-purple-100 text-purple-700');
            searchCategory(globalData.halaman, '🏢 Fitur & Profil Portal', 'bg-amber-100 text-amber-700');

            return { html, total };
        };

        // Try strict match ('all tokens') first, then fallback to relaxed match ('any token')
        let result = renderMatches('all');
        if (result.total === 0) {
            result = renderMatches('any');
        }

        if (result.total === 0) {
            resultsBox.innerHTML = `
                <div class="text-center py-6">
                    <i class="ti ti-search-off text-3xl text-slate-300 mb-2"></i>
                    <div class="font-bold text-xs text-slate-700">Tidak ada hasil untuk "${query}"</div>
                    <div class="text-[11px] text-slate-400 mt-1">Coba kata kunci lain seperti <i>Domisili</i>, <i>SKTM</i>, <i>Berita</i>, atau <i>Profil</i>.</div>
                </div>
            `;
        } else {
            resultsBox.innerHTML = result.html;
        }

        resultsBox.classList.remove('hidden');
    }

    document.addEventListener('click', function(e) {
        const input = document.getElementById('heroGlobalSearch');
        const resultsBox = document.getElementById('globalSearchResults');
        if (input && resultsBox && !input.contains(e.target) && !resultsBox.contains(e.target)) {
            resultsBox.classList.add('hidden');
        }
    });
</script>

@endsection
