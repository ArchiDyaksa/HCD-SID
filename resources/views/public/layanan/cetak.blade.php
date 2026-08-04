<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Surat - {{ $surat->jenisSurat->nama_surat }} - {{ $surat->kode_tracking }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Times+New+Roman&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Times New Roman', Times, serif; background: #f8fafc; }
        @media print {
            .no-print { display: none !important; }
            body { background: white; }
            .print-container { border: none !important; shadow: none !important; margin: 0 !important; padding: 0 !important; width: 100% !important; }
        }
    </style>
</head>
<body class="p-4 md:p-10">

    <!-- Action Bar (No Print) -->
    <div class="no-print max-w-4xl mx-auto mb-6 flex justify-between items-center bg-slate-900 text-white p-4 rounded-2xl shadow-lg font-sans text-xs font-bold">
        <a href="{{ route('layanan.cek-status') }}" class="hover:text-emerald-400 flex items-center gap-1">
            &larr; Kembali ke Pelacakan Status
        </a>
        <div class="flex items-center gap-3">
            <button onclick="window.print()" class="bg-emerald-600 hover:bg-emerald-500 text-white px-5 py-2 rounded-xl transition flex items-center gap-2">
                <span>Cetak / Simpan PDF</span>
            </button>
        </div>
    </div>

    <!-- Letter Container -->
    @php
        $cleanKabupaten = trim(preg_replace('/^(kabupaten|kab\.)\s+/i', '', $profile->kabupaten ?? ''));
        $cleanKecamatan = trim(preg_replace('/^(kecamatan|kec\.)\s+/i', '', $profile->kecamatan ?? ''));
    @endphp
    <div class="print-container max-w-3xl mx-auto bg-white border border-slate-200 shadow-2xl p-8 md:p-16 text-slate-900 text-sm leading-relaxed">
        <!-- Kop Surat -->
        <div class="border-b-4 border-double border-slate-900 pb-4 mb-6 text-center">
            <h3 class="text-base font-bold uppercase tracking-wider">PEMERINTAH KABUPATEN {{ strtoupper($cleanKabupaten) }}</h3>
            <h4 class="text-sm font-bold uppercase tracking-wider">KECAMATAN {{ strtoupper($cleanKecamatan) }}</h4>
            <h2 class="text-xl md:text-2xl font-extrabold uppercase tracking-widest mt-1">{{ strtoupper($profile->nama_desa) }}</h2>
            <p class="text-xs font-normal italic mt-1 text-slate-600">{{ $profile->alamat_kantor }} &bull; Telp: {{ $profile->no_telp }} &bull; Email: {{ $profile->email }}</p>
        </div>

        <!-- Title & Number -->
        <div class="text-center mb-8">
            <h1 class="text-lg font-bold uppercase underline tracking-wide">{{ strtoupper($surat->jenisSurat->nama_surat) }}</h1>
            <p class="text-xs font-bold mt-1">Nomor: {{ $surat->nomor_surat ?: '470 / '.substr($surat->kode_tracking, 4).' / '.date('Y') }}</p>
        </div>

        <!-- Body Content -->
        <p class="mb-4 text-justify indent-8">
            Yang bertanda tangan di bawah ini Kepala Desa {{ $profile->nama_desa }}, Kecamatan {{ $cleanKecamatan }}, Kabupaten {{ $cleanKabupaten }}, menerangkan dengan sebenarnya bahwa:
        </p>

        <table class="w-full my-4 ml-6 text-sm">
            <tr class="py-1">
                <td class="w-44 py-1 font-semibold">Nama Lengkap</td>
                <td class="w-4">:</td>
                <td class="py-1 font-bold">{{ strtoupper($surat->nama_pemohon) }}</td>
            </tr>
            <tr class="py-1">
                <td class="py-1 font-semibold">NIK (Nomor Induk)</td>
                <td class="w-4">:</td>
                <td class="py-1 font-mono font-bold">{{ $surat->nik_pemohon }}</td>
            </tr>
            <tr class="py-1">
                <td class="py-1 font-semibold">No. Telepon / WA</td>
                <td class="w-4">:</td>
                <td class="py-1">{{ $surat->no_hp ?: '-' }}</td>
            </tr>
            <tr class="py-1">
                <td class="py-1 font-semibold">Maksud / Keperluan</td>
                <td class="w-4">:</td>
                <td class="py-1 font-bold text-slate-800">{{ $surat->keperluan }}</td>
            </tr>
            <tr class="py-1">
                <td class="py-1 font-semibold">Kode Pelacakan</td>
                <td class="w-4">:</td>
                <td class="py-1 font-mono font-bold text-emerald-800">{{ $surat->kode_tracking }}</td>
            </tr>
        </table>

        <p class="mb-4 text-justify indent-8">
            Orang tersebut di atas adalah benar-benar warga penduduk Desa {{ $profile->nama_desa }} yang berkelakuan baik. Surat keterangan ini diberikan kepada yang bersangkutan untuk dipergunakan sebagaimana mestinya.
        </p>

        <p class="mb-10 text-justify indent-8">
            Demikian surat keterangan ini dibuat dengan sebenarnya untuk dapat dipergunakan sebagaimana mestinya.
        </p>

        <!-- Signature Footer -->
        <div class="flex justify-end mt-12 text-center">
            <div class="w-64">
                <p class="text-xs">{{ $profile->nama_desa }}, {{ $surat->updated_at->translatedFormat('d F Y') }}</p>
                <p class="text-xs font-bold uppercase mt-1">Kepala Desa {{ $profile->nama_desa }}</p>
                
                <div class="h-24 flex items-center justify-center relative my-2">
                    <div class="border border-dashed border-emerald-400 text-emerald-600 font-sans text-[10px] p-2 rounded-xl bg-emerald-50/50">
                        [ STEMPEL & TANDA TANGAN RESMI PEMDES ]
                    </div>
                </div>

                <p class="font-bold underline uppercase text-sm">BUDI SANTOSO</p>
                <p class="text-xs text-slate-500">NIP. 19780512 200501 1 003</p>
            </div>
        </div>
    </div>

</body>
</html>
