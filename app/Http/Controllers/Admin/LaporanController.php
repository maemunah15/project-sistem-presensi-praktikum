<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KelasPraktikum;
use App\Models\MataPraktikum;
use App\Models\User;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $kelasList = KelasPraktikum::with(['mataPraktikum', 'pengajar', 'jadwal', 'mahasiswa'])->get();
        $mataPraktikumList = MataPraktikum::orderBy('kode')->get();

        $selectedKelas = $request->query('kelas', 'A1');
        $selectedTahun = $request->query('tahun', '2026/2027 Ganjil');

        // Sample attendance records matching mock up data
        $rekapData = [
            [
                'nim' => '1227050002',
                'nama' => 'Nama Mahasiswa 1',
                'p' => ['H', 'H', 'H', 'S', 'H', 'H'],
                'hadir' => 5,
                'persen' => '83.3%',
                'status' => 'Memenuhi',
            ],
            [
                'nim' => '2388010026',
                'nama' => "Maemunah Halimatus Sa'diyah",
                'p' => ['H', 'A', 'H', 'H', 'I', 'H'],
                'hadir' => 4,
                'persen' => '66.7%',
                'status' => 'Memenuhi',
            ],
            [
                'nim' => '2388010048',
                'nama' => 'Nama Mahasiswa 3',
                'p' => ['A', 'A', 'H', 'A', 'H', 'A'],
                'hadir' => 2,
                'persen' => '33.3%',
                'status' => 'Tidak memenuhi',
            ],
            [
                'nim' => '2388010099',
                'nama' => 'Nama Mahasiswa 4',
                'p' => ['H', 'H', 'H', 'H', 'H', 'H'],
                'hadir' => 6,
                'persen' => '100.0%',
                'status' => 'Memenuhi',
            ],
        ];

        return view('admin.laporan.index', compact(
            'kelasList',
            'mataPraktikumList',
            'selectedKelas',
            'selectedTahun',
            'rekapData'
        ));
    }
}
