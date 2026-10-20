<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa - Portal Laboratorium UIN SSC</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-100 min-h-screen text-slate-800 flex">

    <!-- 1. SIDEBAR LEFT NAVIGATION -->
    <aside class="w-64 bg-slate-900 text-slate-300 min-h-screen flex flex-col justify-between hidden md:flex sticky top-0 h-screen border-r border-slate-800">
        <div>
            <!-- Sidebar Header -->
            <div class="p-6 border-b border-slate-800 flex items-center gap-3">
                <div class="w-9 h-9 bg-emerald-600 rounded-xl flex items-center justify-center text-white text-lg font-bold shadow-lg shadow-emerald-600/30">
                    🎓
                </div>
                <div>
                    <h1 class="font-bold text-white text-sm leading-tight">Presensi Lab</h1>
                    <p class="text-[11px] text-slate-400 font-semibold">UIN SSC Mahasiswa</p>
                </div>
            </div>

            <!-- Sidebar Menu List -->
            <nav class="p-4 space-y-1.5 text-xs font-semibold">
                <p class="px-3 text-[10px] uppercase font-bold text-slate-500 tracking-wider mb-2">Menu Utama</p>
                
                <a href="{{ route('mahasiswa.dashboard') }}" class="flex items-center gap-3 px-3.5 py-2.5 bg-emerald-600 text-white rounded-xl font-bold shadow-md shadow-emerald-600/20 transition">
                    <span class="text-base">📊</span> Dashboard
                </a>

                <p class="px-3 text-[10px] uppercase font-bold text-slate-500 tracking-wider pt-4 mb-2">Layanan Presensi</p>
                
                <a href="#" class="flex items-center gap-3 px-3.5 py-2.5 text-slate-400 hover:text-white hover:bg-slate-800/80 rounded-xl transition">
                    <span class="text-base">📷</span> Scan QR Presensi
                </a>

                <a href="#" class="flex items-center gap-3 px-3.5 py-2.5 text-slate-400 hover:text-white hover:bg-slate-800/80 rounded-xl transition">
                    <span class="text-base">📄</span> Pengajuan Izin / Sakit
                </a>

                <a href="#" class="flex items-center gap-3 px-3.5 py-2.5 text-slate-400 hover:text-white hover:bg-slate-800/80 rounded-xl transition">
                    <span class="text-base">📈</span> Riwayat Kehadiran
                </a>
            </nav>
        </div>

        <!-- Sidebar Footer Profile Info -->
        <div class="p-4 border-t border-slate-800">
            <div class="bg-slate-800/60 p-3 rounded-xl flex items-center justify-between">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 bg-emerald-500/20 text-emerald-400 rounded-lg flex items-center justify-center font-bold text-xs border border-emerald-500/30">
                        M
                    </div>
                    <div>
                        <p class="text-xs font-bold text-white leading-tight truncate w-28">{{ Auth::user()->nama ?? 'Mahasiswa' }}</p>
                        <p class="text-[10px] text-slate-400 font-mono">NIM: {{ Auth::user()->nip_nim ?? '1227050002' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </aside>

    <!-- 2. MAIN CONTENT AREA -->
    <div class="flex-1 flex flex-col min-w-0">
        
        <!-- Topbar Navbar -->
        <header class="bg-white border-b border-slate-200 sticky top-0 z-20 px-6 py-3.5 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <h2 class="text-base font-bold text-slate-800">Portal Mahasiswa</h2>
                <span class="px-2.5 py-0.5 bg-emerald-50 text-emerald-700 text-[10px] font-extrabold rounded-full border border-emerald-200 uppercase">
                    Mahasiswa Aktif
                </span>
            </div>

            <!-- Profile & Logout Button -->
            <div class="flex items-center gap-4">
                <div class="text-right hidden sm:block">
                    <p class="text-xs font-bold text-slate-800 leading-tight">{{ Auth::user()->nama ?? 'Mahasiswa Contoh' }}</p>
                    <p class="text-[11px] text-slate-500">{{ Auth::user()->email ?? 'mahasiswa@uin.ac.id' }}</p>
                </div>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="px-3.5 py-2 bg-slate-100 hover:bg-rose-50 hover:text-rose-600 hover:border-rose-200 text-slate-700 font-bold text-xs rounded-xl border border-slate-200 transition">
                        Keluar
                    </button>
                </form>
            </div>
        </header>

        <!-- Content Body Container -->
        <main class="p-6 md:p-8 max-w-7xl w-full mx-auto space-y-8">

            <!-- Banner Welcome Minimalis & Modern -->
            <div class="bg-gradient-to-r from-slate-900 via-emerald-950 to-slate-900 rounded-2xl p-6 text-white shadow-xl relative overflow-hidden flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div class="relative z-10 space-y-1">
                    <span class="px-3 py-1 bg-white/10 text-emerald-200 text-xs font-semibold rounded-full border border-white/10 inline-block mb-1">
                        Portal Praktikum Mahasiswa
                    </span>
                    <h3 class="text-2xl font-extrabold">Selamat Datang, {{ Auth::user()->nama ?? 'Mahasiswa Contoh' }}! 👋</h3>
                    <p class="text-slate-300 text-xs">NIM: <span class="font-mono text-white font-semibold">{{ Auth::user()->nip_nim ?? '1227050002' }}</span> | Email: {{ Auth::user()->email ?? 'mahasiswa@uin.ac.id' }}</p>
                </div>
            </div>

            <!-- Stat Cards / Ringkasan Metrik -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Total Kelas</p>
                        <h4 class="text-2xl font-extrabold text-slate-900 mt-1">4 Kelas</h4>
                    </div>
                    <div class="w-11 h-11 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center text-xl font-bold">
                        📚
                    </div>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Kehadiran</p>
                        <h4 class="text-2xl font-extrabold text-emerald-600 mt-1">95%</h4>
                    </div>
                    <div class="w-11 h-11 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center text-xl font-bold">
                        📊
                    </div>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Total Hadir</p>
                        <h4 class="text-2xl font-extrabold text-slate-900 mt-1">18 Pertemuan</h4>
                    </div>
                    <div class="w-11 h-11 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center text-xl font-bold">
                        ✅
                    </div>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Sesi Aktif</p>
                        <h4 class="text-2xl font-extrabold text-amber-600 mt-1">1 Praktikum</h4>
                    </div>
                    <div class="w-11 h-11 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center text-xl font-bold">
                        ⚡
                    </div>
                </div>
            </div>

            <!-- Grid Sesi Presensi Aktif & Aksi Cepat -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <!-- Sesi Presensi Aktif (2 Kolom) -->
                <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6 space-y-5">
                    <div class="flex justify-between items-center pb-4 border-b border-slate-100">
                        <div>
                            <h3 class="text-base font-bold text-slate-900">Sesi Presensi Aktif</h3>
                            <p class="text-xs text-slate-500 mt-0.5">Silakan scan QR Code saat praktikum sedang berlangsung.</p>
                        </div>
                        <span class="px-3 py-1 bg-emerald-50 text-emerald-700 text-xs font-bold rounded-full border border-emerald-200 animate-pulse flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Sesi Berlangsung
                        </span>
                    </div>

                    <!-- Card Detail Praktikum -->
                    <div class="bg-slate-50 rounded-xl p-5 border border-slate-200/80 space-y-3">
                        <div class="flex justify-between items-start">
                            <div>
                                <span class="px-2.5 py-0.5 bg-emerald-100 text-emerald-800 font-bold text-[10px] rounded-md uppercase tracking-wider">
                                    Pemrograman Web
                                </span>
                                <h4 class="text-lg font-bold text-slate-900 mt-1.5">Kelas IF-A (Pertemuan ke-3)</h4>
                            </div>
                            <span class="text-xs font-semibold text-slate-500 bg-white px-3 py-1 rounded-lg border border-slate-200">
                                ⏰ 08:00 - 10:00 WIB
                            </span>
                        </div>
                        <p class="text-xs text-slate-600"><strong class="text-slate-800">Materi:</strong> Pengenalan Framework Laravel & Routing Dasar</p>
                        <p class="text-xs text-slate-600"><strong class="text-slate-800">Ruangan:</strong> Lab Komputer 1</p>
                    </div>

                    <!-- Tombol Action Scan QR Code -->
                    <a href="#" class="w-full py-3.5 bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs rounded-xl shadow-md shadow-emerald-700/20 flex items-center justify-center gap-2 transition">
                        <span class="text-base">📷</span> Scan QR Code Presensi
                    </a>
                </div>

                <!-- Panel Aksi Cepat (1 Kolom) -->
                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6 space-y-4">
                    <h3 class="text-base font-bold text-slate-900 pb-3 border-b border-slate-100">Aksi Cepat</h3>

                    <a href="#" class="block p-4 rounded-xl border border-slate-200/80 hover:border-emerald-500 hover:bg-emerald-50/30 transition group">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-slate-100 group-hover:bg-emerald-100 text-slate-700 group-hover:text-emerald-700 rounded-xl flex items-center justify-center text-lg transition">
                                    📄
                                </div>
                                <div>
                                    <h4 class="text-xs font-bold text-slate-900 group-hover:text-emerald-700 transition">Pengajuan Izin / Sakit</h4>
                                    <p class="text-[11px] text-slate-500 mt-0.5">Unggah surat keterangan tidak hadir</p>
                                </div>
                            </div>
                            <span class="text-slate-400 group-hover:text-emerald-700 font-bold text-sm transition">→</span>
                        </div>
                    </a>

                    <a href="#" class="block p-4 rounded-xl border border-slate-200/80 hover:border-emerald-500 hover:bg-emerald-50/30 transition group">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-slate-100 group-hover:bg-emerald-100 text-slate-700 group-hover:text-emerald-700 rounded-xl flex items-center justify-center text-lg transition">
                                    📈
                                </div>
                                <div>
                                    <h4 class="text-xs font-bold text-slate-900 group-hover:text-emerald-700 transition">Riwayat Kehadiran</h4>
                                    <p class="text-[11px] text-slate-500 mt-0.5">Cek rekap presensi seluruh mata praktikum</p>
                                </div>
                            </div>
                            <span class="text-slate-400 group-hover:text-emerald-700 font-bold text-sm transition">→</span>
                        </div>
                    </a>
                </div>

            </div>

        </main>
    </div>

</body>
</html>