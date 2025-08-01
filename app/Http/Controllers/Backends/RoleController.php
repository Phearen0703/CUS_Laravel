<?php

namespace App\Http\Controllers\Backends;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = DB::table('roles')->get();
        return view('backends.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backends.roles.create');
    }

    public function store(Request $r)
    {
        $r->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $i = DB::table('roles')->insert([
            'name' => $r->name,
            'description' => $r->description,
            'created_at' => date('Y-m-d H:i:s'),

        ]);
        if($i== true) {
            return redirect()->route('roles.index')->with(['status' => 'success', 'sms'=> 'Role created successfully.']);
        } else {
            return redirect()->back()->with(['status' => 'error', 'sms'=> 'Failed to create role.']);
        }

    }

   
    public function edit(string $id)
    {
       
       $data['role']= DB::table('roles')->find($id);
      
        return view('backends.roles.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $i = DB::table('roles')->where('id', $id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        if($i) {
            return redirect()->route('roles.index')->with(['status' => 'success', 'sms'=> 'Role updated successfully.']);
        } else {
            return redirect()->back()->with(['status' => 'error', 'sms'=> 'Failed to update role.']);
        }
    }

}
