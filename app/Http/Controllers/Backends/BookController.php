<?php

namespace App\Http\Controllers\Backends;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        // Logic to list books
        return view('backends.books.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Logic to show book creation form
    }

    // Other methods like store, edit, update, delete, etc. would go here
}
