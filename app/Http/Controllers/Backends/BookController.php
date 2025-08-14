<?php

namespace App\Http\Controllers\Backends;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // All methods in this controller are protected
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::with(['category', 'createdBy', 'updatedBy', 'deletedBy'])
            ->leftJoin('users as creator', 'books.created_by', '=', 'creator.id')
            ->leftJoin('users as updater', 'books.updated_by', '=', 'updater.id')
            ->leftJoin('users as deleter', 'books.deleted_by', '=', 'deleter.id')
            ->leftJoin('categorys as category', 'books.category_id', '=', 'category.id')
            ->select(
                'books.*',
                'creator.name as created_by_name',
                'updater.name as updated_by_name',
                'category.name as category'
            )
            ->get();

           

        return view('backends.books.index',compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('backends.books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'published_date' => 'required|date',
            'category_id' => 'required|exists:categorys,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'pdf' => 'nullable|mimes:pdf|max:20480', // 20MB max
        ]);

        // Auto-generate code: B001, B002, etc.
        $lastBook = Book::orderBy('id', 'desc')->first();
        if ($lastBook && preg_match('/^B(\d+)$/', $lastBook->code, $matches)) {
            $nextId = (int)$matches[1] + 1;
        } else {
            $nextId = 1;
        }
        $code = 'B' . str_pad($nextId, 3, '0', STR_PAD_LEFT);

        // Handle image upload
        $imagePath = $request->hasFile('image')
            ? $request->file('image')->store('images', 'public')
            : null;

        // Handle PDF upload
        if ($request->hasFile('pdf')) {
            $pdfPath = $request->file('pdf')->store('pdfs', 'public');
            $ebook = $pdfPath; // or you could use basename($pdfPath)
        } else {
            $pdfPath = null;
            $ebook = null;
        }

        // Save book
        $book = Book::create([
            'code' => $code,
            'ebook' => $ebook,
            'title' => $request->title,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'published_date' => $request->published_date,
            'description' => $request->description,
            'image' => $imagePath,
            'pdf' => $pdfPath,
            'category_id' => $request->category_id,
            'created_by' => auth()->id(),
        ]);

        if ($book) {
            return redirect()->route('books.index')->with('success', 'Book created successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to create book.');
        }
    }

    public function delete($id)
    {
        $book = Book::findOrFail($id);
        $book->deleted_by = auth()->id();
        $book->saveQuietly();

        if ($book->delete()) {
            return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete book.');
        }
    }

}
