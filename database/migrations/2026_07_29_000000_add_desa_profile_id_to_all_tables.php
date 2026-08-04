<?php

use App\Models\DesaProfile;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $defaultDesaId = DB::table('desa_profiles')->value('id');

        if (!$defaultDesaId) {
            $defaultDesaId = DB::table('desa_profiles')->insertGetId([
                'nama_desa' => 'Nama Desa',
                'slug' => 'nama-desa',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $tables = [
            'users',
            'penduduks',
            'jenis_surats',
            'surats',
            'beritas',
            'kegiatans',
            'kontak_pentings',
            'galeris',
        ];

        foreach ($tables as $tableName) {
            if (Schema::hasTable($tableName) && !Schema::hasColumn($tableName, 'desa_profile_id')) {
                Schema::table($tableName, function (Blueprint $table) {
                    $table->foreignId('desa_profile_id')
                          ->nullable()
                          ->after('id')
                          ->constrained('desa_profiles')
                          ->nullOnDelete();
                });

                DB::table($tableName)->update(['desa_profile_id' => $defaultDesaId]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tables = [
            'users',
            'penduduks',
            'jenis_surats',
            'surats',
            'beritas',
            'kegiatans',
            'kontak_pentings',
            'galeris',
        ];

        foreach ($tables as $tableName) {
            if (Schema::hasTable($tableName) && Schema::hasColumn($tableName, 'desa_profile_id')) {
                Schema::table($tableName, function (Blueprint $table) {
                    $table->dropForeign(['desa_profile_id']);
                    $table->dropColumn('desa_profile_id');
                });
            }
        }
    }
};
