@extends('layouts.public')

@section('title', 'Kontak Penting & Layanan Darurat')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-br from-emerald-950 via-teal-900 to-slate-900 text-white py-16 px-6 overflow-hidden">
    <div class="max-w-6xl mx-auto relative z-10 text-center">
        <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-red-500/20 text-red-300 border border-red-500/30 text-xs font-extrabold uppercase tracking-widest mb-4">
            <i class="ti ti-phone-call"></i> Akses Cepat & Darurat
        </span>
        <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight">Kontak Penting & Layanan Darurat</h1>
        <p class="text-slate-300 text-sm md:text-base max-w-2xl mx-auto mt-3">Daftar kontak nomor penting perangkat desa, puskesmas, polisi, pemadam kebakaran, dan fasilitas umum terdekat.</p>
    </div>
</section>

<!-- Main Content -->
<section class="max-w-6xl mx-auto px-6 py-12 space-y-12">
    @forelse ($kontaks as $kategori => $items)
    <div>
        <div class="flex items-center gap-3 mb-6 pb-2 border-b border-slate-200">
            <div class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center font-bold">
                <i class="ti ti-phone text-lg"></i>
            </div>
            <h2 class="text-xl font-extrabold text-slate-800 tracking-tight">{{ $kategori }}</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($items as $item)
            <div class="bg-white rounded-3xl border border-slate-100 p-6 shadow-xl shadow-slate-200/30 hover:shadow-2xl transition-all flex flex-col justify-between">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-md mb-2 inline-block">
                        {{ $item->jabatan_peran ?: 'Kontak Resmi' }}
                    </span>
                    <h3 class="text-lg font-extrabold text-slate-800 tracking-tight">{{ $item->nama }}</h3>
                    @if ($item->alamat)
                    <p class="text-slate-400 text-xs mt-1 leading-relaxed">{{ $item->alamat }}</p>
                    @endif
                </div>

                <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between">
                    <div>
                        <span class="text-[10px] text-slate-400 font-semibold uppercase block">Nomor Telepon</span>
                        <span class="font-mono font-bold text-slate-800 text-sm">{{ $item->no_telp }}</span>
                    </div>

                    <a href="tel:{{ $item->no_telp }}" class="w-10 h-10 rounded-2xl bg-emerald-600 hover:bg-emerald-700 text-white flex items-center justify-center shadow-lg shadow-emerald-600/30 transition-transform active:scale-95">
                        <i class="ti ti-phone-call text-lg"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @empty
    <div class="bg-white rounded-3xl border border-slate-100 p-12 text-center text-slate-400">
        Belum ada daftar kontak penting yang ditambahkan.
    </div>
    @endforelse
</section>
@endsection
