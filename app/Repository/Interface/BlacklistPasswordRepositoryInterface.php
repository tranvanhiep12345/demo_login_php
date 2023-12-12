<?php
namespace App\Repository\Interface;

use Illuminate\Support\Collection;

interface BlacklistPasswordRepositoryInterface
{
    public function all(): Collection;
}
