<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Controller;
use App\Repository\Eloquent\PermissionRepository;

class PermissionController extends Controller
{
    public function __construct(PermissionRepository $permissionRepository,
                                RoleController $roleController)
    {
        $this->permissionRepository = $permissionRepository;

        $this->roleController = $roleController;
    }
    public function findByUserId()
    {
        $user = auth('api')->user();
        if (!$user) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }
        return $this->permissionRepository->findByUserId($user->id);
    }
}
