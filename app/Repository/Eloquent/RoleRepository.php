<?php
namespace App\Repository\Eloquent;

use App\Models\Role;
use App\Repository\Interface\RoleRepositoryInterface;
use Illuminate\Support\Collection;

class RoleRepository implements RoleRepositoryInterface
{
    public function __construct(Role $role)
    {
        $this->role = $role;
    }
    public function all(): Collection
    {
        return $this->role->with('users')->get();
    }
    public function find($id)
    {
        return $this->role->with('users')->find($id);
    }
    public function findByUserId($idUser)
    {
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
    }
}
