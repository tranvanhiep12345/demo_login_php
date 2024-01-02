<?php

namespace App\Repository\Eloquent;

use App\Models\Permission;
use App\Repository\Interface\PermissionRepositoryInterface;
use Illuminate\Support\Facades\Cache;

class PermissionRepository implements PermissionRepositoryInterface
{
    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }

    public function findByUserId($idUser)
    {
        $cacheKey = 'permissions:user:' . $idUser;

        return Cache::remember($cacheKey, 600, function () use ($idUser) {
            return $this->permission
                ->join('permission_roles', 'permissions.id', '=', 'permission_roles.permission_id')
                ->join('role_users', 'permission_roles.role_id', '=', 'role_users.role_id')
                ->where('role_users.user_id', $idUser)
                ->select([
                    "permission_id",
                    "permission_name",
                    "permission_description",
                    "user_id"
                ])
                ->distinct()
                ->get();
        });
    }
}
