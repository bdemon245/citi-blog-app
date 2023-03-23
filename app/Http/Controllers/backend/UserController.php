<?php

namespace App\Http\Controllers\backend;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read user', [
            'only' => ['index', 'show']
        ]);
        $this->middleware('permission:create user',   [
            'only' => ['create', 'store']
        ]);
        $this->middleware('permission:update user',   [
            'only' => ['update', 'edit']
        ]);
        $this->middleware('permission:delete user',  [
            'only' => ['destroy']
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('roles')->get();
        $roles = Role::get();
        return view('backend.users.addUsers', compact('roles', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'min:6'],
            'role' => ['required'],
        ]);
        $avatar = "https://api.dicebear.com/5.x/bottts/svg?seed=$request->name&scale=80&radius=50";
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'avatar' => $avatar,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole($request->role);
        return back(201)->with('success', 'new user created');
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

    public function toggleBan(User $user)
    {
        $toggle = !$user->status;
        $msg = 'user is banned';//default msg
        $user->status = $toggle;
        $user->update();
        if ($toggle) {
            $msg = 'user is unbanned'; //msg if user is unbanned
        }
        return back()->with('success', $msg);
    }
}
