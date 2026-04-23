<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\BorrowingController as AdminBorrowingController;
use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\ReportController as AdminReportController; // ✅ Diperbaiki
use App\Http\Controllers\Petugas\BorrowingController as PetugasBorrowingController;
use App\Http\Controllers\Peminjam\BorrowingController as PeminjamBorrowingController;

// Welcome Route
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Users
    Route::resource('users', AdminUserController::class);

    // Books
    Route::resource('books', AdminBookController::class);

    // Categories
    Route::resource('categories', AdminCategoryController::class);

    // Borrowings
    Route::resource('borrowings', AdminBorrowingController::class)->only(['index', 'edit', 'update', 'destroy']);

    // Activity Logs
    Route::get('activity-logs', [ActivityLogController::class, 'index'])->name('activity-logs.index');

    // Reports ✅ Tanpa prefix /admin lagi karena sudah di dalam group
    Route::get('reports/borrowing', [AdminReportController::class, 'borrowing'])->name('reports.borrowing');
});

// Petugas Routes
Route::middleware(['auth', 'petugas'])->prefix('petugas')->name('petugas.')->group(function () {
    Route::get('borrowings', [PetugasBorrowingController::class, 'index'])->name('borrowings.index');
    Route::post('borrowings/{id}/approve', [PetugasBorrowingController::class, 'approve'])->name('borrowings.approve');
    Route::get('borrowings/monitoring', [PetugasBorrowingController::class, 'monitoringReturns'])->name('borrowings.monitoring');
    Route::post('borrowings/{id}/returned', [PetugasBorrowingController::class, 'markReturned'])->name('borrowings.returned');
    Route::post('borrowings/{id}/mark-paid', [PetugasBorrowingController::class, 'markFinePaid'])->name('borrowings.mark-paid');
    Route::get('reports/borrowings', [PetugasBorrowingController::class, 'report'])->name('reports.borrowings');
});

// Peminjam Routes
Route::middleware(['auth', 'peminjam'])->prefix('peminjam')->name('peminjam.')->group(function () {
    Route::get('books', [PeminjamBorrowingController::class, 'index'])->name('books.index');
    Route::get('borrowing/{book}', [PeminjamBorrowingController::class, 'create'])->name('borrowing.create');
    Route::post('borrowing', [PeminjamBorrowingController::class, 'store'])->name('borrowing.store');
    Route::get('my-borrowings', [PeminjamBorrowingController::class, 'myBorrowings'])->name('borrowings.index');
    Route::post('return/{id}', [PeminjamBorrowingController::class, 'return'])->name('borrowing.return');
});