<?php

namespace App\Http\Controllers\Backends;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Validator;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data = DB::table('users')
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->select('users.*', 'roles.name as role_name')
            ->get();
   
        return view('backends.users.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $data['roles'] = DB::table('roles')->where('id','!=', auth()->user()->role_id == 1 ? null : 1)->get();
        $data['roles'] = DB::table('roles')->get();
        return view('backends.users.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $vilidator = validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'nullable|email|max:255|unique:users',
            'password' => 'required|min:8',
            'role_id' => 'required|numeric'

        ]);

  
        if($vilidator->fails()) {
            return redirect()->route('users.index')->with(['status'=>'error', 'data'=>$vilidator->errors()]);
        }
        $name = $request->name;
        $username = $request->username;
        $email = $request->email;
        $password = bcrypt($request->password);
        $role_id = $request->role_id;


        $i = DB::table('users')->insert([
            'name' => $name,
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'role_id' => $role_id,
            'created_at' => date('Y-m-d-H:i:s'),
            'photo' => $request->hasFile('photo') ? $request->file('photo')->store('images/photo','users') : null,
        ]);


        if($i == true) {
            return redirect()->route('users.index')->with(['status'=>'success', 'data'=>'User created successfully']);
        } else {
            return redirect()->route('users.index')->with(['status'=>'error', 'data'=>'User creation failed']);
        }
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
