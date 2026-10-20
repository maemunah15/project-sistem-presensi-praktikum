<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin | SIPRAK</title>

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
            border-radius: 13px;
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

        .tab-btn {
            border: 1px solid #e1e9e5;
            background: white;
            border-radius: 9px;
            padding: 8px 14px;
            color: #52635b;
            font-size: 12px;
            font-weight: 600;
            white-space: nowrap;
            cursor: pointer;
            transition: all .2s;
        }

        .tab-btn.active {
            background: var(--green-dark);
            color: white;
            border-color: var(--green-dark);
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
            font-size: 11px;
        }

        .data-table tbody tr:hover { background: #fbfdfc; }

        .status-active {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            border-radius: 30px;
            padding: 4px 8px;
            background: #eaf8f0;
            border: 1px solid #c6ead5;
            color: #08784f;
            font-size: 10px;
            font-weight: 700;
        }

        .status-active::before {
            content: '';
            height: 5px;
            width: 5px;
            border-radius: 50%;
            background: #16a36c;
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

    <!-- SIDEBAR -->
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
                    <a href="{{ url('/admin/dashboard?tab=master') }}" class="nav-link active">
                        <span class="nav-icon">
                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                                <rect x="3" y="4" width="18" height="16" rx="2"/>
                                <path d="M3 9h18M9 9v11"/>
                            </svg>
                        </span>
                        <span class="flex-1">Data Master</span>
                        <span class="text-[8.5px] font-medium rounded px-1.5 py-0.5 bg-[#075c46]/10 text-[#075c46]" id="badgeCount">2</span>
                    </a>

                    <a href="{{ route('admin.akademik.index') }}" class="nav-link">
                        <span class="nav-icon">
                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M3 21h18M5 21V8l7-5 7 5v13"/><path d="M9 11h1m4 0h1m-6 4h1m4 0h1"/></svg>
                        </span>
                        <span class="flex-1">Manajemen Akademik</span>
                        <span class="text-[10px] font-normal">›</span>
                    </a>

                    <a href="{{ route('admin.penugasan.index') }}" class="nav-link">
                        <span class="nav-icon">
                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><circle cx="9" cy="8" r="3"/><circle cx="17" cy="9" r="2.5"/><path d="M3 20v-2a6 6 0 0 1 12 0v2z"/><path d="M16 15a5 5 0 0 1 5 5"/></svg>
                        </span>
                        <span class="flex-1">Penugasan &amp; Mapping</span>
                    </a>

                    <a href="{{ route('admin.laporan.index') }}" class="nav-link">
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

        <div class="border-t border-white/10 p-3.5">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-full bg-emerald-700/80 border border-emerald-500/30 flex items-center justify-center text-white text-[11px] font-semibold">
                    {{ substr(Auth::user()->nama ?? 'A', 0, 1) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-[11.5px] font-semibold text-white truncate">{{ Auth::user()->nama ?? 'Admin Lab' }}</p>
                    <p class="text-[9.5px] text-emerald-200/60 truncate font-normal">Administrator</p>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" title="Keluar" class="w-7 h-7 rounded-lg border border-white/10 flex items-center justify-center text-emerald-200 hover:bg-white/10 transition">
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M10 17l5-5-5-5M15 12H3"/><path d="M12 3h7a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-7"/></svg>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- MAIN CONTENT AREA -->
    <div class="main-area ml-[250px] min-h-screen flex flex-col">

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
                        <span class="hidden sm:inline px-2.5 py-0.5 rounded-full bg-emerald-50 border border-emerald-100 text-emerald-800 font-semibold text-[11px]">Data Master</span>
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

        <main class="flex-1 px-6 py-6 lg:px-8 lg:py-8 space-y-6">

            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h2 class="text-xl sm:text-2xl font-bold tracking-tight text-[#183c30]">Data Master</h2>
                    <p class="text-xs text-slate-500 mt-1">Kelola data utama yang digunakan dalam sistem presensi praktikum.</p>
                </div>

                <button onclick="openModal()" class="btn-primary inline-flex items-center justify-center gap-2 self-start sm:self-auto shadow-sm">
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
                    <span>Tambah Data</span>
                </button>
            </div>

            <div class="flex gap-2 overflow-x-auto pb-1">
                <button class="tab-btn active" onclick="switchTab('mahasiswa', this)">Mahasiswa</button>
                <button class="tab-btn" onclick="switchTab('dosen', this)">Dosen</button>
                <button class="tab-btn" onclick="switchTab('asisten', this)">Asisten Praktikum</button>
                <button class="tab-btn" onclick="switchTab('laboratorium', this)">Laboratorium</button>
                <button class="tab-btn" onclick="switchTab('matakuliah', this)">Mata Kuliah</button>
            </div>

            <section class="surface overflow-hidden">
                <div class="p-4 border-b border-[#edf1ef] flex flex-col sm:flex-row justify-between gap-3">
                    <div class="relative w-full sm:max-w-[360px]">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="11" cy="11" r="7"/><path d="m16 16 4 4"/></svg>
                        <input id="searchInput" type="search" class="field pl-9" placeholder="Cari data..." oninput="filterTable()">
                    </div>

                    <button onclick="exportCSV()" class="px-3 py-2 rounded-lg border border-[#e1e9e5] text-xs font-semibold text-slate-700 hover:bg-slate-50 inline-flex items-center justify-center gap-2">
                        <svg class="w-3.5 h-3.5 text-emerald-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 3v12m-5-5 5 5 5-5"/><path d="M4 16v4h16v-4"/></svg>
                        Ekspor CSV
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="data-table" id="dataTable">
                        <thead id="tableHead"></thead>
                        <tbody id="tableBody"></tbody>
                    </table>
                </div>
            </section>

            <footer class="pt-4 pb-2">
                <p class="text-[10px] text-slate-400">© {{ date('Y') }} SIPRAK · UIN Siber Syekh Nurjati Cirebon</p>
            </footer>

        </main>
    </div>
</div>

<!-- MODAL TAMBAH DATA DINAMIS -->
<div id="addModal" class="fixed inset-0 bg-black/40 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-md w-full p-6 space-y-4 shadow-xl">
        <div class="flex justify-between items-center border-b pb-3">
            <h3 class="text-sm font-bold text-slate-800" id="modalTitle">Tambah Data Master</h3>
            <button onclick="closeModal()" class="text-slate-400 hover:text-slate-600 text-lg">&times;</button>
        </div>

        <form id="addForm" onsubmit="handleFormSubmit(event)" class="space-y-3">
            <div>
                <label class="block text-[11px] font-semibold text-slate-600 mb-1" id="labelCol1">NIM / NIP / KODE</label>
                <input type="text" id="inputCol1" required class="field" placeholder="Masukkan ID / Kode">
            </div>

            <div>
                <label class="block text-[11px] font-semibold text-slate-600 mb-1" id="labelCol2">Nama / Keterangan</label>
                <input type="text" id="inputCol2" required class="field" placeholder="Masukkan Nama">
            </div>

            <div id="containerCol3">
                <label class="block text-[11px] font-semibold text-slate-600 mb-1" id="labelCol3">Program Studi / Detail</label>
                <input type="text" id="inputCol3" class="field" placeholder="Masukkan Detail">
            </div>

            <div id="containerCol4" class="hidden">
                <label class="block text-[11px] font-semibold text-slate-600 mb-1" id="labelCol4">PRAKTIKUM</label>
                <input type="text" id="inputCol4" class="field" placeholder="Masukkan Nama Praktikum">
            </div>

            <div class="flex justify-end gap-2 pt-2">
                <button type="button" onclick="closeModal()" class="px-3 py-2 rounded-lg border text-xs font-semibold text-slate-600 hover:bg-slate-50">Batal</button>
                <button type="submit" class="btn-primary">Simpan Data</button>
            </div>
        </form>
    </div>
</div>

<script>
    const masterData = {
        mahasiswa: [
            { col1: "12345", col2: "Akun Uji Coba", col3: "Teknik Informatika (Siber)", extra: "A2", status: "Aktif" },
            { col1: "1004", col2: "Andi", col3: "Teknik Informatika (Siber)", extra: "A1", status: "Aktif" }
        ],
        dosen: [
            { col1: "19850101", col2: "Dr. Ahmad, M.T.", col3: "Teknik Informatika", status: "Aktif" },
            { col1: "19880202", col2: "Siti Aminah, M.Kom.", col3: "Sistem Informasi", status: "Aktif" },
            { col1: "123456", col2: "Maryam, M.Kom", col3: "Informatika", status: "Aktif" }
        ],
        asisten: [
            { col1: "200101", col2: "Siti Nurhaliza", col3: "Lab Komputer 1", extra: "Praktikum Web", status: "Aktif" },
            { col1: "200102", col2: "Rahmat Hidayat", col3: "Lab Komputer 2", extra: "Praktikum Metopen", status: "Aktif" }
        ],
        laboratorium: [
            { col1: "LAB-01", col2: "Lab Komputer 1", col3: "Gedung A Lt. 2", status: "Aktif" },
            { col1: "LAB-02", col2: "Lab Komputer 2", col3: "Gedung B Lt. 1", status: "Aktif" },
            { col1: "LAB-03", col2: "Lab Jaringan", col3: "Informatika", status: "Aktif" }
        ],
        matakuliah: [
            { col1: "IF202", col2: "Pemrograman Web", col3: "3 SKS", extra: "Semester 3", status: "Aktif" },
            { col1: "IF21", col2: "Metopen", col3: "3 SKS", extra: "Semester 6", status: "Aktif" },
            { col1: "INF123", col2: "Logika Informatika", col3: "3 SKS", extra: "Semester 3", status: "Aktif" }
        ]
    };

    let currentTab = 'mahasiswa';

    function switchTab(tab, btn) {
        currentTab = tab;
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        renderTable();
    }

    function renderTable() {
        const head = document.getElementById('tableHead');
        const body = document.getElementById('tableBody');
        const data = masterData[currentTab] || [];

        let thHTML = '';
        if (currentTab === 'mahasiswa') {
            thHTML = `<tr><th>NIM</th><th>NAMA</th><th>PROGRAM STUDI</th><th>KELAS</th><th>STATUS</th><th class="text-right">AKSI</th></tr>`;
        } else if (currentTab === 'dosen') {
            thHTML = `<tr><th>NIP</th><th>NAMA DOSEN</th><th>PRODI</th><th>STATUS</th><th class="text-right">AKSI</th></tr>`;
        } else if (currentTab === 'asisten') {
            thHTML = `<tr><th>ID ASPRAK</th><th>NAMA ASPRAK</th><th>ALOKASI LAB</th><th>PRAKTIKUM</th><th>STATUS</th><th class="text-right">AKSI</th></tr>`;
        } else if (currentTab === 'laboratorium') {
            thHTML = `<tr><th>KODE LAB</th><th>NAMA LAB</th><th>LOKASI</th><th>STATUS</th><th class="text-right">AKSI</th></tr>`;
        } else if (currentTab === 'matakuliah') {
            thHTML = `<tr><th>KODE MK</th><th>NAMA MATA KULIAH</th><th>SKS</th><th>SEMESTER</th><th>STATUS</th><th class="text-right">AKSI</th></tr>`;
        }
        head.innerHTML = thHTML;

        let tbHTML = '';
        if (data.length === 0) {
            tbHTML = `<tr><td colspan="6" class="text-center p-6 text-slate-400">Belum ada data.</td></tr>`;
        } else {
            data.forEach((item, idx) => {
                if (currentTab === 'asisten') {
                    tbHTML += `
                        <tr>
                            <td class="font-bold text-slate-700">${item.col1}</td>
                            <td class="font-semibold text-slate-800">${item.col2}</td>
                            <td class="text-slate-500 font-medium">${item.col3}</td>
                            <td><span class="inline-block px-2 py-0.5 rounded bg-slate-50 border border-slate-200 text-[10px] font-semibold text-slate-600">${item.extra || '-'}</span></td>
                            <td><span class="status-active">${item.status}</span></td>
                            <td>
                                <div class="flex items-center justify-end gap-3 font-semibold text-xs">
                                    <button onclick="editData(${idx})" class="text-emerald-700 hover:underline">Ubah</button>
                                    <button onclick="deleteData(${idx})" class="text-rose-600 hover:underline">Hapus</button>
                                </div>
                            </td>
                        </tr>
                    `;
                } else if (currentTab === 'laboratorium' || currentTab === 'dosen') {
                    tbHTML += `
                        <tr>
                            <td class="font-bold text-slate-700">${item.col1}</td>
                            <td class="font-semibold text-slate-800">${item.col2}</td>
                            <td class="text-slate-500 font-medium">${item.col3}</td>
                            <td><span class="status-active">${item.status}</span></td>
                            <td>
                                <div class="flex items-center justify-end gap-3 font-semibold text-xs">
                                    <button onclick="editData(${idx})" class="text-emerald-700 hover:underline">Ubah</button>
                                    <button onclick="deleteData(${idx})" class="text-rose-600 hover:underline">Hapus</button>
                                </div>
                            </td>
                        </tr>
                    `;
                } else {
                    tbHTML += `
                        <tr>
                            <td class="font-bold text-slate-700">${item.col1}</td>
                            <td class="font-semibold text-slate-800">${item.col2}</td>
                            <td class="text-slate-500">${item.col3}</td>
                            <td><span class="inline-block px-2 py-0.5 rounded bg-slate-50 border border-slate-200 text-[10px] font-semibold text-slate-600">${item.extra || '-'}</span></td>
                            <td><span class="status-active">${item.status}</span></td>
                            <td>
                                <div class="flex items-center justify-end gap-3 font-semibold text-xs">
                                    <button onclick="editData(${idx})" class="text-emerald-700 hover:underline">Ubah</button>
                                    <button onclick="deleteData(${idx})" class="text-rose-600 hover:underline">Hapus</button>
                                </div>
                            </td>
                        </tr>
                    `;
                }
            });
        }
        body.innerHTML = tbHTML;
        document.getElementById('badgeCount').innerText = data.length;
    }

    function openModal() {
        document.getElementById('modalTitle').innerText = 'Tambah Data ' + currentTab.toUpperCase();
        
        const l1 = document.getElementById('labelCol1');
        const l2 = document.getElementById('labelCol2');
        const c3Container = document.getElementById('containerCol3');
        const c4Container = document.getElementById('containerCol4');

        // Sembunyikan containerCol4 secara default
        c4Container.classList.add('hidden');

        if (currentTab === 'asisten') {
            l1.innerText = 'ID ASPRAK';
            document.getElementById('inputCol1').placeholder = 'Contoh: 200103';
            
            l2.innerText = 'NAMA ASPRAK';
            document.getElementById('inputCol2').placeholder = 'Masukkan Nama Asprak';
            
            c3Container.innerHTML = `
                <label class="block text-[11px] font-semibold text-slate-600 mb-1">ALOKASI LAB</label>
                <select id="inputCol3" class="field" required>
                    <option value="">-- Pilih Alokasi Lab --</option>
                    <option value="Lab Komputer 1">Lab Komputer 1</option>
                    <option value="Lab Komputer 2">Lab Komputer 2</option>
                    <option value="Lab Jaringan">Lab Jaringan</option>
                </select>
            `;

            // Tampilkan field Praktikum
            c4Container.classList.remove('hidden');
            document.getElementById('inputCol4').placeholder = 'Contoh: Praktikum Web';
        } else if (currentTab === 'laboratorium') {
            l1.innerText = 'KODE LAB';
            document.getElementById('inputCol1').placeholder = 'Contoh: LAB-04';
            
            l2.innerText = 'NAMA LAB';
            document.getElementById('inputCol2').placeholder = 'Contoh: Lab Komputer 3';
            
            c3Container.innerHTML = `
                <label class="block text-[11px] font-semibold text-slate-600 mb-1">LOKASI</label>
                <select id="inputCol3" class="field" required>
                    <option value="">-- Pilih Lokasi Lab --</option>
                    <option value="Gedung A Lt. 2">Gedung A Lt. 2</option>
                    <option value="Gedung B Lt. 1">Gedung B Lt. 1</option>
                    <option value="Informatika">Informatika</option>
                </select>
            `;
        } else if (currentTab === 'dosen') {
            l1.innerText = 'NIP';
            document.getElementById('inputCol1').placeholder = 'Masukkan NIP';
            
            l2.innerText = 'NAMA DOSEN';
            document.getElementById('inputCol2').placeholder = 'Masukkan Nama Dosen';
            
            c3Container.innerHTML = `
                <label class="block text-[11px] font-semibold text-slate-600 mb-1">PROGRAM STUDI</label>
                <input type="text" id="inputCol3" class="field" placeholder="Masukkan Program Studi">
            `;
        } else {
            l1.innerText = 'NIM / NIP / KODE';
            document.getElementById('inputCol1').placeholder = 'Masukkan ID / Kode';
            
            l2.innerText = 'Nama / Keterangan';
            document.getElementById('inputCol2').placeholder = 'Masukkan Nama';
            
            c3Container.innerHTML = `
                <label class="block text-[11px] font-semibold text-slate-600 mb-1">Program Studi / Detail</label>
                <input type="text" id="inputCol3" class="field" placeholder="Masukkan Detail / Prodi">
            `;
        }

        document.getElementById('addModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('addModal').classList.add('hidden');
        document.getElementById('addForm').reset();
    }

    function handleFormSubmit(e) {
        e.preventDefault();
        const c1 = document.getElementById('inputCol1').value;
        const c2 = document.getElementById('inputCol2').value;
        const c3 = document.getElementById('inputCol3').value;
        const c4 = document.getElementById('inputCol4') ? document.getElementById('inputCol4').value : '';

        masterData[currentTab].push({
            col1: c1,
            col2: c2,
            col3: c3 || '-',
            extra: c4 || '',
            status: 'Aktif'
        });

        renderTable();
        closeModal();
    }

    function deleteData(idx) {
        if(confirm('Yakin ingin menghapus data ini?')) {
            masterData[currentTab].splice(idx, 1);
            renderTable();
        }
    }

    function editData(idx) {
        alert('Fitur ubah data ' + masterData[currentTab][idx].col2 + ' siap digunakan.');
    }

    function filterTable() {
        const val = document.getElementById('searchInput').value.toLowerCase();
        const rows = document.querySelectorAll('#tableBody tr');
        rows.forEach(row => {
            row.style.display = row.innerText.toLowerCase().includes(val) ? '' : 'none';
        });
    }

    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('open');
        document.getElementById('mobileOverlay').classList.toggle('show');
    }

    document.addEventListener('DOMContentLoaded', () => {
        renderTable();
    });
</script>

</body>
</html>