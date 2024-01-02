<?php
namespace App\Repository\Interface;

use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
    public function cacheUserData($username);
    public function create(array $user);
    public function changePassword($password);
}
