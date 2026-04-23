@extends('layouts.app')

@section('title', 'Peminjaman Saya - Book Hub')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Peminjaman Saya</h1>
    <p class="text-gray-600 mt-2">Lihat dan kelola semua peminjaman buku Anda</p>
</div>

@if ($borrowings->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-lg shadow p-4">
            <p class="text-gray-600 text-sm">Total Peminjaman</p>
            <p class="text-3xl font-bold text-gray-900">{{ $borrowings->total() }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <p class="text-gray-600 text-sm">Menunggu Persetujuan</p>
            <p class="text-3xl font-bold text-yellow-600">{{ $borrowings->where('status', 'pending')->count() }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <p class="text-gray-600 text-sm">Sedang Dipinjam</p>
            <p class="text-3xl font-bold text-blue-600">{{ $borrowings->where('status', 'approved')->count() }}</p>
        </div>

        <div class="bg-white rounded-lg shadow p-4">
            <p class="text-gray-600 text-sm">Denda Belum Lunas</p>
            <p class="text-3xl font-bold text-red-600">{{ $unpaidFineCount }}</p>
            <p class="text-xs text-gray-500 mt-1">Rp {{ number_format($unpaidFineAmount, 0, ',', '.') }}</p>
        </div>
    </div>

    <div class="space-y-4">
        @foreach ($borrowings as $borrowing)
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="border-l-4 @if ($borrowing->status === 'pending') border-yellow-500
                    @elseif ($borrowing->status === 'approved') border-blue-500
                    @elseif ($borrowing->status === 'returned') border-green-500
                    @else border-red-500 @endif">
                    <div class="p-6">
                        <div class="flex items-center justify-between gap-4 mb-4">
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">{{ $borrowing->book->name }}</h3>
                                <p class="text-sm text-gray-500">ISBN: {{ $borrowing->book->isbn }}</p>
                            </div>
                            <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full
                                @if ($borrowing->status === 'pending') bg-yellow-100 text-yellow-800
                                @elseif ($borrowing->status === 'approved') bg-lime-100 text-blue-800
                                @elseif ($borrowing->status === 'returned') bg-green-100 text-green-800
                                @else bg-red-100 text-red-800 @endif">
                                @if ($borrowing->status === 'pending')
                                    ⏳ Menunggu Persetujuan
                                @elseif ($borrowing->status === 'approved')
                                    ✅ Disetujui
                                @elseif ($borrowing->status === 'returned')
                                    ✓ Dikembalikan
                                @else
                                    ❌ Ditolak
                                @endif
                            </span>
                        </div>

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                            <div>
                                <p class="text-xs text-gray-500 uppercase">Jumlah</p>
                                <p class="font-semibold text-gray-900">{{ $borrowing->qty }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase">Mulai</p>
                                <p class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($borrowing->start_date)->format('d/m/Y') }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase">Akhir</p>
                                <p class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($borrowing->end_date)->format('d/m/Y') }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase">Diajukan</p>
                                <p class="font-semibold text-gray-900">{{ $borrowing->created_at->format('d/m/Y') }}</p>
                            </div>
                        </div>

                        @if ($borrowing->note)
                            <div class="mb-4 p-3 bg-gray-50 rounded">
                                <p class="text-xs text-gray-500 uppercase">Catatan</p>
                                <p class="text-sm text-gray-700">{{ $borrowing->note }}</p>
                            </div>
                        @endif

                        @if ($borrowing->status === 'returned')
                            <div class="rounded-lg border border-gray-200 p-4 bg-gray-50">
                                <div class="flex items-center justify-between gap-3 mb-3">
                                    <p class="text-sm font-semibold text-gray-900">Informasi Pengembalian & Denda</p>
                                    @if ($borrowing->total_fine > 0)
                                        <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full {{ $borrowing->fine_status === 'lunas' ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }}">
                                            {{ $borrowing->fine_status === 'lunas' ? 'Lunas' : 'Belum Lunas' }}
                                        </span>
                                    @else
                                        <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-emerald-100 text-emerald-700">
                                            Tanpa Denda
                                        </span>
                                    @endif
                                </div>

                                <div class="grid grid-cols-2 md:grid-cols-4 gap-3 text-sm">
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase">Tanggal Kembali</p>
                                        <p class="font-semibold text-gray-900">{{ optional($borrowing->actual_return_date)->format('d/m/Y') ?? optional($borrowing->returned_at)->format('d/m/Y') ?? '-' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase">Kondisi</p>
                                        <p class="font-semibold text-gray-900">{{ $borrowing->return_condition ? str_replace('_', ' ', ucfirst($borrowing->return_condition)) : '-' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase">Telat</p>
                                        <p class="font-semibold text-gray-900">{{ $borrowing->late_days }} hari</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase">Total Denda</p>
                                        <p class="font-semibold {{ $borrowing->total_fine > 0 ? 'text-red-600' : 'text-emerald-600' }}">Rp {{ number_format($borrowing->total_fine, 0, ',', '.') }}</p>
                                    </div>
                                </div>

                                @if ($borrowing->total_fine > 0)
                                    <div class="mt-3 text-sm text-gray-700">
                                        <p>Denda keterlambatan: <span class="font-semibold">Rp {{ number_format($borrowing->late_fine, 0, ',', '.') }}</span></p>
                                        <p>Denda kerusakan: <span class="font-semibold">Rp {{ number_format($borrowing->damage_fine, 0, ',', '.') }}</span></p>
                                        @if ($borrowing->fine_status === 'lunas' && $borrowing->fine_paid_at)
                                            <p class="text-emerald-700 mt-1">Dibayar pada {{ $borrowing->fine_paid_at->format('d/m/Y H:i') }}</p>
                                        @endif
                                    </div>
                                @endif

                                @if ($borrowing->return_note)
                                    <div class="mt-3 rounded bg-white p-3 text-sm text-gray-700 border border-gray-200">
                                        <p class="text-xs text-gray-500 uppercase mb-1">Catatan Petugas</p>
                                        <p>{{ $borrowing->return_note }}</p>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-8 flex justify-center">
        {{ $borrowings->links() }}
    </div>
@else
    <div class="bg-white rounded-lg shadow p-12 text-center">
        <div class="text-5xl mb-4">📭</div>
        <p class="text-gray-500 text-lg mb-4">Anda belum memiliki peminjaman</p>
        <a href="{{ route('peminjam.books.index') }}" class="inline-block bg-lime-600 text-white px-6 py-2 rounded-lg hover:bg-lime-700 transition font-medium">
            Lihat Daftar Buku
        </a>
    </div>
@endif
@endsection
