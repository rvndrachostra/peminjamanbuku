@extends('layouts.app')

@section('title', 'Kelola User - BookHub')

@section('content')
<style>
    .tooltip-container {
        position: relative;
        display: inline-block;
    }

    .tooltip {
        visibility: hidden;
        background-color: #1f2937;
        color: #fff;
        text-align: left;
        padding: 8px 12px;
        border-radius: 6px;
        position: fixed;
        z-index: 9999;
        white-space: normal;
        font-size: 0.875rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        pointer-events: none;
        opacity: 0;
        transition: opacity 0.3s ease-in-out, visibility 0.3s ease-in-out;
        max-width: 300px;
    }

    .tooltip::after {
        content: "";
        position: absolute;
        bottom: -5px;
        left: 50%;
        margin-left: -5px;
        border-width: 5px;
        border-style: solid;
        border-color: #1f2937 transparent transparent transparent;
    }

    .tooltip-container:hover .tooltip {
        visibility: visible;
        opacity: 1;
    }
</style>

<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Kelola User</h1>
        <p class="text-gray-600 mt-2">Manajemen pengguna sistem BookHub</p>
    </div>
    <a href="{{ route('admin.users.create') }}" class="bg-lime-600 text-white px-6 py-2 rounded-lg hover:bg-lime-700 transition font-medium">
        + Tambah User Baru
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Foto</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Telepon</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tindakan</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($users as $user)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($user->profile_photo)
                                <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="{{ $user->name }}"
                                    class="h-10 w-10 rounded-full object-cover">
                            @else
                                <div class="h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center">
                                    <span class="text-xs font-medium text-gray-700">{{ substr($user->name, 0, 1) }}</span>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <p class="text-sm font-medium text-gray-900">{{ $user->name }}</p>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <p class="text-sm text-gray-500">{{ $user->email }}</p>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <p class="text-sm text-gray-500">{{ $user->phone ?? '-' }}</p>
                        </td>
                        <td class="px-6 py-4">
                            @if ($user->address)
                                <div class="tooltip-container">
                                    <p class="text-sm text-gray-500">
                                        @if (strlen($user->address) > 30)
                                            {{ substr($user->address, 0, 30) }}...
                                        @else
                                            {{ $user->address }}
                                        @endif
                                    </p>
                                    <div class="tooltip">{{ $user->address }}</div>
                                </div>
                            @else
                                <p class="text-sm text-gray-400">-</p>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex gap-2 flex-wrap">
                                @foreach ($user->roles as $role)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                        @if ($role->name === 'admin') bg-red-100 text-red-800
                                        @elseif ($role->name === 'petugas') bg-lime-100 text-blue-800
                                        @else bg-green-100 text-green-800 @endif">
                                        {{ $role->label }}
                                    </span>
                                @endforeach
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm fonts-medium space-x-2">
                            <a href="{{ route('admin.users.edit', $user) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                            @if ($user->id !== Auth::id())
                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="inline" onsubmit="return confirm('Yakin ingin menghapus user ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                            Belum ada user. <a href="{{ route('admin.users.create') }}" class="text-blue-600 hover:underline">Buat user baru</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
        {{ $users->links() }}
    </div>
</div>

<script>
    // Position tooltips dynamically
    document.querySelectorAll('.tooltip-container').forEach(container => {
        const tooltip = container.querySelector('.tooltip');

        container.addEventListener('mouseenter', function() {
            const rect = container.getBoundingClientRect();
            const tooltipRect = tooltip.getBoundingClientRect();

            // Position tooltip above the text with some offset
            const top = rect.top - tooltipRect.height - 10;
            const left = rect.left + (rect.width / 2) - (tooltipRect.width / 2);

            tooltip.style.top = (top + window.scrollY) + 'px';
            tooltip.style.left = left + 'px';
        });
    });
</script>
@endsection
