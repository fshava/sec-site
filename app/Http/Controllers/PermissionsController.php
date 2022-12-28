<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Admin/Permissions/Index', ['permissions'=>Permission::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Permissions/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        Permission::create(['name' => $request->name]);
        return Redirect::route('permissions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        return Inertia::render('Admin/Permissions/Edit', ['permission'=>$permission]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        // dd($permission);
        $request->validate(['name' => 'required|unique:permissions,name,'.$permission->id]);
        $permission->update($request->only('name'));
        // dd($permission);
        return Redirect::route('permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        // dd($permission);
        $permission->delete();
        $permissions = Permission::all();
        // return Redirect::route('permissions.index');
        return Inertia::render('Admin/Permissions/Index', ['permissions'=>$permissions]);
    }
}
