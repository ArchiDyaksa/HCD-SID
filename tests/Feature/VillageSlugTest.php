<?php

namespace Tests\Feature;

use App\Models\DesaProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VillageSlugTest extends TestCase
{
    use RefreshDatabase;

    public function test_accessing_old_village_slug_redirects_to_current_slug(): void
    {
        $profile = DesaProfile::current();
        $profile->update([
            'nama_desa' => 'Desa Sukamaju Baru',
            'slug' => 'desa-sukamaju-baru',
        ]);

        // Accessing using old/invalid slug
        $response = $this->get('/desa-lama/berita');

        // Should 301 redirect to the new active village slug
        $response->assertStatus(301);
        $response->assertRedirect('/desa-sukamaju-baru/berita');
    }
}
