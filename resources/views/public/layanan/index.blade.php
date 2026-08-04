@extends('layouts.public')

@section('title', 'Layanan Surat')

@section('content')
<!-- Header Section -->
<section class="relative bg-gradient-to-br from-emerald-950 via-teal-900 to-slate-900 text-white py-16 px-6 overflow-hidden">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_30%,rgba(16,185,129,0.15),transparent_50%)]"></div>
    <div class="max-w-6xl mx-auto relative z-10 text-center">
        <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 text-xs font-extrabold uppercase tracking-widest mb-4">
            <i class="ti ti-file-text"></i> Layanan Online Warga
        </span>
        <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight">Layanan Mandiri Pengajuan Surat</h1>
        <p class="text-slate-300 text-sm md:text-base max-w-2xl mx-auto mt-3">Buat permohonan surat administrasi desa secara daring, cepat, dan transparan.</p>
    </div>
</section>

<section class="max-w-5xl mx-auto px-6 py-12">
    @if ($errors->any())
        <div class="mb-8 p-4 rounded-2xl bg-red-50 border border-red-200 text-red-700 text-sm flex items-start gap-3">
            <i class="ti ti-alert-circle text-xl mt-0.5"></i>
            <div>
                <span class="font-bold">Terjadi kesalahan pada pengajuan surat:</span>
                <ul class="list-disc list-inside mt-1 text-xs space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
        @foreach ($jenisSurats as $jenis)
        <div class="bg-white rounded-3xl border border-slate-100 shadow-lg shadow-slate-200/40 p-8 flex flex-col hover:border-emerald-200 transition-colors duration-300 group">
            @php
                $catLabel = 'Surat Keterangan';
                $catColor = 'bg-emerald-50 text-emerald-700 border-emerald-100';
                if (\Illuminate\Support\Str::contains(strtolower($jenis->nama_surat), 'pengantar')) {
                    $catLabel = 'Surat Pengantar';
                    $catColor = 'bg-blue-50 text-blue-700 border-blue-100';
                } elseif (\Illuminate\Support\Str::contains(strtolower($jenis->nama_surat), 'dokumen') || \Illuminate\Support\Str::contains(strtolower($jenis->nama_surat), 'administrasi')) {
                    $catLabel = 'Dokumen Administrasi';
                    $catColor = 'bg-purple-50 text-purple-700 border-purple-100';
                }
            @endphp
            <div class="mb-4">
                <span class="px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-wider border {{ $catColor }}">{{ $catLabel }}</span>
            </div>
            <div class="flex items-center gap-3.5 mb-4">
                <div class="w-12 h-12 rounded-xl bg-slate-100 text-slate-700 flex items-center justify-center text-xl group-hover:scale-105 transition-transform">
                    <i class="ti ti-file-text"></i>
                </div>
                <h2 class="font-extrabold text-slate-800 text-lg leading-tight">{{ $jenis->nama_surat }}</h2>
            </div>
            
            <p class="text-slate-400 text-xs leading-relaxed mb-6 flex-grow">{{ $jenis->deskripsi }}</p>

            @if ($jenis->persyaratan)
            <div class="mb-6 bg-slate-50 p-5 rounded-2xl border border-slate-100">
                <div class="text-xs font-bold text-slate-700 uppercase tracking-wider mb-2 flex items-center gap-1.5">
                    <i class="ti ti-clipboard-list text-emerald-600"></i> Persyaratan Dokumen
                </div>
                <ul class="text-xs text-slate-500 space-y-2">
                    @foreach ($jenis->persyaratan_array as $syarat)
                        <li class="flex items-start gap-2">
                            <i class="ti ti-check text-emerald-600 mt-0.5"></i>
                            <span>{{ $syarat }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
            @endif

            <button type="button"
                    onclick="openAjukanModal({{ $jenis->id }}, '{{ addslashes($jenis->nama_surat) }}', '{{ addslashes($jenis->deskripsi) }}', {{ json_encode($jenis->persyaratan_array) }})"
                    class="w-full bg-slate-50 hover:bg-emerald-700 text-slate-700 hover:text-white font-bold py-3.5 px-5 rounded-2xl text-center text-xs flex items-center justify-center gap-2 border border-slate-200/60 hover:border-emerald-700 hover:shadow-lg hover:shadow-emerald-700/20 transition-all duration-300 cursor-pointer">
                <span>Ajukan Surat Ini</span>
                <i class="ti ti-arrow-right"></i>
            </button>
        </div>
        @endforeach
    </div>
</section>

<!-- MODAL PENGAJUAN SURAT -->
<div id="modal-ajukan-surat" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 flex items-center justify-center p-4 hidden overflow-y-auto">
    <div class="bg-white rounded-3xl border border-slate-100 shadow-2xl max-w-xl w-full p-6 md:p-8 relative my-8 animate-fadeIn space-y-6">
        <!-- Close Button -->
        <button type="button" onclick="closeAjukanModal()" class="absolute top-6 right-6 w-9 h-9 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-500 hover:text-slate-800 flex items-center justify-center transition-colors">
            <i class="ti ti-x text-lg"></i>
        </button>

        <!-- Header Modal -->
        <div class="flex items-start gap-4 pr-8">
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-2xl shrink-0">
                <i class="ti ti-file-plus"></i>
            </div>
            <div>
                <span class="text-[10px] font-extrabold uppercase tracking-wider text-emerald-600 bg-emerald-50 px-2.5 py-0.5 rounded-full border border-emerald-100 inline-block mb-1">Formulir Mandiri</span>
                <h3 id="modal-judul-surat" class="font-extrabold text-slate-800 text-xl leading-snug">Ajukan Surat</h3>
                <p id="modal-deskripsi-surat" class="text-xs text-slate-400 mt-1 leading-relaxed">Lengkapi data diri Anda untuk mengajukan permohonan surat.</p>
            </div>
        </div>

        <!-- Box Persyaratan (Dinamis) -->
        <div id="modal-box-persyaratan" class="bg-slate-50 p-4 rounded-2xl border border-slate-100 hidden">
            <div class="text-xs font-bold text-slate-700 uppercase tracking-wider mb-2 flex items-center gap-1.5">
                <i class="ti ti-clipboard-list text-emerald-600"></i> Syarat Dokumen yang Perlu Disiapkan
            </div>
            <ul id="modal-list-persyaratan" class="text-xs text-slate-500 space-y-1.5"></ul>
        </div>

        <!-- Form Pengajuan -->
        <form method="POST" action="{{ route('layanan.store') }}" class="space-y-4">
            @csrf
            <input type="hidden" name="jenis_surat_id" id="modal_jenis_surat_id" value="{{ old('jenis_surat_id') }}">

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nama Lengkap Pemohon <span class="text-red-500">*</span></label>
                <div class="relative">
                    <i class="ti ti-user absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-lg"></i>
                    <input type="text" id="modal_nama_pemohon" name="nama_pemohon" value="{{ old('nama_pemohon') }}" required
                           placeholder="Masukkan nama lengkap sesuai KTP"
                           class="w-full border border-slate-200 rounded-2xl pl-11 pr-4 py-3 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none text-sm transition-all duration-300">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">NIK Pemohon (16 Digit) <span class="text-red-500">*</span></label>
                <div class="relative">
                    <i class="ti ti-id absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-lg"></i>
                    <input type="text" id="modal_nik_pemohon" name="nik_pemohon" value="{{ old('nik_pemohon') }}" required inputmode="numeric" maxlength="16"
                           placeholder="Masukkan 16 digit NIK"
                           class="w-full border border-slate-200 rounded-2xl pl-11 pr-4 py-3 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none text-sm transition-all duration-300">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nomor HP / WhatsApp (Aktif)</label>
                <div class="relative">
                    <i class="ti ti-brand-whatsapp absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-lg"></i>
                    <input type="text" id="modal_no_hp" name="no_hp" value="{{ old('no_hp') }}"
                           placeholder="Contoh: 081234567890"
                           class="w-full border border-slate-200 rounded-2xl pl-11 pr-4 py-3 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none text-sm transition-all duration-300">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Keperluan / Keterangan <span class="text-red-500">*</span></label>
                <div class="relative">
                    <textarea id="modal_keperluan" name="keperluan" rows="3" required
                              placeholder="Tuliskan tujuan pembuatan surat secara jelas (misal: pengurusan beasiswa anak, dsb.)"
                              class="w-full border border-slate-200 rounded-2xl p-4 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none text-sm transition-all duration-300">{{ old('keperluan') }}</textarea>
                </div>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="button" onclick="closeAjukanModal()" class="w-1/3 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold py-3.5 rounded-2xl text-xs transition-colors">
                    Batal
                </button>
                <button type="submit" class="w-2/3 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-bold py-3.5 rounded-2xl text-xs shadow-lg shadow-emerald-700/20 hover:scale-[1.01] active:scale-[0.99] transition-all flex items-center justify-center gap-2">
                    <i class="ti ti-send"></i>
                    <span>Kirim Pengajuan Surat</span>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    const jenisSuratsData = @json($jenisSurats);

    function openAjukanModal(id, namaSurat, deskripsi, persyaratan) {
        document.getElementById('modal_jenis_surat_id').value = id;
        document.getElementById('modal-judul-surat').innerText = 'Ajukan ' + namaSurat;
        document.getElementById('modal-deskripsi-surat').innerText = deskripsi || 'Lengkapi data Anda untuk permohonan surat ini.';

        const boxPersyaratan = document.getElementById('modal-box-persyaratan');
        const listPersyaratan = document.getElementById('modal-list-persyaratan');
        listPersyaratan.innerHTML = '';

        if (persyaratan && persyaratan.length > 0) {
            persyaratan.forEach(syarat => {
                const li = document.createElement('li');
                li.className = 'flex items-start gap-2';
                li.innerHTML = `<i class="ti ti-check text-emerald-600 mt-0.5"></i> <span>${syarat}</span>`;
                listPersyaratan.appendChild(li);
            });
            boxPersyaratan.classList.remove('hidden');
        } else {
            boxPersyaratan.classList.add('hidden');
        }

        document.getElementById('modal-ajukan-surat').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeAjukanModal() {
        document.getElementById('modal-ajukan-surat').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Auto-open modal jika ada error validasi atau parameter query open_id
    document.addEventListener('DOMContentLoaded', function () {
        const oldJenisId = "{{ old('jenis_surat_id', request('open_id')) }}";
        if (oldJenisId) {
            const targetJenis = jenisSuratsData.find(j => j.id == oldJenisId);
            if (targetJenis) {
                openAjukanModal(targetJenis.id, targetJenis.nama_surat, targetJenis.deskripsi, targetJenis.persyaratan_array);
            }
        }
    });

    // Close modal saat menekan tombol Escape
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            closeAjukanModal();
        }
    });
</script>
@endsection
