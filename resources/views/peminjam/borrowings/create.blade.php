@extends('layouts.app')

@section('title', 'Ajukan Peminjaman - BookHub')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Ajukan Peminjaman Buku</h1>
    <p class="text-gray-600 mt-2">Isi form untuk mengajukan peminjaman buku</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2">
        <div class="bg-white rounded-lg shadow p-8">
            <form method="POST" action="{{ route('peminjam.borrowing.store') }}" class="space-y-6">
                @csrf

                <div class="p-4 bg-lime-50 rounded-lg border border-blue-200">
                    <h3 class="font-semibold text-gray-900 mb-2">Buku Yang Akan di pinjam</h3>
                    <p class="text-sm text-gray-700"><strong>Judul:</strong> {{ $book->name }}</p>
                    <p class="text-sm text-gray-700"><strong>Penulis:</strong> {{ $book->author ?? 'Tidak diketahui' }}</p>
                    <p class="text-sm text-gray-700"><strong>Kategori:</strong> {{ $book->category?->name ?? 'Tidak ada kategori' }}</p>
                    <p class="text-sm text-gray-700"><strong>ISBN:</strong> {{ $book->isbn ?? 'Tidak ada' }}</p>
                    <p class="text-sm text-gray-700"><strong>Stok Tersedia:</strong> {{ $book->qty_available }} dari {{ $book->qty_total }}</p>
                </div>

                <input type="hidden" name="book_id" value="{{ $book->id }}">

                <div>
                    <label for="qty" class="block text-sm font-medium text-gray-700">Jumlah yang Dipinjam</label>
                    <input type="number" name="qty" id="qty" value="{{ old('qty', 1) }}" required min="1" max="{{ $book->qty_available }}"
                        class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500 {{ $errors->has('qty') ? 'border-red-500' : 'border-gray-300' }}"
                        placeholder="Masukkan jumlah">
                    <p class="text-xs text-gray-500 mt-1">Maksimal: {{ $book->qty_available }}</p>
                    @error('qty')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="start_date" class="block text-sm font-medium text-gray-700">Tanggal Mulai Peminjaman</label>
                    <input type="date" name="start_date" id="start_date" value="{{ old('start_date', today()->toDateString()) }}" required
                        min="{{ today()->toDateString() }}"
                        class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500 {{ $errors->has('start_date') ? 'border-red-500' : 'border-gray-300' }}">
                    @error('start_date')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="end_date" class="block text-sm font-medium text-gray-700">Tanggal Pengembalian</label>
                    <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}" required
                        class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500 {{ $errors->has('end_date') ? 'border-red-500' : 'border-gray-300' }}">
                    <p class="text-xs text-gray-500 mt-1">Harus setelah tanggal mulai peminjaman</p>
                    @error('end_date')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="note" class="block text-sm font-medium text-gray-700">Keterangan Tambahan (Opsional)</label>
                    <textarea name="note" id="note" rows="4"
                        class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Masukkan tujuan peminjaman atau keterangan lainnya">{{ old('note') }}</textarea>
                </div>

                <div class="flex gap-4">
                    <button type="submit" class="flex-1 bg-lime-600 text-white py-2 rounded-lg hover:bg-lime-700 transition font-medium">
                        Kirim Permintaan
                    </button>
                    <a href="{{ route('peminjam.books.index') }}" class="flex-1 bg-gray-300 text-gray-700 py-2 rounded-lg hover:bg-gray-400 transition text-center font-medium">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div>
        <div class="bg-lime-50 rounded-lg border border-blue-200 p-6">
            <h3 class="font-semibold text-gray-900 mb-4">Panduan Pengajuan</h3>
            <div class="space-y-3 text-sm text-gray-700">
                <div class="flex gap-2">
                    <span class="text-lg">1️⃣</span>
                    <p>Isi jumlah buku yang ingin dipinjam</p>
                </div>
                <div class="flex gap-2">
                    <span class="text-lg">2️⃣</span>
                    <p>Tentukan tanggal mulai dan akhir peminjaman</p>
                </div>
                <div class="flex gap-2">
                    <span class="text-lg">3️⃣</span>
                    <p>Tambahkan keterangan jika diperlukan</p>
                </div>
                <div class="flex gap-2">
                    <span class="text-lg">4️⃣</span>
                    <p>Klik "Kirim Permintaan" untuk mengajukan</p>
                </div>
                <div class="flex gap-2">
                    <span class="text-lg">5️⃣</span>
                    <p>Tunggu persetujuan dari petugas</p>
                </div>
            </div>
        </div>

        <div class="bg-yellow-50 rounded-lg border border-yellow-200 p-6 mt-6">
            <h3 class="font-semibold text-gray-900 mb-3">⚠️ Syarat & Ketentuan</h3>
            <ul class="text-sm text-gray-700 space-y-2">
                <li>• Kembalikan buku sesuai jadwal yang ditentukan</li>
                <li>• Periksa kondisi buku sebelum meninggalkan lokasi</li>
                <li>• Jika ada kerusakan, laporkan segera ke petugas</li>
                <li>• Timbulkan denda jika terlambat mengembalikan</li>
            </ul>
        </div>
    </div>
</div>
@endsection
