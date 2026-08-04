@extends('layouts.public')

@section('title', $profile->nama_desa . ' — Beranda')

@section('content')

<!-- Hero Section Premium -->
<section class="relative bg-gradient-to-br from-emerald-800 via-emerald-900 to-teal-950 text-white overflow-hidden py-24 md:py-32">
    <!-- Hiasan Background -->
    <div class="absolute inset-0 opacity-10 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-teal-400 via-transparent to-transparent"></div>
    <div class="absolute -top-40 -right-40 w-96 h-96 rounded-full bg-emerald-500/10 blur-3xl"></div>
    <div class="absolute -bottom-40 -left-40 w-96 h-96 rounded-full bg-teal-500/10 blur-3xl"></div>

    <div class="max-w-6xl mx-auto px-6 relative z-10 text-center">
        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-700/50 border border-emerald-500/30 text-emerald-300 text-xs font-bold uppercase tracking-wider mb-6 animate-pulse">
            <i class="ti ti-discount-check"></i> Portal Kependudukan & Layanan Digital
        </span>
        <h1 class="text-3xl md:text-5xl lg:text-6xl font-extrabold tracking-tight leading-tight mb-6">
            Selamat Datang di <span class="bg-gradient-to-r from-emerald-300 to-teal-200 bg-clip-text text-transparent">{{ $profile->nama_desa }}</span>
        </h1>
        <p class="text-slate-200 max-w-2xl mx-auto mb-10 text-base md:text-lg leading-relaxed font-light">
            Solusi praktis dan cepat untuk pelayanan administrasi warga desa. Ajukan permohonan surat keterangan secara mandiri, lacak status pengajuan Anda, dan temukan informasi berita terbaru.
        </p>
        <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
            <a href="{{ route('layanan.index') }}" class="w-full sm:w-auto bg-gradient-to-r from-emerald-500 to-teal-600 text-white font-bold px-8 py-4 rounded-2xl shadow-lg shadow-emerald-900/30 hover:shadow-emerald-500/20 hover:scale-[1.02] active:scale-[0.98] transition-all duration-300 flex items-center justify-center gap-2">
                <i class="ti ti-file-description text-xl"></i>
                <span>Ajukan Surat Mandiri</span>
            </a>
            <a href="{{ route('layanan.cek-status') }}" class="w-full sm:w-auto bg-emerald-950/60 hover:bg-emerald-950 text-slate-200 hover:text-white font-semibold px-8 py-4 rounded-2xl border border-emerald-700/50 hover:border-emerald-500/70 transition-all duration-300 flex items-center justify-center gap-2">
                <i class="ti ti-search text-xl"></i>
                <span>Cek Status Surat</span>
            </a>
        </div>
    </div>
</section>

