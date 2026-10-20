<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk | SIPRAK - UIN Siber Syekh Nurjati Cirebon</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * { box-sizing: border-box; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f5f7f8; color: #23352f; }
        .field { width: 100%; border: 1px solid #e1e9e5; background: #fafcfb; border-radius: 10px; padding: 11px 14px; font-size: 13px; outline: none; transition: all .2s; }
        .field:focus { border-color: #087f60; box-shadow: 0 0 0 3px rgba(8,127,96,.1); }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center p-4 lg:p-8 bg-[#f5f7f8]">

<div class="max-w-4xl w-full bg-white rounded-3xl border border-[#e5ebe8] shadow-xl overflow-hidden grid grid-cols-1 md:grid-cols-12 min-h-[580px]">

    <!-- KIRI: BRANDING & BANNER -->
    <div class="md:col-span-5 bg-[#064b3b] p-8 text-white flex flex-col justify-between relative overflow-hidden">
        <div class="space-y-6 z-10">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center p-1.5 shadow-sm">
                    <img src="{{ asset('image/Logo-UINSSC.png') }}" alt="Logo UINSSC" class="w-full h-full object-contain" onerror="this.onerror=null; this.src='https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Logo_UIN_Siber_Syekh_Nurjati_Cirebon.png/600px-Logo_UIN_Siber_Syekh_Nurjati_Cirebon.png';">
                </div>
                <div>
                    <h1 class="text-base font-bold tracking-tight text-white leading-tight">SIPRAK</h1>
                    <p class="text-[10px] text-emerald-200/80">Sistem Presensi Praktikum</p>
                </div>
            </div>

            <div class="pt-4 space-y-2">
                <span class="px-2.5 py-1 rounded-full bg-white/10 border border-white/20 text-[10px] font-semibold text-emerald-200 uppercase tracking-wider">PORTAL PRESENSI PRAKTIKUM</span>
                <h2 class="text-xl font-extrabold text-white leading-tight">Presensi Praktikum, Lebih Tertib dan Terintegrasi.</h2>
                <p class="text-xs text-emerald-100/70 leading-relaxed pt-1">Kelola kehadiran praktikum secara digital melalui sistem presensi yang praktis, terstruktur, dan tercatat otomatis.</p>
            </div>
        </div>

        <div class="space-y-2.5 z-10 pt-6">
            <div class="p-3 rounded-xl bg-white/5 border border-white/10 flex items-center gap-3">
                <div class="w-7 h-7 rounded-lg bg-white/10 flex items-center justify-center text-xs">📲</div>
                <div>
                    <p class="text-xs font-bold text-white">Presensi QR Code</p>
                    <p class="text-[10px] text-emerald-200/70">Pencatatan kehadiran digital</p>
                </div>
            </div>

            <div class="p-3 rounded-xl bg-white/5 border border-white/10 flex items-center gap-3">
                <div class="w-7 h-7 rounded-lg bg-white/10 flex items-center justify-center text-xs">📈</div>
                <div>
                    <p class="text-xs font-bold text-white">Rekapitulasi Kehadiran</p>
                    <p class="text-[10px] text-emerald-200/70">Data dan laporan lebih terstruktur</p>
                </div>
            </div>

            <div class="p-3 rounded-xl bg-white/5 border border-white/10 flex items-center gap-3">
                <div class="w-7 h-7 rounded-lg bg-white/10 flex items-center justify-center text-xs">👥</div>
                <div>
                    <p class="text-xs font-bold text-white">Manajemen Praktikum</p>
                    <p class="text-[10px] text-emerald-200/70">Terintegrasi untuk setiap peran</p>
                </div>
            </div>
        </div>
    </div>

    <!-- KANAN: FORM LOGIN -->
    <div class="md:col-span-7 p-8 md:p-10 flex flex-col justify-between bg-white">
        <div class="space-y-6">
            <div class="flex items-center justify-between">
                <span class="px-3 py-1 rounded-full bg-emerald-50 border border-emerald-100 text-[10px] font-bold text-emerald-800 uppercase tracking-wider">● AUTENTIKASI AKUN</span>
            </div>

            <div>
                <h2 class="text-2xl font-extrabold text-[#183c30]">Selamat Datang</h2>
                <p class="text-xs text-slate-500 mt-1">Masuk menggunakan NIP atau NIM yang telah terdaftar pada sistem SIPRAK.</p>
            </div>

            <!-- FORM LOGIN -->
            <form action="{{ route('login') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Nomor Induk (NIP / NIM) <span class="text-rose-500">*</span></label>
                    <div class="relative">
                        <input type="text" id="usernameInput" name="username" placeholder="Masukkan NIP atau NIM" class="field pl-10" required>
                        <span class="absolute left-3.5 top-3 text-slate-400 text-xs">💳</span>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Kata Sandi <span class="text-rose-500">*</span></label>
                    <div class="relative">
                        <input type="password" id="passwordInput" name="password" placeholder="Masukkan kata sandi" class="field pl-10" required>
                        <span class="absolute left-3.5 top-3 text-slate-400 text-xs">🔒</span>
                    </div>
                </div>

                <div class="flex items-center justify-between text-xs pt-1">
                    <label class="flex items-center gap-2 cursor-pointer text-slate-600 font-medium">
                        <input type="checkbox" class="rounded border-slate-300 text-emerald-700 focus:ring-emerald-600">
                        Ingat perangkat ini
                    </label>
                    <a href="#" class="text-emerald-700 font-semibold hover:underline">Butuh bantuan? Hubungi Admin</a>
                </div>

                <button type="submit" class="w-full py-3 bg-[#075c46] hover:bg-[#064b3b] text-white font-bold text-xs rounded-xl shadow-md hover:shadow-lg transition flex items-center justify-center gap-2">
                    Masuk ke Sistem →
                </button>
            </form>

            <!-- KARTU AKUN UJI COBA -->
            <div class="pt-4 border-t border-slate-100 space-y-3">
                <div class="flex justify-between items-center">
                    <h3 class="text-xs font-bold text-slate-800">Akun Uji Coba</h3>
                    <span class="text-[10px] text-slate-400">Khusus pengujian</span>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-4 gap-2">
                    <!-- Mahasiswa -->
                    <button type="button" onclick="fillLogin('2026110012', 'password')" class="p-2.5 rounded-xl border border-emerald-100 bg-emerald-50/40 hover:bg-emerald-100/60 transition text-center group">
                        <div class="w-6 h-6 rounded-lg bg-emerald-100 text-emerald-800 flex items-center justify-center mx-auto text-xs font-bold group-hover:scale-110 transition">🎓</div>
                        <p class="text-[11px] font-bold text-emerald-950 mt-1.5">Mahasiswa</p>
                    </button>

                    <!-- Dosen -->
                    <button type="button" onclick="fillLogin('198504122010122001', 'password')" class="p-2.5 rounded-xl border border-emerald-100 bg-emerald-50/40 hover:bg-emerald-100/60 transition text-center group">
                        <div class="w-6 h-6 rounded-lg bg-emerald-100 text-emerald-800 flex items-center justify-center mx-auto text-xs font-bold group-hover:scale-110 transition">🧑‍🏫</div>
                        <p class="text-[11px] font-bold text-emerald-950 mt-1.5">Dosen</p>
                    </button>

                    <!-- Asprak -->
                    <button type="button" onclick="fillLogin('2026119999', 'password')" class="p-2.5 rounded-xl border border-emerald-100 bg-emerald-50/40 hover:bg-emerald-100/60 transition text-center group">
                        <div class="w-6 h-6 rounded-lg bg-emerald-100 text-emerald-800 flex items-center justify-center mx-auto text-xs font-bold group-hover:scale-110 transition">👥</div>
                        <p class="text-[11px] font-bold text-emerald-950 mt-1.5">Asprak</p>
                    </button>

                    <!-- Admin Lab -->
                    <button type="button" onclick="fillLogin('admin', 'password')" class="p-2.5 rounded-xl border border-emerald-100 bg-emerald-50/40 hover:bg-emerald-100/60 transition text-center group">
                        <div class="w-6 h-6 rounded-lg bg-emerald-100 text-emerald-800 flex items-center justify-center mx-auto text-xs font-bold group-hover:scale-110 transition">⚙️</div>
                        <p class="text-[11px] font-bold text-emerald-950 mt-1.5">Admin Lab</p>
                    </button>
                </div>
            </div>
        </div>

        <footer class="pt-6 text-center text-[10px] text-slate-400">
            © {{ date('Y') }} SIPRAK · UIN Siber Syekh Nurjati Cirebon
        </footer>
    </div>
</div>

<script>
    function fillLogin(username, password) {
        document.getElementById('usernameInput').value = username;
        document.getElementById('passwordInput').value = password;
    }
</script>

</body>
</html>