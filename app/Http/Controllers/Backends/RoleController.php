<?php

namespace App\Http\Controllers\Backends;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class RoleController extends Controller
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
        $roles = DB::table('roles')
        ->where('id', '!=', auth()->user()->role_id == 1 ? null : 1)->get();
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

    public function delete(string $id)
    {
        $find = DB::table('users')->where('id', $id)->exists();
        if($find){
            return redirect()->route('roles.index')->with(['status' => 'error', 'sms'=> 'This role cannot be deleted because it is assigned to one or more users.']);
        }

        $d = DB::table('roles')->where('id', $id)->delete();
        if($d) {
            return redirect()->route('roles.index')->with(['status' => 'success', 'sms'=> 'Role deleted successfully.']);
        } else {
            return redirect()->route('roles.index')->with(['status' => 'error', 'sms'=> 'Failed to delete role.']);
        }
    }

    public function permissions($id)
    {

        $data['role_permission'] = DB::table('permissions') // fixed table name
            ->leftJoinSub(
                DB::table('role_permission')->where('role_id', $id), 't1', function ($join) {
                    $join->on('permissions.id', '=', 't1.permission_id'); // fixed table name
                }
            )
            ->select(
                'permissions.*',
                DB::raw('IFNULL(t1.list, 0) as list'),
                DB::raw('IFNULL(t1.`insert`, 0) as `store`'),
                DB::raw('IFNULL(t1.update, 0) as edit'),
                DB::raw('IFNULL(t1.`delete`, 0) as `remove`'),
                DB::raw('IFNULL(t1.id, 0) as role_permission_id')
            )
            ->get();
            $data['id'] = $id;


        return view('backends.roles.permissions.index', $data);
        
    }

    public function permissionsUpdate(Request $r, $roleId)
{
    $permissionType = $r->permission;
    $permissionValue = $r->role_permission_value;
    $permissionId = $r->permission_id;

    $columnsMap = [
        'list' => 'list',
        'edit' => 'update',
        'store' => 'insert',
        'remove' => 'delete'
    ];

    // Ensure the permission type is a valid column
    $column = $columnsMap[$permissionType] ?? null;

    if (!$column) {
        return redirect()->back()->with(['status' => 'error', 'sms' => 'Invalid permission type.']);
    }

    try {
        // Find the existing record or create a new one if it doesn't exist
        $permissionRecord = DB::table('role_permission')
            ->where('role_id', $roleId)
            ->where('permission_id', $permissionId)
            ->first();

        if ($permissionRecord) {
            // Update the existing record's specific column
            DB::table('role_permission')
                ->where('id', $permissionRecord->id)
                ->update([
                    $column => $permissionValue,
                    'updated_at' => now(), // Use now() for timestamps
                ]);
        } else {
            // No record exists, so create a new one with the given permission
            DB::table('role_permission')->insert([
                'role_id' => $roleId,
                'permission_id' => $permissionId,
                $column => $permissionValue,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()->route('roles.permissions', ['id' => $roleId])
            ->with(['status' => 'success', 'sms' => 'Update Successful.']);

    } catch (\Exception $e) {
        return redirect()->route('roles.permissions', ['id' => $roleId])
            ->with(['status' => 'error', 'sms' => 'Update Failed.']);
    }
}



}