<!-- Statistik Section (Floating) -->
<section class="max-w-6xl mx-auto px-6 -mt-12 relative z-20">
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <div class="bg-white rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/50 p-6 flex items-center gap-4 group hover:border-emerald-200 transition-colors duration-300">
            <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-2xl group-hover:scale-105 transition-transform">
                <i class="ti ti-users"></i>
            </div>
            <div>
                <div class="text-3xl font-extrabold text-slate-800 tracking-tight">{{ number_format($statistik['total_penduduk']) }}</div>
                <div class="text-sm text-slate-400 font-semibold">Total Penduduk</div>
            </div>
        </div>
        
        <div class="bg-white rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/50 p-6 flex items-center gap-4 group hover:border-blue-200 transition-colors duration-300">
            <div class="w-14 h-14 rounded-2xl bg-blue-50 text-blue-700 flex items-center justify-center text-2xl group-hover:scale-105 transition-transform">
                <i class="ti ti-man"></i>
            </div>
            <div>
                <div class="text-3xl font-extrabold text-slate-800 tracking-tight">{{ number_format($statistik['laki_laki']) }}</div>
                <div class="text-sm text-slate-400 font-semibold">Penduduk Laki-laki</div>
            </div>
        </div>
        
        <div class="bg-white rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/50 p-6 flex items-center gap-4 group hover:border-pink-200 transition-colors duration-300">
            <div class="w-14 h-14 rounded-2xl bg-pink-50 text-pink-700 flex items-center justify-center text-2xl group-hover:scale-105 transition-transform">
                <i class="ti ti-woman"></i>
            </div>
            <div>
                <div class="text-3xl font-extrabold text-slate-800 tracking-tight">{{ number_format($statistik['perempuan']) }}</div>
                <div class="text-sm text-slate-400 font-semibold">Penduduk Perempuan</div>
            </div>
        </div>
    </div>

    <!-- Visualisasi Grafik Demografi Penduduk (HCD Feature) -->
    <div class="mt-8 bg-white rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/50 p-6 md:p-8">
        <div class="flex flex-col md:flex-row items-center justify-between gap-6 mb-6">
            <div>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 text-emerald-800 text-xs font-bold uppercase tracking-wider mb-2">
                    <i class="ti ti-chart-pie"></i> Visualisasi Data Kependudukan
                </span>
                <h3 class="text-xl md:text-2xl font-extrabold text-slate-800 tracking-tight">Grafik Demografi Penduduk</h3>
                <p class="text-slate-400 text-xs md:text-sm mt-1">Perbandingan komposisi jenis kelamin warga {{ $profile->nama_desa }}</p>
            </div>
            <div class="flex items-center gap-4 text-xs font-semibold">
                <div class="flex items-center gap-2">
                    <span class="w-3.5 h-3.5 rounded-full bg-blue-500 inline-block"></span>
                    <span class="text-slate-700">Laki-laki ({{ $statistik['total_penduduk'] > 0 ? round(($statistik['laki_laki'] / $statistik['total_penduduk']) * 100, 1) : 0 }}%)</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-3.5 h-3.5 rounded-full bg-pink-500 inline-block"></span>
                    <span class="text-slate-700">Perempuan ({{ $statistik['total_penduduk'] > 0 ? round(($statistik['perempuan'] / $statistik['total_penduduk']) * 100, 1) : 0 }}%)</span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
            <!-- Canvas Chart.js -->
            <div class="relative h-60 max-w-xs mx-auto w-full flex items-center justify-center">
                <canvas id="chartGenderHome"></canvas>
            </div>

            <!-- Progress Bar & Detail Stat -->
            <div class="space-y-5">
                <div>
                    <div class="flex justify-between text-sm font-bold mb-1.5">
                        <span class="text-blue-700 flex items-center gap-1.5"><i class="ti ti-man"></i> Laki-laki</span>
                        <span class="text-slate-800">{{ number_format($statistik['laki_laki']) }} Jiwa ({{ $statistik['total_penduduk'] > 0 ? round(($statistik['laki_laki'] / $statistik['total_penduduk']) * 100, 1) : 0 }}%)</span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-4 overflow-hidden p-0.5 border border-slate-200/60">
                        <div class="bg-gradient-to-r from-blue-500 to-indigo-600 h-full rounded-full transition-all duration-1000" style="width: {{ $statistik['total_penduduk'] > 0 ? round(($statistik['laki_laki'] / $statistik['total_penduduk']) * 100, 1) : 0 }}%"></div>
                    </div>
                </div>

                <div>
                    <div class="flex justify-between text-sm font-bold mb-1.5">
                        <span class="text-pink-700 flex items-center gap-1.5"><i class="ti ti-woman"></i> Perempuan</span>
                        <span class="text-slate-800">{{ number_format($statistik['perempuan']) }} Jiwa ({{ $statistik['total_penduduk'] > 0 ? round(($statistik['perempuan'] / $statistik['total_penduduk']) * 100, 1) : 0 }}%)</span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-4 overflow-hidden p-0.5 border border-slate-200/60">
                        <div class="bg-gradient-to-r from-pink-500 to-rose-600 h-full rounded-full transition-all duration-1000" style="width: {{ $statistik['total_penduduk'] > 0 ? round(($statistik['perempuan'] / $statistik['total_penduduk']) * 100, 1) : 0 }}%"></div>
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
                        borderWidth: 3,
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
                    cutout: '70%'
                }
            });
        }
    });
</script>

