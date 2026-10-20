<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Praktikum | SIPRAK</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        siprak: {
                            50: '#effaf5',
                            100: '#d8f3e5',
                            600: '#07805d',
                            700: '#066747',
                            800: '#07553f',
                            900: '#064735'
                        }
                    }
                }
            }
        }
    </script>

    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background: #f6f8f7; }
        .sidebar-link { transition: .2s ease; }
        .sidebar-link:hover { background: #163c35; color: white; }
        .sidebar-link.active {
            background: #087b5b;
            color: white;
            box-shadow: 0 4px 12px #003d2c30;
        }
        .modal-backdrop { background: rgba(12, 31, 26, .45); }
        input:focus, select:focus {
            outline: none;
            border-color: #07805d;
            box-shadow: 0 0 0 3px #07805d15;
        }
    </style>
</head>

<body class="min-h-screen text-slate-800">

<div class="min-h-screen md:flex">

    <!-- SIDEBAR -->
    <aside class="w-full md:w-[250px] bg-[#0b211f] text-slate-300 md:fixed md:inset-y-0 flex flex-col z-30">

        <!-- Logo -->
        <div class="px-5 py-5 border-b border-white/10">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-xl bg-white flex items-center justify-center p-1.5 shrink-0">
                    <img
                        src="{{ asset('image/Logo-UINSSC.png') }}"
                        alt="Logo UINSSC"
                        class="w-full h-full object-contain"
                        onerror="this.style.display='none';this.nextElementSibling.style.display='block';"
                    >
                    <span style="display:none" class="text-xs font-bold text-siprak-800">UIN</span>
                </div>
                <div>
                    <h1 class="text-sm font-extrabold text-white">SIPRAK</h1>
                    <p class="text-[11px] text-emerald-400 mt-1">Sistem Presensi Praktikum</p>
                    <p class="text-[10px] text-slate-500 mt-1">UIN Siber Syekh Nurjati</p>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="p-4 space-y-1 flex-1">
            <p class="text-[10px] uppercase tracking-widest font-bold text-slate-500 px-3 mb-3">
                Menu Utama
            </p>

            <a href="{{ url('/admin/dashboard?tab=master') }}"
               class="sidebar-link flex items-center gap-3 px-3 py-3 rounded-lg text-sm">
                <span class="w-6 text-center">▦</span>
                <span>Data Master</span>
            </a>

            <div class="px-3 pt-5 pb-2 text-[10px] uppercase tracking-widest font-bold text-slate-500">
                Manajemen Akademik
            </div>

            <a href="{{ url('/admin/akademik/kelas') }}"
               class="sidebar-link flex items-center gap-3 px-3 py-3 rounded-lg text-sm">
                <span class="w-6 text-center">▤</span>
                <span>Kelas Praktikum</span>
            </a>

            <a href="{{ url('/admin/akademik/jadwal') }}"
               class="sidebar-link active flex items-center gap-3 px-3 py-3 rounded-lg text-sm">
                <span class="w-6 text-center">▦</span>
                <span class="font-semibold">Jadwal Praktikum</span>
            </a>

            <a href="{{ url('/admin/akademik/mata-praktikum') }}"
               class="sidebar-link flex items-center gap-3 px-3 py-3 rounded-lg text-sm">
                <span class="w-6 text-center">▧</span>
                <span>Mata Praktikum</span>
            </a>

            <div class="px-3 pt-5 pb-2 text-[10px] uppercase tracking-widest font-bold text-slate-500">
                Lainnya
            </div>

            <a href="{{ url('/admin/penugasan') }}"
               class="sidebar-link flex items-center gap-3 px-3 py-3 rounded-lg text-sm">
                <span class="w-6 text-center">♧</span>
                <span>Penugasan & Mapping</span>
            </a>

            <a href="{{ url('/admin/laporan') }}"
               class="sidebar-link flex items-center gap-3 px-3 py-3 rounded-lg text-sm">
                <span class="w-6 text-center">▥</span>
                <span>Rekap & Laporan</span>
            </a>
        </nav>

        <!-- Admin profile -->
        <div class="border-t border-white/10 p-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-emerald-800 text-white flex items-center justify-center font-bold">
                    A
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-sm font-bold text-white">{{ Auth::user()->nama ?? 'Admin Lab' }}</p>
                    <p class="text-[11px] text-slate-500">Administrator</p>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" title="Keluar" class="text-slate-400 hover:text-white text-lg">⇥</button>
                </form>
            </div>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="min-w-0 flex-1 md:ml-[250px]">

        <!-- TOPBAR -->
        <header class="bg-white border-b border-slate-200 px-5 lg:px-8 py-4">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div class="text-sm text-slate-500">
                    <span class="text-emerald-700 font-semibold">UIN SSC</span>
                    <span class="mx-2 text-slate-300">/</span>
                    Manajemen Akademik
                    <span class="mx-2 text-slate-300">/</span>
                    <span class="text-slate-800 font-semibold">Jadwal Praktikum</span>
                </div>

                <div class="flex items-center gap-3">
                    <div class="hidden sm:block text-right">
                        <p class="text-xs font-semibold text-slate-700">{{ Auth::user()->nama ?? 'Admin Lab' }}</p>
                        <p class="text-[11px] text-slate-400">Administrator Sistem</p>
                    </div>
                    <div class="w-9 h-9 rounded-full bg-siprak-800 text-white flex items-center justify-center font-bold text-sm">
                        A
                    </div>
                </div>
            </div>
        </header>

        <!-- PAGE -->
        <div class="p-5 lg:p-8 max-w-[1600px] mx-auto">

            <!-- NOTIFIKASI SUCCESS / ERROR -->
            @if(session('success'))
                <div class="mb-5 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-5 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-sm font-semibold">
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-5 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-sm">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach($errors->all() as$err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- PAGE TITLE -->
            <section class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-7">
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <h2 class="text-2xl font-extrabold tracking-tight text-slate-900">
                            Jadwal Praktikum
                        </h2>
                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-800 border border-emerald-100">
                            Akademik
                        </span>
                    </div>
                    <p class="text-sm text-slate-500 leading-relaxed">
                        Atur waktu, kelas, dan lokasi pelaksanaan praktikum.
                    </p>
                </div>

                <button onclick="openModalTambah()"
                    class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-siprak-800 hover:bg-siprak-900 text-white text-sm font-bold shadow-sm transition">
                    <span class="text-lg leading-none">+</span>
                    Tambah Jadwal
                </button>
            </section>

            <!-- SUMMARY -->
            <section class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">

                <div class="bg-white border border-slate-200 rounded-xl p-5">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-xs font-semibold text-slate-500">Total Jadwal</p>
                            <h3 id="totalJadwal" class="text-2xl font-extrabold text-slate-900 mt-2">{{ $jadwals->count() }}</h3>
                            <p class="text-[11px] text-slate-400 mt-1">Jadwal terdaftar</p>
                        </div>
                        <div class="w-10 h-10 rounded-lg bg-emerald-50 text-emerald-800 flex items-center justify-center text-xl">▦</div>
                    </div>
                </div>

                <div class="bg-white border border-slate-200 rounded-xl p-5">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-xs font-semibold text-slate-500">Hari Pelaksanaan</p>
                            <h3 class="text-2xl font-extrabold text-slate-900 mt-2">5 Hari</h3>
                            <p class="text-[11px] text-slate-400 mt-1">Senin sampai Jumat</p>
                        </div>
                        <div class="w-10 h-10 rounded-lg bg-slate-100 text-slate-600 flex items-center justify-center text-xl">▣</div>
                    </div>
                </div>

                <div class="bg-white border border-slate-200 rounded-xl p-5">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-xs font-semibold text-slate-500">Semester Aktif</p>
                            <h3 class="text-xl font-extrabold text-slate-900 mt-2">2026/2027</h3>
                            <p class="text-[11px] text-slate-400 mt-1">Ganjil</p>
                        </div>
                        <div class="w-10 h-10 rounded-lg bg-emerald-50 text-emerald-800 flex items-center justify-center text-xl">◷</div>
                    </div>
                </div>
            </section>

            <!-- TABLE CONTAINER -->
            <section class="bg-white rounded-xl border border-slate-200 overflow-hidden">

                <!-- Table heading -->
                <div class="px-5 py-4 border-b border-slate-200">
                    <h3 class="font-bold text-slate-800 text-sm">Daftar Jadwal Praktikum</h3>
                    <p class="text-xs text-slate-500 mt-1">Daftar waktu dan penempatan kelas praktikum.</p>
                </div>

                <!-- Filters -->
                <div class="p-4 sm:p-5 flex flex-col lg:flex-row gap-3 justify-between border-b border-slate-100">

                    <div class="relative w-full lg:max-w-sm">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">⌕</span>
                        <input id="searchInput" type="text"
                            placeholder="Cari mata kuliah, kelas, atau ruang..."
                            class="w-full pl-9 pr-4 py-2.5 rounded-lg border border-slate-200 bg-white text-sm">
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3">
                        <select id="hariFilter"
                            class="px-3 py-2.5 rounded-lg border border-slate-200 bg-white text-sm text-slate-600">
                            <option value="">Semua Hari</option>
                            <option>Senin</option>
                            <option>Selasa</option>
                            <option>Rabu</option>
                            <option>Kamis</option>
                            <option>Jumat</option>
                        </select>

                        <button onclick="resetFilter()"
                            class="px-4 py-2.5 border border-slate-200 rounded-lg text-sm font-semibold text-slate-600 hover:bg-slate-50">
                            Reset
                        </button>
                    </div>
                </div>

                <!-- Responsive table -->
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left whitespace-nowrap">
                        <thead class="bg-slate-50 border-b border-slate-200 text-[11px] uppercase tracking-wide text-slate-500">
                            <tr>
                                <th class="px-5 py-4 font-bold">Hari / Waktu</th>
                                <th class="px-5 py-4 font-bold">Mata Praktikum</th>
                                <th class="px-5 py-4 font-bold">Kelas</th>
                                <th class="px-5 py-4 font-bold">Laboratorium</th>
                                <th class="px-5 py-4 font-bold">Semester / TA</th>
                                <th class="px-5 py-4 font-bold text-center">Status</th>
                                <th class="px-5 py-4 font-bold text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody id="jadwalBody" class="divide-y divide-slate-100">

                            @forelse($jadwals as$jadwal)
                                <tr class="jadwal-row hover:bg-slate-50/70"
                                    data-hari="{{ $jadwal->hari }}"
                                    data-search="{{ strtolower(($jadwal->kelas->mataPraktikum->nama ?? '') . ' ' . ($jadwal->kelas->nama_kelas ?? '') . ' ' . $jadwal->ruang) }}">
                                    <td class="px-5 py-4">
                                        <p class="font-bold text-slate-800">{{ $jadwal->hari }}</p>
                                        <p class="text-xs text-slate-500 mt-1">
                                            {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H.i') }}–{{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H.i') }} WIB
                                        </p>
                                    </td>
                                    <td class="px-5 py-4 font-semibold text-slate-800">
                                        {{ $jadwal->kelas->mataPraktikum->nama ?? '-' }}
                                    </td>
                                    <td class="px-5 py-4">
                                        <span class="px-2.5 py-1 rounded-md bg-slate-100 border border-slate-200 text-xs font-semibold">
                                            {{ $jadwal->kelas->nama_kelas ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-4 text-slate-600">{{ $jadwal->ruang }}</td>
                                    <td class="px-5 py-4 text-slate-600">
                                        Semester {{ $jadwal->kelas->semester ?? '-' }} ({{ $jadwal->kelas->tahun_ajaran ?? '-' }})
                                    </td>
                                    <td class="px-5 py-4 text-center">
                                        @if($jadwal->kelas &&$jadwal->kelas->status)
                                            <span class="px-2.5 py-1 rounded-full bg-emerald-50 border border-emerald-100 text-emerald-800 text-xs font-semibold">Aktif</span>
                                        @else
                                            <span class="px-2.5 py-1 rounded-full bg-slate-100 border border-slate-200 text-slate-600 text-xs font-semibold">Non-Aktif</span>
                                        @endif
                                    </td>
                                    <td class="px-5 py-4 text-center">
                                        <button onclick="openModalEdit({{ json_encode([
                                            'id' => $jadwal->id,
                                            'kelas_id' => $jadwal->kelas_id,
                                            'hari' => $jadwal->hari,
                                            'jam_mulai' => \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i'),
                                            'jam_selesai' => \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i'),
                                            'ruang' => $jadwal->ruang,
                                            'update_url' => route('admin.jadwal.update', $jadwal->id)
                                        ]) }})" class="text-emerald-700 hover:text-emerald-900 font-semibold mr-3">Ubah</button>

                                        <form action="{{ route('admin.jadwal.destroy', $jadwal->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-rose-600 hover:text-rose-800 font-semibold">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-8 text-slate-500 text-sm">
                                        Belum ada data jadwal praktikum.
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>

                <!-- Empty state -->
                <div id="emptyState" class="hidden text-center py-12 px-4">
                    <p class="text-slate-700 font-bold text-sm">Jadwal tidak ditemukan</p>
                    <p class="text-slate-500 text-xs mt-2">Coba ubah kata kunci atau filter pencarian.</p>
                </div>

                <!-- Footer table -->
                <div class="px-5 py-4 border-t border-slate-200 flex flex-col sm:flex-row justify-between gap-2 text-xs text-slate-500">
                    <p id="tableCount">Menampilkan {{ $jadwals->count() }} jadwal</p>
                    <p>Semester Akademik 2026/2027</p>
                </div>
            </section>

            <footer class="text-xs text-slate-400 mt-7 pb-4">
                © {{ date('Y') }} SIPRAK · UIN Siber Syekh Nurjati Cirebon
            </footer>
        </div>
    </main>
