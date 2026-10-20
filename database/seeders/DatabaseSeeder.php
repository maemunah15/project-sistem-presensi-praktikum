<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\MataPraktikum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Hapus user lama agar bersih
        User::query()->delete();

        // 1. ADMIN
        User::create([
            'nip_nim' => 'admin',
            'nama' => 'Administrator Lab',
            'email' => 'admin@uin.ac.id',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'status' => true,
        ]);

        // 2. DOSEN
        User::create([
            'nip_nim' => '198501012020',
            'nama' => 'Dosen Pengampu, M.Kom.',
            'email' => 'dosen@uin.ac.id',
            'password' => Hash::make('password123'),
            'role' => 'dosen',
            'status' => true,
        ]);

        // 3. ASISTEN DOSEN / ASPRAK
        User::create([
            'nip_nim' => '1227050001',
            'nama' => 'Asisten Dosen Praktikum',
            'email' => 'asprak@uin.ac.id',
            'password' => Hash::make('password123'),
            'role' => 'asprak',
            'status' => true,
        ]);

        // 4. MAHASISWA
        User::create([
            'nip_nim' => '2388010001',
            'nama' => 'Mahasiswa Praktikan',
            'email' => 'mahasiswa@uin.ac.id',
            'password' => Hash::make('password123'),
            'role' => 'mahasiswa',
            'status' => true,
        ]);

        // 7. DUMMY MATA PRAKTIKUM
        MataPraktikum::updateOrCreate(
            ['kode' => 'IF101'],
            [
                'nama' => 'Algoritma dan Pemrograman',
                'semester' => 1,
                'sks' => 3,
                'status' => true,
            ]
        );

        MataPraktikum::updateOrCreate(
            ['kode' => 'IF202'],
            [
                'nama' => 'Pemrograman Web',
                'semester' => 3,
                'sks' => 3,
                'status' => true,
            ]
        );

        // 8. DUMMY KELAS PRAKTIKUM
        $mp1 = MataPraktikum::where('kode', 'IF101')->first();
        $mp2 = MataPraktikum::where('kode', 'IF202')->first();

        $dosen = User::where('role', 'dosen')->first();
        $asprak = User::where('role', 'asprak')->first();
        $mahasiswa1 = User::where('role', 'mahasiswa')->first();

        if ($mp1) {
            $kelasA1 = \App\Models\KelasPraktikum::updateOrCreate(
                ['mata_praktikum_id' => $mp1->id, 'nama_kelas' => 'A1'],
                ['tahun_ajaran' => '2026/2027', 'semester' => 1, 'status' => true]
            );

            $kelasA2 = \App\Models\KelasPraktikum::updateOrCreate(
                ['mata_praktikum_id' => $mp1->id, 'nama_kelas' => 'A2'],
                ['tahun_ajaran' => '2026/2027', 'semester' => 1, 'status' => true]
            );

            // Jadwal A1
            \App\Models\Jadwal::updateOrCreate(
                ['kelas_id' => $kelasA1->id],
                ['hari' => 'Senin', 'jam_mulai' => '08:00:00', 'jam_selesai' => '10:30:00', 'ruang' => 'Lab Komputer 1 (Siber)']
            );

            // Jadwal A2
            \App\Models\Jadwal::updateOrCreate(
                ['kelas_id' => $kelasA2->id],
                ['hari' => 'Selasa', 'jam_mulai' => '10:30:00', 'jam_selesai' => '13:00:00', 'ruang' => 'Lab Komputer 2 (Multimedia)']
            );

            // Pengajar A1
            if ($dosen) {
                $kelasA1->pengajar()->syncWithoutDetaching([$dosen->id => ['tipe' => 'dosen']]);
                $kelasA2->pengajar()->syncWithoutDetaching([$dosen->id => ['tipe' => 'dosen']]);
            }
            if ($asprak) {
                $kelasA1->pengajar()->syncWithoutDetaching([$asprak->id => ['tipe' => 'asprak']]);
            }

            // Mahasiswa A1
            if ($mahasiswa1) {
                $kelasA1->mahasiswa()->syncWithoutDetaching([$mahasiswa1->id => ['tanggal_daftar' => now()]]);
            }
        }

        if ($mp2) {
            $kelasB1 = \App\Models\KelasPraktikum::updateOrCreate(
                ['mata_praktikum_id' => $mp2->id, 'nama_kelas' => 'B1'],
                ['tahun_ajaran' => '2026/2027', 'semester' => 3, 'status' => true]
            );

            \App\Models\Jadwal::updateOrCreate(
                ['kelas_id' => $kelasB1->id],
                ['hari' => 'Rabu', 'jam_mulai' => '13:00:00', 'jam_selesai' => '15:30:00', 'ruang' => 'Lab Riset Cyber & IoT']
            );

            if ($dosen) {
                $kelasB1->pengajar()->syncWithoutDetaching([$dosen->id => ['tipe' => 'dosen']]);
            }
        }
    }
}