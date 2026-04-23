<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BookController extends Controller
{
    public function index()
    {
        $query = Book::with('category');

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

        $books = $query->paginate(10);
        return view('admin.books.index', compact('books'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn' => 'required|string|unique:books',
            'year_published' => 'required|integer|min:1000|max:' . date('Y'),
            'qty_total' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            ...$validated,
            'qty_available' => $validated['qty_total'],
        ];

        if ($request->hasFile('image')) {
            $imageName = Str::slug($validated['name']) . '.' . $request->file('image')->getClientOriginalExtension();
            $data['image'] = $request->file('image')->storeAs('book-images', $imageName, 'public');
        }

        Book::create($data);

        $this->logActivity(Auth::user(), "Membuat buku baru: {$validated['name']}");

        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil dibuat');
    }

    public function edit(Book $book)
    {
        $categories = Category::all();
        return view('admin.books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn' => 'required|string|unique:books,isbn,' . $book->id,
            'year_published' => 'required|integer|min:1000|max:' . date('Y'),
            'qty_total' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'delete_image' => 'nullable|boolean',
        ]);

        $data = $validated;

        // Handle delete existing image
        if ($request->input('delete_image')) {
            if ($book->image) {
                \Storage::disk('public')->delete($book->image);
            }
            $data['image'] = null;
        }

        // Handle upload new image
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($book->image) {
                \Storage::disk('public')->delete($book->image);
            }
            $imageName = Str::slug($validated['name']) . '.' . $request->file('image')->getClientOriginalExtension();
            $data['image'] = $request->file('image')->storeAs('book-images', $imageName, 'public');
        }

        $book->update($data);

        $this->logActivity(Auth::user(), "Mengubah data buku: {$book->name}");

        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil diperbarui');
    }

    public function destroy(Book $book)
    {
        // Delete associated image if exists
        if ($book->image) {
            \Storage::disk('public')->delete($book->image);
        }

        $this->logActivity(Auth::user(), "Menghapus buku: {$book->name}");
        $book->delete();

        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil dihapus');
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
