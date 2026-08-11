@extends('layouts.public')
@section('title', 'Profil Desa — ' . $profile->nama_desa)
@section('content')
<!-- Header Section -->
<section class="relative bg-gradient-to-br from-emerald-950 via-teal-900 to-slate-900 text-white py-16 px-6 overflow-hidden">
    <div class="max-w-6xl mx-auto relative z-10 text-center">
        <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 text-xs font-extrabold uppercase tracking-widest mb-4">
            <i class="ti ti-photo-heart"></i> Profil Desa
        </span>
        <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight">Profil {{ $profile->nama_desa }}</h1>
        <p class="text-slate-300 text-sm md:text-base max-w-2xl mx-auto mt-3">
            <i class="ti ti-map-pin"></i> {{ $profile->kecamatan }}, {{ $profile->kabupaten }}, {{ $profile->provinsi }}
        </p>
    </div>
</section>
<section class="max-w-4xl mx-auto px-6 py-12 -mt-8 relative z-10">
    <!-- Quick Info Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-12">
        <div class="bg-white rounded-2xl border border-slate-100 shadow-xl shadow-slate-200/50 p-6 text-center hover:border-emerald-200 transition-colors duration-300">
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-xl mx-auto mb-3">
                <i class="ti ti-ruler-measure"></i>
            </div>
            <div class="font-extrabold text-slate-800">{{ $profile->luas_wilayah ?: '-' }}</div>
            <div class="text-xs text-slate-400 font-semibold mt-1">Luas Wilayah</div>
        </div>
        
        <div class="bg-white rounded-2xl border border-slate-100 shadow-xl shadow-slate-200/50 p-6 text-center hover:border-emerald-200 transition-colors duration-300">
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-xl mx-auto mb-3">
                <i class="ti ti-phone-call"></i>
            </div>
            <div class="font-extrabold text-slate-800">{{ $profile->no_telp ?: '-' }}</div>
            <div class="text-xs text-slate-400 font-semibold mt-1">Telepon Kantor</div>
        </div>
        
        <div class="bg-white rounded-2xl border border-slate-100 shadow-xl shadow-slate-200/50 p-6 text-center hover:border-emerald-200 transition-colors duration-300">
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-xl mx-auto mb-3">
                <i class="ti ti-mail"></i>
            </div>
            <div class="font-extrabold text-slate-800 break-all">{{ $profile->email ?: '-' }}</div>
            <div class="text-xs text-slate-400 font-semibold mt-1">Email Resmi</div>
        </div>
    </div>
    <!-- Main Content Cards -->
    <div class="space-y-8">
        <!-- Sejarah -->
        <div class="bg-white rounded-3xl border border-slate-100 shadow-lg shadow-slate-200/40 p-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-lg">
                    <i class="ti ti-history"></i>
                </div>
                <h2 class="text-xl font-bold text-slate-800 tracking-tight">Sejarah Desa</h2>
            </div>
            <p class="text-slate-600 leading-relaxed text-sm whitespace-pre-line border-l-4 border-emerald-500 pl-4 py-1">{{ $profile->sejarah ?: 'Belum ada data.' }}</p>
        </div>
        <!-- Visi & Misi -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Visi -->
            <div class="bg-white rounded-3xl border border-slate-100 shadow-lg shadow-slate-200/40 p-8 flex flex-col">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-teal-50 text-teal-700 flex items-center justify-center text-lg">
                        <i class="ti ti-eye"></i>
                    </div>
                    <h2 class="text-xl font-bold text-slate-800 tracking-tight">Visi</h2>
                </div>
                <p class="text-slate-600 leading-relaxed text-sm italic font-medium bg-teal-50/40 p-5 rounded-2xl border border-teal-100/50 flex-grow">
                    "{{ $profile->visi ?: 'Belum ada data.' }}"
                </p>
            </div>
            <!-- Misi -->
            <div class="bg-white rounded-3xl border border-slate-100 shadow-lg shadow-slate-200/40 p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-teal-50 text-teal-700 flex items-center justify-center text-lg">
                        <i class="ti ti-target-arrow"></i>
                    </div>
                    <h2 class="text-xl font-bold text-slate-800 tracking-tight">Misi</h2>
                </div>
                <ul class="space-y-3.5 text-slate-600 text-sm">
                    @forelse (explode("\n", $profile->misi ?? '') as $misi)
                        @if(trim($misi))
                            <li class="flex items-start gap-2.5">
                                <i class="ti ti-circle-check-filled text-emerald-600 text-base mt-0.5 flex-shrink-0"></i>
                                <span>{{ trim($misi) }}</span>
                            </li>
                        @endif
                    @empty
                        <li class="flex items-center gap-2">
                            <i class="ti ti-circle-x text-red-500"></i>
                            <span>Belum ada data.</span>
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>
        <!-- Struktur Kepengurusan Aparatur Desa -->
        <div class="bg-white rounded-3xl border border-slate-100 shadow-lg shadow-slate-200/40 p-8">
            <div class="flex items-center justify-between gap-4 mb-6 pb-4 border-b border-slate-100 flex-wrap">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-lg">
                        <i class="ti ti-users-group"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-slate-800 tracking-tight">Struktur Kepengurusan Aparatur Desa</h2>
                        <p class="text-xs text-slate-400 mt-0.5">Susunan aparatur pelaksana pemerintah Desa {{ $profile->nama_desa }}</p>
                    </div>
                </div>
                @if($profile->struktur_organisasi)
                    <button type="button" onclick="openStrukturModal('{{ asset('storage/' . $profile->struktur_organisasi) }}')"
                            class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-emerald-50 hover:bg-emerald-100 text-emerald-700 font-bold text-xs transition-colors">
                        <i class="ti ti-zoom-in text-sm"></i>
                        <span>Perbesar Bagan</span>
                    </button>
                @endif
            </div>
            @if($profile->struktur_organisasi)
                <div class="rounded-2xl overflow-hidden border border-slate-100 bg-slate-50 relative group cursor-pointer"
                     onclick="openStrukturModal('{{ asset('storage/' . $profile->struktur_organisasi) }}')">
                    <img src="{{ asset('storage/' . $profile->struktur_organisasi) }}" 
                         alt="Bagan Struktur Organisasi Desa {{ $profile->nama_desa }}" 
                         class="w-full max-h-[500px] object-contain mx-auto">
                    <div class="absolute inset-0 bg-emerald-950/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white gap-2 font-bold text-xs backdrop-blur-[2px]">
                        <i class="ti ti-zoom-in text-2xl"></i>
                        <span>Klik untuk Memperbesar Gambar</span>
                    </div>
                </div>
            @else
                <!-- Bagan Representatif Default HCD -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 text-xs">
                    <div class="bg-emerald-50/80 p-4 rounded-2xl border border-emerald-200 text-center sm:col-span-2 md:col-span-3 max-w-xs mx-auto w-full">
                        <div class="w-10 h-10 rounded-xl bg-emerald-600 text-white flex items-center justify-center text-lg mx-auto mb-2 shadow-sm">
                            <i class="ti ti-crown"></i>
                        </div>
                        <span class="block font-extrabold text-slate-800 text-sm">{{ $profile->nama_kepala_desa ?: 'Kepala Desa' }}</span>
                        <span class="text-slate-500 text-[11px]">{{ $profile->nama_kepala_desa ? 'Kepala Desa ' . $profile->nama_desa : 'Pimpinan Pemerintah Desa' }}</span>
                    </div>
                    <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100 text-center">
                        <div class="w-8 h-8 rounded-xl bg-teal-100 text-teal-700 flex items-center justify-center text-base mx-auto mb-2">
                            <i class="ti ti-briefcase"></i>
                        </div>
                        <span class="block font-bold text-slate-800">Sekretaris Desa</span>
                        <span class="text-slate-400 text-[10px]">Administrasi & Pelayanan</span>
                    </div>
                    <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100 text-center">
                        <div class="w-8 h-8 rounded-xl bg-teal-100 text-teal-700 flex items-center justify-center text-base mx-auto mb-2">
                            <i class="ti ti-coins"></i>
                        </div>
                        <span class="block font-bold text-slate-800">Kaur Keuangan</span>
                        <span class="text-slate-400 text-[10px]">Pengelolaan Anggaran Desa</span>
                    </div>
                    <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100 text-center">
                        <div class="w-8 h-8 rounded-xl bg-teal-100 text-teal-700 flex items-center justify-center text-base mx-auto mb-2">
                            <i class="ti ti-file-text"></i>
                        </div>
                        <span class="block font-bold text-slate-800">Kasi Pelayanan & Kesra</span>
                        <span class="text-slate-400 text-[10px]">Layanan Masyarakat & Surat</span>
                    </div>
                </div>
            @endif
        </div>
        <!-- Alamat Kantor & Peta Lokasi Wilayah -->
        <div class="bg-white rounded-3xl border border-slate-100 shadow-lg shadow-slate-200/40 p-8">
            <div class="flex items-center justify-between gap-4 mb-6 flex-wrap">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-700 flex items-center justify-center text-lg">
                        <i class="ti ti-map-pin"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-slate-800 tracking-tight">Lokasi Kantor Balai Desa</h2>
                        <p class="text-xs text-slate-400 mt-0.5">{{ $profile->alamat_kantor ?: 'Balai Desa ' . $profile->nama_desa }}</p>
                    </div>
                </div>
                @php
                    $mapsQuery = ($profile->alamat_kantor ?: '') . ' ' . $profile->nama_desa . ' ' . ($profile->kecamatan ?: '') . ' ' . ($profile->kabupaten ?: '');
                    $directMapsUrl = "https://www.google.com/maps/search/?api=1&query=" . urlencode($mapsQuery);
                    $embedMapSrc = $profile->peta_embed ?: "https://maps.google.com/maps?q=" . urlencode($mapsQuery) . "&t=&z=15&ie=UTF8&iwloc=&output=embed";
                @endphp
                <a href="{{ $directMapsUrl }}" target="_blank" rel="noopener noreferrer"
                   class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-indigo-50 hover:bg-indigo-100 text-indigo-700 font-bold text-xs transition-colors shadow-sm">
                    <i class="ti ti-brand-google-maps text-base"></i>
                    <span>Buka di Google Maps</span>
                </a>
            </div>
            <div class="rounded-2xl overflow-hidden border border-slate-200 shadow-inner h-80 bg-slate-100 relative">
                <iframe src="{{ $embedMapSrc }}" 
                        class="w-full h-full border-0" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
            <div class="mt-4 flex flex-wrap items-center justify-between gap-3 text-xs text-slate-500 bg-slate-50 p-4 rounded-2xl border border-slate-100">
                <div class="flex items-center gap-2">
                    <i class="ti ti-building-community text-emerald-600 text-base"></i>
                    <span>{{ $profile->alamat_kantor ?: 'Kec. ' . $profile->kecamatan . ', Kab. ' . $profile->kabupaten . ', ' . $profile->provinsi }}</span>
                </div>
                <div class="font-semibold text-slate-700 flex items-center gap-1.5">
                    <i class="ti ti-ruler-measure text-emerald-600"></i>
                    <span>Luas Wilayah: {{ $profile->luas_wilayah ? $profile->luas_wilayah : '-' }}</span>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Lightbox Modal untuk Bagan Struktur -->
