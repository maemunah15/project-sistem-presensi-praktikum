<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        $userRole = $user->role;

        // Jika role user diizinkan
        if (in_array($userRole, $roles)) {
            return $next($request);
        }

        // Jika role tidak cocok, redirect ke dashboard yang sesuai peran mereka
        if ($userRole === 'admin') {
            return redirect('/admin/dashboard')->with('error', 'Halaman tersebut khusus untuk peran lain. Anda dialihkan ke Dashboard Admin.');
        } elseif ($userRole === 'dosen' || $userRole === 'asprak') {
            return redirect('/dosen/dashboard')->with('error', 'Halaman tersebut khusus untuk peran lain. Anda dialihkan ke Dashboard Dosen / Asprak.');
        } else {
            return redirect('/mahasiswa/dashboard')->with('error', 'Halaman tersebut khusus untuk peran lain. Anda dialihkan ke Dashboard Mahasiswa.');
        }
    }
}
