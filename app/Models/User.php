<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Nama tabel di database (MySQL)
     */
    protected $table = 'users';

    /**
     * Kolom yang dapat diisi secara masal (Mass Assignment)
     */
    protected $fillable = [
        'nama',
        'nip_nim',
        'email',
        'password',
        'role',
        'status',
    ];

    /**
     * Kolom yang disembunyikan saat serialisasi (keamanan)
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Konversi tipe data otomatis
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}