<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;

    protected $table = 'presensi';

    protected $fillable = [
        'sesi_presensi_id',
        'mahasiswa_id',
        'waktu_presensi',
        'status',
        'keterangan',
    ];

    /**
     * Relasi ke Sesi Presensi
     */
    public function sesiPresensi()
    {
        return $this->belongsTo(SesiPresensi::class, 'sesi_presensi_id');
    }

    /**
     * Relasi ke User (Mahasiswa)
     */
    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'mahasiswa_id');
    }
}