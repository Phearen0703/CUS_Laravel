<?php

namespace App\Http\Controllers\Frontends;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class BookController extends Controller
{
    public function index()
    {
        $categories = Category::with('books')->get();
        
        return view('home',compact('categories'));
    }
}
