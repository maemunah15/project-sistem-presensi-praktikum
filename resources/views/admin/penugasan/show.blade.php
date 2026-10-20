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

                    <a href="{{ route('admin.penugasan.index') }}" class="nav-link active">
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
                <div class="p-3 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-xs font-medium flex justify-between items-center shadow-sm">
                    <span>{{ session('success') }}</span>
                    <button onclick="this.parentElement.remove()">&times;</button>
                </div>
            @endif

            <!-- BANNER DETAIL KELAS -->
            <div class="surface p-5 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div>
                    <div class="flex items-center gap-3">
                        <h2 class="text-xl font-bold tracking-tight text-[#183c30]">{{ $kelas->mataPraktikum->nama ?? 'Praktikum' }}</h2>
                        <span class="px-2.5 py-0.5 rounded-md bg-emerald-100 text-emerald-800 font-bold text-xs">
                            Kelas {{ $kelas->nama_kelas ?? '4B' }}
                        </span>
                    </div>
                    <p class="text-xs text-slate-500 mt-1">
                        Tahun Ajaran: <span class="font-semibold text-slate-700">{{ $kelas->tahun_ajaran ?? '2026/2027' }}</span> · Semester: <span class="font-semibold text-slate-700">{{ $kelas->semester ?? 5 }}</span>
                    </p>
                </div>
            </div>

            <!-- TWO COLUMN LAYOUT: PENGAJAR & MAHASISWA -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <!-- CARD 1: PLOTTING PENGAJAR -->
                <section class="surface overflow-hidden flex flex-col">
                    <div class="p-4 border-b border-[#edf1ef]">
                        <h3 class="text-xs font-bold text-slate-800">1. Plotting Pengajar (Dosen &amp; Asprak)</h3>
                        <p class="text-[11px] text-slate-400 mt-0.5">Tugaskan Dosen Pengampu atau Asisten Praktikum ke kelas ini.</p>
                    </div>

                    <div class="p-4 border-b border-[#edf1ef] bg-slate-50/50">
                        <form action="{{ route('admin.penugasan.pengajar.store', $kelas->id) }}" method="POST" class="flex flex-col sm:flex-row gap-2">
                            @csrf
                            <select name="user_id" class="field flex-1" required>
                                <option value="">-- Pilih Dosen / Asprak --</option>
                                <optgroup label="Dosen">
                                    @foreach($dosens as $d)
                                        <option value="{{ $d->nama }}">{{ $d->nama }}</option>
                                    @endforeach
                                </optgroup>
                                <optgroup label="Asisten Praktikum">
                                    @foreach($aspraks as $a)
                                        <option value="{{ $a->nama }}">{{ $a->nama }}</option>
                                    @endforeach
                                </optgroup>
                            </select>

                            <select name="tipe" class="field w-full sm:w-28" required>
                                <option value="dosen">Dosen</option>
                                <option value="asprak">Asprak</option>
                            </select>

                            <button type="submit" class="btn-primary shrink-0">+ Tambah</button>
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
                                        <td class="font-semibold text-slate-800">{{ $p->user->nama ?? '-' }}</td>
                                        <td>
                                            @if(($p->tipe ?? 'dosen') === 'dosen')
                                                <span class="px-2 py-0.5 rounded bg-blue-50 text-blue-700 text-[10px] font-bold border border-blue-100">Dosen</span>
                                            @else
                                                <span class="px-2 py-0.5 rounded bg-emerald-50 text-emerald-700 text-[10px] font-bold border border-emerald-100">Asprak</span>
                                            @endif
                                        </td>
                                        <td class="text-right">
                                            <form action="{{ route('admin.penugasan.pengajar.destroy', [$kelas->id, $p->id]) }}" method="POST" onsubmit="return confirm('Hapus pengajar ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-rose-600 hover:underline font-semibold text-xs">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center p-4 text-slate-400">Belum ada pengajar ditugaskan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                <!-- CARD 2: MAPPING MAHASISWA -->
                <section class="surface overflow-hidden flex flex-col">
                    <div class="p-4 border-b border-[#edf1ef]">
                        <h3 class="text-xs font-bold text-slate-800">2. Mapping Rombel Mahasiswa</h3>
                        <p class="text-[11px] text-slate-400 mt-0.5">Pilih mahasiswa terdaftar untuk dimasukkan ke rombel kelas ini.</p>
                    </div>

                    <div class="p-4 border-b border-[#edf1ef] bg-slate-50/50">
                        <form action="{{ route('admin.penugasan.mahasiswa.store', $kelas->id) }}" method="POST" class="flex gap-2">
                            @csrf
                            <select name="user_id" class="field flex-1" required>
                                <option value="">-- Pilih Mahasiswa --</option>
                                @foreach($mahasiswas as $m)
                                    <option value="{{ $m->nip_nim }} - {{ $m->nama }}">{{ $m->nip_nim }} - {{ $m->nama }}</option>
                                @endforeach
                            </select>

                            <button type="submit" class="btn-primary shrink-0">+ Petakan</button>
                        </form>
                    </div>

                    <div class="overflow-x-auto flex-1">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>NIM</th>
                                    <th>NAMA MAHASISWA</th>
                                    <th class="text-right">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($kelas->mahasiswa as $m)
                                    <tr>
                                        <td class="font-bold text-slate-600">{{ $m->user->nip_nim ?? '-' }}</td>
                                        <td class="font-semibold text-slate-800">{{ $m->user->nama ?? '-' }}</td>
                                        <td class="text-right">
                                            <form action="{{ route('admin.penugasan.mahasiswa.destroy', [$kelas->id, $m->id]) }}" method="POST" onsubmit="return confirm('Keluarkan mahasiswa dari kelas ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-rose-600 hover:underline font-semibold text-xs">Keluarkan</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center p-4 text-slate-400">Belum ada mahasiswa dipetakan.</td>
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

<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('open');
        document.getElementById('mobileOverlay').classList.toggle('show');
    }
</script>

</body>
</html>