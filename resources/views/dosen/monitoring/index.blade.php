<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring Kehadiran | SIPRAK</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * { box-sizing: border-box; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f5f7f8;
            color: #23352f;
        }

        :root {
            --green-dark: #075c46;
            --green-deep: #064b3b;
            --green-main: #087f60;
            --green-light: #e8f5ef;
            --border: #e5ebe8;
        }

        .sidebar {
            background: var(--green-deep);
            color: #eaf4ef;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 12px;
            border-radius: 10px;
            font-size: 11.5px;
            font-weight: 500;
            color: #c4d7cf;
            transition: background .2s, color .2s;
        }

        .nav-link:hover {
            background: rgba(255,255,255,.08);
            color: white;
        }

        .nav-link.active {
            background: #e8f5ef !important;
            color: #075c46 !important;
            font-weight: 600;
        }

        .nav-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 30px;
            height: 30px;
            flex-shrink: 0;
            border-radius: 8px;
            background: rgba(255,255,255,.08);
            color: #c4d7cf;
        }

        .nav-link.active .nav-icon {
            background: #d2ebdf !important;
            color: #075c46 !important;
        }

        .surface {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 14px;
        }

        .field {
            width: 100%;
            border: 1px solid #e1e9e5;
            background: #fafcfb;
            border-radius: 9px;
            padding: 9px 12px;
            font-size: 12px;
            outline: none;
        }

        .field:focus {
            border-color: #70bda0;
            box-shadow: 0 0 0 3px rgba(8,127,96,.08);
        }

        .mobile-overlay { display: none; }

        @media (max-width: 767px) {
            .sidebar {
                position: fixed;
                inset: 0 auto 0 0;
                width: 250px;
                z-index: 50;
                transform: translateX(-100%);
                transition: transform .25s ease;
            }
            .sidebar.open { transform: translateX(0); }
            .mobile-overlay.show {
                display: block; position: fixed; inset: 0; z-index: 40; background: rgba(12,31,24,.4);
            }
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
                <img src="{{ asset('image/Logo-UINSSC.png') }}"
                     alt="Logo UINSSC"
                     class="w-full h-full object-contain"
                     onerror="this.onerror=null; this.src='https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Logo_UIN_Siber_Syekh_Nurjati_Cirebon.png/600px-Logo_UIN_Siber_Syekh_Nurjati_Cirebon.png';"
                >
            </div>

            <div class="min-w-0">
                <h1 class="text-[13.5px] font-bold text-white tracking-tight">SIPRAK</h1>
                <p class="text-[9.5px] text-emerald-200/80 font-normal mt-0.5">Dosen</p>
            </div>
        </div>

        <div class="px-3 pt-4 pb-2 flex-1 overflow-y-auto space-y-4">
            <div>
                <div class="flex justify-between items-center px-2 mb-2">
                    <span class="text-[9.5px] font-semibold tracking-wider text-emerald-200/60 uppercase">MENU UTAMA</span>
                </div>

                <nav class="space-y-1">
                    <!-- Dashboard -->
                    <a href="{{ route('dosen.dashboard') }}" class="nav-link">
                        <span class="nav-icon">
                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/></svg>
                        </span>
                        <span class="flex-1">Dashboard</span>
                    </a>

                    <!-- Pertemuan & Materi -->
                    <a href="{{ route('dosen.pertemuan.index') }}" class="nav-link">
                        <span class="nav-icon">
                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                        </span>
                        <span class="flex-1">Pertemuan &amp; Materi</span>
                    </a>

                    <!-- Monitoring Kehadiran (Hanya ini yang Active) -->
                    <a href="{{ route('dosen.monitoring.index') }}" class="nav-link active">
                        <span class="nav-icon">
                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        </span>
                        <span class="flex-1">Monitoring Kehadiran</span>
                    </a>

                    <!-- Laporan Presensi -->
                    <a href="{{ route('dosen.laporan.index') }}" class="nav-link">
                        <span class="nav-icon">
                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                        </span>
                        <span class="flex-1">Laporan Presensi</span>
                    </a>
                </nav>
            </div>
        </div>

        <!-- FOOTER SIDEBAR LOGOUT -->
        <div class="border-t border-white/10 p-3.5 flex items-center justify-between gap-2.5">
            <div class="flex items-center gap-2.5 min-w-0">
                <div class="w-8 h-8 rounded-full bg-emerald-700/80 border border-emerald-500/30 flex items-center justify-center text-white text-[11px] font-semibold shrink-0">
                    {{ substr(Auth::user()->nama ?? 'D', 0, 1) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-[11.5px] font-semibold text-white truncate">{{ Auth::user()->nama ?? 'Dr. Rina Amelia' }}</p>
                    <p class="text-[9.5px] text-emerald-200/60 truncate font-normal">Dosen</p>
                </div>
            </div>

            <form action="{{ route('logout') }}" method="POST" class="shrink-0">
                @csrf
                <button type="submit" class="w-8 h-8 rounded-lg border border-white/10 bg-white/5 hover:bg-rose-600/80 hover:border-rose-500 text-emerald-200 hover:text-white flex items-center justify-center transition-all" title="Keluar / Logout">
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                        <polyline points="16 17 21 12 16 7"/>
                        <line x1="21" y1="12" x2="9" y2="12"/>
                    </svg>
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN CONTENT AREA -->
    <div class="main-area ml-[250px] min-h-screen flex flex-col">

        <!-- TOPBAR -->
        <header class="bg-white border-b border-[#e5ebe8] sticky top-0 z-30">
            <div class="min-h-[72px] px-6 lg:px-8 flex items-center justify-between gap-4">
                <div class="flex items-center gap-3 min-w-0">
                    <button onclick="toggleSidebar()" class="md:hidden p-2 rounded-lg border border-slate-200" aria-label="Buka menu">
                        <svg class="w-5 h-5 text-slate-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>

                    <div class="text-xs flex flex-wrap items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-emerald-600"></span>
                        <span class="font-bold text-emerald-900">UIN SSC</span>
                        <span class="text-slate-300">/</span>
                        <span class="text-slate-500 font-medium">Monitoring Kehadiran</span>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <button class="p-2 text-slate-400 hover:text-emerald-700 transition relative">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
                        <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-emerald-600 rounded-full"></span>
                    </button>
                </div>
            </div>
        </header>

        <!-- PAGE CONTENT -->
        <main class="flex-1 px-6 py-6 lg:px-8 lg:py-8 space-y-6">

            <!-- HEADER TITLE -->
            <div>
                <h2 class="text-xl font-bold tracking-tight text-[#183c30]">Monitoring Kehadiran</h2>
                <p class="text-xs text-slate-500 mt-1">Pantau status presensi realtime per kelas dan pertemuan.</p>
            </div>

            <!-- FILTER BAR -->
            <div class="surface p-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-1">
                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider">MATA PRAKTIKUM &amp; KELAS</label>
                    <select class="field font-bold text-slate-800 text-xs py-2">
                        <option value="1">Pemrograman Web — Kelas A (Ganjil 2026/2027)</option>
                        <option value="2">Basis Data — Kelas B2 (Ganjil 2026/2027)</option>
                    </select>
                </div>

                <div class="space-y-1">
                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider">PERTEMUAN PRAKTIKUM</label>
                    <select class="field font-bold text-slate-800 text-xs py-2">
                        <option value="1">Pertemuan 1 — Pengenalan Praktikum</option>
                        <option value="2">Pertemuan 2 — Dasar HTML</option>
                        <option value="3">Pertemuan 3 — Dasar CSS</option>
                    </select>
                </div>
            </div>

            <!-- RINGKASAN REKAP PERTEMUAN -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                <div class="surface p-3.5 border-l-4 border-l-emerald-600">
                    <p class="text-[10px] font-semibold text-slate-400 uppercase">Hadir</p>
                    <p class="text-xl font-bold text-slate-800 mt-1">28 <span class="text-xs font-normal text-slate-400">/ 32</span></p>
                </div>
                <div class="surface p-3.5 border-l-4 border-l-amber-500">
                    <p class="text-[10px] font-semibold text-slate-400 uppercase">Terlambat</p>
                    <p class="text-xl font-bold text-slate-800 mt-1">2</p>
                </div>
                <div class="surface p-3.5 border-l-4 border-l-blue-500">
                    <p class="text-[10px] font-semibold text-slate-400 uppercase">Izin / Sakit</p>
                    <p class="text-xl font-bold text-slate-800 mt-1">1</p>
                </div>
                <div class="surface p-3.5 border-l-4 border-l-rose-500">
                    <p class="text-[10px] font-semibold text-slate-400 uppercase">Tanpa Keterangan</p>
                    <p class="text-xl font-bold text-slate-800 mt-1">1</p>
                </div>
            </div>

            <!-- TABEL DAFTAR MAHASISWA -->
            <div class="surface overflow-hidden">
                <div class="p-4 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                    <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wider">Status Presensi Mahasiswa</h3>
                    <input type="text" placeholder="Cari NIM atau nama..." class="field max-w-xs text-xs py-1.5">
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-xs">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-100 text-slate-500 font-bold uppercase text-[10px] tracking-wider">
                                <th class="p-3.5 pl-5">NIM</th>
                                <th class="p-3.5">Nama Mahasiswa</th>
                                <th class="p-3.5">Waktu Presensi</th>
                                <th class="p-3.5">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-slate-700">
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="p-3.5 pl-5 font-bold text-slate-800">2388010026</td>
                                <td class="p-3.5 font-medium">Macmunah</td>
                                <td class="p-3.5 text-slate-500">08:02 WIB</td>
                                <td class="p-3.5">
                                    <span class="px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 text-[10px] font-bold">Hadir</span>
                                </td>
                            </tr>
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="p-3.5 pl-5 font-bold text-slate-800">2388010002</td>
                                <td class="p-3.5 font-medium">Mahasiswa Contoh</td>
                                <td class="p-3.5 text-slate-500">08:18 WIB</td>
                                <td class="p-3.5">
                                    <span class="px-2.5 py-1 rounded-full bg-amber-50 text-amber-700 border border-amber-200 text-[10px] font-bold">Terlambat</span>
                                </td>
                            </tr>
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="p-3.5 pl-5 font-bold text-slate-800">135576957</td>
                                <td class="p-3.5 font-medium">Maya</td>
                                <td class="p-3.5 text-slate-500">—</td>
                                <td class="p-3.5">
                                    <span class="px-2.5 py-1 rounded-full bg-blue-50 text-blue-700 border border-blue-200 text-[10px] font-bold">Izin</span>
                                </td>
                            </tr>
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="p-3.5 pl-5 font-bold text-slate-800">64672736254284</td>
                                <td class="p-3.5 font-medium">Mahasiswa 64672736254284</td>
                                <td class="p-3.5 text-slate-500">—</td>
                                <td class="p-3.5">
                                    <span class="px-2.5 py-1 rounded-full bg-rose-50 text-rose-700 border border-rose-200 text-[10px] font-bold">Alpa</span>
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