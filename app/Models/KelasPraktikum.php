<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasPraktikum extends Model
{
    use HasFactory;

    protected $table = 'kelas_praktikum';

    protected $fillable = [
        'mata_praktikum_id',
        'nama_kelas',
        'tahun_ajaran',
        'semester',
        'status',
    ];

    /**
     * Relasi ke Mata Praktikum
     */
    public function mataPraktikum()
    {
        return $this->belongsTo(MataPraktikum::class, 'mata_praktikum_id');
    }

    /**
     * Relasi ke Mahasiswa yang terdaftar di kelas ini
     */
    public function mahasiswa()
    {
        return $this->belongsToMany(User::class, 'mahasiswa_kelas', 'kelas_id', 'mahasiswa_id')
                    ->withPivot('tanggal_daftar')
                    ->withTimestamps();
    }

    /**
     * Relasi ke Dosen / Asprak
     */
    public function pengajar()
    {
        return $this->belongsToMany(User::class, 'pengajar_kelas', 'kelas_id', 'user_id')
                    ->withPivot('tipe')
                    ->withTimestamps();
    }

    /**
     * Relasi ke Pertemuan
     */
    public function pertemuan()
    {
        return $this->hasMany(Pertemuan::class, 'kelas_id');
    }

    /**
     * Relasi ke Jadwal
     */
    public function jadwals()
    {
        return $this->hasOne(Jadwal::class, 'kelas_id');
    }
}