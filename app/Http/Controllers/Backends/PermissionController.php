<?php

namespace App\Http\Controllers\Backends;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class PermissionController extends Controller
{
    public function index(){
       $data['permissions'] = DB::table('permissions')->get();
        return view('backends.permissions.index',$data);
    }
    public function create(){
        return view('backends.permissions.create');
    }
    public function store(Request $r){
        $r->validate([
            'name' => 'required|string|max:255',
            'key' => 'required|string|max:255',
        ]);

        $i = DB::table('permissions')->insert([
            'name' => $r->name,
            'key' => $r->key,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        if($i == true) {
            return redirect()->route('permissions.index')->with(['status' => 'success', 'sms'=> 'Permission created successfully.']);
        } else {
            return redirect()->back()->with(['status' => 'error', 'sms'=> 'Failed to create permission.']);
        }
    }
    public function edit(string $id){
        $data['permission'] = DB::table('permissions')->find($id);
        return view('backends.permissions.edit', $data);
    }
    public function update(Request $r, string $id){
        $r->validate([
            'name' => 'required|string|max:255',
            'key' => 'required|string|max:255',
        ]);

        $i = DB::table('permissions')->where('id', $id)->update([
            'name' => $r->name,
            'key' => $r->key,
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        if($i == true) {
            return redirect()->route('permissions.index')->with(['status' => 'success', 'sms'=> 'Permission updated successfully.']);
        } else {
            return redirect()->back()->with(['status' => 'error', 'sms'=> 'Failed to update permission.']);
        }
    }
    public function delete(string $id){
        $i = DB::table('permissions')->where('id', $id)->delete();
        if($i == true) {
            return redirect()->route('permissions.index')->with(['status' => 'success', 'sms'=> 'Permission deleted successfully.']);
        } else {
            return redirect()->back()->with(['status' => 'error', 'sms'=> 'Failed to delete permission.']);
        }
    }
}
