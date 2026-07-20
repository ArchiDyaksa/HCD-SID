<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('surats', function (Blueprint $table) {
            $table->id();
            $table->string('kode_tracking', 20)->unique();
            $table->string('nomor_surat')->nullable();
            $table->foreignId('jenis_surat_id')->constrained('jenis_surats');
            $table->foreignId('penduduk_id')->nullable()->constrained('penduduks')->nullOnDelete();
            $table->string('nama_pemohon');
            $table->string('nik_pemohon', 16);
            $table->string('no_hp')->nullable();
            $table->text('keperluan');
            $table->enum('status', ['diajukan', 'diproses', 'disetujui', 'ditolak', 'selesai'])->default('diajukan');
            $table->text('catatan_admin')->nullable();
            $table->timestamp('tanggal_pengajuan')->useCurrent();
            $table->timestamp('tanggal_selesai')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surats');
    }
};
