<?php

namespace App\Repository\Eloquent;

use App\Models\User;
use App\Repository\Interface\UserRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function cacheUserData($username)
    {
        $cacheKey = 'user.' . $username;
        return Cache::remember($cacheKey, 600, function () use ($username) {
            return $this->user->where('username', $username)->first();
        });
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

        $user->update([
            'password' => Hash::make($passwordData->password),
            'password_changed_at' => Carbon::now(),
            'jwt_version' => $user->jwt_version + 1,
        ]);
        $user->save();
        $this->clearUserCache($user->username);

        $cachedVersion = $this->user->find($user->id);
        Cache::put('jwt_version:' . $user->id, $cachedVersion->jwt_version, 600);

        return auth('api')->claims([
            'jwt_version' => $user->jwt_version
        ])->fromUser($user);
    }

    public function checkUserBlock($username)
    {
        $cacheKey = 'user.blocked.' . $username;

        return Cache::remember($cacheKey, 600, function () use ($username) {
            $user = $this->user->where('username', $username)->first();
            return $user['is_blocked'];
        });
    }

    public function clearUserCache($username)
    {
        Cache::forget('user.' . $username);
        Cache::forget('user.blocked.' . $username);
    }
}
