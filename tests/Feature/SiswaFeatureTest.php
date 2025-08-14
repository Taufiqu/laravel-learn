<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User; // <-- Pastikan ini di-import

class SiswaFeatureTest extends TestCase
{
    use RefreshDatabase; // Trait untuk mereset database setelah setiap tes

    /**
     * Tes untuk memastikan tamu tidak bisa melihat halaman daftar siswa.
     *
     * @return void
     */
    public function test_tamu_tidak_bisa_melihat_halaman_daftar_siswa(): void
    {
        $response = $this->get('/siswa');

        $response->assertRedirect('/login');
    }

    /**
     * Tes untuk memastikan admin bisa melihat halaman daftar siswa.
     *
     * @return void
     */
    public function test_admin_bisa_melihat_halaman_daftar_siswa(): void
    {
        // 1. Persiapan (Arrange)
        $admin = User::factory()->create(['role' => 'admin']);

        // 2. Aksi (Act)
        $response = $this->actingAs($admin)->get('/siswa');

        // 3. Pengecekan (Assert)
        $response->assertStatus(200);
        $response->assertViewIs('siswa.index');
        $response->assertSee('Manajemen Data Siswa');
    }
}