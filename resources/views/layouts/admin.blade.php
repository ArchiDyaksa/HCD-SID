<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — Sistem Informasi Desa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased min-h-screen">
<div class="flex min-h-screen">
    <!-- Sidebar Premium -->
    <aside class="w-68 bg-gradient-to-b from-emerald-950 to-teal-950 text-white flex-col hidden md:flex border-r border-emerald-900/40 shadow-xl">
        <div class="px-6 py-6 border-b border-emerald-900 flex items-center gap-3">
            <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-emerald-500 to-teal-400 flex items-center justify-center shadow-lg shadow-emerald-500/20">
                <i class="ti ti-layout-dashboard text-lg"></i>
            </div>
            <div class="flex flex-col">
                <span class="font-extrabold text-sm tracking-tight">Panel Admin</span>
                <span class="text-[9px] text-emerald-400 uppercase tracking-widest font-bold -mt-0.5">Sistem Informasi Desa</span>
            </div>
        </div>
        
        <nav class="flex-1 px-4 py-6 space-y-1.5 text-sm font-semibold">
            @php 
                $active = 'bg-emerald-800 text-white shadow-md shadow-emerald-800/10'; 
                $inactive = 'text-emerald-100/70 hover:bg-emerald-900/60 hover:text-white transition duration-200'; 
            @endphp
            
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.dashboard') ? $active : $inactive }}">
                <i class="ti ti-chart-pie text-lg"></i>
                <span>Dashboard</span>
            </a>
            
            <a href="{{ route('admin.penduduk.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.penduduk.*') ? $active : $inactive }}">
                <i class="ti ti-users-group text-lg"></i>
                <span>Data Penduduk</span>
            </a>
            
            <a href="{{ route('admin.surat.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.surat.*') ? $active : $inactive }}">
                <i class="ti ti-file-text text-lg"></i>
                <span>Pengajuan Surat</span>
            </a>
            
            <a href="{{ route('admin.jenissurat.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.jenissurat.*') ? $active : $inactive }}">
                <i class="ti ti-folder text-lg"></i>
                <span>Jenis Surat</span>
            </a>
            
            <a href="{{ route('admin.berita.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.berita.*') ? $active : $inactive }}">
                <i class="ti ti-news text-lg"></i>
                <span>Berita Desa</span>
            </a>
            
            <div class="pt-6 border-t border-emerald-900/60 mt-6">
                <a href="{{ route('home') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ $inactive }}" target="_blank">
                    <i class="ti ti-external-link text-lg"></i>
                    <span>Lihat Situs Publik</span>
                </a>
            </div>
        </nav>
        
        <form action="{{ route('logout') }}" method="POST" class="p-4 border-t border-emerald-900">
            @csrf
            <button class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-red-200 hover:bg-red-950/40 hover:text-red-400 transition duration-200 font-semibold">
                <i class="ti ti-logout text-lg"></i>
                <span>Keluar</span>
            </button>
        </form>
    </aside>

    <!-- Konten Dashboard -->
    <div class="flex-grow flex flex-col min-w-0">
        <header class="bg-white border-b border-slate-100 px-8 py-5 flex items-center justify-between sticky top-0 z-35 shadow-sm">
            <div class="flex items-center gap-3">
                <h1 class="text-lg md:text-xl font-bold text-slate-800">@yield('title', 'Dashboard')</h1>
            </div>
            <div class="flex items-center gap-3">
                <div class="hidden sm:flex flex-col text-right">
                    <span class="text-xs text-slate-400 font-medium">Administrator</span>
                    <span class="text-sm text-slate-700 font-semibold">{{ auth()->user()->name ?? 'Admin' }}</span>
                </div>
                <div class="w-10 h-10 rounded-full bg-emerald-50 text-emerald-700 flex items-center justify-center font-bold border border-emerald-100 shadow-inner">
                    {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                </div>
            </div>
        </header>

        <main class="flex-grow p-6 md:p-8 max-w-[1600px] w-full mx-auto">
            @if (session('success'))
                <div class="bg-emerald-50 text-emerald-800 border border-emerald-200/80 rounded-xl px-5 py-4 flex items-center gap-3 shadow-sm mb-6">
                    <i class="ti ti-circle-check text-xl text-emerald-600"></i>
                    <div class="font-medium text-sm">{{ session('success') }}</div>
                </div>
            @endif
            @if ($errors->any())
                <div class="bg-red-50 text-red-800 border border-red-200/80 rounded-xl px-5 py-4 shadow-sm mb-6">
                    <div class="flex items-center gap-3 mb-2 text-red-600 font-semibold text-sm">
                        <i class="ti ti-circle-x text-xl"></i>
                        <span>Mohon perbaiki kesalahan berikut:</span>
                    </div>
                    <ul class="list-disc list-inside text-xs text-red-700/90 pl-1 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</div>
</body>
</html>
