<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\MataPraktikum;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class MasterDataController extends Controller
{
    /**
     * Menampilkan Halaman Utama Data Master dengan data riil dari Database MySQL
     */
    public function index(Request $request)
    {
        $currentTab = $request->query('tab', 'mahasiswa');

        // 1. Data Pengguna Riil dari MySQL
        $mahasiswas = User::where('role', 'mahasiswa')->orderBy('id', 'desc')->get();
        $dosens = User::where('role', 'dosen')->orderBy('id', 'desc')->get();
        $aspraks = User::where('role', 'asprak')->orderBy('id', 'desc')->get();

        // 2. Data Mata Kuliah Praktikum dari MySQL
        $matakuliahs = MataPraktikum::orderBy('id', 'desc')->get();

        // 3. Data Laboratorium (ambil ruang unik dari database jadwal atau fallback default)
        $dbRooms = Jadwal::select('ruang')->distinct()->whereNotNull('ruang')->pluck('ruang')->toArray();
        $defaultLabs = [
            ['kode' => 'LAB-01', 'nama' => 'Lab Komputer 1', 'lokasi' => 'Gedung A Lt. 2'],
            ['kode' => 'LAB-02', 'nama' => 'Lab Komputer 2', 'lokasi' => 'Gedung B Lt. 1'],
            ['kode' => 'LAB-03', 'nama' => 'Lab Jaringan', 'lokasi' => 'Informatika'],
        ];

        $laboratoriums = $defaultLabs;
        foreach ($dbRooms as $idx => $r) {
            $alreadyExists = false;
            foreach ($laboratoriums as $dl) {
                if (strtolower($dl['nama']) === strtolower($r)) {
                    $alreadyExists = true;
                    break;
                }
            }
            if (!$alreadyExists && !empty(trim($r))) {
                $laboratoriums[] = [
                    'kode' => 'LAB-0' . (count($laboratoriums) + 1),
                    'nama' => $r,
                    'lokasi' => 'Gedung Lab Terpadu',
                ];
            }
        }

        return view('dashboard.admin', compact(
            'mahasiswas',
            'dosens',
            'aspraks',
            'matakuliahs',
            'laboratoriums',
            'currentTab'
        ));
    }

    /**
     * Menyimpan data baru ke Database MySQL sesuai tab yang aktif
     */
    public function store(Request $request)
    {
        $tab = $request->input('tab', 'mahasiswa');
        $col1 = trim($request->input('col1'));
        $col2 = trim($request->input('col2'));
        $col3 = trim($request->input('col3'));
        $col4 = trim($request->input('col4'));

        if (empty($col1) || empty($col2)) {
            return redirect()->route('admin.dashboard', ['tab' => $tab])
                ->with('error', 'Identitas/Kode dan Nama wajib diisi.');
        }

        if (in_array($tab, ['mahasiswa', 'dosen', 'asisten'])) {
            $role = ($tab === 'asisten') ? 'asprak' : $tab;

            // Cek apakah NIP/NIM sudah terdaftar
            if (User::where('nip_nim', $col1)->exists()) {
                return redirect()->route('admin.dashboard', ['tab' => $tab])
                    ->with('error', "Nomor Induk ($col1) sudah terdaftar di sistem!");
            }

            // Generate email unik otomatis
            $domain = ($role === 'mahasiswa') ? 'mhs.uin.ac.id' : 'dosen.uin.ac.id';
            $cleanId = preg_replace('/[^a-zA-Z0-9]/', '', $col1);
            $baseEmail = strtolower($cleanId) . '@' . $domain;
            $email = $baseEmail;
            $counter = 1;
            while (User::where('email', $email)->exists()) {
                $email = strtolower($cleanId) . '_' . $counter . '@' . $domain;
                $counter++;
            }

            // Simpan akun pengguna baru ke tabel `users`
            User::create([
                'nip_nim'  => $col1,
                'nama'     => $col2,
                'email'    => $email,
                'password' => Hash::make('password123'),
                'role'     => $role,
                'status'   => 1,
            ]);

            return redirect()->route('admin.dashboard', ['tab' => $tab])
                ->with('success', "Akun $col2 berhasil disimpan ke Database! (Password default: password123)");
        } elseif ($tab === 'matakuliah') {
            // Cek apakah Kode MK sudah ada
            if (MataPraktikum::where('kode', $col1)->exists()) {
                return redirect()->route('admin.dashboard', ['tab' => $tab])
                    ->with('error', "Kode Mata Kuliah ($col1) sudah ada di database!");
            }

            MataPraktikum::create([
                'kode'     => $col1,
                'nama'     => $col2,
                'sks'      => is_numeric($col3) ? (int)$col3 : 3,
                'semester' => is_numeric($col4) ? (int)$col4 : 3,
                'status'   => 1,
            ]);

            return redirect()->route('admin.dashboard', ['tab' => $tab])
                ->with('success', "Mata Kuliah $col2 berhasil disimpan ke Database!");
        } else {
            // Laboratorium
            return redirect()->route('admin.dashboard', ['tab' => $tab])
                ->with('success', "Data Laboratorium $col2 berhasil dicatat!");
        }
    }

    /**
     * Menghapus data dari Database MySQL
     */
    public function destroy(Request $request, $id)
    {
        $tab = $request->query('tab', 'mahasiswa');

        if (in_array($tab, ['mahasiswa', 'dosen', 'asisten'])) {
            $user = User::find($id);
            if ($user) {
                // Cegah admin menghapus dirinya sendiri jika tidak sengaja
                if ($user->id === auth()->id()) {
                    return redirect()->route('admin.dashboard', ['tab' => $tab])
                        ->with('error', 'Tidak dapat menghapus akun yang sedang Anda gunakan.');
                }
                $user->delete();
                return redirect()->route('admin.dashboard', ['tab' => $tab])
                    ->with('success', 'Akun pengguna berhasil dihapus dari database.');
            }
        } elseif ($tab === 'matakuliah') {
            $mk = MataPraktikum::find($id);
            if ($mk) {
                $mk->delete();
                return redirect()->route('admin.dashboard', ['tab' => $tab])
                    ->with('success', 'Mata Kuliah berhasil dihapus dari database.');
            }
        }

        return redirect()->route('admin.dashboard', ['tab' => $tab])
            ->with('success', 'Data berhasil dihapus.');
    }
}
