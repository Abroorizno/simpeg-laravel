<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    public function index()
    {
        $title = 'User Roles';
        $user_role = UserRole::with('users', 'roles')->get();
        $roles = Role::orderBy('id', 'desc')->get();
        $users = User::orderBy('id', 'desc')->get();


        return view('dashboard.user_role', compact('title', 'user_role', 'users', 'roles'));
    }

    public function store(Request $request)
    {
        $data = [
            'user_id' => $request->user,
            'role_id' => $request->role
        ];

        UserRole::create($data);
        return redirect()->route('user_role.index')->with('success', 'User role assigned successfully.');
    }

    public function update(Request $request, string $id)
    {
        $user_role = UserRole::findOrFail($id);

        $data = [
            'user_id' => $request->user,
            'role_id' => $request->role
        ];

        $user_role->update($data);
        return redirect()->route('user_role.index')->with('success', 'User role updated successfully.');
    }

    public function destroy(string $id)
    {
        $user_role = UserRole::findOrFail($id);
        $user_role->delete();

        return redirect()->route('user_role.index')->with('success', 'User role deleted successfully.');
    }
}
