@extends('layouts.app')

@section('title', 'Dashboard Admin - BookHub')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Dashboard Admin</h1>
                    <p class="text-gray-600 mt-1">
                        Selamat datang, {{ Auth::user()->name ?? 'Admin' }}!
                    </p>
                </div>

                <div class="flex items-center space-x-4">
                    <div class="text-right">
                        <p class="text-sm font-medium text-gray-900">
                            {{ Auth::user()->name ?? 'Admin' }}
                        </p>
                        <p class="text-xs text-gray-500">Administrator</p>
                    </div>

                    <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold">
                        {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <p class="text-sm text-gray-600">Total User</p>
                <p class="text-2xl font-bold text-gray-900">{{ $totalUsers }}</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <p class="text-sm text-gray-600">Total Buku</p>
                <p class="text-2xl font-bold text-gray-900">{{ $totalBooks }}</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <p class="text-sm text-gray-600">Total Peminjaman</p>
                <p class="text-2xl font-bold text-gray-900">{{ $totalBorrowings }}</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <p class="text-sm text-gray-600">Peminjaman Pending</p>
                <p class="text-2xl font-bold text-gray-900">{{ $pendingBorrowings }}</p>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Peminjaman Terbaru -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">
                    Peminjaman Terbaru
                </h3>

                <div class="space-y-3">
                    @forelse(\App\Models\Borrowing::with(['user', 'book'])->latest()->take(5)->get() as $borrowing)

                        @php
                            $statusClass = match($borrowing->status) {
                                'pending' => 'bg-yellow-100 text-yellow-800',
                                'approved' => 'bg-green-100 text-green-800',
                                'rejected' => 'bg-red-100 text-red-800',
                                default => 'bg-blue-100 text-blue-800',
                            };
                        @endphp

                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div>
                                <p class="text-sm font-medium text-gray-900">
                                    {{ $borrowing->user?->name ?? 'Unknown' }}
                                </p>
                                <p class="text-xs text-gray-600">
                                    {{ $borrowing->book?->name ?? 'Unknown Book' }}
                                </p>
                            </div>

                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $statusClass }}">
                                {{ ucfirst($borrowing->status) }}
                            </span>
                        </div>

                    @empty
                        <p class="text-gray-500 text-sm">
                            Belum ada peminjaman
                        </p>
                    @endforelse
                </div>
            </div>

            <!-- Statistik -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">
                    Statistik Bulan Ini
                </h3>

                <div class="space-y-4">
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Peminjaman Baru</span>
                        <span class="text-sm font-medium text-gray-900">
                            {{ \App\Models\Borrowing::whereMonth('created_at', now()->month)->count() }}
                        </span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Buku Dikembalikan</span>
                        <span class="text-sm font-medium text-gray-900">
                            {{ \App\Models\Borrowing::where('status', 'returned')
                                ->whereMonth('returned_at', now()->month)
                                ->count() }}
                        </span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">User Aktif</span>
                        <span class="text-sm font-medium text-gray-900">
                            {{ \App\Models\User::where('created_at', '>=', now()->subMonth())->count() }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection