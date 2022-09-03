<?php

declare(strict_types=1);

namespace App\Shared\Domain\Factory;

use App\Shared\Domain\ValueObject\UserId;

interface UserIdFactoryInterface
{
    public function newUserId(): UserId;
}
