<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Admin — Sistem Informasi Desa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
    <style> body { font-family: 'Plus Jakarta Sans', sans-serif; } </style>
</head>
<body class="bg-gradient-to-br from-emerald-900 via-teal-950 to-slate-950 min-h-screen flex items-center justify-center p-6 relative overflow-hidden">
    <!-- Hiasan Background Glow -->
    <div class="absolute -top-40 -left-40 w-96 h-96 rounded-full bg-emerald-500/20 blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-40 -right-40 w-96 h-96 rounded-full bg-teal-500/20 blur-3xl pointer-events-none"></div>

    <div class="bg-white/95 backdrop-blur-xl border border-white/20 rounded-3xl shadow-2xl w-full max-w-md p-8 md:p-10 relative z-10">
        <!-- Logo & Header -->
        <div class="text-center mb-8">
            <div class="w-16 h-16 rounded-2xl bg-gradient-to-tr from-emerald-600 to-teal-500 text-white flex items-center justify-center text-3xl mx-auto mb-4 shadow-lg shadow-emerald-600/30">
                <i class="ti ti-shield-lock"></i>
            </div>
            <h1 class="text-2xl font-extrabold text-slate-800 tracking-tight">Panel Administrator</h1>
            <p class="text-slate-400 text-xs mt-1 font-medium">Sistem Informasi Desa</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 text-red-800 border border-red-200/80 rounded-2xl px-4 py-3 mb-6 text-xs flex items-center gap-2">
                <i class="ti ti-alert-circle text-base text-red-600 flex-shrink-0"></i>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <form method="POST" action="{{ route('login.submit') }}" class="space-y-5">
            @csrf
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Alamat Email</label>
                <div class="relative">
                    <i class="ti ti-mail absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-lg"></i>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                           placeholder="admin@desa.id"
                           class="w-full border border-slate-200 rounded-2xl pl-11 pr-4 py-3.5 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none transition-all duration-300">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Kata Sandi</label>
                <div class="relative">
                    <i class="ti ti-lock absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-lg"></i>
                    <input type="password" name="password" required
                           placeholder="••••••••"
                           class="w-full border border-slate-200 rounded-2xl pl-11 pr-4 py-3.5 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none transition-all duration-300">
                </div>
            </div>

            <div class="flex items-center justify-between text-xs font-semibold">
                <label class="flex items-center gap-2 text-slate-600 cursor-pointer select-none">
                    <input type="checkbox" name="remember" class="w-4 h-4 rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                    <span>Ingat Saya</span>
                </label>
            </div>

            <button type="submit" class="w-full bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-bold py-3.5 rounded-2xl shadow-lg shadow-emerald-700/20 hover:scale-[1.01] active:scale-[0.99] transition-all text-sm flex items-center justify-center gap-2">
                <i class="ti ti-login"></i>
                <span>Masuk ke System</span>
            </button>
        </form>

        <div class="text-center mt-8 pt-6 border-t border-slate-100">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-1.5 text-xs text-slate-500 hover:text-emerald-700 font-bold transition-colors group">
                <i class="ti ti-arrow-left group-hover:-translate-x-1 transition-transform"></i>
                <span>Kembali ke Situs Desa</span>
            </a>
        </div>
    </div>
</body>
</html>

