<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('presensi', function (Blueprint $table) {
            $table->id();

            // Relasi ke tabel sesi_presensi
            $table->foreignId('sesi_presensi_id')
                  ->constrained('sesi_presensi')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();

            // Relasi ke tabel users (mahasiswa)
            $table->foreignId('mahasiswa_id')
                  ->constrained('users')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();

            // Catatan waktu presensi
            $table->dateTime('waktu_presensi');

            // Status Kehadiran
            $table->enum('status', [
                'hadir',
                'izin',
                'sakit',
                'alpa'
            ])->default('hadir');

            // Keterangan opsional (misal: "Surat sakit terlampir")
            $table->text('keterangan')->nullable();

            $table->timestamps();

            // Mencegah mahasiswa presensi ganda di sesi yang sama
            $table->unique(['sesi_presensi_id', 'mahasiswa_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presensi');
    }
};