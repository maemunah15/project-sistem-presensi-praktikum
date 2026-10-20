<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin | SIPRAK</title>

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
            border-radius: 13px;
        }

        .field {
            width: 100%;
            border: 1px solid #e1e9e5;
            background: #fafcfb;
            border-radius: 9px;
            padding: 9px 12px;
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
            padding: 9px 16px;
            font-size: 12px;
            font-weight: 600;
            transition: background .2s;
        }

        .btn-primary:hover {
            background: #064b3b;
        }

        .tab-btn {
            border: 1px solid #e1e9e5;
            background: white;
            border-radius: 9px;
            padding: 8px 14px;
            color: #52635b;
            font-size: 12px;
            font-weight: 600;
            white-space: nowrap;
            cursor: pointer;
            transition: all .2s;
        }

        .tab-btn.active {
            background: var(--green-dark);
            color: white;
            border-color: var(--green-dark);
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
            font-size: 11px;
        }

        .data-table tbody tr:hover { background: #fbfdfc; }

        .status-active {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            border-radius: 30px;
            padding: 4px 8px;
            background: #eaf8f0;
            border: 1px solid #c6ead5;
            color: #08784f;
            font-size: 10px;
            font-weight: 700;
        }

        .status-active::before {
            content: '';
            height: 5px;
            width: 5px;
            border-radius: 50%;
            background: #16a36c;
        }

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
    @include('partials.admin-sidebar', ['active' => 'master'])

    <!-- MAIN CONTENT AREA -->
    <div class="main-area ml-[250px] min-h-screen flex flex-col">

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
                        <span class="hidden sm:inline px-2.5 py-0.5 rounded-full bg-emerald-50 border border-emerald-100 text-emerald-800 font-semibold text-[11px]">Data Master</span>
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

        <main class="flex-1 px-6 py-6 lg:px-8 lg:py-8 space-y-6">

            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h2 class="text-xl sm:text-2xl font-bold tracking-tight text-[#183c30]">Data Master</h2>
                    <p class="text-xs text-slate-500 mt-1">Kelola data utama yang digunakan dalam sistem presensi praktikum.</p>
                </div>

                <button onclick="openModal()" class="btn-primary inline-flex items-center justify-center gap-2 self-start sm:self-auto shadow-sm">
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
                    <span>Tambah Data</span>
                </button>
            </div>

            @if(session('success'))
                <div class="p-3.5 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-xs font-semibold flex justify-between items-center shadow-sm">
                    <div class="flex items-center gap-2">
                        <span>✅</span>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-emerald-600 hover:text-emerald-900 text-base">&times;</button>
                </div>
            @endif

            @if(session('error'))
                <div class="p-3.5 bg-rose-50 border border-rose-200 text-rose-800 rounded-xl text-xs font-semibold flex justify-between items-center shadow-sm">
                    <div class="flex items-center gap-2">
                        <span>⚠️</span>
                        <span>{{ session('error') }}</span>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-rose-600 hover:text-rose-900 text-base">&times;</button>
                </div>
            @endif

            <div class="flex gap-2 overflow-x-auto pb-1">
                <button class="tab-btn {{ ($currentTab ?? 'mahasiswa') === 'mahasiswa' ? 'active' : '' }}" onclick="switchTab('mahasiswa', this)">Mahasiswa</button>
                <button class="tab-btn {{ ($currentTab ?? '') === 'dosen' ? 'active' : '' }}" onclick="switchTab('dosen', this)">Dosen</button>
                <button class="tab-btn {{ ($currentTab ?? '') === 'asisten' ? 'active' : '' }}" onclick="switchTab('asisten', this)">Asisten Praktikum</button>
                <button class="tab-btn {{ ($currentTab ?? '') === 'laboratorium' ? 'active' : '' }}" onclick="switchTab('laboratorium', this)">Laboratorium</button>
                <button class="tab-btn {{ ($currentTab ?? '') === 'matakuliah' ? 'active' : '' }}" onclick="switchTab('matakuliah', this)">Mata Kuliah</button>
            </div>

            <section class="surface overflow-hidden">
                <div class="p-4 border-b border-[#edf1ef]">
                    <div class="relative w-full sm:max-w-[360px]">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="11" cy="11" r="7"/><path d="m16 16 4 4"/></svg>
                        <input id="searchInput" type="search" class="field pl-9" placeholder="Cari data..." oninput="filterTable()">
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="data-table" id="dataTable">
                        <thead id="tableHead"></thead>
                        <tbody id="tableBody"></tbody>
                    </table>
                </div>
            </section>

            <footer class="pt-4 pb-2">
                <p class="text-[10px] text-slate-400">© {{ date('Y') }} SIPRAK · UIN Siber Syekh Nurjati Cirebon</p>
            </footer>

        </main>
    </div>
</div>

<!-- FORM DELETE DATABASE (TERSEMBUNYI) -->
<form id="deleteForm" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>

<!-- MODAL TAMBAH DATA DINAMIS -->
<div id="addModal" class="fixed inset-0 bg-black/40 z-50 hidden items-center justify-center p-4" style="display: none;">
    <div class="bg-white rounded-2xl max-w-md w-full p-6 space-y-4 shadow-xl">
        <div class="flex justify-between items-center border-b pb-3">
            <h3 class="text-sm font-bold text-slate-800" id="modalTitle">Tambah Data Master</h3>
            <button onclick="closeModal()" class="text-slate-400 hover:text-slate-600 text-lg">&times;</button>
        </div>

        <form id="addForm" action="{{ route('admin.master.store') }}" method="POST" class="space-y-3">
            @csrf
            <input type="hidden" name="tab" id="formTabInput" value="{{ $currentTab ?? 'mahasiswa' }}">

            <div>
                <label class="block text-[11px] font-semibold text-slate-600 mb-1" id="labelCol1">NIM / NIP / KODE</label>
                <input type="text" id="inputCol1" name="col1" required class="field" placeholder="Masukkan ID / Kode">
            </div>

            <div>
                <label class="block text-[11px] font-semibold text-slate-600 mb-1" id="labelCol2">Nama / Keterangan</label>
                <input type="text" id="inputCol2" name="col2" required class="field" placeholder="Masukkan Nama">
            </div>

            <div id="containerCol3">
                <label class="block text-[11px] font-semibold text-slate-600 mb-1" id="labelCol3">Program Studi / Detail</label>
                <input type="text" id="inputCol3" name="col3" class="field" placeholder="Masukkan Detail">
            </div>

            <div id="containerCol4" class="hidden">
                <label class="block text-[11px] font-semibold text-slate-600 mb-1" id="labelCol4">PRAKTIKUM</label>
                <input type="text" id="inputCol4" name="col4" class="field" placeholder="Masukkan Nama Praktikum">
            </div>

            <div class="flex justify-end gap-2 pt-2">
                <button type="button" onclick="closeModal()" class="px-3 py-2 rounded-lg border text-xs font-semibold text-slate-600 hover:bg-slate-50">Batal</button>
                <button type="submit" class="btn-primary" id="btnSubmit">Simpan Data</button>
            </div>
        </form>
    </div>
</div>

<script>
    const masterData = {
        mahasiswa: [
            @if(isset($mahasiswas))
                @foreach($mahasiswas as $m)
                    { id: {{ $m->id }}, col1: "{{ $m->nip_nim }}", col2: "{{ addslashes($m->nama) }}", col3: "{{ $m->email }}", status: "{{ $m->status ? 'Aktif' : 'Nonaktif' }}" },
                @endforeach
            @endif
        ],
        dosen: [
            @if(isset($dosens))
                @foreach($dosens as $d)
                    { id: {{ $d->id }}, col1: "{{ $d->nip_nim }}", col2: "{{ addslashes($d->nama) }}", col3: "{{ $d->email }}", status: "{{ $d->status ? 'Aktif' : 'Nonaktif' }}" },
                @endforeach
            @endif
        ],
        asisten: [
            @if(isset($aspraks))
                @foreach($aspraks as $a)
                    { id: {{ $a->id }}, col1: "{{ $a->nip_nim }}", col2: "{{ addslashes($a->nama) }}", col3: "{{ $a->email }}", extra: "Lab Komputer", status: "{{ $a->status ? 'Aktif' : 'Nonaktif' }}" },
                @endforeach
            @endif
        ],
        laboratorium: [
            @if(isset($laboratoriums))
                @foreach($laboratoriums as $lab)
                    { id: "{{ $lab['kode'] }}", col1: "{{ $lab['kode'] }}", col2: "{{ addslashes($lab['nama']) }}", col3: "{{ $lab['lokasi'] }}", status: "Aktif" },
                @endforeach
            @endif
        ],
        matakuliah: [
            @if(isset($matakuliahs))
                @foreach($matakuliahs as $mk)
                    { id: {{ $mk->id }}, col1: "{{ $mk->kode }}", col2: "{{ addslashes($mk->nama) }}", col3: "{{ $mk->sks }} SKS", extra: "Semester {{ $mk->semester }}", status: "{{ $mk->status ? 'Aktif' : 'Nonaktif' }}" },
                @endforeach
            @endif
        ]
    };

    let currentTab = "{{ $currentTab ?? 'mahasiswa' }}";

    function switchTab(tab, btn) {
        currentTab = tab;
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        if (btn) btn.classList.add('active');
        const formTab = document.getElementById('formTabInput');
        if (formTab) formTab.value = tab;
        history.replaceState(null, '', '?tab=' + tab);
        renderTable();
    }

    function renderTable() {
        const head = document.getElementById('tableHead');
        const body = document.getElementById('tableBody');
        const data = masterData[currentTab] || [];

        let thHTML = '';
        if (currentTab === 'mahasiswa') {
            thHTML = `<tr><th>NIM</th><th>NAMA</th><th>PROGRAM STUDI</th><th>STATUS</th><th class="text-right">AKSI</th></tr>`;
        } else if (currentTab === 'dosen') {
            thHTML = `<tr><th>NIP</th><th>NAMA DOSEN</th><th>PRODI</th><th>STATUS</th><th class="text-right">AKSI</th></tr>`;
        } else if (currentTab === 'asisten') {
            thHTML = `<tr><th>ID ASPRAK</th><th>NAMA ASPRAK</th><th>ALOKASI LAB</th><th>PRAKTIKUM</th><th>STATUS</th><th class="text-right">AKSI</th></tr>`;
        } else if (currentTab === 'laboratorium') {
            thHTML = `<tr><th>KODE LAB</th><th>NAMA LAB</th><th>LOKASI</th><th>STATUS</th><th class="text-right">AKSI</th></tr>`;
        } else if (currentTab === 'matakuliah') {
            thHTML = `<tr><th>KODE MK</th><th>NAMA MATA KULIAH</th><th>SKS</th><th>SEMESTER</th><th>STATUS</th><th class="text-right">AKSI</th></tr>`;
        }
        head.innerHTML = thHTML;

        let tbHTML = '';
        if (data.length === 0) {
            tbHTML = `<tr><td colspan="6" class="text-center p-6 text-slate-400">Belum ada data.</td></tr>`;
        } else {
            data.forEach((item, idx) => {
                if (currentTab === 'mahasiswa') {
                    tbHTML += `
                        <tr>
                            <td class="font-bold text-slate-700">${item.col1}</td>
                            <td class="font-semibold text-slate-800">${item.col2}</td>
                            <td class="text-slate-500">${item.col3}</td>
                            <td><span class="status-active">${item.status}</span></td>
                            <td>
                                <div class="flex items-center justify-end gap-3 font-semibold text-xs">
                                    <button onclick="editData(${idx})" class="text-emerald-700 hover:underline">Ubah</button>
                                    <button onclick="deleteData(${idx})" class="text-rose-600 hover:underline">Hapus</button>
                                </div>
                            </td>
                        </tr>
                    `;
                } else if (currentTab === 'asisten') {
                    tbHTML += `
                        <tr>
                            <td class="font-bold text-slate-700">${item.col1}</td>
                            <td class="font-semibold text-slate-800">${item.col2}</td>
                            <td class="text-slate-500 font-medium">${item.col3}</td>
                            <td><span class="inline-block px-2 py-0.5 rounded bg-slate-50 border border-slate-200 text-[10px] font-semibold text-slate-600">${item.extra || '-'}</span></td>
                            <td><span class="status-active">${item.status}</span></td>
                            <td>
                                <div class="flex items-center justify-end gap-3 font-semibold text-xs">
                                    <button onclick="editData(${idx})" class="text-emerald-700 hover:underline">Ubah</button>
                                    <button onclick="deleteData(${idx})" class="text-rose-600 hover:underline">Hapus</button>
                                </div>
                            </td>
                        </tr>
                    `;
                } else if (currentTab === 'laboratorium' || currentTab === 'dosen') {
                    tbHTML += `
                        <tr>
                            <td class="font-bold text-slate-700">${item.col1}</td>
                            <td class="font-semibold text-slate-800">${item.col2}</td>
                            <td class="text-slate-500 font-medium">${item.col3}</td>
                            <td><span class="status-active">${item.status}</span></td>
                            <td>
                                <div class="flex items-center justify-end gap-3 font-semibold text-xs">
                                    <button onclick="editData(${idx})" class="text-emerald-700 hover:underline">Ubah</button>
                                    <button onclick="deleteData(${idx})" class="text-rose-600 hover:underline">Hapus</button>
                                </div>
                            </td>
                        </tr>
                    `;
                } else {
                    tbHTML += `
                        <tr>
                            <td class="font-bold text-slate-700">${item.col1}</td>
                            <td class="font-semibold text-slate-800">${item.col2}</td>
                            <td class="text-slate-500">${item.col3}</td>
                            <td><span class="inline-block px-2 py-0.5 rounded bg-slate-50 border border-slate-200 text-[10px] font-semibold text-slate-600">${item.extra || '-'}</span></td>
                            <td><span class="status-active">${item.status}</span></td>
                            <td>
                                <div class="flex items-center justify-end gap-3 font-semibold text-xs">
                                    <button onclick="editData(${idx})" class="text-emerald-700 hover:underline">Ubah</button>
                                    <button onclick="deleteData(${idx})" class="text-rose-600 hover:underline">Hapus</button>
                                </div>
                            </td>
                        </tr>
                    `;
                }
            });
        }
        body.innerHTML = tbHTML;
        const badge = document.getElementById('badgeCount');
        if (badge) {
            badge.innerText = data.length;
        }
    }

    function openModal() {
        document.getElementById('modalTitle').innerText = 'Tambah Data ' + currentTab.toUpperCase();
        
        const l1 = document.getElementById('labelCol1');
        const l2 = document.getElementById('labelCol2');
        const c3Container = document.getElementById('containerCol3');
        const c4Container = document.getElementById('containerCol4');

        // Sembunyikan containerCol4 secara default
        c4Container.classList.add('hidden');

        if (currentTab === 'asisten') {
            l1.innerText = 'ID / NIM ASPRAK';
            document.getElementById('inputCol1').placeholder = 'Contoh: 200103';
            
            l2.innerText = 'NAMA ASPRAK';
            document.getElementById('inputCol2').placeholder = 'Masukkan Nama Asprak';
            
            c3Container.innerHTML = `
                <label class="block text-[11px] font-semibold text-slate-600 mb-1">PROGRAM STUDI / LAB</label>
                <input type="text" id="inputCol3" name="col3" class="field" placeholder="Contoh: Teknik Informatika / Lab 1">
            `;
        } else if (currentTab === 'laboratorium') {
            l1.innerText = 'KODE LAB';
            document.getElementById('inputCol1').placeholder = 'Contoh: LAB-04';
            
            l2.innerText = 'NAMA LAB';
            document.getElementById('inputCol2').placeholder = 'Contoh: Lab Komputer 3';
            
            c3Container.innerHTML = `
                <label class="block text-[11px] font-semibold text-slate-600 mb-1">LOKASI</label>
                <input type="text" id="inputCol3" name="col3" class="field" placeholder="Contoh: Gedung A Lt. 2">
            `;
        } else if (currentTab === 'dosen') {
            l1.innerText = 'NIP';
            document.getElementById('inputCol1').placeholder = 'Masukkan NIP Dosen';
            
            l2.innerText = 'NAMA DOSEN';
            document.getElementById('inputCol2').placeholder = 'Masukkan Nama Lengkap beserta Gelar';
            
            c3Container.innerHTML = `
                <label class="block text-[11px] font-semibold text-slate-600 mb-1">PROGRAM STUDI</label>
                <input type="text" id="inputCol3" name="col3" class="field" placeholder="Masukkan Program Studi">
            `;
        } else if (currentTab === 'matakuliah') {
            l1.innerText = 'KODE MK';
            document.getElementById('inputCol1').placeholder = 'Contoh: IF202';
            
            l2.innerText = 'NAMA MATA KULIAH';
            document.getElementById('inputCol2').placeholder = 'Contoh: Pemrograman Web';
            
            c3Container.innerHTML = `
                <label class="block text-[11px] font-semibold text-slate-600 mb-1">JUMLAH SKS</label>
                <input type="number" id="inputCol3" name="col3" class="field" value="3" placeholder="SKS">
            `;

            c4Container.classList.remove('hidden');
            document.getElementById('inputCol4').placeholder = 'Semester (1-8)';
        } else {
            l1.innerText = 'NIM';
            document.getElementById('inputCol1').placeholder = 'Masukkan NIM Mahasiswa';
            
            l2.innerText = 'NAMA MAHASISWA';
            document.getElementById('inputCol2').placeholder = 'Masukkan Nama Mahasiswa';
            
            c3Container.innerHTML = `
                <label class="block text-[11px] font-semibold text-slate-600 mb-1">PROGRAM STUDI</label>
                <input type="text" id="inputCol3" name="col3" class="field" placeholder="Masukkan Program Studi">
            `;
        }

        const modal = document.getElementById('addModal');
        if (modal) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            modal.style.display = 'flex';
        }
    }

    function closeModal() {
        const modal = document.getElementById('addModal');
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            modal.style.display = 'none';
        }
        const form = document.getElementById('addForm');
        if (form) {
            form.reset();
        }
    }

    function deleteData(idx) {
        const item = masterData[currentTab][idx];
        if (!item) return;

        if (confirm(`Yakin ingin menghapus data ${item.col2} dari database?`)) {
            if (item.id) {
                const form = document.getElementById('deleteForm');
                form.action = `/admin/dashboard/${item.id}?tab=${currentTab}`;
                form.submit();
            } else {
                masterData[currentTab].splice(idx, 1);
                renderTable();
            }
        }
    }

    function editData(idx) {
        const item = masterData[currentTab][idx];
        alert('Data ' + item.col2 + ' (' + item.col1 + ') terdaftar aktif di Database MySQL.');
    }

    function filterTable() {
        const val = document.getElementById('searchInput').value.toLowerCase();
        const rows = document.querySelectorAll('#tableBody tr');
        rows.forEach(row => {
            row.style.display = row.innerText.toLowerCase().includes(val) ? '' : 'none';
        });
    }

    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('open');
        document.getElementById('mobileOverlay').classList.toggle('show');
    }

    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('addForm');
        if (form) {
            form.addEventListener('submit', function() {
                closeModal();
                const btn = document.getElementById('btnSubmit');
                if (btn) {
                    setTimeout(() => {
                        btn.disabled = true;
                        btn.innerHTML = 'Menyimpan ke Database...';
                        btn.classList.add('opacity-75', 'cursor-not-allowed');
                    }, 20);
                }
            });
        }
        renderTable();
    });
</script>

</body>
</html>