<div id="modal-struktur" class="fixed inset-0 z-50 bg-slate-950/80 backdrop-blur-md hidden items-center justify-center p-4 transition-all duration-300">
    <div class="relative max-w-5xl w-full bg-white rounded-3xl overflow-hidden shadow-2xl p-4 flex flex-col max-h-[90vh]">
        <div class="flex items-center justify-between pb-3 border-b border-slate-100 px-2">
            <h3 class="font-extrabold text-slate-800 text-sm flex items-center gap-2">
                <i class="ti ti-users-group text-emerald-600"></i>
                <span>Bagan Struktur Organisasi Desa {{ $profile->nama_desa }}</span>
            </h3>
            <button type="button" onclick="closeStrukturModal()" class="w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-600 flex items-center justify-center text-lg transition-colors">
                <i class="ti ti-x"></i>
            </button>
        </div>
        <div class="flex-grow overflow-auto p-4 flex items-center justify-center bg-slate-50 rounded-2xl mt-3">
            <img id="modal-struktur-img" src="" alt="Bagan Struktur Organisasi" class="max-w-full max-h-[70vh] object-contain rounded-xl shadow-sm">
        </div>
    </div>
</div>
<script>
    function openStrukturModal(imgUrl) {
        document.getElementById('modal-struktur-img').src = imgUrl;
        const modal = document.getElementById('modal-struktur');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
    function closeStrukturModal() {
        const modal = document.getElementById('modal-struktur');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>
@endsection