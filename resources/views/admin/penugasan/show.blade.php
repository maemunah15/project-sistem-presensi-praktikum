<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Mapping Kelas | SIPRAK</title>

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
            padding: 8px 12px;
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
            padding: 8px 14px;
            font-size: 11.5px;
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
            padding: 10px 14px;
            border-bottom: 1px solid var(--border);
        }

        .data-table td {
            padding: 11px 14px;
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

    <!-- SIDEBAR -->
    @include('partials.admin-sidebar', ['active' => 'penugasan'])

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
                        <a href="{{ route('admin.penugasan.index') }}" class="text-slate-500 hover:text-emerald-700 font-medium">Penugasan &amp; Mapping</a>
                        <span class="text-slate-300">/</span>
                        <span class="px-2.5 py-0.5 rounded-full bg-emerald-50 border border-emerald-100 text-emerald-800 font-semibold text-[11px]">Detail Plotting Kelas</span>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.penugasan.index') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-slate-200 text-xs font-semibold text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition shadow-sm">
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                        <span>Kembali ke Daftar Kelas</span>
                    </a>
                </div>
            </div>
        </header>

        <!-- PAGE CONTENT -->
        <main class="flex-1 px-6 py-6 lg:px-8 lg:py-8 space-y-6">

            @if(session('success'))
                <div class="p-3.5 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-xs font-medium flex justify-between items-center shadow-sm">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-600 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-emerald-700 hover:text-emerald-900">&times;</button>
                </div>
            @endif

            @if(session('error'))
                <div class="p-3.5 bg-rose-50 border border-rose-200 text-rose-800 rounded-xl text-xs font-medium flex justify-between items-center shadow-sm">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-rose-600 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        <span>{{ session('error') }}</span>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-rose-700 hover:text-rose-900">&times;</button>
                </div>
            @endif

            @if(session('info'))
                <div class="p-3.5 bg-blue-50 border border-blue-200 text-blue-800 rounded-xl text-xs font-medium flex justify-between items-center shadow-sm">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-blue-600 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                        <span>{{ session('info') }}</span>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-blue-700 hover:text-blue-900">&times;</button>
                </div>
            @endif

            <!-- BANNER DETAIL KELAS -->
            <div class="surface p-5 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 shadow-sm">
                <div>
                    <div class="flex items-center gap-3">
                        <h2 class="text-xl font-bold tracking-tight text-[#183c30]">{{ $kelas->mataPraktikum->nama ?? 'Praktikum' }}</h2>
                        <span class="px-2.5 py-0.5 rounded-md bg-emerald-100 text-emerald-800 font-bold text-xs border border-emerald-200">
                            Kelas {{ $kelas->nama_kelas ?? '4B' }}
                        </span>
                    </div>
                    <p class="text-xs text-slate-500 mt-1">
                        Tahun Ajaran: <span class="font-semibold text-slate-700">{{ $kelas->tahun_ajaran ?? '2026/2027' }}</span> · Semester: <span class="font-semibold text-slate-700">{{ $kelas->semester ?? 5 }}</span>
                    </p>
                </div>

                <a href="{{ route('admin.penugasan.index') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-slate-200 text-slate-600 hover:bg-slate-50 text-xs font-semibold transition">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                    <span>Kembali ke Daftar Kelas</span>
                </a>
            </div>

            <!-- TWO COLUMN LAYOUT: PENGAJAR & MAHASISWA -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <!-- CARD 1: PLOTTING PENGAJAR -->
                <section class="surface overflow-hidden flex flex-col shadow-sm">
                    <div class="p-4 border-b border-[#edf1ef] flex justify-between items-center bg-white">
                        <div>
                            <h3 class="text-xs font-bold text-slate-800">1. Plotting Pengajar (Dosen &amp; Asprak)</h3>
                            <p class="text-[11px] text-slate-400 mt-0.5">Tugaskan Dosen Pengampu atau Asisten Praktikum ke kelas ini.</p>
                        </div>
                        <span class="px-2.5 py-0.5 rounded-full bg-slate-100 text-slate-700 font-bold text-[11px]">
                            {{ $kelas->pengajar->count() }} Pengajar
                        </span>
                    </div>

                    <div class="p-4 border-b border-[#edf1ef] bg-slate-50/50">
                        <form action="{{ route('admin.penugasan.pengajar.store', $kelas->id) }}" method="POST" class="flex flex-col sm:flex-row gap-2">
                            @csrf
                            <select name="user_id" class="field flex-1" required>
                                <option value="">-- Pilih Dosen / Asprak --</option>
                                <optgroup label="Dosen Pengampu">
                                    @foreach($dosens as $d)
                                        <option value="{{ $d->id }}">{{ $d->nama }} ({{ $d->nip_nim }})</option>
                                    @endforeach
                                </optgroup>
                                <optgroup label="Asisten Praktikum">
                                    @foreach($aspraks as $a)
                                        <option value="{{ $a->id }}">{{ $a->nama }} ({{ $a->nip_nim }})</option>
                                    @endforeach
                                </optgroup>
                            </select>

                            <select name="tipe" class="field w-full sm:w-28" required>
                                <option value="dosen">Dosen</option>
                                <option value="asprak">Asprak</option>
                            </select>

                            <button type="submit" class="inline-flex items-center justify-center gap-1.5 px-3.5 py-2 rounded-xl bg-[#075c46] hover:bg-[#064b3b] text-white text-xs font-bold shadow-xs transition shrink-0 cursor-pointer">
                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
                                <span>Tugaskan</span>
                            </button>
                        </form>
                    </div>

                    <div class="overflow-x-auto flex-1">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>NAMA PENGAJAR</th>
                                    <th>PERAN</th>
                                    <th class="text-right">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($kelas->pengajar as $p)
                                    <tr>
                                        <td class="font-semibold text-slate-800">{{ $p->nama ?? '-' }}</td>
                                        <td>
                                            @php
                                                $roleTipe = $p->pivot->tipe ?? $p->role ?? 'dosen';
                                            @endphp
                                            @if($roleTipe === 'dosen')
                                                <span class="px-2 py-0.5 rounded bg-blue-50 text-blue-700 text-[10px] font-bold border border-blue-100">Dosen</span>
                                            @else
                                                <span class="px-2 py-0.5 rounded bg-emerald-50 text-emerald-700 text-[10px] font-bold border border-emerald-100">Asprak</span>
                                            @endif
                                        </td>
                                        <td class="text-right">
                                            <form action="{{ route('admin.penugasan.pengajar.destroy', $p->id) }}?kelas_id={{ $kelas->id }}" method="POST" onsubmit="return confirm('Hapus penugasan pengajar ini dari kelas?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg border border-rose-200 bg-rose-50 hover:bg-rose-100 text-rose-700 text-xs font-semibold transition" title="Hapus Pengajar">
                                                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                                    <span>Hapus</span>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center p-6 text-slate-400">Belum ada pengajar yang ditugaskan di kelas ini.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                <!-- CARD 2: MAPPING MAHASISWA -->
                <section class="surface overflow-hidden flex flex-col shadow-sm">
                    <div class="p-4 border-b border-[#edf1ef] flex flex-col sm:flex-row sm:items-center justify-between gap-3 bg-white">
                        <div>
                            <h3 class="text-xs font-bold text-slate-800">2. Mapping Rombel Mahasiswa</h3>
                            <p class="text-[11px] text-slate-400 mt-0.5">Mahasiswa yang terdaftar pada kelas rombel ini.</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="px-2.5 py-1 rounded-lg bg-emerald-50 text-emerald-800 font-bold text-xs border border-emerald-100">
                                {{ $kelas->mahasiswa->count() }} Mahasiswa
                            </span>
                            <button type="button" onclick="openModalMhs()" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-[#075c46] hover:bg-[#064b3b] text-white text-xs font-bold shadow-sm transition cursor-pointer">
                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
                                <span>Pilih Mahasiswa</span>
                            </button>
                        </div>
                    </div>

                    <!-- PENCARIAN MAHASISWA TERDAFTAR -->
                    @if($kelas->mahasiswa->count() > 0)
                        <div class="px-4 py-2.5 border-b border-[#edf1ef] bg-slate-50/50">
                            <div class="relative">
                                <input type="text" id="searchRegisteredMhs" oninput="filterRegisteredMhs()" placeholder="Cari mahasiswa di kelas ini (NIM / Nama)..." class="field pl-8 text-xs">
                                <svg class="w-3.5 h-3.5 text-slate-400 absolute left-2.5 top-2.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
                            </div>
                        </div>
                    @endif

                    <div class="overflow-x-auto flex-1">
                        <table class="data-table" id="tableRegisteredMhs">
                            <thead>
                                <tr>
                                    <th>NIM</th>
                                    <th>NAMA MAHASISWA</th>
                                    <th class="text-right">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($kelas->mahasiswa as $m)
                                    <tr class="registered-mhs-row">
                                        <td class="font-bold text-slate-700 font-mono nim-col">{{ $m->nip_nim ?? '-' }}</td>
                                        <td class="font-semibold text-slate-800 nama-col">{{ $m->nama ?? '-' }}</td>
                                        <td class="text-right">
                                            <form action="{{ route('admin.penugasan.mahasiswa.destroy', $m->id) }}?kelas_id={{ $kelas->id }}" method="POST" onsubmit="return confirm('Keluarkan mahasiswa {{ $m->nama }} ({{ $m->nip_nim }}) dari kelas ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg border border-rose-200 bg-rose-50 hover:bg-rose-100 text-rose-700 text-xs font-semibold transition" title="Keluarkan dari kelas">
                                                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                                    <span>Keluarkan</span>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr id="emptyRegisteredRow">
                                        <td colspan="3" class="text-center p-8 text-slate-400">
                                            <div class="space-y-2">
                                                <p class="font-medium text-slate-500">Belum ada mahasiswa yang dipetakan ke kelas ini.</p>
                                                <button type="button" onclick="openModalMhs()" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-[#075c46] hover:bg-[#064b3b] text-white text-xs font-semibold shadow-xs">
                                                    <span>+ Tambahkan Mahasiswa Sekarang</span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

            </div>

            <footer class="pt-4 pb-2">
                <p class="text-[10px] text-slate-400">© {{ date('Y') }} SIPRAK · UIN Siber Syekh Nurjati Cirebon</p>
            </footer>

        </main>
    </div>
</div>

<!-- ================= MODAL PEMILIHAN MAHASISWA DENGAN TABEL & LIVE SEARCH ================= -->
<div id="modalPilihMhs" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-50 hidden flex items-center justify-center p-3 sm:p-5">
    <div class="bg-white rounded-2xl max-w-3xl w-full max-h-[90vh] flex flex-col shadow-2xl border border-slate-100 overflow-hidden transform transition-all" onclick="event.stopPropagation()">
        
        <!-- MODAL HEADER -->
        <div class="p-4 sm:p-5 border-b border-[#edf1ef] flex justify-between items-start gap-3 bg-white">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-800 flex items-center justify-center font-bold shrink-0">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <div>
                    <h3 class="text-sm sm:text-base font-bold text-slate-800">Pilih Mahasiswa ke Rombel Kelas {{ $kelas->nama_kelas }}</h3>
                    <p class="text-xs text-slate-400 mt-0.5">Cari berdasarkan NIM atau Nama. Anda bisa memilih satu per satu atau mencentang sekaligus.</p>
                </div>
            </div>
            <button type="button" onclick="closeModalMhs()" class="w-8 h-8 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 flex items-center justify-center text-xl leading-none">&times;</button>
        </div>

        <!-- SEARCH BAR -->
        <div class="p-4 border-b border-[#edf1ef] bg-slate-50/70">
            <div class="relative">
                <input type="text" id="modalSearchMhsInput" oninput="filterModalMahasiswa()" placeholder="Ketik NIM atau Nama mahasiswa untuk mencari..." class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 bg-white text-xs outline-none focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 shadow-xs">
                <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
            </div>
        </div>

        <!-- MODAL TABLE CONTENT -->
        <form id="formMultiMhs" action="{{ route('admin.penugasan.mahasiswa.store', $kelas->id) }}" method="POST" class="flex-1 flex flex-col min-h-0">
            @csrf
            <div class="flex-1 overflow-y-auto overflow-x-auto min-h-[260px] max-h-[50vh]">
                <table class="data-table" id="tableModalMhs">
                    <thead class="sticky top-0 z-10 bg-[#fafcfb]">
                        <tr>
                            <th class="w-10 text-center">
                                <input type="checkbox" id="checkAllMhs" onchange="toggleSelectAllMhs(this)" class="rounded border-slate-300 text-emerald-700 focus:ring-emerald-600 cursor-pointer" title="Pilih Semua Mahasiswa yang Tampak">
                            </th>
                            <th class="w-36">NIM</th>
                            <th>NAMA MAHASISWA</th>
                            <th>EMAIL</th>
                            <th class="text-right w-24">PILIH</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mahasiswas as $m)
                            <tr class="modal-mhs-row hover:bg-emerald-50/40 transition">
                                <td class="text-center">
                                    <input type="checkbox" name="mahasiswa_ids[]" value="{{ $m->id }}" onchange="updateSelectedCount()" class="mhs-item-checkbox rounded border-slate-300 text-emerald-700 focus:ring-emerald-600 cursor-pointer">
                                </td>
                                <td class="font-bold text-slate-700 font-mono modal-nim">
                                    <span class="px-2 py-0.5 rounded bg-slate-100 text-slate-700 text-[11px]">{{ $m->nip_nim ?? '-' }}</span>
                                </td>
                                <td class="font-semibold text-slate-800 modal-nama">{{ $m->nama ?? '-' }}</td>
                                <td class="text-slate-400 text-xs">{{ $m->email ?? '-' }}</td>
                                <td class="text-right">
                                    <button type="button" onclick="pilihSingleMahasiswa('{{ $m->id }}')" class="px-2.5 py-1 rounded-lg bg-emerald-50 hover:bg-emerald-600 text-emerald-800 hover:text-white border border-emerald-200 text-xs font-semibold transition cursor-pointer">
                                        Pilih
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center p-8 text-slate-400">
                                    Semua mahasiswa dalam sistem sudah terdaftar di kelas ini.
                                </td>
                            </tr>
                        @endforelse
                        <tr id="noMhsMatchRow" class="hidden">
                            <td colspan="5" class="text-center p-8 text-slate-400">
                                Tidak ada mahasiswa yang cocok dengan pencarian NIM / Nama tersebut.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- MODAL FOOTER -->
            <div class="p-4 border-t border-[#edf1ef] bg-white flex flex-col sm:flex-row justify-between items-center gap-3">
                <div class="text-xs text-slate-600">
                    <span id="selectedCountBadge" class="font-bold text-[#075c46]">0</span> mahasiswa dipilih
                </div>

                <div class="flex items-center gap-2 w-full sm:w-auto justify-end">
                    <button type="button" onclick="closeModalMhs()" class="px-4 py-2 rounded-xl border text-xs font-semibold text-slate-600 hover:bg-slate-50 transition">
                        Batal
                    </button>
                    <button type="submit" id="btnSubmitSelectedMhs" disabled class="px-4 py-2 rounded-xl bg-[#075c46] hover:bg-[#064b3b] text-white text-xs font-bold shadow-sm transition disabled:opacity-50 disabled:cursor-not-allowed">
                        Tambahkan Mahasiswa Terpilih (0)
                    </button>
                </div>
            </div>
        </form>

        <!-- FORM SINGLE SUBMIT KETIKA KLIK TOMBOL PILIH -->
        <form id="formSingleMhs" action="{{ route('admin.penugasan.mahasiswa.store', $kelas->id) }}" method="POST" class="hidden">
            @csrf
            <input type="hidden" name="user_id" id="singleUserIdInput">
        </form>
    </div>
</div>

<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('open');
        document.getElementById('mobileOverlay').classList.toggle('show');
    }

    // Modal Control
    function openModalMhs() {
        const modal = document.getElementById('modalPilihMhs');
        if (modal) {
            modal.classList.remove('hidden');
            setTimeout(() => {
                document.getElementById('modalSearchMhsInput')?.focus();
            }, 50);
        }
    }

    function closeModalMhs() {
        const modal = document.getElementById('modalPilihMhs');
        if (modal) {
            modal.classList.add('hidden');
        }
    }

    document.getElementById('modalPilihMhs')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeModalMhs();
        }
    });

    // 1. Live Search Mahasiswa di Dalam Modal
    function filterModalMahasiswa() {
        const input = document.getElementById('modalSearchMhsInput');
        const filter = input.value.toLowerCase().trim();
        const rows = document.querySelectorAll('.modal-mhs-row');
        let visibleCount = 0;

        rows.forEach(row => {
            const nim = row.querySelector('.modal-nim')?.innerText.toLowerCase() || '';
            const nama = row.querySelector('.modal-nama')?.innerText.toLowerCase() || '';

            if (nim.includes(filter) || nama.includes(filter)) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        const noMatch = document.getElementById('noMhsMatchRow');
        if (noMatch) {
            noMatch.classList.toggle('hidden', visibleCount > 0);
        }
    }

    // 2. Select All Checkbox di Modal
    function toggleSelectAllMhs(masterCheckbox) {
        const rows = document.querySelectorAll('.modal-mhs-row');
        rows.forEach(row => {
            if (row.style.display !== 'none') {
                const cb = row.querySelector('.mhs-item-checkbox');
                if (cb) cb.checked = masterCheckbox.checked;
            }
        });
        updateSelectedCount();
    }

    // 3. Update Hitungan Mahasiswa yang Dipilih
    function updateSelectedCount() {
        const checkboxes = document.querySelectorAll('.mhs-item-checkbox:checked');
        const count = checkboxes.length;

        const badge = document.getElementById('selectedCountBadge');
        if (badge) badge.innerText = count;

        const btn = document.getElementById('btnSubmitSelectedMhs');
        if (btn) {
            btn.disabled = count === 0;
            btn.innerText = `Tambahkan Mahasiswa Terpilih (${count})`;
        }
    }

    // 4. Pilih Single Mahasiswa via Tombol Baris
    function pilihSingleMahasiswa(userId) {
        const input = document.getElementById('singleUserIdInput');
        if (input) {
            input.value = userId;
            document.getElementById('formSingleMhs').submit();
        }
    }

    // 5. Search Filter untuk Mahasiswa yang Sudah Terdaftar
    function filterRegisteredMhs() {
        const input = document.getElementById('searchRegisteredMhs');
        if (!input) return;
        const filter = input.value.toLowerCase().trim();
        const rows = document.querySelectorAll('.registered-mhs-row');

        rows.forEach(row => {
            const nim = row.querySelector('.nim-col')?.innerText.toLowerCase() || '';
            const nama = row.querySelector('.nama-col')?.innerText.toLowerCase() || '';
            row.style.display = (nim.includes(filter) || nama.includes(filter)) ? '' : 'none';
        });
    }
</script>

</body>
</html>