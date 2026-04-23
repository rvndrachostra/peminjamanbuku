<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookHub - Sistem Peminjaman Buku Perpustakaan Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,400&family=Space+Grotesk:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: #f0f2f5;
            min-height: 100vh;
            color: #1a1d23;
        }

        /* ─── ANIMATIONS ─── */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes slideInLeft {
            from { opacity: 0; transform: translateX(-30px); }
            to   { opacity: 1; transform: translateX(0); }
        }
        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(30px); }
            to   { opacity: 1; transform: translateX(0); }
        }
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        /* ─── THEME COLORS ─── */
        :root {
            --primary: #14b87a;
            --primary-dark: #0d9d6a;
            --primary-light: #e6f7f0;
            --secondary: #f59e0b;
            --bg: #f0f2f5;
            --surface: #ffffff;
            --text: #1a1d23;
            --text-muted: #64748b;
            --border: #e2e8f0;
            --shadow: rgba(0,0,0,0.08);
        }

        /* ─── COMPONENTS ─── */
        .btn-primary {
            background: var(--primary);
            color: white;
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 600;
            font-family: 'DM Sans', sans-serif;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
            box-shadow: 0 8px 24px rgba(20,184,122,0.3);
        }

        .btn-secondary {
            background: var(--surface);
            color: var(--text);
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 600;
            font-family: 'DM Sans', sans-serif;
            transition: all 0.2s ease;
            border: 2px solid var(--border);
            cursor: pointer;
        }
        .btn-secondary:hover {
            border-color: var(--primary);
            color: var(--primary);
            transform: translateY(-1px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.08);
        }

        .card {
            background: var(--surface);
            border-radius: 16px;
            box-shadow: 0 4px 24px var(--shadow);
            border: 1px solid var(--border);
            transition: all 0.3s ease;
        }
        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 32px var(--shadow);
        }

        .feature-icon {
            width: 56px;
            height: 56px;
            background: var(--primary-light);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
        }
        .feature-icon svg {
            width: 24px;
            height: 24px;
            color: var(--primary);
        }

        .stat-card {
            background: var(--surface);
            padding: 24px;
            border-radius: 16px;
            text-align: center;
            border: 1px solid var(--border);
            transition: all 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px var(--shadow);
        }

        .nav-link {
            color: var(--text-muted);
            font-weight: 500;
            transition: color 0.2s ease;
            position: relative;
        }
        .nav-link:hover {
            color: var(--primary);
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary);
            transition: width 0.2s ease;
        }
        .nav-link:hover::after {
            width: 100%;
        }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 768px) {
            .hero-grid {
                grid-template-columns: 1fr;
                gap: 32px;
            }
            .hero-title {
                font-size: 2.5rem;
                line-height: 1.2;
            }
        }

        /* ─── TAMBAHAN AGAR TEKS CTA JELAS ─── */
        .gradient-bg {
            background: linear-gradient(135deg, #0a5c4b, #0b3b3f);
            /* gradien gelap untuk kontras dengan teks putih */
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="bg-white shadow-sm fixed w-full top-0 z-50 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-green-500 rounded-xl flex items-center justify-center shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <div>
                        <span class="text-2xl font-bold text-gray-900 font-['Space_Grotesk']">Book<span class="text-green-500">Hub</span></span>
                        <div class="text-xs text-green-500 font-medium tracking-wider uppercase">DIGITAL LIBRARY</div>
                    </div>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#beranda" class="nav-link">Beranda</a>
                    <a href="#fitur" class="nav-link">Fitur</a>
                    <a href="#tentang" class="nav-link">Tentang</a>
                    <a href="#kontak" class="nav-link">Kontak</a>
                </div>

                <!-- Auth Buttons -->
                <div class="flex items-center space-x-4">
                    <a href="{{ route('login') }}" class="hidden sm:block text-gray-600 hover:text-green-500 font-medium transition-colors px-4 py-2">Login</a>
                    <a href="{{ route('register') }}" class="btn-primary">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        Daftar Sekarang
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div id="beranda" class="pt-32 pb-24 px-4 sm:px-6 lg:px-8" style="background: var(--bg);">
        <div class="max-w-7xl mx-auto">
            <div class="hero-grid grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <!-- Left Content -->
                <div class="text-center lg:text-left" style="animation: slideInLeft 0.8s ease forwards;">
                    <div class="inline-block mb-6">
                        <span class="bg-green-50 text-green-700 px-4 py-2 rounded-full text-sm font-semibold border border-green-200">
                            🏆 Platform Terpercaya #1
                        </span>
                    </div>
                    <h1 class="hero-title text-5xl md:text-6xl lg:text-7xl font-black text-gray-900 mb-6 leading-tight font-['Space_Grotesk']">
                        Pinjam Buku
                        <span class="text-green-500">Online</span>
                        Jadi Mudah
                    </h1>
                    <p class="text-xl md:text-2xl text-gray-600 mb-10 leading-relaxed font-['DM_Sans']">
                        Platform peminjaman buku perpustakaan digital modern untuk kebutuhan membaca, belajar, dan penelitian. Praktis, aman, dan terpercaya.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="{{ route('login') }}" class="btn-primary text-lg font-bold">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                            </svg>
                            Login Sekarang
                        </a>
                        <a href="#fitur" class="btn-secondary text-lg font-bold">
                            Pelajari Lebih lanjut
                        </a>
                    </div>

                    <!-- Stats -->
                    <div class="grid grid-cols-3 gap-8 mt-16">
                        <div class="stat-card">
                            <div class="text-3xl font-black text-green-500 mb-2">10K+</div>
                            <div class="text-sm text-gray-600 font-medium">Koleksi Buku</div>
                        </div>
                        <div class="stat-card">
                            <div class="text-3xl font-black text-green-500 mb-2">5K+</div>
                            <div class="text-sm text-gray-600 font-medium">Pengguna Aktif</div>
                        </div>
                        <div class="stat-card">
                            <div class="text-3xl font-black text-green-500 mb-2">98%</div>
                            <div class="text-sm text-gray-600 font-medium">Kepuasan</div>
                        </div>
                    </div>
                </div>

                <!-- Right Image/Illustration -->
                <div class="relative" style="animation: slideInRight 0.8s ease forwards;">
                    <div class="card p-8">
                        <img src="https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=800&h=600&fit=crop" alt="Library Books" class="rounded-2xl w-full shadow-lg">

                        <!-- Floating Cards -->
                        <div class="absolute -top-6 -left-6 card p-5">
                            <div class="flex items-center space-x-3">
                                <div class="feature-icon">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-bold text-gray-900">Tersedia</div>
                                    <div class="text-sm text-gray-600">Koleksi Buku</div>
                                </div>
                            </div>
                        </div>

                        <div class="absolute -bottom-6 -right-6 card p-5">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-bold text-gray-900">9/5</div>
                                    <div class="text-sm text-gray-600">Support</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Role Cards Section -->
    <div class="py-24 px-4 sm:px-6 lg:px-8" style="background: var(--bg);">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-20">
                <span class="text-green-600 font-semibold text-sm uppercase tracking-wider">Untuk Siapa?</span>
                <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-4 mt-3 font-['Space_Grotesk']">Tiga Peran Utama</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto font-['DM_Sans']">Setiap peran memiliki akses dan fitur khusus yang disesuaikan</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Admin Card -->
                <div class="card p-8" style="animation: fadeInUp 0.6s ease forwards;">
                    <div class="feature-icon mb-6">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3 font-['Space_Grotesk']">Admin</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed font-['DM_Sans']">Kontrol penuh sistem, kelola pengguna, buku, kategori, dan pantau semua aktivitas peminjaman</p>
                    <ul class="space-y-3 text-sm text-gray-600">
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-3 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Manajemen User & Buku</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-3 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Dashboard Analytics Real-time</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-3 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            </svg>
                            <span>Log Aktivitas Lengkap</span>
                        </li>
                    </ul>
                </div>

                <!-- Petugas Card -->
                <div class="card p-8" style="animation: fadeInUp 0.8s ease forwards;">
                    <div class="feature-icon mb-6">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3 font-['Space_Grotesk']">Petugas</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed font-['DM_Sans']">Verifikasi peminjaman, monitor pengembalian buku, cek kondisi, dan buat laporan detail</p>
                    <ul class="space-y-3 text-sm text-gray-600">
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-3 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Approve Peminjaman Cepat</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-3 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Inspeksi Kondisi Buku</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-3 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Generate Laporan Otomatis</span>
                        </li>
                    </ul>
                </div>

                <!-- Peminjam Card -->
                <div class="card p-8" style="animation: fadeInUp 1s ease forwards;">
                    <div class="feature-icon mb-6">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3 font-['Space_Grotesk']">Peminjam</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed font-['DM_Sans']">Cari buku yang tersedia, ajukan peminjaman, dan kembalikan dengan mudah</p>
                    <ul class="space-y-3 text-sm text-gray-600">
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-3 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Browse Koleksi Buku</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-3 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Booking Online Instant</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-3 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Track Status Real-time</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div id="fitur" class="py-24 px-4 sm:px-6 lg:px-8 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-20">
                <span class="text-amber-600 font-semibold text-sm uppercase tracking-wider">Kenapa Kami?</span>
                <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-4 mt-3">Fitur Unggulan</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">Semua yang Anda butuhkan dalam satu platform perpustakaan digital terintegrasi</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Feature 1 -->
                <div class="glass-effect rounded-2xl p-6 feature-card border border-gray-100">
                    <div class="bg-amber-50 w-14 h-14 rounded-xl flex items-center justify-center mb-5 border border-amber-100">
                        <svg class="w-7 h-7 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <h4 class="font-bold text-gray-900 mb-2 text-lg">Katalog Buku Real-time</h4>
                    <p class="text-gray-600 text-sm leading-relaxed">Monitor ketersediaan buku secara langsung dengan update otomatis</p>
                </div>

                <!-- Feature 2 -->
                <div class="glass-effect rounded-2xl p-6 feature-card border border-gray-100">
                    <div class="bg-blue-50 w-14 h-14 rounded-xl flex items-center justify-center mb-5 border border-blue-100">
                        <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h4 class="font-bold text-gray-900 mb-2 text-lg">Approval Cepat</h4>
                    <p class="text-gray-600 text-sm leading-relaxed">Sistem persetujuan otomatis dengan notifikasi instant ke email dan SMS</p>
                </div>

                <!-- Feature 3 -->
                <div class="glass-effect rounded-2xl p-6 feature-card border border-gray-100">
                    <div class="bg-violet-50 w-14 h-14 rounded-xl flex items-center justify-center mb-5 border border-violet-100">
                        <svg class="w-7 h-7 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h4 class="font-bold text-gray-900 mb-2 text-lg">Laporan Detail</h4>
                    <p class="text-gray-600 text-sm leading-relaxed">Generate laporan lengkap dengan statistik dan analytics mendalam</p>
                </div>

                <!-- Feature 4 -->
                <div class="glass-effect rounded-2xl p-6 feature-card border border-gray-100">
                    <div class="bg-amber-50 w-14 h-14 rounded-xl flex items-center justify-center mb-5 border border-amber-100">
                        <svg class="w-7 h-7 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <h4 class="font-bold text-gray-900 mb-2 text-lg">Keamanan Tinggi</h4>
                    <p class="text-gray-600 text-sm leading-relaxed">Data terenkripsi end-to-end dengan log aktivitas lengkap</p>
                </div>

                <!-- Feature 5 -->
                <div class="glass-effect rounded-2xl p-6 feature-card border border-gray-100">
                    <div class="bg-rose-50 w-14 h-14 rounded-xl flex items-center justify-center mb-5 border border-rose-100">
                        <svg class="w-7 h-7 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                    </div>
                    <h4 class="font-bold text-gray-900 mb-2 text-lg">Notifikasi Pintar</h4>
                    <p class="text-gray-600 text-sm leading-relaxed">Reminder otomatis untuk jadwal pengembalian dan pembaruan</p>
                </div>

                <!-- Feature 6 -->
                <div class="glass-effect rounded-2xl p-6 feature-card border border-gray-100">
                    <div class="bg-emerald-50 w-14 h-14 rounded-xl flex items-center justify-center mb-5 border border-indigo-100">
                        <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h4 class="font-bold text-gray-900 mb-2 text-lg">Riwayat Lengkap</h4>
                    <p class="text-gray-600 text-sm leading-relaxed">Track semua transaksi peminjaman dengan detail history</p>
                </div>

                <!-- Feature 7 -->
                <div class="glass-effect rounded-2xl p-6 feature-card border border-gray-100">
                    <div class="bg-cyan-50 w-14 h-14 rounded-xl flex items-center justify-center mb-5 border border-cyan-100">
                        <svg class="w-7 h-7 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                    </div>
                    <h4 class="font-bold text-gray-900 mb-2 text-lg">Multi Payment</h4>
                    <p class="text-gray-600 text-sm leading-relaxed">Berbagai metode pembayaran digital tersedia dan aman</p>
                </div>

                <!-- Feature 8 -->
                <div class="glass-effect rounded-2xl p-6 feature-card border border-gray-100">
                    <div class="bg-teal-50 w-14 h-14 rounded-xl flex items-center justify-center mb-5 border border-teal-100">
                        <svg class="w-7 h-7 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <h4 class="font-bold text-gray-900 mb-2 text-lg">Support 9/5</h4>
                    <p class="text-gray-600 text-sm leading-relaxed">Tim support profesional siap membantu kapan saja</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Categories Section -->
    <div id="tentang" class="py-24 px-4 sm:px-6 lg:px-8 bg-linear-to-br from-emerald-50 via-white to-sky-50">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-20">
                <span class="text-amber-600 font-semibold text-sm uppercase tracking-wider">Koleksi Lengkap</span>
                <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-4 mt-3">Kategori Buku</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">Berbagai pilihan buku untuk semua kebutuhan Anda</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <!-- Category 1 -->
                <div class="glass-effect rounded-2xl p-6 text-center hover-lift cursor-pointer border border-gray-100">
                    <div class="bg-linear-to-br from-orange-500 to-red-500 w-16 h-16 rounded-2xl flex items-center justify-center mb-4 mx-auto shadow-lg">
                        <span class="text-3xl">⚽</span>
                    </div>
                    <h4 class="font-bold text-gray-900">Fiksi</h4>
                    <p class="text-sm text-gray-600 mt-1">Novel, Cerita Pendek</p>
                </div>

                <!-- Category 2 -->
                <div class="glass-effect rounded-2xl p-6 text-center hover-lift cursor-pointer border border-gray-100">
                    <div class="bg-linear-to-br from-blue-500 to-cyan-500 w-16 h-16 rounded-2xl flex items-center justify-center mb-4 mx-auto shadow-lg">
                        <span class="text-3xl">🏸</span>
                    </div>
                    <h4 class="font-bold text-gray-900">Non-Fiksi</h4>
                    <p class="text-sm text-gray-600 mt-1">Biografi, Sejarah</p>
                </div>

                <!-- Category 3 -->
                <div class="glass-effect rounded-2xl p-6 text-center hover-lift cursor-pointer border border-gray-100">
                    <div class="bg-linear-to-br from-green-500 to-pink-500 w-16 h-16 rounded-2xl flex items-center justify-center mb-4 mx-auto shadow-lg">
                        <span class="text-3xl">🏋️</span>
                    </div>
                    <h4 class="font-bold text-gray-900">Pendidikan</h4>
                    <p class="text-sm text-gray-600 mt-1">Pelajaran, Referensi</p>
                </div>

                <!-- Category 4 -->
                <div class="glass-effect rounded-2xl p-6 text-center hover-lift cursor-pointer border border-gray-100">
                    <div class="bg-linear-to-br from-green-500 to-emerald-500 w-16 h-16 rounded-2xl flex items-center justify-center mb-4 mx-auto shadow-lg">
                        <span class="text-3xl">⛳</span>
                    </div>
                    <h4 class="font-bold text-gray-900">Teknologi</h4>
                    <p class="text-sm text-gray-600 mt-1">Programming, IT</p>
                </div>

                <!-- Category 5 -->
                <div class="glass-effect rounded-2xl p-6 text-center hover-lift cursor-pointer border border-gray-100">
                    <div class="bg-linear-to-br from-yellow-500 to-orange-500 w-16 h-16 rounded-2xl flex items-center justify-center mb-4 mx-auto shadow-lg">
                        <span class="text-3xl">🏊</span>
                    </div>
                    <h4 class="font-bold text-gray-900">Sains</h4>
                    <p class="text-sm text-gray-600 mt-1">Fisika, Kimia, Biologi</p>
                </div>

                <!-- Category 6 -->
                <div class="glass-effect rounded-2xl p-6 text-center hover-lift cursor-pointer border border-gray-100">
                    <div class="bg-linear-to-br from-indigo-500 to-blue-500 w-16 h-16 rounded-2xl flex items-center justify-center mb-4 mx-auto shadow-lg">
                        <span class="text-3xl">🥊</span>
                    </div>
                    <h4 class="font-bold text-gray-900">Seni</h4>
                    <p class="text-sm text-gray-600 mt-1">Musik, Lukis, Fotografi</p>
                </div>

                <!-- Category 7 -->
                <div class="glass-effect rounded-2xl p-6 text-center hover-lift cursor-pointer border border-gray-100">
                    <div class="bg-linear-to-br from-rose-500 to-pink-500 w-16 h-16 rounded-2xl flex items-center justify-center mb-4 mx-auto shadow-lg">
                        <span class="text-3xl">🏃</span>
                    </div>
                    <h4 class="font-bold text-gray-900">Motivasi</h4>
                    <p class="text-sm text-gray-600 mt-1">Inspirasi, Sukses</p>
                </div>

                <!-- Category 8 -->
                <div class="glass-effect rounded-2xl p-6 text-center hover-lift cursor-pointer border border-gray-100">
                    <div class="bg-gradient-to-br from-teal-500 to-cyan-500 w-16 h-16 rounded-2xl flex items-center justify-center mb-4 mx-auto shadow-lg">
                        <span class="text-3xl">🚴</span>
                    </div>
                    <h4 class="font-bold text-gray-900">Bahasa</h4>
                    <p class="text-sm text-gray-600 mt-1">Inggris, Indonesia</p>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="py-24 px-4 sm:px-6 lg:px-8 bg-white">
        <div class="max-w-5xl mx-auto">
            <div class="gradient-bg rounded-3xl shadow-2xl p-12 md:p-16 text-center text-white overflow-hidden relative">
                <div class="absolute top-0 right-0 opacity-10 transform rotate-12">
                    <svg class="w-72 h-72" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="relative z-10">
                    <span class="bg-white bg-opacity-20 text-white px-4 py-2 rounded-full text-sm font-semibold inline-block mb-4">
                        🚀 Mulai Sekarang
                    </span>
                    <h2 class="text-4xl md:text-5xl font-black mb-6">Siap Memulai?</h2>
                    <p class="text-xl text-emerald-50 mb-10 max-w-2xl mx-auto leading-relaxed">
                        Bergabunglah dengan siswa berprestasi menjadi pembaca dan pencari ilmu untuk kebutuhan peminjaman buku mereka
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('login') }}" class="bg-transparent border-2 border-white text-white px-12 py-4 rounded-xl hover:bg-white hover:text-amber-600 transition-all font-bold text-lg shadow-xl">
                            Login Sekarang
                        </a>
                        <a href="{{ route('register') }}" class="bg-transparent border-2 border-white text-white px-12 py-4 rounded-xl hover:bg-white hover:text-amber-600 transition-all font-bold text-lg shadow-xl">
                            Daftar Gratis
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer id="kontak" class="bg-gray-900 text-white py-16 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <!-- Company Info -->
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="gradient-bg p-2.5 rounded-xl shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <span class="text-xl font-bold">Book<span class="text-green-500">Hub</span></span>
                    </div>
                    <p class="text-gray-400 mb-6 leading-relaxed max-w-md">
                      Platform peminjaman buku perpustakaan terpercaya untuk kebutuhan siswa membaca, belajar, dan penelitian. Mudah, aman, dan profesional.
                    </p>
                    <div class="flex space-x-3">
                        <a href="#" class="bg-gray-800 p-3 rounded-xl hover:bg-gray-700 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        <a href="#" class="bg-gray-800 p-3 rounded-xl hover:bg-gray-700 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                            </svg>
                        </a>
                        <a href="#" class="bg-gray-800 p-3 rounded-xl hover:bg-gray-700 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/>
                            </svg>
                        </a>
                        <a href="#" class="bg-gray-800 p-3 rounded-xl hover:bg-gray-700 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="font-bold mb-6 text-lg">Quick Links</h4>
                    <ul class="space-y-3 text-gray-400">
                        <li><a href="#" class="hover:text-emerald-400 transition-colors">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-emerald-400 transition-colors">Cara Kerja</a></li>
                        <li><a href="#" class="hover:text-emerald-400 transition-colors">Syarat & Ketentuan</a></li>
                        <li><a href="#" class="hover:text-emerald-400 transition-colors">Kebijakan Privasi</a></li>
                        <li><a href="#" class="hover:text-emerald-400 transition-colors">FAQ</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h4 class="font-bold mb-6 text-lg">Hubungi Kami</h4>
                    <ul class="space-y-3 text-gray-400">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 mr-2 mt-0.5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            BookHub@smk.belajar.id
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 mr-2 mt-0.5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            0896-1829-7321
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 mr-2 mt-0.5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            SMKN 1 Ciomas
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 mr-2 mt-0.5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Senin - Jumat: 07:00 - 16:00
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center text-center md:text-left">
                <p class="text-gray-400 mb-4 md:mb-0">© 2026 BookHub. Semua hak dilindungi undang-undang Perpustakaan.</p>
                <p class="text-gray-500 text-sm">Dibuat dengan <span class="text-red-500">❤️</span> untuk kemudahan peminjaman Buku</p>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button -->
    <button id="scrollTop" class="fixed bottom-8 right-8 bg-emerald-600 text-white p-4 rounded-full shadow-2xl hover:bg-emerald-700 transition-all opacity-0 pointer-events-none z-50">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
        </svg>
    </button>

    <script>
        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Scroll to top button
        const scrollTopBtn = document.getElementById('scrollTop');
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                scrollTopBtn.classList.remove('opacity-0', 'pointer-events-none');
            } else {
                scrollTopBtn.classList.add('opacity-0', 'pointer-events-none');
            }
        });

        scrollTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Add animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.feature-card, .hover-lift').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(el);
        });
    </script>
</body>
</html>