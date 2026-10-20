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
        Schema::create('sesi_presensi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pertemuan_id')
                  ->constrained('pertemuan')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();

            $table->string('kode_qr', 100)->unique();

            $table->dateTime('waktu_mulai');
            $table->dateTime('waktu_selesai');

            $table->enum('status', [
                'aktif',
                'selesai'
            ])->default('aktif');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sesi_presensi');
    }
};
