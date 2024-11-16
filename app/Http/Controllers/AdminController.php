<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use function Laravel\Prompts\info;

class AdminController extends Controller
{
    public function manageRoles()
    {
        return view('admin.manage-roles');
    }

    public function createRole(Request $request)
    {
        Role::create([
            'name' => $request->name
        ]);

        return redirect()->route('admin.roles')->with('success', 'Role Created 😍!');
    }

    public function editRole(Request $request, $id)
    {
        Role::find($id)->update([
            'name' => $request->name
        ]);

        return redirect()->route('admin.roles')->with('success', 'Role Updated 😍!');
    }

    public function deleteRole($id)
    {
        Role::find($id)->delete();

        return redirect()->route('admin.roles')->with('success', 'Role Deleted 😍!');
    }

    public function manageUsers()
    {
        return view('admin.manage-users')->with('roles', Role::all());
    }

    public function createUser(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        $user->assignRole($request->role);

        return redirect()->route('admin.users')->with('success', 'User Created 😍!');
    }

    public function editUser(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'role' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        // Find the user by ID and update their details
        $user = User::findOrFail($id); // Use findOrFail to throw a 404 error if not found
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        
        $user->syncRoles([$request->role]); // This will remove all existing roles and assign the new one

        return redirect()->route('admin.users')->with('success', 'User Updated 😍!');
    }

    public function deleteUser($id)
    {
        $user = User::find($id)->delete();

        return redirect()->route('admin.users')->with('success', 'User Deleted 😍!');
    }
}
