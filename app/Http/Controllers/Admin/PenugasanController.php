<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KelasPraktikum;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenugasanController extends Controller
{
    /**
     * Halaman Utama Penugasan & Mapping Kelas
     */
    public function index(Request $request)
    {
        // PERBAIKAN: Menghapus .user karena pengajar dan mahasiswa sudah langsung merujuk ke model User
        $kelases = KelasPraktikum::with(['mataPraktikum', 'pengajar', 'mahasiswa'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.penugasan.index', compact('kelases'));
    }

    /**
     * Detail Mapping untuk Kelas Spesifik
     */
    public function show($id)
    {
        // PERBAIKAN: Menghapus .user agar tidak terjadi RelationNotFoundException
        $kelas = KelasPraktikum::with(['mataPraktikum', 'pengajar', 'mahasiswa'])->findOrFail($id);

        $dosens = User::where('role', 'dosen')->orderBy('nama', 'asc')->get();
        $aspraks = User::where('role', 'asprak')->orderBy('nama', 'asc')->get();
        
        $mahasiswaTerdaftarIds = DB::table('mahasiswa_kelas')->where('kelas_id', $id)->pluck('mahasiswa_id')->toArray();
        $mahasiswas = User::where('role', 'mahasiswa')
            ->whereNotIn('id', $mahasiswaTerdaftarIds)
            ->orderBy('nama', 'asc')
            ->get();

        return view('admin.penugasan.show', compact('kelas', 'dosens', 'aspraks', 'mahasiswas'));
    }

    /**
     * Simpan Plotting Pengajar (Dosen / Asprak)
     */
    public function storePengajar(Request $request, $kelasId)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'tipe'    => 'required|in:dosen,asprak',
        ]);

        $exists = DB::table('pengajar_kelas')
            ->where('kelas_id', $kelasId)
            ->where('user_id', $request->user_id)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'Pengajar tersebut sudah ditugaskan pada kelas ini.');
        }

        DB::table('pengajar_kelas')->insert([
            'kelas_id'   => $kelasId,
            'user_id'    => $request->user_id,
            'tipe'       => $request->tipe,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Pengajar berhasil ditugaskan ke kelas.');
    }

    /**
     * Hapus Plotting Pengajar
     */
    public function destroyPengajar($id)
    {
        DB::table('pengajar_kelas')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Penugasan pengajar berhasil dihapus.');
    }

    /**
     * Simpan Mapping Mahasiswa ke Kelas
     */
    public function storeMahasiswa(Request $request, $kelasId)
    {
        $request->validate([
            'mahasiswa_ids'   => 'required|array',
            'mahasiswa_ids.*' => 'exists:users,id',
        ]);

        $data = [];
        foreach ($request->mahasiswa_ids as $mhsId) {
            $data[] = [
                'kelas_id'       => $kelasId,
                'mahasiswa_id'   => $mhsId,
                'tanggal_daftar' => now(),
                'created_at'     => now(),
                'updated_at'     => now(),
            ];
        }

        DB::table('mahasiswa_kelas')->insert($data);

        return redirect()->back()->with('success', count($data) . ' Mahasiswa berhasil ditambahkan ke kelas.');
    }

    /**
     * Keluarkan Mahasiswa dari Kelas
     */
    public function destroyMahasiswa($id)
    {
        DB::table('mahasiswa_kelas')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Mahasiswa berhasil dikeluarkan dari kelas.');
    }
}