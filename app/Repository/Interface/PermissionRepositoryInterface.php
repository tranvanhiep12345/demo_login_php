<?php
namespace App\Repository\Interface;

use Illuminate\Support\Collection;

interface PermissionRepositoryInterface
{
    public function findByUserId($idUser);
}
