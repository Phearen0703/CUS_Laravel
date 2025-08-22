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
    public function index(Request $request)
    {
        $query = Book::with(['category', 'createdBy', 'updatedBy', 'deletedBy'])
            ->leftJoin('users as creator', 'books.created_by', '=', 'creator.id')
            ->leftJoin('users as updater', 'books.updated_by', '=', 'updater.id')
            ->leftJoin('users as deleter', 'books.deleted_by', '=', 'deleter.id')
            ->leftJoin('categorys as category', 'books.category_id', '=', 'category.id')
            ->select(
                'books.*',
                'creator.name as created_by_name',
                'updater.name as updated_by_name',
                'category.name as category'
            );

        // 🔍 Search by code or title
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('books.title', 'like', '%' . $search . '%')
                ->orWhere('books.code', 'like', '%' . $search . '%');
            });
        }

        // 📂 Filter by type (book / ebook)
        if ($request->filled('type')) {
            if ($request->type == 'book') {
                $query->whereNotNull('books.image');
            } elseif ($request->type == 'ebook') {
                $query->whereNotNull('books.pdf');
            }
        }

        // Pagination
        $books = $query->orderBy('books.id', 'desc')->paginate(10);
        $books->appends($request->all()); // Keep filters on pagination links

        return view('backends.books.index', compact('books'));
    }

    public function show($id)
    {
        $book = Book::with(['category', 'createdBy', 'updatedBy', 'deletedBy'])
            ->findOrFail($id);

        return view('backends.books.show', compact('book'));
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
            'title'          => 'required|string|max:255',
            'author'         => 'required|string|max:255',
            'publisher'      => 'required|string|max:255',
            'published_date' => 'required|date',
            'category_id'    => 'required|exists:categorys,id',
            'image'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'pdf'            => 'nullable|mimes:pdf|max:20480', // 20MB max
        ]);

        /** --------- Book Code (B001, B002, ...) --------- */
        $lastBook = Book::orderBy('id', 'desc')->first();
        if ($lastBook && preg_match('/^B(\d+)$/', $lastBook->code, $matches)) {
            $nextBookId = (int) $matches[1] + 1;
        } else {
            $nextBookId = 1;
        }
        $code = 'B' . str_pad($nextBookId, 3, '0', STR_PAD_LEFT);

        /** --------- Ebook Code (E001, E002, ...) --------- */
        $ebook = null;
        if ($request->hasFile('pdf')) {
            $lastEbook = Book::whereNotNull('ebook')->orderBy('id', 'desc')->first();
            if ($lastEbook && preg_match('/^E(\d+)$/', $lastEbook->ebook, $matches)) {
                $nextEbookId = (int) $matches[1] + 1;
            } else {
                $nextEbookId = 1;
            }
            $ebook = 'E' . str_pad($nextEbookId, 3, '0', STR_PAD_LEFT);
        }

        /** --------- Handle Image Upload --------- */
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image      = $request->file('image');
            $imageName  = $code . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/books'), $imageName);
            $imagePath = 'images/books/' . $imageName;
        }

        /** --------- Handle PDF Upload --------- */
        $pdfPath = null;
        if ($request->hasFile('pdf')) {
            $pdf      = $request->file('pdf');
            $pdfName  = $code . '.' . $pdf->getClientOriginalExtension();
            $pdf->move(public_path('pdf/books'), $pdfName);
            $pdfPath = 'pdf/books/' . $pdfName;
        }

        /** --------- Save Book --------- */
        $book = Book::create([
            'code'          => $code,
            'ebook'         => $ebook,
            'title'         => $request->title,
            'author'        => $request->author,
            'publisher'     => $request->publisher,
            'published_date'=> $request->published_date,
            'description'   => $request->description,
            'image'         => $imagePath,
            'pdf'           => $pdfPath,
            'category_id'   => $request->category_id,
            'created_by'    => auth()->id(),
        ]);

        return redirect()
            ->route('books.index')
            ->with([
                'status' => $book ? 'success' : 'error',
                'sms'    => $book ? 'Book created successfully.' : 'Failed to create book.'
            ]);
    }


    public function edit($id)
    {
        $book = Book::with(['category'])->findOrFail($id);
        $categories = Category::all();

        
        return view('backends.books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title'          => 'required|string|max:255',
            'author'         => 'required|string|max:255',
            'publisher'      => 'required|string|max:255',
            'published_date' => 'required|date',
            'category_id'    => 'required|exists:categorys,id',
            'image'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'pdf'            => 'nullable|mimes:pdf|max:20480', // 20MB max
        ]);

        $book = Book::findOrFail($id);

        /** --------- Handle Image Upload --------- */
        if ($request->hasFile('image')) {
            $image      = $request->file('image');
            $imageName  = $book->code . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/books'), $imageName);
            $book->image = 'images/books/' . $imageName;
        }

        /** --------- Handle Clear PDF --------- */
        if ($request->has('clear_pdf') && $request->clear_pdf == 1) {
            if ($book->pdf && file_exists(public_path($book->pdf))) {
                unlink(public_path($book->pdf));
            }
            $book->pdf = null;
            $book->ebook = null; // optional reset ebook code if no PDF
        }

        /** --------- Handle PDF Upload --------- */
        if ($request->hasFile('pdf')) {
            $pdf      = $request->file('pdf');
            $pdfName  = $book->code . '.' . $pdf->getClientOriginalExtension();
            $pdf->move(public_path('pdf/books'), $pdfName);
            $book->pdf = 'pdf/books/' . $pdfName;

            // Assign ebook code if missing
            if (!$book->ebook) {
                $lastEbook = Book::whereNotNull('ebook')
                    ->orderBy('id', 'desc')
                    ->first();

                if ($lastEbook && preg_match('/^E(\d+)$/', $lastEbook->ebook, $matches)) {
                    $nextId = (int)$matches[1] + 1;
                } else {
                    $nextId = 1;
                }

                $book->ebook = 'E' . str_pad($nextId, 3, '0', STR_PAD_LEFT);
            }
        }

        /** --------- Update Book Details --------- */
        $book->title          = $request->title;
        $book->author         = $request->author;
        $book->publisher      = $request->publisher;
        $book->published_date = $request->published_date;
        $book->description    = $request->description;
        $book->category_id    = $request->category_id;
        $book->updated_by     = auth()->id();

        if ($book->save()) {
            return redirect()
                ->route('books.index')
                ->with(['status'=>'success', 'sms'=>'Book updated successfully.']);
        } else {
            return redirect()
                ->route('books.index')
                ->with(['status'=>'error', 'sms'=>'Failed to update book.']);
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
