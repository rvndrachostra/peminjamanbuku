@extends('layouts.app')

@section('title', 'Edit Buku - Book Hub')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Edit Buku</h1>
    <p class="text-gray-600 mt-2">Ubah data buku perpustakaan</p>
</div>

<div class="bg-white rounded-lg shadow p-8 max-w-2xl">
    <form method="POST" action="{{ route('admin.books.update', $book) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="category_id" class="block text-sm font-medium text-gray-700">Kategori</label>
            <select name="category_id" id="category_id" required
                class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('category_id') border-red-500 @enderror">
                <option value="">Pilih Kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Judul Buku</label>
            <input type="text" name="name" id="name" value="{{ old('name', $book->name) }}" required
                class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror"
                placeholder="Contoh: Harry Potter and the Philosopher's Stone">
            @error('name')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="author" class="block text-sm font-medium text-gray-700">Penulis</label>
            <input type="text" name="author" id="author" value="{{ old('author', $book->author) }}" required
                class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('author') border-red-500 @enderror"
                placeholder="Contoh: J.K. Rowling">
            @error('author')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="isbn" class="block text-sm font-medium text-gray-700">ISBN</label>
                <input type="text" name="isbn" id="isbn" value="{{ old('isbn', $book->isbn) }}" required
                    class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('isbn') border-red-500 @enderror"
                    placeholder="Contoh: 978-0-7475-3269-9">
                @error('isbn')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="year_published" class="block text-sm font-medium text-gray-700">Tahun Terbit</label>
                <input type="number" name="year_published" id="year_published" value="{{ old('year_published', $book->year_published) }}" required min="1000" max="{{ date('Y') }}"
                    class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('year_published') border-red-500 @enderror">
                @error('year_published')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div>
            <label for="qty_total" class="block text-sm font-medium text-gray-700">Jumlah Total</label>
            <input type="number" name="qty_total" id="qty_total" value="{{ old('qty_total', $book->qty_total) }}" required min="1"
                class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('qty_total') border-red-500 @enderror">
            @error('qty_total')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="bg-lime-50 border border-blue-200 rounded-lg p-4">
            <p class="text-sm text-blue-800"><strong>Stok Tersedia:</strong> {{ $book->qty_available }}/{{ $book->qty_total }}</p>
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi (Opsional)</label>
            <textarea name="description" id="description" rows="4"
                class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                placeholder="Masukkan sinopsis atau deskripsi buku">{{ old('description', $book->description) }}</textarea>
            @error('description')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="image" class="block text-sm font-medium text-gray-700">Gambar Sampul Buku</label>
            @if ($book->image)
                <div class="mb-4">
                    <p class="text-sm text-gray-600 mb-2">Gambar Saat Ini:</p>
                    <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->name }}"
                        class="h-48 w-32 rounded-lg object-cover border border-gray-200">
                    <div class="mt-2">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="delete_image" value="1" id="deleteImage">
                            <span class="ml-2 text-sm text-gray-700">Hapus gambar saat ini</span>
                        </label>
                    </div>
                </div>
            @endif
            <div id="imagePreview" class="mb-4" style="display: none;">
                <p class="text-sm text-gray-600 mb-2">Preview Gambar Baru:</p>
                <img id="previewImage" src="" alt="Preview"
                    class="h-48 w-32 rounded-lg object-cover border border-gray-200">
            </div>
            <div class="mt-1 flex items-center justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-gray-400 transition">
                <div class="space-y-1 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                        <path d="M28 8H12a4 4 0 00-4 4v20a4 4 0 004 4h24a4 4 0 004-4V16a4 4 0 00-4-4h-8l-4-4z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <div class="flex text-sm text-gray-600">
                        <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500">
                            <span>Upload gambar baru</span>
                            <input id="image" name="image" type="file" class="sr-only" accept="image/*">
                        </label>
                        <p class="pl-1">atau drag and drop</p>
                    </div>
                    <p class="text-xs text-gray-500">PNG, JPG, GIF hingga 2MB</p>
                </div>
            </div>
            @error('image')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex gap-4">
            <button type="submit" class="bg-lime-600 text-white px-6 py-2 rounded-lg hover:bg-lime-700 transition font-medium">
                Simpan Perubahan
            </button>
            <a href="{{ route('admin.books.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400 transition font-medium">
                Batal
            </a>
        </div>
    </form>
</div>

<script>
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                const previewImage = document.getElementById('previewImage');
                const imagePreview = document.getElementById('imagePreview');
                previewImage.src = event.target.result;
                imagePreview.style.display = 'block';
                // Scroll to preview
                imagePreview.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            };
            reader.readAsDataURL(file);
        }
    });

    document.getElementById('deleteImage')?.addEventListener('change', function(e) {
        const imageInput = document.getElementById('image');
        if (e.target.checked) {
            imageInput.disabled = true;
            imageInput.value = '';
        } else {
            imageInput.disabled = false;
        }
    });
</script>
@endsection