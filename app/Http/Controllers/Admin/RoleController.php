<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\RolePermission;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = User::getRoles();
        $permissions = Permission::all()->groupBy('module');
        
        // Get current permissions for each role
        $rolePermissions = [];
        foreach (array_keys($roles) as $role) {
            $rolePermissions[$role] = RolePermission::getPermissionsByRole($role);
        }
        
        return view('admin.roles.index', compact('roles', 'permissions', 'rolePermissions'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'role' => 'required|string',
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $role = $request->role;
        
        // Delete existing permissions for this role
        RolePermission::where('role', $role)->delete();
        
        // Add new permissions
        if ($request->has('permissions')) {
            foreach ($request->permissions as $permissionId) {
                RolePermission::create([
                    'role' => $role,
                    'permission_id' => $permissionId,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Hak akses role ' . User::getRoles()[$role] . ' berhasil diperbarui.');
    }
}