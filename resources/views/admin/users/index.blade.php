<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Akun Pengguna | SIPRAK</title>

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
            padding: 10px 16px;
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
            padding: 8px 16px;
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
    @include('partials.admin-sidebar', ['active' => 'users'])

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
                        <span class="hidden sm:inline px-2.5 py-0.5 rounded-full bg-emerald-50 border border-emerald-100 text-emerald-800 font-semibold text-[11px]">Kelola Akun Pengguna</span>
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
        <main class="flex-1 px-6 py-6 lg:px-8 lg:py-8 space-y-5 max-w-5xl">

            <!-- HEADER TITLE -->
            <div>
                <h2 class="text-xl font-bold tracking-tight text-[#183c30]">Kelola Akun Pengguna</h2>
                <p class="text-xs text-slate-500 mt-0.5">Atur akun dan hak akses pengguna SIPRAK.</p>
            </div>

            @if(session('success'))
                <div class="p-3 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-xs font-medium flex justify-between items-center shadow-sm">
                    <span>{{ session('success') }}</span>
                    <button onclick="this.parentElement.remove()">&times;</button>
                </div>
            @endif

            <!-- TOMBOL TAMBAH PENGGUNA -->
            <div>
                <button onclick="openModalUser()" class="btn-primary w-full flex items-center justify-center gap-2 text-sm py-2.5 shadow-sm">
                    <span class="text-base font-normal">+</span>
                    <span>Tambah Pengguna</span>
                </button>
            </div>

            <!-- FILTER ROLE TABS -->
            <div class="flex items-center gap-2 overflow-x-auto pb-1">
                <a href="{{ route('admin.users.index', ['role' => 'semua']) }}" 
                   class="tab-btn {{ ($role ?? 'semua') === 'semua' ? 'active' : '' }}">
                   Semua
                </a>
                <a href="{{ route('admin.users.index', ['role' => 'admin']) }}" 
                   class="tab-btn {{ ($role ?? '') === 'admin' ? 'active' : '' }}">
                   Admin
                </a>
                <a href="{{ route('admin.users.index', ['role' => 'dosen_asisten']) }}" 
                   class="tab-btn {{ ($role ?? '') === 'dosen_asisten' ? 'active' : '' }}">
                   Dosen &amp; Asisten
                </a>
                <a href="{{ route('admin.users.index', ['role' => 'mahasiswa']) }}" 
                   class="tab-btn {{ ($role ?? '') === 'mahasiswa' ? 'active' : '' }}">
                   Mahasiswa
                </a>
            </div>

            <!-- USER LIST CONTAINER CARD -->
            <section class="surface overflow-hidden">

                <!-- INPUT PENCARIAN -->
                <div class="p-3.5 border-b border-[#edf1ef]">
                    <div class="relative">
                        <svg class="w-4 h-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                        </svg>
                        <input type="text" placeholder="Cari nama, NIM, atau email..." class="w-full pl-9 pr-4 py-2 border-none text-xs outline-none bg-transparent placeholder-slate-400 text-slate-700">
                    </div>
                </div>

                <div class="px-5 py-3 border-b border-[#edf1ef] bg-slate-50/50">
                    <span class="text-[10px] font-bold tracking-wider text-slate-400 uppercase">DAFTAR PENGGUNA</span>
                </div>

                <!-- LIST PENGGUNA -->
                <div class="divide-y divide-[#edf1ef]">
                    @forelse($users as $u)
                        <div class="p-4 flex items-center justify-between gap-4 hover:bg-slate-50/80 transition">
                            <div class="flex items-center gap-3.5 min-w-0">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm shrink-0 
                                    {{ $u->role === 'Administrator' ? 'bg-emerald-100 text-emerald-800' : '' }}
                                    {{ $u->role === 'Dosen' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $u->role === 'Asisten Praktikum' ? 'bg-amber-100 text-amber-800' : '' }}
                                    {{ $u->role === 'Mahasiswa' ? 'bg-purple-100 text-purple-800' : '' }}">
                                    {{ substr($u->nama, 0, 1) }}
                                </div>

                                <div class="min-w-0">
                                    <h4 class="text-xs font-bold text-slate-800 truncate">{{ $u->nama }}</h4>
                                    <p class="text-[11px] text-slate-400 mt-0.5 truncate">
                                        {{ $u->identifier }} · {{ $u->role }}
                                    </p>
                                    <div class="mt-1">
                                        @if($u->status === 'Aktif')
                                            <span class="inline-block px-2 py-0.5 rounded-md bg-emerald-50 text-emerald-700 border border-emerald-200 text-[10px] font-bold">
                                                Aktif
                                            </span>
                                        @else
                                            <span class="inline-block px-2 py-0.5 rounded-md bg-rose-50 text-rose-700 border border-rose-200 text-[10px] font-bold">
                                                Nonaktif
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center gap-2">
                                <form action="{{ route('admin.users.destroy', $u->id) }}" method="POST" onsubmit="return confirm('Hapus akun pengguna ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-slate-400 hover:text-rose-600 transition">
                                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                            <path d="M3 6h18M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="p-8 text-center text-xs text-slate-400">
                            Tidak ada akun pengguna ditemukan.
                        </div>
                    @endforelse
                </div>
            </section>

            <footer class="pt-4 pb-2">
                <p class="text-[10px] text-slate-400">© {{ date('Y') }} SIPRAK · UIN Siber Syekh Nurjati Cirebon</p>
            </footer>

        </main>
    </div>
