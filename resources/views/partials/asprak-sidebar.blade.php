@php
    $current = $active ?? 'dashboard';
@endphp

<!-- BACKDROP MOBILE -->
<div id="mobileOverlay" class="mobile-overlay" onclick="toggleSidebar()"></div>

<!-- SIDEBAR NAVIGATION -->
<aside id="sidebar" class="sidebar fixed inset-y-0 left-0 w-[250px] flex flex-col z-50">
    <div class="h-[80px] px-5 flex items-center gap-3 border-b border-white/10 shrink-0">
        <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center p-1.5 shrink-0 shadow-sm">
            <img src="{{ asset('image/Logo-UINSSC.png') }}" alt="Logo UINSSC" class="w-full h-full object-contain" onerror="this.onerror=null; this.src='https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Logo_UIN_Siber_Syekh_Nurjati_Cirebon.png/600px-Logo_UIN_Siber_Syekh_Nurjati_Cirebon.png';">
        </div>
        <div class="min-w-0">
            <h1 class="text-[13.5px] font-bold text-white tracking-tight leading-tight">SIPRAK</h1>
            <p class="text-[9.5px] text-emerald-200/80 font-normal mt-0.5">Sistem Presensi Praktikum</p>
        </div>
    </div>

    <div class="px-3 pt-4 pb-2 flex-1 overflow-y-auto space-y-4">
        <div>
            <div class="flex justify-between items-center px-2 mb-2">
                <span class="text-[9.5px] font-semibold tracking-wider text-emerald-200/60 uppercase">MENU UTAMA</span>
                <span class="text-[8.5px] font-medium text-emerald-200/40 bg-white/5 px-1.5 py-0.5 rounded">ASPRAK</span>
            </div>

            <nav class="space-y-1">
                <!-- 1. Dashboard -->
                <a href="{{ route('asprak.dashboard') }}" class="nav-link {{ $current === 'dashboard' ? 'active' : '' }}">
                    <span class="nav-icon">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    </span>
                    <span class="flex-1">Dashboard</span>
                </a>

                <!-- 2. Sesi Presensi -->
                <a href="{{ route('asprak.sesi.index') }}" class="nav-link {{ $current === 'sesi' ? 'active' : '' }}">
                    <span class="nav-icon">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    </span>
                    <span class="flex-1">Sesi Presensi</span>
                </a>

                <!-- 3. Monitoring Presensi -->
                <a href="{{ route('asprak.monitoring.index') }}" class="nav-link {{ $current === 'monitoring' ? 'active' : '' }}">
                    <span class="nav-icon">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </span>
                    <span class="flex-1">Monitoring Presensi</span>
                </a>

                <!-- 4. Verifikasi Izin/Sakit -->
                <a href="{{ route('asprak.verifikasi.index') }}" class="nav-link {{ $current === 'verifikasi' ? 'active' : '' }}">
                    <span class="nav-icon">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    </span>
                    <span class="flex-1">Verifikasi Izin/Sakit</span>
                </a>
            </nav>
        </div>
    </div>

    <!-- FOOTER USER SIDEBAR -->
    <div class="border-t border-white/10 p-3.5 flex items-center justify-between gap-2.5 bg-black/10 shrink-0">
        <div class="flex items-center gap-2.5 min-w-0">
            <div class="w-8 h-8 rounded-full bg-emerald-700/80 border border-emerald-500/30 flex items-center justify-center text-white text-[11px] font-semibold shrink-0">
                {{ substr(Auth::user()->nama ?? 'A', 0, 1) }}
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-[11.5px] font-semibold text-white truncate">{{ Auth::user()->nama ?? 'Asisten Praktikum' }}</p>
                <p class="text-[9.5px] text-emerald-200/60 truncate font-normal">Pengajar Praktikum</p>
            </div>
        </div>

        <form action="{{ route('logout') }}" method="POST" class="shrink-0">
            @csrf
            <button type="submit" class="w-8 h-8 rounded-lg border border-white/10 bg-white/5 hover:bg-rose-600/80 text-emerald-200 hover:text-white flex items-center justify-center transition-all" title="Keluar">
                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
            </button>
        </form>
    </div>
</aside>
