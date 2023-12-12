<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Controller;
use App\Repository\Eloquent\RoleRepository;

class RoleController extends Controller
{
    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }
    public function index()
    {
        return $this->roleRepository->all();
    }
    public function findByUserId()
    {
        $idUser = auth('api')->user()->id;
        if (!$idUser) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }
        return $this->roleRepository->findByUserId($idUser);
    }
}
