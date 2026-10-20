<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KelasPraktikum;
use App\Models\MataPraktikum;
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
        // Ambil kelas praktikum lengkap dengan hitungan pengajar dan mahasiswa
        $kelases = KelasPraktikum::with(['mataPraktikum', 'pengajar', 'mahasiswa'])
            ->withCount(['pengajar', 'mahasiswa'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Ambil daftar mata praktikum untuk form modal tambah kelas praktikum
        $mataPraktikum = MataPraktikum::orderBy('nama', 'asc')->get();

        return view('admin.penugasan.index', compact('kelases', 'mataPraktikum'));
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
    public function destroyPengajar(Request $request, $id)
    {
        // $id adalah user_id pengajar atau id baris pengajar_kelas
        $kelasId = $request->query('kelas_id');
        if ($kelasId) {
            DB::table('pengajar_kelas')
                ->where('kelas_id', $kelasId)
                ->where('user_id', $id)
                ->delete();
        } else {
            DB::table('pengajar_kelas')->where('id', $id)->orWhere('user_id', $id)->delete();
        }
        return redirect()->back()->with('success', 'Penugasan pengajar berhasil dihapus.');
    }

    /**
     * Simpan Mapping Mahasiswa ke Kelas
     */
    public function storeMahasiswa(Request $request, $kelasId)
    {
        // Mendukung single user_id atau multiple mahasiswa_ids
        $mhsIds = [];
        if ($request->has('user_id') && !empty($request->user_id)) {
            $mhsIds[] = $request->user_id;
        } elseif ($request->has('mahasiswa_ids')) {
            $mhsIds = is_array($request->mahasiswa_ids) ? $request->mahasiswa_ids : [$request->mahasiswa_ids];
        }

        if (empty($mhsIds)) {
            return redirect()->back()->with('error', 'Silakan pilih mahasiswa terlebih dahulu.');
        }

        $data = [];
        foreach ($mhsIds as $mhsId) {
            $exists = DB::table('mahasiswa_kelas')
                ->where('kelas_id', $kelasId)
                ->where('mahasiswa_id', $mhsId)
                ->exists();

            if (!$exists) {
                $data[] = [
                    'kelas_id'       => $kelasId,
                    'mahasiswa_id'   => $mhsId,
                    'tanggal_daftar' => now(),
                    'created_at'     => now(),
                    'updated_at'     => now(),
                ];
            }
        }

        if (!empty($data)) {
            DB::table('mahasiswa_kelas')->insert($data);
            return redirect()->back()->with('success', count($data) . ' Mahasiswa berhasil ditambahkan ke kelas.');
        }

        return redirect()->back()->with('info', 'Mahasiswa yang dipilih sudah terdaftar di kelas ini.');
    }

    /**
     * Keluarkan Mahasiswa dari Kelas
     */
    public function destroyMahasiswa(Request $request, $id)
    {
        $kelasId = $request->query('kelas_id');
        if ($kelasId) {
            DB::table('mahasiswa_kelas')
                ->where('kelas_id', $kelasId)
                ->where('mahasiswa_id', $id)
                ->delete();
        } else {
            DB::table('mahasiswa_kelas')->where('id', $id)->orWhere('mahasiswa_id', $id)->delete();
        }
        return redirect()->back()->with('success', 'Mahasiswa berhasil dikeluarkan dari kelas.');
    }
}