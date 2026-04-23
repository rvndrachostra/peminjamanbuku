    @extends('layouts.app')

    @section('title', 'Dashboard Petugas - BookHub')

    @section('content')
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Dashboard Petugas</h1>
        <p class="text-gray-600 mt-2">Selamat datang, {{ Auth::user()->name }}!</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-orange-100 rounded-lg p-3">
                    <span class="text-2xl">⏳</span>
                </div>
                <div class="ml-4">
                    <p class="text-gray-500 text-sm">Peminjaman Pending</p>
                    <p class="text-3xl font-bold text-orange-600">{{ $pendingBorrowings }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-red-100 rounded-lg p-3">
                    <span class="text-2xl">⚠️</span>
                </div>
                <div class="ml-4">
                    <p class="text-gray-500 text-sm">Pengembalian Terlambat</p>
                    <p class="text-3xl font-bold text-red-600">{{ $unreturned }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-lime-100 rounded-lg p-3">
                    <span class="text-2xl">📅</span>
                </div>
                <div class="ml-4">
                    <p class="text-gray-500 text-sm">Tanggal Hari Ini</p>
                    <p class="text-2xl font-bold text-gray-900">{{ now()->format('d M Y') }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-emerald-100 rounded-lg p-3">
                    <span class="text-2xl">💰</span>
                </div>
                <div class="ml-4">
                    <p class="text-gray-500 text-sm">Denda Belum Lunas</p>
                    <p class="text-3xl font-bold text-emerald-600">{{ $unpaidFines }}</p>
                    <p class="text-xs text-gray-500 mt-1">Rp {{ number_format($unpaidFineAmount, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6">
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-6">Menu Petugas</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="{{ route('petugas.borrowings.index') }}" class="block p-6 bg-gradient-to-br from-blue-50 to-blue-100 rounded-lg hover:shadow-lg transition border-l-4 border-blue-600">
                    <div class="text-3xl mb-3">✅</div>
                    <p class="font-bold text-gray-900 text-lg">Setujui Peminjaman</p>
                    <p class="text-sm text-gray-600 mt-1">Lihat dan setujui permintaan peminjaman</p>
                    <p class="text-xs text-blue-600 font-semibold mt-3">{{ $pendingBorrowings }} menunggu persetujuan</p>
                </a>

                <a href="{{ route('petugas.borrowings.monitoring') }}" class="block p-6 bg-gradient-to-br from-green-50 to-green-100 rounded-lg hover:shadow-lg transition border-l-4 border-green-600">
                    <div class="text-3xl mb-3">👁️</div>
                    <p class="font-bold text-gray-900 text-lg">Pantau Pengembalian</p>
                    <p class="text-sm text-gray-600 mt-1">Pantau alat yang sedang dipinjam</p>
                    <p class="text-xs text-green-600 font-semibold mt-3">{{ $unreturned }} terlambat dikembalikan</p>
                </a>

                <a href="{{ route('petugas.reports.borrowings') }}" class="block p-6 bg-gradient-to-br from-green-50 to-green-100 rounded-lg hover:shadow-lg transition border-l-4 border-green-600">
                    <div class="text-3xl mb-3">🖨️</div>
                    <p class="font-bold text-gray-900 text-lg">Cetak Laporan</p>
                    <p class="text-sm text-gray-600 mt-1">Buat dan cetak laporan peminjaman</p>
                    <p class="text-xs text-green-600 font-semibold mt-3">Laporan bulanan</p>
                </a>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Panduan Cepat</h2>
            <div class="space-y-3">
                <div class="flex items-start">
                    <span class="text-2xl mr-3">1️⃣</span>
                    <div>
                        <p class="font-medium text-gray-900">Periksa Peminjaman Pending</p>
                        <p class="text-sm text-gray-500">Tinjau dan setujui permintaan peminjaman yang masuk</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <span class="text-2xl mr-3">2️⃣</span>
                    <div>
                        <p class="font-medium text-gray-900">Pantau Pengembalian</p>
                        <p class="text-sm text-gray-500">Pastikan semua alat dikembalikan sesuai jadwal</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <span class="text-2xl mr-3">3️⃣</span>
                    <div>
                        <p class="font-medium text-gray-900">Buat Laporan</p>
                        <p class="text-sm text-gray-500">Cetak laporan peminjaman untuk dokumentasi</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
