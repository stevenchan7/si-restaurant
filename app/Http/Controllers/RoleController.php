<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        $users = User::with('roles')->get();
        return view('superadmin.roles.roles', compact('roles', 'users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles',
        ]);

        Role::create($validated);

        return redirect()->route('roles.index')->with('success', 'Role created successfully');
    }

    public function edit(Role $role)
    {
        return view('superadmin.roles.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
        ]);

        $role->update($validated);

        return redirect()->route('roles.index')->with('success', 'Role updated successfully');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully');
    }

    public function storeRole(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|exists:users,email',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id',
        ]);

        $user = User::where('email', $request->email)->first();
        $user->roles()->syncWithoutDetaching($validated['roles']);

        return redirect()->route('roles.index')->with('success', 'Roles assigned successfully');
    }

    public function removeUserRole(User $user, Role $role)
    {
        $user->roles()->detach($role->id);

        return redirect()->route('roles.index')->with('success', 'User role removed successfully');
    }

    // Menampilkan form untuk mengedit role dari pengguna
    public function editUserRole(User $user)
    {
        $roles = Role::all();
        return view('superadmin.roles.edit-user-role', compact('user', 'roles'));
    }

    // Mengupdate role dari pengguna
    public function updateUserRole(Request $request, User $user)
    {
        $validated = $request->validate([
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id',
        ]);

        $user->roles()->sync($validated['roles']);

        return redirect()->route('roles.index')->with('success', 'User roles updated successfully');
    }

    // Menampilkan form untuk menetapkan permissions ke role
    public function assignPermissions(Role $role)
    {
        $permissions = Permission::all();
        return view('superadmin.permissions.assign', compact('role', 'permissions'));
    }

    // Menyimpan permissions yang ditetapkan ke role
    public function storePermissions(Request $request, Role $role)
    {
        $validated = $request->validate([
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $role->permissions()->sync($validated['permissions']);

        return redirect()->route('roles.index')->with('success', 'Permissions assigned successfully');
    }

    // Menampilkan form untuk mengedit permissions dari role
    public function editPermissions(Role $role)
    {
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('id')->toArray();
        return view('superadmin.permissions.edit-permissions', compact('role', 'permissions', 'rolePermissions'));
    }

    public function updatePermissions(Request $request, Role $role)
    {
        $validated = $request->validate([
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id',
        ]);
    
        $role->permissions()->sync($validated['permissions']);
    
        return redirect()->route('permissions.index')->with('success', 'Permissions updated successfully');
    }
    
}