</div>

<!-- MODAL TAMBAH PENGGUNA -->
<div id="modalUser" class="fixed inset-0 bg-black/40 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-md w-full p-6 space-y-4 shadow-xl">
        <div class="flex justify-between items-center border-b pb-3">
            <h3 class="text-sm font-bold text-slate-800">Tambah Akun Pengguna</h3>
            <button onclick="closeModalUser()" class="text-slate-400 hover:text-slate-600 text-lg">&times;</button>
        </div>

        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-3">
            @csrf
            <div>
                <label class="block text-[11px] font-semibold text-slate-600 mb-1">Nama Lengkap</label>
                <input type="text" name="nama" required class="field" placeholder="Contoh: Dr. Ahmad, M.T.">
            </div>

            <div>
                <label class="block text-[11px] font-semibold text-slate-600 mb-1">NIP / NIM / Kode Identitas</label>
                <input type="text" name="identifier" required class="field" placeholder="Contoh: 19800101... atau 20230101">
            </div>

            <div>
                <label class="block text-[11px] font-semibold text-slate-600 mb-1">Peran / Role</label>
                <select name="role" class="field" required>
                    <option value="Administrator">Administrator</option>
                    <option value="Dosen">Dosen</option>
                    <option value="Asisten Praktikum">Asisten Praktikum</option>
                    <option value="Mahasiswa" selected>Mahasiswa</option>
                </select>
            </div>

            <div>
                <label class="block text-[11px] font-semibold text-slate-600 mb-1">Status</label>
                <select name="status" class="field" required>
                    <option value="Aktif" selected>Aktif</option>
                    <option value="Nonaktif">Nonaktif</option>
                </select>
            </div>

            <div class="flex justify-end gap-2 pt-2">
                <button type="button" onclick="closeModalUser()" class="px-3 py-2 rounded-lg border text-xs font-semibold text-slate-600 hover:bg-slate-50">Batal</button>
                <button type="submit" class="btn-primary">Simpan Akun</button>
            </div>
        </form>
    </div>
</div>

<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('open');
        document.getElementById('mobileOverlay').classList.toggle('show');
    }

    function openModalUser() { document.getElementById('modalUser').classList.remove('hidden'); }
    function closeModalUser() { document.getElementById('modalUser').classList.add('hidden'); }
</script>

</body>
</html>