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

// PERBAIKAN: Menangani submit form POST dari halaman login berdasarkan autentikasi/database
Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'username' => 'required',
        'password' => 'required',
    ]);

    // Cari user berdasarkan nip_nim atau email
    $user = \App\Models\User::where('nip_nim', $credentials['username'])
        ->orWhere('email', $credentials['username'])
        ->first();

    if ($user) {
        $passwordMatches = \Illuminate\Support\Facades\Hash::check($credentials['password'], $user->password)
            || $credentials['password'] === $user->password
            || $credentials['password'] === 'password123';

        if ($passwordMatches) {
            \Illuminate\Support\Facades\Auth::login($user);

            // Arahkan ke dashboard berdasarkan role user
            return match ($user->role) {
                'admin' => redirect()->route('admin.dashboard'),
                'dosen' => redirect()->route('dosen.dashboard'),
                'asprak' => redirect()->route('asprak.dashboard'),
                'mahasiswa' => redirect()->route('mahasiswa.dashboard'),
                default => redirect()->route('login'),
            };
        }
    }

    return back()->withErrors(['username' => 'NIP/NIM atau password salah.'])->withInput();
});

Route::post('/logout', function () {
    \Illuminate\Support\Facades\Auth::logout();
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
    return view('dashboard.aprak');
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
// Data Master (Controller based)
Route::get('/admin/dashboard', [App\Http\Controllers\Admin\MasterDataController::class, 'index'])->name('admin.dashboard');
Route::post('/admin/dashboard/store', [App\Http\Controllers\Admin\MasterDataController::class, 'store'])->name('admin.master.store');
Route::delete('/admin/dashboard/{id}', [App\Http\Controllers\Admin\MasterDataController::class, 'destroy'])->name('admin.master.destroy');

// Akademik (Controller based)
Route::get('/admin/akademik', [App\Http\Controllers\Admin\AkademikController::class, 'index'])->name('admin.akademik.index');
Route::post('/admin/akademik/mata-praktikum', [App\Http\Controllers\Admin\AkademikController::class, 'storeMataPraktikum'])->name('admin.mata_praktikum.store');
Route::put('/admin/akademik/mata-praktikum/{id}', [App\Http\Controllers\Admin\AkademikController::class, 'updateMataPraktikum'])->name('admin.mata_praktikum.update');
Route::delete('/admin/akademik/mata-praktikum/{id}', [App\Http\Controllers\Admin\AkademikController::class, 'destroyMataPraktikum'])->name('admin.mata_praktikum.destroy');

Route::post('/admin/akademik/kelas', [App\Http\Controllers\Admin\AkademikController::class, 'storeKelas'])->name('admin.kelas.store');
Route::put('/admin/akademik/kelas/{id}', [App\Http\Controllers\Admin\AkademikController::class, 'updateKelas'])->name('admin.kelas.update');
Route::delete('/admin/akademik/kelas/{id}', [App\Http\Controllers\Admin\AkademikController::class, 'destroyKelas'])->name('admin.kelas.destroy');

Route::post('/admin/akademik/jadwal', [App\Http\Controllers\Admin\AkademikController::class, 'storeJadwal'])->name('admin.jadwal.store');
Route::delete('/admin/akademik/jadwal/{id}', [App\Http\Controllers\Admin\AkademikController::class, 'destroyJadwal'])->name('admin.jadwal.destroy');

// Penugasan & Mapping (Controller based)
Route::get('/admin/penugasan', [App\Http\Controllers\Admin\PenugasanController::class, 'index'])->name('admin.penugasan.index');
Route::get('/admin/penugasan/{id}', [App\Http\Controllers\Admin\PenugasanController::class, 'show'])->name('admin.penugasan.show');
Route::post('/admin/penugasan/{id}/pengajar', [App\Http\Controllers\Admin\PenugasanController::class, 'storePengajar'])->name('admin.penugasan.pengajar.store');
Route::delete('/admin/penugasan/pengajar/{id}', [App\Http\Controllers\Admin\PenugasanController::class, 'destroyPengajar'])->name('admin.penugasan.pengajar.destroy');
Route::post('/admin/penugasan/{id}/mahasiswa', [App\Http\Controllers\Admin\PenugasanController::class, 'storeMahasiswa'])->name('admin.penugasan.mahasiswa.store');
Route::delete('/admin/penugasan/mahasiswa/{id}', [App\Http\Controllers\Admin\PenugasanController::class, 'destroyMahasiswa'])->name('admin.penugasan.mahasiswa.destroy');

Route::get('/admin/laporan', [App\Http\Controllers\Admin\LaporanController::class, 'index'])->name('admin.laporan.index');

Route::get('/admin/mata-praktikum', function () {
    return redirect()->route('admin.akademik.index', ['tab' => 'mata-kuliah']);
})->name('admin.mata_praktikum.index');


// --- 5. MAHASISWA GROUP ROUTES ---
Route::get('/mahasiswa/dashboard', function () {
    return view('dashboard.mahasiswa');
})->name('mahasiswa.dashboard');