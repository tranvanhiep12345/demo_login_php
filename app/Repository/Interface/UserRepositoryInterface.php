<?php
namespace App\Repository\Interface;

use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
    public function all(): Collection;
    public function find($username);
    public function create(array $user);
    public function changePassword($password);
}
