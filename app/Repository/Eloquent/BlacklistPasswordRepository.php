<?php
namespace App\Repository\Eloquent;

use App\Models\BlacklistPassword;
use App\Repository\Interface\BlacklistPasswordRepositoryInterface;
use Illuminate\Support\Collection;

class BlacklistPasswordRepository implements BlacklistPasswordRepositoryInterface
{
    public function __construct(BlacklistPassword $blacklistPassword)
    {
        $this->blacklistPassword = $blacklistPassword;
    }
    public function all(): Collection
    {
        return $this->blacklistPassword->all();
    }
}
