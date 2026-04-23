<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function borrowing(Request $request)
    {
        $borrowings = Borrowing::with(['user', 'book', 'approver'])
            ->orderByDesc('created_at')
            ->get();

        return view('admin.reports.borrowing', compact('borrowings'));
    }
}