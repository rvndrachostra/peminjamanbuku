@extends('layouts.app')

@section('title', 'Pantau Pengembalian - Book Hub')

@section('content')
<style>
    .modal-backdrop {
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
    }

    .modal-backdrop.show {
        opacity: 1;
    }

    .modal-panel {
        opacity: 0;
        transform: translateY(20px) scale(0.98);
        transition: all 0.3s ease-in-out;
    }

    .modal-panel.show {
        opacity: 1;
        transform: translateY(0) scale(1);
    }

    .confirm-btn {
        position: relative;
        overflow: visible;
    }

    .spark {
        position: absolute;
        left: 50%;
        top: 50%;
        width: 7px;
        height: 7px;
        border-radius: 9999px;
        background: #facc15;
        opacity: 0;
        transform: translate(-50%, -50%) scale(0.2);
        pointer-events: none;
    }

    .confirm-btn.spark-run .spark {
        animation: spark-burst 0.7s ease-out forwards;
    }

    @keyframes spark-burst {
        0% {
            opacity: 0;
            transform: translate(-50%, -50%) scale(0.2);
        }

        20% {
            opacity: 1;
        }

        100% {
            opacity: 0;
            transform: translate(calc(-50% + var(--tx)), calc(-50% + var(--ty))) scale(0.1);
        }
    }

    .check-rise {
        animation: check-rise 0.55s ease-out forwards;
    }

    @keyframes check-rise {
        0% {
            opacity: 0;
            transform: translate(-50%, 16px) scale(0.55);
        }

        100% {
            opacity: 1;
            transform: translate(-50%, -2px) scale(1);
        }
    }
</style>

<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Pantau Pengembalian Buku</h1>
    <p class="text-gray-600 mt-2">Denda keterlambatan otomatis Rp {{ number_format($dailyFine, 0, ',', '.') }} per hari.</p>
</div>

