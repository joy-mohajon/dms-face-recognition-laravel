<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Http\Requests\RoleRequest;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $roles = Role::orderBy('id', 'DESC')->paginate(10);
        return view('pages.role.index', compact('roles'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = collect(config('permissionList'))->groupBy('module_name');
        return view('pages.role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        try {
            $role = Role::create(['name' => $request->input('name')]);
            $role->syncPermissions($request->input('permissions'));
            return redirect()->route('roles.index')
            ->with('success', 'Role created successfully');
            // return redirect()->route('roles.index')->with('success', 'Added successfully!');
        } catch (\Exception $e) {
            return redirect()->route('roles.index')->with('error', 'Something went wrong!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = collect(config('permissionList'))->groupBy('module_name');
        $rolePermissions = $role->permissions()->pluck('name')->toArray();
        return view('pages.role.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, Role $role)
    {
        if (!blank($role)) {
            // try {
                $role->name = $request->input('name');
                $role->save();
                $role->syncPermissions($request->input('permissions'));
                return redirect()->route('roles.index')->with('success', 'Role updated successfully');
            // } catch (\Exception $e) {
            //     return redirect()->route('roles.index')->with('error', 'Something went wrong!');
            // }
        }
        return redirect()->route('roles.index')->with('error', 'Something went wrong!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        // session()->flash('success', 'Rule Successfully Deleted');
        return response()->json(['success' => true, 'status'=> 'Rule has been deleted.']);
    }
}
