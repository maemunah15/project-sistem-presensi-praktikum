<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Menampilkan daftar seluruh pengguna (Admin, Dosen, Asprak, Mahasiswa)
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Filter berdasarkan pencarian nama/NIP/NIM/email
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nip_nim', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filter berdasarkan role
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        $users = $query->orderBy('nama', 'asc')->paginate(10)->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Menampilkan form tambah pengguna baru
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Menyimpan data pengguna baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'     => 'required|string|max:255',
            'nip_nim'  => 'required|string|max:50|unique:users,nip_nim',
            'email'    => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',
            'role'     => 'required|in:admin,dosen,asprak,mahasiswa',
        ], [
            'nip_nim.unique' => 'NIP/NIM sudah terdaftar di sistem.',
            'email.unique'   => 'Email sudah terdaftar di sistem.',
        ]);

        User::create([
            'nama'     => $request->nama,
            'nip_nim'  => $request->nip_nim,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'Pengguna baru berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit pengguna
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Memperbarui data pengguna di database
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'nama'     => 'required|string|max:255',
            'nip_nim'  => 'required|string|max:50|unique:users,nip_nim,' . $id,
            'email'    => 'required|email|max:255|unique:users,email,' . $id,
            'role'     => 'required|in:admin,dosen,asprak,mahasiswa',
            'password' => 'nullable|string|min:6',
        ]);

        $data = [
            'nama'    => $request->nama,
            'nip_nim' => $request->nip_nim,
            'email'   => $request->email,
            'role'    => $request->role,
        ];

        // Jika password diisi, lakukan Hash password baru
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')
            ->with('success', 'Data pengguna berhasil diperbarui.');
    }

    /**
     * Menghapus data pengguna
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Mencegah Admin menghapus akunnya sendiri yang sedang login
        if (auth()->id() == $user->id) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Pengguna berhasil dihapus.');
    }
}