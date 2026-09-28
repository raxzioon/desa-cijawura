<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    use HasFactory;

    protected $fillable = [
        'role',
        'permission_id',
    ];

    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }

    // Method untuk cek apakah role memiliki permission
    public static function roleHasPermission($role, $permissionName)
    {
        return self::where('role', $role)
                  ->whereHas('permission', function($query) use ($permissionName) {
                      $query->where('name', $permissionName);
                  })
                  ->exists();
    }

    // Method untuk dapatkan semua permissions dari role
    public static function getPermissionsByRole($role)
    {
        return self::where('role', $role)
                  ->with('permission')
                  ->get()
                  ->pluck('permission.name')
                  ->toArray();
    }
}

