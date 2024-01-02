<?php
namespace App\Repository\Interface;

use Illuminate\Support\Collection;

interface RoleRepositoryInterface
{
    public function findByUserId($idUser);
}
