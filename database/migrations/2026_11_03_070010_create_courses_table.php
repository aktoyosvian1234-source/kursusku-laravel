<?php

namespace Tests\Feature;

use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CourseTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
    }

    public function test_halaman_daftar_kursus_bisa_dibuka(): void
    {
        $response = $this->get('/courses');

        $response->assertStatus(200);
    }

    public function test_data_kursus_valid_bisa_disimpan(): void
    {
        $response = $this->post('/courses', [
            'name' => 'Laravel Dasar',
            // isi kolom lain sesuai form kamu
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('courses', ['name' => 'Laravel Dasar']);
    }

    public function test_validasi_menolak_data_kosong(): void
    {
        $response = $this->post('/courses', []);

        $response->assertSessionHasErrors();
        $this->assertDatabaseCount('courses', 0);
    }
}