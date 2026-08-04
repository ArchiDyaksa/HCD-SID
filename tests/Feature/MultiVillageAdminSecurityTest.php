<?php

namespace Tests\Feature;

use App\Models\Berita;
use App\Models\DesaProfile;
use App\Models\Penduduk;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MultiVillageAdminSecurityTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_of_village_a_can_access_village_a_dashboard(): void
    {
        $desaA = DesaProfile::create([
            'nama_desa' => 'Desa Sukamaju',
            'slug' => 'desa-sukamaju',
        ]);

        $adminA = User::create([
            'name' => 'Admin Sukamaju',
            'email' => 'admin.sukamaju@test.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'desa_profile_id' => $desaA->id,
        ]);

        $response = $this->actingAs($adminA)->get('/desa-sukamaju/admin/dashboard');

        $response->assertStatus(200);
    }

    public function test_admin_of_village_a_is_blocked_when_accessing_village_b_admin(): void
    {
        $desaA = DesaProfile::create([
            'nama_desa' => 'Desa Sukamaju',
            'slug' => 'desa-sukamaju',
        ]);

        $desaB = DesaProfile::create([
            'nama_desa' => 'Desa Sumbermakmur',
            'slug' => 'desa-sumbermakmur',
        ]);

        $adminA = User::create([
            'name' => 'Admin Sukamaju',
            'email' => 'admin.sukamaju@test.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'desa_profile_id' => $desaA->id,
        ]);

        // Admin A trying to access Desa B admin dashboard
        $response = $this->actingAs($adminA)->get('/desa-sumbermakmur/admin/dashboard');

        // Must be blocked with 403 Forbidden
        $response->assertStatus(403);
    }

    public function test_data_is_strictly_isolated_between_villages(): void
    {
        $desaA = DesaProfile::create([
            'nama_desa' => 'Desa Sukamaju',
            'slug' => 'desa-sukamaju',
        ]);

        $desaB = DesaProfile::create([
            'nama_desa' => 'Desa Sumbermakmur',
            'slug' => 'desa-sumbermakmur',
        ]);

        $adminA = User::create([
            'name' => 'Admin Sukamaju',
            'email' => 'admin.a@test.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'desa_profile_id' => $desaA->id,
        ]);

        // Create Penduduk for Desa A & Desa B
        $pendudukA = Penduduk::create([
            'desa_profile_id' => $desaA->id,
            'nik' => '1111111111111111',
            'nama' => 'Warga Desa A',
            'jenis_kelamin' => 'L',
        ]);

        $pendudukB = Penduduk::create([
            'desa_profile_id' => $desaB->id,
            'nik' => '2222222222222222',
            'nama' => 'Warga Desa B',
            'jenis_kelamin' => 'L',
        ]);

        // When accessing Desa A admin route, only Desa A residents should be fetched
        DesaProfile::setCurrent($desaA);
        $this->actingAs($adminA);

        $this->assertCount(1, Penduduk::all());
        $this->assertEquals('Warga Desa A', Penduduk::first()->nama);

        // When accessing Desa B route context
        DesaProfile::setCurrent($desaB);
        $this->assertCount(1, Penduduk::all());
        $this->assertEquals('Warga Desa B', Penduduk::first()->nama);
    }
}
