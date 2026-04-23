@extends('layouts.app')

@section('title', 'Daftar Buku - Book Hub')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Daftar Buku Tersedia</h1>
    <p class="text-gray-600 mt-2">Jelajahi dan pilih buku yang ingin dipinjam</p>
</div>

<!-- Search Form -->
<div class="mb-6">
    <form method="GET" action="{{ route('peminjam.books.index') }}" class="max-w-md">
        <div class="relative">
            <input type="text" name="search" value="{{ request('search') }}" 
                   placeholder="Cari buku..." 
                   class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-amber-500 focus:border-amber-500">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <span class="text-gray-400">🔍</span>
            </div>
        </div>
    </form>
</div>

@if ($books->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($books as $book)
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition overflow-hidden flex flex-col">
                @if ($book->image)
                    <div class="h-48 bg-white flex items-center justify-center overflow-hidden">
                        <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->name }}"
                            class="w-full h-full object-contain">
                    </div>
                @else
                    <div class="bg-gradient-to-r from-amber-500 to-amber-600 h-48 flex items-center justify-center">
                        <div class="text-5xl">📚</div>
                    </div>
                @endif

                <div class="p-6 flex-1 flex flex-col">
                    <h3 class="text-lg font-bold text-gray-900 mb-1">{{ $book->name }}</h3>

                    <div class="mb-4">
                        <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-amber-100 text-amber-800">
                            {{ $book->category->name ?? 'N/A' }}
                        </span>
                    </div>

                    <div class="mb-4">
                        <p class="text-sm text-gray-600 mb-1">Penulis</p>
                        <p class="text-sm font-medium">{{ $book->author }}</p>
                    </div>

                    <div class="mb-4">
                        <p class="text-sm text-gray-600 mb-1">Tahun Terbit</p>
                        <p class="text-sm font-medium">{{ $book->year_published }}</p>
                    </div>

                    <div class="mb-4">
                        <p class="text-sm text-gray-600 mb-1">Ketersediaan</p>
                        <div class="flex items-center gap-2">
                            <div class="flex-1 h-2 bg-gray-200 rounded-full">
                                <div class="h-2 bg-green-500 rounded-full" style="width: {{ ($book->qty_available / $book->qty_total) * 100 }}%"></div>
                            </div>
                            <span class="text-sm font-semibold text-gray-900">{{ $book->qty_available }}/{{ $book->qty_total }}</span>
                        </div>
                    </div>

                    @if ($book->description)
                        <p class="text-sm text-gray-600 mb-4 flex-1">{{ Str::limit($book->description, 100) }}</p>
                    @endif

                    @if ($book->qty_available > 0)
                        <a href="{{ route('peminjam.borrowing.create', $book) }}" class="w-full bg-amber-600 text-white py-2 rounded-lg hover:bg-amber-700 transition text-center font-medium">
                            Ajukan Peminjaman
                        </a>
                    @else
                        <button disabled class="w-full bg-gray-400 text-white py-2 rounded-lg text-center font-medium cursor-not-allowed">
                            Stok Habis
                        </button>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-8 flex justify-center">
        {{ $books->links() }}
    </div>
@else
    <div class="bg-white rounded-lg shadow p-12 text-center">
        <div class="text-5xl mb-4">📭</div>
        @if(request('search'))
            <p class="text-gray-500 text-lg">Buku tidak ditemukan untuk "{{ request('search') }}"</p>
            <p class="text-gray-400 text-sm mt-2">Coba kata kunci lain atau hapus filter pencarian</p>
        @else
            <p class="text-gray-500 text-lg">Belum ada buku yang tersedia untuk dipinjam</p>
        @endif
    </div>
@endif
@endsection