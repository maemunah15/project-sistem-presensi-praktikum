<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MataPraktikum;
use App\Models\KelasPraktikum;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class AkademikController extends Controller
{
    /**
     * Menampilkan Halaman Utama Manajemen Akademik dengan 3 Sub-Tab
     */
    public function index(Request $request)
    {
        $tab = $request->query('tab', 'mata-kuliah');

        // Data 1: Mata Kuliah Praktikum
        $mataPraktikum = MataPraktikum::orderBy('kode', 'asc')->get();

        // Data 2: Kelas Praktikum (dengan eager loading relasi lengkap)
        $kelasPraktikum = KelasPraktikum::with(['mataPraktikum', 'pengajar', 'mahasiswa'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Data 3: Jadwal Praktikum
        $jadwals = Jadwal::with(['kelas.mataPraktikum'])->orderBy('hari', 'asc')->get();

        return view('admin.akademik.index', compact('mataPraktikum', 'kelasPraktikum', 'jadwals', 'tab'));
    }

    // ================= 1. MATA KULIAH PRAKTIKUM =================
    public function storeMataPraktikum(Request $request)
    {
        $request->validate([
            'kode'     => 'required|string|max:20|unique:mata_praktikum,kode',
            'nama'     => 'required|string|max:100',
            'semester' => 'required|numeric|min:1|max:8',
            'sks'      => 'nullable|numeric|min:1|max:6',
        ]);

        MataPraktikum::create([
            'kode'     => $request->kode,
            'nama'     => $request->nama,
            'semester' => $request->semester,
            'sks'      => $request->sks ?? 3,
            'status'   => $request->status ?? 1,
        ]);

        return redirect()->route('admin.akademik.index', ['tab' => 'mata-kuliah'])
            ->with('success', 'Mata Kuliah Praktikum berhasil ditambahkan!');
    }

    public function updateMataPraktikum(Request $request, $id)
    {
        $mk = MataPraktikum::findOrFail($id);

        $request->validate([
            'kode'     => 'required|string|max:20|unique:mata_praktikum,kode,' . $mk->id,
            'nama'     => 'required|string|max:100',
            'semester' => 'required|numeric|min:1|max:8',
            'sks'      => 'nullable|numeric|min:1|max:6',
        ]);

        $mk->update([
            'kode'     => $request->kode,
            'nama'     => $request->nama,
            'semester' => $request->semester,
            'sks'      => $request->sks ?? $mk->sks,
            'status'   => $request->status ?? $mk->status,
        ]);

        return redirect()->route('admin.akademik.index', ['tab' => 'mata-kuliah'])
            ->with('success', 'Mata Kuliah Praktikum berhasil diperbarui!');
    }

    public function destroyMataPraktikum($id)
    {
        try {
            MataPraktikum::findOrFail($id)->delete();
            return redirect()->route('admin.akademik.index', ['tab' => 'mata-kuliah'])
                ->with('success', 'Mata Kuliah Praktikum berhasil dihapus!');
        } catch (QueryException $e) {
            return redirect()->route('admin.akademik.index', ['tab' => 'mata-kuliah'])
                ->with('error', 'Gagal Menghapus: Mata kuliah ini masih terikat dengan Kelas Praktikum yang aktif! Hapus kelasnya terlebih dahulu.');
        }
    }

    // ================= 2. KELAS PRAKTIKUM =================
    public function storeKelas(Request $request)
    {
        $request->validate([
            'mata_praktikum_id' => 'required|exists:mata_praktikum,id',
            'nama_kelas'        => 'required|string|max:50',
            'tahun_ajaran'      => 'required|string|max:20',
            'semester'          => 'nullable|integer|min:1|max:8',
        ]);

        $mk = MataPraktikum::find($request->mata_praktikum_id);
        $semester = $request->semester ?: ($mk->semester ?? 1);

        KelasPraktikum::create([
            'mata_praktikum_id' => $request->mata_praktikum_id,
            'nama_kelas'        => $request->nama_kelas,
            'tahun_ajaran'      => $request->tahun_ajaran,
            'semester'          => $semester,
            'status'            => 1,
        ]);

        if ($request->input('redirect_to') === 'penugasan') {
            return redirect()->route('admin.penugasan.index')
                ->with('success', 'Kelas Praktikum berhasil ditambahkan!');
        }

        return redirect()->route('admin.akademik.index', ['tab' => 'kelas'])
            ->with('success', 'Kelas Praktikum berhasil ditambahkan!');
    }

    public function updateKelas(Request $request, $id)
    {
        $kelas = KelasPraktikum::findOrFail($id);

        $request->validate([
            'mata_praktikum_id' => 'required|exists:mata_praktikum,id',
            'nama_kelas'        => 'required|string|max:50',
            'tahun_ajaran'      => 'required|string|max:20',
            'semester'          => 'nullable|integer|min:1|max:8',
        ]);

        $mk = MataPraktikum::find($request->mata_praktikum_id);
        $semester = $request->semester ?: ($mk->semester ?? $kelas->semester ?? 1);

        $data = $request->all();
        $data['semester'] = $semester;

        $kelas->update($data);

        return redirect()->route('admin.akademik.index', ['tab' => 'kelas'])
            ->with('success', 'Kelas Praktikum berhasil diperbarui!');
    }

    public function destroyKelas(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            // 1. Hapus otomatis relasi anak di tabel pivot dan jadwal
            DB::table('mahasiswa_kelas')->where('kelas_id', $id)->delete();
            DB::table('pengajar_kelas')->where('kelas_id', $id)->delete();
            DB::table('jadwal')->where('kelas_id', $id)->delete();

            // 2. Hapus data induk Kelas Praktikum
            KelasPraktikum::findOrFail($id)->delete();

            DB::commit();

            if ($request->query('redirect_to') === 'penugasan') {
                return redirect()->route('admin.penugasan.index')
                    ->with('success', 'Kelas Praktikum beserta seluruh data penugasannya berhasil dihapus!');
            }

            return redirect()->route('admin.akademik.index', ['tab' => 'kelas'])
                ->with('success', 'Kelas Praktikum beserta data penugasannya berhasil dihapus!');
        } catch (\Exception $e) {
            DB::rollBack();

            if ($request->query('redirect_to') === 'penugasan') {
                return redirect()->route('admin.penugasan.index')
                    ->with('error', 'Gagal menghapus kelas karena terikat dengan data presensi atau sesi praktikum.');
            }

            return redirect()->route('admin.akademik.index', ['tab' => 'kelas'])
                ->with('error', 'Gagal menghapus kelas karena terikat dengan data presensi harian.');
        }
    }

    // ================= 3. JADWAL PRAKTIKUM =================
    public function storeJadwal(Request $request)
    {
        $request->validate([
            'kelas_id'    => 'required|exists:kelas_praktikum,id',
            'hari'        => 'required|string',
            'jam_mulai'   => 'required',
            'jam_selesai' => 'required',
            'ruangan_lab' => 'required|string|max:100',
        ]);

        // Pemetaan 'ruangan_lab' dari Form ke Kolom 'ruang' pada tabel database 'jadwal'
        Jadwal::create([
            'kelas_id'    => $request->kelas_id,
            'hari'        => $request->hari,
            'jam_mulai'   => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'ruang'       => $request->ruangan_lab,
        ]);

        return redirect()->route('admin.akademik.index', ['tab' => 'jadwal'])
            ->with('success', 'Jadwal Praktikum berhasil ditambahkan!');
    }

    public function destroyJadwal($id)
    {
        Jadwal::findOrFail($id)->delete();

        return redirect()->route('admin.akademik.index', ['tab' => 'jadwal'])
            ->with('success', 'Jadwal Praktikum berhasil dihapus!');
    }
}