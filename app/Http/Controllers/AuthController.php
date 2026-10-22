<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan halaman form login
    public function showLogin()
    {
        if (Auth::check()) {
            return $this->redirectBasedOnRole(Auth::user()->role);
        }

        return view('auth.login');
    }

    // Memproses data login menggunakan NIP / NIM
    public function login(Request $request)
    {
        // 1. Validasi input: NIP/NIM dan password wajib diisi
        $credentials = $request->validate([
            'nip_nim'  => ['required', 'string'],
            'password' => ['required', 'string'],
            'role'     => ['nullable', 'string', 'in:admin,dosen,asprak,mahasiswa'],
        ]);

        $nipNim = trim($credentials['nip_nim']);
        $password = $credentials['password'];
        $selectedRole = $request->input('role');

        // 2. Cek apakah user dengan NIP / NIM tersebut sudah ada
        $user = User::where('nip_nim', $nipNim)->first();

        if ($user) {
            // Cek kecocokan password biasa atau password default uji coba ('password123' / sama dengan nip_nim)
            $passwordValid = Hash::check($password, $user->password) 
                || $password === 'password123' 
                || $password === $nipNim;

            if ($passwordValid) {
                // Jika penguji memilih role tertentu di form, sesuaikan role akun tersebut
                if ($selectedRole && in_array($selectedRole, ['admin', 'dosen', 'asprak', 'mahasiswa'])) {
                    $user->role = $selectedRole;
                }
                
                // Pastikan password tersimpan ter-hash dengan benar jika memakai password123
                if ($password === 'password123' && !Hash::check('password123', $user->password)) {
                    $user->password = Hash::make('password123');
                }
                $user->save();

                $remember = $request->boolean('remember');
                Auth::login($user, $remember);
                $request->session()->regenerate();

                return $this->redirectBasedOnRole($user->role);
            }
        } else {
            // 3. FITUR PENGUJIAN FLEKSIBEL:
            // Jika akun belum ada di database dan penguji memasukkan password123 (atau NIM-nya sendiri),
            // sistem otomatis membuatkan akun baru dengan NIP/NIM dan Role yang dipilih!
            if ($password === 'password123' || $password === $nipNim || $password === '12345678') {
                $role = $selectedRole ?: 'mahasiswa';
                $roleLabels = [
                    'admin' => 'Admin',
                    'dosen' => 'Dosen',
                    'asprak' => 'Asisten Praktikum',
                    'mahasiswa' => 'Mahasiswa',
                ];

                $user = User::create([
                    'nip_nim'  => $nipNim,
                    'nama'     => ($roleLabels[$role] ?? 'Pengguna') . ' ' . $nipNim,
                    'email'    => $nipNim . '@praktikum.test',
                    'password' => Hash::make('password123'),
                    'role'     => $role,
                    'status'   => true,
                ]);

                $remember = $request->boolean('remember');
                Auth::login($user, $remember);
                $request->session()->regenerate();

                return $this->redirectBasedOnRole($user->role);
            }
        }

        // 4. Jika password salah
        return back()->withErrors([
            'nip_nim' => 'NIP / NIM atau password yang Anda masukkan salah. Untuk uji coba angka bebas, gunakan password: password123',
        ]);
    }

    // Redirection helper berdasarkan role pengguna
    public function redirectBasedOnRole(string $role)
    {
        if ($role === 'admin') {
            return redirect()->intended('/admin/dashboard');
        } elseif ($role === 'dosen' || $role === 'asprak') {
            return redirect()->intended('/dosen/dashboard');
        } else {
            return redirect()->intended('/mahasiswa/dashboard');
        }
    }

    // Memproses logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}