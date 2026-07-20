<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Informasi Desa')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
    <style>
        html { font-size: 16px; scroll-behavior: smooth; }
        html.text-besar { font-size: 19px; }
        html.kontras-tinggi body { background: #0b0f19; color: #f3f4f6; }
        html.kontras-tinggi .bg-white { background: #1f2937 !important; color: #f3f4f6 !important; border-color: #374151 !important; }
        html.kontras-tinggi a { color: #34d399 !important; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-header {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
        html.kontras-tinggi .glass-header {
            background: rgba(31, 41, 55, 0.9);
        }
        .nav-link {
            position: relative;
            transition: color 0.3s ease;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -4px;
            left: 0;
            background-color: #047857;
            transition: width 0.3s ease;
        }
        .nav-link:hover::after {
            width: 100%;
        }
        .nav-link.active::after {
            width: 100%;
        }
        .skip-link:focus { transform: translateY(0); }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased min-h-screen flex flex-col selection:bg-emerald-600 selection:text-white">

    <a href="#konten-utama" class="skip-link fixed -translate-y-20 focus:translate-y-0 transition duration-300 bg-emerald-700 text-white px-5 py-3 z-50 top-0 left-0 rounded-br-xl shadow-lg font-semibold">Lompat ke konten utama</a>

    <!-- Bar Aksesibilitas Premium -->
    <div class="bg-gradient-to-r from-emerald-900 to-teal-950 text-white text-xs border-b border-emerald-800/40">
        <div class="max-w-6xl mx-auto px-6 py-2 flex items-center justify-between gap-3 font-medium">
            <div class="flex items-center gap-2">
                <span class="inline-block w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                <span>Portal Resmi {{ ($profile ?? \App\Models\DesaProfile::current())->nama_desa }}</span>
            </div>
            <div class="flex items-center gap-3">
                <button onclick="document.documentElement.classList.toggle('text-besar')" class="px-2.5 py-1 rounded bg-white/10 hover:bg-white/20 transition flex items-center gap-1" aria-label="Perbesar atau perkecil ukuran huruf">
                    <i class="ti ti-typography text-sm"></i> A+ / A-
                </button>
                <button onclick="document.documentElement.classList.toggle('kontras-tinggi')" class="px-2.5 py-1 rounded bg-white/10 hover:bg-white/20 transition flex items-center gap-1" aria-label="Ubah kontras tampilan">
                    <i class="ti ti-contrast text-sm"></i> Kontras
                </button>
            </div>
        </div>
    </div>

    <!-- Navigasi Glassmorphism -->
    <header class="glass-header shadow-sm border-b border-slate-100 sticky top-0 z-40 transition-all duration-300">
        <nav class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-emerald-600 to-teal-500 flex items-center justify-center text-white shadow-md shadow-emerald-600/20 group-hover:scale-105 transition-transform duration-300">
                    <i class="ti ti-building-community text-xl" aria-hidden="true"></i>
                </div>
                <div class="flex flex-col">
                    <span class="font-extrabold text-base tracking-tight text-emerald-950 group-hover:text-emerald-800 transition-colors">{{ ($profile ?? \App\Models\DesaProfile::current())->nama_desa }}</span>
                    <span class="text-[10px] text-emerald-600 uppercase tracking-widest font-bold -mt-1">Portal Desa</span>
                </div>
            </a>
            
            <button class="md:hidden text-slate-700 hover:text-emerald-700 focus:outline-none p-1" onclick="document.getElementById('menu-mobile').classList.toggle('hidden')" aria-label="Buka menu">
                <i class="ti ti-menu-2 text-2xl"></i>
            </button>
            
            <div class="hidden md:flex items-center gap-8 font-semibold text-sm text-slate-600">
                <a href="{{ route('home') }}" class="nav-link hover:text-emerald-800 {{ request()->routeIs('home') ? 'text-emerald-700 font-bold active' : '' }}">Beranda</a>
                <a href="{{ route('profil') }}" class="nav-link hover:text-emerald-800 {{ request()->routeIs('profil') ? 'text-emerald-700 font-bold active' : '' }}">Profil Desa</a>
                <a href="{{ route('berita.index') }}" class="nav-link hover:text-emerald-800 {{ request()->routeIs('berita.*') ? 'text-emerald-700 font-bold active' : '' }}">Berita</a>
                <a href="{{ route('layanan.index') }}" class="nav-link hover:text-emerald-800 {{ request()->routeIs('layanan.*') ? 'text-emerald-700 font-bold active' : '' }}">Layanan Surat</a>
                <a href="{{ route('layanan.cek-status') }}" class="nav-link hover:text-emerald-800 {{ request()->routeIs('layanan.cek-status') ? 'text-emerald-700 font-bold active' : '' }}">Cek Status</a>
            </div>
        </nav>
        
        <!-- Mobile Menu (Removed Login Button) -->
        <div id="menu-mobile" class="hidden md:hidden border-t border-slate-100 px-6 py-4 flex flex-col gap-3 font-semibold text-slate-600 bg-white shadow-inner animate-fadeIn">
            <a href="{{ route('home') }}" class="py-2 border-b border-slate-50 hover:text-emerald-700">Beranda</a>
            <a href="{{ route('profil') }}" class="py-2 border-b border-slate-50 hover:text-emerald-700">Profil Desa</a>
            <a href="{{ route('berita.index') }}" class="py-2 border-b border-slate-50 hover:text-emerald-700">Berita</a>
            <a href="{{ route('layanan.index') }}" class="py-2 border-b border-slate-50 hover:text-emerald-700">Layanan Surat</a>
            <a href="{{ route('layanan.cek-status') }}" class="py-2 hover:text-emerald-700">Cek Status</a>
        </div>
    </header>

    <!-- Alert / Toast Notification -->
    @if (session('success'))
        <div class="max-w-6xl mx-auto px-6 mt-6">
            <div class="bg-emerald-50 text-emerald-800 border border-emerald-200/80 rounded-xl px-5 py-4 flex items-center gap-3 shadow-sm">
                <i class="ti ti-circle-check text-xl text-emerald-600"></i>
                <div class="font-medium text-sm">{{ session('success') }}</div>
            </div>
        </div>
    @endif

    <main id="konten-utama" class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer Premium -->
    <footer class="bg-gradient-to-b from-slate-900 to-slate-950 text-slate-300 mt-20 border-t border-slate-800">
        <div class="max-w-6xl mx-auto px-6 py-16 grid grid-cols-1 md:grid-cols-3 gap-12">
            <div>
                <div class="flex items-center gap-2 mb-4">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-tr from-emerald-600 to-teal-500 flex items-center justify-center text-white">
                        <i class="ti ti-building-community text-sm"></i>
                    </div>
                    <h3 class="text-white font-extrabold text-lg">{{ ($profile ?? \App\Models\DesaProfile::current())->nama_desa }}</h3>
                </div>
                <p class="text-sm text-slate-400 leading-relaxed mb-4">Membangun desa mandiri, inovatif, dan sejahtera melalui transparansi dan pelayanan publik digital yang prima.</p>
                <div class="text-xs text-slate-500 flex items-center gap-1.5">
                    <i class="ti ti-map-pin text-sm"></i>
                    <span>{{ ($profile ?? \App\Models\DesaProfile::current())->alamat_kantor }}</span>
                </div>
            </div>
            
            <div>
                <h3 class="text-white font-bold text-sm uppercase tracking-widest mb-4 border-l-2 border-emerald-500 pl-3">Kontak Desa</h3>
                <ul class="space-y-3 text-sm text-slate-400">
                    <li class="flex items-center gap-2">
                        <i class="ti ti-phone text-emerald-500 text-lg"></i>
                        <span>{{ ($profile ?? \App\Models\DesaProfile::current())->no_telp }}</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="ti ti-mail text-emerald-500 text-lg"></i>
                        <span class="break-all">{{ ($profile ?? \App\Models\DesaProfile::current())->email }}</span>
                    </li>
                </ul>
            </div>
            
            <div>
                <h3 class="text-white font-bold text-sm uppercase tracking-widest mb-4 border-l-2 border-emerald-500 pl-3">Tautan Cepat</h3>
                <ul class="text-sm space-y-2.5 font-medium">
                    <li><a href="{{ route('layanan.index') }}" class="hover:text-white transition flex items-center gap-2 group"><i class="ti ti-chevron-right text-[10px] text-emerald-500 group-hover:translate-x-1 transition-transform"></i> Ajukan Surat</a></li>
                    <li><a href="{{ route('layanan.cek-status') }}" class="hover:text-white transition flex items-center gap-2 group"><i class="ti ti-chevron-right text-[10px] text-emerald-500 group-hover:translate-x-1 transition-transform"></i> Cek Status Pengajuan</a></li>
                    <li><a href="{{ route('berita.index') }}" class="hover:text-white transition flex items-center gap-2 group"><i class="ti ti-chevron-right text-[10px] text-emerald-500 group-hover:translate-x-1 transition-transform"></i> Berita Desa</a></li>
                    <li><a href="{{ route('profil') }}" class="hover:text-white transition flex items-center gap-2 group"><i class="ti ti-chevron-right text-[10px] text-emerald-500 group-hover:translate-x-1 transition-transform"></i> Profil Desa</a></li>
                </ul>
            </div>
        </div>
        
        <div class="text-center text-xs text-slate-500 py-6 border-t border-slate-800 max-w-6xl mx-auto px-6 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div>
                &copy; {{ date('Y') }} {{ ($profile ?? \App\Models\DesaProfile::current())->nama_desa }}. Hak Cipta Dilindungi.
            </div>
            <div class="text-slate-600">
                Sistem Informasi Desa &bull; Universitas
            </div>
        </div>
    </footer>
</body>
</html>

