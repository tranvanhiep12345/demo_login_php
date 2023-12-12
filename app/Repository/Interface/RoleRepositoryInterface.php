<?php
namespace App\Repository\Interface;

use Illuminate\Support\Collection;

interface RoleRepositoryInterface
{
    public function all(): Collection;
    public function find($id);
    public function findByUserId($idUser);
}
