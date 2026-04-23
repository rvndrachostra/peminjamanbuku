@extends('layouts.app')

@section('title', 'Edit User - BookHub')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Edit User</h1>
    <p class="text-gray-600 mt-2">Ubah data pengguna sistem bookHub</p>
</div>

<div class="bg-white rounded-lg shadow p-8 max-w-2xl">
    <form method="POST" action="{{ route('admin.users.update', $user) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror"
                placeholder="Masukkan nama lengkap">
            @error('name')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-500 @enderror"
                placeholder="user@example.com">
            @error('email')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="phone" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
            <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}"
                class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                placeholder="08xx-xxxx-xxxx">
            @error('phone')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="address" class="block text-sm font-medium text-gray-700">Alamat</label>
            <textarea name="address" id="address" rows="3"
                class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                placeholder="Masukkan alamat lengkap">{{ old('address', $user->address) }}</textarea>
            @error('address')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-3">Foto Profil</label>
            @if ($user->profile_photo)
                <div class="mb-4 relative inline-block" id="currentPhotoContainer">
                    <p class="text-sm text-gray-600 mb-2">Foto Profil Saat Ini:</p>
                    <div class="relative w-32 h-32">
                        <img id="currentPhoto" src="{{ asset('storage/' . $user->profile_photo) }}" alt="{{ $user->name }}"
                            class="h-32 w-32 rounded-lg object-cover border border-gray-200">
                        <button type="button" id="deletePhotoBtn"
                            class="absolute top-0 right-0 transform translate-x-1/4 -translate-y-1/4 bg-red-500 hover:bg-red-600 text-white rounded-full p-1 shadow-lg transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <input type="hidden" id="deleteProfilePhoto" name="delete_profile_photo" value="0">
            @endif
            <div id="newPhotoPreview" class="mb-4" style="display: none;">
                <p class="text-sm text-gray-600 mb-2">Preview Foto Baru:</p>
                <img id="newPreviewImage" src="" alt="Preview Baru"
                    class="h-32 w-32 rounded-lg object-cover border border-gray-200">
            </div>
            <div class="mt-1 flex items-center justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-gray-400 transition">
                <div class="space-y-1 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                        <path d="M28 8H12a4 4 0 00-4 4v20a4 4 0 004 4h24a4 4 0 004-4V16a4 4 0 00-4-4h-8l-4-4z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <div class="flex text-sm text-gray-600">
                        <label for="profile_photo" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500">
                            <span>Upload foto baru</span>
                            <input id="profile_photo" name="profile_photo" type="file" class="sr-only" accept="image/*">
                        </label>
                        <p class="pl-1">atau drag and drop</p>
                    </div>
                    <p class="text-xs text-gray-500">PNG, JPG, GIF hingga 2MB (Opsional)</p>
                </div>
            </div>
            @error('profile_photo')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Password (Kosongkan jika tidak ingin mengubah)</label>
            <input type="password" name="password" id="password"
                class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('password') border-red-500 @enderror"
                placeholder="Minimal 8 karakter">
            @error('password')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation"
                class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                placeholder="Masukkan ulang password">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-3">Pilih Role</label>
            <div class="space-y-3">
                @foreach ($roles as $role)
                    <div class="flex items-center">
                        <input type="checkbox" name="roles[]" value="{{ $role->id }}" id="role_{{ $role->id }}"
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                            {{ $user->roles->contains($role) ? 'checked' : '' }}>
                        <label for="role_{{ $role->id }}" class="ml-2 block text-sm text-gray-700">
                            <span class="font-medium">{{ $role->label }}</span>
                            <p class="text-xs text-gray-500">
                                @if ($role->name === 'admin')
                                    Akses penuh ke sistem
                                @elseif ($role->name === 'petugas')
                                    Mengelola persetujuan peminjaman dan pengembalian
                                @else
                                    Dapat meminjam dan mengembalikan Buku
                                @endif
                            </p>
                        </label>
                    </div>
                @endforeach
            </div>
            @error('roles')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex gap-4">
            <button type="submit" class="bg-lime-600 text-white px-6 py-2 rounded-lg hover:bg-lime-700 transition font-medium">
                Simpan Perubahan
            </button>
            <a href="{{ route('admin.users.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400 transition font-medium">
                Batal
            </a>
        </div>
    </form>
</div>

<script>
    document.getElementById('deletePhotoBtn')?.addEventListener('click', function(e) {
        e.preventDefault();
        if (confirm('Yakin ingin menghapus foto profil?')) {
            document.getElementById('deleteProfilePhoto').value = '1';
            document.getElementById('currentPhotoContainer').style.display = 'none';
            document.getElementById('newPhotoPreview').style.display = 'none';
            document.getElementById('profile_photo').value = '';
        }
    });

    document.getElementById('profile_photo')?.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                const deletePhotoInput = document.getElementById('deleteProfilePhoto');
                if (deletePhotoInput) {
                    deletePhotoInput.value = '0';
                }
                const newPreviewImage = document.getElementById('newPreviewImage');
                const newPhotoPreview = document.getElementById('newPhotoPreview');
                newPreviewImage.src = event.target.result;
                newPhotoPreview.style.display = 'block';
                // Scroll to preview
                newPhotoPreview.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
