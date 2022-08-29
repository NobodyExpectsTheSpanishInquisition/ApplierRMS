<?php

declare(strict_types=1);

namespace App\Write\Shared\Domain\Model;

use App\Shared\Domain\ValueObject\AccountId;
use App\Shared\Domain\ValueObject\FirstName;
use App\Shared\Domain\ValueObject\LastName;
use App\Shared\Domain\ValueObject\UserId;

final class Account
{
    public function __construct(
        private readonly AccountId $mainAccountId,
        private readonly UserId $mainUserId,
        private readonly FirstName $firstName,
        private readonly LastName $lastName
    ) {
    }
}
