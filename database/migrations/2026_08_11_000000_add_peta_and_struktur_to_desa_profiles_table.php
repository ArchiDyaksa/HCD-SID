<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('desa_profiles', function (Blueprint $table) {
            $table->text('peta_embed')->nullable()->after('alamat_kantor');
            $table->string('struktur_organisasi')->nullable()->after('logo');
        });
    }

    public function down(): void
    {
        Schema::table('desa_profiles', function (Blueprint $table) {
            $table->dropColumn(['peta_embed', 'struktur_organisasi']);
        });
    }
};
