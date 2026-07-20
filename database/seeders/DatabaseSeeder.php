<?php

namespace Database\Seeders;

use App\Models\DesaProfile;
use App\Models\JenisSurat;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@desa.id'],
            [
                'name' => 'Admin Desa',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        DesaProfile::firstOrCreate(
            ['id' => 1],
            [
                'nama_desa' => 'Desa Sukamaju',
                'kecamatan' => 'Kecamatan Contoh',
                'kabupaten' => 'Kabupaten Contoh',
                'provinsi' => 'Jawa Tengah',
                'sejarah' => 'Tuliskan sejarah desa di sini melalui panel admin.',
                'visi' => 'Mewujudkan desa yang maju, mandiri, dan sejahtera.',
                'misi' => "Meningkatkan pelayanan publik berbasis digital\nMemberdayakan potensi ekonomi warga\nMenjaga kelestarian lingkungan desa",
                'luas_wilayah' => '12.5 km²',
                'alamat_kantor' => 'Jl. Raya Desa No. 1',
                'no_telp' => '0812-0000-0000',
                'email' => 'kontak@desasukamaju.id',
            ]
        );

        $jenisSurat = [
            ['kode' => 'SKD', 'nama_surat' => 'Surat Keterangan Domisili', 'deskripsi' => 'Surat keterangan tempat tinggal warga.', 'persyaratan' => "Fotokopi KTP\nFotokopi KK"],
            ['kode' => 'SKTM', 'nama_surat' => 'Surat Keterangan Tidak Mampu', 'deskripsi' => 'Untuk keperluan bantuan sosial/pendidikan.', 'persyaratan' => "Fotokopi KTP\nFotokopi KK\nSurat pengantar RT/RW"],
            ['kode' => 'SKU', 'nama_surat' => 'Surat Keterangan Usaha', 'deskripsi' => 'Untuk keperluan perizinan usaha.', 'persyaratan' => "Fotokopi KTP\nFoto lokasi usaha"],
            ['kode' => 'SKL', 'nama_surat' => 'Surat Keterangan Kelahiran', 'deskripsi' => 'Pengantar untuk pembuatan akta kelahiran.', 'persyaratan' => "Fotokopi KK\nSurat keterangan bidan/RS"],
        ];

        foreach ($jenisSurat as $item) {
            JenisSurat::firstOrCreate(['kode' => $item['kode']], $item + ['aktif' => true]);
        }
    }
}
