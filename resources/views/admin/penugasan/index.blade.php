<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penugasan & Mapping | SIPRAK</title>

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

        .field {
            width: 100%;
            border: 1px solid #e1e9e5;
            background: #fafcfb;
            border-radius: 9px;
            padding: 8px 12px;
            font-size: 12px;
            outline: none;
            transition: all .2s;
        }

        .field:focus {
            border-color: #70bda0;
            box-shadow: 0 0 0 3px rgba(8,127,96,.08);
            background: white;
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
                        <span class="text-slate-500 font-medium">Portal Laboratorium</span>
                        <span class="text-slate-300 hidden sm:inline">/</span>
                        <span class="hidden sm:inline px-2.5 py-0.5 rounded-full bg-emerald-50 border border-emerald-100 text-emerald-800 font-semibold text-[11px]">Penugasan & Mapping Kelas</span>
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

            <div>
                <h2 class="text-xl font-bold tracking-tight text-[#183c30]">Penugasan & Mapping Kelas Praktikum</h2>
                <p class="text-xs text-slate-500 mt-1">Kelola penugasan Pengajar (Dosen & Asprak) serta mapping pendaftaran Mahasiswa ke dalam kelas.</p>
            </div>

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

            @if($errors->any())
                <div class="p-3.5 bg-rose-50 border border-rose-200 text-rose-800 rounded-xl text-xs font-medium space-y-1 shadow-sm">
                    <div class="font-bold">Terjadi kesalahan pengisian form:</div>
                    <ul class="list-disc list-inside text-[11px] text-rose-700">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- TABLE CARD -->
            <section class="surface overflow-hidden shadow-sm">
                <div class="p-4 border-b border-[#edf1ef] flex flex-col sm:flex-row sm:items-center justify-between gap-3 bg-white">
                    <div>
                        <h3 class="text-xs font-bold text-slate-800">Daftar Kelas Praktikum Aktif</h3>
                        <p class="text-[11px] text-slate-400 mt-0.5">Pilih kelas untuk mengelola plotting Dosen, Asprak, dan Mahasiswa.</p>
                    </div>
                    <button type="button" onclick="openModalKelas()" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-[#075c46] hover:bg-[#064b3b] text-white text-xs font-bold shadow-sm hover:shadow transition self-start sm:self-auto cursor-pointer">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
                        <span>Tambah Kelas Praktikum</span>
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th class="w-12">NO</th>
                                <th>MATA PRAKTIKUM</th>
                                <th>KELAS</th>
                                <th>PENGAJAR (DOSEN / ASPRAK)</th>
                                <th>MAHASISWA TERDAFTAR</th>
                                <th class="text-right">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $items = isset($kelases) ? $kelases : (isset($kelas) ? $kelas : collect());
                            @endphp
                            @if(count($items) > 0)
                                @foreach($items as $index => $k)
                                    <tr>
                                        <td class="font-medium text-slate-500">{{ $index + 1 }}</td>
                                        <td class="font-bold text-slate-800">{{ $k->mataPraktikum->nama ?? '-' }}</td>
                                        <td>
                                            <span class="inline-block px-2.5 py-0.5 rounded bg-emerald-50 border border-emerald-200 text-[10px] font-bold text-emerald-800">
                                                {{ $k->nama_kelas ?? '-' }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full bg-slate-100 text-slate-700 text-[11px] font-semibold">
                                                 {{ $k->pengajar_count ?? ($k->pengajar ? $k->pengajar->count() : 0) }} Pengajar
                                            </span>
                                        </td>
                                        <td>
                                            <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full bg-slate-100 text-slate-700 text-[11px] font-semibold">
                                                 {{ $k->mahasiswa_count ?? ($k->mahasiswa ? $k->mahasiswa->count() : 0) }} Mahasiswa
                                            </span>
                                        </td>
                                        <td class="text-right">
                                            <div class="inline-flex items-center gap-2 justify-end">
                                                <a href="{{ route('admin.penugasan.show', $k->id) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-[#075c46] hover:bg-[#064b3b] text-white text-xs font-semibold shadow-xs transition">
                                                    <span>Kelola &amp; Mapping</span>
                                                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                        <path d="M5 12h14M12 5l7 7-7 7"/>
                                                    </svg>
                                                </a>
                                                <form action="{{ route('admin.kelas.destroy', $k->id) }}?redirect_to=penugasan" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kelas {{ $k->nama_kelas }} ({{ $k->mataPraktikum->nama ?? '-' }}) beserta seluruh data penugasan pengajar dan mahasiswanya?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg border border-rose-200 bg-rose-50 hover:bg-rose-100 text-rose-700 text-xs font-semibold transition" title="Hapus Kelas Ini">
                                                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                                                        <span>Hapus</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="text-center p-8 text-slate-400">
                                        <div class="space-y-3">
                                            <p class="font-medium text-slate-500">Belum ada kelas praktikum yang terdaftar.</p>
                                            <button type="button" onclick="openModalKelas()" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-[#075c46] hover:bg-[#064b3b] text-white text-xs font-bold shadow-sm transition">
                                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
                                                <span>Tambah Kelas Praktikum Pertama</span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                @if(isset($kelases) && method_exists($kelases, 'links'))
                    <div class="p-4 border-t border-[#edf1ef]">
                        {{ $kelases->links() }}
                    </div>
                @endif
            </section>

            <footer class="pt-4 pb-2">
                <p class="text-[10px] text-slate-400">© {{ date('Y') }} SIPRAK · UIN Siber Syekh Nurjati Cirebon</p>
            </footer>

        </main>
    </div>
</div>

<!-- MODAL TAMBAH KELAS PRAKTIKUM -->
<div id="modalKelas" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-md w-full p-6 space-y-4 shadow-2xl border border-slate-100 transform transition-all" onclick="event.stopPropagation()">
        <div class="flex justify-between items-center border-b pb-3">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-800 flex items-center justify-center font-bold">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-slate-800">Tambah Kelas Praktikum</h3>
                    <p class="text-[11px] text-slate-400">Tambahkan kelas baru ke daftar penugasan</p>
                </div>
            </div>
            <button type="button" onclick="closeModalKelas()" class="w-7 h-7 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 flex items-center justify-center text-lg leading-none">&times;</button>
        </div>

        <form action="{{ route('admin.kelas.store') }}" method="POST" class="space-y-3.5" id="formTambahKelas">
            @csrf
            <input type="hidden" name="redirect_to" value="penugasan">

            <div>
                <label class="block text-[11px] font-semibold text-slate-700 mb-1">Mata Praktikum <span class="text-rose-500">*</span></label>
                <select name="mata_praktikum_id" class="field" required>
                    <option value="">-- Pilih Mata Praktikum --</option>
                    @if(isset($mataPraktikum))
                        @foreach($mataPraktikum as $mk)
                            <option value="{{ $mk->id }}">{{ $mk->nama }} ({{ $mk->kode ?? 'MK' }})</option>
                        @endforeach
                    @endif
                </select>
            </div>

            <div>
                <label class="block text-[11px] font-semibold text-slate-700 mb-1">Nama Kelas <span class="text-rose-500">*</span></label>
                <input type="text" name="nama_kelas" required class="field" placeholder="Contoh: 4B, 3A, atau TI-2B">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-[11px] font-semibold text-slate-700 mb-1">Semester <span class="text-rose-500">*</span></label>
                    <input type="number" name="semester" min="1" max="8" value="3" required class="field">
                </div>
                <div>
                    <label class="block text-[11px] font-semibold text-slate-700 mb-1">Tahun Ajaran <span class="text-rose-500">*</span></label>
                    <input type="text" name="tahun_ajaran" value="2026/2027" required class="field">
                </div>
            </div>

            <div class="flex justify-end gap-2 pt-3 border-t border-slate-100">
                <button type="button" onclick="closeModalKelas()" class="px-4 py-2 rounded-xl border text-xs font-semibold text-slate-600 hover:bg-slate-50 transition">Batal</button>
                <button type="submit" id="btnSubmitKelas" class="px-4 py-2 rounded-xl bg-[#075c46] hover:bg-[#064b3b] text-white text-xs font-bold shadow-sm transition">Simpan Kelas</button>
            </div>
        </form>
    </div>
</div>

<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('open');
        document.getElementById('mobileOverlay').classList.toggle('show');
    }

    function openModalKelas() {
        const modal = document.getElementById('modalKelas');
        if (modal) {
            modal.classList.remove('hidden');
        }
    }

    function closeModalKelas() {
        const modal = document.getElementById('modalKelas');
        if (modal) {
            modal.classList.add('hidden');
        }
    }

    // Tutup jika klik di area backdrop hitam
    document.getElementById('modalKelas')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeModalKelas();
        }
    });

    // Cegah submit kosong / ganda
    document.getElementById('formTambahKelas')?.addEventListener('submit', function(e) {
        const btn = document.getElementById('btnSubmitKelas');
        if (btn) {
            btn.innerHTML = 'Menyimpan...';
            btn.classList.add('opacity-75', 'cursor-not-allowed');
        }
    });
</script>

</body>
</html>