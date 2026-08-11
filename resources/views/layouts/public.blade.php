<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Informasi Desa')</title>
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><rect width='100' height='100' rx='25' fill='%23047857'/><path d='M30 70 L50 30 L70 70 Z' fill='%23ffffff'/><circle cx='50' cy='42' r='8' fill='%2334d399'/></svg>">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
    <script>
        (function() {
            if (localStorage.getItem('kontras-tinggi') === 'true') {
                document.documentElement.classList.add('kontras-tinggi');
            }
            const fontLevel = localStorage.getItem('font-level');
            if (fontLevel === 'besar') {
                document.documentElement.classList.add('text-besar');
            } else if (fontLevel === 'sangat-besar') {
                document.documentElement.classList.add('text-sangat-besar');
            }
            if (localStorage.getItem('highlight-links') === 'true') {
                document.documentElement.classList.add('highlight-links');
            }
        })();
    </script>
    <style>
        html { font-size: 16px; scroll-behavior: smooth; }
        html.text-besar { font-size: 18px; }
        html.text-sangat-besar { font-size: 21px; }

        html.highlight-links a,
        html.highlight-links button {
            outline: 3px solid #3b82f6 !important;
            outline-offset: 2px !important;
        }
        
        /* Premium Dark Mode & High Contrast Design System */
        html.kontras-tinggi body { 
            background-color: #0b0f19 !important; 
            color: #f1f5f9 !important; 
        }

        /* Card & Box Containers */
        html.kontras-tinggi .bg-white,
        html.kontras-tinggi .bg-slate-50,
        html.kontras-tinggi .bg-slate-100,
        html.kontras-tinggi .bg-slate-200,
        html.kontras-tinggi article { 
            background-color: #111827 !important; 
            color: #f1f5f9 !important; 
            border-color: #1f2937 !important; 
        }

        /* Text Contrast Overrides */
        html.kontras-tinggi p,
        html.kontras-tinggi label,
        html.kontras-tinggi td,
        html.kontras-tinggi th,
        html.kontras-tinggi li,
        html.kontras-tinggi span { color: #cbd5e1 !important; }

        /* ==========================================================================
           HIGH CONTRAST (DARK MODE) - ACCURATE & HARMONIOUS ICON STYLING
           ========================================================================== */

        /* 1. Base Dark Mode Typography */
        html.kontras-tinggi h1,
        html.kontras-tinggi h2,
        html.kontras-tinggi h3,
        html.kontras-tinggi h4,
        html.kontras-tinggi h5,
        html.kontras-tinggi h6,
        html.kontras-tinggi .font-extrabold,
        html.kontras-tinggi .font-bold { color: #f8fafc !important; }
        
        html.kontras-tinggi p,
        html.kontras-tinggi label,
        html.kontras-tinggi td,
        html.kontras-tinggi th,
        html.kontras-tinggi li,
        html.kontras-tinggi span:not([class*="text-"]):not([class*="bg-"]) { color: #cbd5e1 !important; }

        html.kontras-tinggi .text-slate-300,
        html.kontras-tinggi .text-slate-400,
        html.kontras-tinggi .text-slate-500,
        html.kontras-tinggi .text-slate-600,
        html.kontras-tinggi .text-slate-700,
        html.kontras-tinggi .text-slate-800,
        html.kontras-tinggi .text-slate-900 { color: #cbd5e1 !important; }

        /* 2. Default Icon Color */
        html.kontras-tinggi i.ti,
        html.kontras-tinggi [class*="ti-"] {
            color: #34d399; /* Bright Emerald Default */
        }

        /* 3. Solid Buttons / Badges / Headers with Dark/Solid Backgrounds -> Crisp White Icons */
        html.kontras-tinggi .bg-emerald-600 i,
        html.kontras-tinggi .bg-emerald-700 i,
        html.kontras-tinggi .bg-emerald-800 i,
        html.kontras-tinggi .bg-teal-600 i,
        html.kontras-tinggi .bg-gradient-to-r i,
        html.kontras-tinggi .bg-gradient-to-br i,
        html.kontras-tinggi .bg-gradient-to-tr i,
        html.kontras-tinggi .bg-slate-900 i,
        html.kontras-tinggi .bg-slate-950 i,
        html.kontras-tinggi button.bg-emerald-600 i,
        html.kontras-tinggi button.bg-emerald-700 i,
        html.kontras-tinggi a.bg-emerald-600 i,
        html.kontras-tinggi a.bg-emerald-700 i,
        html.kontras-tinggi .text-white,
        html.kontras-tinggi .text-white i,
        html.kontras-tinggi .text-white span,
        html.kontras-tinggi #panel-aksesibilitas-fab i,
        html.kontras-tinggi #panel-aksesibilitas-fab span {
            color: #ffffff !important;
        }

        /* 4. Categorized Color Systems for Badges & Icons in High Contrast */

        /* Emerald / Green (Default SID Accent, Surat, Kependudukan Utama, Card Kepala Desa) */
        html.kontras-tinggi .bg-emerald-50,
        html.kontras-tinggi .bg-emerald-100,
        html.kontras-tinggi [class*="bg-emerald-50"],
        html.kontras-tinggi .bg-green-50,
        html.kontras-tinggi .bg-green-100,
        html.kontras-tinggi .bg-emerald-500\/10,
        html.kontras-tinggi .bg-emerald-500\/20 {
            background-color: #1e293b !important;
            color: #34d399 !important;
            border-color: rgba(52, 211, 153, 0.4) !important;
        }
        html.kontras-tinggi .text-emerald-400,
        html.kontras-tinggi .text-emerald-500,
        html.kontras-tinggi .text-emerald-600,
        html.kontras-tinggi .text-emerald-700,
        html.kontras-tinggi .text-emerald-800,
        html.kontras-tinggi .text-emerald-900,
        html.kontras-tinggi .text-emerald-950,
        html.kontras-tinggi .text-green-600,
        html.kontras-tinggi .text-green-700,
        html.kontras-tinggi .bg-emerald-50 i,
        html.kontras-tinggi .bg-emerald-100 i,
        html.kontras-tinggi .ti-circle-check-filled {
            color: #34d399 !important;
        }

        /* Blue / Sky (Laki-laki, WhatsApp, Telepon, Info, Kontak) */
        html.kontras-tinggi .bg-blue-50,
        html.kontras-tinggi .bg-blue-100,
        html.kontras-tinggi .bg-sky-50,
        html.kontras-tinggi .bg-sky-100 {
            background-color: rgba(59, 130, 246, 0.2) !important;
            color: #60a5fa !important;
            border-color: rgba(96, 165, 250, 0.4) !important;
        }
        html.kontras-tinggi .text-blue-400,
        html.kontras-tinggi .text-blue-500,
        html.kontras-tinggi .text-blue-600,
        html.kontras-tinggi .text-blue-700,
        html.kontras-tinggi .text-blue-800,
        html.kontras-tinggi .text-blue-900,
        html.kontras-tinggi .bg-blue-50 i,
        html.kontras-tinggi .bg-blue-100 i,
        html.kontras-tinggi .ti-man,
        html.kontras-tinggi .ti-gender-male {
            color: #60a5fa !important;
        }

        /* Pink / Rose (Perempuan) */
        html.kontras-tinggi .bg-pink-50,
        html.kontras-tinggi .bg-pink-100,
        html.kontras-tinggi .bg-rose-50,
        html.kontras-tinggi .bg-rose-100 {
            background-color: rgba(244, 63, 94, 0.2) !important;
            color: #fb7185 !important;
            border-color: rgba(251, 113, 133, 0.4) !important;
        }
        html.kontras-tinggi .text-pink-400,
        html.kontras-tinggi .text-pink-500,
        html.kontras-tinggi .text-pink-600,
        html.kontras-tinggi .text-pink-700,
        html.kontras-tinggi .text-pink-800,
        html.kontras-tinggi .bg-pink-50 i,
        html.kontras-tinggi .bg-pink-100 i,
        html.kontras-tinggi .ti-woman,
        html.kontras-tinggi .ti-gender-female {
            color: #fb7185 !important;
        }

        /* Indigo / Purple / Violet (Lokasi Peta, Kantor Desa, Galeri) */
        html.kontras-tinggi .bg-indigo-50,
        html.kontras-tinggi .bg-indigo-100,
        html.kontras-tinggi .bg-purple-50,
        html.kontras-tinggi .bg-purple-100 {
            background-color: rgba(99, 102, 241, 0.2) !important;
            color: #a5b4fc !important;
            border-color: rgba(165, 180, 252, 0.4) !important;
        }
        html.kontras-tinggi .text-indigo-400,
        html.kontras-tinggi .text-indigo-500,
        html.kontras-tinggi .text-indigo-600,
        html.kontras-tinggi .text-indigo-700,
        html.kontras-tinggi .text-purple-400,
        html.kontras-tinggi .text-purple-500,
        html.kontras-tinggi .text-purple-600,
        html.kontras-tinggi .text-purple-700,
        html.kontras-tinggi .bg-indigo-50 i,
        html.kontras-tinggi .bg-indigo-100 i,
        html.kontras-tinggi .ti-brand-google-maps {
            color: #a5b4fc !important;
        }

        /* Teal (Visi, Misi, Struktur Organisasi) */
        html.kontras-tinggi .bg-teal-50,
        html.kontras-tinggi .bg-teal-100,
        html.kontras-tinggi .bg-teal-50\/40 {
            background-color: rgba(20, 184, 166, 0.2) !important;
            color: #2dd4bf !important;
            border-color: rgba(45, 212, 191, 0.4) !important;
        }
        html.kontras-tinggi .text-teal-400,
        html.kontras-tinggi .text-teal-500,
        html.kontras-tinggi .text-teal-600,
        html.kontras-tinggi .text-teal-700,
        html.kontras-tinggi .bg-teal-50 i,
        html.kontras-tinggi .bg-teal-100 i {
            color: #2dd4bf !important;
        }

        /* Amber / Yellow (Peringatan, Waktu / Agenda, Catatan) */
        html.kontras-tinggi .bg-amber-50,
        html.kontras-tinggi .bg-amber-100,
        html.kontras-tinggi .bg-yellow-50,
        html.kontras-tinggi .bg-yellow-100 {
            background-color: rgba(245, 158, 11, 0.2) !important;
            color: #fbbf24 !important;
            border-color: rgba(251, 191, 36, 0.4) !important;
        }
        html.kontras-tinggi .text-amber-400,
        html.kontras-tinggi .text-amber-500,
        html.kontras-tinggi .text-amber-600,
        html.kontras-tinggi .text-amber-700,
        html.kontras-tinggi .bg-amber-50 i,
        html.kontras-tinggi .bg-amber-100 i,
        html.kontras-tinggi .ti-alert-triangle,
        html.kontras-tinggi .ti-clock {
            color: #fbbf24 !important;
        }

        /* Red (Ditolak, Batal, Tutup, Hapus, Error) */
        html.kontras-tinggi .bg-red-50,
        html.kontras-tinggi .bg-red-100 {
            background-color: rgba(239, 68, 68, 0.2) !important;
            color: #f87171 !important;
            border-color: rgba(248, 113, 113, 0.4) !important;
        }
        html.kontras-tinggi .text-red-400,
        html.kontras-tinggi .text-red-500,
        html.kontras-tinggi .text-red-600,
        html.kontras-tinggi .text-red-700,
        html.kontras-tinggi .bg-red-50 i,
        html.kontras-tinggi .bg-red-100 i,
        html.kontras-tinggi .ti-circle-x,
        html.kontras-tinggi .ti-trash {
            color: #f87171 !important;
        }

        /* Slate Boxes & Modal Close Buttons */
        html.kontras-tinggi .bg-slate-50,
        html.kontras-tinggi .bg-slate-100,
        html.kontras-tinggi .bg-slate-200 {
            background-color: #1e293b !important;
            color: #e2e8f0 !important;
            border-color: #334155 !important;
        }
        html.kontras-tinggi .bg-slate-100 i,
        html.kontras-tinggi .bg-slate-200 i,
        html.kontras-tinggi button.rounded-full i {
            color: #f8fafc !important;
        }

        /* 5. Form Input Prefix Icons */
        html.kontras-tinggi .relative > i,
        html.kontras-tinggi i.absolute,
        html.kontras-tinggi form i {
            color: #34d399 !important;
        }
        
        html.kontras-tinggi .nav-link { color: #cbd5e1 !important; }
        html.kontras-tinggi .nav-link:hover,
        html.kontras-tinggi .nav-link.active { color: #34d399 !important; }
        html.kontras-tinggi .nav-link::after { background-color: #34d399 !important; }

        html.kontras-tinggi header a,
        html.kontras-tinggi nav a,
        html.kontras-tinggi button { text-decoration: none !important; }

        /* Header Glassmorphism in Dark Mode */
        html.kontras-tinggi .glass-header {
            background: rgba(15, 23, 42, 0.95) !important;
            border-bottom: 1px solid #1f2937 !important;
        }

        /* Input Form & Input Icon Fixes */
        html.kontras-tinggi input,
        html.kontras-tinggi textarea,
        html.kontras-tinggi select { 
            background-color: #0f172a !important; 
            color: #f8fafc !important; 
            border-color: #334155 !important; 
        }
        
        html.kontras-tinggi input:focus,
        html.kontras-tinggi textarea:focus,
        html.kontras-tinggi select:focus {
            border-color: #34d399 !important;
            box-shadow: 0 0 0 2px rgba(52, 211, 153, 0.2) !important;
        }

        html.kontras-tinggi .relative i {
            color: #34d399 !important;
        }

        /* Modals & Dialogs */
        html.kontras-tinggi #modal-ajukan-surat > div,
        html.kontras-tinggi #modal-preview > div,
        html.kontras-tinggi #modal-berita > div {
            background-color: #111827 !important;
            border: 1px solid #374151 !important;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.7) !important;
        }

        /* Text & Icon contrast override for dark mode buttons & badges */
        html.kontras-tinggi .text-white,
        html.kontras-tinggi .text-white * {
            color: #ffffff !important;
        }

        /* Share Toast in High Contrast */
        html.kontras-tinggi #share-toast > div {
            background-color: #1e293b !important;
            border-color: #475569 !important;
            color: #f8fafc !important;
        }

        /* Mobile Menu */
        html.kontras-tinggi #menu-mobile {
            background-color: #111827 !important;
            border-color: #1f2937 !important;
        }
        html.kontras-tinggi #menu-mobile a {
            border-color: #1f2937 !important;
            color: #e2e8f0 !important;
        }
        html.kontras-tinggi #menu-mobile a:hover {
            color: #34d399 !important;
        }

        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-header {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
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
    <script>
        function toggleTextBesar() {
            const isBig = document.documentElement.classList.toggle('text-besar');
            localStorage.setItem('text-besar', isBig);
        }
        function toggleKontrasTinggi() {
            const isHighContrast = document.documentElement.classList.toggle('kontras-tinggi');
            localStorage.setItem('kontras-tinggi', isHighContrast);
        }
    </script>
</head>
<body class="bg-slate-50 text-slate-800 antialiased min-h-screen flex flex-col selection:bg-emerald-600 selection:text-white">

    <a href="#konten-utama" class="skip-link fixed -translate-y-20 focus:translate-y-0 transition duration-300 bg-emerald-700 text-white px-5 py-3 z-50 top-0 left-0 rounded-br-xl shadow-lg font-semibold">Lompat ke konten utama</a>

    <!-- Header Utama Terpadu (Sticky Top Stay saat Scroll) -->
    <header class="sticky top-0 z-50 w-full transition-all duration-300 shadow-sm">
        <!-- Bar Informasi Top -->
        <div class="bg-gradient-to-r from-emerald-950 via-teal-900 to-slate-950 text-white text-xs border-b border-emerald-800/40">
            <div class="max-w-6xl mx-auto px-6 py-2 flex items-center justify-between font-medium">
                <div class="flex items-center gap-2">
                    <span class="inline-block w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>Portal Resmi {{ ($profile ?? \App\Models\DesaProfile::current())->nama_desa }}</span>
                </div>
                <div class="text-[11px] text-emerald-300/80 hidden sm:block">
                    Sistem Informasi Kependudukan & Layanan Desa Mandiri
                </div>
            </div>
        </div>

        <!-- Navigasi Glassmorphism -->
        <div class="glass-header border-b border-slate-100/80">
            <nav class="max-w-6xl mx-auto px-6 py-3.5 flex items-center justify-between">
                <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-emerald-600 to-teal-500 flex items-center justify-center text-white shadow-md shadow-emerald-600/20 group-hover:scale-105 transition-transform duration-300 overflow-hidden">
                        @if(($profile ?? \App\Models\DesaProfile::current())->logo)
                            <img src="{{ asset('storage/' . ($profile ?? \App\Models\DesaProfile::current())->logo) }}" class="w-full h-full object-cover">
                        @else
                            <i class="ti ti-building-community text-xl" aria-hidden="true"></i>
                        @endif
                    </div>
                    <div class="flex flex-col">
                        <span class="font-extrabold text-base tracking-tight text-emerald-950 group-hover:text-emerald-800 transition-colors">{{ ($profile ?? \App\Models\DesaProfile::current())->nama_desa }}</span>
                        <span class="text-[10px] text-emerald-600 uppercase tracking-widest font-bold -mt-1">Portal Desa</span>
                    </div>
                </a>
                
                <button class="md:hidden text-slate-700 hover:text-emerald-700 focus:outline-none p-1" onclick="document.getElementById('menu-mobile').classList.toggle('hidden')" aria-label="Buka menu">
                    <i class="ti ti-menu-2 text-2xl"></i>
                </button>
                
                <div class="hidden md:flex items-center gap-6 font-semibold text-sm text-slate-600">
                    <a href="{{ route('home') }}" class="nav-link hover:text-emerald-800 {{ request()->routeIs('home') ? 'text-emerald-700 font-bold active' : '' }}">Beranda</a>
                    <a href="{{ route('profil') }}" class="nav-link hover:text-emerald-800 {{ request()->routeIs('profil') ? 'text-emerald-700 font-bold active' : '' }}">Profil</a>
                    <a href="{{ route('kegiatan.index') }}" class="nav-link hover:text-emerald-800 {{ request()->routeIs('kegiatan.*') ? 'text-emerald-700 font-bold active' : '' }}">Agenda</a>
                    <a href="{{ route('berita.index') }}" class="nav-link hover:text-emerald-800 {{ request()->routeIs('berita.*') ? 'text-emerald-700 font-bold active' : '' }}">Berita</a>
                    <a href="{{ route('galeri.index') }}" class="nav-link hover:text-emerald-800 {{ request()->routeIs('galeri.*') ? 'text-emerald-700 font-bold active' : '' }}">Galeri</a>
                    <a href="{{ route('kontak.index') }}" class="nav-link hover:text-emerald-800 {{ request()->routeIs('kontak.*') ? 'text-emerald-700 font-bold active' : '' }}">Kontak</a>
                    <a href="{{ route('layanan.index') }}" class="px-4 py-2 rounded-xl bg-emerald-600 text-white font-bold hover:bg-emerald-700 shadow-md shadow-emerald-600/20 transition-all">Layanan Surat</a>
                </div>
            </nav>
            
            <!-- Mobile Menu -->
            <div id="menu-mobile" class="hidden md:hidden border-t border-slate-100 px-6 py-4 flex flex-col gap-3 font-semibold text-slate-600 bg-white shadow-inner animate-fadeIn">
                <a href="{{ route('home') }}" class="py-2 border-b border-slate-50 hover:text-emerald-700">Beranda</a>
                <a href="{{ route('profil') }}" class="py-2 border-b border-slate-50 hover:text-emerald-700">Profil Desa</a>
                <a href="{{ route('kegiatan.index') }}" class="py-2 border-b border-slate-50 hover:text-emerald-700">Agenda Kegiatan</a>
                <a href="{{ route('berita.index') }}" class="py-2 border-b border-slate-50 hover:text-emerald-700">Berita Desa</a>
                <a href="{{ route('galeri.index') }}" class="py-2 border-b border-slate-50 hover:text-emerald-700">Galeri Foto</a>
                <a href="{{ route('kontak.index') }}" class="py-2 border-b border-slate-50 hover:text-emerald-700">Kontak Penting</a>
                <a href="{{ route('layanan.index') }}" class="py-2 border-b border-slate-50 hover:text-emerald-700">Layanan Surat</a>
                <a href="{{ route('layanan.cek-status') }}" class="py-2 hover:text-emerald-700">Cek Status Surat</a>
            </div>
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
        </div>
    </footer>

    <!-- Floating Assistive HCD Button & WhatsApp Hotline -->
    <div class="fixed bottom-6 left-6 z-40">
        <button onclick="toggleHcdModal()" 
                title="Panel Aksesibilitas HCD" 
                aria-label="Buka Panel Aksesibilitas"
                class="w-12 h-12 rounded-full bg-gradient-to-r from-emerald-600 to-teal-700 hover:from-emerald-500 hover:to-teal-600 text-white shadow-2xl shadow-emerald-950/60 border border-emerald-400/40 flex items-center justify-center hover:scale-110 active:scale-95 transition-all duration-300">
            <i class="ti ti-settings text-2xl"></i>
        </button>
    </div>

    <!-- Modal Drawer Aksesibilitas HCD -->
    <div id="hcd-accessibility-modal" class="fixed inset-0 z-50 bg-slate-950/60 backdrop-blur-sm hidden flex items-center justify-center p-4 transition-opacity">
        <div class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl border border-slate-100 relative text-slate-800 animate-fadeIn">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-6">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl font-bold">
                        <i class="ti ti-accessibility"></i>
                    </div>
                    <div>
                        <h3 class="font-extrabold text-slate-800 text-lg">Panel Aksesibilitas HCD</h3>
                        <p class="text-xs text-slate-400">Pengaturan kenyamanan baca & bantuan suara warga</p>
                    </div>
                </div>
                <button onclick="toggleHcdModal()" class="w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-500 flex items-center justify-center transition">
                    <i class="ti ti-x text-lg"></i>
                </button>
            </div>

            <div class="space-y-6 text-sm">
                <!-- Fitur 2: Pengatur Ukuran Huruf -->
                <div>
                    <label class="font-bold text-slate-800 flex items-center gap-2 mb-2">
                        <i class="ti ti-typography text-blue-600 text-lg"></i> Ukuran Huruf
                    </label>
                    <div class="grid grid-cols-3 gap-2">
                        <button onclick="setFontLevel('normal')" class="py-2.5 px-3 rounded-xl border border-slate-200 font-semibold text-xs text-slate-700 hover:bg-emerald-50 hover:border-emerald-300 hover:text-emerald-700 transition text-center">
                            Normal (16px)
                        </button>
                        <button onclick="setFontLevel('besar')" class="py-2.5 px-3 rounded-xl border border-slate-200 font-semibold text-xs text-slate-700 hover:bg-emerald-50 hover:border-emerald-300 hover:text-emerald-700 transition text-center">
                            Besar (18px)
                        </button>
                        <button onclick="setFontLevel('sangat-besar')" class="py-2.5 px-3 rounded-xl border border-slate-200 font-semibold text-xs text-slate-700 hover:bg-emerald-50 hover:border-emerald-300 hover:text-emerald-700 transition text-center">
                            Ekstra (21px)
                        </button>
                    </div>
                </div>

                <!-- Fitur 3: Mode Kontras Tinggi / Dark Mode -->
                <div class="flex items-center justify-between pt-2">
                    <div>
                        <div class="font-bold text-slate-800 flex items-center gap-2">
                            <i class="ti ti-contrast text-purple-600 text-lg"></i> Mode Kontras Tinggi / Malam
                        </div>
                        <div class="text-xs text-slate-400 mt-0.5">Meningkatkan kontras warna untuk mata sensitif</div>
                    </div>
                    <button onclick="toggleKontrasTinggi()" class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 font-bold text-xs text-slate-700 transition">
                        Ubah
                    </button>
                </div>

                <!-- Fitur 4: Highlight Tautan Interaktif -->
                <div class="flex items-center justify-between pt-2 border-t border-slate-100">
                    <div>
                        <div class="font-bold text-slate-800 flex items-center gap-2">
                            <i class="ti ti-link text-amber-600 text-lg"></i> Penanda Garis Tepi Tautan
                        </div>
                        <div class="text-xs text-slate-400 mt-0.5">Memperjelas letak tombol dan tautan yang dapat diklik</div>
                    </div>
                    <button onclick="toggleHighlightLinks()" class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 font-bold text-xs text-slate-700 transition">
                        Ubah
                    </button>
                </div>
            </div>

            <div class="mt-6 pt-4 border-t border-slate-100 text-center">
                <button onclick="toggleHcdModal()" class="w-full bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold py-3 rounded-2xl transition">
                    Selesai & Tutup
                </button>
            </div>
        </div>
    </div>

    <!-- Toast Notification Container -->
    <div id="share-toast" class="fixed bottom-6 right-6 z-50 transform translate-y-20 opacity-0 pointer-events-none transition-all duration-300">
        <div class="bg-slate-900 text-white border border-slate-700 rounded-2xl px-5 py-3.5 shadow-2xl flex items-center gap-3">
            <div class="w-8 h-8 rounded-xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center flex-shrink-0">
                <i class="ti ti-circle-check text-xl"></i>
            </div>
            <div class="text-xs font-semibold" id="share-toast-msg">Link berhasil disalin!</div>
        </div>
    </div>

    <script>
        function toggleHcdModal() {
            const modal = document.getElementById('hcd-accessibility-modal');
            if (modal) {
                modal.classList.toggle('hidden');
            }
        }

        function setFontLevel(level) {
            document.documentElement.classList.remove('text-besar', 'text-sangat-besar');
            if (level === 'besar') {
                document.documentElement.classList.add('text-besar');
                localStorage.setItem('font-level', 'besar');
            } else if (level === 'sangat-besar') {
                document.documentElement.classList.add('text-sangat-besar');
                localStorage.setItem('font-level', 'sangat-besar');
            } else {
                localStorage.setItem('font-level', 'normal');
            }
        }

        function toggleHighlightLinks() {
            const isHighlighted = document.documentElement.classList.toggle('highlight-links');
            localStorage.setItem('highlight-links', isHighlighted);
        }

        let isSpeaking = false;
        function bacaHalamanIni() {
            if (!('speechSynthesis' in window)) {
                alert('Browser Anda belum mendukung fitur Pembaca Suara otomatis.');
                return;
            }
            if (isSpeaking) {
                window.speechSynthesis.cancel();
                isSpeaking = false;
                const btnText = document.getElementById('tts-btn-text');
                if (btnText) btnText.innerText = '🔊 Asisten Suara';
                return;
            }

            const mainContent = document.getElementById('konten-utama');
            if (!mainContent) return;

            const textToRead = mainContent.innerText.substring(0, 800);
            const utterance = new SpeechSynthesisUtterance(textToRead);
            utterance.lang = 'id-ID';
            utterance.rate = 0.95;

            utterance.onstart = function() {
                isSpeaking = true;
                const btnText = document.getElementById('tts-btn-text');
                if (btnText) btnText.innerText = '⏹️ Hentikan Suara';
            };

            utterance.onend = function() {
                isSpeaking = false;
                const btnText = document.getElementById('tts-btn-text');
                if (btnText) btnText.innerText = '🔊 Asisten Suara';
            };

            utterance.onerror = function() {
                isSpeaking = false;
                const btnText = document.getElementById('tts-btn-text');
                if (btnText) btnText.innerText = '🔊 Asisten Suara';
            };

            window.speechSynthesis.cancel();
            window.speechSynthesis.speak(utterance);
        }

        function copyToClipboard(text, customMessage = 'Tautan berhasil disalin!') {
            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(text).then(showToast).catch(fallbackCopy);
            } else {
                fallbackCopy();
            }

            function fallbackCopy() {
                const textArea = document.createElement("textarea");
                textArea.value = text;
                textArea.style.position = "fixed";
                textArea.style.left = "-999999px";
                textArea.style.top = "-999999px";
                document.body.appendChild(textArea);
                textArea.focus();
                textArea.select();
                try {
                    document.execCommand('copy');
                    showToast();
                } catch (err) {
                    console.error('Gagal menyalin tautan:', err);
                }
                document.body.removeChild(textArea);
            }

            function showToast() {
                const toast = document.getElementById('share-toast');
                const toastMsg = document.getElementById('share-toast-msg');
                if (toast && toastMsg) {
                    toastMsg.innerText = customMessage;
                    toast.classList.remove('translate-y-20', 'opacity-0', 'pointer-events-none');
                    toast.classList.add('translate-y-0', 'opacity-100');
                    setTimeout(() => {
                        toast.classList.remove('translate-y-0', 'opacity-100');
                        toast.classList.add('translate-y-20', 'opacity-0', 'pointer-events-none');
                    }, 3000);
                }
            }
        }

        function shareToWhatsapp(title, url, extraInfo = '') {
            let message = `*${title}*\n`;
            if (extraInfo) {
                message += `${extraInfo}\n`;
            }
            message += `\nSelengkapnya dapat dilihat pada tautan berikut:\n${url}`;
            const waUrl = `https://api.whatsapp.com/send?text=${encodeURIComponent(message)}`;
            window.open(waUrl, '_blank', 'noopener,noreferrer');
        }
    </script>
</body>
</html>

