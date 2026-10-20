
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelas Praktikum | SIPRAK</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }

        body { background: #f6f8f7; }

        .sidebar {
            background: #073c32;
        }

        .menu-link {
            transition: background .2s ease, color .2s ease;
        }

        .menu-link:hover {
            background: rgba(255,255,255,.08);
        }

        .menu-active {
            background: #08765b;
            color: white;
        }

        .field {
            width: 100%;
            border: 1px solid #dce5e1;
            border-radius: 10px;
            padding: 10px 12px;
            font-size: 13px;
            background: white;
            outline: none;
        }

        .field:focus {
            border-color: #059669;
            box-shadow: 0 0 0 3px rgba(5,150,105,.10);
        }

        .table-row:hover {
            background: #f8fbf9;
        }

        .modal-backdrop {
            background: rgba(15, 35, 29, .48);
            backdrop-filter: blur(3px);
        }

        @media (max-width: 767px) {
            .sidebar {
                width: 76px;
                min-width: 76px;
            }

            .sidebar .menu-text,
            .sidebar .brand-text,
            .sidebar .menu-heading,
            .sidebar .sidebar-footer {
                display: none;
            }

            .sidebar .menu-link {
                justify-content: center;
                padding-left: 0;
                padding-right: 0;
            }

            .main-content {
                min-width: 0;
            }
        }
    </style>
</head>

<body class="min-h-screen text-slate-800">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="sidebar w-[250px] min-w-[250px] text-slate-200 flex flex-col">

        <!-- Brand -->
        <div class="h-[92px] px-5 flex items-center gap-3 border-b border-white/10">
            <div class="w-12 h-12 rounded-xl bg-white flex items-center justify-center p-1.5 shrink-0">
                <img
                    src="{{ asset('image/Logo-UINSSC.png') }}"
                    alt="Logo UINSSC"
                    class="w-full h-full object-contain"
                    onerror="this.style.display='none'; this.nextElementSibling.style.display='block';"
                >
                <span class="hidden text-emerald-800 font-extrabold text-xs">UIN</span>
            </div>

            <div class="brand-text">
                <h1 class="text-[17px] font-extrabold text-white tracking-tight">
                    SIPRAK
                </h1>
                <p class="text-[11px] text-emerald-300 font-medium">
                    Sistem Presensi Praktikum
                </p>
            </div>
        </div>

        <!-- Menu -->
        <nav class="flex-1 px-3 py-6 space-y-6">

            <div>
                <p class="menu-heading text-[10px] uppercase tracking-[1.5px] font-bold text-emerald-300/70 px-3 mb-3">
                    Menu Utama
                </p>

                <div class="space-y-1.5">

                    <a href="{{ url('/admin/dashboard') }}"
                       class="menu-link flex items-center gap-3 px-3 py-3 rounded-xl text-[13px] font-semibold">
                        <span class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <rect x="3" y="3" width="7" height="7" rx="1.5"/>
                                <rect x="14" y="3" width="7" height="7" rx="1.5"/>
                                <rect x="14" y="14" width="7" height="7" rx="1.5"/>
                                <rect x="3" y="14" width="7" height="7" rx="1.5"/>
                            </svg>
                        </span>
                        <span class="menu-text">Dashboard</span>
                    </a>

                    <a href="{{ url('/admin/dashboard?tab=master') }}"
                       class="menu-link flex items-center gap-3 px-3 py-3 rounded-xl text-[13px] font-semibold">
                        <span class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2m6-10a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm7-3h5m-2.5-2.5v5"/>
                            </svg>
                        </span>
                        <span class="menu-text">Data Master</span>
                    </a>

                </div>
            </div>

            <div>
                <p class="menu-heading text-[10px] uppercase tracking-[1.5px] font-bold text-emerald-300/70 px-3 mb-3">
                    Akademik
                </p>

                <div class="space-y-1.5">

                    <a href="{{ url('/admin/akademik/kelas') }}"
                       class="menu-link menu-active flex items-center gap-3 px-3 py-3 rounded-xl text-[13px] font-semibold">
                        <span class="w-8 h-8 rounded-lg bg-white/15 flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2Z"/>
                            </svg>
                        </span>
                        <span class="menu-text flex-1">Kelas Praktikum</span>
                    </a>

                    <a href="{{ url('/admin/akademik/jadwal') }}"
                       class="menu-link flex items-center gap-3 px-3 py-3 rounded-xl text-[13px] font-semibold">
                        <span class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <rect x="3" y="5" width="18" height="16" rx="2"/>
                                <path stroke-linecap="round" d="M16 3v4M8 3v4M3 10h18"/>
                            </svg>
                        </span>
                        <span class="menu-text flex-1">Jadwal Praktikum</span>
                    </a>

                    <a href="{{ url('/admin/akademik/semester') }}"
                       class="menu-link flex items-center gap-3 px-3 py-3 rounded-xl text-[13px] font-semibold">
                        <span class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18m9-9H3"/>
                                <circle cx="12" cy="12" r="9"/>
                            </svg>
                        </span>
                        <span class="menu-text flex-1">Semester Akademik</span>
                    </a>

                </div>
            </div>

            <div>
                <p class="menu-heading text-[10px] uppercase tracking-[1.5px] font-bold text-emerald-300/70 px-3 mb-3">
                    Sistem
                </p>

                <a href="{{ url('/admin/users') }}"
                   class="menu-link flex items-center gap-3 px-3 py-3 rounded-xl text-[13px] font-semibold">
                    <span class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <circle cx="12" cy="8" r="4"/>
                            <path stroke-linecap="round" d="M5 21v-2a7 7 0 0 1 14 0v2"/>
                        </svg>
                    </span>
                    <span class="menu-text">Pengguna</span>
                </a>
            </div>
        </nav>

        <!-- Footer Sidebar -->
        <div class="sidebar-footer p-4 border-t border-white/10">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-full bg-emerald-700 flex items-center justify-center text-sm font-bold text-white">
                    A
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-xs font-bold text-white">Admin Lab</p>
                    <p class="text-[10px] text-emerald-300">Administrator</p>
                </div>
            </div>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="main-content flex-1 min-w-0">

        <!-- TOPBAR -->
        <header class="bg-white border-b border-slate-200 px-5 lg:px-8 py-4">
            <div class="flex flex-wrap items-center justify-between gap-4">

                <div class="flex items-center gap-2 text-xs sm:text-sm">
                    <span class="w-2 h-2 rounded-full bg-emerald-600"></span>
                    <span class="font-bold text-emerald-900">UIN SSC</span>
                    <span class="text-slate-300">/</span>
                    <span class="text-slate-500">Portal Laboratorium</span>
                    <span class="text-slate-300">/</span>
                    <span class="text-slate-700 font-semibold">Kelas Praktikum</span>
                </div>

                <div class="flex items-center gap-3">
                    <div class="hidden sm:block text-right">
                        <p class="text-xs font-bold text-slate-700">Admin Lab</p>
                        <p class="text-[10px] text-slate-500">Administrator SIPRAK</p>
                    </div>
                    <div class="w-9 h-9 rounded-full bg-emerald-800 text-white flex items-center justify-center text-sm font-bold">
                        A
                    </div>
                </div>
            </div>
        </header>

        <!-- PAGE CONTENT -->
        <section class="p-5 lg:p-8 max-w-[1600px] mx-auto">

            <!-- Title -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-7">
                <div>
                    <div class="flex items-center gap-3 flex-wrap">
                        <h1 class="text-2xl font-extrabold tracking-tight text-slate-900">
                            Kelas Praktikum
                        </h1>
                        <span class="text-[10px] font-bold text-emerald-800 bg-emerald-50 border border-emerald-100 px-2.5 py-1 rounded-full">
                            MANAJEMEN AKADEMIK
                        </span>
                    </div>
                    <p class="text-sm text-slate-500 mt-2">
                        Kelola kelas, mata kuliah, dan periode praktikum dalam satu halaman.
                    </p>
                </div>

                <button onclick="openAddModal()"
                    class="inline-flex items-center justify-center gap-2 px-5 py-3 bg-emerald-800 hover:bg-emerald-900 text-white text-sm font-bold rounded-xl shadow-sm transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" d="M12 5v14M5 12h14"/>
                    </svg>
                    Tambah Kelas
                </button>
            </div>

            <!-- SUMMARY CARDS -->
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4 mb-7">

                <div class="bg-white border border-slate-200 rounded-2xl p-5">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-xs font-semibold text-slate-500">Total Kelas</p>
                            <h2 id="totalKelas" class="text-3xl font-extrabold text-slate-900 mt-2">4</h2>
                            <p class="text-[11px] text-slate-400 mt-2">Seluruh kelas praktikum</p>
                        </div>
                        <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-800 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2Z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white border border-slate-200 rounded-2xl p-5">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-xs font-semibold text-slate-500">Kelas Aktif</p>
                            <h2 id="kelasAktif" class="text-3xl font-extrabold text-slate-900 mt-2">3</h2>
                            <p class="text-[11px] text-slate-400 mt-2">Siap digunakan untuk praktikum</p>
                        </div>
                        <div class="w-11 h-11 rounded-xl bg-green-50 text-green-700 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m5 12 4 4L19 6"/>
                                <circle cx="12" cy="12" r="9"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white border border-slate-200 rounded-2xl p-5">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-xs font-semibold text-slate-500">Semester Digunakan</p>
                            <h2 class="text-xl font-extrabold text-slate-900 mt-3">2026/2027</h2>
                            <p class="text-[11px] text-slate-400 mt-2">Semester Ganjil</p>
                        </div>
                        <div class="w-11 h-11 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <rect x="3" y="5" width="18" height="16" rx="2"/>
                                <path stroke-linecap="round" d="M16 3v4M8 3v4M3 10h18"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TABLE PANEL -->
            <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden">

                <!-- Table heading -->
                <div class="px-5 lg:px-6 py-5 border-b border-slate-100">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                        <div>
                            <h2 class="text-base font-extrabold text-slate-900">Daftar Kelas</h2>
                            <p class="text-xs text-slate-500 mt-1">Informasi kelas praktikum yang terdaftar di sistem.</p>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-3">
                            <div class="relative">
                                <svg class="w-4 h-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                    <circle cx="11" cy="11" r="7"/>
                                    <path stroke-linecap="round" d="m16 16 4 4"/>
                                </svg>
                                <input id="searchInput" type="text" placeholder="Cari kode atau nama kelas..."
                                    class="field sm:w-64 pl-9">
                            </div>

                            <select id="semesterFilter" class="field sm:w-48">
                                <option value="">Semua Semester</option>
                                <option value="1">Semester 1</option>
                                <option value="2">Semester 2</option>
                                <option value="3">Semester 3</option>
                                <option value="4">Semester 4</option>
                                <option value="5">Semester 5</option>
                                <option value="6">Semester 6</option>
                                <option value="7">Semester 7</option>
                                <option value="8">Semester 8</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left whitespace-nowrap">
                        <thead class="bg-slate-50 border-b border-slate-200">
                            <tr class="text-[10px] uppercase tracking-wider text-slate-500">
                                <th class="px-6 py-4 font-bold">No.</th>
                                <th class="px-4 py-4 font-bold">Kode Kelas</th>
                                <th class="px-4 py-4 font-bold">Nama Kelas</th>
                                <th class="px-4 py-4 font-bold">Mata Kuliah</th>
                                <th class="px-4 py-4 font-bold">Semester</th>
                                <th class="px-4 py-4 font-bold">Tahun Akademik</th>
                                <th class="px-4 py-4 font-bold">Status</th>
                                <th class="px-6 py-4 font-bold text-right">Aksi</th>
                            </tr>
                        </thead>

                        <tbody id="kelasTable" class="divide-y divide-slate-100 text-xs">
                            <!-- Data contoh untuk preview UI -->
                            <tr class="table-row"
                                data-kode="KLS001" data-nama="IF A" data-matkul="Pemrograman Web"
                                data-semester="5" data-tahun="2026/2027" data-status="Aktif">
                                <td class="px-6 py-4 text-slate-400">1</td>
                                <td class="px-4 py-4 font-bold text-slate-800">KLS001</td>
                                <td class="px-4 py-4 font-bold text-slate-900">IF A</td>
                                <td class="px-4 py-4 text-slate-600">Pemrograman Web</td>
                                <td class="px-4 py-4 text-slate-600">Semester 5</td>
                                <td class="px-4 py-4 text-slate-600">2026/2027</td>
                                <td class="px-4 py-4">
                                    <span class="status-badge inline-flex px-2.5 py-1 rounded-full bg-emerald-50 border border-emerald-100 text-emerald-700 text-[10px] font-bold">Aktif</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-end items-center gap-3">
                                        <button onclick="editRow(this)" class="font-bold text-emerald-700 hover:text-emerald-900">Edit</button>
                                        <button onclick="deleteRow(this)" class="font-bold text-rose-600 hover:text-rose-800">Hapus</button>
                                    </div>
                                </td>
                            </tr>

                            <tr class="table-row"
                                data-kode="KLS002" data-nama="IF B" data-matkul="Basis Data"
                                data-semester="3" data-tahun="2026/2027" data-status="Aktif">
                                <td class="px-6 py-4 text-slate-400">2</td>
                                <td class="px-4 py-4 font-bold text-slate-800">KLS002</td>
                                <td class="px-4 py-4 font-bold text-slate-900">IF B</td>
                                <td class="px-4 py-4 text-slate-600">Basis Data</td>
                                <td class="px-4 py-4 text-slate-600">Semester 3</td>
                                <td class="px-4 py-4 text-slate-600">2026/2027</td>
                                <td class="px-4 py-4">
                                    <span class="status-badge inline-flex px-2.5 py-1 rounded-full bg-emerald-50 border border-emerald-100 text-emerald-700 text-[10px] font-bold">Aktif</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-end items-center gap-3">
                                        <button onclick="editRow(this)" class="font-bold text-emerald-700 hover:text-emerald-900">Edit</button>
                                        <button onclick="deleteRow(this)" class="font-bold text-rose-600 hover:text-rose-800">Hapus</button>
                                    </div>
                                </td>
                            </tr>

                            <tr class="table-row"
                                data-kode="KLS003" data-nama="IF A" data-matkul="Jaringan Komputer"
                                data-semester="5" data-tahun="2026/2027" data-status="Aktif">
                                <td class="px-6 py-4 text-slate-400">3</td>
                                <td class="px-4 py-4 font-bold text-slate-800">KLS003</td>
                                <td class="px-4 py-4 font-bold text-slate-900">IF A</td>
                                <td class="px-4 py-4 text-slate-600">Jaringan Komputer</td>
                                <td class="px-4 py-4 text-slate-600">Semester 5</td>
                                <td class="px-4 py-4 text-slate-600">2026/2027</td>
                                <td class="px-4 py-4">
                                    <span class="status-badge inline-flex px-2.5 py-1 rounded-full bg-emerald-50 border border-emerald-100 text-emerald-700 text-[10px] font-bold">Aktif</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-end items-center gap-3">
                                        <button onclick="editRow(this)" class="font-bold text-emerald-700 hover:text-emerald-900">Edit</button>
                                        <button onclick="deleteRow(this)" class="font-bold text-rose-600 hover:text-rose-800">Hapus</button>
                                    </div>
                                </td>
                            </tr>

                            <tr class="table-row"
                                data-kode="KLS004" data-nama="IF C" data-matkul="Algoritma dan Struktur Data"
                                data-semester="3" data-tahun="2026/2027" data-status="Nonaktif">
                                <td class="px-6 py-4 text-slate-400">4</td>
                                <td class="px-4 py-4 font-bold text-slate-800">KLS004</td>
                                <td class="px-4 py-4 font-bold text-slate-900">IF C</td>
                                <td class="px-4 py-4 text-slate-600">Algoritma dan Struktur Data</td>
                                <td class="px-4 py-4 text-slate-600">Semester 3</td>
                                <td class="px-4 py-4 text-slate-600">2026/2027</td>
                                <td class="px-4 py-4">
                                    <span class="status-badge inline-flex px-2.5 py-1 rounded-full bg-slate-100 border border-slate-200 text-slate-600 text-[10px] font-bold">Nonaktif</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-end items-center gap-3">
                                        <button onclick="editRow(this)" class="font-bold text-emerald-700 hover:text-emerald-900">Edit</button>
                                        <button onclick="deleteRow(this)" class="font-bold text-rose-600 hover:text-rose-800">Hapus</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div id="emptyState" class="hidden text-center py-12 px-4">
                        <p class="text-sm font-bold text-slate-700">Data tidak ditemukan</p>
                        <p class="text-xs text-slate-500 mt-1">Coba ubah kata kunci atau filter semester.</p>
                    </div>
                </div>

                <!-- Table footer -->
                <div class="px-5 lg:px-6 py-4 border-t border-slate-100 flex flex-col sm:flex-row gap-2 sm:items-center sm:justify-between">
                    <p id="tableInfo" class="text-xs text-slate-500">Menampilkan 4 data kelas</p>
                    <p class="text-[11px] text-slate-400">SIPRAK · Manajemen Akademik</p>
                </div>
            </div>

            <p class="text-[11px] text-slate-400 mt-5">
                UIN Siber Syekh Nurjati Cirebon · Sistem Presensi Praktikum
            </p>
        </section>
    </main>
</div>

<!-- MODAL TAMBAH / EDIT -->
<div id="kelasModal" class="hidden fixed inset-0 z-50 modal-backdrop items-center justify-center p-4">
    <div class="bg-white w-full max-w-lg rounded-2xl shadow-2xl overflow-hidden">

        <div class="px-6 py-5 border-b border-slate-100 flex items-start justify-between">
            <div>
                <h2 id="modalTitle" class="text-lg font-extrabold text-slate-900">Tambah Kelas</h2>
                <p class="text-xs text-slate-500 mt-1">Lengkapi informasi kelas praktikum.</p>
            </div>
            <button onclick="closeModal()" class="text-slate-400 hover:text-slate-700 text-2xl leading-none" aria-label="Tutup">&times;</button>
        </div>

        <form id="kelasForm" class="p-6 space-y-4">
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-2">Kode Kelas</label>
                <input id="kodeKelas" class="field" placeholder="Contoh: KLS005" required>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-2">Nama Kelas</label>
                <input id="namaKelas" class="field" placeholder="Contoh: IF A" required>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-2">Mata Kuliah Praktikum</label>
                <input id="mataKuliah" class="field" placeholder="Contoh: Pemrograman Web" required>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-2">Semester</label>
                    <select id="semesterKelas" class="field" required>
                        <option value="">Pilih semester</option>
                        <option value="1">Semester 1</option>
                        <option value="2">Semester 2</option>
                        <option value="3">Semester 3</option>
                        <option value="4">Semester 4</option>
                        <option value="5">Semester 5</option>
                        <option value="6">Semester 6</option>
                        <option value="7">Semester 7</option>
                        <option value="8">Semester 8</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-2">Tahun Akademik</label>
                    <input id="tahunAkademik" class="field" placeholder="2026/2027" required>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-2">Status Kelas</label>
                <select id="statusKelas" class="field" required>
                    <option value="Aktif">Aktif</option>
                    <option value="Nonaktif">Nonaktif</option>
                </select>
            </div>

            <div class="flex justify-end gap-3 pt-3 border-t border-slate-100">
                <button type="button" onclick="closeModal()"
                    class="px-4 py-2.5 text-xs font-bold text-slate-600 border border-slate-200 rounded-xl hover:bg-slate-50">
                    Batal
                </button>
                <button type="submit"
                    class="px-5 py-2.5 text-xs font-bold text-white bg-emerald-800 hover:bg-emerald-900 rounded-xl">
                    Simpan Kelas
                </button>
            </div>
        </form>
    </div>
</div>

<!-- NOTIFIKASI -->
<div id="toast" class="hidden fixed bottom-5 right-5 z-[60] bg-emerald-900 text-white px-5 py-3 rounded-xl shadow-xl text-xs font-semibold"></div>

<script>
    const modal = document.getElementById('kelasModal');
    const form = document.getElementById('kelasForm');
    const table = document.getElementById('kelasTable');
    let editingRow = null;

    function showToast(message) {
        const toast = document.getElementById('toast');
        toast.textContent = message;
        toast.classList.remove('hidden');

        clearTimeout(window.toastTimer);
        window.toastTimer = setTimeout(() => toast.classList.add('hidden'), 2500);
    }

    function openAddModal() {
        editingRow = null;
        form.reset();
        document.getElementById('modalTitle').textContent = 'Tambah Kelas';
        document.getElementById('kodeKelas').disabled = false;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeModal() {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    function editRow(button) {
        editingRow = button.closest('tr');

        document.getElementById('modalTitle').textContent = 'Edit Kelas';
        document.getElementById('kodeKelas').value = editingRow.dataset.kode;
        document.getElementById('kodeKelas').disabled = true;
        document.getElementById('namaKelas').value = editingRow.dataset.nama;
        document.getElementById('mataKuliah').value = editingRow.dataset.matkul;
        document.getElementById('semesterKelas').value = editingRow.dataset.semester;
        document.getElementById('tahunAkademik').value = editingRow.dataset.tahun;
        document.getElementById('statusKelas').value = editingRow.dataset.status;

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function deleteRow(button) {
        const row = button.closest('tr');
        const kode = row.dataset.kode;

        if (!confirm(`Apakah kamu yakin ingin menghapus kelas ${kode}?`)) return;

        row.remove();
        updateTable();
        showToast('Data kelas dihapus dari tampilan.');
    }

    function createActionButtons() {
        return `
            <div class="flex justify-end items-center gap-3">
                <button onclick="editRow(this)" class="font-bold text-emerald-700 hover:text-emerald-900">Edit</button>
                <button onclick="deleteRow(this)" class="font-bold text-rose-600 hover:text-rose-800">Hapus</button>
            </div>`;
    }

    function updateStatusBadge(status) {
        if (status === 'Aktif') {
            return `<span class="status-badge inline-flex px-2.5 py-1 rounded-full bg-emerald-50 border border-emerald-100 text-emerald-700 text-[10px] font-bold">Aktif</span>`;
        }

        return `<span class="status-badge inline-flex px-2.5 py-1 rounded-full bg-slate-100 border border-slate-200 text-slate-600 text-[10px] font-bold">Nonaktif</span>`;
    }

    function saveRowData(row, data) {
        row.dataset.kode = data.kode;
        row.dataset.nama = data.nama;
        row.dataset.matkul = data.matkul;
        row.dataset.semester = data.semester;
        row.dataset.tahun = data.tahun;
        row.dataset.status = data.status;

        row.innerHTML = `
            <td class="px-6 py-4 text-slate-400"></td>
            <td class="px-4 py-4 font-bold text-slate-800">${escapeHTML(data.kode)}</td>
            <td class="px-4 py-4 font-bold text-slate-900">${escapeHTML(data.nama)}</td>
            <td class="px-4 py-4 text-slate-600">${escapeHTML(data.matkul)}</td>
            <td class="px-4 py-4 text-slate-600">Semester ${data.semester}</td>
            <td class="px-4 py-4 text-slate-600">${escapeHTML(data.tahun)}</td>
            <td class="px-4 py-4">${updateStatusBadge(data.status)}</td>
            <td class="px-6 py-4">${createActionButtons()}</td>`;
    }

    function escapeHTML(value) {
        return String(value).replace(/[&<>"']/g, char => ({
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        }[char]));
    }

    form.addEventListener('submit', function(event) {
        event.preventDefault();

        const data = {
            kode: document.getElementById('kodeKelas').value.trim(),
            nama: document.getElementById('namaKelas').value.trim(),
            matkul: document.getElementById('mataKuliah').value.trim(),
            semester: document.getElementById('semesterKelas').value,
            tahun: document.getElementById('tahunAkademik').value.trim(),
            status: document.getElementById('statusKelas').value
        };

        if (Object.values(data).some(value => !value)) {
            showToast('Lengkapi semua kolom terlebih dahulu.');
            return;
        }

        if (!editingRow) {
            const duplicate = [...table.querySelectorAll('tr')]
                .some(row => row.dataset.kode.toLowerCase() === data.kode.toLowerCase());

            if (duplicate) {
                showToast('Kode kelas sudah digunakan.');
                return;
            }

            const row = document.createElement('tr');
            row.className = 'table-row';
            saveRowData(row, data);
            table.appendChild(row);
            showToast('Kelas ditambahkan ke tampilan.');
        } else {
            saveRowData(editingRow, data);
            showToast('Data kelas diperbarui pada tampilan.');
        }

        closeModal();
        updateTable();
    });

    function updateTable() {
        const rows = [...table.querySelectorAll('tr')];
        const query = document.getElementById('searchInput').value.toLowerCase().trim();
        const semester = document.getElementById('semesterFilter').value;
        let visible = 0;
        let active = 0;

        rows.forEach((row, index) => {
            const matchesQuery = [
                row.dataset.kode,
                row.dataset.nama,
                row.dataset.matkul,
                row.dataset.tahun
            ].some(value => (value || '').toLowerCase().includes(query));

            const matchesSemester = !semester || row.dataset.semester === semester;
            const show = matchesQuery && matchesSemester;

            row.classList.toggle('hidden', !show);

            if (show) {
                visible++;
                active += row.dataset.status === 'Aktif' ? 1 : 0;
                row.cells[0].textContent = visible;
            }
        });

        document.getElementById('totalKelas').textContent = rows.length;
        document.getElementById('kelasAktif').textContent = rows.filter(row => row.dataset.status === 'Aktif').length;
        document.getElementById('tableInfo').textContent = `Menampilkan ${visible} dari ${rows.length} data kelas`;
        document.getElementById('emptyState').classList.toggle('hidden', visible !== 0);
    }

    document.getElementById('searchInput').addEventListener('input', updateTable);
    document.getElementById('semesterFilter').addEventListener('change', updateTable);

    modal.addEventListener('click', function(event) {
        if (event.target === modal) closeModal();
    });

    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') closeModal();
    });

    updateTable();
</script>

</body>
</html>
