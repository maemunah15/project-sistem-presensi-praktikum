<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SesiPresensi extends Model
{
    use HasFactory;

    protected $table = 'sesi_presensi';

    protected $fillable = [
        'pertemuan_id',
        'kode_qr',
        'waktu_mulai',
        'waktu_selesai',
        'interval_qr',
        'status',
    ];

    /**
     * Relasi ke Pertemuan
     */
    public function pertemuan()
    {
        return $this->belongsTo(Pertemuan::class, 'pertemuan_id');
    }

    /**
     * Relasi ke Catatan Presensi Mahasiswa (Satu Sesi punya banyak Presensi)
     */
    public function presensi()
    {
        return $this->hasMany(Presensi::class, 'sesi_presensi_id');
    }
}