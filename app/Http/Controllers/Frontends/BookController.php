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
        // Eager load the category relationship to prevent the 500 error
        $book = Book::with('category')->findOrFail($id);

        return view('backends.books.book-modal', compact('book'));
    }
}
