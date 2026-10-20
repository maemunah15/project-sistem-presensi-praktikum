<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pertemuan extends Model
{
    use HasFactory;

    protected $table = 'pertemuan';

    protected $fillable = [
        'kelas_id',
        'pertemuan_ke',
        'tanggal',
        'materi',
        'status',
    ];

    /**
     * Relasi ke Kelas Praktikum (Kebalikan dari hasMany)
     */
    public function kelas()
    {
        return $this->belongsTo(KelasPraktikum::class, 'kelas_id');
    }

    /**
     * Relasi ke Sesi Presensi (Satu Pertemuan bisa memiliki Sesi Presensi)
     */
    public function sesiPresensi()
    {
        return $this->hasOne(SesiPresensi::class, 'pertemuan_id');
    }
}