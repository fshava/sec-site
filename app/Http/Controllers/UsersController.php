<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Redirect;

class UsersController extends Controller
{
    /**
     * Display all users
     * 
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $users = User::with('roles')->get();
        // $users = User::all();
        // dd($users);
        return Inertia::render('Admin/Users/Index', ['users'=>$users]);
    }

    /**
     * Show form for creating user
     * 
     * @return \Illuminate\Http\Response
     */
    public function create() 
    {
        return Inertia::render('Admin/Users/Create');
    }

    /**
     * Store a newly created user
     * 
     * @param User $user
     * @param StoreUserRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(User $user, StoreUserRequest $request) 
    {
        //For demo purposes only. When creating user or inviting a user
        // you should create a generated random password and email it to the user
        $user->create(array_merge($request->validated(), [
            'password' => 'test' 
        ]));

        return Redirect::route('users.index');
    }

    /**
     * Show user data
     * 
     * @param User $user
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(User $user) 
    {
        $roles = $user->getRoleNames();
        $count = $roles->count();
        return Inertia::render('Admin/Users/Show', ['user'=>$user, 'roles'=>$roles, 'count'=>$count]);
    }

    /**
     * Edit user data
     * 
     * @param User $user
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user) 
    {
        return Inertia::render('Admin/Users/Edit', [  
        'user' => $user,
        'userRoles' => $user->roles->pluck('name')->toArray(),
        'roles' => Role::latest()->get()
        ]);
    }

    /**
     * Update user data
     * 
     * @param User $user
     * @param UpdateUserRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, Request $request) 
    {
        // $user->update($request->validated());
        // dd($request->get('role'));
        $user->syncRoles($request->get('role'));

        return Redirect::route('users.index');
    }

    /**
     * Delete user data
     * 
     * @param User $user
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user) 
    {
        $user->delete();

        return Redirect::route('users.index');
    }
}
