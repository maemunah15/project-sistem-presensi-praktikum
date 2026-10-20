<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pertemuan & Materi | SIPRAK</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * { box-sizing: border-box; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f5f7f8; color: #23352f; }
        :root { --green-dark: #075c46; --green-deep: #064b3b; --green-main: #087f60; --green-light: #e8f5ef; --border: #e5ebe8; }
        .sidebar { background: var(--green-deep); color: #eaf4ef; }
        .nav-link { display: flex; align-items: center; gap: 10px; padding: 9px 12px; border-radius: 10px; font-size: 11.5px; font-weight: 500; color: #c4d7cf; transition: background .2s, color .2s; }
        .nav-link:hover { background: rgba(255,255,255,.08); color: white; }
        .nav-link.active { background: #e8f5ef !important; color: #075c46 !important; font-weight: 600; }
        .nav-icon { display: flex; align-items: center; justify-content: center; width: 30px; height: 30px; flex-shrink: 0; border-radius: 8px; background: rgba(255,255,255,.08); color: #c4d7cf; }
        .nav-link.active .nav-icon { background: #d2ebdf !important; color: #075c46 !important; }
        .surface { background: #fff; border: 1px solid var(--border); border-radius: 14px; }
        .field { width: 100%; border: 1px solid #e1e9e5; background: #fafcfb; border-radius: 9px; padding: 9px 12px; font-size: 12px; outline: none; }
        .field:focus { border-color: #70bda0; box-shadow: 0 0 0 3px rgba(8,127,96,.08); }
        .btn-primary { background: var(--green-dark); color: white; border-radius: 9px; padding: 9px 16px; font-size: 12px; font-weight: 600; transition: background .2s; }
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

    <!-- SIDEBAR -->
    <aside id="sidebar" class="sidebar fixed inset-y-0 left-0 w-[250px] flex flex-col z-50">
        <div class="h-[80px] px-5 flex items-center gap-3 border-b border-white/10">
            <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center p-1.5 shrink-0 shadow-sm">
                <img src="{{ asset('image/Logo-UINSSC.png') }}" alt="Logo UINSSC" class="w-full h-full object-contain" onerror="this.onerror=null; this.src='https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Logo_UIN_Siber_Syekh_Nurjati_Cirebon.png/600px-Logo_UIN_Siber_Syekh_Nurjati_Cirebon.png';">
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
                    <a href="{{ route('dosen.dashboard') }}" class="nav-link">
                        <span class="nav-icon"><svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/></svg></span>
                        <span class="flex-1">Dashboard</span>
                    </a>
                    <a href="{{ route('dosen.pertemuan.index') }}" class="nav-link active">
                        <span class="nav-icon"><svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg></span>
                        <span class="flex-1">Pertemuan &amp; Materi</span>
                    </a>
                    <a href="{{ route('dosen.monitoring.index') }}" class="nav-link">
                        <span class="nav-icon"><svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></span>
                        <span class="flex-1">Monitoring Kehadiran</span>
                    </a>
                    <a href="{{ route('dosen.laporan.index') }}" class="nav-link">
                        <span class="nav-icon"><svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg></span>
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
                <button type="submit" class="w-8 h-8 rounded-lg border border-white/10 bg-white/5 hover:bg-rose-600/80 text-emerald-200 hover:text-white flex items-center justify-center transition-all">
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <div class="main-area ml-[250px] min-h-screen flex flex-col">
        <header class="bg-white border-b border-[#e5ebe8] sticky top-0 z-30">
            <div class="min-h-[72px] px-6 lg:px-8 flex items-center justify-between">
                <div class="text-xs flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-600"></span>
                    <span class="font-bold text-emerald-900">UIN SSC</span>
                    <span class="text-slate-300">/</span>
                    <span class="text-slate-500 font-medium">Pertemuan &amp; Materi</span>
                </div>
            </div>
        </header>

        <main class="flex-1 px-6 py-6 lg:px-8 lg:py-8 space-y-6">
            <div>
                <h2 class="text-xl font-bold tracking-tight text-[#183c30]">Pertemuan &amp; Materi</h2>
                <p class="text-xs text-slate-500 mt-1">Kelola jadwal, materi, dan aktivitas praktikum.</p>
            </div>

            <!-- SELECT KELAS PRAKTIKUM -->
            <div class="surface p-4 space-y-1.5">
                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider">PILIH KELAS PRAKTIKUM</label>
                <select id="selectKelas" onchange="renderDataKelas()" class="field font-bold text-slate-800 text-xs py-2">
                    <option value="kelas_a">Pemrograman Web — Kelas A · Ganjil 2026/2027</option>
                    <option value="kelas_b">Pemrograman Web — Kelas B · Genap 2026/2027</option>
                    <option value="basis_data">Basis Data — Kelas B2 · Ganjil 2026/2027</option>
                </select>
            </div>

            <!-- STATS CARDS -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="surface p-4 flex items-start gap-3">
                    <div class="w-9 h-9 rounded-lg bg-emerald-50 text-emerald-700 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    </div>
                    <div>
                        <p class="text-[11px] text-slate-400 font-semibold">Total Pertemuan</p>
                        <p id="totalPertemuan" class="text-2xl font-bold text-slate-800 mt-0.5">14</p>
                        <p class="text-[10px] text-slate-400 mt-1">Target per semester</p>
                    </div>
                </div>

                <div class="surface p-4 flex items-start gap-3">
                    <div class="w-9 h-9 rounded-lg bg-emerald-50 text-emerald-700 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                    </div>
                    <div>
                        <p class="text-[11px] text-slate-400 font-semibold">Materi Diunggah</p>
                        <p id="materiDiunggah" class="text-2xl font-bold text-slate-800 mt-0.5">8</p>
                        <p class="text-[10px] text-slate-400 mt-1">Total berkas materi</p>
                    </div>
                </div>
            </div>

            <!-- DAFTAR PERTEMUAN -->
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-sm font-bold text-slate-800">Daftar Pertemuan</h3>
                    <button onclick="openModalTambah()" class="btn-primary inline-flex items-center gap-1.5">+ Tambah Pertemuan</button>
                </div>

                <div id="containerPertemuan" class="surface overflow-hidden divide-y divide-slate-100">
                    <!-- Render otomatis via JavaScript -->
                </div>
            </div>

            <footer class="pt-4 pb-2">
                <p class="text-[10px] text-slate-400">© {{ date('Y') }} SIPRAK · UIN Siber Syekh Nurjati Cirebon</p>
            </footer>
        </main>
    </div>
</div>

<!-- MODAL TAMBAH PERTEMUAN -->
<div id="modalTambah" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-md w-full p-6 space-y-4 shadow-xl">
        <div class="flex justify-between items-center border-b border-slate-100 pb-3">
            <h3 class="text-sm font-bold text-slate-800">Tambah Pertemuan Baru</h3>
            <button onclick="closeModalTambah()" class="text-slate-400 hover:text-slate-600 font-bold">✕</button>
        </div>

        <div class="space-y-3">
            <div>
                <label class="block text-[11px] font-semibold text-slate-600 mb-1">Nomor Pertemuan</label>
                <input type="number" id="inputNoPertemuan" placeholder="Misal: 04" class="field text-xs">
            </div>
            <div>
                <label class="block text-[11px] font-semibold text-slate-600 mb-1">Judul Pertemuan</label>
                <input type="text" id="inputJudul" placeholder="Misal: Proyek Perangkat Lunak" class="field text-xs">
            </div>
            <div>
                <label class="block text-[11px] font-semibold text-slate-600 mb-1">Deskripsi Singkat</label>
                <input type="text" id="inputDeskripsi" placeholder="Misal: buku panduan" class="field text-xs">
            </div>
            <div>
                <label class="block text-[11px] font-semibold text-slate-600 mb-1">Unggah Materi (PDF/ZIP)</label>
                <input type="file" id="inputFileMateri" class="field text-xs py-1.5">
            </div>
        </div>

        <div class="flex justify-end gap-2 pt-2 border-t border-slate-100">
            <button onclick="closeModalTambah()" class="px-4 py-2 rounded-lg border border-slate-200 text-xs font-semibold text-slate-600 hover:bg-slate-50">Batal</button>
            <button onclick="simpanPertemuanBaru()" class="btn-primary py-2 px-4 text-xs">Simpan Pertemuan</button>
        </div>
    </div>
</div>

<!-- MODAL EDIT PERTEMUAN -->
<div id="modalEdit" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-md w-full p-6 space-y-4 shadow-xl">
        <div class="flex justify-between items-center border-b border-slate-100 pb-3">
            <h3 class="text-sm font-bold text-slate-800">Edit Pertemuan</h3>
            <button onclick="closeModalEdit()" class="text-slate-400 hover:text-slate-600 font-bold">✕</button>
        </div>

        <input type="hidden" id="editIndex">
        <div class="space-y-3">
            <div>
                <label class="block text-[11px] font-semibold text-slate-600 mb-1">Nomor Pertemuan</label>
                <input type="text" id="editNoPertemuan" class="field text-xs">
            </div>
            <div>
                <label class="block text-[11px] font-semibold text-slate-600 mb-1">Judul Pertemuan</label>
                <input type="text" id="editJudul" class="field text-xs">
            </div>
            <div>
                <label class="block text-[11px] font-semibold text-slate-600 mb-1">Deskripsi Singkat</label>
                <input type="text" id="editDeskripsi" class="field text-xs">
            </div>
        </div>

        <div class="flex justify-end gap-2 pt-2 border-t border-slate-100">
            <button onclick="closeModalEdit()" class="px-4 py-2 rounded-lg border border-slate-200 text-xs font-semibold text-slate-600 hover:bg-slate-50">Batal</button>
            <button onclick="simpanEditPertemuan()" class="btn-primary py-2 px-4 text-xs">Simpan Perubahan</button>
        </div>
    </div>
</div>

<!-- MODAL CEK MATERI -->
<div id="modalMateri" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-md w-full p-6 space-y-4 shadow-xl">
        <div class="flex justify-between items-center border-b border-slate-100 pb-3">
            <h3 class="text-sm font-bold text-slate-800" id="detailJudulMateri">Detail Materi</h3>
            <button onclick="closeModalMateri()" class="text-slate-400 hover:text-slate-600 font-bold">✕</button>
        </div>

        <div class="space-y-3">
            <p class="text-xs text-slate-500" id="detailDeskripsiMateri">-</p>
            <div class="p-4 bg-emerald-50 border border-emerald-100 rounded-xl flex items-center justify-between">
                <div class="flex items-center gap-3 min-w-0">
                    <div class="w-8 h-8 rounded-lg bg-emerald-700 text-white flex items-center justify-center font-bold text-xs shrink-0">FILE</div>
                    <div class="min-w-0">
                        <p class="text-xs font-bold text-emerald-950 truncate" id="detailNamaFile">Modul_Praktikum.pdf</p>
                        <p class="text-[10px] text-emerald-700" id="detailUkuranFile">2.4 MB · Diunggah oleh Dosen</p>
                    </div>
                </div>
                <!-- TOMBOL UNDUH AKTIF -->
                <a id="btnDownloadMateri" href="#" download class="px-3 py-1.5 bg-emerald-700 text-white rounded-lg text-xs font-semibold hover:bg-emerald-800 shrink-0 inline-flex items-center gap-1">
                    Unduh
                </a>
            </div>
        </div>

        <div class="flex justify-end pt-2 border-t border-slate-100">
            <button onclick="closeModalMateri()" class="btn-primary py-2 px-4 text-xs">Tutup</button>
        </div>
    </div>
</div>

<script>
    const dataPraktikum = {
        'kelas_a': {
            totalPertemuan: 14,
            materiDiunggah: 8,
            pertemuan: [
                { no: '01', judul: 'Pengenalan Praktikum', deskripsi: 'Pengantar dan aturan laboratorium', namaFile: 'Modul_01_Pengenalan.pdf', fileUrl: '', ukuran: '1.8 MB' },
                { no: '02', judul: 'Dasar HTML', deskripsi: 'Struktur dokumen HTML', namaFile: 'Modul_02_HTML.pdf', fileUrl: '', ukuran: '2.1 MB' },
                { no: '03', judul: 'Dasar CSS', deskripsi: 'Styling halaman web', namaFile: 'Modul_03_CSS.pdf', fileUrl: '', ukuran: '3.4 MB' }
            ]
        },
        'kelas_b': {
            totalPertemuan: 16,
            materiDiunggah: 12,
            pertemuan: [
                { no: '01', judul: 'Pengenalan Web Genap', deskripsi: 'Aturan & Silabus Praktikum Genap', namaFile: 'Silabus_Genap.pdf', fileUrl: '', ukuran: '1.2 MB' },
                { no: '02', judul: 'HTML5 Semantic', deskripsi: 'Penggunaan elemen semantic', namaFile: 'Modul_HTML5.pdf', fileUrl: '', ukuran: '2.0 MB' }
            ]
        },
        'basis_data': {
            totalPertemuan: 12,
            materiDiunggah: 6,
            pertemuan: [
                { no: '01', judul: 'ERD & Conceptual Data', deskripsi: 'Perancangan skema basis data', namaFile: 'Modul_ERD.pdf', fileUrl: '', ukuran: '2.5 MB' }
            ]
        }
    };

    function renderDataKelas() {
        const selectedKey = document.getElementById('selectKelas').value;
        const currentData = dataPraktikum[selectedKey];

        document.getElementById('totalPertemuan').innerText = currentData.totalPertemuan;
        document.getElementById('materiDiunggah').innerText = currentData.materiDiunggah;

        const container = document.getElementById('containerPertemuan');
        container.innerHTML = '';

        currentData.pertemuan.forEach((item, index) => {
            container.innerHTML += `
                <div class="p-4 flex items-center justify-between gap-4 hover:bg-slate-50/80 transition">
                    <div class="flex items-center gap-4 min-w-0">
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-800 font-bold text-sm flex items-center justify-center shrink-0">
                            ${item.no}
                        </div>
                        <div class="min-w-0">
                            <h4 class="text-xs font-bold text-slate-800 truncate">${item.judul}</h4>
                            <p class="text-[11px] text-slate-400 mt-0.5 truncate">${item.deskripsi}</p>
                            <button onclick="openModalMateri(${index})" class="inline-block mt-1 text-[10px] font-bold text-emerald-700 hover:underline">
                                Materi tersedia<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pertemuan & Materi | SIPRAK</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * { box-sizing: border-box; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f5f7f8; color: #23352f; }
        :root { --green-dark: #075c46; --green-deep: #064b3b; --green-main: #087f60; --green-light: #e8f5ef; --border: #e5ebe8; }
        .sidebar { background: var(--green-deep); color: #eaf4ef; }
        .nav-link { display: flex; align-items: center; gap: 10px; padding: 9px 12px; border-radius: 10px; font-size: 11.5px; font-weight: 500; color: #c4d7cf; transition: background .2s, color .2s; }
        .nav-link:hover { background: rgba(255,255,255,.08); color: white; }
        .nav-link.active { background: #e8f5ef !important; color: #075c46 !important; font-weight: 600; }
        .nav-icon { display: flex; align-items: center; justify-content: center; width: 30px; height: 30px; flex-shrink: 0; border-radius: 8px; background: rgba(255,255,255,.08); color: #c4d7cf; }
        .nav-link.active .nav-icon { background: #d2ebdf !important; color: #075c46 !important; }
        .surface { background: #fff; border: 1px solid var(--border); border-radius: 14px; }
        .field { width: 100%; border: 1px solid #e1e9e5; background: #fafcfb; border-radius: 9px; padding: 9px 12px; font-size: 12px; outline: none; }
        .field:focus { border-color: #70bda0; box-shadow: 0 0 0 3px rgba(8,127,96,.08); }
        .btn-primary { background: var(--green-dark); color: white; border-radius: 9px; padding: 9px 16px; font-size: 12px; font-weight: 600; transition: background .2s; }
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

    <!-- SIDEBAR -->
    <aside id="sidebar" class="sidebar fixed inset-y-0 left-0 w-[250px] flex flex-col z-50">
        <div class="h-[80px] px-5 flex items-center gap-3 border-b border-white/10">
            <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center p-1.5 shrink-0 shadow-sm">
                <img src="{{ asset('image/Logo-UINSSC.png') }}" alt="Logo UINSSC" class="w-full h-full object-contain" onerror="this.onerror=null; this.src='https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Logo_UIN_Siber_Syekh_Nurjati_Cirebon.png/600px-Logo_UIN_Siber_Syekh_Nurjati_Cirebon.png';">
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
                    <a href="{{ route('dosen.dashboard') }}" class="nav-link">
                        <span class="nav-icon"><svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/></svg></span>
                        <span class="flex-1">Dashboard</span>
                    </a>
                    <a href="{{ route('dosen.pertemuan.index') }}" class="nav-link active">
                        <span class="nav-icon"><svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg></span>
                        <span class="flex-1">Pertemuan &amp; Materi</span>
                    </a>
                    <a href="{{ route('dosen.monitoring.index') }}" class="nav-link">
                        <span class="nav-icon"><svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></span>
                        <span class="flex-1">Monitoring Kehadiran</span>
                    </a>
                    <a href="{{ route('dosen.laporan.index') }}" class="nav-link">
                        <span class="nav-icon"><svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg></span>
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
                <button type="submit" class="w-8 h-8 rounded-lg border border-white/10 bg-white/5 hover:bg-rose-600/80 text-emerald-200 hover:text-white flex items-center justify-center transition-all">
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <div class="main-area ml-[250px] min-h-screen flex flex-col">
        <header class="bg-white border-b border-[#e5ebe8] sticky top-0 z-30">
            <div class="min-h-[72px] px-6 lg:px-8 flex items-center justify-between">
                <div class="text-xs flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-600"></span>
                    <span class="font-bold text-emerald-900">UIN SSC</span>
                    <span class="text-slate-300">/</span>
                    <span class="text-slate-500 font-medium">Pertemuan &amp; Materi</span>
                </div>
            </div>
        </header>

        <main class="flex-1 px-6 py-6 lg:px-8 lg:py-8 space-y-6">
            <div>
                <h2 class="text-xl font-bold tracking-tight text-[#183c30]">Pertemuan &amp; Materi</h2>
                <p class="text-xs text-slate-500 mt-1">Kelola jadwal, materi, dan aktivitas praktikum.</p>
            </div>

            <!-- SELECT KELAS PRAKTIKUM -->
            <div class="surface p-4 space-y-1.5">
                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider">PILIH KELAS PRAKTIKUM</label>
                <select id="selectKelas" onchange="renderDataKelas()" class="field font-bold text-slate-800 text-xs py-2">
                    <option value="kelas_a">Pemrograman Web — Kelas A · Ganjil 2026/2027</option>
                    <option value="kelas_b">Pemrograman Web — Kelas B · Genap 2026/2027</option>
                    <option value="basis_data">Basis Data — Kelas B2 · Ganjil 2026/2027</option>
                </select>
            </div>

            <!-- STATS CARDS -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="surface p-4 flex items-start gap-3">
                    <div class="w-9 h-9 rounded-lg bg-emerald-50 text-emerald-700 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    </div>
                    <div>
                        <p class="text-[11px] text-slate-400 font-semibold">Total Pertemuan</p>
                        <p id="totalPertemuan" class="text-2xl font-bold text-slate-800 mt-0.5">14</p>
                        <p class="text-[10px] text-slate-400 mt-1">Target per semester</p>
                    </div>
                </div>

                <div class="surface p-4 flex items-start gap-3">
                    <div class="w-9 h-9 rounded-lg bg-emerald-50 text-emerald-700 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                    </div>
                    <div>
                        <p class="text-[11px] text-slate-400 font-semibold">Materi Diunggah</p>
                        <p id="materiDiunggah" class="text-2xl font-bold text-slate-800 mt-0.5">8</p>
                        <p class="text-[10px] text-slate-400 mt-1">Total berkas materi</p>
                    </div>
                </div>
            </div>

            <!-- DAFTAR PERTEMUAN -->
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-sm font-bold text-slate-800">Daftar Pertemuan</h3>
                    <button onclick="openModalTambah()" class="btn-primary inline-flex items-center gap-1.5">+ Tambah Pertemuan</button>
                </div>

                <div id="containerPertemuan" class="surface overflow-hidden divide-y divide-slate-100">
                    <!-- Render otomatis via JavaScript -->
                </div>
            </div>

            <footer class="pt-4 pb-2">
                <p class="text-[10px] text-slate-400">© {{ date('Y') }} SIPRAK · UIN Siber Syekh Nurjati Cirebon</p>
            </footer>
        </main>
    </div>
</div>

<!-- MODAL TAMBAH PERTEMUAN -->
<div id="modalTambah" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-md w-full p-6 space-y-4 shadow-xl">
        <div class="flex justify-between items-center border-b border-slate-100 pb-3">
            <h3 class="text-sm font-bold text-slate-800">Tambah Pertemuan Baru</h3>
            <button onclick="closeModalTambah()" class="text-slate-400 hover:text-slate-600 font-bold">✕</button>
        </div>

        <div class="space-y-3">
            <div>
                <label class="block text-[11px] font-semibold text-slate-600 mb-1">Nomor Pertemuan</label>
                <input type="number" id="inputNoPertemuan" placeholder="Misal: 04" class="field text-xs">
            </div>
            <div>
                <label class="block text-[11px] font-semibold text-slate-600 mb-1">Judul Pertemuan</label>
                <input type="text" id="inputJudul" placeholder="Misal: Proyek Perangkat Lunak" class="field text-xs">
            </div>
            <div>
                <label class="block text-[11px] font-semibold text-slate-600 mb-1">Deskripsi Singkat</label>
                <input type="text" id="inputDeskripsi" placeholder="Misal: buku panduan" class="field text-xs">
            </div>
            <div>
                <label class="block text-[11px] font-semibold text-slate-600 mb-1">Unggah Materi (PDF/ZIP)</label>
                <input type="file" id="inputFileMateri" class="field text-xs py-1.5">
            </div>
        </div>

        <div class="flex justify-end gap-2 pt-2 border-t border-slate-100">
            <button onclick="closeModalTambah()" class="px-4 py-2 rounded-lg border border-slate-200 text-xs font-semibold text-slate-600 hover:bg-slate-50">Batal</button>
            <button onclick="simpanPertemuanBaru()" class="btn-primary py-2 px-4 text-xs">Simpan Pertemuan</button>
        </div>
    </div>
</div>

<!-- MODAL EDIT PERTEMUAN -->
<div id="modalEdit" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-md w-full p-6 space-y-4 shadow-xl">
        <div class="flex justify-between items-center border-b border-slate-100 pb-3">
            <h3 class="text-sm font-bold text-slate-800">Edit Pertemuan</h3>
            <button onclick="closeModalEdit()" class="text-slate-400 hover:text-slate-600 font-bold">✕</button>
        </div>

        <input type="hidden" id="editIndex">
        <div class="space-y-3">
            <div>
                <label class="block text-[11px] font-semibold text-slate-600 mb-1">Nomor Pertemuan</label>
                <input type="text" id="editNoPertemuan" class="field text-xs">
            </div>
            <div>
                <label class="block text-[11px] font-semibold text-slate-600 mb-1">Judul Pertemuan</label>
                <input type="text" id="editJudul" class="field text-xs">
            </div>
            <div>
                <label class="block text-[11px] font-semibold text-slate-600 mb-1">Deskripsi Singkat</label>
                <input type="text" id="editDeskripsi" class="field text-xs">
            </div>
        </div>

        <div class="flex justify-end gap-2 pt-2 border-t border-slate-100">
            <button onclick="closeModalEdit()" class="px-4 py-2 rounded-lg border border-slate-200 text-xs font-semibold text-slate-600 hover:bg-slate-50">Batal</button>
            <button onclick="simpanEditPertemuan()" class="btn-primary py-2 px-4 text-xs">Simpan Perubahan</button>
        </div>
    </div>
</div>

<!-- MODAL CEK MATERI -->
<div id="modalMateri" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-md w-full p-6 space-y-4 shadow-xl">
        <div class="flex justify-between items-center border-b border-slate-100 pb-3">
            <h3 class="text-sm font-bold text-slate-800" id="detailJudulMateri">Detail Materi</h3>
            <button onclick="closeModalMateri()" class="text-slate-400 hover:text-slate-600 font-bold">✕</button>
        </div>

        <div class="space-y-3">
            <p class="text-xs text-slate-500" id="detailDeskripsiMateri">-</p>
            <div class="p-4 bg-emerald-50 border border-emerald-100 rounded-xl flex items-center justify-between">
                <div class="flex items-center gap-3 min-w-0">
                    <div class="w-8 h-8 rounded-lg bg-emerald-700 text-white flex items-center justify-center font-bold text-xs shrink-0">FILE</div>
                    <div class="min-w-0">
                        <p class="text-xs font-bold text-emerald-950 truncate" id="detailNamaFile">Modul_Praktikum.pdf</p>
                        <p class="text-[10px] text-emerald-700" id="detailUkuranFile">2.4 MB · Diunggah oleh Dosen</p>
                    </div>
                </div>
                <!-- TOMBOL UNDUH AKTIF -->
                <a id="btnDownloadMateri" href="#" download class="px-3 py-1.5 bg-emerald-700 text-white rounded-lg text-xs font-semibold hover:bg-emerald-800 shrink-0 inline-flex items-center gap-1">
                    Unduh
                </a>
            </div>
        </div>

        <div class="flex justify-end pt-2 border-t border-slate-100">
            <button onclick="closeModalMateri()" class="btn-primary py-2 px-4 text-xs">Tutup</button>
        </div>
    </div>
</div>

<script>
    const dataPraktikum = {
        'kelas_a': {
            totalPertemuan: 14,
            materiDiunggah: 8,
            pertemuan: [
                { no: '01', judul: 'Pengenalan Praktikum', deskripsi: 'Pengantar dan aturan laboratorium', namaFile: 'Modul_01_Pengenalan.pdf', fileUrl: '', ukuran: '1.8 MB' },
                { no: '02', judul: 'Dasar HTML', deskripsi: 'Struktur dokumen HTML', namaFile: 'Modul_02_HTML.pdf', fileUrl: '', ukuran: '2.1 MB' },
                { no: '03', judul: 'Dasar CSS', deskripsi: 'Styling halaman web', namaFile: 'Modul_03_CSS.pdf', fileUrl: '', ukuran: '3.4 MB' }
            ]
        },
        'kelas_b': {
            totalPertemuan: 16,
            materiDiunggah: 12,
            pertemuan: [
                { no: '01', judul: 'Pengenalan Web Genap', deskripsi: 'Aturan & Silabus Praktikum Genap', namaFile: 'Silabus_Genap.pdf', fileUrl: '', ukuran: '1.2 MB' },
                { no: '02', judul: 'HTML5 Semantic', deskripsi: 'Penggunaan elemen semantic', namaFile: 'Modul_HTML5.pdf', fileUrl: '', ukuran: '2.0 MB' }
            ]
        },
        'basis_data': {
            totalPertemuan: 12,
            materiDiunggah: 6,
            pertemuan: [
                { no: '01', judul: 'ERD & Conceptual Data', deskripsi: 'Perancangan skema basis data', namaFile: 'Modul_ERD.pdf', fileUrl: '', ukuran: '2.5 MB' }
            ]
        }
    };

    function renderDataKelas() {
        const selectedKey = document.getElementById('selectKelas').value;
        const currentData = dataPraktikum[selectedKey];

        document.getElementById('totalPertemuan').innerText = currentData.totalPertemuan;
        document.getElementById('materiDiunggah').innerText = currentData.materiDiunggah;

        const container = document.getElementById('containerPertemuan');
        container.innerHTML = '';

        currentData.pertemuan.forEach((item, index) => {
            container.innerHTML += `
                <div class="p-4 flex items-center justify-between gap-4 hover:bg-slate-50/80 transition">
                    <div class="flex items-center gap-4 min-w-0">
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-800 font-bold text-sm flex items-center justify-center shrink-0">
                            ${item.no}
                        </div>
                        <div class="min-w-0">
                            <h4 class="text-xs font-bold text-slate-800 truncate">${item.judul}</h4>
                            <p class="text-[11px] text-slate-400 mt-0.5 truncate">${item.deskripsi}</p>
                            <button onclick="openModalMateri(${index})" class="inline-block mt-1 text-[10px] font-bold text-emerald-700 hover:underline">
                                Materi tersedia 
                            </button>
                        </div>
                    </div>
                    <div class="flex items-center gap-1.5 shrink-0">
                        <button onclick="openModalEdit(${index})" class="px-2.5 py-1.5 rounded-lg border border-slate-200 hover:bg-slate-100 text-slate-600 text-[11px] font-semibold transition inline-flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            Edit
                        </button>
                        <button onclick="hapusPertemuan(${index})" class="px-2.5 py-1.5 rounded-lg border border-rose-200 hover:bg-rose-50 text-rose-600 text-[11px] font-semibold transition inline-flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                            Hapus
                        </button>
                    </div>
                </div>
            `;
        });
    }

    // SIMPAN PERTEMUAN BARU & BUAT DOWNLOAD LINK DARI FILE ASLI
    function simpanPertemuanBaru() {
        const no = document.getElementById('inputNoPertemuan').value || '04';
        const judul = document.getElementById('inputJudul').value || 'Pertemuan Baru';
        const deskripsi = document.getElementById('inputDeskripsi').value || 'Materi praktikum';
        const fileInput = document.getElementById('inputFileMateri');

        let namaFile = 'Materi_Baru.pdf';
        let fileUrl = '';
        let ukuran = '2.4 MB';

        if (fileInput.files && fileInput.files[0]) {
            const uploadedFile = fileInput.files[0];
            namaFile = uploadedFile.name;
            ukuran = (uploadedFile.size / (1024 * 1024)).toFixed(1) + ' MB';
            // Membuat Object URL sementara untuk diunduh langsung
            fileUrl = URL.createObjectURL(uploadedFile);
        }

        const selectedKey = document.getElementById('selectKelas').value;
        dataPraktikum[selectedKey].pertemuan.push({
            no: no.padStart(2, '0'),
            judul: judul,
            deskripsi: deskripsi,
            namaFile: namaFile,
            fileUrl: fileUrl,
            ukuran: ukuran
        });

        dataPraktikum[selectedKey].totalPertemuan += 1;
        dataPraktikum[selectedKey].materiDiunggah += 1;

        closeModalTambah();
        renderDataKelas();
    }

    // MODAL CEK MATERI & ATUR LINK DOWNLOAD
    function openModalMateri(index) {
        const selectedKey = document.getElementById('selectKelas').value;
        const item = dataPraktikum[selectedKey].pertemuan[index];

        document.getElementById('detailJudulMateri').innerText = item.judul;
        document.getElementById('detailDeskripsiMateri').innerText = item.deskripsi;
        document.getElementById('detailNamaFile').innerText = item.namaFile;
        document.getElementById('detailUkuranFile').innerText = `${item.ukuran} · Diunggah oleh Dosen`;

        const btnDownload = document.getElementById('btnDownloadMateri');
        btnDownload.setAttribute('download', item.namaFile);

        if (item.fileUrl) {
            btnDownload.setAttribute('href', item.fileUrl);
        } else {
            // Jika dummy data bawaan, buatkan file teks buatan saat diunduh
            const dummyBlob = new Blob([`Materi Praktikum: ${item.judul}\nDeskripsi: ${item.deskripsi}`], { type: 'text/plain' });
            btnDownload.setAttribute('href', URL.createObjectURL(dummyBlob));
        }

        document.getElementById('modalMateri').classList.remove('hidden');
    }

    function closeModalMateri() { document.getElementById('modalMateri').classList.add('hidden'); }

    function openModalTambah() {
        document.getElementById('inputNoPertemuan').value = '';
        document.getElementById('inputJudul').value = '';
        document.getElementById('inputDeskripsi').value = '';
        document.getElementById('inputFileMateri').value = '';
        document.getElementById('modalTambah').classList.remove('hidden');
    }
    function closeModalTambah() { document.getElementById('modalTambah').classList.add('hidden'); }

    function openModalEdit(index) {
        const selectedKey = document.getElementById('selectKelas').value;
        const item = dataPraktikum[selectedKey].pertemuan[index];

        document.getElementById('editIndex').value = index;
        document.getElementById('editNoPertemuan').value = item.no;
        document.getElementById('editJudul').value = item.judul;
        document.getElementById('editDeskripsi').value = item.deskripsi;

        document.getElementById('modalEdit').classList.remove('hidden');
    }
    function closeModalEdit() { document.getElementById('modalEdit').classList.add('hidden'); }

    function simpanEditPertemuan() {
        const index = document.getElementById('editIndex').value;
        const selectedKey = document.getElementById('selectKelas').value;

        dataPraktikum[selectedKey].pertemuan[index].no = document.getElementById('editNoPertemuan').value;
        dataPraktikum[selectedKey].pertemuan[index].judul = document.getElementById('editJudul').value;
        dataPraktikum[selectedKey].pertemuan[index].deskripsi = document.getElementById('editDeskripsi').value;

        closeModalEdit();
        renderDataKelas();
    }

    function hapusPertemuan(index) {
        if (confirm('Apakah Anda yakin ingin menghapus pertemuan ini?')) {
            const selectedKey = document.getElementById('selectKelas').value;
            dataPraktikum[selectedKey].pertemuan.splice(index, 1);
            dataPraktikum[selectedKey].totalPertemuan -= 1;
            renderDataKelas();
        }
    }

    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('open');
        document.getElementById('mobileOverlay').classList.toggle('show');
    }

    renderDataKelas();
</script>

</body>
</html>
                            </button>
                        </div>
                    </div>
                    <div class="flex items-center gap-1.5 shrink-0">
                        <button onclick="openModalEdit(${index})" class="px-2.5 py-1.5 rounded-lg border border-slate-200 hover:bg-slate-100 text-slate-600 text-[11px] font-semibold transition inline-flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            Edit
                        </button>
                        <button onclick="hapusPertemuan(${index})" class="px-2.5 py-1.5 rounded-lg border border-rose-200 hover:bg-rose-50 text-rose-600 text-[11px] font-semibold transition inline-flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                            Hapus
                        </button>
                    </div>
                </div>
            `;
        });
    }

    // SIMPAN PERTEMUAN BARU & BUAT DOWNLOAD LINK DARI FILE ASLI
    function simpanPertemuanBaru() {
        const no = document.getElementById('inputNoPertemuan').value || '04';
        const judul = document.getElementById('inputJudul').value || 'Pertemuan Baru';
        const deskripsi = document.getElementById('inputDeskripsi').value || 'Materi praktikum';
        const fileInput = document.getElementById('inputFileMateri');

        let namaFile = 'Materi_Baru.pdf';
        let fileUrl = '';
        let ukuran = '2.4 MB';

        if (fileInput.files && fileInput.files[0]) {
            const uploadedFile = fileInput.files[0];
            namaFile = uploadedFile.name;
            ukuran = (uploadedFile.size / (1024 * 1024)).toFixed(1) + ' MB';
            // Membuat Object URL sementara untuk diunduh langsung
            fileUrl = URL.createObjectURL(uploadedFile);
        }

        const selectedKey = document.getElementById('selectKelas').value;
        dataPraktikum[selectedKey].pertemuan.push({
            no: no.padStart(2, '0'),
            judul: judul,
            deskripsi: deskripsi,
            namaFile: namaFile,
            fileUrl: fileUrl,
            ukuran: ukuran
        });

        dataPraktikum[selectedKey].totalPertemuan += 1;
        dataPraktikum[selectedKey].materiDiunggah += 1;

        closeModalTambah();
        renderDataKelas();
    }

    // MODAL CEK MATERI & ATUR LINK DOWNLOAD
    function openModalMateri(index) {
        const selectedKey = document.getElementById('selectKelas').value;
        const item = dataPraktikum[selectedKey].pertemuan[index];

        document.getElementById('detailJudulMateri').innerText = item.judul;
        document.getElementById('detailDeskripsiMateri').innerText = item.deskripsi;
        document.getElementById('detailNamaFile').innerText = item.namaFile;
        document.getElementById('detailUkuranFile').innerText = `${item.ukuran} · Diunggah oleh Dosen`;

        const btnDownload = document.getElementById('btnDownloadMateri');
        btnDownload.setAttribute('download', item.namaFile);

        if (item.fileUrl) {
            btnDownload.setAttribute('href', item.fileUrl);
        } else {
            // Jika dummy data bawaan, buatkan file teks buatan saat diunduh
            const dummyBlob = new Blob([`Materi Praktikum: ${item.judul}\nDeskripsi: ${item.deskripsi}`], { type: 'text/plain' });
            btnDownload.setAttribute('href', URL.createObjectURL(dummyBlob));
        }

        document.getElementById('modalMateri').classList.remove('hidden');
    }

    function closeModalMateri() { document.getElementById('modalMateri').classList.add('hidden'); }

    function openModalTambah() {
        document.getElementById('inputNoPertemuan').value = '';
        document.getElementById('inputJudul').value = '';
        document.getElementById('inputDeskripsi').value = '';
        document.getElementById('inputFileMateri').value = '';
        document.getElementById('modalTambah').classList.remove('hidden');
    }
    function closeModalTambah() { document.getElementById('modalTambah').classList.add('hidden'); }

    function openModalEdit(index) {
        const selectedKey = document.getElementById('selectKelas').value;
        const item = dataPraktikum[selectedKey].pertemuan[index];

        document.getElementById('editIndex').value = index;
        document.getElementById('editNoPertemuan').value = item.no;
        document.getElementById('editJudul').value = item.judul;
        document.getElementById('editDeskripsi').value = item.deskripsi;

        document.getElementById('modalEdit').classList.remove('hidden');
    }
    function closeModalEdit() { document.getElementById('modalEdit').classList.add('hidden'); }

    function simpanEditPertemuan() {
        const index = document.getElementById('editIndex').value;
        const selectedKey = document.getElementById('selectKelas').value;

        dataPraktikum[selectedKey].pertemuan[index].no = document.getElementById('editNoPertemuan').value;
        dataPraktikum[selectedKey].pertemuan[index].judul = document.getElementById('editJudul').value;
        dataPraktikum[selectedKey].pertemuan[index].deskripsi = document.getElementById('editDeskripsi').value;

        closeModalEdit();
        renderDataKelas();
    }

    function hapusPertemuan(index) {
        if (confirm('Apakah Anda yakin ingin menghapus pertemuan ini?')) {
            const selectedKey = document.getElementById('selectKelas').value;
            dataPraktikum[selectedKey].pertemuan.splice(index, 1);
            dataPraktikum[selectedKey].totalPertemuan -= 1;
            renderDataKelas();
        }
    }

    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('open');
        document.getElementById('mobileOverlay').classList.toggle('show');
    }

    renderDataKelas();
</script>

</body>
</html>