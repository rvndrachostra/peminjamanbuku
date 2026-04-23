<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowingController extends Controller
{
    public function index()
    {
        $query = Book::with('category')->where('qty_available', '>', 0);

        if (request('search')) {
            $search = request('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('author', 'like', '%' . $search . '%')
                  ->orWhere('isbn', 'like', '%' . $search . '%')
                  ->orWhereHas('category', function ($q) use ($search) {
                      $q->where('name', 'like', '%' . $search . '%');
                  });
            });
        }

        $books = $query->paginate(12);
        return view('peminjam.books.index', compact('books'));
    }

    public function create(Book $book)
    {
        $book->load('category');
        return view('peminjam.borrowings.create', compact('book'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'book_id' => 'required|exists:books,id',
            'qty' => 'required|integer|min:1',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'note' => 'nullable|string',
        ]);

        $book = Book::findOrFail($validated['book_id']);
        if ($book->qty_available < $validated['qty']) {
            return back()->withErrors(['qty' => 'Stok buku tidak cukup. Tersedia: ' . $book->qty_available]);
        }

        Borrowing::create([
            'book_id' => $validated['book_id'],
            'user_id' => Auth::id(),
            'qty' => $validated['qty'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'note' => $validated['note'],
            'status' => 'pending',
        ]);

        return redirect()->route('peminjam.borrowings.index')->with('success', 'Permintaan peminjaman berhasil dibuat');
    }

    public function myBorrowings()
    {
        $borrowingQuery = Auth::user()->borrowings();

        $borrowings = (clone $borrowingQuery)
            ->with('book')
            ->orderByDesc('created_at')
            ->paginate(10);

        $unpaidFineCount = (clone $borrowingQuery)
            ->where('status', 'returned')
            ->where('fine_status', 'belum_lunas')
            ->count();

        $unpaidFineAmount = (clone $borrowingQuery)
            ->where('status', 'returned')
            ->where('fine_status', 'belum_lunas')
            ->sum('total_fine');

        return view('peminjam.borrowings.index', compact('borrowings', 'unpaidFineCount', 'unpaidFineAmount'));
    }

    public function return(Request $request, $id)
    {
        $borrowing = Borrowing::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($borrowing->status !== 'approved') {
            return back()->withErrors('Hanya peminjaman yang disetujui yang dapat dikembalikan');
        }

        $borrowing->update([
            'status' => 'returned',
            'returned_at' => now(),
        ]);

        return redirect()->route('peminjam.borrowings.index')->with('success', 'Alat berhasil dikembalikan');
    }
}
