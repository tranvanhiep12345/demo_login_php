<?php
namespace App\Repository\Eloquent;

use App\Models\Role;
use App\Repository\Interface\RoleRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class RoleRepository implements RoleRepositoryInterface
{
    public function __construct(Role $role)
    {
        $this->role = $role;
    }
    public function findByUserId($idUser)
    {
        $cacheKey = 'roles:user:' . $idUser;

        return Cache::remember($cacheKey, 600, function () use ($idUser) {
            return $this->role
                ->join('role_users', 'roles.id', '=', 'role_users.role_id')
                ->where('role_users.user_id', $idUser)
                ->select([
                    "role_id",
                    "role_name",
                    "role_description",
                    "user_id"
                ])
                ->get();
        });
    }
}
