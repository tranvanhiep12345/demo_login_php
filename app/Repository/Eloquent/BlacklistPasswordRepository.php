<?php
namespace App\Repository\Eloquent;

use App\Models\BlacklistPassword;
use App\Repository\Interface\BlacklistPasswordRepositoryInterface;
use Illuminate\Support\Facades\Cache;

class BlacklistPasswordRepository implements BlacklistPasswordRepositoryInterface
{
    public function __construct(BlacklistPassword $blacklistPassword)
    {
        $this->blacklistPassword = $blacklistPassword;
    }
    public function all()
    {
        $cacheKey = 'blacklist_passwords';
        return Cache::remember($cacheKey, 600, function () {
            return $this->blacklistPassword->pluck('blacklist_password')->toArray();
        });
    }
}
