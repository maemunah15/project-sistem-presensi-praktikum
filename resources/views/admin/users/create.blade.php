<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User Baru - Admin Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-slate-100 min-h-screen text-slate-800 flex items-center justify-center p-4">

    <div class="bg-white w-full max-w-xl rounded-2xl shadow-xl border border-slate-200/80 overflow-hidden">
        <div class="bg-slate-900 text-white p-6 flex justify-between items-center">
            <div>
                <h2 class="text-base font-bold">Tambah Pengguna Baru</h2>
                <p class="text-xs text-slate-400 mt-0.5">Isi formulir berikut untuk mendaftarkan akun baru.</p>
            </div>
            <a href="{{ route('admin.users.index') }}" class="text-xs text-slate-300 hover:text-white font-bold">← Batal</a>
        </div>

        <form action="{{ route('admin.users.store') }}" method="POST" class="p-6 space-y-4">
            @csrf

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Nama Lengkap</label>
                <input type="text" name="nama" value="{{ old('nama') }}" required placeholder="Contoh: Ahmad Subagja"
                       class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold focus:outline-none focus:border-emerald-500">
                @error('nama') <span class="text-[11px] text-rose-600 font-bold mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">NIP / NIM</label>
                <input type="text" name="nip_nim" value="{{ old('nip_nim') }}" required placeholder="Contoh: 1227050001"
                       class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold focus:outline-none focus:border-emerald-500 font-mono">
                @error('nip_nim') <span class="text-[11px] text-rose-600 font-bold mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Alamat Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required placeholder="Contoh: user@uin.ac.id"
                       class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold focus:outline-none focus:border-emerald-500">
                @error('email') <span class="text-[11px] text-rose-600 font-bold mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Role / Peran</label>
                <select name="role" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold focus:outline-none focus:border-emerald-500">
                    <option value="">-- Pilih Role --</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrator</option>
                    <option value="dosen" {{ old('role') == 'dosen' ? 'selected' : '' }}>Dosen Pengampu</option>
                    <option value="asprak" {{ old('role') == 'asprak' ? 'selected' : '' }}>Asisten Praktikum (Asprak)</option>
                    <option value="mahasiswa" {{ old('role') == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                </select>
                @error('role') <span class="text-[11px] text-rose-600 font-bold mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Password</label>
                <input type="password" name="password" required placeholder="Minimal 6 Karakter"
                       class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold focus:outline-none focus:border-emerald-500">
                @error('password') <span class="text-[11px] text-rose-600 font-bold mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div class="pt-4 flex justify-end gap-3 border-t border-slate-100">
                <a href="{{ route('admin.users.index') }}" class="px-4 py-2.5 bg-slate-100 text-slate-700 font-bold text-xs rounded-xl hover:bg-slate-200 transition">Batal</a>
                <button type="submit" class="px-5 py-2.5 bg-emerald-600 text-white font-bold text-xs rounded-xl hover:bg-emerald-700 transition shadow-md shadow-emerald-600/20">Simpan User</button>
            </div>
        </form>
    </div>

</body>
</html>