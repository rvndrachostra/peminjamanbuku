<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Book Hub')</title>
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

        /* ─── SIDEBAR VARIABLES ─── */
        :root {
            --sb-bg: #0d1c17;
            --sb-surface: rgba(255,255,255,0.045);
            --sb-hover: rgba(20,184,120,0.12);
            --sb-active-bg: rgba(20,184,120,0.16);
            --sb-active-border: #14b87a;
            --sb-text: rgba(255,255,255,0.72);
            --sb-muted: rgba(255,255,255,0.32);
            --sb-accent: #14b87a;
            --sb-accent2: #f59e0b;
            --sb-border: rgba(255,255,255,0.07);
            --sb-width: 240px;
        }

        /* ─── ANIMATIONS ─── */
        @keyframes fadeInLeft {
            from { opacity: 0; transform: translateX(-12px); }
            to   { opacity: 1; transform: translateX(0); }
        }
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-8px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes pulseDot {
            0%, 100% { opacity: 1; box-shadow: 0 0 0 0 rgba(20,184,120,0.5); }
            50%       { opacity: 0.7; box-shadow: 0 0 0 4px rgba(20,184,120,0); }
        }
        @keyframes scanLine {
            0%   { transform: translateY(-100%); }
            100% { transform: translateY(600%); }
        }
        @keyframes slideInUp {
            from { opacity: 0; transform: translateY(10px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ─── SIDEBAR ─── */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: var(--sb-width);
            height: 100%;
            background: var(--sb-bg);
            display: flex;
            flex-direction: column;
            overflow: hidden;
            z-index: 50;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 4px 0 24px rgba(0,0,0,0.25);
        }

        /* subtle dot-grid background */
        .sidebar::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: radial-gradient(circle, rgba(20,184,120,0.07) 1px, transparent 1px);
            background-size: 22px 22px;
            pointer-events: none;
        }

        /* top accent line */
        .sidebar::after {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--sb-accent), transparent);
        }

        /* animated scan line */
        .sidebar-scan {
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 80px;
            background: linear-gradient(180deg, rgba(20,184,120,0.07), transparent);
            pointer-events: none;
            animation: scanLine 8s linear infinite;
            z-index: 0;
        }

        .sidebar-inner {
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            height: 100%;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: rgba(20,184,120,0.3) transparent;
        }
        .sidebar-inner::-webkit-scrollbar { width: 4px; }
        .sidebar-inner::-webkit-scrollbar-thumb { background: rgba(20,184,120,0.3); border-radius: 4px; }

        /* ─── LOGO ─── */
        .sidebar-logo {
            padding: 20px 16px 16px;
            border-bottom: 1px solid var(--sb-border);
            flex-shrink: 0;
            animation: fadeInDown 0.5s ease forwards;
        }
        .logo-row {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .logo-icon {
            width: 36px;
            height: 36px;
            background: var(--sb-accent);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            position: relative;
            overflow: hidden;
        }
        .logo-icon::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.18), transparent 60%);
        }
        .logo-icon svg {
            width: 18px;
            height: 18px;
            stroke: #fff;
            fill: none;
            stroke-width: 1.75;
            stroke-linecap: round;
            stroke-linejoin: round;
            position: relative;
            z-index: 1;
        }
        .logo-text {
            flex: 1;
        }
        .logo-text h1 {
            font-size: 15px;
            font-weight: 600;
            color: #fff;
            letter-spacing: 0.2px;
            font-family: 'Space Grotesk', sans-serif;
        }
        .logo-text span {
            display: block;
            font-size: 9.5px;
            color: var(--sb-accent);
            letter-spacing: 1.8px;
            text-transform: uppercase;
            margin-top: 1px;
        }
        .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--sb-accent);
            animation: pulseDot 2.5s ease infinite;
            flex-shrink: 0;
        }

        /* ─── SECTION LABEL ─── */
        .nav-section {
            padding: 18px 16px 6px;
        }
        .nav-section-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 9.5px;
            font-weight: 500;
            color: var(--sb-muted);
            letter-spacing: 1.8px;
            text-transform: uppercase;
        }
        .nav-section-label::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--sb-border);
        }

        /* ─── NAV ITEMS ─── */
        .nav-list {
            padding: 4px 10px;
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 10px;
            border-radius: 9px;
            text-decoration: none;
            font-size: 13px;
            color: var(--sb-text);
            border: 1px solid transparent;
            position: relative;
            transition: background 0.2s ease, color 0.2s ease, border-color 0.2s ease, transform 0.15s ease;
            opacity: 0;
            animation: fadeInLeft 0.4s ease forwards;
            cursor: pointer;
        }
        .nav-link:nth-child(1) { animation-delay: 0.12s; }
        .nav-link:nth-child(2) { animation-delay: 0.18s; }
        .nav-link:nth-child(3) { animation-delay: 0.24s; }
        .nav-link:nth-child(4) { animation-delay: 0.30s; }
        .nav-link:nth-child(5) { animation-delay: 0.36s; }
        .nav-link:nth-child(6) { animation-delay: 0.42s; }

        .nav-link:hover {
            background: var(--sb-hover);
            color: #fff;
            border-color: rgba(20,184,120,0.18);
            transform: translateX(2px);
        }
        .nav-link:hover .nav-icon-wrap {
            background: rgba(20,184,120,0.18);
        }

        .nav-link.active {
            background: var(--sb-active-bg);
            color: var(--sb-accent);
            border-color: rgba(20,184,120,0.28);
            font-weight: 500;
        }
        .nav-link.active::before {
            content: '';
            position: absolute;
            left: -1px;
            top: 20%;
            bottom: 20%;
            width: 2.5px;
            background: var(--sb-accent);
            border-radius: 0 3px 3px 0;
        }
        .nav-link.active .nav-icon-wrap {
            background: rgba(20,184,120,0.22);
            color: var(--sb-accent);
        }

        /* icon wrap */
        .nav-icon-wrap {
            width: 28px;
            height: 28px;
            border-radius: 7px;
            background: rgba(255,255,255,0.06);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: background 0.2s;
        }
        .nav-icon-wrap svg {
            width: 14px;
            height: 14px;
            stroke: currentColor;
            fill: none;
            stroke-width: 1.75;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .nav-label { flex: 1; white-space: nowrap; }

        .nav-badge {
            font-size: 10px;
            background: var(--sb-accent);
            color: #fff;
            border-radius: 20px;
            padding: 1px 7px;
            font-weight: 600;
            min-width: 20px;
            text-align: center;
        }
        .nav-badge.warning { background: var(--sb-accent2); }

        /* ─── DIVIDER ─── */
        .sidebar-divider {
            height: 1px;
            background: var(--sb-border);
            margin: 10px 16px;
            flex-shrink: 0;
        }

        /* ─── USER SECTION ─── */
        .sidebar-user-section {
            padding: 0 10px 6px;
            margin-top: auto;
            flex-shrink: 0;
        }
        .sidebar-user {
            padding: 10px;
            border-radius: 10px;
            background: rgba(255,255,255,0.045);
            border: 1px solid var(--sb-border);
            display: flex;
            align-items: center;
            gap: 10px;
            transition: background 0.2s;
            animation: fadeInLeft 0.5s ease 0.5s forwards;
            opacity: 0;
        }
        .sidebar-user:hover { background: rgba(255,255,255,0.07); }

        .user-avatar {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            background: linear-gradient(135deg, var(--sb-accent), #0d9488);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 600;
            color: #fff;
            flex-shrink: 0;
        }
        .user-avatar img {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            object-fit: cover;
        }
        .user-info { flex: 1; min-width: 0; }
        .user-name {
            font-size: 12px;
            font-weight: 500;
            color: #fff;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .user-role {
            font-size: 10px;
            color: var(--sb-muted);
            margin-top: 1px;
        }
        .user-logout-btn {
            width: 28px;
            height: 28px;
            border-radius: 7px;
            background: rgba(239,68,68,0.14);
            border: 1px solid rgba(239,68,68,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background 0.2s, border-color 0.2s;
            flex-shrink: 0;
        }
        .user-logout-btn:hover {
            background: rgba(239,68,68,0.28);
            border-color: rgba(239,68,68,0.4);
        }
        .user-logout-btn svg {
            width: 13px;
            height: 13px;
            stroke: #ef4444;
            fill: none;
            stroke-width: 1.75;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        /* ─── OVERLAY (mobile) ─── */
        .sidebar-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.55);
            backdrop-filter: blur(2px);
            z-index: 40;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s, visibility 0.3s;
        }
        .sidebar-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        /* ─── MAIN LAYOUT ─── */
        .main-wrapper {
            margin-left: var(--sb-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* ─── TOP BAR ─── */
        .topbar {
            position: sticky;
            top: 0;
            z-index: 30;
            height: 60px;
            background: rgba(255,255,255,0.97);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(0,0,0,0.07);
            display: flex;
            align-items: center;
            padding: 0 20px;
            gap: 14px;
            animation: fadeInDown 0.4s ease forwards;
        }

        .topbar-hamburger {
            display: none;
            width: 36px;
            height: 36px;
            border-radius: 9px;
            background: #f4f6f9;
            border: none;
            cursor: pointer;
            align-items: center;
            justify-content: center;
            transition: background 0.2s;
        }
        .topbar-hamburger:hover { background: #eaecf0; }
        .topbar-hamburger svg {
            width: 16px;
            height: 16px;
            stroke: #4b5563;
            fill: none;
            stroke-width: 2;
            stroke-linecap: round;
        }

        .topbar-breadcrumb {
            display: flex;
            flex-direction: column;
            gap: 1px;
        }
        .topbar-page {
            font-size: 14px;
            font-weight: 600;
            color: #1a1d23;
            font-family: 'Space Grotesk', sans-serif;
        }
        .topbar-crumb {
            font-size: 11px;
            color: #9ca3af;
            display: flex;
            align-items: center;
            gap: 4px;
        }
        .topbar-crumb span { color: var(--sb-accent); }

        .topbar-right {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* search bar */
        .topbar-search {
            display: flex;
            align-items: center;
            gap: 7px;
            background: #f4f6f9;
            border: 1px solid #e5e7eb;
            border-radius: 9px;
            padding: 6px 12px;
            font-size: 12px;
            color: #9ca3af;
            cursor: pointer;
            transition: border-color 0.2s, background 0.2s;
        }
        .topbar-search:hover {
            border-color: var(--sb-accent);
            background: #fff;
        }
        .topbar-search svg {
            width: 13px;
            height: 13px;
            stroke: #9ca3af;
            fill: none;
            stroke-width: 2;
        }

        /* notif bell */
        .topbar-notif {
            position: relative;
            width: 36px;
            height: 36px;
            border-radius: 9px;
            background: #f4f6f9;
            border: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background 0.2s, border-color 0.2s;
        }
        .topbar-notif:hover {
            background: #fff;
            border-color: var(--sb-accent);
        }
        .topbar-notif svg {
            width: 15px;
            height: 15px;
            stroke: #6b7280;
            fill: none;
            stroke-width: 1.75;
            stroke-linecap: round;
            stroke-linejoin: round;
        }
        .notif-badge {
            position: absolute;
            top: 6px;
            right: 7px;
            width: 6px;
            height: 6px;
            background: #ef4444;
            border-radius: 50%;
            border: 1.5px solid #fff;
        }

        /* user avatar (topbar) */
        .topbar-user {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 4px 10px 4px 6px;
            border-radius: 10px;
            background: #f4f6f9;
            border: 1px solid #e5e7eb;
            cursor: pointer;
            transition: background 0.2s, border-color 0.2s;
        }
        .topbar-user:hover {
            background: #fff;
            border-color: var(--sb-accent);
        }
        .topbar-avatar {
            width: 28px;
            height: 28px;
            border-radius: 7px;
            background: linear-gradient(135deg, var(--sb-accent), #0d9488);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 600;
            color: #fff;
            flex-shrink: 0;
        }
        .topbar-avatar img {
            width: 28px;
            height: 28px;
            border-radius: 7px;
            object-fit: cover;
        }
        .topbar-user-info {
            display: flex;
            flex-direction: column;
            gap: 1px;
        }
        .topbar-role {
            font-size: 11px;
            color: #6b7280;
            line-height: 1;
        }

        /* ─── PAGE CONTENT ─── */
        .page-content {
            flex: 1;
            padding: 24px 24px;
        }
        .page-content-inner {
            max-width: 1280px;
            margin: 0 auto;
            animation: slideInUp 0.5s ease forwards;
        }

        /* ─── MOBILE ─── */
        @media (max-width: 768px) {
            :root { --sb-width: 240px; }

            .sidebar { transform: translateX(-100%); }
            .sidebar.mobile-open { transform: translateX(0); }

            .main-wrapper { margin-left: 0; }

            .topbar-hamburger { display: flex; }
            .topbar-search,
            .topbar-breadcrumb { display: none; }
        }
    </style>
</head>
<body>

    <!-- Sidebar Overlay (mobile) -->
    <div id="sidebarOverlay" class="sidebar-overlay" onclick="closeSidebar()"></div>

    <!-- ═══════════════════════════════════════
         SIDEBAR
    ═══════════════════════════════════════ -->
    <aside id="sidebar" class="sidebar">
        <div class="sidebar-scan"></div>

        <div class="sidebar-inner">

            {{-- ── LOGO ── --}}
            <div class="sidebar-logo">
                <div class="logo-row">
                    <div class="logo-icon">
                        <svg viewBox="0 0 24 24"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                    </div>
                    <div class="logo-text">
                        <h1>Book Hub</h1>
                        <span>Digital Library</span>
                    </div>
                    <div class="status-dot"></div>
                </div>
            </div>

            {{-- ══════════════════════════
                 ADMIN NAV
            ══════════════════════════ --}}
            @if (Auth::check() && Auth::user()->isAdmin())
                <<div class="mb-6">
                    <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-4 px-3">Admin Panel</h3>
                    <nav class="space-y-1">
                        <a href="{{ route('dashboard') }}"
                           class="nav-link flex items-center px-4 py-3 rounded-xl {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <span class="text-xl mr-3">📊</span>
                            <span class="text-sm">Dashboard</span>
                        </a>
                        <a href="{{ route('admin.users.index') }}"
                           class="nav-link flex items-center px-4 py-3 rounded-xl {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                            <span class="text-xl mr-3">👥</span>
                            <span class="text-sm">Kelola User</span>
                        </a>
                        <a href="{{ route('admin.books.index') }}"
                           class="nav-link flex items-center px-4 py-3 rounded-xl {{ request()->routeIs('admin.books.*') ? 'active' : '' }}">
                            <span class="text-xl mr-3">📚</span>
                            <span class="text-sm">Kelola Buku</span>
                        </a>
                        <a href="{{ route('admin.categories.index') }}"
                           class="nav-link flex items-center px-4 py-3 rounded-xl {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                            <span class="text-xl mr-3">📁</span>
                            <span class="text-sm">Kategori</span>
                        </a>
                        {{-- <a href="{{ route('admin.reports.borrowings') }}"
                           class="nav-link flex items-center px-4 py-3 rounded-xl {{ request()->routeIs('admin.borrowings.*') ? 'active' : '' }}">
                            <span class="text-xl mr-3">📋</span>
                            <span class="text-sm">Peminjaman</span>
                        </a> --}}
                        <a href="{{ route('admin.activity-logs.index') }}"
                           class="nav-link flex items-center px-4 py-3 rounded-xl {{ request()->routeIs('admin.activity-logs.*') ? 'active' : '' }}">
                            <span class="text-xl mr-3">📝</span>
                            <span class="text-sm">Log Aktivitas</span>
                        </a>
                    </nav>
                </div>

            {{-- ══════════════════════════
                 PETUGAS NAV
            ══════════════════════════ --}}
            @elseif (Auth::check() && Auth::user()->isPetugas())
                <div class="nav-section">
                    <div class="nav-section-label">Petugas</div>
                </div>
                <nav class="nav-list">
                    <a href="{{ route('dashboard') }}"
                       class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <div class="nav-icon-wrap">
                            <svg viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
                        </div>
                        <span class="nav-label">Dashboard</span>
                    </a>
                    <a href="{{ route('petugas.borrowings.index') }}"
                       class="nav-link {{ request()->routeIs('petugas.borrowings.index') ? 'active' : '' }}">
                        <div class="nav-icon-wrap">
                            <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                        </div>
                        <span class="nav-label">Setujui Peminjaman</span>
                    </a>
                    <a href="{{ route('petugas.borrowings.monitoring') }}"
                       class="nav-link {{ request()->routeIs('petugas.borrowings.monitoring') ? 'active' : '' }}">
                        <div class="nav-icon-wrap">
                            <svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        </div>
                        <span class="nav-label">Pantau Pengembalian</span>
                    </a>
                    <a href="{{ route('petugas.reports.borrowings') }}"
                       class="nav-link {{ request()->routeIs('petugas.reports.*') ? 'active' : '' }}">
                        <div class="nav-icon-wrap">
                            <svg viewBox="0 0 24 24"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
                        </div>
                        <span class="nav-label">Cetak Laporan</span>
                    </a>
                </nav>

            {{-- ══════════════════════════
                 PEMINJAM NAV
            ══════════════════════════ --}}
            @else
                <div class="nav-section">
                    <div class="nav-section-label">Menu</div>
                </div>
                <nav class="nav-list">
                    <a href="{{ route('dashboard') }}"
                       class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <div class="nav-icon-wrap">
                            <svg viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
                        </div>
                        <span class="nav-label">Dashboard</span>
                    </a>
                    <a href="{{ route('peminjam.books.index') }}"
                       class="nav-link {{ request()->routeIs('peminjam.books.*') ? 'active' : '' }}">
                        <div class="nav-icon-wrap">
                            <svg viewBox="0 0 24 24"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                        </div>
                        <span class="nav-label">Katalog Buku</span>
                    </a>
                    <a href="{{ route('peminjam.borrowings.index') }}"
                       class="nav-link {{ request()->routeIs('peminjam.borrowings.*') ? 'active' : '' }}">
                        <div class="nav-icon-wrap">
                            <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                        </div>
                        <span class="nav-label">Peminjaman Saya</span>
                    </a>
                </nav>
            @endif

            {{-- ── USER SECTION ── --}}
            <div class="sidebar-user-section">
                <div class="sidebar-user">

                    <div class="user-avatar">
                        @if (Auth::check() && Auth::user()->profile_photo)
                            <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="{{ Auth::user()->name }}">
                        @else
                            {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                        @endif
                    </div>

                    <div class="user-info">
                        <div class="user-name">
                            {{ Auth::user()->name ?? 'Guest' }}
                        </div>

                        <div class="user-role">
                            @if (Auth::check() && Auth::user()->isAdmin())
                                Administrator
                            @elseif (Auth::check() && Auth::user()->isPetugas())
                                Petugas
                            @else
                                Peminjam
                            @endif
                        </div>
                    </div>

                    @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="user-logout-btn" title="Logout">
                            <svg viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                        </button>
                    </form>
                    @endauth

                </div>
            </div>

        </div>{{-- end .sidebar-inner --}}
    </aside>

    <!-- ═══════════════════════════════════════
         MAIN CONTENT
    ═══════════════════════════════════════ -->
    <div class="main-wrapper">

        {{-- ── TOP BAR ── --}}
        <nav class="topbar">
            {{-- Hamburger (mobile) --}}
            <button class="topbar-hamburger" onclick="toggleSidebar()" aria-label="Toggle sidebar">
                <svg viewBox="0 0 24 24"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
            </button>

            {{-- Breadcrumb --}}
            <div class="topbar-breadcrumb">
                <div class="topbar-page">@yield('page_title', 'Dashboard')</div>
                <div class="topbar-crumb">Book Hub / <span>@yield('page_title', 'Dashboard')</span></div>
            </div>

            <div class="topbar-right">
                {{-- Search --}}
                <div class="topbar-search">
                    <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    Cari buku...
                </div>

                {{-- Notifications --}}
                <div class="topbar-notif" title="Notifikasi">
                    <svg viewBox="0 0 24 24"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
                    <div class="notif-badge"></div>
                </div>

                {{-- User chip --}}
                <div class="topbar-user">
                    <div class="topbar-avatar">
                        @if (Auth::check() && Auth::user()->profile_photo)
                            <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="{{ Auth::user()->name }}">
                        @else
                            {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                        @endif
                    </div>
                    <div class="topbar-user-info">
                        <div class="topbar-role">
                            @if (Auth::check() && Auth::user()->isAdmin())
                                Administrator
                            @elseif (Auth::check() && Auth::user()->isPetugas())
                                Petugas
                            @else
                                Peminjam
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        {{-- ── PAGE CONTENT ── --}}
        <main class="page-content">
            <div class="page-content-inner">
                @yield('content')
            </div>
        </main>

    </div>

    <script>
        function toggleSidebar() {
            const sidebar  = document.getElementById('sidebar');
            const overlay  = document.getElementById('sidebarOverlay');
            const isOpen   = sidebar.classList.contains('mobile-open');

            if (isOpen) {
                closeSidebar();
            } else {
                sidebar.classList.add('mobile-open');
                overlay.classList.add('active');
                document.body.style.overflow = 'hidden';
            }
        }

        function closeSidebar() {
            document.getElementById('sidebar').classList.remove('mobile-open');
            document.getElementById('sidebarOverlay').classList.remove('active');
            document.body.style.overflow = '';
        }

        // Close sidebar when a nav link is tapped on mobile
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 768) closeSidebar();
            });
        });
    </script>
</body>
</html>
