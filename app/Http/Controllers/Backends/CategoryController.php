<?php

namespace App\Http\Controllers\Backends;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $data['categorys'] = Category::leftJoin(
            'users as creator', 
            'categorys.created_by', '=', 'creator.id'
        )
        ->leftJoin(
            'users as updater', 
            'categorys.updated_by', '=', 'updater.id'
        )
        ->select(
            'categorys.*', 
            'creator.name as created_by_name', 
            'updater.name as updated_by_name'
        )
        ->get();

        return view('backends.categorys.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backends.categorys.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $lastCategory = Category::orderBy('id', 'desc')->first();
        if ($lastCategory && preg_match('/^CAT(\d+)$/', $lastCategory->code, $matches)) {
            $nextId = (int)$matches[1] + 1;
        } else {
            $nextId = 1;
        }

        $code = 'CAT' . str_pad($nextId, 3, '0', STR_PAD_LEFT);

        $category = Category::create([
            'name'       => $request->name,
            'code'       => $code,
            'created_at' => now(),
            'created_by' => auth()->id(),
        ]);

        return redirect()
            ->route('categorys.index')
            ->with([
                'status' => $category ? 'success' : 'error',
                'sms'    => $category ? 'Category created successfully.' : 'Failed to create category.'
            ]);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('backends.categorys.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->updated_at = now();
        $category->updated_by = auth()->id();

        $updated = $category->save();
        
        return redirect()
            ->route('categorys.index')
            ->with([
                'status' => $updated ? 'success' : 'error',
                'sms'    => $updated ? 'Category updated successfully.' : 'Failed to update category.'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
        {
            $category = Category::findOrFail($id);
            $category->deleted_by = auth()->id();
            $category->save(); // Save deleted_by before delete
            
            $deleted = $category->delete(); // Soft delete

            return redirect()
                ->route('categorys.index')
                ->with([
                    'status' => $deleted ? 'success' : 'error',
                    'sms'    => $deleted
                        ? 'Category deleted successfully.'
                        : 'Failed to delete category.'
                ]);
        }

}
