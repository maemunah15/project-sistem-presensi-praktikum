<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminDashboardTest extends TestCase
{
    use RefreshDatabase;
    public function test_guest_is_redirected_to_login(): void
    {
        $response = $this->get('/admin/dashboard');
        $response->assertRedirect('/login');
    }

    public function test_admin_can_access_dashboard_and_view_all_sections(): void
    {
        $admin = User::create([
            'nip_nim' => '1001',
            'nama' => 'Admin Lab',
            'email' => 'admin@uin.ac.id',
            'password' => bcrypt('password123'),
            'role' => 'admin',
            'status' => true,
        ]);

        $response = $this->actingAs($admin)->get('/admin/dashboard');

        $response->assertStatus(200);
        $response->assertSee('Data Master');
        $response->assertSee('Manajemen Akademik');
        $response->assertSee('Penugasan & Mapping', false);
        $response->assertSee('Rekap & Laporan Master', false);
        $response->assertSee('UIN Siber Syekh Nurjati');
    }

    public function test_admin_users_pages_contain_sidebar(): void
    {
        $admin = User::create([
            'nip_nim' => '1001',
            'nama' => 'Admin Lab',
            'email' => 'admin@uin.ac.id',
            'password' => bcrypt('password123'),
            'role' => 'admin',
            'status' => true,
        ]);

        // 1. Index page
        $resIndex = $this->actingAs($admin)->get('/admin/users');
        $resIndex->assertStatus(200);
        $resIndex->assertSee('Presensi Praktikum');
        $resIndex->assertSee('UIN Siber Syekh Nurjati');
        $resIndex->assertSee('Kelola Akun Pengguna');

        // 2. Create page
        $resCreate = $this->actingAs($admin)->get('/admin/users/create');
        $resCreate->assertStatus(200);
        $resCreate->assertSee('Presensi Praktikum');
        $resCreate->assertSee('UIN Siber Syekh Nurjati');
        $resCreate->assertSee('Tambah User Baru');

        // 3. Edit page
        $resEdit = $this->actingAs($admin)->get("/admin/users/{$admin->id}/edit");
        $resEdit->assertStatus(200);
        $resEdit->assertSee('Presensi Praktikum');
        $resEdit->assertSee('UIN Siber Syekh Nurjati');
        $resEdit->assertSee('Perbarui Informasi Akun');
    }

    public function test_akademik_penugasan_and_laporan_pages_accessible(): void
    {
        $admin = User::create([
            'nip_nim' => '1001',
            'nama' => 'Admin Lab',
            'email' => 'admin@uin.ac.id',
            'password' => bcrypt('password123'),
            'role' => 'admin',
            'status' => true,
        ]);

        // Akademik page
        $resAkademik = $this->actingAs($admin)->get('/admin/akademik');
        $resAkademik->assertStatus(200);
        $resAkademik->assertSee('Manajemen Akademik');
        $resAkademik->assertSee('Tahun Ajaran & Semester', false);
        $resAkademik->assertSee('Aturan Presensi');

        // Penugasan page
        $resPenugasan = $this->actingAs($admin)->get('/admin/penugasan');
        $resPenugasan->assertStatus(200);
        $resPenugasan->assertSee('Penugasan & Mapping Kelas', false);
        $resPenugasan->assertSee('Daftar Kelas Praktikum');

        // Laporan page
        $resLaporan = $this->actingAs($admin)->get('/admin/laporan');
        $resLaporan->assertStatus(200);
        $resLaporan->assertSee('Rekap & Laporan Master', false);
        $resLaporan->assertSee('Ekspor Excel');
        $resLaporan->assertSee('Ekspor PDF');
    }

    public function test_login_page_has_uin_ssc_branding(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('UIN Siber Syekh Nurjati Cirebon');
        $response->assertSee('Presensi Praktikum');
        $response->assertSee('Masuk ke Sistem');
    }
}
