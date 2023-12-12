<?php
namespace App\Repository\Interface;

use Illuminate\Support\Collection;

interface PermissionRepositoryInterface
{
    public function all(): Collection;
    public function find($id);
    public function findByUserId($idUser);
}
