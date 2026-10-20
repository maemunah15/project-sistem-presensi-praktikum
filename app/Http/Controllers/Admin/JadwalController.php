<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\KelasPraktikum;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class JadwalController extends Controller
{
    /**
     * Menampilkan daftar jadwal praktikum.
     */
    public function index()
    {
        $jadwals = Jadwal::with('kelas.mataPraktikum')
            ->orderBy('hari', 'asc')
            ->orderBy('jam_mulai', 'asc')
            ->get();

        $kelases = KelasPraktikum::with('mataPraktikum')
            ->where('status', true)
            ->get();

        return view('admin.akademik.jadwal.index', compact('jadwals', 'kelases'));
    }

    /**
     * Menyimpan data jadwal baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kelas_id'    => 'required|exists:kelas_praktikum,id',
            'hari'        => ['required', Rule::in(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'])],
            'jam_mulai'   => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'ruang'       => 'required|string|max:100',
        ]);

        // Cek bentrok jadwal di ruang yang sama pada hari & rentang waktu yang beririsan
        $bentrok = Jadwal::where('ruang', $validated['ruang'])
            ->where('hari', $validated['hari'])
            ->where(function ($query) use ($validated) {
                $query->whereBetween('jam_mulai', [$validated['jam_mulai'], $validated['jam_selesai']])
                    ->orWhereBetween('jam_selesai', [$validated['jam_mulai'], $validated['jam_selesai']])
                    ->orWhere(function ($q) use ($validated) {
                        $q->where('jam_mulai', '<=', $validated['jam_mulai'])
                          ->where('jam_selesai', '>=', $validated['jam_selesai']);
                    });
            })
            ->exists();

        if ($bentrok) {
            return back()->withInput()->with('error', 'Jadwal bentrok! Ruangan ' . $validated['ruang'] . ' sudah digunakan pada hari dan jam tersebut.');
        }

        Jadwal::create($validated);

        return back()->with('success', 'Jadwal praktikum berhasil ditambahkan!');
    }

    /**
     * Memperbarui data jadwal.
     */
    public function update(Request $request, Jadwal $jadwal)
    {
        $validated = $request->validate([
            'kelas_id'    => 'required|exists:kelas_praktikum,id',
            'hari'        => ['required', Rule::in(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'])],
            'jam_mulai'   => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'ruang'       => 'required|string|max:100',
        ]);

        // Cek bentrok jadwal di ruangan & waktu sama (abaikan ID jadwal yang sedang di-edit)
        $bentrok = Jadwal::where('ruang', $validated['ruang'])
            ->where('hari', $validated['hari'])
            ->where('id', '!=', $jadwal->id)
            ->where(function ($query) use ($validated) {
                $query->whereBetween('jam_mulai', [$validated['jam_mulai'], $validated['jam_selesai']])
                    ->orWhereBetween('jam_selesai', [$validated['jam_mulai'], $validated['jam_selesai']])
                    ->orWhere(function ($q) use ($validated) {
                        $q->where('jam_mulai', '<=', $validated['jam_mulai'])
                          ->where('jam_selesai', '>=', $validated['jam_selesai']);
                    });
            })
            ->exists();

        if ($bentrok) {
            return back()->withInput()->with('error', 'Jadwal bentrok! Ruangan ' . $validated['ruang'] . ' sudah digunakan pada hari dan jam tersebut.');
        }

        $jadwal->update($validated);

        return back()->with('success', 'Jadwal praktikum berhasil diperbarui!');
    }

    /**
     * Menghapus data jadwal.
     */
    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();

        return back()->with('success', 'Jadwal praktikum berhasil dihapus!');
    }
}