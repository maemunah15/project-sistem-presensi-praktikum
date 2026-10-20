<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Asprak | SIPRAK</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * { box-sizing: border-box; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f5f7f8; color: #23352f; }
        :root { --green-dark: #075c46; --green-deep: #064b3b; --green-main: #087f60; --green-light: #e8f5ef; --border: #e5ebe8; }
        .sidebar { background: var(--green-deep); color: #eaf4ef; }
        .nav-link { display: flex; align-items: center; gap: 10px; padding: 10px 14px; border-radius: 10px; font-size: 12px; font-weight: 500; color: #c4d7cf; transition: background .2s, color .2s; }
        .nav-link:hover { background: rgba(255,255,255,.08); color: white; }
        .nav-link.active { background: #e8f5ef !important; color: #075c46 !important; font-weight: 600; }
        .nav-icon { display: flex; align-items: center; justify-content: center; width: 22px; height: 22px; shrink-0; }
        .surface { background: #fff; border: 1px solid var(--border); border-radius: 14px; }
        .btn-primary { background: var(--green-dark); color: white; border-radius: 9px; padding: 8px 14px; font-size: 11.5px; font-weight: 600; transition: background .2s; }
        .btn-primary:hover { background: #064b3b; }
        .mobile-overlay { display: none; }
        @media (max-width: 767px) {
            .sidebar { position: fixed; inset: 0 auto 0 0; width: 250px; z-index: 50; transform: translateX(-100%); transition: transform .25s ease; }
            .sidebar.open { transform: translateX(0); }
            .mobile-overlay.show { display: block; position: fixed; inset: 0; z-index: 40; background: rgba(12,31,24,.4); }
            .main-area { margin-left: 0 !important; }
        }
    </style>
</head>

<body class="min-h-screen">

<div id="mobileOverlay" class="mobile-overlay" onclick="toggleSidebar()"></div>

<div class="min-h-screen">

    <!-- SIDEBAR NAVIGATION -->
    <aside id="sidebar" class="sidebar fixed inset-y-0 left-0 w-[250px] flex flex-col z-50">
        <div class="h-[80px] px-5 flex items-center gap-3 border-b border-white/10">
            <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center p-1.5 shrink-0 shadow-sm">
                <img src="{{ asset('image/Logo-UINSSC.png') }}" alt="Logo UINSSC" class="w-full h-full object-contain" onerror="this.onerror=null; this.src='https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Logo_UIN_Siber_Syekh_Nurjati_Cirebon.png/600px-Logo_UIN_Siber_Syekh_Nurjati_Cirebon.png';">
            </div>
            <div class="min-w-0">
                <h1 class="text-[13.5px] font-bold text-white tracking-tight">SIPRAK</h1>
                <p class="text-[9.5px] text-emerald-200/80 font-normal mt-0.5">Sistem Presensi Praktikum</p>
            </div>
        </div>

        <div class="px-3 pt-4 pb-2 flex-1 overflow-y-auto space-y-1">
            <!-- 1. Dashboard (ACTIVE) -->
            <a href="{{ route('asprak.dashboard') }}" class="nav-link active">
                <span class="nav-icon">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                </span>
                <span class="flex-1">Dashboard</span>
            </a>

            <!-- 2. Sesi Presensi -->
            <a href="{{ route('asprak.sesi.index') }}" class="nav-link">
                <span class="nav-icon">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                </span>
                <span class="flex-1">Sesi Presensi</span>
            </a>

            <!-- 3. Monitoring Presensi -->
            <a href="{{ route('asprak.monitoring.index') }}" class="nav-link">
                <span class="nav-icon">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </span>
                <span class="flex-1">Monitoring Presensi</span>
            </a>

            <!-- 4. Verifikasi Izin/Sakit -->
            <a href="{{ route('asprak.verifikasi.index') }}" class="nav-link">
                <span class="nav-icon">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                </span>
                <span class="flex-1">Verifikasi Izin/Sakit</span>
            </a>
        </div>

        <!-- FOOTER USER SIDEBAR -->
        <div class="border-t border-white/10 p-3.5 flex items-center justify-between gap-2.5">
            <div class="flex items-center gap-2.5 min-w-0">
                <div class="w-8 h-8 rounded-full bg-emerald-700/80 border border-emerald-500/30 flex items-center justify-center text-white text-[11px] font-semibold shrink-0">
                    A
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

    <!-- MAIN AREA -->
    <div class="main-area ml-[250px] min-h-screen flex flex-col">

        <!-- TOPBAR HEADER -->
        <header class="bg-white border-b border-[#e5ebe8] sticky top-0 z-30">
            <div class="min-h-[64px] px-6 lg:px-8 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <button onclick="toggleSidebar()" class="md:hidden p-2 rounded-lg border border-slate-200">
                        <svg class="w-5 h-5 text-slate-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                </div>

                <div class="flex items-center gap-3">
                    <button class="p-2 text-slate-400 hover:text-emerald-700 relative">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
                        <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-rose-500 rounded-full"></span>
                    </button>

                    <div class="flex items-center gap-2 border-l border-slate-100 pl-3">
                        <div class="w-7 h-7 rounded-full bg-emerald-800 text-white font-bold text-xs flex items-center justify-center">A</div>
                        <span class="text-xs font-semibold text-slate-700">Asisten Praktikum</span>
                    </div>
                </div>
            </div>
        </header>

        <!-- PAGE CONTENT -->
        <main class="flex-1 px-6 py-6 lg:px-8 space-y-6">

            <!-- PAGE TITLE -->
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-bold tracking-tight text-[#183c30]">Dashboard Asprak</h2>
                    <p class="text-xs text-slate-500 mt-0.5">Kelola sesi dan pantau kehadiran praktikum hari ini.</p>
                </div>

                <div class="surface px-3 py-1.5 flex items-center gap-2 text-xs font-semibold text-slate-600">
                    <svg class="w-3.5 h-3.5 text-emerald-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    <span>Senin, 19 Oktober 2026</span>
                </div>
            </div>

            <!-- SECTION 1: SESI PRAKTIKUM HARI INI -->
            <div class="surface p-5 space-y-4">
                <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wider">Sesi Praktikum Hari Ini</h3>
                    </div>
                    <a href="{{ route('asprak.sesi.index') }}" class="text-xs font-semibold text-emerald-700 hover:underline flex items-center gap-1">Lihat Semua →</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-xs">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-100 text-slate-400 font-bold uppercase text-[10px]">
                                <th class="p-3 pl-4">No</th>
                                <th class="p-3">Mata Praktikum</th>
                                <th class="p-3">Kelas</th>
                                <th class="p-3">Waktu</th>
                                <th class="p-3">Ruang</th>
                                <th class="p-3">Status</th>
                                <th class="p-3 text-right pr-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-slate-700">
                            <tr>
                                <td class="p-3 pl-4 font-semibold text-slate-400">1</td>
                                <td class="p-3 font-bold text-slate-800">
                                    Pemrograman Web
                                    <span class="block text-[10px] font-normal text-slate-400">Kelas A</span>
                                </td>
                                <td class="p-3 font-medium">A</td>
                                <td class="p-3">10.00 – 12.00</td>
                                <td class="p-3">Lab Komputer 2</td>
                                <td class="p-3">
                                    <span class="px-2.5 py-1 rounded-full bg-amber-50 text-amber-700 border border-amber-200 text-[10px] font-semibold">Belum dimulai</span>
                                </td>
                                <td class="p-3 text-right pr-4">
                                    <a href="{{ route('asprak.sesi.index') }}" class="btn-primary inline-flex items-center gap-1">
                                        <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="5 3 19 12 5 21 5 3"/></svg>
                                        Buka Sesi Presensi
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-3 pl-4 font-semibold text-slate-400">2</td>
                                <td class="p-3 font-bold text-slate-800">
                                    Basis Data
                                    <span class="block text-[10px] font-normal text-slate-400">Kelas B</span>
                                </td>
                                <td class="p-3 font-medium">B</td>
                                <td class="p-3">13.00 – 15.00</td>
                                <td class="p-3">Lab Komputer 1</td>
                                <td class="p-3">
                                    <span class="px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 text-[10px] font-semibold">Selesai</span>
                                </td>
                                <td class="p-3 text-right pr-4">
                                    <button class="px-3 py-1.5 rounded-lg border border-slate-200 text-slate-600 font-semibold hover:bg-slate-50 transition">Lihat Detail</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- SECTION 2: RINGKASAN KEHADIRAN AKTIF -->
            <div class="surface p-5 space-y-4">
                <div class="flex items-center gap-2 border-b border-slate-100 pb-3">
                    <svg class="w-4 h-4 text-emerald-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                    <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wider">Ringkasan Kehadiran Aktif</h3>
                </div>

                <div class="p-4 bg-slate-50 rounded-xl border border-slate-100 flex flex-col md:flex-row items-center justify-between gap-6">
                    <div class="space-y-1 text-center md:text-left">
                        <span class="px-2.5 py-0.5 rounded-full bg-emerald-100 text-emerald-800 text-[10px] font-bold inline-block mb-1">● Sesi Aktif</span>
                        <h4 class="text-sm font-bold text-slate-800">Pemrograman Web — Kelas A</h4>
                        <div class="flex flex-wrap items-center justify-center md:justify-start gap-3 text-xs text-slate-400 pt-1">
                            <span>📅 Senin, 19 Oktober 2026</span>
                            <span>⏰ 10.00 – 12.00</span>
                            <span>📍 Lab Komputer 2</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-8">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center font-bold">
                                👤
                            </div>
                            <div>
                                <p class="text-xl font-bold text-slate-800">24</p>
                                <p class="text-[10px] text-slate-400">Hadir (dari 32 Mhs)</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-slate-200 text-slate-600 flex items-center justify-center font-bold">
                                👤
                            </div>
                            <div>
                                <p class="text-xl font-bold text-slate-800">8</p>
                                <p class="text-[10px] text-slate-400">Belum Presensi</p>
                            </div>
                        </div>

                        <div class="text-center pl-4 border-l border-slate-200">
                            <p class="text-2xl font-bold text-emerald-800">75%</p>
                            <p class="text-[10px] text-slate-400 font-semibold">Kehadiran</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECTION 3: PENGAJUAN IZIN/SAKIT MENUNGGU VERIFIKASI -->
            <div class="surface p-5 space-y-4">
                <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wider">Pengajuan Izin/Sakit Menunggu Verifikasi</h3>
                    </div>
                    <a href="{{ route('asprak.verifikasi.index') }}" class="text-xs font-semibold text-emerald-700 hover:underline flex items-center gap-1">Lihat Semua →</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-xs">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-100 text-slate-400 font-bold uppercase text-[10px]">
                                <th class="p-3 pl-4">No</th>
                                <th class="p-3">Nama Mahasiswa</th>
                                <th class="p-3">NIM</th>
                                <th class="p-3">Kelas</th>
                                <th class="p-3">Pertemuan</th>
                                <th class="p-3">Alasan</th>
                                <th class="p-3">Bukti</th>
                                <th class="p-3">Tanggal Pengajuan</th>
                                <th class="p-3 text-right pr-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-slate-700">
                            <tr>
                                <td class="p-3 pl-4 font-semibold text-slate-400">1</td>
                                <td class="p-3 font-bold text-slate-800">Siti Nurhaliza</td>
                                <td class="p-3 text-slate-500">2026110012</td>
                                <td class="p-3">Pemrograman Web Kelas A</td>
                                <td class="p-3">Pertemuan 5</td>
                                <td class="p-3">
                                    <span class="px-2 py-0.5 rounded bg-amber-50 text-amber-700 border border-amber-200 text-[10px] font-semibold">Sakit (demam)</span>
                                </td>
                                <td class="p-3">
                                    <a href="#" class="text-emerald-700 hover:underline flex items-center gap-1 font-semibold">
                                        📄 surat-dokter.pdf
                                    </a>
                                </td>
                                <td class="p-3 text-slate-400">19 Okt 2026 08:45</td>
                                <td class="p-3 text-right pr-4 space-x-1">
                                    <button onclick="alert('Pengajuan Ditolak')" class="px-2.5 py-1 bg-rose-600 text-white font-semibold rounded-lg hover:bg-rose-700">✕ Tolak</button>
                                    <button onclick="alert('Pengajuan Disetujui')" class="px-2.5 py-1 bg-emerald-700 text-white font-semibold rounded-lg hover:bg-emerald-800">✓ Setujui</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <footer class="pt-4 pb-2">
                <p class="text-[10px] text-slate-400">© {{ date('Y') }} SIPRAK · UIN Siber Syekh Nurjati Cirebon</p>
            </footer>

        </main>
    </div>
</div>

<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('open');
        document.getElementById('mobileOverlay').classList.toggle('show');
    }
</script>

</body>
</html>