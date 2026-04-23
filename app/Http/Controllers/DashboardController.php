<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Borrowing;
use App\Models\Book;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Jika user tidak memiliki role, beri role peminjam default
        if (!$user->isAdmin() && !$user->isPetugas() && !$user->isPeminjam()) {
            $peminjamRole = \App\Models\Role::firstOrCreate(['name' => 'peminjam'], ['label' => 'Peminjam']);
            $user->roles()->attach($peminjamRole->id);
            $user->refresh(); // Refresh untuk mendapatkan role baru
        }

        // Redirect berdasarkan role
        if ($user->isAdmin()) {
            return $this->adminDashboard();
        } elseif ($user->isPetugas()) {
            return $this->petugasDashboard();
        } elseif ($user->isPeminjam()) {
            return $this->peminjamDashboard();
        }

        return redirect('/');
    }

    private function adminDashboard()
    {
        $data = [
            'totalUsers' => User::count(),
            'totalBooks' => Book::count(),
            'totalBorrowings' => Borrowing::count(),
            'pendingBorrowings' => Borrowing::where('status', 'pending')->count(),
        ];

        return view('dashboard.admin', $data);
    }

    private function petugasDashboard()
    {
        $data = [
            'pendingBorrowings' => Borrowing::where('status', 'pending')->count(),
            'unreturned' => Borrowing::where('status', 'approved')->where('end_date', '<', today())->count(),
            'unpaidFines' => Borrowing::where('status', 'returned')->where('fine_status', 'belum_lunas')->count(),
            'unpaidFineAmount' => Borrowing::where('status', 'returned')->where('fine_status', 'belum_lunas')->sum('total_fine'),
        ];

        return view('dashboard.petugas', $data);
    }

    private function peminjamDashboard()
    {
        $user = Auth::user();
        $data = [
            'myBorrowings' => $user->borrowings()->count(),
            'pending' => $user->borrowings()->where('status', 'pending')->count(),
            'approved' => $user->borrowings()->where('status', 'approved')->count(),
        ];

        return view('dashboard.peminjam', $data);
    }
}
