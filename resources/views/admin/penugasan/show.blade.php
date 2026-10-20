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
                                            <form action="{{ route('admin.penugasan.pengajar.destroy', $p->id) }}?kelas_id={{ $kelas->id }}" method="POST" onsubmit="return confirm('Hapus pengajar ini?')">
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
                                    <option value="{{ $m->id }}">{{ $m->nip_nim }} - {{ $m->nama }}</option>
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
                                        <td class="font-bold text-slate-600">{{ $m->nip_nim ?? '-' }}</td>
                                        <td class="font-semibold text-slate-800">{{ $m->nama ?? '-' }}</td>
                                        <td class="text-right">
                                            <form action="{{ route('admin.penugasan.mahasiswa.destroy', $m->id) }}?kelas_id={{ $kelas->id }}" method="POST" onsubmit="return confirm('Keluarkan mahasiswa dari kelas ini?')">
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