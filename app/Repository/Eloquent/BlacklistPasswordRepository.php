<?php
namespace App\Repository\Eloquent;

use App\Models\BlacklistPassword;
use App\Repository\Interface\BlacklistPasswordRepositoryInterface;

class BlacklistPasswordRepository implements BlacklistPasswordRepositoryInterface
{
    public function __construct(BlacklistPassword $blacklistPassword)
    {
        $this->blacklistPassword = $blacklistPassword;
    }
    public function all()
    {
        return $this->blacklistPassword->pluck('blacklist_password')->toArray();
    }
}
