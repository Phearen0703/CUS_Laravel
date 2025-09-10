<?php

namespace App\Http\Controllers\Frontends;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;

class BookController extends Controller
{
    // Home Page (all categories with limited books)
    public function index(Request $request)
    {
        $categories = Category::withCount('books')->get();
        $recentBooks = Book::latest()->take(5)->get();

        $query = Book::query();

        if ($request->filled('search')) {
            $s = $request->input('search');
            $query->where(function($q) use ($s) {
                $q->where('title', 'like', "%{$s}%")
                  ->orWhere('code', 'like', "%{$s}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->input('category'));
        }

        $books = $query->latest()->paginate(12)->withQueryString();

        return view('frontends.index', compact('categories', 'recentBooks', 'books'));
    }

    // 🔍 Search Page
    public function search(Request $request)
    {
        $query = $request->input('query');

        $books = Book::where('title', 'LIKE', "%{$query}%")
                    ->orWhere('code', 'LIKE', "%{$query}%")
                    ->paginate(10);

        $categories = Category::withCount('books')->get();
        $recentBooks = Book::latest()->take(5)->get(); // ✅ add this

        return view('frontends.index', compact('books', 'categories', 'recentBooks'))
            ->with('search', $query);
    }

    // 📂 Category Page
    public function category($id)
    {
        $category = Category::with('books')->findOrFail($id);

        $categories = Category::withCount('books')->get();
        $recentBooks = Book::latest()->take(5)->get(); // ✅ add this

        return view('frontends.category.show', compact('category', 'categories', 'recentBooks'));
    }

    // 📖 Book Modal
    public function showModal(string $id)
    {
        $book = Book::with('category')->findOrFail($id);
        return view('frontends.books.book-modal', compact('book'));
    }

    // 📑 View PDF
    public function viewPdf($id)
    {
        $book = Book::findOrFail($id);

        if (!$book->pdf) {
            return redirect()->back()->with('error', 'No PDF available for this book.');
        }

        $path = public_path('pdf/books/' . $book->pdf);

        if (!file_exists($path)) {
            return redirect()->back()->with('error', 'PDF file not found on server.');
        }

        return response()->file($path);
    }
}
