<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwal';

    protected $fillable = [
        'kelas_id',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'ruang',
    ];

    /**
     * Relasi ke Kelas Praktikum
     */
    public function kelas()
    {
        return $this->belongsTo(KelasPraktikum::class, 'kelas_id');
    }
}