<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function admin(Request $request)
    {
        $mahasiswaList = \App\Models\User::where('role', 'mahasiswa')->orderBy('nama')->get();
        $dosenList = \App\Models\User::where('role', 'dosen')->orderBy('nama')->get();
        $asistenList = \App\Models\User::where('role', 'asprak')->orderBy('nama')->get();
        $mataPraktikumList = \App\Models\MataPraktikum::orderBy('kode')->get();
        
        // Memanggil 'jadwals' (hasMany) menggantikan 'jadwal'
        $kelasList = \App\Models\KelasPraktikum::with(['mataPraktikum', 'pengajar', 'jadwals', 'mahasiswa'])->get();

        $stats = [
            'total_user' => \App\Models\User::count(),
            'total_dosen' => $dosenList->count(),
            'total_mahasiswa' => $mahasiswaList->count(),
            'total_asprak' => $asistenList->count(),
            'total_matkul' => $mataPraktikumList->count(),
            'total_kelas' => $kelasList->count(),
        ];

        // Active tab parameter support (default to 'master')
        $activeTab = $request->query('tab', 'master');

        return view('dashboard.admin', compact(
            'mahasiswaList',
            'dosenList',
            'asistenList',
            'mataPraktikumList',
            'kelasList',
            'stats',
            'activeTab'
        ));
    }

    public function dosen()
    {
        return view('dashboard.dosen');
    }

    public function mahasiswa()
    {
        return view('dashboard.mahasiswa');
    }
}