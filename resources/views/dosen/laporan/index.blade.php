<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Presensi | SIPRAK</title>

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
            background: #ffffff !important;
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
            background: transparent !important;
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

        .btn-submit {
            background: var(--green-dark);
            color: white;
            border-radius: 9px;
            padding: 10px 16px;
            font-size: 12px;
            font-weight: 600;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: background .2s;
        }

        .btn-submit:hover {
            background: #064b3b;
        }

        .btn-export {
            background: #e8f5ef;
            color: #075c46;
            border-radius: 9px;
            padding: 7px 14px;
            font-size: 12px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: background .2s;
        }

        .btn-export:hover {
            background: #d2ebdf;
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

        /* FORMAT KHUSUS UNTUK METODE CETAK PDF */
        @media print {
            body {
                background: #ffffff !important;
                color: #000000 !important;
            }
            .sidebar, header, .btn-export, .btn-submit, select, label, .no-print, footer {
                display: none !important;
            }
            .main-area {
                margin-left: 0 !important;
                padding: 0 !important;
            }
            .surface {
                border: none !important;
                box-shadow: none !important;
                padding: 0 !important;
            }
            .print-only {
                display: block !important;
            }
            table {
                width: 100% !important;
                border-collapse: collapse !important;
                margin-top: 15px !important;
            }
            th, td {
                border: 1px solid #333 !important;
                padding: 8px !important;
            }
            th {
                background-color: #f0f0f0 !important;
            }
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
                <p class="text-[9.5px] text-emerald-200/80 font-normal mt-0.5">Portal Dosen</p>
            </div>
        </div>

        <div class="px-3 pt-4 pb-2 flex-1 overflow-y-auto space-y-4">
            <div>
                <div class="flex justify-between items-center px-2 mb-2">
                    <span class="text-[9.5px] font-semibold tracking-wider text-emerald-200/60 uppercase">MENU UTAMA</span>
                </div>

                <nav class="space-y-1">
                    <a href="{{ route('dosen.dashboard') }}" class="nav-link">
                        <span class="nav-icon">
                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/></svg>
                        </span>
                        <span class="flex-1">Dashboard</span>
                    </a>

                    <a href="{{ route('dosen.pertemuan.index') }}" class="nav-link">
                        <span class="nav-icon">
                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                        </span>
                        <span class="flex-1">Pertemuan &amp; Materi</span>
                    </a>

                    <a href="{{ route('dosen.monitoring.index') }}" class="nav-link">
                        <span class="nav-icon">
                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        </span>
                        <span class="flex-1">Monitoring Kehadiran</span>
                    </a>

                    <a href="{{ route('dosen.laporan.index') }}" class="nav-link active">
                        <span class="nav-icon">
                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                        </span>
                        <span class="flex-1">Laporan Presensi</span>
                    </a>
                </nav>
            </div>
        </div>

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
                        <span class="text-slate-500 font-medium">Laporan Presensi</span>
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

            <!-- KOP SURAT KHUSUS CETAK/PDF -->
            <div class="hidden print-only mb-6 border-b-2 border-black pb-4 text-center">
                <h1 class="text-lg font-bold uppercase tracking-wide">KEMENTERIAN AGAMA REPUBLIK INDONESIA</h1>
                <h2 class="text-md font-bold uppercase">UIN SIBER SYEKH NURJATI CIREBON</h2>
                <p class="text-xs mt-1">Laporan Rekapitulasi Kehadiran Praktikum Mahasiswa</p>
                <div class="text-xs mt-3 text-left font-semibold space-y-0.5">
                    <p id="printKelas">Kelas Praktikum: Pemrograman Web — Kelas A</p>
                    <p id="printSemester">Semester: Ganjil 2026/2027</p>
                    <p id="printRentang">Rentang Pertemuan: Pertemuan 1–14</p>
                </div>
            </div>

            <!-- HEADER TITLE -->
            <div class="no-print">
                <h2 class="text-xl font-bold tracking-tight text-[#183c30]">Laporan Presensi</h2>
                <p class="text-xs text-slate-500 mt-1">Rekap kehadiran mahasiswa dan ekspor laporan praktikum.</p>
            </div>

            <!-- FILTER LAPORAN -->
            <div class="surface p-5 space-y-4 no-print">
                <h3 class="text-sm font-bold text-slate-800">Filter Laporan</h3>

                <div class="space-y-3">
                    <div>
                        <label class="block text-[11px] font-medium text-slate-500 mb-1">Kelas Praktikum</label>
                        <select id="selectKelas" class="field font-medium text-slate-800 text-xs py-2">
                            <option value="Pemrograman Web — Kelas A">Pemrograman Web — Kelas A</option>
                            <option value="Basis Data — Kelas B2">Basis Data — Kelas B2</option>
                            <option value="Jaringan Komputer — Kelas A1">Jaringan Komputer — Kelas A1</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-[11px] font-medium text-slate-500 mb-1">Semester</label>
                        <select id="selectSemester" class="field font-medium text-slate-800 text-xs py-2">
                            <option value="Ganjil 2026/2027">Ganjil 2026/2027</option>
                            <option value="Genap 2025/2026">Genap 2025/2026</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-[11px] font-medium text-slate-500 mb-1">Rentang Pertemuan</label>
                        <select id="selectRentang" class="field font-medium text-slate-800 text-xs py-2">
                            <option value="Pertemuan 1–14">Pertemuan 1–14</option>
                            <option value="Pertemuan 1–7 (UTS)">Pertemuan 1–7 (UTS)</option>
                            <option value="Pertemuan 8–14 (UAS)">Pertemuan 8–14 (UAS)</option>
                        </select>
                    </div>

                    <button onclick="tampilkanLaporan()" class="btn-submit mt-2">
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg>
                        Tampilkan Laporan
                    </button>
                </div>
            </div>

            <!-- RINGKASAN STATISTIK -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 no-print">
                <div class="surface p-4 space-y-1">
                    <p class="text-[11px] text-slate-400 font-medium">Mahasiswa</p>
                    <p id="statMahasiswa" class="text-2xl font-bold text-slate-800">32</p>
                    <p class="text-[10px] text-slate-400">Terdaftar di kelas</p>
                </div>

                <div class="surface p-4 space-y-1">
                    <p class="text-[11px] text-slate-400 font-medium">Rata-rata Kehadiran</p>
                    <p id="statRatarata" class="text-2xl font-bold text-emerald-800">89%</p>
                    <p class="text-[10px] text-slate-400">Contoh data</p>
                </div>
            </div>

            <!-- REKAP PRESENSI MAHASISWA -->
            <div class="surface overflow-hidden p-5 space-y-4">
                <div class="flex items-center justify-between no-print">
                    <div>
                        <h3 class="text-sm font-bold text-slate-800">Rekap Presensi Mahasiswa</h3>
                        <p class="text-[11px] text-slate-400 mt-0.5">Ringkasan per mahasiswa</p>
                    </div>

                    <!-- TOMBOL EKSPOR UNTUK PILIH FORMAT -->
                    <button onclick="toggleModalEkspor()" class="btn-export">
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                        Ekspor
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table id="tabelRekap" class="w-full text-left border-collapse text-xs">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-100 text-slate-500 font-bold text-[11px]">
                                <th class="p-3 pl-2">Mahasiswa</th>
                                <th class="p-3 text-center">Hadir</th>
                                <th class="p-3 text-right pr-2">Persen</th>
                            </tr>
                        </thead>
                        <tbody id="tbodyMahasiswa" class="divide-y divide-slate-100 text-slate-700">
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="p-3 pl-2 font-medium text-slate-800">Ahmad Rizki</td>
                                <td class="p-3 text-center text-slate-500">13/14</td>
                                <td class="p-3 text-right pr-2 font-bold text-emerald-600">93%</td>
                            </tr>
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="p-3 pl-2 font-medium text-slate-800">Siti Aisyah</td>
                                <td class="p-3 text-center text-slate-500">12/14</td>
                                <td class="p-3 text-right pr-2 font-bold text-emerald-600">86%</td>
                            </tr>
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="p-3 pl-2 font-medium text-slate-800">Dewi Lestari</td>
                                <td class="p-3 text-center text-slate-500">14/14</td>
                                <td class="p-3 text-right pr-2 font-bold text-emerald-600">100%</td>
                            </tr>
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="p-3 pl-2 font-medium text-slate-800">Fajar Maulana</td>
                                <td class="p-3 text-center text-slate-500">10/14</td>
                                <td class="p-3 text-right pr-2 font-bold text-amber-600">71%</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- KOLOM TANDA TANGAN KHUSUS CETAK/PDF -->
                <div class="hidden print-only mt-12 flex justify-end">
                    <div class="text-center text-xs">
                        <p>Cirebon, {{ date('d F Y') }}</p>
                        <p class="mt-1 font-semibold">Dosen Pengampu Praktikum,</p>
                        <div class="h-16"></div>
                        <p class="font-bold underline">{{ Auth::user()->nama ?? 'Dr. Rina Amelia' }}</p>
                        <p>NIP. 198504122010122001</p>
                    </div>
                </div>

                <div class="pt-2 flex items-center justify-between text-[11px] text-slate-400 border-t border-slate-100 no-print">
                    <span id="labelPagination">Menampilkan 4 dari 32 mahasiswa</span>
                    <button class="hover:text-slate-600 p-1">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
                    </button>
                </div>
            </div>

            <footer class="pt-4 pb-2 no-print">
                <p class="text-[10px] text-slate-400">© {{ date('Y') }} SIPRAK · UIN Siber Syekh Nurjati Cirebon</p>
            </footer>

        </main>
    </div>
</div>

<!-- MODAL PILIHAN FORMAT EKSPOR -->
<div id="modalEkspor" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4 no-print">
    <div class="bg-white rounded-2xl max-w-sm w-full p-6 space-y-4 shadow-xl">
        <div class="flex justify-between items-center border-b border-slate-100 pb-3">
            <h3 class="text-sm font-bold text-slate-800">Pilih Format Ekspor</h3>
            <button onclick="toggleModalEkspor()" class="text-slate-400 hover:text-slate-600 font-bold">✕</button>
        </div>

        <p class="text-xs text-slate-500">Pilih format dokumen laporan rekap kehadiran mahasiswa yang ingin diunduh:</p>

        <div class="space-y-2.5">
            <!-- Pilihan Cetak / PDF -->
            <button onclick="exportToPDF()" class="w-full p-3 bg-slate-50 border border-slate-200 hover:border-emerald-500 hover:bg-emerald-50/50 rounded-xl flex items-center gap-3 transition text-left group">
                <div class="w-9 h-9 rounded-lg bg-rose-100 text-rose-700 flex items-center justify-center font-bold text-xs shrink-0">
                    PDF
                </div>
                <div>
                    <p class="text-xs font-bold text-slate-800 group-hover:text-emerald-800">Dokumen PDF (Cetak / Save PDF)</p>
                    <p class="text-[10px] text-slate-400">Lengkap dengan Kop Surat dan Tanda Tangan</p>
                </div>
            </button>

            <!-- Pilihan CSV / Excel -->
            <button onclick="exportToExcel()" class="w-full p-3 bg-slate-50 border border-slate-200 hover:border-emerald-500 hover:bg-emerald-50/50 rounded-xl flex items-center gap-3 transition text-left group">
                <div class="w-9 h-9 rounded-lg bg-emerald-100 text-emerald-800 flex items-center justify-center font-bold text-xs shrink-0">
                    XLS
                </div>
                <div>
                    <p class="text-xs font-bold text-slate-800 group-hover:text-emerald-800">File Excel (.CSV / Spreadsheet)</p>
                    <p class="text-[10px] text-slate-400">Format tabel Microsoft Excel/Google Sheets</p>
                </div>
            </button>
        </div>

        <div class="flex justify-end pt-2 border-t border-slate-100">
            <button onclick="toggleModalEkspor()" class="px-4 py-2 rounded-lg border border-slate-200 text-xs font-semibold text-slate-600 hover:bg-slate-50">Batal</button>
        </div>
    </div>
</div>

<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('open');
        document.getElementById('mobileOverlay').classList.toggle('show');
    }

    function toggleModalEkspor() {
        document.getElementById('modalEkspor').classList.toggle('hidden');
    }

    function tampilkanLaporan() {
        const kelas = document.getElementById('selectKelas').value;
        const semester = document.getElementById('selectSemester').value;
        const rentang = document.getElementById('selectRentang').value;

        document.getElementById('printKelas').innerText = `Kelas Praktikum: ${kelas}`;
        document.getElementById('printSemester').innerText = `Semester: ${semester}`;
        document.getElementById('printRentang').innerText = `Rentang Pertemuan: ${rentang}`;

        alert(`Memuat data laporan untuk:\n${kelas}\n${semester}\n${rentang}`);
    }

    // FUNGSIONALITAS EKSPOR PDF (MEMANFAATKAN FITUR PRINT BROWSER DENGAN LAYOUT KHUSUS)
    function exportToPDF() {
        const kelas = document.getElementById('selectKelas').value;
        const semester = document.getElementById('selectSemester').value;
        const rentang = document.getElementById('selectRentang').value;

        document.getElementById('printKelas').innerText = `Kelas Praktikum: ${kelas}`;
        document.getElementById('printSemester').innerText = `Semester: ${semester}`;
        document.getElementById('printRentang').innerText = `Rentang Pertemuan: ${rentang}`;

        toggleModalEkspor();
        window.print();
    }

    // FUNGSIONALITAS EKSPOR EXCEL (.CSV)
    function exportToExcel() {
        const kelas = document.getElementById('selectKelas').value;
        const semester = document.getElementById('selectSemester').value;

        let csvContent = "data:text/csv;charset=utf-8,";
        csvContent += `LAPORAN PRESENSI PRAKTIKUM - UIN SIBER SYEKH NURJATI CIREBON\n`;
        csvContent += `Kelas: ${kelas}\n`;
        csvContent += `Semester: ${semester}\n\n`;
        csvContent += "Nama Mahasiswa,Total Hadir,Persentase\n";

        const rows = document.querySelectorAll('#tbodyMahasiswa tr');
        rows.forEach(row => {
            const cols = row.querySelectorAll('td');
            const nama = cols[0].innerText;
            const hadir = cols[1].innerText;
            const persen = cols[2].innerText;
            csvContent += `"${nama}","${hadir}","${persen}"\n`;
        });

        const encodedUri = encodeURI(csvContent);
        const link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", `Laporan_Presensi_${kelas.replace(/\s+/g, '_')}.csv`);
        document.body.appendChild(link);

        link.click();
        document.body.removeChild(link);
        toggleModalEkspor();
    }
</script>

</body>
</html>