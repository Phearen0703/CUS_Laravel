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
        $categories = Category::with('books')->get();

    return view('frontends.index', compact('categories'));
    }


    // Category Page
    public function category($id)
    {
        $category = Category::with('books')->findOrFail($id);
        return view('frontends.category.show', compact('category'));
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
