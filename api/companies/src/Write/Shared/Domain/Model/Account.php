<?php

declare(strict_types=1);

namespace App\Write\Shared\Domain\Model;

use App\Shared\Domain\ValueObject\AccountId;

final class Account
{
    public function __construct(
        private readonly AccountId $mainAccountId,
        private readonly User $user
    ) {
    }
}
