<?php
namespace App\Repository\Eloquent;

use App\Models\User;
use App\Repository\Interface\UserRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function all(): Collection
    {
        return $this->user->all();
    }

    public function find($username)
    {
        return $this->user->find($username);
    }

    public function create($userData)
    {
        return $this->user->create([
            'display_name' => $userData->display_name,
            'username' => $userData->username,
            'email' => $userData->email,
            'password' => Hash::make($userData->password),
            'password_confirmation' => Hash::make($userData->password_confirmation)
        ]);
    }
    public function changePassword($passwordData)
    {
        $user = auth('api')->user();
        if (!Hash::check($passwordData->old_password, $user->password)) {
            return response()->json(['error' => 'Mật khẩu cũ không chính xác.'], 422);
        }
        return $user->update([
            'password' => Hash::make($passwordData->password)
        ]);
    }
}
