<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataPraktikum extends Model
{
    use HasFactory;

    protected $table = 'mata_praktikum';

    protected $fillable = [
        'kode',
        'nama',
        'semester',
        'sks',
        'status',
    ];

    /**
     * Relasi ke Kelas Praktikum
     */
    public function kelasPraktikum()
    {
        return $this->hasMany(KelasPraktikum::class, 'mata_praktikum_id');
    }
}
