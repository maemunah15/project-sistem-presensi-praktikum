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
        Schema::create('mahasiswa_kelas', function (Blueprint $table) {
                   $table->id();

                   $table->foreignId('kelas_id')
                          ->constrained('kelas_praktikum')
                          ->cascadeOnUpdate()
                          ->restrictOnDelete();

                    $table->foreignId('mahasiswa_id')
                          ->constrained('users')
                          ->cascadeOnUpdate()
                          ->restrictOnDelete();

                    $table->date('tanggal_daftar');
                    $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa_kelas');
    }
};
