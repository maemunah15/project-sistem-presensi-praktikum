<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap & Laporan Presensi | SIPRAK</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * { box-sizing: border-box; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f5f7f8; color: #23352f; }
        :root {
            --green-dark: #075c46;
            --green-deep: #064b3b;
            --green-main: #087f60;
            --green-light: #e8f5ef;
            --border: #e5ebe8;
        }
        .sidebar { background: var(--green-deep); color: #eaf4ef; }
        .nav-link {
            display: flex; align-items: center; gap: 10px; padding: 9px 12px;
            border-radius: 10px; font-size: 11.5px; font-weight: 500; color: #c4d7cf;
            transition: background .2s, color .2s;
        }
        .nav-link:hover { background: rgba(255,255,255,.08); color: white; }
        .nav-link.active { background: #e8f5ef !important; color: #075c46 !important; font-weight: 600; }
        .nav-icon { display: flex; align-items: center; justify-content: center; width: 20px; height: 20px; shrink-0; }
        .surface { background: #fff; border: 1px solid var(--border); border-radius: 14px; }
        .btn-primary { background: var(--green-dark); color: white; border-radius: 9px; padding: 8px 14px; font-size: 11.5px; font-weight: 600; transition: background .2s; }
        .btn-primary:hover { background: #064b3b; }
        .field {
            width: 100%; border: 1px solid #d9e2de; background: #fff;
            border-radius: 9px; padding: 7px 11px; font-size: 12px; color: #23352f;
            outline: none; transition: border-color .15s;
        }
        .field:focus { border-color: var(--green-main); }
        .data-table { width: 100%; border-collapse: collapse; font-size: 11.5px; }
        .data-table th {
            text-align: left; padding: 10px 14px; background: #fafcfb;
            color: #637870; font-size: 10px; font-weight: 700;
            text-transform: uppercase; letter-spacing: .04em; border-bottom: 1px solid #edf1ef;
        }
        .data-table td { padding: 11px 14px; border-bottom: 1px solid #f0f3f1; }
        .data-table tr:last-child td { border-bottom: none; }
        .mobile-overlay { display: none; }

        .print-only { display: none; }

        @media (max-width: 767px) {
            .sidebar { position: fixed; inset: 0 auto 0 0; width: 250px; z-index: 50; transform: translateX(-100%); transition: transform .25s ease; }
            .sidebar.open { transform: translateX(0); }
            .mobile-overlay.show { display: block; position: fixed; inset: 0; z-index: 40; background: rgba(12,31,24,.4); }
            .main-area { margin-left: 0 !important; }
        }

        @media print {
            .sidebar, header, .no-print, #mobileOverlay { display: none !important; }
            .main-area { margin-left: 0 !important; padding: 0 !important; }
            .surface { border: none !important; box-shadow: none !important; padding: 0 !important; background: transparent !important; }
            body { background: #fff !important; color: #111 !important; font-size: 10.5pt; }
            .print-only { display: block !important; }
            .data-table { font-size: 9pt; width: 100% !important; border: 1px solid #333 !important; }
            .data-table th, .data-table td { border: 1px solid #555 !important; padding: 6px 8px !important; color: #000 !important; }
            .data-table th { background: #f2f2f2 !important; font-weight: bold !important; text-align: center; }
            .page-break-avoid { page-break-inside: avoid; }
        }
    </style>
</head>

<body class="min-h-screen">

<div id="mobileOverlay" class="mobile-overlay" onclick="toggleSidebar()"></div>

<div class="min-h-screen">

    <!-- SIDEBAR -->
    @include('partials.admin-sidebar', ['active' => 'laporan'])

    <!-- MAIN AREA -->
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

            <!-- HEADER TITLE & DOWNLOAD ACTIONS -->
            <div class="surface p-5 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 border border-emerald-200 flex items-center justify-center text-emerald-800 shrink-0">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-slate-800">Rekap &amp; Laporan Presensi Praktikum</h2>
                        <p class="text-xs text-slate-500 mt-0.5">Filter data kehadiran praktikum, pantau ringkasan, dan unduh laporan.</p>
                    </div>
                </div>

                <div class="flex items-center gap-2 no-print">
                    <!-- Tombol Download / Cetak PDF Saja -->
                    <button onclick="downloadPDF()" class="px-4 py-2.5 rounded-xl bg-rose-700 hover:bg-rose-800 text-white text-xs font-bold shadow-sm hover:shadow inline-flex items-center gap-2 transition cursor-pointer">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><path d="M12 18v-6m-3 3 3 3 3-3"/></svg>
                        <span>Cetak / Unduh PDF</span>
                    </button>
                </div>
            </div>

            <!-- KOP SURAT FORMAL UNTUK CETAK PDF (HANYA TAMPIL SAAT PRINT) -->
            <div class="print-only mb-6 text-center border-b-2 border-black pb-4">
                <p class="text-xs font-bold tracking-wider uppercase text-black">KEMENTERIAN AGAMA REPUBLIK INDONESIA</p>
                <h1 class="text-base font-extrabold tracking-wide uppercase text-black mt-0.5">UNIVERSITAS ISLAM NEGERI SIBER SYEKH NURJATI CIREBON</h1>
                <p class="text-[11px] font-semibold text-black">PUSAT LABORATORIUM KOMPUTER &amp; SISTEM PRAKTIKUM TERPADU (SIPRAK)</p>
                <p class="text-[9.5px] text-gray-700 mt-0.5">Jl. Perjuangan By Pass Sunyaragi, Cirebon, Jawa Barat 45131 · Laman: https://uinssc.ac.id</p>
                <div class="border-b border-black mt-2 mb-4"></div>

                <h2 class="text-sm font-bold uppercase underline tracking-wide">LAPORAN REKAPITULASI PRESENSI MAHASISWA PRAKTIKUM</h2>
                <div class="mt-2 text-[10.5px] text-left grid grid-cols-2 gap-x-6 gap-y-1 max-w-2xl mx-auto">
                    <div><span class="font-bold">Mata Praktikum:</span> {{ $currentKelas->mataPraktikum->nama ?? '-' }} ({{ $currentKelas->mataPraktikum->kode ?? '-' }})</div>
                    <div><span class="font-bold">Semester / T.A:</span> {{ $selectedSemester }}</div>
                    <div><span class="font-bold">Kelas:</span> Kelas {{ $currentKelas->nama_kelas ?? '-' }}</div>
                    <div><span class="font-bold">Periode Rentang:</span> 
                        {{ $startDate ? \Carbon\Carbon::parse($startDate)->format('d/m/Y') : 'Awal' }} s/d {{ $endDate ? \Carbon\Carbon::parse($endDate)->format('d/m/Y') : 'Sekarang' }}
                    </div>
                </div>
            </div>

            <!-- 1. FILTER LAPORAN BERDASARKAN RENTANG TANGGAL (DATE RANGE) -->
            <section class="surface p-5 space-y-4 no-print shadow-sm">
                <div class="flex items-center justify-between border-b pb-3">
                    <h3 class="text-xs font-bold text-slate-800 flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg>
                        <span>Filter Data Presensi &amp; Rentang Tanggal</span>
                    </h3>
                    <span class="text-[11px] text-slate-400">Pilih kelas dan tentukan rentang tanggal awal hingga akhir</span>
                </div>

                <form action="{{ route('admin.laporan.index') }}" method="GET" class="space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <!-- Filter Kelas Praktikum -->
                        <div>
                            <label class="block text-[11px] font-semibold text-slate-600 mb-1">Kelas Praktikum</label>
                            <select name="kelas_id" class="field" onchange="this.form.submit()">
                                @foreach($kelasList as $k)
                                    <option value="{{ $k->id }}" {{ $selectedKelasId == $k->id ? 'selected' : '' }}>
                                        Kelas {{ $k->nama_kelas }} ({{ $k->mataPraktikum->nama ?? '-' }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Filter Semester -->
                        <div>
                            <label class="block text-[11px] font-semibold text-slate-600 mb-1">Semester / Tahun Ajaran</label>
                            <select name="semester" class="field">
                                <option value="Ganjil 2026/2027" {{ $selectedSemester == 'Ganjil 2026/2027' ? 'selected' : '' }}>Ganjil 2026/2027</option>
                                <option value="Genap 2025/2026" {{ $selectedSemester == 'Genap 2025/2026' ? 'selected' : '' }}>Genap 2025/2026</option>
                            </select>
                        </div>

                        <!-- Date Range Picker: Dari Tanggal -->
                        <div>
                            <label class="block text-[11px] font-semibold text-slate-600 mb-1">Dari Tanggal (Mulai)</label>
                            <input type="date" name="start_date" value="{{ $startDate ?? '' }}" class="field text-xs">
                        </div>

                        <!-- Date Range Picker: Sampai Tanggal -->
                        <div>
                            <label class="block text-[11px] font-semibold text-slate-600 mb-1">Sampai Tanggal (Selesai)</label>
                            <input type="date" name="end_date" value="{{ $endDate ?? '' }}" class="field text-xs">
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2 pt-2 border-t border-slate-100">
                        <div class="text-[11px] text-slate-500">
                            @if($startDate || $endDate)
                                <span class="font-medium text-emerald-800">Rentang filter aktif:</span>
                                {{ $startDate ? \Carbon\Carbon::parse($startDate)->format('d M Y') : 'Awal' }} s/d {{ $endDate ? \Carbon\Carbon::parse($endDate)->format('d M Y') : 'Sekarang' }}
                            @else
                                <span class="text-slate-400">Menampilkan seluruh data pertemuan kelas.</span>
                            @endif
                        </div>
                        <div class="flex items-center gap-2 self-end sm:self-auto">
                            <a href="{{ route('admin.laporan.index') }}" class="px-4 py-2 rounded-xl border text-xs font-semibold text-slate-600 hover:bg-slate-50 transition">Reset Filter</a>
                            <button type="submit" class="px-4 py-2 rounded-xl bg-[#075c46] hover:bg-[#064b3b] text-white text-xs font-bold shadow-sm transition">Terapkan Filter</button>
                        </div>
                    </div>
                </form>
            </section>

            <!-- 2. RINGKASAN KEHADIRAN (STATISTIK) - TANPA EMOJI -->
            <section class="space-y-3 no-print">
                <div class="flex justify-between items-center">
                    <h3 class="text-xs font-bold text-slate-800">Ringkasan Statistik Kehadiran</h3>
                    <span class="text-[11px] text-slate-500 font-medium">
                        {{ $currentKelas ? 'Kelas '.$currentKelas->nama_kelas.' - '.($currentKelas->mataPraktikum->nama ?? '') : 'Seluruh Praktikum' }}
                    </span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="surface p-4 flex items-center gap-3 shadow-xs">
                        <div class="w-10 h-10 rounded-xl bg-slate-100 text-slate-700 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-slate-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-semibold text-slate-400 uppercase tracking-wider">Total Pertemuan</p>
                            <p class="text-xl font-bold text-slate-800 mt-0.5">{{ $totalPertemuan }} Pertemuan</p>
                        </div>
                    </div>

                    <div class="surface p-4 flex items-center gap-3 shadow-xs">
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-emerald-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-semibold text-slate-400 uppercase tracking-wider">Total Hadir</p>
                            <p class="text-xl font-bold text-emerald-800 mt-0.5">{{ $totalHadir }} Kali</p>
                        </div>
                    </div>

                    <div class="surface p-4 flex items-center gap-3 shadow-xs">
                        <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-amber-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-semibold text-slate-400 uppercase tracking-wider">Total Izin / Sakit</p>
                            <p class="text-xl font-bold text-amber-800 mt-0.5">{{ $totalIzin }} Kali</p>
                        </div>
                    </div>

                    <div class="surface p-4 flex items-center gap-3 shadow-xs">
                        <div class="w-10 h-10 rounded-xl bg-rose-50 text-rose-700 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-rose-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-semibold text-slate-400 uppercase tracking-wider">Total Alpha</p>
                            <p class="text-xl font-bold text-rose-800 mt-0.5">{{ $totalAlpha }} Kali</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- 3. REKAP PER MAHASISWA -->
            <section class="surface overflow-hidden shadow-sm" id="reportArea">
                <div class="p-4 border-b border-[#edf1ef] flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2 no-print bg-white">
                    <div>
                        <h3 class="text-xs font-bold text-slate-800">Daftar Rekap Kehadiran Mahasiswa</h3>
                        <p class="text-[11px] text-slate-400 mt-0.5">Akumulasi presensi per mahasiswa pada periode ini.</p>
                    </div>
                    <div class="text-[11px] font-semibold text-slate-600 bg-slate-50 px-2.5 py-1 rounded-lg border border-slate-200">
                        Total: {{ count($rekapData) }} Mahasiswa Terdaftar
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="data-table" id="tableRekap">
                        <thead>
                            <tr>
                                <th class="w-12 text-center">NO</th>
                                <th>NIM</th>
                                <th>NAMA MAHASISWA</th>
                                <th>MATA PRAKTIKUM</th>
                                <th>KELAS</th>
                                <th class="text-center">HADIR</th>
                                <th class="text-center">IZIN / SAKIT</th>
                                <th class="text-center">ALPHA</th>
                                <th class="text-center">PERSENTASE</th>
                                <th class="text-center">STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($rekapData as $index => $item)
                                <tr>
                                    <td class="text-slate-400 font-medium text-center">{{ $index + 1 }}</td>
                                    <td class="font-bold text-slate-700 font-mono">{{ $item['nim'] }}</td>
                                    <td class="font-semibold text-slate-800">{{ $item['nama'] }}</td>
                                    <td class="text-slate-600">{{ $item['mata_praktikum'] }}</td>
                                    <td>
                                        <span class="px-2 py-0.5 rounded bg-emerald-50 border border-emerald-200 text-[10px] font-bold text-emerald-800">
                                            {{ $item['kelas'] }}
                                        </span>
                                    </td>
                                    <td class="text-center font-bold text-emerald-700">{{ $item['hadir'] }}</td>
                                    <td class="text-center font-semibold text-amber-700">{{ $item['izin'] }}</td>
                                    <td class="text-center font-semibold text-rose-700">{{ $item['alpha'] }}</td>
                                    <td class="text-center">
                                        <span class="font-bold text-xs {{ $item['persentase'] >= 75 ? 'text-emerald-700' : 'text-rose-600' }}">
                                            {{ $item['persentase'] }}%
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        @if($item['persentase'] >= 75)
                                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">Memenuhi</span>
                                        @else
                                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-rose-100 text-rose-800">Kurang</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center py-8 text-slate-400">
                                        Tidak ada data mahasiswa ditemukan untuk filter ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- TANDA TANGAN FORMAL SAAT CETAK PDF (HANYA TAMPIL SAAT PRINT) -->
            <div class="print-only mt-10 page-break-avoid">
                <div class="flex justify-between items-start text-[11px] pt-6">
                    <div class="text-center w-64">
                        <p class="font-normal text-black">Mengetahui,</p>
                        <p class="font-bold text-black mt-0.5">Kepala Laboratorium</p>
                        <div class="h-20"></div>
                        <p class="font-bold underline text-black">Dr. H. Ahmad Fauzi, M.Kom.</p>
                        <p class="text-[9.5px] text-gray-700">NIP. 19780512 200501 1 003</p>
                    </div>

                    <div class="text-center w-64">
                        <p class="font-normal text-black">Cirebon, {{ date('d F Y') }}</p>
                        <p class="font-bold text-black mt-0.5">Dosen Pengampu Praktikum</p>
                        <div class="h-20"></div>
                        <p class="font-bold underline text-black">{{ Auth::user()->nama ?? 'Dosen Pengampu, M.Kom.' }}</p>
                        <p class="text-[9.5px] text-gray-700">NIP. {{ Auth::user()->nip_nim ?? '19850214 201012 1 002' }}</p>
                    </div>
                </div>
            </div>

            <footer class="pt-4 pb-2 no-print">
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

    // Fitur Cetak / Download PDF
    function downloadPDF() {
        window.print();
    }
</script>

</body>
</html>