</div>

<!-- MODAL TAMBAH / EDIT -->
<div id="jadwalModal" class="hidden fixed inset-0 z-50 items-center justify-center p-4 modal-backdrop">
    <div class="bg-white w-full max-w-2xl rounded-2xl shadow-2xl overflow-hidden max-h-[92vh] overflow-y-auto">

        <div class="flex items-center justify-between px-6 py-5 border-b border-slate-200">
            <div>
                <h3 id="modalTitle" class="font-extrabold text-lg text-slate-900">Tambah Jadwal Praktikum</h3>
                <p class="text-xs text-slate-500 mt-1">Lengkapi informasi jadwal praktikum.</p>
            </div>
            <button onclick="closeModal()" class="w-9 h-9 rounded-lg hover:bg-slate-100 text-slate-500 text-xl">×</button>
        </div>

        <form id="jadwalForm" method="POST" action="{{ route('admin.jadwal.store') }}" class="p-6">
            @csrf
            <div id="methodContainer"></div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 mb-2">Kelas Praktikum <span class="text-rose-500">*</span></label>
                    <select id="kelas_id" name="kelas_id" required class="w-full border border-slate-200 rounded-lg px-3.5 py-3 text-sm bg-white">
                        <option value="">-- Pilih Kelas Praktikum --</option>
                        @foreach($kelases as$kelas)
                            <option value="{{ $kelas->id }}">
                                {{ $kelas->mataPraktikum->nama ?? 'Mata Kuliah' }} - Kelas {{ $kelas->nama_kelas }} (Semester {{$kelas->semester }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-2">Hari <span class="text-rose-500">*</span></label>
                    <select id="hari" name="hari" required class="w-full border border-slate-200 rounded-lg px-3 py-3 text-sm bg-white">
                        <option value="">Pilih hari</option>
                        <option value="Senin">Senin</option>
                        <option value="Selasa">Selasa</option>
                        <option value="Rabu">Rabu</option>
                        <option value="Kamis">Kamis</option>
                        <option value="Jumat">Jumat</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-2">Laboratorium / Ruang <span class="text-rose-500">*</span></label>
                    <input id="ruang" name="ruang" required type="text" placeholder="Contoh: Lab Komputer 1"
                        class="w-full border border-slate-200 rounded-lg px-3.5 py-3 text-sm">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-2">Jam Mulai <span class="text-rose-500">*</span></label>
                    <input id="jamMulai" name="jam_mulai" required type="time"
                        class="w-full border border-slate-200 rounded-lg px-3.5 py-3 text-sm">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-2">Jam Selesai <span class="text-rose-500">*</span></label>
                    <input id="jamSelesai" name="jam_selesai" required type="time"
                        class="w-full border border-slate-200 rounded-lg px-3.5 py-3 text-sm">
                </div>

            </div>

            <div class="mt-6 p-3 rounded-lg bg-amber-50 border border-amber-100 text-xs text-amber-800">
                Sistem backend akan otomatis memeriksa bentrok waktu dan ruangan di jam yang beririsan.
            </div>

            <div class="flex justify-end gap-3 mt-6">
                <button type="button" onclick="closeModal()"
                    class="px-4 py-2.5 rounded-lg border border-slate-200 text-sm font-semibold text-slate-600 hover:bg-slate-50">
                    Batal
                </button>
                <button type="submit"
                    class="px-5 py-2.5 rounded-lg bg-siprak-800 hover:bg-siprak-900 text-white text-sm font-bold">
                    Simpan Jadwal
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    const modal = document.getElementById('jadwalModal');
    const form = document.getElementById('jadwalForm');
    const methodContainer = document.getElementById('methodContainer');

    function openModalTambah() {
        form.action = "{{ route('admin.jadwal.store') }}";
        methodContainer.innerHTML = '';
        form.reset();
        document.getElementById('modalTitle').textContent = 'Tambah Jadwal Praktikum';
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function openModalEdit(data) {
        form.action = data.update_url;
        methodContainer.innerHTML = '@method("PUT")';

        document.getElementById('modalTitle').textContent = 'Ubah Jadwal Praktikum';
        document.getElementById('kelas_id').value = data.kelas_id;
        document.getElementById('hari').value = data.hari;
        document.getElementById('ruang').value = data.ruang;
        document.getElementById('jamMulai').value = data.jam_mulai;
        document.getElementById('jamSelesai').value = data.jam_selesai;

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeModal() {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    function filterTable() {
        const query = document.getElementById('searchInput').value.toLowerCase().trim();
        const hari = document.getElementById('hariFilter').value;
        let visible = 0;

        document.querySelectorAll('.jadwal-row').forEach(row => {
            const matchesQuery = row.dataset.search ? row.dataset.search.includes(query) : true;
            const matchesHari = !hari || row.dataset.hari === hari;
            const show = matchesQuery && matchesHari;

            row.style.display = show ? '' : 'none';
            if (show) visible++;
        });

        const emptyState = document.getElementById('emptyState');
        if (emptyState) {
            emptyState.classList.toggle('hidden', visible !== 0);
        }
        document.getElementById('tableCount').textContent = `Menampilkan ${visible} jadwal`;
    }

    function resetFilter() {
        document.getElementById('searchInput').value = '';
        document.getElementById('hariFilter').value = '';
        filterTable();
    }

    document.getElementById('searchInput').addEventListener('input', filterTable);
    document.getElementById('hariFilter').addEventListener('change', filterTable);

    modal.addEventListener('click', function(event) {
        if (event.target === modal) closeModal();
    });
</script>

</body>
</html>