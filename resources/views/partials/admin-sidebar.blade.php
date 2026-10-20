@php
    $current = $active ?? '';
    if (!$current) {
        if (request()->routeIs('admin.dashboard*')) {
            $current = 'master';
        } elseif (request()->routeIs('admin.akademik*') || request()->routeIs('admin.mata_praktikum*') || request()->routeIs('admin.kelas*') || request()->routeIs('admin.jadwal*')) {
            $current = 'akademik';
        } elseif (request()->routeIs('admin.penugasan*')) {
            $current = 'penugasan';
        } elseif (request()->routeIs('admin.laporan*')) {
            $current = 'laporan';
        } elseif (request()->routeIs('admin.users*')) {
            $current = 'users';
        }
    }
@endphp

<!-- BACKDROP MOBILE -->
<div id="mobileOverlay" class="mobile-overlay" onclick="toggleSidebar()"></div>

<!-- SIDEBAR -->
<aside id="sidebar" class="sidebar fixed inset-y-0 left-0 w-[250px] flex flex-col z-50">

    <!-- Brand Header -->
    <div class="h-[80px] px-5 flex items-center gap-3 border-b border-white/10 shrink-0">
        <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center p-1.5 shrink-0 shadow-sm">
            <img src="{{ asset('image/Logo-UINSSC.png') }}"
                 alt="Logo UINSSC"
                 class="w-full h-full object-contain"
                 onerror="this.onerror=null; this.src='https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Logo_UIN_Siber_Syekh_Nurjati_Cirebon.png/600px-Logo_UIN_Siber_Syekh_Nurjati_Cirebon.png';">
        </div>
        <div class="min-w-0">
            <h1 class="text-[13.5px] font-bold text-white tracking-tight leading-tight">SIPRAK</h1>
            <p class="text-[9.5px] text-emerald-200/80 font-normal mt-0.5">Sistem Presensi Praktikum</p>
        </div>
    </div>

    <!-- Navigation Menu Items -->
    <div class="px-3 pt-4 pb-2 flex-1 overflow-y-auto space-y-4">
        <div>
            <div class="flex justify-between items-center px-2 mb-2">
                <span class="text-[9.5px] font-semibold tracking-wider text-emerald-200/60 uppercase">MENU UTAMA</span>
                <span class="text-[8.5px] font-medium text-emerald-200/40 bg-white/5 px-1.5 py-0.5 rounded">ADMIN</span>
            </div>

            <nav class="space-y-1">
                <!-- 1. Data Master -->
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ $current === 'master' ? 'active' : '' }}">
                    <span class="nav-icon">
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <rect x="3" y="4" width="18" height="16" rx="2"/>
                            <path d="M3 9h18M9 9v11"/>
                        </svg>
                    </span>
                    <span class="flex-1">Data Master</span>
                </a>

                <!-- 2. Manajemen Akademik -->
                <a href="{{ route('admin.akademik.index') }}" class="nav-link {{ $current === 'akademik' ? 'active' : '' }}">
                    <span class="nav-icon">
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M3 21h18M5 21V8l7-5 7 5v13"/><path d="M9 11h1m4 0h1m-6 4h1m4 0h1"/>
                        </svg>
                    </span>
                    <span class="flex-1">Manajemen Akademik</span>
                </a>

                <!-- 3. Penugasan & Mapping -->
                <a href="{{ route('admin.penugasan.index') }}" class="nav-link {{ $current === 'penugasan' ? 'active' : '' }}">
                    <span class="nav-icon">
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <circle cx="9" cy="8" r="3"/><circle cx="17" cy="9" r="2.5"/><path d="M3 20v-2a6 6 0 0 1 12 0v2z"/><path d="M16 15a5 5 0 0 1 5 5"/>
                        </svg>
                    </span>
                    <span class="flex-1">Penugasan &amp; Mapping</span>
                </a>

                <!-- 4. Rekap & Laporan -->
                <a href="{{ route('admin.laporan.index') }}" class="nav-link {{ $current === 'laporan' ? 'active' : '' }}">
                    <span class="nav-icon">
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M4 19V5m0 14h17"/><path d="M8 15l4-4 3 2 5-7"/>
                        </svg>
                    </span>
                    <span class="flex-1">Rekap &amp; Laporan</span>
                </a>
            </nav>
        </div>
    </div>

    <!-- User Profile Footer -->
    <div class="border-t border-white/10 p-3.5 flex items-center justify-between gap-2.5 shrink-0 bg-black/10">
        <div class="flex items-center gap-2.5 min-w-0">
            <div class="w-8 h-8 rounded-full bg-emerald-700/80 border border-emerald-500/30 flex items-center justify-center text-white text-[11px] font-semibold shrink-0">
                {{ substr(Auth::user()->nama ?? 'A', 0, 1) }}
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-[11.5px] font-semibold text-white truncate">{{ Auth::user()->nama ?? 'Admin Lab' }}</p>
                <p class="text-[9.5px] text-emerald-200/60 truncate font-normal">Administrator</p>
            </div>
        </div>

        <form action="{{ route('logout') }}" method="POST" class="shrink-0">
            @csrf
            <button type="submit" class="w-8 h-8 rounded-lg border border-white/10 bg-white/5 hover:bg-rose-600/80 hover:border-rose-500 text-emerald-200 hover:text-white flex items-center justify-center transition-all" title="Keluar / Logout">
                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/>
                </svg>
            </button>
        </form>
    </div>
</aside>
