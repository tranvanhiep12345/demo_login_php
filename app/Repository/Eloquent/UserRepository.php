<?php
namespace App\Repository\Eloquent;

use App\Http\Requests\ChangePasswordRequest;
use App\Models\User;
use App\Repository\Interface\UserRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(User $user,
                                BlacklistPasswordRepository $blacklistPassword)
    {
        $this->user = $user;
        $this->blacklistPassword = $blacklistPassword;
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
            return false;
        }
        return $user->update([
            'password' => Hash::make($passwordData->password)
        ]);
    }
}
