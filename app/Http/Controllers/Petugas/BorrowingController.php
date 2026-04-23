<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BorrowingController extends Controller
{
    private const DEFAULT_DAILY_FINE = 5000;

    private function getDailyFine(): int
    {
        return (int) config('app.borrowing_daily_fine', self::DEFAULT_DAILY_FINE);
    }

    public function index()
    {
        $borrowings = Borrowing::with(['user', 'book'])
            ->where('status', 'pending')
            ->orderByDesc('created_at')
            ->paginate(10);
        return view('petugas.borrowings.index', compact('borrowings'));
    }

    public function approve(Request $request, $id)
    {
        $borrowing = Borrowing::findOrFail($id);

        if ($borrowing->status !== 'pending') {
            return back()->withErrors('Hanya peminjaman pending yang dapat disetujui');
        }

        $book = $borrowing->book;
        if ($book->qty_available < $borrowing->qty) {
            return back()->withErrors('Stok buku tidak cukup');
        }

        $borrowing->update([
            'status' => 'approved',
            'approved_by' => Auth::id(),
        ]);

        $book->update([
            'qty_available' => $book->qty_available - $borrowing->qty,
        ]);

        $this->logActivity(Auth::user(), "Menyetujui peminjaman dari {$borrowing->user->name}");

        return redirect()->route('petugas.borrowings.index')->with('success', 'Peminjaman berhasil disetujui');
    }

    public function monitoringReturns()
    {
        $borrowings = Borrowing::with(['user', 'book'])
            ->where(function ($query) {
                $query->where('status', 'approved')
                    ->orWhere(function ($returnedQuery) {
                        $returnedQuery->where('status', 'returned')
                            ->where('fine_status', 'belum_lunas');
                    });
            })
            ->orderByRaw("CASE WHEN status = 'approved' THEN 0 ELSE 1 END")
            ->orderBy('end_date')
            ->paginate(10);

        $dailyFine = $this->getDailyFine();

        return view('petugas.borrowings.monitoring', compact('borrowings', 'dailyFine'));
    }

    public function markReturned(Request $request, $id)
    {
        $borrowing = Borrowing::findOrFail($id);

        if ($borrowing->status !== 'approved') {
            return back()->withErrors('Hanya peminjaman yang sudah disetujui yang dapat ditandai sebagai dikembalikan');
        }

        $validated = $request->validate([
            'returned_date' => 'required|date',
            'return_condition' => 'required|in:baik,rusak_ringan,rusak_berat,hilang,lainnya',
            'damage_fine' => 'nullable|integer|min:0|required_unless:return_condition,baik',
            'return_note' => 'nullable|string|max:1000',
        ]);

        $returnedAt = Carbon::parse($validated['returned_date'])->setTimeFrom(now());
        $dueDate = $borrowing->end_date instanceof Carbon
            ? $borrowing->end_date->copy()->startOfDay()
            : Carbon::parse($borrowing->end_date)->startOfDay();
        $returnDate = $returnedAt->copy()->startOfDay();

        $lateDays = $returnDate->greaterThan($dueDate) ? $dueDate->diffInDays($returnDate) : 0;
        $dailyFine = $this->getDailyFine();
        $lateFine = $lateDays * $dailyFine;
        $damageFine = $validated['return_condition'] === 'baik' ? 0 : (int) $validated['damage_fine'];
        $totalFine = $lateFine + $damageFine;
        $fineStatus = $totalFine > 0 ? 'belum_lunas' : 'lunas';

        $borrowing->update([
            'status' => 'returned',
            'returned_at' => $returnedAt,
            'actual_return_date' => $returnedAt->toDateString(),
            'return_condition' => $validated['return_condition'],
            'return_note' => $validated['return_note'] ?? null,
            'late_days' => $lateDays,
            'daily_late_fee' => $dailyFine,
            'late_fine' => $lateFine,
            'damage_fine' => $damageFine,
            'total_fine' => $totalFine,
            'fine_status' => $fineStatus,
            'fine_paid_at' => $fineStatus === 'lunas' ? now() : null,
        ]);

        $book = $borrowing->book;
        $book->update([
            'qty_available' => $book->qty_available + $borrowing->qty,
        ]);

        $this->logActivity(
            Auth::user(),
            "Mencatat pengembalian alat dari {$borrowing->user->name} dengan total denda Rp " . number_format($totalFine, 0, ',', '.')
        );

        return redirect()->route('petugas.borrowings.monitoring')->with('success', 'Pengembalian berhasil dicatat');
    }

    public function markFinePaid(Request $request, $id)
    {
        $borrowing = Borrowing::with('user')->findOrFail($id);

        if ($borrowing->status !== 'returned') {
            return back()->withErrors('Status peminjaman belum dikembalikan');
        }

        if ($borrowing->total_fine <= 0) {
            return back()->withErrors('Peminjaman ini tidak memiliki denda');
        }

        if ($borrowing->fine_status === 'lunas') {
            return back()->withErrors('Denda sudah berstatus lunas');
        }

        $borrowing->update([
            'fine_status' => 'lunas',
            'fine_paid_at' => now(),
        ]);

        $this->logActivity(
            Auth::user(),
            "Menandai denda peminjaman {$borrowing->id} milik {$borrowing->user->name} sebagai lunas"
        );

        return redirect()->route('petugas.borrowings.monitoring')->with('success', 'Status denda berhasil diubah menjadi lunas');
    }

    public function report()
    {
        $borrowings = Borrowing::with(['user', 'book', 'approver'])
            ->orderByDesc('created_at')
            ->get();

        return view('petugas.reports.borrowings', compact('borrowings'));
    }

    private function logActivity($user, $action)
    {
        \App\Models\ActivityLog::create([
            'user_id' => $user->id,
            'action' => $action,
            'ip' => request()->ip(),
        ]);
    }
}
