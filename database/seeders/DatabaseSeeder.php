<?php

namespace Database\Seeders;

use App\Models\DesaProfile;
use App\Models\Galeri;
use App\Models\JenisSurat;
use App\Models\Kegiatan;
use App\Models\KontakPenting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $kalakijo = DesaProfile::firstOrCreate(
            ['slug' => 'kalakijo'],
            [
                'nama_desa' => 'Kalakijo',
                'kecamatan' => 'Triharjo',
                'kabupaten' => 'Sleman',
                'provinsi' => 'Daerah Istimewa Yogyakarta',
            ]
        );

        $jongke = DesaProfile::firstOrCreate(
            ['slug' => 'jongke'],
            [
                'nama_desa' => 'Jongke',
                'kecamatan' => 'Sendangadi',
                'kabupaten' => 'Sleman',
                'provinsi' => 'Daerah Istimewa Yogyakarta',
            ]
        );

        User::firstOrCreate(
            ['email' => 'admin.kalakijo@desa.id'],
            [
                'name' => 'Admin Desa Kalakijo',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'desa_profile_id' => $kalakijo->id,
            ]
        );

        User::firstOrCreate(
            ['email' => 'admin.jongke@desa.id'],
            [
                'name' => 'Admin Desa Jongke',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'desa_profile_id' => $jongke->id,
            ]
        );

        DesaProfile::firstOrCreate(
            ['id' => 1],
            [
                'nama_desa' => 'Desa Sukamaju',
                'kecamatan' => 'Kecamatan Cerdas',
                'kabupaten' => 'Kabupaten Sejahtera',
                'provinsi' => 'Jawa Tengah',
                'sejarah' => 'Desa Sukamaju didirikan sejak tahun 1965 dengan komitmen luhur membangun kemandirian warga berbasis gotong-royong dan inovasi.',
                'visi' => 'Mewujudkan desa digital yang transparan, mandiri, dan sejahtera.',
                'misi' => "Meningkatkan pelayanan publik berbasis digital\nMemberdayakan potensi ekonomi warga\nMenjaga kelestarian lingkungan desa",
                'luas_wilayah' => '12.5 km²',
                'alamat_kantor' => 'Jl. Raya Utama Desa Sukamaju No. 01',
                'no_telp' => '0812-3456-7890',
                'email' => 'kontak@desasukamaju.id',
            ]
        );

        $jenisSurat = [
            ['kode' => 'SKD', 'nama_surat' => 'Surat Keterangan Domisili', 'deskripsi' => 'Surat keterangan resmi tempat tinggal warga di wilayah desa.', 'persyaratan' => "Fotokopi KTP\nFotokopi KK"],
            ['kode' => 'SKTM', 'nama_surat' => 'Surat Keterangan Tidak Mampu', 'deskripsi' => 'Persyaratan pengurusan bantuan sosial, beasiswa sekolah, atau pengobatan gratis.', 'persyaratan' => "Fotokopi KTP\nFotokopi KK\nSurat pengantar RT/RW"],
            ['kode' => 'SKU', 'nama_surat' => 'Surat Keterangan Usaha', 'deskripsi' => 'Pengajuan keterangan resmi untuk UMKM dan perizinan perbankan.', 'persyaratan' => "Fotokopi KTP\nFoto tempat lokasi usaha"],
            ['kode' => 'SKL', 'nama_surat' => 'Surat Keterangan Kelahiran', 'deskripsi' => 'Surat pengantar kelahiran untuk pembuatan Akta Kelahiran anak.', 'persyaratan' => "Fotokopi KK\nSurat keterangan dari Bidan/Puskesmas"],
            ['kode' => 'SPKTP', 'nama_surat' => 'Surat Pengantar KTP / KK', 'deskripsi' => 'Pengantar administratif resmi untuk penerbitan KTP-el atau perubahan Kartu Keluarga.', 'persyaratan' => "Fotokopi KK Lama\nSurat pengantar RT/RW"],
            ['kode' => 'SPN', 'nama_surat' => 'Surat Pengantar Nikah (N1-N4)', 'deskripsi' => 'Pengantar administratif resmi untuk pengurusan pernikahan di KUA atau Catatan Sipil.', 'persyaratan' => "Fotokopi KTP & KK Pemohon\nFotokopi Akta Kelahiran\nPasfoto 3x4 (2 lembar)"],
            ['kode' => 'ADM', 'nama_surat' => 'Dokumen Administrasi Umum', 'deskripsi' => 'Pengurusan dokumen administrasi kemasyarakatan dan permohonan umum lainnya.', 'persyaratan' => "Fotokopi KTP\nFotokopi KK"],
        ];

        foreach ($jenisSurat as $item) {
            JenisSurat::firstOrCreate(['kode' => $item['kode']], $item + ['aktif' => true]);
        }

        // Seed Agenda Kegiatan
        $kegiatans = [
            [
                'nama_kegiatan' => 'Musyawarah Perencanaan Pembangunan Desa (Musrenbangdes)',
                'tanggal' => now()->addDays(3)->format('Y-m-d'),
                'waktu' => '09:00 - 12:00 WIB',
                'lokasi' => 'Balai Pertemuan Desa Sukamaju',
                'deskripsi' => 'Pembahasan Rencana Kerja Pemerintah Desa tahun anggaran mendatang bersama seluruh elemen masyarakat.',
                'penyelenggara' => 'Pemerintah Desa',
            ],
            [
                'nama_kegiatan' => 'Gotong Royong Bersih Lingkungan & Posyandu Lansia',
                'tanggal' => now()->addDays(7)->format('Y-m-d'),
                'waktu' => '07:00 - 10:00 WIB',
                'lokasi' => 'Area RW 02 & Poskesdes',
                'deskripsi' => 'Kerja bakti pembersihan saluran air desa dilanjutkan cek kesehatan gratis lansia.',
                'penyelenggara' => 'Karang Taruna & PKK',
            ],
        ];

        foreach ($kegiatans as $k) {
            Kegiatan::firstOrCreate(['nama_kegiatan' => $k['nama_kegiatan']], $k);
        }

        // Seed Kontak Penting
        $kontaks = [
            ['kategori' => 'Layanan Darurat', 'nama' => 'Puskesmas Sukamaju (24 Jam)', 'jabatan_peran' => 'UGD & Ambulans Desa', 'no_telp' => '0811-9999-8888', 'alamat' => 'Jl. Kesehatan No. 12'],
            ['kategori' => 'Layanan Darurat', 'nama' => 'Polsek Sektor Desa', 'jabatan_peran' => 'Keamanan & SPKT', 'no_telp' => '0812-1111-2222', 'alamat' => 'Jl. Bhayangkara No. 05'],
            ['kategori' => 'Perangkat Desa', 'nama' => 'Bapak Budi Santoso (Kepala Desa)', 'jabatan_peran' => 'Kepala Desa', 'no_telp' => '0812-3456-7890', 'alamat' => 'Kantor Desa Sukamaju'],
            ['kategori' => 'Perangkat Desa', 'nama' => 'Ibu Siti Rahma (Sekretaris Desa)', 'jabatan_peran' => 'Sekretaris Desa', 'no_telp' => '0813-9876-5432', 'alamat' => 'Kantor Desa Sukamaju'],
        ];

        foreach ($kontaks as $kt) {
            KontakPenting::firstOrCreate(['nama' => $kt['nama']], $kt);
        }

        // Seed Galeri Foto
        $galeris = [
            ['judul' => 'Peresmian Balai Pertemuan Desa & Portal Digital', 'kategori' => 'Pembangunan', 'tanggal' => now()->subDays(10)->format('Y-m-d'), 'deskripsi' => 'Peresmian fasilitas umum dan peluncuran layanan online warga.'],
            ['judul' => 'Pelatihan UMKM dan Digital Marketing Warga', 'kategori' => 'Pemberdayaan', 'tanggal' => now()->subDays(20)->format('Y-m-d'), 'deskripsi' => 'Pelatihan pemasaran online untuk pelaku usaha mikro desa.'],
        ];

        foreach ($galeris as $g) {
            Galeri::firstOrCreate(['judul' => $g['judul']], $g);
        }
    }
}
