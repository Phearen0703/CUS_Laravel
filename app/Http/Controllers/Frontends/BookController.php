<?php

namespace App\Http\Controllers\Frontends;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;

class BookController extends Controller
{
    // Home Page (all categories with limited books)
    public function index()
    {
        $categories = Category::withCount('books')->get();
        $recentBooks = Book::latest()->take(5)->get();


    return view('frontends.index', compact('categories', 'recentBooks'));
    }


    // Category Page
    public function category($id)
    {
        $category = Category::with('books')->findOrFail($id);
        return view('frontends.category.show', compact('category'));
    }
    // Search books by title or code
    public function search(Request $request)
    {
        $query = $request->input('query');
        $categoryId = $request->input('category');

        $books = Book::query()
            ->when($query, function($q) use ($query) {
                $q->where('title', 'LIKE', "%{$query}%")
                ->orWhere('code', 'LIKE', "%{$query}%");
            })
            ->when($categoryId, function($q) use ($categoryId) {
                $q->where('category_id', $categoryId);
            })
            ->with('category')
            ->get();

        $categories = Category::withCount('books')->get();
        $recentBooks = Book::latest()->take(5)->get();

        return view('frontends.index', compact('books', 'categories', 'recentBooks', 'query', 'categoryId'));
    }





    // Book Modal
    public function showModal(string $id)
    {
        $book = Book::with('category')->findOrFail($id);

        // point to frontends folder instead of backends
        return view('frontends.books.book-modal', compact('book'));
    }
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
