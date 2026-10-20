<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap & Laporan | SIPRAK</title>

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

        .btn-primary {
            background: var(--green-dark);
            color: white;
            border-radius: 9px;
            padding: 9px 16px;
            font-size: 12px;
            font-weight: 600;
            transition: background .2s;
        }

        .btn-primary:hover {
            background: #064b3b;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            white-space: nowrap;
        }

        .data-table th {
            background: #f8faf9;
            color: #718078;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .045em;
            text-align: left;
            padding: 12px 16px;
            border-bottom: 1px solid var(--border);
        }

        .data-table td {
            padding: 13px 16px;
            border-bottom: 1px solid #edf1ef;
            font-size: 11.5px;
        }

        .data-table tbody tr:hover { background: #fbfdfc; }

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
                <p class="text-[9.5px] text-emerald-200/80 font-normal mt-0.5">Sistem Presensi Praktikum</p>
            </div>
        </div>

        <div class="px-3 pt-4 pb-2 flex-1 overflow-y-auto space-y-4">
            <div>
                <div class="flex justify-between items-center px-2 mb-2">
                    <span class="text-[9.5px] font-semibold tracking-wider text-emerald-200/60 uppercase">MENU UTAMA</span>
                    <span class="text-[8.5px] font-medium text-emerald-200/40 bg-white/5 px-1.5 py-0.5 rounded">ADMIN</span>
                </div>

                <nav class="space-y-1">
                    <a href="{{ url('/admin/dashboard?tab=master') }}" class="nav-link">
                        <span class="nav-icon">
                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="M3 9h18M9 9v11"/></svg>
                        </span>
                        <span class="flex-1">Data Master</span>
                    </a>

                    <a href="{{ route('admin.akademik.index') }}" class="nav-link">
                        <span class="nav-icon">
                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M3 21h18M5 21V8l7-5 7 5v13"/><path d="M9 11h1m4 0h1m-6 4h1m4 0h1"/></svg>
                        </span>
                        <span class="flex-1">Manajemen Akademik</span>
                    </a>

                    <a href="{{ route('admin.penugasan.index') }}" class="nav-link">
                        <span class="nav-icon">
                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><circle cx="9" cy="8" r="3"/><circle cx="17" cy="9" r="2.5"/><path d="M3 20v-2a6 6 0 0 1 12 0v2z"/><path d="M16 15a5 5 0 0 1 5 5"/></svg>
                        </span>
                        <span class="flex-1">Penugasan &amp; Mapping</span>
                    </a>

                    <a href="{{ route('admin.laporan.index') }}" class="nav-link active">
                        <span class="nav-icon">
                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M4 19V5m0 14h17"/><path d="M8 15l4-4 3 2 5-7"/></svg>
                        </span>
                        <span class="flex-1">Rekap &amp; Laporan</span>
                    </a>
                </nav>
            </div>

            <div>
                <div class="px-2 mb-2">
                    <span class="text-[9.5px] font-semibold tracking-wider text-emerald-200/60 uppercase">SISTEM</span>
                </div>
                <nav class="space-y-1">
                    <a href="{{ route('admin.users.index') }}" class="nav-link">
                        <span class="nav-icon">
                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><circle cx="12" cy="8" r="4"/><path d="M4 21v-2a8 8 0 0 1 16 0v2"/></svg>
                        </span>
                        <span class="flex-1">Kelola Akun Pengguna</span>
                    </a>
                </nav>
            </div>
        </div>

        <div class="border-t border-white/10 p-3.5 flex items-center justify-between gap-2.5">
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
                        <span class="text-slate-500 font-medium">Portal Laboratorium</span>
                        <span class="text-slate-300 hidden sm:inline">/</span>
                        <span class="hidden sm:inline px-2.5 py-0.5 rounded-full bg-emerald-50 border border-emerald-100 text-emerald-800 font-semibold text-[11px]">Rekap &amp; Laporan</span>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <div class="text-right hidden sm:block">
                        <p class="text-xs font-semibold text-slate-800 leading-tight">{{ Auth::user()->nama ?? 'Admin Lab' }}</p>
                        <p class="text-[10px] text-emerald-700 font-medium mt-0.5">Administrator</p>
                    </div>
                    <div class="w-8 h-8 rounded-full bg-[#075c46] text-white flex items-center justify-center font-semibold text-xs shadow-sm">
                        {{ substr(Auth::user()->nama ?? 'A', 0, 1) }}
                    </div>
                </div>
            </div>
        </header>

        <!-- PAGE CONTENT -->
        <main class="flex-1 px-6 py-6 lg:px-8 lg:py-8 space-y-6">

            <!-- HEADER TITLE -->
            <div class="surface p-5 flex items-start gap-4">
                <div class="w-10 h-10 rounded-xl bg-emerald-50 border border-emerald-200 flex items-center justify-center text-emerald-800 shrink-0">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                        <polyline points="14 2 14 8 20 8"/>
                        <line x1="16" y1="13" x2="8" y2="13"/>
                        <line x1="16" y1="17" x2="8" y2="17"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-slate-800">Rekap &amp; Laporan</h2>
                    <p class="text-xs text-slate-500 mt-0.5">Pantau kehadiran praktikum dan unduh laporan berdasarkan periode.</p>
                </div>
            </div>

            <!-- 1. FILTER LAPORAN FORM -->
            <section class="surface p-5 space-y-4">
                <h3 class="text-xs font-bold text-slate-800">1. Filter Laporan</h3>

                <form action="{{ route('admin.laporan.index') }}" method="GET" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[11px] font-semibold text-slate-600 mb-1">Semester</label>
                            <select name="semester" class="field">
                                <option value="Ganjil 2026/2027" {{ ($selectedSemester ?? '') == 'Ganjil 2026/2027' ? 'selected' : '' }}>Ganjil 2026/2027</option>
                                <option value="Genap 2025/2026" {{ ($selectedSemester ?? '') == 'Genap 2025/2026' ? 'selected' : '' }}>Genap 2025/2026</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-[11px] font-semibold text-slate-600 mb-1">Mata Praktikum</label>
                            <select name="mata_praktikum" class="field">
                                <option value="">Semua Mata Praktikum</option>
                                @foreach($mataPraktikum as $mk)
                                    <option value="{{ $mk->nama }}" {{ ($selectedMK ?? '') == $mk->nama ? 'selected' : '' }}>
                                        {{ $mk->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-[11px] font-semibold text-slate-600 mb-1">Kelas</label>
                            <select name="kelas" class="field">
                                <option value="">Semua Kelas</option>
                                @foreach($kelasPraktikum as $kp)
                                    <option value="{{ $kp->nama_kelas }}" {{ ($selectedKelas ?? '') == $kp->nama_kelas ? 'selected' : '' }}>
                                        Kelas {{ $kp->nama_kelas }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-[11px] font-semibold text-slate-600 mb-1">Periode</label>
                            <input type="text" name="periode" value="{{ $selectedPeriode ?? '01 Sep – 15 Okt 2026' }}" class="field">
                        </div>
                    </div>

                    <div class="flex justify-end gap-2 pt-2 border-t border-slate-100">
                        <a href="{{ route('admin.laporan.index') }}" class="px-4 py-2 rounded-lg border text-xs font-semibold text-slate-600 hover:bg-slate-50 transition">Reset</a>
                        <button type="submit" class="btn-primary">Terapkan Filter</button>
                    </div>
                </form>
            </section>

            <!-- 2. RINGKASAN PRESENSI STATS -->
            <section class="space-y-3">
                <h3 class="text-xs font-bold text-slate-800">2. Ringkasan Presensi</h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="surface p-4 flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-emerald-50 text-emerald-700 flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-semibold text-slate-400 uppercase tracking-wider">Total Pertemuan</p>
                            <p class="text-xl font-bold text-slate-800 mt-0.5">{{ $totalPertemuan ?? 48 }}</p>
                        </div>
                    </div>

                    <div class="surface p-4 flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-emerald-50 text-emerald-700 flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 6L9 17l-5-5"/></svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-semibold text-slate-400 uppercase tracking-wider">Hadir</p>
                            <p class="text-xl font-bold text-emerald-800 mt-0.5">{{ number_format($hadir ?? 1248, 0, ',', '.') }}</p>
                        </div>
                    </div>

                    <div class="surface p-4 flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-amber-50 text-amber-700 flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-semibold text-slate-400 uppercase tracking-wider">Izin / Sakit</p>
                            <p class="text-xl font-bold text-amber-800 mt-0.5">{{ $izin ?? 76 }}</p>
                        </div>
                    </div>

                    <div class="surface p-4 flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-rose-50 text-rose-700 flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-semibold text-slate-400 uppercase tracking-wider">Tidak Hadir</p>
                            <p class="text-xl font-bold text-rose-800 mt-0.5">{{ $tidakHadir ?? 112 }}</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- 3. GRAFIK RINGKASAN KEHADIRAN -->
            <section class="surface p-5 space-y-3">
                <h3 class="text-xs font-bold text-slate-800">3. Grafik Ringkasan Kehadiran</h3>
                <div class="h-48 bg-slate-50 border border-dashed border-slate-200 rounded-xl flex flex-col items-center justify-center text-slate-400 text-xs">
                    <svg class="w-8 h-8 text-slate-300 mb-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M18 20V10M12 20V4M6 20v-6"/></svg>
                    <span>Grafik Kehadiran {{ $selectedMK != '' ? "($selectedMK)" : 'Semua Praktikum' }} {{ $selectedKelas != '' ? "Kelas $selectedKelas" : '' }}</span>
                </div>
            </section>

            <!-- 4. DETAIL REKAP TABEL -->
            <section class="surface overflow-hidden">
                <div class="p-4 border-b border-[#edf1ef] flex justify-between items-center">
                    <div>
                        <h3 class="text-xs font-bold text-slate-800">4. Detail Rekap Kehadiran</h3>
                        <p class="text-[11px] text-slate-400 mt-0.5">Daftar presensi per mahasiswa berdasarkan filter yang dipilih.</p>
                    </div>
                    <button class="px-3 py-1.5 rounded-lg border border-slate-200 text-xs font-semibold text-slate-700 hover:bg-slate-50 inline-flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-emerald-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 3v12m-5-5 5 5 5-5"/><path d="M4 16v4h16v-4"/></svg>
                        Unduh Rekap PDF/CSV
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>NIM</th>
                                <th>NAMA MAHASISWA</th>
                                <th>MATA PRAKTIKUM</th>
                                <th>KELAS</th>
                                <th>HADIR</th>
                                <th>IZIN</th>
                                <th>ALPHA</th>
                                <th>PERSENTASE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="font-bold text-slate-600">12345</td>
                                <td class="font-semibold text-slate-800">Akun Uji Coba</td>
                                <td class="text-slate-700">{{ $selectedMK != '' ? $selectedMK : 'Pemrograman Web' }}</td>
                                <td><span class="px-2 py-0.5 rounded bg-emerald-50 border border-emerald-200 text-[10px] font-bold text-emerald-800">{{ $selectedKelas != '' ? $selectedKelas : 'B1' }}</span></td>
                                <td class="font-bold text-emerald-700">12</td>
                                <td class="text-amber-700">0</td>
                                <td class="text-rose-700">0</td>
                                <td><span class="px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800 font-bold text-[10px]">100%</span></td>
                            </tr>
                            <tr>
                                <td class="font-bold text-slate-600">1004</td>
                                <td class="font-semibold text-slate-800">Andi</td>
                                <td class="text-slate-700">{{ $selectedMK != '' ? $selectedMK : 'Metopen' }}</td>
                                <td><span class="px-2 py-0.5 rounded bg-emerald-50 border border-emerald-200 text-[10px] font-bold text-emerald-800">{{ $selectedKelas != '' ? $selectedKelas : '6A' }}</span></td>
                                <td class="font-bold text-emerald-700">10</td>
                                <td class="text-amber-700">1</td>
                                <td class="text-rose-700">1</td>
                                <td><span class="px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800 font-bold text-[10px]">83.3%</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

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