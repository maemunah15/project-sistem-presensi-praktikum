<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mata Kuliah Praktikum | SIPRAK - UIN Siber Syekh Nurjati Cirebon</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        * { box-sizing: border-box; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f8fafc; color: #1e293b; }

        :root {
            --green-dark: #064e3b;
            --green-deep: #022c22;
            --green-main: #047857;
            --border: #e2e8f0;
        }

        .sidebar { background: var(--green-deep); color: #ecfdf5; }
        .nav-link {
            display: flex; align-items: center; gap: 12px; padding: 11px 14px;
            border-radius: 12px; font-size: 13px; font-weight: 600; color: #a7f3d0;
            transition: all .2s;
        }
        .nav-link:hover { background: rgba(255,255,255,.08); color: #ffffff; }
        .nav-link.active { background: #047857; color: #ffffff; box-shadow: 0 4px 12px rgba(4, 120, 87, 0.25); }

        .surface { background: #ffffff; border: 1px solid var(--border); border-radius: 16px; }

        .btn-primary {
            background: var(--green-main); color: white; border-radius: 10px;
            padding: 9px 16px; font-size: 13px; font-weight: 700; transition: all .2s;
        }
        .btn-primary:hover { background: var(--green-dark); box-shadow: 0 4px 12px rgba(6, 78, 59, 0.2); }

        .field {
            width: 100%; border: 1px solid #cbd5e1; background: #ffffff;
            border-radius: 10px; padding: 9px 14px; font-size: 13px; outline: none; transition: all 0.2s;
        }
        .field:focus { border-color: #047857; box-shadow: 0 0 0 3px rgba(4, 120, 87, 0.12); }
    </style>
</head>
<body class="min-h-screen">

<div class="min-h-screen flex">

    <!-- SIDEBAR LEFT -->
    <aside id="sidebar" class="sidebar w-[260px] flex flex-col sticky top-0 h-screen shrink-0 z-50">
        <div class="h-[88px] px-6 flex items-center gap-3.5 border-b border-emerald-900/60">
            <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center p-1.5 shrink-0 shadow-md">
                <img src="{{ asset('image/Logo-UINSSC.png') }}" 
                     alt="Logo UINSSC" class="w-full h-full object-contain"
                     onerror="this.onerror=null; this.src='https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Logo_UIN_Siber_Syekh_Nurjati_Cirebon.png/600px-Logo_UIN_Siber_Syekh_Nurjati_Cirebon.png';">
            </div>
            <div class="min-w-0">
                <h1 class="text-lg font-black text-white tracking-tight leading-none">SIPRAK</h1>
                <p class="text-[11px] text-emerald-300 font-medium mt-1 truncate">Sistem Presensi Praktikum</p>
            </div>
        </div>

        <div class="px-4 pt-6 pb-2">
            <div class="flex justify-between items-center px-2 mb-3">
                <span class="text-[10px] font-extrabold tracking-widest text-emerald-400 uppercase">MENU UTAMA</span>
                <span class="text-[9px] font-bold text-emerald-200/50 bg-emerald-900/80 px-2 py-0.5 rounded">ADMIN</span>
            </div>

            <nav class="space-y-1.5">
                <a href="{{ url('/admin/dashboard') }}" class="nav-link">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="M3 9h18M9 9v11"/></svg>
                    <span class="flex-1">Data Master</span>
                </a>

                <a href="{{ route('admin.akademik.index') }}" class="nav-link active">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 21h18M5 21V8l7-5 7 5v13"/><path d="M9 11h1m4 0h1m-6 4h1m4 0h1"/></svg>
                    <span class="flex-1">Manajemen Akademik</span>
                </a>

                <a href="{{ route('admin.penugasan.index') }}" class="nav-link">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="8" r="3"/><circle cx="17" cy="9" r="2.5"/><path d="M3 20v-2a6 6 0 0 1 12 0v2z"/><path d="M16 15a5 5 0 0 1 5 5"/></svg>
                    <span class="flex-1">Penugasan & Mapping</span>
                </a>
            </nav>
        </div>

        <div class="flex-1"></div>

        <div class="border-t border-emerald-900/60 p-4">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-full bg-emerald-700 border border-emerald-500/50 flex items-center justify-center text-white text-xs font-black shadow-sm">
                    {{ substr(Auth::user()->nama ?? 'Admin', 0, 1) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-bold text-white truncate">{{ Auth::user()->nama ?? 'Administrator' }}</p>
                    <p class="text-[10px] text-emerald-300/80 truncate">Administrator SIPRAK</p>
                </div>
            </div>
        </div>
    </aside>

    <!-- MAIN CONTENT AREA -->
    <div class="flex-1 min-w-0 flex flex-col">

        <!-- TOPBAR -->
        <header class="bg-white border-b border-slate-200 sticky top-0 z-30 min-h-[76px] px-6 lg:px-8 flex items-center justify-between">
            <div class="text-xs flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-emerald-600"></span>
                <span class="font-extrabold text-emerald-950">SIPRAK</span>
                <span class="text-slate-300">/</span>
                <span class="text-slate-500 font-medium">Manajemen Akademik</span>
                <span class="text-slate-300">/</span>
                <span class="px-2.5 py-1 rounded-full bg-emerald-50 border border-emerald-200 text-emerald-800 font-bold text-[11px]">
                    Mata Kuliah Praktikum
                </span>
            </div>

            <div class="flex items-center gap-3">
                <div class="text-right hidden sm:block">
                    <p class="text-xs font-bold text-slate-900 leading-tight">{{ Auth::user()->nama ?? 'Admin Lab' }}</p>
                    <p class="text-[10px] text-emerald-700 font-semibold mt-0.5">Administrator</p>
                </div>
                <div class="w-9 h-9 rounded-full bg-emerald-800 text-white flex items-center justify-center font-extrabold text-xs shadow-md ring-2 ring-emerald-100">
                    {{ substr(Auth::user()->nama ?? 'A', 0, 1) }}
                </div>
            </div>
        </header>

        <!-- CONTENT BODY -->
        <main class="flex-1 px-6 py-8 max-w-6xl w-full mx-auto space-y-6">

            <!-- Alert Notifikasi Berhasil -->
            @if(session('success'))
                <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-xs font-bold flex items-center justify-between shadow-sm">
                    <div class="flex items-center gap-2">
                        <span>✅</span>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-emerald-600 hover:text-emerald-900 font-bold text-base">&times;</button>
                </div>
            @endif

            <!-- Alert Notifikasi Gagal/Error -->
            @if(session('error'))
                <div class="p-4 bg-rose-50 border border-rose-200 text-rose-800 rounded-xl text-xs font-bold flex items-center justify-between shadow-sm">
                    <div class="flex items-center gap-2">
                        <span>⚠️</span>
                        <span>{{ session('error') }}</span>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-rose-600 hover:text-rose-900 font-bold text-base">&times;</button>
                </div>
            @endif

            <!-- Title Header -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h2 class="text-2xl sm:text-3xl font-black tracking-tight text-slate-900">
                        Mata Kuliah Praktikum
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-500 mt-1 font-medium">
                        Mengelola daftar mata kuliah yang memiliki kegiatan praktikum di laboratorium.
                    </p>
                </div>

                <div class="flex items-center gap-2">
                    <a href="{{ route('admin.akademik.index') }}" class="px-4 py-2.5 rounded-xl border border-slate-200 bg-white text-xs font-bold text-slate-700 hover:bg-slate-50 transition">
                        ← Kembali
                    </a>
                    <button onclick="openModalCreate()" class="btn-primary inline-flex items-center gap-2 shadow-sm">
                        <svg class="w-4 h-4 stroke-[2.5]" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M12 5v14M5 12h14"/></svg>
                        Tambah Mata Kuliah
                    </button>
                </div>
            </div>

            <!-- TABLE CARD CONTAINER -->
            <section class="surface overflow-hidden">
                
                <!-- Filter Bar & Search Input -->
                <div class="p-4 sm:p-5 border-b border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4 bg-slate-50/50">
                    <div class="relative w-full sm:max-w-md">
                        <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="7"/><path d="m16 16 4 4"/>
                        </svg>
                        <input type="search" id="searchInput" onkeyup="filterTable()" 
                               class="w-full pl-10 pr-4 py-2 bg-white border border-slate-200 rounded-xl text-xs font-medium focus:outline-none focus:border-emerald-600 transition" 
                               placeholder="Cari berdasarkan kode atau nama mata kuliah...">
                    </div>

                    <div class="flex items-center gap-1.5 w-full sm:w-auto overflow-x-auto">
                        <button onclick="filterStatus('all')" class="status-tab active px-3 py-1.5 rounded-lg text-xs font-bold bg-emerald-800 text-white transition">Semua</button>
                        <button onclick="filterStatus('aktif')" class="status-tab px-3 py-1.5 rounded-lg text-xs font-bold text-slate-600 hover:bg-slate-200/60 transition">Aktif</button>
                        <button onclick="filterStatus('nonaktif')" class="status-tab px-3 py-1.5 rounded-lg text-xs font-bold text-slate-600 hover:bg-slate-200/60 transition">Nonaktif</button>
                    </div>
                </div>

                <!-- Data Table -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-xs" id="courseTable">
                        <thead>
                            <tr class="bg-slate-50/80 text-slate-500 font-bold uppercase tracking-wider border-b border-slate-100">
                                <th class="p-4 w-12 text-center">No</th>
                                <th class="p-4">Kode MK</th>
                                <th class="p-4">Nama Mata Kuliah</th>
                                <th class="p-4">Semester</th>
                                <th class="p-4">SKS</th>
                                <th class="p-4">Status</th>
                                <th class="p-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 font-medium text-slate-700" id="tableBody">
                            @forelse($mataPraktikum as $index =>$mk)
                                <tr class="course-row hover:bg-slate-50/80 transition" 
                                    data-code="{{ strtolower($mk->kode) }}" 
                                    data-name="{{ strtolower($mk->nama) }}" 
                                    data-status="{{ $mk->status ? 'aktif' : 'nonaktif' }}">
                                    <td class="p-4 text-center font-bold text-slate-400">{{ $index + 1 }}</td>
                                    <td class="p-4 font-mono font-bold text-slate-900">{{ $mk->kode }}</td>
                                    <td class="p-4 font-bold text-emerald-950">{{ $mk->nama }}</td>
                                    <td class="p-4">Semester {{ $mk->semester }}</td>
                                    <td class="p-4"><span class="px-2 py-0.5 rounded bg-slate-100 font-bold text-slate-600">{{ $mk->sks }} SKS</span></td>
                                    <td class="p-4">
                                        @if($mk->status)
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-emerald-50 border border-emerald-200 text-emerald-800 text-[10px] font-bold">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span> Aktif
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-slate-100 border border-slate-200 text-slate-500 text-[10px] font-bold">
                                                <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span> Nonaktif
                                            </span>
                                        @endif
                                    </td>
                                    <td class="p-4 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <!-- Tombol Edit -->
                                            <button onclick="openModalEdit({{ $mk->id }}, '{{$mk->kode }}', '{{ $mk->nama }}', {{$mk->semester }}, {{ $mk->sks }}, {{$mk->status ? 1 : 0 }})" 
                                                    class="p-1.5 hover:bg-emerald-50 text-emerald-700 rounded-lg transition font-bold" title="Edit Data">
                                                Edit
                                            </button>
                                            
                                            <!-- Tombol Hapus -->
                                            <form action="{{ route('admin.mata_praktikum.destroy', $mk->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus mata kuliah ini?')">
                                                @csrf 
                                                @method('DELETE')
                                                <button type="submit" class="p-1.5 hover:bg-rose-50 text-rose-600 rounded-lg transition font-bold" title="Hapus Data">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="p-8 text-center text-slate-400 font-medium">
                                        Belum ada data mata kuliah praktikum terdaftar.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="p-4 border-t border-slate-100 bg-slate-50/50 text-xs text-slate-500 flex justify-between items-center font-medium">
                    <span>Total Data: <strong id="totalCount" class="text-slate-800">{{ count($mataPraktikum) }}</strong> Mata Kuliah</span>
                </div>
            </section>

            <footer class="pt-6 pb-4 text-center sm:text-left">
                <p class="text-xs text-slate-400 font-medium">
                    &copy; {{ date('Y') }} SIPRAK · UIN Siber Syekh Nurjati Cirebon. All rights reserved.
                </p>
            </footer>

        </main>
    </div>

</div>

<!-- MODAL DIALOG: TAMBAH / EDIT MATA KULIAH -->
<div id="courseModal" class="hidden fixed inset-0 z-[60] bg-slate-900/40 backdrop-blur-sm items-center justify-center p-4">
    <div class="bg-white rounded-2xl w-full max-w-md shadow-2xl border border-slate-100 overflow-hidden">
        
        <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
            <h3 id="modalTitle" class="text-sm font-extrabold text-slate-900">
                Tambah Mata Kuliah
            </h3>
            <button onclick="closeModal()" class="text-slate-400 hover:text-slate-700 text-xl font-bold">&times;</button>
        </div>

        <form id="courseForm" method="POST" action="{{ route('admin.mata_praktikum.store') }}" class="p-6 space-y-4">
            @csrf
            <input type="hidden" id="methodField" name="_method" value="POST">

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Kode MK</label>
                <input type="text" id="formKode" name="kode" required placeholder="Contoh: IF101" class="field uppercase font-mono">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Nama Mata Kuliah</label>
                <input type="text" id="formNama" name="nama" required placeholder="Contoh: Algoritma & Pemrograman" class="field">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Semester</label>
                    <input type="number" id="formSemester" name="semester" required min="1" max="8" value="1" class="field">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">SKS</label>
                    <input type="number" id="formSks" name="sks" required min="1" max="6" value="3" class="field">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Status Kegiatan</label>
                <select id="formStatus" name="status" class="field">
                    <option value="1">Aktif</option>
                    <option value="0">Nonaktif</option>
                </select>
            </div>

            <div class="flex justify-end gap-2 pt-2">
                <button type="button" onclick="closeModal()" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-50 transition">
                    Batal
                </button>
                <button type="submit" class="btn-primary">
                    Simpan Data
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    let currentStatusFilter = 'all';

    function filterTable() {
        const query = document.getElementById('searchInput').value.toLowerCase().trim();
        const rows = document.querySelectorAll('.course-row');
        let visibleCount = 0;

        rows.forEach(row => {
            const code = row.dataset.code;
            const name = row.dataset.name;
            const status = row.dataset.status;

            const matchesSearch = code.includes(query) || name.includes(query);
            const matchesStatus = (currentStatusFilter === 'all') || (status === currentStatusFilter);

            if (matchesSearch && matchesStatus) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        document.getElementById('totalCount').textContent = visibleCount;
    }

    function filterStatus(status) {
        currentStatusFilter = status;
        
        document.querySelectorAll('.status-tab').forEach(tab => {
            tab.classList.remove('bg-emerald-800', 'text-white');
            tab.classList.add('text-slate-600');
        });

        event.target.classList.add('bg-emerald-800', 'text-white');
        event.target.classList.remove('text-slate-600');

        filterTable();
    }

    function openModalCreate() {
        document.getElementById('modalTitle').textContent = 'Tambah Mata Kuliah Praktikum';
        document.getElementById('courseForm').action = "{{ route('admin.mata_praktikum.store') }}";
        document.getElementById('methodField').value = 'POST';
        
        document.getElementById('formKode').value = '';
        document.getElementById('formNama').value = '';
        document.getElementById('formSemester').value = '1';
        document.getElementById('formSks').value = '3';
        document.getElementById('formStatus').value = '1';

        const modal = document.getElementById('courseModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function openModalEdit(id, kode, nama, semester, sks, status) {
        document.getElementById('modalTitle').textContent = 'Edit Mata Kuliah Praktikum';
        document.getElementById('courseForm').action = `/admin/akademik/mata-praktikum/${id}`;
        document.getElementById('methodField').value = 'PUT';

        document.getElementById('formKode').value = kode;
        document.getElementById('formNama').value = nama;
        document.getElementById('formSemester').value = semester;
        document.getElementById('formSks').value = sks;
        document.getElementById('formStatus').value = status;

        const modal = document.getElementById('courseModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeModal() {
        const modal = document.getElementById('courseModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>

</body>
</html>