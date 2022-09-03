<?php

declare(strict_types=1);

namespace App\Shared\Domain\Factory;

use App\Shared\Domain\ValueObject\AccountId;

interface AccountIdFactoryInterface
{
    public function newAccountId(): AccountId;
}
