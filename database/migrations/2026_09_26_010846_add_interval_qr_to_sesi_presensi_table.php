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
        Schema::table('sesi_presensi', function (Blueprint $table) {
            // Menambahkan kolom interval_qr setelah kolom waktu_selesai
            $table->unsignedSmallInteger('interval_qr')
                  ->default(30)
                  ->after('waktu_selesai');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sesi_presensi', function (Blueprint $table) {
            $table->dropColumn('interval_qr');
        });
    }
};