@php
    $currentActive = $active ?? 'master';
@endphp

<!-- BACKDROP MOBILE -->
<div id="sidebarBackdrop" onclick="toggleSidebar(false)" class="fixed inset-0 z-40 bg-slate-900/60 backdrop-blur-sm hidden md:hidden transition-opacity"></div>

<!-- LEFT SIDEBAR NAVIGATION (UIN SSC Cyber Islamic Dark Theme) -->
<aside id="mainSidebar" class="fixed md:sticky top-0 z-50 md:z-30 h-screen w-72 bg-gradient-to-b from-uin-dark via-uin-darkSurface to-[#050D11] text-slate-300 flex flex-col justify-between border-r border-uin-border/80 shadow-2xl transition-transform -translate-x-full md:translate-x-0 duration-300 ease-in-out">
    
    <!-- Header & Nav Links -->
    <div class="flex flex-col h-full overflow-y-auto">
        
        <!-- University & System Brand -->
        <div class="p-6 border-b border-uin-border/70 relative overflow-hidden">
            <!-- Background Glow -->
            <div class="absolute -right-10 -top-10 w-32 h-32 bg-uin-cyber/10 rounded-full blur-2xl pointer-events-none"></div>
            <div class="absolute -left-6 -bottom-6 w-24 h-24 bg-uin-sage/10 rounded-full blur-xl pointer-events-none"></div>

            <div class="flex items-start gap-3.5 relative z-10">
                <!-- UIN SSC Emblem Icon -->
                <div class="relative group">
                    <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-uin-forest via-uin-cyber to-emerald-600 flex items-center justify-center text-white shadow-lg shadow-uin-cyber/20 ring-1 ring-white/20">
                        <!-- SVG Stylized Mosque Dome + Cyber Layers + Book -->
                        <svg class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                        </svg>
                    </div>
                    <span class="absolute -top-1 -right-1 w-3 h-3 bg-uin-gold rounded-full border-2 border-uin-dark animate-pulse" title="Sistem Aktif"></span>
                </div>

                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-1.5">
                        <h1 class="font-bold text-white text-base leading-tight font-display tracking-tight">Presensi Praktikum</h1>
                    </div>
                    <p class="text-[11px] font-semibold text-emerald-400/90 tracking-wide mt-0.5">UIN Siber Syekh Nurjati</p>
                    <div class="inline-flex items-center gap-1 mt-1 px-2 py-0.5 rounded-full bg-uin-border/70 border border-uin-cyber/30 text-[9px] font-semibold text-uin-sageLight tracking-wider uppercase">
                        <span class="w-1.5 h-1.5 rounded-full bg-uin-cyber"></span>
                        Panel Admin
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Menu -->
        <nav class="p-4 space-y-1.5 flex-1">
            <div class="px-3 pt-2 pb-1 text-[10px] font-extrabold uppercase tracking-widest text-slate-400/80 flex items-center justify-between">
                <span>Menu Utama</span>
                <span class="text-[9px] text-uin-sage">v2.4 Siber</span>
            </div>

            <!-- 1. Data Master -->
            <a href="{{ route('admin.dashboard') }}" class="w-full flex items-center justify-between px-3.5 py-3 rounded-xl text-xs font-semibold transition-all duration-200 group {{ $currentActive === 'master' ? 'bg-gradient-to-r from-uin-forest to-uin-cyber text-white shadow-md shadow-uin-cyber/20 border border-emerald-400/20' : 'text-slate-300 hover:text-white hover:bg-uin-border/60' }}">
                <div class="flex items-center gap-3">
                    <div class="w-7 h-7 rounded-lg {{ $currentActive === 'master' ? 'bg-white/10' : 'bg-uin-border/50' }} flex items-center justify-center text-sm group-hover:scale-110 transition">
                        🗃️
                    </div>
                    <span class="{{ $currentActive === 'master' ? 'font-bold' : 'font-medium' }}">Data Master</span>
                </div>
                <span class="text-[10px] px-2 py-0.5 rounded-md {{ $currentActive === 'master' ? 'bg-white/20 text-white font-bold' : 'bg-slate-800 text-slate-400' }} font-mono">5 Sub</span>
            </a>

            <!-- 2. Manajemen Akademik -->
            <a href="{{ route('admin.mata_praktikum.index') }}" class="w-full flex items-center justify-between px-3.5 py-3 rounded-xl text-xs font-semibold transition-all duration-200 group {{ $currentActive === 'akademik' ? 'bg-gradient-to-r from-uin-forest to-uin-cyber text-white shadow-md shadow-uin-cyber/20 border border-emerald-400/20' : 'text-slate-300 hover:text-white hover:bg-uin-border/60' }}">
                <div class="flex items-center gap-3">
                    <div class="w-7 h-7 rounded-lg {{ $currentActive === 'akademik' ? 'bg-white/10' : 'bg-uin-border/50' }} flex items-center justify-center text-sm group-hover:scale-110 transition">
                        🏛️
                    </div>
                    <span class="{{ $currentActive === 'akademik' ? 'font-bold' : 'font-medium' }}">Manajemen Akademik</span>
                </div>
                <span class="text-[10px] px-1.5 py-0.5 rounded text-slate-400 group-hover:text-uin-cyber text-xs">→</span>
            </a>

            <!-- 3. Penugasan & Mapping Kelas -->
            <a href="{{ route('admin.penugasan.index') }}" class="w-full flex items-center justify-between px-3.5 py-3 rounded-xl text-xs font-semibold transition-all duration-200 group {{ $currentActive === 'penugasan' ? 'bg-gradient-to-r from-uin-forest to-uin-cyber text-white shadow-md shadow-uin-cyber/20 border border-emerald-400/20' : 'text-slate-300 hover:text-white hover:bg-uin-border/60' }}">
                <div class="flex items-center gap-3">
                    <div class="w-7 h-7 rounded-lg {{ $currentActive === 'penugasan' ? 'bg-white/10' : 'bg-uin-border/50' }} flex items-center justify-center text-sm group-hover:scale-110 transition">
                        👥
                    </div>
                    <span class="{{ $currentActive === 'penugasan' ? 'font-bold' : 'font-medium' }}">Penugasan & Mapping</span>
                </div>
                <span class="text-[10px] px-2 py-0.5 rounded-md bg-amber-500/20 text-amber-300 font-bold border border-amber-500/30">Plotting</span>
            </a>

            <!-- 4. Rekap & Laporan Master -->
            <a href="{{ route('admin.laporan.index') }}" class="w-full flex items-center justify-between px-3.5 py-3 rounded-xl text-xs font-semibold transition-all duration-200 group {{ $currentActive === 'laporan' ? 'bg-gradient-to-r from-uin-forest to-uin-cyber text-white shadow-md shadow-uin-cyber/20 border border-emerald-400/20' : 'text-slate-300 hover:text-white hover:bg-uin-border/60' }}">
                <div class="flex items-center gap-3">
                    <div class="w-7 h-7 rounded-lg {{ $currentActive === 'laporan' ? 'bg-white/10' : 'bg-uin-border/50' }} flex items-center justify-center text-sm group-hover:scale-110 transition">
                        📊
                    </div>
                    <span class="{{ $currentActive === 'laporan' ? 'font-bold' : 'font-medium' }}">Rekap & Laporan Master</span>
                </div>
                <span class="text-[10px] px-2 py-0.5 rounded-md bg-emerald-500/20 text-emerald-300 font-bold border border-emerald-500/30">Export</span>
            </a>

            <!-- Separator: Master User Data Management -->
            <div class="pt-5 pb-1 px-3 text-[10px] font-extrabold uppercase tracking-widest text-slate-400/80">
                Sistem & Autentikasi
            </div>

            <!-- 5. Kelola Akun Pengguna -->
            <a href="{{ route('admin.users.index') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-semibold transition-all duration-200 group {{ $currentActive === 'users' ? 'bg-gradient-to-r from-uin-forest to-uin-cyber text-white shadow-md shadow-uin-cyber/20 border border-emerald-400/20' : 'text-slate-400 hover:text-white hover:bg-uin-border/50' }}">
                <div class="flex items-center gap-3">
                    <div class="w-7 h-7 rounded-lg {{ $currentActive === 'users' ? 'bg-white/10' : 'bg-uin-border/40' }} flex items-center justify-center text-xs group-hover:scale-110 transition">
                        ⚙️
                    </div>
                    <span class="{{ $currentActive === 'users' ? 'font-bold text-white' : '' }}">Kelola Akun Pengguna</span>
                </div>
                <span class="text-[10px] px-2 py-0.5 rounded font-mono {{ $currentActive === 'users' ? 'bg-white/20 text-white font-bold' : 'text-slate-400 bg-uin-border/40' }}">CRUD</span>
            </a>
        </nav>

        <!-- UIN SSC Cyber Badge in Sidebar -->
        <div class="p-4 mx-4 mb-4 rounded-xl bg-gradient-to-br from-uin-forest/30 via-uin-darkSurface to-uin-dark border border-uin-cyber/20 text-xs">
            <div class="flex items-center gap-2 mb-1.5">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                <p class="font-bold text-white text-[11px] tracking-wide">Cyber Campus Network</p>
            </div>
            <p class="text-[10px] text-slate-400 leading-relaxed">
                Terhubung ke server presensi laboratorium kampus terpadu UIN Siber Cirebon.
            </p>
            <div class="mt-2.5 pt-2 border-t border-uin-border/60 flex items-center justify-between text-[10px]">
                <span class="text-uin-sage">Bendera UIN: #77815C</span>
                <span class="text-uin-cyber font-mono font-bold">ONLINE</span>
            </div>
        </div>

        <!-- Sidebar User Profile Footer -->
        <div class="p-4 border-t border-uin-border/70 bg-black/20">
            <div class="flex items-center justify-between gap-3">
                <div class="flex items-center gap-2.5 min-w-0">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-uin-emerald to-uin-cyber text-white flex items-center justify-center font-bold text-xs ring-2 ring-emerald-500/30 flex-shrink-0">
                        {{ substr(Auth::user()->nama ?? 'Admin', 0, 1) }}
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-xs font-bold text-white truncate leading-tight">{{ Auth::user()->nama ?? 'Administrator' }}</p>
                        <p class="text-[10px] text-uin-sage font-mono truncate">NIP: {{ Auth::user()->nip_nim ?? '1001' }}</p>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST" class="flex-shrink-0">
                    @csrf
                    <button type="submit" title="Keluar dari sistem" class="p-2 rounded-lg bg-uin-border/60 hover:bg-rose-900/40 text-slate-400 hover:text-rose-300 transition border border-uin-border/60">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>

    </div>
</aside>
