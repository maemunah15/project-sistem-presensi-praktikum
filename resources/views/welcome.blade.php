<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SIPRAK - Presensi Praktikum UIN Siber Syekh Nurjati Cirebon</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* Animasi masuk */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(12px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* HP melayang dengan rotasi halus */
        @keyframes phoneFloatTilt {
            0%, 100% {
                transform: translateY(0) rotate(-4deg);
            }
            50% {
                transform: translateY(-6px) rotate(-2deg);
            }
        }

        /* Gradient di belakang HP */
        @keyframes pulseGradient {
            0%, 100% {
                transform: scale(1);
                opacity: 0.75;
            }
            50% {
                transform: scale(1.07);
                opacity: 1;
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.8s ease-out both;
        }

        .animate-phone-tilt {
            animation: phoneFloatTilt 4.5s ease-in-out infinite;
        }

        .animate-gradient-glow {
            animation: pulseGradient 4s ease-in-out infinite;
        }

        .hero-gradient {
            background:
                radial-gradient(
                    ellipse at 80% 25%,
                    rgba(167, 243, 208, 0.22),
                    transparent 36%
                ),
                radial-gradient(
                    ellipse at 10% 90%,
                    rgba(204, 251, 241, 0.28),
                    transparent 35%
                ),
                #f8fafc;
        }

        /* Hormati preferensi pengurangan animasi */
        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                scroll-behavior: auto !important;
            }
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-800 min-h-screen flex flex-col selection:bg-emerald-500 selection:text-white">

    <!-- ================= NAVBAR ================= -->
    <nav class="bg-white/90 backdrop-blur-md border-b border-slate-200/80 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">

                <div class="flex items-center gap-3 sm:gap-4">

                    <img
                        src="{{ asset('image/Logo-UINSSC.png') }}"
                        alt="Logo UIN Siber Syekh Nurjati Cirebon"
                        class="h-11 w-auto object-contain"
                        onerror="this.onerror=null; this.src='https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Logo_UIN_Siber_Syekh_Nurjati_Cirebon.png/600px-Logo_UIN_Siber_Syekh_Nurjati_Cirebon.png';"
                    >

                    <div>
                        <span class="font-black text-xl tracking-tight text-emerald-900 block leading-tight">
                            SIPRAK
                        </span>
                        <span class="text-[11px] font-semibold text-emerald-700 tracking-wide block">
                            Sistem Presensi Praktikum
                        </span>
                    </div>

                    <div class="h-8 w-px bg-slate-200 hidden sm:block"></div>

                    <div class="hidden sm:block">
                        <span class="text-sm font-bold text-slate-700 tracking-tight">
                            UIN Siber Syekh Nurjati Cirebon
                        </span>
                    </div>

                </div>

            </div>
        </div>
    </nav>


    <!-- ================= HERO SECTION ================= -->
    <main class="flex-1 flex items-center relative overflow-hidden hero-gradient py-12 md:py-16">

        <!-- Background decoration -->
        <div class="absolute top-10 right-10 w-96 h-96 bg-emerald-100/40 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-10 left-10 w-80 h-80 bg-teal-100/40 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full relative z-10">

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center">

                <!-- KOLOM KIRI: HERO TEXT -->
                <div class="lg:col-span-7 space-y-6 text-center lg:text-left animate-fade-in">

                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-emerald-100/70 text-emerald-800 text-xs font-bold shadow-sm border border-emerald-200/60">
                        <span class="text-base">🎓</span>
                        <span>Sistem Presensi Praktikum</span>
                    </div>

                    <h1 class="text-6xl sm:text-7xl lg:text-8xl font-black tracking-tight leading-none text-transparent bg-clip-text bg-gradient-to-r from-emerald-900 via-emerald-800 to-teal-800">
                        SIPRAK
                    </h1>

                    <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold leading-snug tracking-tight text-emerald-950 max-w-2xl mx-auto lg:mx-0">
                        Presensi QR Code Otomatis untuk Praktikum yang Lebih Tertib dan Efisien.
                    </h2>

                    <p class="text-slate-500 text-sm sm:text-base leading-relaxed max-w-2xl mx-auto lg:mx-0">
                        Sistem presensi praktikum berbasis QR Code yang dirancang untuk memudahkan mahasiswa, dosen, asisten praktikum, dan admin dalam mengelola kehadiran praktikum secara digital, cepat, dan akurat.
                    </p>

                    <div class="pt-2 flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">

                        <a
                            href="{{ route('login') }}"
                            class="w-full sm:w-auto px-7 py-3.5 bg-emerald-800 hover:bg-emerald-900 text-white font-bold text-sm rounded-2xl shadow-md hover:shadow-lg transition duration-200 flex items-center justify-center gap-2.5"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4M10 17l5-5-5-5m5 5H3"/>
                            </svg>
                            <span>Masuk Sistem</span>
                        </a>

                    </div>
                </div>


                <!-- KOLOM KANAN: MOCKUP SIPRAK -->
                <div class="lg:col-span-5 flex justify-center items-center">

                    <!-- FRAME UTAMA -->
                    <div class="relative isolate w-full max-w-[460px] rounded-[2rem] bg-white/95 p-5 sm:p-6 shadow-[0_25px_60px_rgba(15,50,40,0.12)] border border-slate-200/80 backdrop-blur-md">

                        <!-- HEADER WINDOW -->
                        <div class="relative z-20 flex items-center justify-between pb-4 border-b border-slate-100">

                            <div class="flex items-center gap-1.5">
                                <span class="w-3 h-3 rounded-full bg-rose-400"></span>
                                <span class="w-3 h-3 rounded-full bg-amber-400"></span>
                                <span class="w-3 h-3 rounded-full bg-emerald-400"></span>
                            </div>

                            <span class="text-[10px] font-extrabold font-mono text-slate-400 tracking-wider">
                                SIPRAK-ENGINE V1.0
                            </span>

                        </div>


                        <!-- AREA VISUAL HP -->
                        <div class="relative isolate flex flex-col items-center justify-center min-h-[290px] py-5">

                            <!-- Gradient utama di belakang HP -->
                            <div class="absolute z-0 w-52 h-52 sm:w-60 sm:h-60 rounded-full bg-gradient-to-br from-emerald-200/80 via-emerald-100/70 to-teal-100/40 blur-[2px] animate-gradient-glow"></div>

                            <!-- Glow lembut -->
                            <div class="absolute z-0 w-44 h-44 rounded-full bg-gradient-to-tr from-emerald-300/30 via-teal-200/30 to-white/20 blur-2xl"></div>

                            <!-- Orbit -->
                            <div class="absolute z-0 w-60 h-40 rounded-[50%] border border-emerald-300/40 -rotate-[24deg]"></div>

                            <!-- Titik dekoratif -->
                            <div class="absolute z-0 left-[23%] top-[34%] w-2.5 h-2.5 rounded-full bg-emerald-400/80 ring-2 ring-emerald-100/70"></div>

                            <div class="absolute z-0 right-[22%] bottom-[28%] w-3 h-3 rounded-full bg-emerald-400/70 ring-2 ring-emerald-100/70"></div>


                            <!-- SMARTPHONE -->
                            <div class="animate-phone-tilt relative z-10">

                                <!-- Bodi HP -->
                                <div class="relative w-[145px] sm:w-[155px] rounded-[2rem] p-[5px] bg-gradient-to-br from-slate-500 via-slate-900 to-black border border-slate-600/80 shadow-[0_18px_35px_rgba(15,50,40,0.25)] ring-1 ring-black/20">

                                    <!-- Tombol fisik -->
                                    <div class="absolute -left-[3px] top-12 w-[3px] h-5 rounded-l bg-slate-600"></div>
                                    <div class="absolute -right-[3px] top-16 w-[3px] h-8 rounded-r bg-slate-600"></div>

                                    <!-- LAYAR HP -->
                                    <div class="relative overflow-hidden rounded-[1.6rem] bg-white px-2.5 pt-2 pb-3">

                                        <!-- Status bar -->
                                        <div class="flex items-center justify-between px-1 mb-2 text-[7px] font-extrabold text-slate-800">
                                            <span>9:41</span>

                                            <div class="flex items-center gap-1">
                                                <svg class="w-3 h-3" viewBox="0 0 24 24" fill="currentColor">
                                                    <path d="M2 8.8C7.5 3.5 16.5 3.5 22 8.8l-10 12z"/>
                                                </svg>
                                                <svg class="w-3 h-3" viewBox="0 0 24 24" fill="currentColor">
                                                    <rect x="3" y="6" width="18" height="12" rx="2"/>
                                                </svg>
                                            </div>
                                        </div>

                                        <!-- Dynamic Island -->
                                        <div class="absolute top-[5px] left-1/2 -translate-x-1/2 w-10 h-[10px] rounded-full bg-black"></div>


                                        <!-- IKON CENTANG BERTINGKAT -->
                                        <div class="relative flex items-center justify-center w-[66px] h-[66px] mx-auto mt-3 mb-2 rounded-full bg-emerald-50">

                                            <div class="absolute inset-[6px] rounded-full bg-emerald-100"></div>

                                            <div class="relative flex items-center justify-center w-[43px] h-[43px] rounded-full bg-gradient-to-br from-emerald-300 via-emerald-500 to-emerald-700 shadow-[0_5px_14px_rgba(16,185,129,0.3)] ring-2 ring-white/80">

                                                <svg class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" aria-label="Presensi berhasil">
                                                    <path d="m5 12 4.5 4.5L19 7"/>
                                                </svg>

                                            </div>
                                        </div>


                                        <h3 class="text-center font-extrabold text-slate-900 text-[10px] mb-3">
                                            Presensi Berhasil
                                        </h3>


                                        <!-- INFORMASI PRESENSI -->
                                        <div class="rounded-lg bg-slate-50 border border-slate-100 p-2 space-y-2 text-left text-[7px]">

                                            <div class="flex items-center gap-1.5 text-emerald-900 font-bold">
                                                <svg class="w-3 h-3 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path d="M4 5.5A2.5 2.5 0 0 1 6.5 3H20v16H6.5A2.5 2.5 0 0 0 4 21z"/>
                                                    <path d="M4 5.5v13"/>
                                                </svg>
                                                <span class="truncate">Praktikum Pemrograman</span>
                                            </div>

                                            <div class="flex items-center gap-1.5 text-slate-600 font-semibold">
                                                <svg class="w-3 h-3 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <circle cx="9" cy="8" r="3"/>
                                                    <path d="M3 20v-2a6 6 0 0 1 12 0v2"/>
                                                    <path d="M16 5a3 3 0 0 1 0 6m2 3a5 5 0 0 1 3 4.5V20"/>
                                                </svg>
                                                <span>Kelas A</span>
                                            </div>

                                            <div class="flex items-center gap-1.5 pt-1.5 border-t border-slate-200/80 text-slate-500 font-medium">
                                                <svg class="w-3 h-3 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <circle cx="12" cy="12" r="9"/>
                                                    <path d="M12 7v5l3 2"/>
                                                </svg>
                                                <span>14 Apr 2026 · 08:45 WIB</span>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- AKHIR SMARTPHONE -->

                        </div>


                        <!-- BADGE DAN JUDUL -->
                        <div class="relative z-20 text-center space-y-1">

                            <div class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-gradient-to-r from-emerald-700 to-emerald-800 text-white text-[11px] font-bold shadow-md shadow-emerald-800/20">

                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m5 12 4.5 4.5L19 7"/>
                                </svg>

                                <span>Presensi Terkonfirmasi</span>
                            </div>

                            <h2 class="text-lg sm:text-xl font-black text-emerald-950 tracking-tight pt-2">
                                Presensi Digital Terintegrasi
                            </h2>

                            <p class="text-slate-500 text-xs font-medium">
                                Cepat, tertib, dan tercatat otomatis.
                            </p>

                        </div>


                        <!-- STATUS PRESENSI -->
                        <div class="relative z-20 mt-5 px-4 py-3.5 rounded-2xl border border-slate-100 bg-slate-50/90 flex justify-between items-center gap-3 text-[11px] sm:text-xs font-bold">

                            <span class="text-slate-500">
                                Status Presensi
                            </span>

                            <span class="text-emerald-700 flex items-center gap-1.5 font-extrabold whitespace-nowrap">
                                <span class="w-2 h-2 rounded-full bg-emerald-600 animate-pulse"></span>
                                Terverifikasi
                            </span>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </main>


    <!-- ================= FOOTER ================= -->
    <footer class="relative z-10 bg-white border-t border-slate-200/80 py-6">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-4 text-xs font-semibold text-slate-500">

            <div class="text-center md:text-left">
                <p class="text-slate-800 font-bold">
                    UIN Siber Syekh Nurjati Cirebon
                </p>

                <p class="text-slate-500 font-normal mt-1">
                    Jl. Perjuangan, Sunyaragi, Kec. Kesambi, Kota Cirebon, Jawa Barat 45132
                </p>
            </div>

            <div class="text-center md:text-right">
                <p>
                    &copy; {{ date('Y') }} SIPRAK - Laboratorium Komputer. All rights reserved.
                </p>
            </div>

        </div>
    </footer>

</body>
</html>