@if (session('success'))
    <div class="mb-4 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="mb-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
        <ul class="list-disc pl-5 space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="bg-white rounded-lg shadow overflow-hidden">
    @if ($borrowings->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Peminjam</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Buku</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Batas Kembali</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Denda</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($borrowings as $borrowing)
                        @php
                            $overdueDays = $borrowing->status === 'approved' && $borrowing->end_date->lt(today())
                                ? $borrowing->end_date->copy()->startOfDay()->diffInDays(today()->startOfDay())
                                : 0;
                            $estimatedLateFine = $overdueDays * $dailyFine;
                        @endphp
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <p class="text-sm font-medium text-gray-900">{{ $borrowing->user->name }}</p>
                                <p class="text-xs text-gray-500">{{ $borrowing->user->email }}</p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <p class="text-sm font-medium text-gray-900">{{ $borrowing->book->name }}</p>
                                <p class="text-xs text-gray-500">{{ $borrowing->book->isbn }}</p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <p class="text-sm text-gray-900">{{ $borrowing->qty }}</p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <p class="text-sm font-medium text-gray-900">{{ $borrowing->end_date->format('d/m/Y') }}</p>
                                @if ($borrowing->status === 'approved' && $borrowing->end_date < today())
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800 mt-1">Terlambat {{ $overdueDays }} hari</span>
                                @endif
                                @if ($borrowing->status === 'approved' && $borrowing->end_date->diffInDays(today()) <= 1)
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800 mt-1">Segera</span>
                                @endif
                                @if ($borrowing->status === 'returned')
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-700 mt-1">Dikembalikan {{ optional($borrowing->actual_return_date)->format('d/m/Y') ?? optional($borrowing->returned_at)->format('d/m/Y') }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if ($borrowing->status === 'approved')
                                    @if ($estimatedLateFine > 0)
                                        <p class="text-sm font-semibold text-red-600">Rp {{ number_format($estimatedLateFine, 0, ',', '.') }}</p>
                                        <p class="text-xs text-gray-500">Estimasi keterlambatan saat ini</p>
                                    @else
                                        <p class="text-sm text-gray-500">Belum ada denda</p>
                                    @endif
                                @else
                                    <p class="text-sm font-semibold {{ $borrowing->total_fine > 0 ? 'text-red-600' : 'text-emerald-600' }}">
                                        Rp {{ number_format($borrowing->total_fine, 0, ',', '.') }}
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        Telat: Rp {{ number_format($borrowing->late_fine, 0, ',', '.') }} | Kerusakan: Rp {{ number_format($borrowing->damage_fine, 0, ',', '.') }}
                                    </p>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($borrowing->status === 'approved')
                                    <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-lime-100 text-blue-800">
                                        Dipinjam
                                    </span>
                                @endif
                                @if ($borrowing->fine_status === 'belum_lunas')
                                    <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-700">
                                        Belum Lunas
                                    </span>
                                @else
                                    <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-emerald-100 text-emerald-700">
                                        Lunas
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                @if ($borrowing->status === 'approved')
                                    <button
                                        type="button"
                                        class="open-return-modal bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition"
                                        data-borrowing-id="{{ $borrowing->id }}"
                                        data-user-name="{{ $borrowing->user->name }}"
                                        data-book-name="{{ $borrowing->book->name }}"
                                        data-end-date="{{ $borrowing->end_date->format('Y-m-d') }}"
                                        data-end-date-label="{{ $borrowing->end_date->format('d/m/Y') }}"
                                    >
                                        Dikembalikan
                                    </button>
                                @endif
                                @if ($borrowing->status === 'returned' && $borrowing->fine_status === 'belum_lunas')
                                    <button
                                        type="button"
                                        class="open-paid-modal bg-emerald-600 text-white px-4 py-2 rounded-lg hover:bg-emerald-700 transition"
                                        data-borrowing-id="{{ $borrowing->id }}"
                                        data-user-name="{{ $borrowing->user->name }}"
                                        data-total-fine="{{ $borrowing->total_fine }}"
                                    >
                                        Tandai Lunas
                                    </button>
                                @else
                                    <span class="text-xs text-gray-500">Selesai</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
            {{ $borrowings->links() }}
        </div>
    @else
        <div class="p-8 text-center">
            <div class="text-5xl mb-4">📦</div>
            <p class="text-gray-500 text-lg">Semua Buku telah dikembalikan atau tidak ada yang dipinjam</p>
            <a href="{{ route('dashboard') }}" class="text-blue-600 hover:underline mt-2 inline-block">Kembali ke Dashboard</a>
        </div>
    @endif
</div>

<div id="returnModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
    <div class="modal-backdrop absolute inset-0 bg-black/50"></div>
    <div class="modal-panel relative z-10 w-full max-w-lg rounded-2xl bg-white shadow-2xl max-h-[95vh] overflow-y-auto">
        <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4">
            <h2 class="text-xl font-bold text-gray-900">Konfirmasi Pengembalian</h2>
            <button type="button" class="text-gray-400 hover:text-gray-700" data-close="return">✕</button>
        </div>

        <form id="returnForm" method="POST" class="space-y-4 px-6 py-5">
            @csrf
            <div class="rounded-lg bg-gray-50 p-4 text-sm text-gray-700">
                <p><span class="font-semibold">Peminjam:</span> <span id="returnBorrowerLabel">-</span></p>
                <p><span class="font-semibold">Buku:</span> <span id="returnBookLabel">-</span></p>
                <p><span class="font-semibold">Batas Kembali:</span> <span id="returnDueDateLabel">-</span></p>
            </div>

            <input type="hidden" id="returnDueDate" value="">

            <div>
                <label for="returned_date" class="block text-sm font-medium text-gray-700">Tanggal Dikembalikan</label>
                <input type="date" id="returned_date" name="returned_date" required class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500">
            </div>

            <div>
                <label for="return_condition" class="block text-sm font-medium text-gray-700">Kondisi Dikembalikan</label>
                <select id="return_condition" name="return_condition" required class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500">
                    <option value="baik">Baik</option>
                    <option value="rusak_ringan">Rusak Ringan</option>
                    <option value="rusak_berat">Rusak Berat</option>
                    <option value="hilang">Hilang</option>
                    <option value="lainnya">Lainnya</option>
                </select>
            </div>

            <div id="damageFineGroup" class="hidden">
                <label for="damage_fine" class="block text-sm font-medium text-gray-700">Denda Kerusakan</label>
                <input type="number" id="damage_fine" name="damage_fine" min="0" step="1000" value="0" class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500" placeholder="Contoh: 25000">
            </div>

            <div>
                <label for="return_note" class="block text-sm font-medium text-gray-700">Catatan Pengembalian (Opsional)</label>
                <textarea id="return_note" name="return_note" rows="2" class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500" placeholder="Contoh: Ada goresan di bagian pegangan"></textarea>
            </div>

            <div class="rounded-lg border border-blue-100 bg-blue-50 p-4">
                <p class="text-sm font-semibold text-blue-900">Ringkasan Denda</p>
                <div class="mt-2 grid grid-cols-2 gap-3 text-sm">
                    <p class="text-gray-600">Terlambat</p>
                    <p id="previewLateDays" class="text-right font-medium text-gray-900">0 hari</p>
                    <p class="text-gray-600">Denda Keterlambatan</p>
                    <p id="previewLateFine" class="text-right font-medium text-gray-900">Rp 0</p>
                    <p class="text-gray-600">Denda Kerusakan</p>
                    <p id="previewDamageFine" class="text-right font-medium text-gray-900">Rp 0</p>
                    <p class="text-gray-700 font-semibold">Total Denda</p>
                    <p id="previewTotalFine" class="text-right font-bold text-red-600">Rp 0</p>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 border-t border-gray-200 pt-4">
                <button type="button" class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100" data-close="return">
                    Batal
                </button>
                <button type="submit" id="returnConfirmBtn" class="confirm-btn inline-flex items-center rounded-lg bg-green-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-green-700 transition">
                    <svg id="returnLoadingIcon" class="mr-2 hidden h-4 w-4 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                    </svg>
                    <span id="returnConfirmLabel">Konfirmasi Pengembalian</span>
                    <span class="spark" style="--tx: -28px; --ty: -20px;"></span>
                    <span class="spark" style="--tx: -8px; --ty: -28px;"></span>
                    <span class="spark" style="--tx: 22px; --ty: -22px;"></span>
                    <span class="spark" style="--tx: 28px; --ty: 8px;"></span>
                    <span class="spark" style="--tx: -24px; --ty: 20px;"></span>
                </button>
            </div>
        </form>
    </div>
</div>

<div id="paidModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
    <div class="modal-backdrop absolute inset-0 bg-black/50"></div>
    <div class="modal-panel relative z-10 w-full max-w-sm rounded-2xl bg-white shadow-2xl max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4">
            <h2 class="text-xl font-bold text-gray-900">Konfirmasi Pelunasan Denda</h2>
            <button type="button" class="text-gray-400 hover:text-gray-700" data-close="paid">✕</button>
        </div>

        <form id="paidForm" method="POST" class="space-y-4 px-6 py-5">
            @csrf
            <div class="rounded-lg bg-emerald-50 p-4 text-sm text-emerald-900">
                <p><span class="font-semibold">Peminjam:</span> <span id="paidBorrowerLabel">-</span></p>
                <p><span class="font-semibold">Total Denda:</span> <span id="paidFineLabel">Rp 0</span></p>
            </div>

            <p class="text-sm text-gray-600">Setelah dikonfirmasi, status denda akan berubah dari belum lunas menjadi lunas.</p>

            <div class="flex items-center justify-end gap-3 border-t border-gray-200 pt-4">
                <button type="button" class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100" data-close="paid">
                    Batal
                </button>
                <button type="submit" id="paidConfirmBtn" class="relative inline-flex items-center rounded-lg bg-emerald-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-emerald-700 transition">
                    <svg id="paidLoadingIcon" class="mr-2 hidden h-4 w-4 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                    </svg>
                    <span id="paidConfirmLabel">Yakin, Tandai Lunas</span>
                    <svg id="paidSuccessCheck" class="absolute left-1/2 h-5 w-5 -translate-x-1/2 text-white opacity-0" style="bottom: 3px;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                    </svg>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    const dailyFine = Number(@json($dailyFine));
    const returnUrlTemplate = @json(url('/petugas/borrowings/__ID__/returned'));
    const paidUrlTemplate = @json(url('/petugas/borrowings/__ID__/mark-paid'));
    const modalTransitionMs = 300;

    const returnModal = document.getElementById('returnModal');
    const paidModal = document.getElementById('paidModal');

    const returnForm = document.getElementById('returnForm');
    const paidForm = document.getElementById('paidForm');

    const returnedDateInput = document.getElementById('returned_date');
    const returnConditionInput = document.getElementById('return_condition');
    const damageFineGroup = document.getElementById('damageFineGroup');
    const damageFineInput = document.getElementById('damage_fine');
    const returnDueDateInput = document.getElementById('returnDueDate');

    function formatRupiah(value) {
        return 'Rp ' + new Intl.NumberFormat('id-ID').format(Number(value || 0));
    }

    function showModal(modalElement) {
        modalElement.classList.remove('hidden');
        modalElement.classList.add('flex');
        requestAnimationFrame(() => {
            modalElement.querySelector('.modal-backdrop').classList.add('show');
            modalElement.querySelector('.modal-panel').classList.add('show');
        });
    }

    function hideModal(modalElement, callback = null) {
        modalElement.querySelector('.modal-backdrop').classList.remove('show');
        modalElement.querySelector('.modal-panel').classList.remove('show');

        setTimeout(() => {
            modalElement.classList.remove('flex');
            modalElement.classList.add('hidden');
            if (typeof callback === 'function') {
                callback();
            }
        }, modalTransitionMs);
    }

    function updateFinePreview() {
        const dueDateRaw = returnDueDateInput.value;
        const returnedDateRaw = returnedDateInput.value;
        const condition = returnConditionInput.value;
        const damageFine = condition === 'baik' ? 0 : Number(damageFineInput.value || 0);

        if (!dueDateRaw || !returnedDateRaw) {
            return;
        }

        const dueDate = new Date(dueDateRaw + 'T00:00:00');
        const returnedDate = new Date(returnedDateRaw + 'T00:00:00');
        const diffMs = returnedDate.getTime() - dueDate.getTime();
        const lateDays = diffMs > 0 ? Math.floor(diffMs / 86400000) : 0;
        const lateFine = lateDays * dailyFine;
        const totalFine = lateFine + damageFine;

        document.getElementById('previewLateDays').textContent = lateDays + ' hari';
        document.getElementById('previewLateFine').textContent = formatRupiah(lateFine);
        document.getElementById('previewDamageFine').textContent = formatRupiah(damageFine);
        document.getElementById('previewTotalFine').textContent = formatRupiah(totalFine);
    }

    function toggleDamageFineInput() {
        const notGoodCondition = returnConditionInput.value !== 'baik';
        damageFineGroup.classList.toggle('hidden', !notGoodCondition);
        damageFineInput.required = notGoodCondition;

        if (!notGoodCondition) {
            damageFineInput.value = 0;
        }

        updateFinePreview();
    }

    document.querySelectorAll('.open-return-modal').forEach((button) => {
        button.addEventListener('click', () => {
            const borrowingId = button.dataset.borrowingId;
            const userName = button.dataset.userName;
            const bookName = button.dataset.bookName;
            const dueDate = button.dataset.endDate;
            const dueDateLabel = button.dataset.endDateLabel;

            returnForm.action = returnUrlTemplate.replace('__ID__', borrowingId);
            document.getElementById('returnBorrowerLabel').textContent = userName;
            document.getElementById('returnBookLabel').textContent = bookName;
            document.getElementById('returnDueDateLabel').textContent = dueDateLabel;
            returnDueDateInput.value = dueDate;

            returnedDateInput.value = new Date().toISOString().split('T')[0];
            returnConditionInput.value = 'baik';
            damageFineInput.value = 0;
            document.getElementById('return_note').value = '';

            toggleDamageFineInput();
            showModal(returnModal);
        });
    });

    document.querySelectorAll('.open-paid-modal').forEach((button) => {
        button.addEventListener('click', () => {
            const borrowingId = button.dataset.borrowingId;
            const userName = button.dataset.userName;
            const totalFine = Number(button.dataset.totalFine || 0);

            paidForm.action = paidUrlTemplate.replace('__ID__', borrowingId);
            document.getElementById('paidBorrowerLabel').textContent = userName;
            document.getElementById('paidFineLabel').textContent = formatRupiah(totalFine);

            showModal(paidModal);
        });
    });

    document.querySelectorAll('[data-close="return"]').forEach((button) => {
        button.addEventListener('click', () => hideModal(returnModal));
    });

    document.querySelectorAll('[data-close="paid"]').forEach((button) => {
        button.addEventListener('click', () => hideModal(paidModal));
    });

    returnModal.querySelector('.modal-backdrop').addEventListener('click', () => hideModal(returnModal));
    paidModal.querySelector('.modal-backdrop').addEventListener('click', () => hideModal(paidModal));

    returnedDateInput.addEventListener('change', updateFinePreview);
    returnConditionInput.addEventListener('change', toggleDamageFineInput);
    damageFineInput.addEventListener('input', updateFinePreview);

    let returnSubmitting = false;
    returnForm.addEventListener('submit', (event) => {
        event.preventDefault();

        if (returnSubmitting || !returnForm.reportValidity()) {
            return;
        }

        returnSubmitting = true;

        const submitButton = document.getElementById('returnConfirmBtn');
        const loadingIcon = document.getElementById('returnLoadingIcon');
        const label = document.getElementById('returnConfirmLabel');

        submitButton.disabled = true;
        submitButton.classList.add('cursor-not-allowed', 'opacity-70');
        loadingIcon.classList.remove('hidden');
        label.textContent = 'Memproses...';

        setTimeout(() => {
            loadingIcon.classList.add('hidden');
            label.textContent = 'Berhasil';
            submitButton.classList.add('spark-run');

            setTimeout(() => {
                hideModal(returnModal, () => {
                    HTMLFormElement.prototype.submit.call(returnForm);
                });
            }, 700);
        }, 3000);
    });

    let paidSubmitting = false;
    paidForm.addEventListener('submit', (event) => {
        event.preventDefault();

        if (paidSubmitting) {
            return;
        }

        paidSubmitting = true;

        const submitButton = document.getElementById('paidConfirmBtn');
        const loadingIcon = document.getElementById('paidLoadingIcon');
        const label = document.getElementById('paidConfirmLabel');
        const successCheck = document.getElementById('paidSuccessCheck');

        submitButton.disabled = true;
        submitButton.classList.add('cursor-not-allowed', 'opacity-70');
        loadingIcon.classList.remove('hidden');
        label.textContent = 'Memproses...';

        setTimeout(() => {
            loadingIcon.classList.add('hidden');
            label.textContent = 'Berhasil';
            successCheck.classList.add('check-rise');

            setTimeout(() => {
                hideModal(paidModal, () => {
                    HTMLFormElement.prototype.submit.call(paidForm);
                });
            }, 700);
        }, 3000);
    });
</script>
@endsection
