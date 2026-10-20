<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes - SIPRAK (Sistem Presensi Praktikum)
|--------------------------------------------------------------------------
*/

// Redirect Halaman Utama ke Login
Route::get('/', function () {
    return redirect()->route('login');
});

// --- 1. AUTHENTICATION ROUTES ---
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// PERBAIKAN: Menangani submit form POST dari halaman login
Route::post('/login', function (Request $request) {
    $username = $request->input('username');

    // Arahkan otomatis berdasarkan akun yang dipilih/diisi
    if ($username === '198504122010122001' || str_contains($username, 'dosen')) {
        return redirect()->route('dosen.dashboard');
    } elseif ($username === '2026119999' || str_contains($username, 'asprak')) {
        return redirect()->route('asprak.dashboard');
    } elseif ($username === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    // Default jika mengisi akun mahasiswa / lainnya
    return redirect()->route('dosen.dashboard');
});

Route::post('/logout', function () {
    return redirect()->route('login');
})->name('logout');


// --- 2. DOSEN GROUP ROUTES ---
Route::get('/dosen/dashboard', function () {
    return view('dashboard.dosen');
})->name('dosen.dashboard');

Route::get('/dosen/pertemuan', function () {
    return view('dosen.pertemuan.index');
})->name('dosen.pertemuan.index');

Route::get('/dosen/monitoring', function () {
    return view('dosen.monitoring.index');
})->name('dosen.monitoring.index');

Route::get('/dosen/laporan', function () {
    return view('dosen.laporan.index');
})->name('dosen.laporan.index');


// --- 3. ASPRAK GROUP ROUTES ---
Route::get('/asprak/dashboard', function () {
    return view('dashboard.asprak');
})->name('asprak.dashboard');

Route::get('/asprak/sesi', function () {
    return view('asprak.sesi.index');
})->name('asprak.sesi.index');

Route::get('/asprak/monitoring', function () {
    return view('asprak.monitoring.index');
})->name('asprak.monitoring.index');

Route::get('/asprak/verifikasi', function () {
    return view('asprak.verifikasi.index');
})->name('asprak.verifikasi.index');


// --- 4. ADMIN GROUP ROUTES ---
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

Route::get('/admin/users', function () {
    return view('admin.users.index');
})->name('admin.users.index');

Route::get('/admin/akademik', function () {
    return view('admin.akademik.index');
})->name('admin.akademik.index');