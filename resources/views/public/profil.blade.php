@extends('layouts.public')

@section('title', 'Profil Desa — ' . $profile->nama_desa)

@section('content')
<!-- Header Section -->
<section class="bg-gradient-to-r from-emerald-800 to-teal-900 text-white py-16">
    <div class="max-w-4xl mx-auto px-6 text-center">
        <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight">Profil {{ $profile->nama_desa }}</h1>
        <p class="text-emerald-100 mt-2 text-sm md:text-base font-medium">
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

        <!-- Alamat Kantor -->
        <div class="bg-white rounded-3xl border border-slate-100 shadow-lg shadow-slate-200/40 p-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-700 flex items-center justify-center text-lg">
                    <i class="ti ti-building-community"></i>
                </div>
                <h2 class="text-xl font-bold text-slate-800 tracking-tight">Alamat Kantor Desa</h2>
            </div>
            <p class="text-slate-600 leading-relaxed text-sm bg-slate-50 p-5 rounded-2xl border border-slate-100">
                {{ $profile->alamat_kantor ?: 'Belum ada data.' }}
            </p>
        </div>
    </div>
</section>
@endsection

