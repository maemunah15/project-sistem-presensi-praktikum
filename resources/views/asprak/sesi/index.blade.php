<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sesi Presensi Aktif | SIPRAK</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet">

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
        .font-mono { font-family: 'JetBrains Mono', monospace; }
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
    @include('partials.asprak-sidebar', ['active' => 'sesi'])

    <!-- MAIN AREA -->
    <div class="main-area ml-[250px] min-h-screen flex flex-col">

        <!-- TOPBAR HEADER -->
        <header class="bg-white border-b border-[#e5ebe8] sticky top-0 z-30">
            <div class="min-h-[64px] px-6 lg:px-8 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <button onclick="toggleSidebar()" class="md:hidden p-2 rounded-lg border border-slate-200">
                        <svg class="w-5 h-5 text-slate-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    <div class="text-xs flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-emerald-600"></span>
                        <span class="font-bold text-emerald-900">UIN SSC</span>
                        <span class="text-slate-300">/</span>
                        <span class="text-slate-500 font-medium">Asisten Praktikum</span>
                        <span class="text-slate-300 hidden sm:inline">/</span>
                        <span class="hidden sm:inline px-2.5 py-0.5 rounded-full bg-emerald-50 border border-emerald-100 text-emerald-800 font-semibold text-[11px]">Sesi Presensi Aktif</span>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <a href="{{ route('asprak.dashboard') }}" class="px-3 py-1.5 rounded-lg border border-slate-200 text-slate-600 hover:bg-slate-50 text-xs font-semibold inline-flex items-center gap-1.5 transition">
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                        <span>Kembali ke Dashboard</span>
                    </a>
                </div>
            </div>
        </header>

        <!-- PAGE CONTENT -->
        <main class="flex-1 px-6 py-6 lg:px-8 space-y-6">

            <!-- BANNER STATUS SESI AKTIF -->
            <div class="surface p-5 bg-gradient-to-r from-emerald-900 to-[#075c46] text-white shadow-md flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div class="space-y-1.5">
                    <div class="flex flex-wrap items-center gap-2.5">
                        <span class="px-3 py-1 rounded-full bg-emerald-500/20 border border-emerald-300/30 text-emerald-200 text-xs font-bold inline-flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                            SESI PRESENSI AKTIF &amp; BERJALAN
                        </span>
                        <span class="text-xs text-emerald-200 font-medium">Kode Sesi: #SP-20261022-01</span>
                    </div>
                    <h2 class="text-xl sm:text-2xl font-extrabold tracking-tight">Pemrograman Web — Kelas A</h2>
                    <p class="text-xs text-emerald-100/80">
                        Pertemuan 5 · Materi: <span class="font-semibold text-white">Integrasi RESTful API &amp; Autentikasi JWT</span> · Lab Komputer 2
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-3 self-stretch md:self-auto">
                    <div class="px-4 py-2.5 rounded-xl bg-white/10 backdrop-blur-sm border border-white/20 text-center">
                        <p class="text-[10px] uppercase tracking-wider text-emerald-200 font-medium">Sisa Waktu Sesi</p>
                        <p class="text-lg font-bold font-mono text-white mt-0.5" id="sessionCountdown">01:42:15</p>
                    </div>
                    <button onclick="confirmCloseSession()" class="px-4 py-2.5 rounded-xl bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold shadow-md inline-flex items-center justify-center gap-2 transition cursor-pointer">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><rect x="9" y="9" width="6" height="6"/></svg>
                        <span>Tutup Sesi Sekarang</span>
                    </button>
                </div>
            </div>

            <!-- TWO COLUMN MAIN GRID: QR CODE (KIRI) vs LIVE FEED MAHASISWA (KANAN) -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

                <!-- KOLOM KIRI: TAMPILAN QR CODE DINAMIS & PROYEKTOR (5 COLS) -->
                <div class="lg:col-span-5 space-y-4">
                    <section class="surface p-6 flex flex-col items-center text-center shadow-sm relative overflow-hidden" id="qrContainer">
                        <div class="w-full flex items-center justify-between pb-4 border-b border-slate-100">
                            <span class="text-xs font-bold text-slate-700 uppercase tracking-wider flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-emerald-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                                QR Code Presensi Dinamis
                            </span>
                            <span class="text-[11px] font-semibold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-md border border-emerald-200">
                                Rotasi: 30 Detik
                            </span>
                        </div>

                        <!-- QR IMAGE BOX -->
                        <div class="my-6 p-4 rounded-2xl bg-white border-2 border-emerald-600/30 shadow-lg relative group">
                            <img id="qrImage" 
                                 src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=SIPRAK-PW-A-20261022-KEY847192" 
                                 alt="QR Code Presensi" 
                                 class="w-56 h-56 sm:w-64 sm:h-64 object-contain transition duration-300">
                            
                            <!-- Scanner Animation Overlay -->
                            <div class="absolute inset-x-4 h-1 bg-gradient-to-r from-transparent via-emerald-500 to-transparent animate-pulse top-10 pointer-events-none"></div>
                        </div>

                        <!-- DYNAMIC TOKEN BADGE -->
                        <div class="space-y-2 w-full">
                            <p class="text-[11px] text-slate-500 font-medium">Minta mahasiswa memindai kode di atas melalui aplikasi SIPRAK.</p>
                            
                            <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-200 flex items-center justify-between font-mono text-xs text-slate-700">
                                <span class="text-slate-400 text-[10px]">PAYLOAD TOKEN:</span>
                                <span class="font-bold text-emerald-800" id="tokenDisplay">SIPRAK-PW-A-TOKEN-784912</span>
                            </div>

                            <!-- COUNTDOWN PROGRESS BAR ROTASI QR -->
                            <div class="space-y-1 pt-2">
                                <div class="flex justify-between text-[11px] font-semibold">
                                    <span class="text-slate-500">Pergantian QR Otomatis (Anti-Joki):</span>
                                    <span class="text-emerald-700 font-bold" id="qrTimerText">30 detik</span>
                                </div>
                                <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden">
                                    <div id="qrProgressBar" class="bg-[#075c46] h-full transition-all duration-1000 ease-linear" style="width: 100%;"></div>
                                </div>
                            </div>
                        </div>

                        <!-- ACTIONS: FULLSCREEN & REFRESH -->
                        <div class="grid grid-cols-2 gap-2 w-full pt-4 mt-4 border-t border-slate-100">
                            <button onclick="toggleFullscreen()" class="px-3 py-2 rounded-xl border border-slate-200 hover:bg-slate-50 text-slate-700 text-xs font-semibold inline-flex items-center justify-center gap-1.5 transition cursor-pointer">
                                <svg class="w-4 h-4 text-slate-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"/></svg>
                                <span>Layar Penuh Proyektor</span>
                            </button>

                            <button onclick="refreshQRCode()" class="px-3 py-2 rounded-xl bg-emerald-50 hover:bg-emerald-100 border border-emerald-200 text-emerald-800 text-xs font-semibold inline-flex items-center justify-center gap-1.5 transition cursor-pointer">
                                <svg class="w-4 h-4 text-emerald-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 4 23 10 17 10"/><polyline points="1 20 1 14 7 14"/><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"/></svg>
                                <span>Perbarui QR Manual</span>
                            </button>
                        </div>
                    </section>
                </div>

                <!-- KOLOM KANAN: REAL-TIME ATTENDANCE FEED & STATUS (7 COLS) -->
                <div class="lg:col-span-7 space-y-4">
                    
                    <!-- 3 STATS SUMMARY -->
                    <div class="grid grid-cols-3 gap-3">
                        <div class="surface p-4 shadow-xs">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Hadir Terverifikasi</p>
                            <p class="text-2xl font-extrabold text-emerald-800 mt-0.5">24 <span class="text-xs font-normal text-slate-400">/ 32 Mhs</span></p>
                            <span class="text-[10px] font-semibold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full inline-block mt-1">75% Kehadiran</span>
                        </div>

                        <div class="surface p-4 shadow-xs">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Belum Presensi</p>
                            <p class="text-2xl font-extrabold text-rose-700 mt-0.5">8 <span class="text-xs font-normal text-slate-400">Mhs</span></p>
                            <span class="text-[10px] font-semibold text-rose-700 bg-rose-50 px-2 py-0.5 rounded-full inline-block mt-1">Belum Scan</span>
                        </div>

                        <div class="surface p-4 shadow-xs">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Izin / Sakit</p>
                            <p class="text-2xl font-extrabold text-amber-700 mt-0.5">0 <span class="text-xs font-normal text-slate-400">Mhs</span></p>
                            <span class="text-[10px] font-semibold text-slate-500 bg-slate-100 px-2 py-0.5 rounded-full inline-block mt-1">Nihil</span>
                        </div>
                    </div>

                    <!-- TABEL FEED MAHASISWA -->
                    <section class="surface overflow-hidden shadow-sm flex flex-col">
                        <div class="p-4 border-b border-[#edf1ef] flex flex-col sm:flex-row sm:items-center justify-between gap-3 bg-white">
                            <div class="flex items-center gap-2">
                                <button onclick="switchTab('hadir')" id="tabHadirBtn" class="px-3.5 py-1.5 rounded-lg text-xs font-bold bg-[#075c46] text-white shadow-xs transition">
                                    Mahasiswa Hadir (24)
                                </button>
                                <button onclick="switchTab('belum')" id="tabBelumBtn" class="px-3.5 py-1.5 rounded-lg text-xs font-semibold bg-slate-100 text-slate-600 hover:bg-slate-200 transition">
                                    Belum Scan (8)
                                </button>
                            </div>

                            <div class="relative w-full sm:w-56">
                                <input type="text" id="searchInput" oninput="filterAttendanceList()" placeholder="Cari nama / NIM..." class="w-full pl-8 pr-3 py-1.5 text-xs rounded-lg border border-slate-200 outline-none focus:ring-2 focus:ring-emerald-500">
                                <svg class="w-3.5 h-3.5 text-slate-400 absolute left-2.5 top-2.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
                            </div>
                        </div>

                        <!-- TAB 1: MAHASISWA HADIR -->
                        <div id="tabHadirContent" class="overflow-x-auto max-h-[380px] overflow-y-auto">
                            <table class="w-full text-left border-collapse text-xs">
                                <thead class="sticky top-0 bg-[#fafcfb] border-b border-slate-100 text-slate-400 font-bold uppercase text-[10px]">
                                    <tr>
                                        <th class="p-3 pl-4">NIM</th>
                                        <th class="p-3">Nama Mahasiswa</th>
                                        <th class="p-3">Waktu Masuk</th>
                                        <th class="p-3">Metode</th>
                                        <th class="p-3 text-right pr-4">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 text-slate-700" id="hadirListBody">
                                    <tr class="mhs-row">
                                        <td class="p-3 pl-4 font-mono font-bold text-slate-700">2026110001</td>
                                        <td class="p-3 font-semibold text-slate-800">Ahmad Rifai</td>
                                        <td class="p-3 text-slate-500 font-mono">10:04:12 WIB</td>
                                        <td class="p-3"><span class="px-2 py-0.5 rounded bg-slate-100 text-[10px] font-semibold">Scan QR</span></td>
                                        <td class="p-3 text-right pr-4">
                                            <span class="px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-800 border border-emerald-200 text-[10px] font-bold">Hadir</span>
                                        </td>
                                    </tr>
                                    <tr class="mhs-row">
                                        <td class="p-3 pl-4 font-mono font-bold text-slate-700">2026110002</td>
                                        <td class="p-3 font-semibold text-slate-800">Annisa Rahmawati</td>
                                        <td class="p-3 text-slate-500 font-mono">10:05:30 WIB</td>
                                        <td class="p-3"><span class="px-2 py-0.5 rounded bg-slate-100 text-[10px] font-semibold">Scan QR</span></td>
                                        <td class="p-3 text-right pr-4">
                                            <span class="px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-800 border border-emerald-200 text-[10px] font-bold">Hadir</span>
                                        </td>
                                    </tr>
                                    <tr class="mhs-row">
                                        <td class="p-3 pl-4 font-mono font-bold text-slate-700">2026110003</td>
                                        <td class="p-3 font-semibold text-slate-800">Budi Santoso</td>
                                        <td class="p-3 text-slate-500 font-mono">10:07:05 WIB</td>
                                        <td class="p-3"><span class="px-2 py-0.5 rounded bg-slate-100 text-[10px] font-semibold">Scan QR</span></td>
                                        <td class="p-3 text-right pr-4">
                                            <span class="px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-800 border border-emerald-200 text-[10px] font-bold">Hadir</span>
                                        </td>
                                    </tr>
                                    <tr class="mhs-row">
                                        <td class="p-3 pl-4 font-mono font-bold text-slate-700">2026110004</td>
                                        <td class="p-3 font-semibold text-slate-800">Dewi Sartika</td>
                                        <td class="p-3 text-slate-500 font-mono">10:09:44 WIB</td>
                                        <td class="p-3"><span class="px-2 py-0.5 rounded bg-slate-100 text-[10px] font-semibold">Scan QR</span></td>
                                        <td class="p-3 text-right pr-4">
                                            <span class="px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-800 border border-emerald-200 text-[10px] font-bold">Hadir</span>
                                        </td>
                                    </tr>
                                    <tr class="mhs-row">
                                        <td class="p-3 pl-4 font-mono font-bold text-slate-700">2026110005</td>
                                        <td class="p-3 font-semibold text-slate-800">Fajar Nugraha</td>
                                        <td class="p-3 text-slate-500 font-mono">10:11:18 WIB</td>
                                        <td class="p-3"><span class="px-2 py-0.5 rounded bg-slate-100 text-[10px] font-semibold">Scan QR</span></td>
                                        <td class="p-3 text-right pr-4">
                                            <span class="px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-800 border border-emerald-200 text-[10px] font-bold">Hadir</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- TAB 2: MAHASISWA BELUM SCAN -->
                        <div id="tabBelumContent" class="overflow-x-auto max-h-[380px] overflow-y-auto hidden">
                            <table class="w-full text-left border-collapse text-xs">
                                <thead class="sticky top-0 bg-[#fafcfb] border-b border-slate-100 text-slate-400 font-bold uppercase text-[10px]">
                                    <tr>
                                        <th class="p-3 pl-4">NIM</th>
                                        <th class="p-3">Nama Mahasiswa</th>
                                        <th class="p-3">Status</th>
                                        <th class="p-3 text-right pr-4">Aksi Manual</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 text-slate-700">
                                    <tr class="mhs-row">
                                        <td class="p-3 pl-4 font-mono font-bold text-slate-700">2026110025</td>
                                        <td class="p-3 font-semibold text-slate-800">Muhammad Zaki</td>
                                        <td class="p-3"><span class="px-2.5 py-0.5 rounded-full bg-rose-50 text-rose-700 border border-rose-200 text-[10px] font-semibold">Belum Masuk</span></td>
                                        <td class="p-3 text-right pr-4">
                                            <button onclick="manualAttendance('Muhammad Zaki', this)" class="px-2.5 py-1 rounded-lg bg-emerald-50 hover:bg-emerald-600 text-emerald-800 hover:text-white border border-emerald-200 text-xs font-semibold transition cursor-pointer">
                                                + Hadirkan Manual
                                            </button>
                                        </td>
                                    </tr>
                                    <tr class="mhs-row">
                                        <td class="p-3 pl-4 font-mono font-bold text-slate-700">2026110026</td>
                                        <td class="p-3 font-semibold text-slate-800">Nabila Putri</td>
                                        <td class="p-3"><span class="px-2.5 py-0.5 rounded-full bg-rose-50 text-rose-700 border border-rose-200 text-[10px] font-semibold">Belum Masuk</span></td>
                                        <td class="p-3 text-right pr-4">
                                            <button onclick="manualAttendance('Nabila Putri', this)" class="px-2.5 py-1 rounded-lg bg-emerald-50 hover:bg-emerald-600 text-emerald-800 hover:text-white border border-emerald-200 text-xs font-semibold transition cursor-pointer">
                                                + Hadirkan Manual
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </section>
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

    // 1. DYNAMIC QR CODE ROTATION (INTERVAL 30 DETIK)
    let secondsLeft = 30;
    const intervalSec = 30;

    function refreshQRCode() {
        const randomHash = Math.random().toString(36).substring(2, 8).toUpperCase();
        const newToken = `SIPRAK-PW-A-TOKEN-${randomHash}`;
        
        document.getElementById('tokenDisplay').innerText = newToken;
        document.getElementById('qrImage').src = `https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=${encodeURIComponent(newToken)}`;
        
        secondsLeft = intervalSec;
        updateProgressBar();
    }

    function updateProgressBar() {
        const percent = (secondsLeft / intervalSec) * 100;
        const bar = document.getElementById('qrProgressBar');
        const text = document.getElementById('qrTimerText');
        if (bar) bar.style.width = `${percent}%`;
        if (text) text.innerText = `${secondsLeft} detik`;
    }

    setInterval(() => {
        secondsLeft--;
        if (secondsLeft <= 0) {
            refreshQRCode();
        } else {
            updateProgressBar();
        }
    }, 1000);

    // 2. FULLSCREEN PROYEKTOR MODE
    function toggleFullscreen() {
        const elem = document.getElementById('qrContainer');
        if (!document.fullscreenElement) {
            elem.requestFullscreen().catch(err => alert(`Error fullscreen: ${err.message}`));
        } else {
            document.exitFullscreen();
        }
    }

    // 3. TAB SWITCHING
    function switchTab(tab) {
        const hadirBtn = document.getElementById('tabHadirBtn');
        const belumBtn = document.getElementById('tabBelumBtn');
        const hadirContent = document.getElementById('tabHadirContent');
        const belumContent = document.getElementById('tabBelumContent');

        if (tab === 'hadir') {
            hadirBtn.className = "px-3.5 py-1.5 rounded-lg text-xs font-bold bg-[#075c46] text-white shadow-xs transition";
            belumBtn.className = "px-3.5 py-1.5 rounded-lg text-xs font-semibold bg-slate-100 text-slate-600 hover:bg-slate-200 transition";
            hadirContent.classList.remove('hidden');
            belumContent.classList.add('hidden');
        } else {
            belumBtn.className = "px-3.5 py-1.5 rounded-lg text-xs font-bold bg-[#075c46] text-white shadow-xs transition";
            hadirBtn.className = "px-3.5 py-1.5 rounded-lg text-xs font-semibold bg-slate-100 text-slate-600 hover:bg-slate-200 transition";
            belumContent.classList.remove('hidden');
            hadirContent.classList.add('hidden');
        }
    }

    // 4. MANUAL ATTENDANCE TRIGGER
    function manualAttendance(nama, btn) {
        if (confirm(`Presensikan mahasiswa ${nama} secara manual?`)) {
            btn.disabled = true;
            btn.innerText = "Tercatat ✓";
            btn.className = "px-2.5 py-1 rounded-lg bg-emerald-100 text-emerald-800 text-xs font-semibold cursor-default";
        }
    }

    // 5. SEARCH FILTER MAHASISWA
    function filterAttendanceList() {
        const input = document.getElementById('searchInput');
        const filter = input.value.toLowerCase().trim();
        const rows = document.querySelectorAll('.mhs-row');

        rows.forEach(row => {
            const text = row.innerText.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        });
    }

    // 6. TUTUP SESI PRESENSI
    function confirmCloseSession() {
        if (confirm('Apakah Anda yakin ingin menutup sesi presensi ini? Sesi presensi yang ditutup tidak dapat discan lagi oleh mahasiswa.')) {
            alert('Sesi presensi berhasil ditutup. Data rekap kehadiran telah dikunci ke database.');
            window.location.href = "{{ route('asprak.dashboard') }}";
        }
    }
</script>

</body>
</html>
