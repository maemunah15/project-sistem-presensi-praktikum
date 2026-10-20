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
        Schema::create('kelas_praktikum', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mata_praktikum_id')
                  ->constrained('mata_praktikum')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();
            $table->string('nama_kelas', 50);
            $table->string('tahun_ajaran', 20);
            $table->unsignedTinyInteger('semester');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas_praktikum');
    }
};