<!-- Layanan Cepat Section -->
<section class="max-w-6xl mx-auto px-6 py-24">
    <div class="text-center mb-16">
        <h2 class="text-2xl md:text-3xl font-extrabold text-slate-800 tracking-tight">Layanan Cepat & Informasi Resmi</h2>
        <div class="w-16 h-1.5 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full mx-auto mt-4"></div>
        <p class="text-slate-400 text-sm mt-4 max-w-lg mx-auto">Akses cepat ke berbagai fitur administrasi kependudukan dan berita terbaru seputar desa kami.</p>
    </div>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <a href="{{ route('layanan.index') }}" class="bg-white border border-slate-100 rounded-3xl p-6 text-center hover:border-emerald-200 hover:shadow-xl hover:shadow-emerald-950/5 hover:-translate-y-1.5 transition-all duration-300 group">
            <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-2xl mx-auto mb-4 group-hover:scale-110 transition-transform">
                <i class="ti ti-file-description"></i>
            </div>
            <div class="font-bold text-slate-800 text-base">Ajukan Surat</div>
            <p class="text-xs text-slate-400 mt-2 leading-relaxed">Buat permohonan surat keterangan secara online tanpa antre</p>
        </a>
        
        <a href="{{ route('layanan.cek-status') }}" class="bg-white border border-slate-100 rounded-3xl p-6 text-center hover:border-emerald-200 hover:shadow-xl hover:shadow-emerald-950/5 hover:-translate-y-1.5 transition-all duration-300 group">
            <div class="w-14 h-14 rounded-2xl bg-teal-50 text-teal-700 flex items-center justify-center text-2xl mx-auto mb-4 group-hover:scale-110 transition-transform">
                <i class="ti ti-search"></i>
            </div>
            <div class="font-bold text-slate-800 text-base">Cek Status</div>
            <p class="text-xs text-slate-400 mt-2 leading-relaxed">Lacak sejauh mana progres pengerjaan surat permohonan Anda</p>
        </a>
        
        <a href="{{ route('berita.index') }}" class="bg-white border border-slate-100 rounded-3xl p-6 text-center hover:border-emerald-200 hover:shadow-xl hover:shadow-emerald-950/5 hover:-translate-y-1.5 transition-all duration-300 group">
            <div class="w-14 h-14 rounded-2xl bg-blue-50 text-blue-700 flex items-center justify-center text-2xl mx-auto mb-4 group-hover:scale-110 transition-transform">
                <i class="ti ti-news"></i>
            </div>
            <div class="font-bold text-slate-800 text-base">Berita Desa</div>
            <p class="text-xs text-slate-400 mt-2 leading-relaxed">Dapatkan kabar aktual seputar aktivitas dan pembangunan desa</p>
        </a>
        
        <a href="{{ route('profil') }}" class="bg-white border border-slate-100 rounded-3xl p-6 text-center hover:border-emerald-200 hover:shadow-xl hover:shadow-emerald-950/5 hover:-translate-y-1.5 transition-all duration-300 group">
            <div class="w-14 h-14 rounded-2xl bg-indigo-50 text-indigo-700 flex items-center justify-center text-2xl mx-auto mb-4 group-hover:scale-110 transition-transform">
                <i class="ti ti-building-monument"></i>
            </div>
            <div class="font-bold text-slate-800 text-base">Profil Desa</div>
            <p class="text-xs text-slate-400 mt-2 leading-relaxed">Ketahui lebih dalam mengenai sejarah, visi, dan misi desa kami</p>
        </a>
    </div>
</section>

<!-- Berita Terbaru Section -->
@if ($beritaTerbaru->count())
<section class="bg-white py-24 border-t border-slate-100">
    <div class="max-w-6xl mx-auto px-6">
        <div class="flex items-end justify-between mb-12">
            <div>
                <h2 class="text-2xl md:text-3xl font-extrabold text-slate-800 tracking-tight">Kabar & Informasi Terkini</h2>
                <p class="text-slate-400 text-sm mt-2">Liputan kegiatan desa terbaru yang terbit secara resmi.</p>
            </div>
            <a href="{{ route('berita.index') }}" class="hidden sm:inline-flex items-center gap-1.5 text-emerald-700 hover:text-emerald-800 font-bold text-sm group">
                <span>Lihat semua berita</span>
                <i class="ti ti-arrow-narrow-right text-lg group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach ($beritaTerbaru as $berita)
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
        
        <div class="text-center mt-10 sm:hidden">
            <a href="{{ route('berita.index') }}" class="inline-flex items-center gap-1.5 bg-slate-50 border border-slate-200 text-slate-700 font-bold px-6 py-3 rounded-2xl text-sm w-full justify-center">
                <span>Lihat Semua Berita</span>
                <i class="ti ti-arrow-narrow-right"></i>
            </a>
        </div>
    </div>
</section>
@endif

@endsection

