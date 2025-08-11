<?php

namespace App\Http\Controllers\Backends;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Validator;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $data['users'] = DB::table('users')
        ->join('roles', 'roles.id', 'users.role_id');
        if(auth()->user()->role_id != 1){
            $data['users'] = $data['users']->where('roles.id', '!=', 1);
        }
        $data['users'] = $data['users']->select('users.*', 'roles.name as role_name')->paginate(10);


        return view('backends.users.index', $data);
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
            return redirect()->route('users.index')->with(['status'=>'error', 'sms'=>$vilidator->errors()]);
        }
        $name = $request->name;
        $username = $request->username;
        $email = $request->email ?? '' ;
        $password = bcrypt($request->password);
        $role_id = $request->role_id;


        $i = DB::table('users')->insert([
            'name' => $name,
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'role_id' => $role_id,
            'created_at' => date('Y-m-d-H:i:s'),
            'photo' => $request->hasFile('photo') ? $request->file('photo')->store('images/photo','custom') : null,
        ]);


        if($i == true) {
            return redirect()->route('users.index')->with(['status'=>'success', 'sms'=>'User created successfully']);
        } else {
            return redirect()->route('users.index')->with(['status'=>'error', 'sms'=>'User creation failed']);
        }
    }

    public function edit(string $id)
    {
        if(auth()->user()->role_id != 1 && auth()->user()->id != $id) {
            return redirect()->route('users.index')->with(['status'=>'error', 'sms'=>'You do not have permission to edit this user']);
        }
        $data['user'] = DB::table('users')->where('id', $id)->first();
        $data['roles'] = DB::table('roles')->get();
        if(!$data['user']) {
            return redirect()->route('users.index')->with(['status'=>'error', 'sms'=>'User not found']);
        }
        return view('backends.users.edit', $data);
        // --- IGNORE ---
        // return view('backends.users.edit', compact('data'));
        // --- IGNORE ---   
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $vilidation = validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,'.$id,
            'role_id' => 'required|numeric'
        ]);
        if($vilidation->fails()) {
            return redirect()->route('users.index')->with(['status'=>'error', 'sms'=>$vilidation->errors()]);
        }
        
        $data = [
            'name' => $request->name,
            'username' => $request->username,
            'role_id' => $request->role_id,
            'status' => $request->status,
            'email' => $request->email ?? '',
            
        ];

        $oldUser = DB::table('users')->find($id);
        if($oldUser->username != $request->username) {
            $find = DB::table('users')->where('username', $request->username)->first();
            if($find) {
                return redirect()->route('users.index')->with(['status'=>'error', 'sms'=>'Username already exists']);
            }
        }
        if($request->password){
            $vilidation = validator::make($request->all(), [
                'password' => 'min:8',
            ]);
            if($vilidation->fails()) {
                return redirect()->route('users.index')->with(['status'=>'error', 'sms'=>$vilidation->errors()]);
            }
            $data['password'] = bcrypt($request->password);
        }
        
        if($request->hasFile('photo')) {
            if(Storage::disk('custom')->exists($oldUser->photo)) {
                Storage::disk('custom')->delete($oldUser->photo);
            }
             $data['photo'] = $request->file('photo')->store('images/photo', 'custom');
        }

        $u = DB::table('users')->where('id', $id)->update($data);
        
        if($u == true) {
            return redirect()->route('users.index')->with(['status'=>'success', 'sms'=>'User updated successfully']);
        } else {
            return redirect()->route('users.index')->with(['status'=>'error', 'sms'=>'User update failed']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        
        $old = DB::table('users')->find($id);
        if(Storage::disk('custom')->exists($old->photo)) {
            Storage::disk('custom')->delete($old->photo);
        }
        
        $d = DB::table('users')->where('id', $id)->delete();
        
        if($d == true) {
          
            return redirect()->route('users.index')->with(['status'=>'success', 'sms'=>'User deleted successfully']);
        }else {
            return redirect()->route('users.index')->with(['status'=>'error', 'sms'=>'User deletion failed']);
        }
    }
}
