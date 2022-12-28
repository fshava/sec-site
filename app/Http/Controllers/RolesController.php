<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Admin/Roles/Index', ['roles'=>Role::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::get();
        return Inertia::render('Admin/Roles/Create', ['permissions'=>$permissions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
        
        $role = Role::create(['name' => $request->get('name')]);
        $role->syncPermissions($request->get('permission'));
        return Redirect::route('roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $role = $role;
        $count = $role->permissions->count();
        $rolePermissions = $role->permissions;
        return Inertia::render('Admin/Roles/Show', ['rolePermissions'=>$rolePermissions, 'role'=>$role, 'count'=>$count]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $role = $role;
        $rolePermissions = $role->permissions->pluck('name')->toArray();
        $count = $role->permissions->count();
        $permissions = Permission::get();
        // dd(['role'=>$role, 
        // 'rolePermissions'=>$rolePermissions, 
        // 'permissions'=>$permissions]);
        return Inertia::render('Admin/Roles/Edit', [
            'role'=>$role, 
            'rolePermissions'=>$rolePermissions, 
            'permissions'=>$permissions,
            'count'=>$count
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);
        
        $role->update($request->only('name'));
    
        $role->syncPermissions($request->get('permission'));
        $rolePermissions = $role->permissions->pluck('name')->toArray();
        // dd($rolePermissions);
        return Redirect::route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return Redirect::route('roles.index');
    }
}
