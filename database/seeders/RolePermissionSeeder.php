<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Permission;
use App\Models\RolePermission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Admin gets all permissions
        $allPermissions = Permission::all();
        foreach ($allPermissions as $permission) {
            RolePermission::create([
                'role' => User::ROLE_ADMIN,
                'permission_id' => $permission->id,
            ]);
        }

        // Operator gets limited permissions (read-only and some management)
        $operatorPermissions = [
            'view_dashboard',
            'manage_news',
            'manage_galleries',
            'manage_comments',
            'manage_surat_online',
            'manage_aduan',
        ];
        
        foreach ($operatorPermissions as $permName) {
            $permission = Permission::where('name', $permName)->first();
            if ($permission) {
                RolePermission::create([
                    'role' => User::ROLE_OPERATOR,
                    'permission_id' => $permission->id,
                ]);
            }
        }

        // User gets minimal permissions (none for admin panel)
        // Users can only access frontend features
    }
};
