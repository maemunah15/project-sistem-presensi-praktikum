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
                <div class="p-3 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-xs font-medium flex justify-between items-center shadow-sm">
                    <span>{{ session('success') }}</span>
                    <button onclick="this.parentElement.remove()">&times;</button>
                </div>
            @endif

            <!-- TABLE CARD -->
            <section class="surface overflow-hidden">
                <div class="p-4 border-b border-[#edf1ef] flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                    <div>
                        <h3 class="text-xs font-bold text-slate-800">Daftar Kelas Praktikum Aktif</h3>
                        <p class="text-[11px] text-slate-400 mt-0.5">Pilih kelas untuk mengelola plotting Dosen, Asprak, dan Mahasiswa.</p>
                    </div>
                    <button type="button" onclick="openModalKelas()" class="btn-primary inline-flex items-center gap-1.5 self-start sm:self-auto shadow-sm">
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
                        <span>+ Tambah Kelas Praktikum</span>
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
                                                👨‍🏫 {{ $k->pengajar_count ?? ($k->pengajar ? $k->pengajar->count() : 0) }} Pengajar
                                            </span>
                                        </td>
                                        <td>
                                            <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full bg-slate-100 text-slate-700 text-[11px] font-semibold">
                                                🎓 {{ $k->mahasiswa_count ?? ($k->mahasiswa ? $k->mahasiswa->count() : 0) }} Mahasiswa
                                            </span>
                                        </td>
                                        <td class="text-right">
                                            <a href="{{ route('admin.penugasan.show', $k->id) }}" class="btn-primary inline-flex items-center gap-1.5">
                                                <span>Kelola &amp; Tambah Data</span>
                                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path d="M5 12h14M12 5l7 7-7 7"/>
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="text-center p-8 text-slate-400">
                                        <div class="space-y-2">
                                            <p class="font-medium text-slate-500">Belum ada kelas praktikum yang terdaftar.</p>
                                            <button type="button" onclick="openModalKelas()" class="btn-primary inline-flex items-center gap-1.5 text-xs">
                                                <span>+ Tambah Kelas Praktikum Pertama</span>
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
<div id="modalKelas" class="fixed inset-0 bg-black/40 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-md w-full p-6 space-y-4 shadow-xl">
        <div class="flex justify-between items-center border-b pb-3">
            <h3 class="text-sm font-bold text-slate-800">Tambah Kelas Praktikum</h3>
            <button type="button" onclick="closeModalKelas()" class="text-slate-400 hover:text-slate-600 text-lg">&times;</button>
        </div>

        <form action="{{ route('admin.kelas.store') }}" method="POST" class="space-y-3">
            @csrf
            <input type="hidden" name="redirect_to" value="penugasan">

            <div>
                <label class="block text-[11px] font-semibold text-slate-600 mb-1">Nama Kelas</label>
                <input type="text" name="nama_kelas" required class="field" placeholder="Contoh: 4B atau TI-2A">
            </div>

            <div>
                <label class="block text-[11px] font-semibold text-slate-600 mb-1">Mata Praktikum</label>
                <select name="mata_praktikum_id" class="field" required>
                    <option value="">-- Pilih Mata Praktikum --</option>
                    @if(isset($mataPraktikum))
                        @foreach($mataPraktikum as $mk)
                            <option value="{{ $mk->id }}">{{ $mk->nama }} ({{ $mk->kode }})</option>
                        @endforeach
                    @endif
                </select>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-[11px] font-semibold text-slate-600 mb-1">Semester</label>
                    <input type="number" name="semester" min="1" max="8" value="3" required class="field">
                </div>
                <div>
                    <label class="block text-[11px] font-semibold text-slate-600 mb-1">Tahun Ajaran</label>
                    <input type="text" name="tahun_ajaran" value="2026/2027" required class="field">
                </div>
            </div>

            <div class="flex justify-end gap-2 pt-2">
                <button type="button" onclick="closeModalKelas()" class="px-3 py-2 rounded-lg border text-xs font-semibold text-slate-600 hover:bg-slate-50">Batal</button>
                <button type="submit" class="btn-primary">Simpan Kelas</button>
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
        if (modal) modal.classList.remove('hidden');
    }

    function closeModalKelas() {
        const modal = document.getElementById('modalKelas');
        if (modal) modal.classList.add('hidden');
    }

    // Auto-close modal segera saat submit dan cegah double-submit
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.querySelector('#modalKelas form');
        if (form) {
            form.addEventListener('submit', function() {
                closeModalKelas();
                const btn = this.querySelector('button[type="submit"]');
                if (btn) {
                    setTimeout(() => {
                        btn.disabled = true;
                        btn.innerHTML = 'Menyimpan...';
                        btn.classList.add('opacity-75', 'cursor-not-allowed');
                    }, 20);
                }
            });
        }
    });
</script>

</body>
</html>